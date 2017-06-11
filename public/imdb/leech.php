<?
ini_set('max_execution_time', 1000000);
//CONFIG DATA BASE LEECH IMDB==========================================================================================
	$db_host='localhost';
	$db_user='admin_1pphim';
	$db_pass='1pphimphanngoc';
	$db_data='admin_1pphim';
	 
	mysql_connect($db_host,$db_user,$db_pass) or die("Not connected to database");
	mysql_select_db($db_data) or die ("Not found database");
	mysql_query('SET NAMES "UTF8"');
//CONFIG DATA BASE LEECH IMDB==========================================================================================

//FUNCTION LEECH IMDB==================================================================================================
function string_split($str, $dau, $duoi)
	{
		$arr_content[]= array();
		$arr_content=explode($dau,$str);
		$str=$arr_content[1];
		$arr_content=explode($duoi,$str);
		$content=$arr_content[0];
		return $content;
	}
function curl_get_contents($url,  $javascript_loop = 0, $timeout = 5)
{

    $url = str_replace( "&amp;", "&", urldecode(trim($url)) );

    $cookie = tempnam ("/tmp", "CURLCOOKIE");
    $ch = curl_init();
    curl_setopt( $ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; rv:1.7.3) Gecko/20041001 Firefox/0.10.1" );
    curl_setopt( $ch, CURLOPT_URL, $url );
    curl_setopt( $ch, CURLOPT_COOKIEJAR, $cookie );
    curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
    curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
	curl_setopt( $ch, CURLOPT_ENCODING, "" );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
    curl_setopt( $ch, CURLOPT_AUTOREFERER, true );
    curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );    # required for https urls
    curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, $timeout );
    curl_setopt( $ch, CURLOPT_TIMEOUT, $timeout );
    curl_setopt( $ch, CURLOPT_MAXREDIRS, 10 );
    $content = curl_exec( $ch );
    $response = curl_getinfo( $ch );
    curl_close ( $ch );

    if ($response['http_code'] == 301 || $response['http_code'] == 302) {
        ini_set("user_agent", "Mozilla/5.0 (Windows; U; Windows NT 5.1; rv:1.7.3) Gecko/20041001 Firefox/0.10.1");

        if ( $headers = get_headers($response['url']) ) {
            foreach( $headers as $value ) {
                if ( substr( strtolower($value), 0, 9 ) == "location:" )
                    return get_url( trim( substr( $value, 9, strlen($value) ) ) );
            }
        }
    }

    if (    ( preg_match("/>[[:space:]]+window\.location\.replace\('(.*)'\)/i", $content, $value) || preg_match("/>[[:space:]]+window\.location\=\"(.*)\"/i", $content, $value) ) && $javascript_loop < 5) {
        return get_url( $value[1], $javascript_loop+1 );
    } else {
        return $content;
    }
}
//FUNCTION LEECH IMDB==================================================================================================

//XU LY LEECH IMDB=====================================================================================================

//Link anh:
	//<img id="name-poster"
	//<td id="overview-top">
//Ten nhan vat:
	//<meta property='og:title' content="
	//<meta property='og:site_name'
//Link nhan vat:
	//<link rel="canonical" href="
	//<meta property='og:site_name'

//Thuat toan:
//Get link trong chuoi theo ID, check chuoi co hay khong ky tu "name-poster", neu khong co ky tu nay thi bo qua, check cai khac, neu co thi xu ly tiep

	
//---------------------------------------------------------------------------------------------------------------------------------
	$n_loop= count($n_loop);
		for ($n=300000; $n<500000; $n++)
			{
			$url='www.imdb.com/name/nm0'.$n;
			$front_name="meta property='og:title' content=".'"';
			$rear_name= '" />';
			$front_pic='img id="name-poster"';
			$rear_pic= 'itemprop="image" />'; 
			$front_id='link rel="canonical" href="';
			$rear_id= '/" />';
			$front_work='<div class="infobar" id="name-job-categories">';
			$rear_work='</div>';
			// Chuyển Url leech thành String
			$str_url=curl_get_contents($url);
			echo "<b>".$n."</b>";
			echo "<br />";
			
			//Kiem tra load. Neu khong ra site IMDB thi n-- (kiem tra ky tu IMDb</title>)
			if(!strpos($str_url,"IMDb</title>"))
			{
				$n--;
			}
			
			//Xác định ten cua nhan vat:
			$str_name= string_split($str_url,$front_name,$rear_name);
			echo "<b>Name: </b>".$str_name;
			echo "<br />";
			
			//Xác định link ID cua nhan vat:
			$str_id= string_split($str_url,$front_id, $rear_id);
			echo "<b>Link: </b>".$str_id;
			echo "<br />";
			
			//Xác định cong viec cua nhan vat:
			$str_work= preg_replace('/\s\s+/', ' ',trim(strip_tags(string_split($str_url,$front_work, $rear_work))));
			echo "<b>Work: </b>".$str_work;
			echo "<br />";
			
			//Xác định pic cua nhan vat:
			$str_pic= string_split($str_url,$front_pic, $rear_pic);
			$link_pic=string_split($str_pic,'src="', '"');
			echo "<b>Pic: </b>".$link_pic;
			echo "<br />";
						

			
// Dữ liệu cần lấy ra để đưa vào CSDL:
//			- $str_name
//			- $link_pic;
//			- $str_id;
//			- $str_kieu
			if($link_pic!="")
			{
			mysql_query("INSERT imdb (stt, name, pic, linkid, work) values 
							(
							'".addslashes($n)."',
							'".addslashes($str_name)."',
							'".addslashes($link_pic)."',
							'".addslashes($str_id)."',
							'".addslashes($str_work)."')"
							);
			}
			echo "---------------------------------------------------------------------------------------------------------------";
			echo "<br />";
			ini_set('max_execution_time', 100000);
			}

//XU LY LEECH IMDB=====================================================================================================
?>