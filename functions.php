<?php
require("FeedCreator.php");

function createRssMakerPattern($pattern)
{
	$pattern = preg_quote($pattern);
	$pattern = str_replace("/", "\/", $pattern);
	$pattern = str_replace("\{%\}", "(.*)", $pattern);
	$pattern = str_replace("\{\*\}", ".*", $pattern);

	return $pattern;
}

function getMatchies($pattern, $text)
{
	// マッチ
	$pattern = createRssMakerPattern($pattern);
	$count = preg_match_all("/${pattern}/", $text, $ms);

	// チェックとカスタマイズ
	if($count == 0) {
		return (object)array();
	}
	
	$i = 0;
	$c = count($ms[0]);
	$patterns = array();
	foreach($ms as $match)
	{
		$j = 0;
		foreach($match as $m){
			$patterns[$j][$i] = $m;
			$j++;
		}
		$i++;
	}

	// 返却
	return $patterns;
}

function itemReplace($pattern, $vals)
{
	$r = str_replace('"', '\"', $pattern);
	$r = str_replace('$', '\$', $r);
	$r = preg_replace("/\{\%([0-9]+)\}/", '$vals[$1]', $r);
	return eval("return \"$r\";");
}

function fsave($path, $data, $type="a")
{
	if ($fh=fopen("$path",$type)) {
		if (flock($fh,LOCK_EX)) {
			fwrite($fh, $data);
			flock($fh,LOCK_UN);
		}
		fclose($fh);
	}
}

// ファイルの中身を読んで文字列に格納する
function fread_all($path)
{
	$fh = fopen($path, "r");
	$data = fread($fh, filesize($path));
	fclose($fh);

	return $data;
}

function isHtml($uri)
{
	if(preg_match('/^(https?|ftp)(:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:\@&=+\$,%#]+)$/', $uri))
	{
		return true;
	}
	return false;
}

function getSite($uri)
{
	$content = file_get_contents($uri);
	$content = preg_replace("/\n\s+/", "\n", $content);
	return $content;
}

function getRss2String($content, $pattern)
{
	$Feed = new FeedCreator();
	$Feed->setBase($pattern->baseurl, $pattern->feed_title, $pattern->baseurl);
	
	$matchies = getMatchies($pattern->pattern, $content);
	foreach($matchies as $m) {
		$id = $pattern->baseurl.time();
		$title = itemReplace($pattern->item_title, $m);
		$link = itemReplace($pattern->item_link, $m);
		$summary = itemReplace($pattern->item_content, $m);
		$Feed->addEntry($id, $title, $link, $summary);
	}
	$rss2 = $Feed->getRss2String();
	unset($Feed);

	return $rss2;

}








