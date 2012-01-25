<?php

$dbhost = "localhost";
$dbuser = "webguync";
$dbpass = "Phoenix90";
$dbname = "test";

$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die                      ('Error connecting to mysql');
mysql_select_db($dbname);

if(isset($_GET['query'])) { $query = $_GET['query']; } else { $query = ""; }
if(isset($_GET['type'])) { $type = $_GET['type']; } else { $query = "count"; }

if($type == "count")
{
	$sql = mysql_query("SELECT count(id) 
								FROM urls 
								WHERE MATCH(url_url, url_title, url_desc)
								AGAINST('$query' IN BOOLEAN MODE)");
	$total = mysql_fetch_array($sql);
	$num = $total[0];
	
	echo $num;
	
}

if($type == "results")
{
	$sql = mysql_query("SELECT url_url, url_title, url_desc 
								FROM urls 
								WHERE MATCH(url_url, url_title, url_desc)
								AGAINST('$query' IN BOOLEAN MODE)");
	while($array = mysql_fetch_array($sql)) {

		$url_url = $array['url_url'];
		$url_title = $array['url_title'];
		$url_desc = $array['url_desc'];
		
		echo "<div class=\"url-holder\"><a href=\"" . $url_url . "\" class=\"url-title\" target=\"_blank\">" . $url_title . "</a>
	
	<div class=\"url-desc\">" . $url_desc . "</div></div>";
				
	}
	
}

mysql_close($conn);

?>