<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ShopController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust mime types and max size as needed
        ]);

        $file = $request->file('photo');
        $filename = $file->getClientOriginalName();
        
        $file->storeAs('shops', $filename);

        $resizedImage = Image::make($file)->resize(500, 500);
        $resizedImage->save(storage_path('app/shops/' . 'resized-' . $filename));


        // TASK: resize the uploaded image from /storage/app/shops/$filename
        //   to size of 500x500 and store it as /storage/app/shops/resized-$filename
        // Use intervention/image package, it's already pre-installed for you

        return 'Success';
    }
}
