<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class ImageController extends Controller
{
    public function display()
    {
        // Get all files from the uploads directory
        $files = scandir(WRITEPATH . 'uploads');

        // Filter out the current and parent directory references
        $images = array_diff($files, ['.', '..']);

        return view('modelosEditView', ['images' => $images]);
    }
}
