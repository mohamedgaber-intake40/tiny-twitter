<?php

use App\Http\Controllers\UploadController;
use Illuminate\Support\Facades\Route;

Route::get('/uploads/{path}', [ UploadController::class, 'show' ])->name('uploads.show')->where('path', '.*');
