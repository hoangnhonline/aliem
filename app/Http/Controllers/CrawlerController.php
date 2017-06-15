<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Goutte, File, Auth;
use App\Helpers\simple_html_dom;
use App\Models\CrawlerFilm;
use App\Models\CrwVideo;
use App\Helpers\Helper;

class CrawlerController extends Controller
{

    // get html dom from file
    // $maxlen is defined in the code as PHP_STREAM_COPY_ALL which is defined as -1.
    public function file_get_html($url, $use_include_path = false, $context=null, $offset = -1, $maxLen=-1, $lowercase = true, $forceTagsClosed=true, $target_charset ='UTF-8', $stripRN=true, $defaultBRText="\r\n", $defaultSpanText=" ")
    {
        // We DO force the tags to be terminated.
        $dom = new simple_html_dom(null, $lowercase, $forceTagsClosed, $target_charset, $stripRN, $defaultBRText, $defaultSpanText);
        // For sourceforge users: uncomment the next line and comment the retreive_url_contents line 2 lines down if it is not already done.
        $contents = file_get_contents($url, $use_include_path, $context, $offset);
        // Paperg - use our own mechanism for getting the contents as we want to control the timeout.
        //$contents = retrieve_url_contents($url);
        if (empty($contents) || strlen($contents) > 600000)
        {
            return false;
        }
        // The second parameter can force the selectors to all be lowercase.
        $dom->load($contents, $lowercase, $stripRN);
        return $dom;
    }
    public function imageXvideos(){
        set_time_limit(1000000);
        $videoList = CrwVideo::whereNull('image_url')->get();
        foreach ($videoList as $video) {
            $video_url = $video->video_url;
            $image_url = $this->getImageUrlXvideo($video_url);
            $image_url = str_replace('ll', 'lll', $image_url);
            $video->image_url = $image_url;
            $video->save();
        }
    }
    public function xvideos(){        
        set_time_limit(1000000);
        //$arr = ['loai_id' => $loai_id, 'cate_id' => $cate_id];
        for($page = 0; $page <= 84; $page++){
            $url = 'http://www.xvideos.com/tags/hot-teen';
            //http://www.xvideos.com/tags/best-blowjob
            //http://www.xvideos.com/?k=sinh+vien&p=83
            $url = $url.$page;
            $arr = $this->getXvideos($url, 2, 1);            
        }
         dd('done');
        return $arr;
    }
    public function getImageUrlXvideo($url){
        $html = $this->file_get_html($url);
        if($html->find('meta[property="og:image"]', 0)){
            return $img = $html->find('meta[property="og:image"]', 0)->attr['content'];
        }else{
            return '';
        }
    }
    public function getXvideos($url, $tag_id, $site_id) {    
    $linkArr=array(); 
    echo "<h4>".$url."</h4>";
    //$html = new simple_html_dom();
    $html = $this->file_get_html($url);

    $domain = "http://www.xvideos.com";
    foreach ($html->find("div.thumb-block ") as $div){        
        // get id video
        $tmp = explode("_",$div->attr['id']);
        $videoID = $tmp['1'];
        if($videoID > 0){                
            $textTime = $div->find('p.metadata', 0)->find('span.bg', 0)->find('strong', 0)->innertext;
                if($this->checkTimeXvideos($textTime)){
                $linkArr['tag_id'] = $tag_id;
                $linkArr['site_id'] = $site_id;
                $linkArr['external_id'] = $videoID;
                $linkArr['duration'] = $textTime;  
                if($div->find('a', 0)){           
                    $linkArr['video_url'] = $domain.$div->find('a', 0)->attr['href'];
                }
                if($div->find('p', 0)->find('a', 0)){
                    $linkArr['title'] = $div->find('p', 0)->find('a', 0)->plaintext;
                }
                if(isset($linkArr['title']) && $linkArr['title'] !='' && isset($linkArr['video_url']) && $linkArr['video_url'] != ''){
                    CrwVideo::create($linkArr);
                }
            }
        }                    
    }
   
    $html->clear(); //lenh xoa cache Dom, neu khong co ham nay thi bo nho ram se day
    unset($html);
    return $linkArr;
}
   
