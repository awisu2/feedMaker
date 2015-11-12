<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>rssMaker</title>
  <link rel="stylesheet" href="style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="rssMaker.js"></script>
</head>
<body>

step1: input base url
<br>

url : <input id="baseurl" type="text" value=""/>
<br>

<button id="button_step1" type="button" name="step1" value="val1">submit</button>
<br />

<textarea id="basehtml"></textarea>
<br />

step2: setting content pattern
<br>

<textarea id="content_pattern"></textarea><br>

<button id="button_step2" type="button" name="step1" value="val1">submit</button><br>

<textarea id="pattern_list"></textarea><br>

step3: make rss<br>

<span class="feed_title">Feed Title</span> : <input id="feed_title" class="feed_text" type="text" id="rss_title" value=""><br>

<span class="feed_title">Feed Link</span> : <input id="feed_link" class="feed_text" type="text" id="rss_" value=""><br>

<span class="feed_title">Feed Description</span> : <input id="feed_description" class="feed_text" type="text" id="rss_" value=""><br>

Rss item ::<br>

<span class="feed_title">Item title</span> : <input id="item_title" class="feed_text" type="text" id="rss_title" value=""><br>

<span class="feed_title">Item Link</span> : <input id="item_link" class="feed_text" type="text" id="rss_link" value=""><br>

<span class="feed_title">Item Image</span> : <input id="item_image" class="feed_text" type="text" id="rss_image" value=""><br>

<span class="feed_title">Item Content</span> : <input id="item_content" class="feed_text" type="text" id="rss_content" value=''><br>

<button id="button_step3" type="button">submit</button><br>

<textarea id="rss_sample"></textarea><br>

step4: save<br>

<button id="button_step4" type="button">submit</button><br>

</body>
</html>



