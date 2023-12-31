<?php

// formation tags with , for showing in edit news page
function formatTags($tags){
    return implode(',' , $tags);
}

// text limitaion
function limitText($text , $limit = 20){
    return \Str::limit($text, $limit);
}
