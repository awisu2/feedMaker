<?php
require("functions.php");

$dir = dirname(__file__);
$path = $dir . "/tmp/data.txt";

$data = fread_all($path);
$loads = json_decode($data);

$i=0;
foreach($loads as $load)
{
	// getSite
	$content = getSite($load->baseurl);
	if(!$content) continue;

	// createFeed
	$feed = getRss2String($content, $load);

	// save
	fsave($dir . "/feeds/feed_" . sprintf("%05d", $i) . ".xml", $feed);

	$i++;
}
