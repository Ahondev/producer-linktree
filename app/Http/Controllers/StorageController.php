<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class StorageController extends Controller
{
    public function image(Request $request) {

        $allowedParams = ['id', 'name', 'folder'];

        if (!$request->has('id') && !$request->has('name')) {
            return response("Unprocessable Entity", 422);
        }

        if ($request->has('folder') && !$request->has('name')) {
            return response("Unprocessable Entity", 422);
        }

        if($request->has('id')) {
            $image = Image::where("id", $request->get("id"))->findOrFail();

        }

    }
}
