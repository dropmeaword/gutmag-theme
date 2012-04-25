<?php
function getTinyUrl($url) {
    $tinyurl = file_get_contents("http://tinyurl.com/api-create.php?url=".$url);
    return $tinyurl;
}
?>
<div class="social-single">
<a href="http://www.addthis.com/bookmark.php"
        style="text-decoration:none; font-size: 1.1em;"
        class="addthis_button">-} share {-</a>
<!-- <img src="<?php bloginfo('template_url'); ?>/images/share-skull.png"/> -->
</div>