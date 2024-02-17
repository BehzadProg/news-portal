<?php

use App\Models\Setting;
use App\Models\Language;

// formation tags with , for showing in edit news page
function formatTags($tags){
    return implode(',' , $tags);
}

// text limitaion
function limitText(string $text , int $limit = 50) : string
{
    return \Str::limit($text, $limit);
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

// set language session
function setLanguage($code) : void
{
    session()->put('language' , $code);
}

// convert views number into k or m format
function converToKFormat(int $number)
{
    if($number < 1000){
        return $number;
    }elseif($number < 1000000){
        return round($number / 1000 , 1) . 'K';
    }else{
        return round($number / 1000000 , 1) . 'M';
    }
}

// make sidebar active
function setSidebarActive(array $routes)
{
    foreach($routes as $route){
        if(request()->routeIs($route)){
            return 'active';
        }
    }
}

//access setting data in all files
function getSetting($key){
    $data = Setting::where('key' , $key)->first();
    return $data->value;
}
