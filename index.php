<?php
if(!function_exists('curl_init')) die("Curl PHP package is not installed!");
 
$linkid = $_GET['linkid'];
$limit = $_GET['limit'];
$curl = curl_init();
 
$expire = 3;
curl_setopt($curl, CURLOPT_URL, $linkid);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 3);
$content = curl_exec($curl);
curl_close($curl);
 
$offset = 0;
$counter = 0;
$result = strpos($content, "\"href=\"/watch?v=", $offset);
while($result != false)
{
	echo ">";
	$assist = substr($content, $result + 16, 11);
	echo $assist;
	$var = strpos($content, "</a>", $result + 29);
	echo " = ";
	$assist = substr($content, $result + 29, $var - 29 - $result);
	echo $assist;
	echo "<";
	$counter++;
	$offset = $result + 164;
	$result = strpos($content, "\"href=\"/watch?v=", $offset);
	if($counter >= $limit) break;
}
if($counter == 0) echo "No results found!";
?>