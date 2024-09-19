<?php

namespace App\actions;

class DeleteFromPublicAction
{
    public static function delete($folder,$name)
    {
        $path_file=public_path($folder.'/'.$name);
        if(file_exists($path_file)){
            unlink($path_file);
        }
    }
}
