<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image as ImageInt;
use Illuminate\Support\Facades\Storage;


class ImageUploadController extends Controller
{

    public function formSubmit(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        $image = $request->file('file');
        $imageName = time() . '.' . $image->extension();
        $destinationPath = storage_path('app/public/images/');
        $image->move($destinationPath, $imageName);
 
    	return response()->json(['success'=>'You have successfully upload file.']);
    }
   
}
