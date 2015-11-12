<?php
require("functions.php");

$uri = file_get_contents("php://input");
if(isHtml($uri)) echo getSite($uri);

