<?php
function make_links_clickable($text) {
    $pattern = '/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/';
    return preg_replace($pattern, '<a href="$0" target="_blank">$0</a>', $text);
}
