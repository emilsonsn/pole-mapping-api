<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function show(string $path)
    {
        abort_unless(Storage::disk('public')->exists($path), 404);
        return Storage::disk('public')->response($path);
    }
}
