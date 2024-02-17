<?php

namespace App\Traits;

use Carbon\Carbon;

trait FileUploadTrait
{
    function generateFileName($name , $privateName)
    {
        $year = Carbon::now()->year;
        $month = Carbon::now()->month;
        $day = Carbon::now()->day;
        $hour = Carbon::now()->hour;
        $minute = Carbon::now()->minute;
        $second = Carbon::now()->second;
        $microsecond = Carbon::now()->microsecond;

        return $year . '_' . $month . '_' . $day . '_' . $hour . '_' . $minute . '_' . $second . '_' . $microsecond . '_' . $privateName .'.' . $name;
    }

    function handleUpload($inputName, $model = null, $pathFile = null , $privateName = null)
    {
        try {
            if (request()->hasFile($inputName)) {

                if ($model && $model->exists(public_path($model->{$inputName}))) {
                    \File::delete(public_path($pathFile) . $model->{$inputName});
                }

                $file = request()->file($inputName);

                $fileName = $this->generateFileName($file->getClientOriginalExtension() , $privateName);

                $file->move(public_path($pathFile), $fileName);

                return $fileName;
            }
        } catch (\Exception $e) {
            throw $e;
        }
    }

    function handleUploadSettingLogo($inputName, $value = null, $pathFile = null , $privateName = null)
    {
        try {
            if (request()->hasFile($inputName)) {

                if ($value) {
                    \File::delete(public_path($pathFile) . $value);
                }

                $file = request()->file($inputName);

                $fileName = $this->generateFileName($file->getClientOriginalExtension() , $privateName);

                $file->move(public_path($pathFile), $fileName);

                return $fileName;
            }
        } catch (\Exception $e) {
            throw $e;
        }
    }

    function deleteFileIfExist($filePath)
{
    try{

        if(\File::exists(public_path($filePath))){
            \File::delete(public_path($filePath));
        }
    }catch(\Exception $e){
        throw $e;
    }
}

}
