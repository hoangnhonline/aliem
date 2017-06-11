<?
	$db_host='localhost';
	$db_user='root';
	$db_pass='1234567';
	$db_data='getcontent';
	 
	mysql_connect($db_host,$db_user,$db_pass) or die("Not connected to database");
	mysql_select_db($db_data) or die ("Not found database");
	mysql_query('SET NAMES "UTF8"');

	$sql= mysql_query("SELECT * FROM imdb");
	if(mysql_num_rows($sql)<=0){echo"<center><font color=red>CHƯA CẤU HÌNH SITE LEECH TIN TỨC</font></center>";}
	while($site_result=mysql_fetch_array($sql))
	{
		$n=$site_result['stt'];
		$str_name=$site_result['name'];
		$link_pic=$site_result['pic'];
		$str_id=$site_result['linkid'];
		$str_work=$site_result['work'];
		
		mysql_query("INSERT imdbi (stt, name, pic, linkid, work) values 
							(
							'".addslashes($n)."',
							'".addslashes($str_name)."',
							'".addslashes($link_pic)."',
							'".addslashes($str_id)."',
							'".addslashes($str_work)."')"
							);
			
			echo "-------------------------".$n;
			echo "<br />";
			ini_set('max_execution_time', 100000);
	}
$sql= mysql_query("DROP table imdb");
echo ".......done";
?>
