<?php 
ini_set('display_errors', 1);
set_time_limit(0);
require "dom.php";
$url='http://123movies.to/';
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (iPhone; U; CPU like Mac OS X; en) AppleWebKit/420.1 (KHTML, like Gecko) Version/3.0 Mobile/3B48b Safari/419.3');    
curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
$result = curl_exec($ch);    

curl_close($ch);    

 // Create a DOM object
$html = new simple_html_dom();
// Load HTML from a string
$html->load($result);


foreach ($html->find('img') as $value) {
	saveFile($value->['data-original']);
}

function saveFile($url){
	$tmp = createDir($url);
	
	$file_name = $tmp['file_name'];
	$path = $tmp['path'];
	
	$chs = curl_init();

// set URL and other appropriate options
	curl_setopt($chs, CURLOPT_URL, $url);
	curl_setopt($chs, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($chs, CURLOPT_HEADER, 0);

	// grab URL and pass it to the browser
	$out = curl_exec($chs);

	// close cURL resource, and free up system resources
	curl_close($chs);
	
	$fp = fopen($path.$file_name, 'w');
	fwrite($fp, $out);
	fclose($fp);
}
function createDir($url){
	$path = "";
	$url = str_replace("http://123movies.to/", "", $url);

	$tmpArr = explode('/', $url);
	
	$file_name = end($tmpArr);
	unset($tmpArr[count($tmpArr)- 1]);
	//unset($tmpArr[]);
	if(!empty($tmpArr)){
		foreach ($tmpArr as $new_folder) {
			$path.= $new_folder."/";			
		}
	}

	if(!is_dir($path) && $path != ''){
		mkdir($path);
	}
	
	return array('path' => $path, 'file_name' => $file_name);

}
?>