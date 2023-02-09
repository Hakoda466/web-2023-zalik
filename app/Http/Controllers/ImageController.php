<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreImageRequest;
use App\Models\Image;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function store(StoreImageRequest $request)
    {
        $file = $request->validated()['file'];        
        $file_name = $file->getClientOriginalName();

        Storage::disk('local')->put($file_name, $file);

        return response()->json([
            'data' => Image::create([
                'filename' => $file_name
            ]),
        ], Response::HTTP_CREATED);
    }
}
