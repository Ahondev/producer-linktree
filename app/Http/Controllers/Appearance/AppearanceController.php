<?php

namespace App\Http\Controllers\Appearance;

use App\Http\Controllers\Controller;
use App\Http\Requests\Appearance\AppearanceUpdateRequest;
use App\Http\Requests\Page\PageUpdateRequest;
use App\Models\Campaign;
use App\Models\Image;
use App\Models\Link;
use Illuminate\Http\Request;

class AppearanceController extends Controller
{

    public function put(AppearanceUpdateRequest $request, string $slug) {
        $valid = $request->validated();

        $campaign = Campaign::where('link', $slug)->firstOrFail();
        $appearance = $campaign->appearance;
        $backgroundType = $request->get('background_type');

        if($backgroundType === 'color-simple' || $backgroundType === 'color-gradient') {
            $appearance->value = $request->get('value');
        }

        if($backgroundType === 'media-image') {
            if($request->hasFile('image')) { $image_id = Image::createFromRequest($request->file('image'))->id; }
            else { $image_id = Image::getPlaceholder(); }
            $appearance->value = $image_id;
        }

        $appearance->background_type = $backgroundType;
        $appearance->theme = $request->get('theme');

        return $appearance->save() ? response("Success", 200) : response("Failed", 500);
    }

}
