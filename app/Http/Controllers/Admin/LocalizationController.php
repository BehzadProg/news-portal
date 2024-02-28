<?php

namespace App\Http\Controllers\Admin;

use App\Models\Language;
use Illuminate\Http\Request;
use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class LocalizationController extends Controller
{
    public function adminIndex() : View
    {
        $languages = Language::where('status' , 1)->get();
        return view('admin.localization.admin-index' , compact('languages'));
    }

    public function frontendIndex() : View
    {
        $languages = Language::where('status' , 1)->get();
        return view('admin.localization.frontend-index' , compact('languages'));
    }

    public function extractLocalizationStrings(Request $request)
    {
        $directory = $request->directory;
        $languageCode = $request->language_code;
        $fileName = $request->file_name;

        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory));

        $localizationStrings = [];

        foreach($files as $file){
            if($file->isDir()){
                continue;
            }

            $contents = file_get_contents($file->getPathname());

            preg_match_all('/__\([\'"](.+?)[\'"]\)/' , $contents, $matches);

            if(!empty($matches[1])){
                foreach ($matches[1] as $match) {

                    $localizationStrings[$match] = $match;
                }
            }
        }

        $phpArray = "<?php\n\nreturn " . var_export($localizationStrings , true) . ";\n";
        //create language folder if it is not exist
        if(!File::isDirectory(lang_path($languageCode))){
            File::makeDirectory(lang_path($languageCode) , 0755 , true);
        }

        file_put_contents(lang_path($languageCode.'/'.$fileName.'.php') , $phpArray);

        toast(__('String Generated Successfully') , 'success');
        return redirect()->back();
    }

    public function updateLangString(Request $request){

        $languageStrings = trans($request->file_name , [] , $request->lang);

        $languageStrings[$request->key] = $request->value;

        $phpArray = "<?php\n\nreturn " . var_export($languageStrings , true) . ";\n";

        file_put_contents(lang_path($request->lang.'/'.$request->file_name.'.php') , $phpArray);

        toast(__('Updated Successfully') , 'success');
        return redirect()->back();

    }


}
