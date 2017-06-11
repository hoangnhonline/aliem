<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Goutte, File, Auth;
use App\Helpers\simple_html_dom;
use App\Models\CrawlerFilm;
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
    public function xvideos(){
        $url = 'http://www.xvideos.com/tags/bedroom/';
        set_time_limit(10000);
        //$arr = ['loai_id' => $loai_id, 'cate_id' => $cate_id];
        for($page = 0; $page <= 5; $page++){
            $url = $url.$page;
            $arr = $this->getXvideos($url);
            dd($arr);
            die();
            $chGet = curl_init($url);    
            curl_setopt($chGet, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($chGet, CURLOPT_FOLLOWLOCATION, TRUE);
            if(strpos($url, 'xvideos') > 0){
                curl_setopt($chGet, CURLOPT_USERAGENT, 'Mozilla/5.0 (iPhone; U; CPU like Mac OS X; en) AppleWebKit/420.1 (KHTML, like Gecko) Version/3.0 Mobile/3B48b Safari/419.3');    
            }
            curl_setopt($chGet, CURLOPT_AUTOREFERER, TRUE);
            $resultGet = curl_exec($chGet);    

            curl_close($chGet);    

             // Create a DOM object
            $htmlGet = new simple_html_dom();
            // Load HTML from a string
            $htmlGet->load($resultGet); 

            foreach ($htmlGet->find('.thumb-block') as $e) {
                dd($e);
              $src = $e->find('a img', 0)->src;
              dd($src);

            }


             $crawler = Goutte::request('GET', $url);    
             //dd($crawler);die;         
             $crawler->filter('.thumb-block')->each(function ($node) use ($arr){
                die('123');
                $title = $url = $thumbnail_url = '';                
                    if($node->filter('a img')->count() > 0){
                     $thumbnail_url = $node->filter('a img')->attr('src');
                    }                
                
                $url = "http://www.xvideos.com".$node->filter('a')->attr('href');
                if($node->filter('p a')->count() > 0){
                    $title = $node->filter('p a')->text();
                }
                  
                $params =  [
                    'title' => $title,
                    'url' => $url,                    
                    'thumbnail_url' => $thumbnail_url,
                    'site_id' => 1,
                    'cate_id' => 1
                ];   
                dd($params);
                CrawlerUrl::create($params);
                         
             });    
            
        }
        return $arr;
    }
    public function getXvideos($url) {    
    $linkArr=array();
    $k = 0; 
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

                
                        $k++;                                       
                        
                        $linkArr[$videoID]['id'] = $videoID;
                        $linkArr[$videoID]['time'] = $textTime;             
                        $linkArr[$videoID]['videoUrl'] = $domain.$div->find('a', 0)->attr['href'];
                       /*
                        // get thumnail 
                        $thumnailUrl = $div->find('.thumb', 0)->find('a')->find('img', 0)->attr['src'];

                        dd($thumnailUrl);
                        $thumnailUrl = replace('thumbs169ll', 'thumbs169lll', $thumnailUrl);
                        
                        $linkArr[$videoID]['thumbnailUrl'] = $thumnailUrl;
                        */
                        // get title
                        $linkArr[$videoID]['title'] = $div->find('p', 0)->find('a', 0)->plaintext;
                        dd($linkArr);
                    
                
            }
                    
    }
    
    $html->clear(); //lenh xoa cache Dom, neu khong co ham nay thi bo nho ram se day
    unset($html);
    return $linkArr;
}
    public function street(){
        set_time_limit(100000);
        $districts = District::all();
        foreach($districts as $district){
            $url = 'https://dothi.net/Handler/SearchHandler.ashx?module=GetStreet&distId='.$district->id_dothi; 
            $chs = curl_init();            
            curl_setopt($chs, CURLOPT_URL, $url);
            curl_setopt($chs, CURLOPT_RETURNTRANSFER, 1); 
            curl_setopt($chs, CURLOPT_HEADER, 0);
            $result = curl_exec($chs);
            curl_close($chs);
            $arr = json_decode($result, true);            
            $i = 0;
            foreach($arr as $war){
                $i++;
                $arr['id_dothi'] = $war['Id'];
                $arr['city_id'] = $district->id;
                $arr['district_id'] = $district->city_id;
                $arr['name'] = $war['Text'];
                $arr['display_order'] = $i;
                $arr['prefix'] = $war['StreetPrefix'];
                $arr['status'] = 1;
                $arr['alias'] = Helper::changeFileName($arr['name']);
                Street::create($arr);
            }
        }
   }
    public function ward(){
        set_time_limit(100000);
        $districts = District::all();
        foreach($districts as $district){
            $url = 'https://dothi.net/Handler/SearchHandler.ashx?module=GetWard&distId='.$district->id_dothi; 
            $chs = curl_init();            
            curl_setopt($chs, CURLOPT_URL, $url);
            curl_setopt($chs, CURLOPT_RETURNTRANSFER, 1); 
            curl_setopt($chs, CURLOPT_HEADER, 0);
            $result = curl_exec($chs);
            curl_close($chs);
            $arr = json_decode($result, true);            
            $i = 0;
            foreach($arr as $war){
                $i++;
                $arr['id_dothi'] = $war['Id'];
                $arr['city_id'] = $district->id;
                $arr['district_id'] = $district->city_id;
                $arr['name'] = $war['Text'];
                $arr['display_order'] = $i;
                $arr['prefix'] = $war['WardPrefix'];
                $arr['status'] = 1;
                $arr['alias'] = Helper::changeFileName($arr['name']);
                Ward::create($arr);
            }
        }
   }
   
   public function district(){
        $citys = City::all();
        foreach($citys as $city){
            $url = 'https://dothi.net/Handler/SearchHandler.ashx?module=GetDistrict&cityCode='.$city->code; 
            $chs = curl_init();            
            curl_setopt($chs, CURLOPT_URL, $url);
            curl_setopt($chs, CURLOPT_RETURNTRANSFER, 1); 
            curl_setopt($chs, CURLOPT_HEADER, 0);
            $result = curl_exec($chs);
            curl_close($chs);
            $arr = json_decode($result, true);
            $i = 0;
            foreach($arr as $dis){
                $i++;
                $arr['id_dothi'] = $dis['Id'];
                $arr['city_id'] = $city->id;
                $arr['name'] = $dis['Text'];
                $arr['display_order'] = $i;
                $arr['status'] = 1;
                $arr['alias'] = Helper::changeFileName($arr['name']);
                District::create($arr);
            }
        }
   }

    public function index(Request $request){
        $dataArr = CrawlerUrl::all();
        foreach ($dataArr as $key => $value) {
            $url = $value->url;
            $site = $this->checkSite($url);

            if($site == "tiki"){

                $dataArr = $this->tiki($url, $value->loai_id, $value->cate_id, $value->type);              


            }elseif($site == "adayroi"){

                $dataArr = $this->adayroi($url, $value->loai_id, $value->cate_id, $value->type);                
            }
            elseif($site == "sendo"){

                $dataArr = $this->sendo($url, $value->loai_id, $value->cate_id, $value->type);
               
            }else{
               
                $dataArr = $this->lazada($url, $value->loai_id, $value->cate_id, $value->type);
               
            }
        }
        die;

    }
    public function dothi(Request $request){
        $crawler = Goutte::request('GET', 'https://dothi.net/dang-tin-ban-cho-thue-nha-dat.htm');  
        $html = '<select id="ddlCity" class="select-menu select2-hidden-accessible" style="width: 231px" tabindex="-1" aria-hidden="true"><option value="-1">-- Chọn Tỉnh/Thành phố --</option><option value="SG">Hồ Chí Minh</option><option value="HN">Hà Nội</option><option value="BD">Bình Dương</option><option value="DDN">Đà Nẵng</option><option value="HP">Hải Phòng</option><option value="LA">Long An</option><option value="VT">Bà Rịa Vũng Tàu</option><option value="AG">An Giang</option><option value="BG">Bắc Giang</option><option value="BK">Bắc Kạn</option><option value="BL">Bạc Liêu</option><option value="BN">Bắc Ninh</option><option value="BTR">Bến Tre</option><option value="BDD">Bình Định</option><option value="BP">Bình Phước</option><option value="BTH">Bình Thuận  </option><option value="CM">Cà Mau</option><option value="CT">Cần Thơ</option><option value="CB">Cao Bằng</option><option value="DDL">Đắk Lắk</option><option value="DNO">Đắk Nông</option><option value="DDB">Điện Biên</option><option value="DNA">Đồng Nai</option><option value="DDT">Đồng Tháp</option><option value="GL">Gia Lai</option><option value="HG">Hà Giang</option><option value="HNA">Hà Nam</option><option value="HT">Hà Tĩnh</option><option value="HD">Hải Dương</option><option value="HGI">Hậu Giang</option><option value="HB">Hòa Bình</option><option value="HY">Hưng Yên</option><option value="KH">Khánh Hòa</option><option value="KG">Kiên Giang</option><option value="KT">Kon Tum</option><option value="LCH">Lai Châu</option><option value="LDD">Lâm Đồng</option><option value="LS">Lạng Sơn</option><option value="LCA">Lào Cai</option><option value="NDD">Nam Định</option><option value="NA">Nghệ An</option><option value="NB">Ninh Bình</option><option value="NT">Ninh Thuận</option><option value="PT">Phú Thọ</option><option value="PY">Phú Yên</option><option value="QB">Quảng Bình</option><option value="QNA">Quảng Nam</option><option value="QNG">Quảng Ngãi</option><option value="QNI">Quảng Ninh</option><option value="QT">Quảng Trị</option><option value="ST">Sóc Trăng</option><option value="SL">Sơn La</option><option value="TNI">Tây Ninh</option><option value="TB">Thái Bình</option><option value="TN">Thái Nguyên</option><option value="TH">Thanh Hóa</option><option value="TTH">Thừa Thiên Huế</option><option value="TG">Tiền Giang</option><option value="TV">Trà Vinh</option><option value="TQ">Tuyên Quang</option><option value="VL">Vĩnh Long</option><option value="VP">Vĩnh Phúc</option><option value="YB">Yên Bái</option></select>';
         $crawler = new simple_html_dom();
        // Load HTML from a string
        $crawler->load($html);
        $i = 0;
        foreach($crawler->find('option') as $e) {
           
            $code = $e->value;
            $name = $e->plaintext;
            if($code != '-1'){
                 $i++;
                $arr['code'] = $e->value;
                $arr['display_order'] = $i;
                $arr['name'] = $e->plaintext;
                $arr['alias'] = Helper::changeFileName($arr['name']);
                City::create($arr);
            }            
        }
    }
    public function lazada($url, $loai_id, $cate_id, $type){
        
        set_time_limit(10000);
        $arr = ['loai_id' => $loai_id, 'cate_id' => $cate_id, 'type' => $type];
        for($page = 1; $page <= 1; $page++){ 
                
          
             $crawler = Goutte::request('GET', $url);             
             $crawler->filter('.product-card')->each(function ($node) use ($arr){
             
                $title = $link = $price = $price_old = $sale_percent = $image_url = '';                
                    if($node->filter('.product-card__img img')->count() > 0){
                     $image_url = $node->filter('.product-card__img img')->attr('data-original');
                    }   
             
                
                    $link = $node->filter('a')->attr('href');
                if($node->filter('div.product-card__name-wrap span')->count() > 0){
                    $title = $node->filter('div.product-card__name-wrap span')->text();
                }
                if($node->filter('div.product-card__price')->count() > 0){
                    $price = $node->filter('div.product-card__price')->text();
                }
                if($node->filter('div.product-card__old-price')->count() > 0){
                    $price_old = $node->filter('div.product-card__old-price')->text();
                }
                if($node->filter('div.product-card__sale')->count() > 0){
                    $sale_percent = $node->filter('div.product-card__sale')->text();
                }  
                $params =  [
                    'name' => $title,
                    'url' => $link,
                    'aff_price' => $price,
                    'aff_price_old' => $price_old,
                    'aff_sale_percent' => $sale_percent,
                    'thumbnail_url' => $image_url,
                    'loai_id' => $arr['loai_id'],
                    'cate_id' => $arr['cate_id'],
                    'is_aff' => 1,
                    'type' => $arr['type'],
                    'site_id' => 1,
                    'status' => 1,
                    'created_user' => Auth::user()->id, 
                    'updated_user'=>Auth::user()->id

                ];   
                SanPham::create($params);
                         
             });    
            
        }
        return $arr;
    }
    public function adayroi($url, $loai_id, $cate_id, $type){        
        set_time_limit(10000);
        $arr = ['loai_id' => $loai_id, 'cate_id' => $cate_id, 'type' => $type];
        for($page = 1; $page <= 1; $page++){ 
            
            
             $crawler = Goutte::request('GET', $url);             
             $crawler->filter('.col-lg-3.col-xs-4')->each(function ($node) use ($arr){                
                if($node->filter('.out-of-stock')->count() == 0){
                $title = $link = $price = $price_old = $sale_percent = $image_url = '';
                    if($node->filter('img.imglist')->count() > 0){
                     $image_url = $node->filter('img.imglist')->attr('data-src');
                    }   
                    
                    $link = "https://www.adayroi.com".$node->filter('a')->attr('href');
                    
                    if($node->filter('.post-title')->count() > 0){
                        $title = $node->filter('.post-title')->text();
                    
                    }
                    if($node->filter('.amount-1')->count() > 0){
                         $price = $node->filter('.amount-1')->text();
                   
                    }
                if($node->filter('.amount-2')->count() > 0){
                    $price_old = $node->filter('.amount-2')->text();
                   
                }
                if($node->filter('.sale-off')->count() > 0){
                    $sale_percent = $node->filter('.sale-off')->text();
                    
                }
                    $params =  [
                    'name' => $title,
                    'url' => $link,
                    'aff_price' => $price,
                    'aff_price_old' => $price_old,
                    'aff_sale_percent' => $sale_percent,
                    'thumbnail_url' => $image_url,
                    'loai_id' => $arr['loai_id'],
                    'cate_id' => $arr['cate_id'],
                    'is_aff' => 1,
                    'type' => $arr['type'],
                    'site_id' => 3,
                    'status' => 1,
                    'created_user' => Auth::user()->id, 
                    'updated_user'=>Auth::user()->id
                ];   
                SanPham::create($params); 
               } 
               
             });
             
              
        }
        return $arr;
    }
    public function crawler(Request $request){

        $url = $request->url;        
        $site = $this->checkSite($url);

        if($site == "tiki"){

            $dataArr = $this->crawlerTiki($url);

        }elseif($site == "adayroi"){

            $dataArr = $this->crawlerAdayroi($url);

        }
        elseif($site == "sendo"){

            $dataArr = $this->crawlerSendo($url);

        }else{

            $dataArr = $this->crawlerLazada($url);

        }
        return view('crawler', compact('dataArr', 'url')); 
    }
    public function crawlerLazada($url){
         $crawler = Goutte::request('GET', $url); 
           //var_dump('http://www.lazada.vn/ao-khoac-nu/?dir=desc&page='.$page.'&sort=discountspecial');die;
   
            
        $dataArr['title'] = "";
        $dataArr['img'] = "";
        $dataArr['price'] = "";
        $dataArr['price_old'] = "";
        
        if( $crawler->filter('h1#prod_title')->count() > 0 ){
            $dataArr['title'] = trim($crawler->filter('h1#prod_title')->text());
        }
        
        if( $crawler->filter('meta[property="og:image"]')->count() > 0 ){
           $dataArr['img'] = $crawler->filter('meta[property="og:image"]')->attr('content');
        }
        if( $crawler->filter('#special_price_box')->count() > 0 ){
            $dataArr['price'] = $crawler->filter('#special_price_box')->text();
        }
        if( $crawler->filter('#price_box')->count() > 0 ){
           $dataArr['price_old'] = $crawler->filter('#price_box')->text();
        }

        return $dataArr;            
         
    }
    public function crawlerAdayroi($url){
        $crawler = Goutte::request('GET', $url);
            
        $dataArr['title'] = "";
        $dataArr['img'] = "";
        $dataArr['price'] = "";
        $dataArr['price_old'] = "";
        
        if( $crawler->filter('h1.item-title')->count() > 0 ){
            $dataArr['title'] = trim($crawler->filter('h1.item-title')->text());
        }
        
        if( $crawler->filter('meta[property="og:image"]')->count() > 0 ){
           $dataArr['img'] = $crawler->filter('meta[property="og:image"]')->attr('content');
        }
        if( $crawler->filter('div.item-price')->count() > 0 ){
            $dataArr['price'] = $crawler->filter('div.item-price')->text();
        }
        if( $crawler->filter('div.price span.original')->count() > 0 ){
           $dataArr['price_old'] = $crawler->filter('div.price span.original')->text();
        }

        return $dataArr;            
         
    }
    public function crawlerSendo($url){
        $crawler = Goutte::request('GET', $url);
            
        $dataArr['title'] = "";
        $dataArr['img'] = "";
        $dataArr['price'] = "";
        $dataArr['price_old'] = "";
        
        if( $crawler->filter('#lightbox_detail h1 strong.fn')->count() > 0 ){
            $dataArr['title'] = trim($crawler->filter('#lightbox_detail h1 strong.fn')->text());
        }
        
        if( $crawler->filter('meta[property="og:image"]')->count() > 0 ){
           $dataArr['img'] = $crawler->filter('meta[property="og:image"]')->attr('content');
        }
        if( $crawler->filter('#lightbox_detail .box-price div.cur-price span')->first()->count() > 0 ){
            $dataArr['price'] = number_format($crawler->filter('#lightbox_detail .box-price div.cur-price span')->first()->text());
        }
        if( $crawler->filter('#lightbox_detail .old-price')->count() > 0 ){
           $dataArr['price_old'] = $crawler->filter('#lightbox_detail .old-price')->text();
        }

        return $dataArr;            
         
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
