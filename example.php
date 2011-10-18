<?php

require_once "RandomBanner.php";

$bannertop = new RandomBanner();

/* Parameters: $content,$link="nothing",$type="img",$pos="top"
 * To insert a Flash Banner, it's not necessary to set the link here,
 * as it's set in the Flash file itself.
 * You need to tell the method that the file is a Flash file,
 * setting anything other than "img" in the type parameter.
 * It can be anything. I wrote "flash" down here, so it's a better example.
 * If no position is specified for the Flash Banner, it's understood that it's a top Banner,
 * and it'll be generated with top Banner's width and height.
 * When you insert a Flash Banner in the sidebar, after the "type" parameter,
 * you have to write anything other than "top", so it'll be understood that's not a top Flash Banner,
 * but a sidebar Flash Banner, and it'll be generated with sidebar Banner's width and height.
 * Below, there's an example of how to set Flash and some images as Banners:
*/

$bannertop->setBanner("banners/banner1.swf","","flash");
$bannertop->setBanner("banners/header_ad1.jpg","http://www.example1.com");
$bannertop->setBanner("banners/header_ad2.jpg","http://www.example2.com");
$bannertop->setBanner("banners/header_ad3.jpg","http://www.example3.com");

$bannertop->showBanner();

unset($bannertop);

?>
