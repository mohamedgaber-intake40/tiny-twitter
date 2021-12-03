<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UploadController extends Controller
{
    public function show($path)
    {
        try {
            $file = Storage::get($path);
        } catch (FileNotFoundException $exception) {
            return abort(404);
        }
        $mime = Storage::mimeType($path);
        return response($file)->header('Content-Type', $mime);
    }

}
