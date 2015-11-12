<?php
require("functions.php");

$_POST = file_get_contents("php://input");
$posts = json_decode($_POST);

$Atom = new FeedCreator();
$Atom->setBase($posts->basurl, $posts->feed_title, $posts->baseurl);

$matchies = getMatchies($posts->pattern, $posts->html);
foreach($matchies as $m) {
	$id = $posts->baseurl.time();
	$title = itemReplace($posts->item_title, $m);
	$link = itemReplace($posts->item_link, $m);
	$summary = itemReplace($posts->item_content, $m);
	$Atom->addEntry($id, $title, $link, $summary);
}

echo $Atom->getRss2String();



