<?php
function getTinyUrl($url) {
    $tinyurl = file_get_contents("http://tinyurl.com/api-create.php?url=".$url);
    return $tinyurl;
}
?>
<div class="social-single">
<a href="http://www.addthis.com/bookmark.php"
        style="text-decoration:none;"
        class="addthis_button">Bookmark or Share</a>
</div>