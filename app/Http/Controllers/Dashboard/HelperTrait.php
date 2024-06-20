<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


trait HelperTrait
{



    public function addImage(Request $request, array & $data, $imageFieldName, $storagePath = 'public')
    {
        if ($request->hasFile($imageFieldName)) {
            $imagePath = $request->file($imageFieldName)->store($storagePath);
            $data[$imageFieldName] = $imagePath;
        }

    }


    public function updateImg(Request $request, array &$data, $imageFieldName, $storagePath = 'public', $admin)
    {
        if ($request->hasFile($imageFieldName)) {
            Storage::delete($admin->$imageFieldName); // Delete previous image
            $data[$imageFieldName] = $request->file($imageFieldName)->store($storagePath);
        } else {
            $data[$imageFieldName] = $admin->$imageFieldName;
        }
    }



}


