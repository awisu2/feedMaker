<?php
require("functions.php");

$_POST = file_get_contents("php://input");
$posts = json_decode($_POST);

$data = array(
	"baseurl" => $posts->baseurl,
	"feed_title" => $posts->feed_title,
	"pattern" => $posts->pattern,
	"item_title" => $posts->item_title,
	"item_link" => $posts->item_link,
	"item_content" => $posts->item_content,
);

$dir = dirname(__file__);
$file_path = $dir . "/tmp/data.txt";

$d = json_encode(array($data));

fsave($file_path, $d."\n", "w");
