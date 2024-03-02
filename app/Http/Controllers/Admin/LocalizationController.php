<?php

namespace App\Http\Controllers\Admin;

use App\Models\Language;
use Illuminate\Http\Request;
use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;

class LocalizationController extends Controller
{
    public function adminIndex(): View
    {
        $languages = Language::where('status', 1)->get();
        return view('admin.localization.admin-index', compact('languages'));
    }

    public function frontendIndex(): View
    {
        $languages = Language::where('status', 1)->get();
        return view('admin.localization.frontend-index', compact('languages'));
    }

    public function extractLocalizationStrings(Request $request)
    {
        $directories = explode(',' , $request->directory);
        $languageCode = $request->language_code;
        $fileName = $request->file_name;
        $localizationStrings = [];

        foreach ($directories as $directory) {
            $directory = trim($directory);

            $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory));
            foreach ($files as $file) {
                if ($file->isDir()) {
                    continue;
                }

                $contents = file_get_contents($file->getPathname());

                preg_match_all('/__\([\'"](.+?)[\'"]\)/', $contents, $matches);

                if (!empty($matches[1])) {
                    foreach ($matches[1] as $match) {

                        $localizationStrings[$match] = $match;
                    }
                }
            }
        }


        $phpArray = "<?php\n\nreturn " . var_export($localizationStrings, true) . ";\n";
        //create language folder if it is not exist
        if (!File::isDirectory(lang_path($languageCode))) {
            File::makeDirectory(lang_path($languageCode), 0755, true);
        }

        file_put_contents(lang_path($languageCode . '/' . $fileName . '.php'), $phpArray);

        toast(__('Strings Generated Successfully'), 'success');
        return redirect()->back();
    }

    public function updateLangString(Request $request)
    {

        $languageStrings = trans($request->file_name, [], $request->lang);

        $languageStrings[$request->key] = $request->value;

        $phpArray = "<?php\n\nreturn " . var_export($languageStrings, true) . ";\n";

        file_put_contents(lang_path($request->lang . '/' . $request->file_name . '.php'), $phpArray);

        toast(__('Updated Successfully'), 'success');
        return redirect()->back();
    }

    public function translateString(Request $request)
    {

        try {
            $languageCode = $request->language_code;
            $languageStrings = trans($request->file_name, [], $languageCode);

            $keyStrings = array_keys($languageStrings);

            $text = implode('|' , $keyStrings);

            $response = Http::withHeaders([
                'X-RapidAPI-Host' => 'microsoft-translator-text.p.rapidapi.com',
                'X-RapidAPI-Key' => '5c076bc59emsh84222108eb04faep14e837jsn86b5b7372f4f',
                'content-type' => 'application/json',
            ])->post("https://microsoft-translator-text.p.rapidapi.com/translate?api-version=3.0&to%5B0%5D=$languageCode&textType=plain&profanityAction=NoAction" , [
                [
                    "Text" => $text
                ]
            ]);

            $translatedText = json_decode($response->body())[0]->translations[0]->text;

            $translatedValues = explode('|' , $translatedText);


            // function custom_array_combine($keys, $values) {
            //     $combinedArray = array();
            //     $countKeys = count($keys);
            //     $countValues = count($values);
            //     $maxLength = max($countKeys, $countValues);

            //     for ($i = 0; $i < $maxLength; $i++) {
            //         $key = isset($keys[$i]) ? $keys[$i] : null;
            //         $value = isset($values[$i]) ? $values[$i] : $key; // Use key as value if value is null
            //         $combinedArray[$key] = $value;
            //     }

            //     return $combinedArray;
            // }


            $updatedArray = array_combine($keyStrings , $translatedValues);

            $phpArray = "<?php\n\nreturn " . var_export($updatedArray, true) . ";\n";

            file_put_contents(lang_path($languageCode . '/' . $request->file_name . '.php'), $phpArray);

            return response(['status' => 'success']);
        } catch (\Throwable $th) {
            return response(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }
}
