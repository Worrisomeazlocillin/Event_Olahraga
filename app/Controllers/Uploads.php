<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Uploads extends Controller
{
    public function serve($filename)
    {
        $path = WRITEPATH . 'uploads/' . $filename;

        if (is_file($path)) {
            return $this->response->download($path, null);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
}
