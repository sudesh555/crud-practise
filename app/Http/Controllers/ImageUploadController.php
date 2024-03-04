<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageUploadController extends Controller
{
    public function imageUpload(Request $request)
    {
        if ($request->has('image')) {
            $img = $request->image;
            $ext = $img->getClientOriginExtension();
            $imageName = time().'.'.$ext;
            $img->move(public_path().'/uploads/', $imageName);
        }
    }
}