    public function checkTimeXvideos($text){
        if(strpos($text, "h") > 0){
            return true;
        }else{
            $text = explode(" ", $text);    
            if($text[1] == 'sec'){
                return false;
            }
            $text = trim($text[0]); 
            $text = str_replace(" ", "", $text);
            $text = str_replace("(", "", $text);                    
            return (int) $text > 4 ? true : false;
        }
        
    }
    public function crawlerTiki($url){
        set_time_limit(10000);    
        $url = $url; 
        $chs = curl_init();            
        curl_setopt($chs, CURLOPT_URL, $url);
        curl_setopt($chs, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt($chs, CURLOPT_HEADER, 0);
        $result = curl_exec($chs);
        curl_close($chs);
        // Create a DOM object
        $crawler = new simple_html_dom();
        // Load HTML from a string
        $crawler->load($result);
        $dataArr['title'] = "";
        $dataArr['img'] = "";
        $dataArr['price'] = "";
        $dataArr['price_old'] = "";
        
        if($crawler->find('h1.item-name', 0)){
            $dataArr['title'] = trim($crawler->find('h1.item-name', 0)->innertext);
        }
        if($crawler->find('meta[property="og:image"]', 0)){
            $dataArr['img'] = $crawler->find('meta[property="og:image"]', 0)->content;
        }
        if($crawler->find('#span-price', 0)){
            $dataArr['price'] = $crawler->find('#span-price', 0)->innertext;    
        }
        if($crawler->find('.old-price-item span', 1)){
            $dataArr['price_old'] = $crawler->find('.old-price-item span', 1)->innertext;    
        }
        return $dataArr;
    }
    public function checkSite($url){
        if( strpos($url, 'tiki.vn') > 0 ){
            $site = "tiki";
        }elseif(strpos($url, 'adayroi') > 0){
            $site = "adayroi";
        }elseif(strpos($url, 'sendo') > 0){
            $site = "sendo";
        }else{
            $site = "lazada";
        }
        return $site;
    }
    public function tiki($url, $loai_id, $cate_id, $type){
        $arr = [];
        set_time_limit(10000);
        for($page = 1; $page <= 1; $page++){ 
             //$crawler = Goutte::request('GET', 'https://tiki.vn/laptop/c2742?order=discount_percent%2Cdesc&page='.$page);   
             //var_dump('https://tiki.vn/laptop/c2742?order=discount_percent%2Cdesc&page='.$page);             
            
            
             $chs = curl_init();

            // set URL and other appropriate options
            curl_setopt($chs, CURLOPT_URL, $url);
            curl_setopt($chs, CURLOPT_RETURNTRANSFER, 1); 
            curl_setopt($chs, CURLOPT_HEADER, 0);

            // grab URL and pass it to the browser
            $result = curl_exec($chs);

            // close cURL resource, and free up system resources
            curl_close($chs);
         // Create a DOM object
            $crawler = new simple_html_dom();
            // Load HTML from a string
            $crawler->load($result);
            foreach($crawler->find('div.product-item') as $node){          
               $title = $link = $price = $price_old = $sale_percent = $image_url = '';
                $title = $content = $image_url = $link = "";
                $count_img = count($node->find('span.image img'));
                
                    if($count_img == 2){
                     $image_url = $node->find('span.image img',1)->src;
                    }
                    if($count_img == 1){
                     $image_url = $node->find('span.image img',0)->src;
                    }  
                    if($count_img == 3){
                     $image_url = $node->find('span.image img',2)->src;
                    }                  
                    
                    $link = $node->find('a', 0)->href;
                    $link = strstr($link, '?', true);
                   
                    if($node->find('span.title', 0)){
                     $title = trim($node->find('span.title', 0)->innertext);                   
                    }
                 if($node->find('.price-sale', 0)){
                    $price_tmp = $node->find('.price-sale', 0)->innertext;
                    $tmpArr = explode('<span', $price_tmp);
                    $price = $tmpArr[0];                    
                }
                if($node->find('.price-regular', 0)){
                    $price_old = $node->find('.price-regular', 0)->innertext;                   
                }
                if($node->find('.sale-tag', 0)){
                  $sale_percent = $node->find('.sale-tag', 0)->innertext;                            
              }
              $params =  [
                    'name' => $title,
                    'url' => $link,
                    'aff_price' => $price,
                    'aff_price_old' => $price_old,
                    'aff_sale_percent' => $sale_percent,
                    'thumbnail_url' => $image_url,
                    'loai_id' => $loai_id,
                    'cate_id' => $cate_id,
                    'is_aff' => 1,
                    'type' => $type,
                    'site_id' => 2,
                    'status' => 1,
                    'created_user' => Auth::user()->id, 
                    'updated_user'=>Auth::user()->id
                ];  
                  
                SanPham::create($params);
            };
              
        }
        return $arr;
    }
    public function detail(Request $request){
    	set_time_limit(10000);
    	$all = Link::where('id', '>=', 1000)->where('id', '<', 1001)->where('status', 1)->get();

    	foreach ($all as $key => $value) {
    		$url = $value->link;
    		$id = $value->id;
    		$crawler = Goutte::request('GET', $url); 
    		$content = $crawler->filter('div.aboutus')->html();    		
    		$model = Link::find($id);
    		$model->status = 0;
    		$model->content = $content;
    		$model->save();
    	}
    }

    public function imageContent(Request $request)
    {
    	set_time_limit(10000);   	

    	$all = Link::where('status', 0)->get();
    	

    	$linkArr = [];
    	foreach($all as $link){
    		echo $link->link;
    		echo "<br>";
    		if( !in_array($link->link , ['http://www.androidgiare.vn/danh-gia-lg-f160/', 'http://www.androidgiare.vn/phablet-cao-cap-dien-thoai-sky-a920/'])){
    		//$link = Link::where('link', 'http://www.androidgiare.vn/dien-thoai-lg-gia-re-duoi-4-trieu/')->first();
    		$html = $link->content;
	    	$doc = new \DOMDocument();
			$doc->loadHTML( $html );

			$images = $doc->getElementsByTagName("img");

			for ( $i = 0; $i < $images->length; $i++ ) {
			  // Outputs: foo.jpg bar.png
			  $image_url = "http://www.androidgiare.vn".$images->item( $i )->attributes->getNamedItem( 'src' )->nodeValue;

			  echo "<br>";
			  if($image_url && strpos($image_url, 'wp-content/') && !strpos($image_url, '/wp-content/')) {
		    		$saveto = str_replace("http://www.androidgiare.vn/wp-content/", "", $image_url);
		    		$tmp = explode('/', $saveto);
		    	
		    		$dir = str_replace(end($tmp), "", $saveto);
		    		
		    		if(!is_dir(public_path() ."/".$dir)){
		    			mkdir(public_path() ."/".$dir, true);
		    		}
		    		var_dump($image_url);
		    		echo "<br>";
		    		var_dump($saveto);
		    		$this->grab_image($image_url, $saveto);
		    		echo "<br>";
		    		$i++;
		    		echo $i." - ".$link->id;
		    		
	    		}
			}	
			echo "<hr>";	
			}	
		}
    }
    public function update(Request $request){
    	$all = Link::all();
    	$linkArr = [];
    	foreach($all as $link){
    		$url = $link->link;
    		$post_name = str_replace("http://www.androidgiare.vn/", "", $url);
    		$post_name = str_replace("/", "", $post_name);
    		$id = $link->id;
    		$title = str_replace("http://www.androidgiare.vn", "", $link->title);
    		
    		$model = Link::find($id);
    		$model->title = $title;
    		$model->post_name = $post_name;
    		$model->save();
    	}  	
    	
    }
    public function saveImage(Request $request){
    	set_time_limit(10000);
    	$all = Link::all();
    	$i = 0;
    	foreach($all as $value){

    		$image_url = $value->image_url;
    		if($image_url){
	    		$saveto = str_replace("http://www.androidgiare.vn/wp-content/", "", $image_url);
	    		$tmp = explode('/', $saveto);
	    	
	    		$dir = str_replace(end($tmp), "", $saveto);
	    		
	    		if(!is_dir(public_path() ."/".$dir)){
	    			mkdir(public_path() ."/".$dir, true);
	    		}
	    		var_dump($image_url);
	    		var_dump($saveto);
	    		$this->grab_image($image_url, $saveto);
	    		$i++;
	    		echo $i." - ".$value->id;
	    		echo "<hr>";
    		}
    	}
    }
    public function grab_image($url,$saveto){
    	var_dump($url);
	    $ch = curl_init ($url);
	    curl_setopt($ch, CURLOPT_HEADER, 0);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
	    $raw=curl_exec($ch);
	    var_dump($raw);die;
	    if($raw){
		    curl_close ($ch);
		    if(!file_exists($saveto)){
		        $fp = fopen($saveto,'x');
			    fwrite($fp, $raw);
			    fclose($fp);
		    }
		}
	    
	}
    public static function changeFileName($str) {
        $str = self::stripUnicode($str);
        $str = str_replace("?", "", $str);
        $str = str_replace("&", "", $str);
        $str = str_replace("'", "", $str);
        $str = str_replace("  ", " ", $str);
        $str = trim($str);
        $str = mb_convert_case($str, MB_CASE_LOWER, 'utf-8');
        $str = str_replace(" ", "-", $str);
        $str = str_replace("---", "-", $str);
        $str = str_replace("--", "-", $str);
        $str = str_replace('"', '', $str);
        $str = str_replace('"', "", $str);
        $str = str_replace(":", "", $str);
        $str = str_replace("(", "", $str);
        $str = str_replace(")", "", $str);
        $str = str_replace(",", "", $str);
        $str = str_replace(".", "", $str);
        $str = str_replace(".", "", $str);
        $str = str_replace(".", "", $str);
        $str = str_replace("%", "", $str);
        return $str;
    }

    public static function stripUnicode($str) {
        if (!$str)
            return false;
        $unicode = array(
            'a' => 'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ',
            'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'd' => 'đ',
            'D' => 'Đ',
            'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'i' => 'í|ì|ỉ|ĩ|ị',
            'I' => 'Í|Ì|Ỉ|Ĩ|Ị',
            'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
            'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
            '' => '?',
            '-' => '/'
        );
        foreach ($unicode as $khongdau => $codau) {
            $arr = explode("|", $codau);
            $str = str_replace($arr, $khongdau, $str);
        }
        return $str;
    }
}
