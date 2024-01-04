<?php

use App\Models\Language;

// formation tags with , for showing in edit news page
function formatTags($tags){
    return implode(',' , $tags);
}

// text limitaion
function limitText($text , $limit = 20){
    return \Str::limit($text, $limit);
}

// set language session
function setLanguage($code) : void
{
    session()->put('language' , $code);
}


// get selected language from session
function getLanguage() : string
{
    if(session()->has('language')){
        return session()->get('language');
    }else{
      try {
        $language = Language::where('default' , 1)->first();
        setLanguage($language->lang);
        return $language->lang;
      } catch (\Throwable $th) {
        setLanguage('en');
        return session()->get('language');
      }
    }
}
