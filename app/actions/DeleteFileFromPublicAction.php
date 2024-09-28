<?php

namespace App\actions;

class DeleteFileFromPublicAction
{
    /**
     * Delete a file from the public folder.
     *
     * @param string $folder
     * @param string $name
     * @return bool
     */
    public static function delete( $folder, $name)
    {
        // Construct the path to the file
        $path_file = public_path($folder . '/' . $name);

        // Check if the file exists and delete it
        if (file_exists($path_file)) unlink($path_file);
    }
}
