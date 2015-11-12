<?php
require("functions.php");

$_POST = file_get_contents("php://input");
$posts = json_decode($_POST);

$html = $posts->html;

// 専用のパターンで検索と取得
$matchies = getMatchies($posts->pattern, $html);

// タイトルの抽出
$title = "";
$count = preg_match("|\<title\>(.*)\</title\>|", $html, $ms);
if($count > 0) $title = $ms[1];

// 詳細の抽出
$description = "";
$count = preg_match('|\<meta +name="Description" +content="(.*)"|', $html, $ms);
if($count > 0) $description = $ms[1];

echo json_encode(array(
	"title" => $title,
	"description" => $description,
	"patterns" => $matchies
));
