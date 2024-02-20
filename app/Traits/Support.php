<?php


namespace App\Traits;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;


class Support
{

    public static function storeFile($file, $filename, $folder_name = 'files'){

        if (!file_exists( $folder_name.'/')) {
            // mkdir('files/' . $folder_name.'/', 666, true);
            File::makeDirectory($folder_name, 0777, true, true);
        }
        $destinationPath =  $folder_name.'/';
        $filename = Str::slug($filename) .'.'.$file->getClientOriginalExtension();
        $file->move($destinationPath, $filename);
        return $destinationPath.$filename;
    }
}
