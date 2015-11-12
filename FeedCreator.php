<?php
class FeedCreator
{
	var $id;
	var $title;
	var $author;
	var $link_alternate;
	var $link_self;
	var $entries = array();
	
	function __construct() {
	}

	private function escapeNgword($txt)
	{
		return str_replace("&", " ", $txt);
	}

	private function getRfc822()
	{
		$sysdate = new datetime();
		return $sysdate->format( DateTime::RFC822 );
	}

	public function setBase($id, $title, $link_alternate)
	{
		$this->id = $this->escapeNgword($id);
		$this->title = $this->escapeNgword($title);
		$this->link_alternate = $this->escapeNgword($link_alternate);
	}

	public function setLinkSelf($link_self)
	{
		$this->link_self = $link_self;
	}

	public function addEntry($id, $title, $link, $summary)
	{
		$this->entries[] = array(
			"id"      => $this->escapeNgword($id),
			"title"   => $this->escapeNgword($title),
			"link"    => $this->escapeNgword($link),
			"updated" => $this->getRfc822(),
			"summary" => $this->escapeNgword($summary),
		);
	}

	public function getRss2String()
	{
		$atom = "";

		// header
		$atom.= '<title>'.$this->title.'</title>'."\n";
		$atom.= '<description>'.$this->title.'</description>'."\n";
		$atom.= "<link>".$this->link_alternate."</link>"."\n";
		$atom.= '<lastBuildDate>'.$this->getRfc822().'</lastBuildDate>'."\n";

		// feeds
		foreach($this->entries as $entry) {
			$ent = "";
			$ent.="<title>".$entry["title"]."</title>"."\n";
			$ent.="<link>".$entry["link"]."</link>"."\n";
			$ent.="<pubDate>".$entry["updated"]."</pubDate>"."\n";
			$ent.="<description>".$entry["title"]."</description>"."\n";
			$ent.="<content:encoded><![CDATA[".$entry["summary"]."]]></content:encoded>"."\n";
			$ent.="<guid isPermaLink=\"true\">".$entry["link"]."</guid>"."\n";
			$ent ="<item>".$ent."</item>"."\n";
			$atom .= $ent;
		}

		// rss2
		$rss2= '<?xml version="1.0" encoding="utf-8"?>'
			. '<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:content="http://purl.org/rss/1.0/modules/content/">'
			. '<channel>'
			. $atom
			. '</channel>'
			. '</rss>';
		return $rss2;
	}
}
