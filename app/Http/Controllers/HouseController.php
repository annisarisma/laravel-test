<?php

namespace App\Http\Controllers;

use App\Models\House;
use GuzzleHttp\Psr7\UploadedFile;
use Illuminate\Http\Request;
use Illuminate\Http\Testing\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class HouseController extends Controller
{
    public function store(Request $request)
    {
        $filename = $request->file('photo')->store('houses');

        House::create([
            'name' => $request->name,
            'photo' => $filename,
        ]);

        return 'Success';
    }

    public function update(Request $request, House $house)
    {
        if ($house->photo) {
            Storage::delete($house->photo);
        }
        $filename = $request->file('photo')->store('houses');

        // TASK: Delete the old file from the storage


        $house->update([
            'name' => $request->name,
            'photo' => $filename,
        ]);

        return 'Success';
    }

    public function download(House $house)
    {
        // TASK: Return the $house->photo file from "storage/app/houses" folder
        // for download in browser
        
        $filename = basename($house->photo);

        $filePath = storage_path('app/houses/' . $filename);
        return response()->download($filePath, $filename);

    }
}
