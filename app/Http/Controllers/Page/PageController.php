<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use App\Http\Requests\Page\PageUpdateRequest;
use App\Models\Campaign;
use App\Models\Image;
use App\Models\Link;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends \App\Http\Controllers\DashboardController
{
//    public function create(PageUpdateRequest $request) {
//        $valid = $request->validated();
//        $image = Image::createFromRequest($request->file('image'));
//
//        $page = new Page([
//            "title" => $valid['title'],
//            "text" => $valid['text'],
//            "image_id" => $image->id,
//        ]);
//
//        return $page->save() ? response("Success", 200) : response("Failed", 400);
//    }

    public function put(PageUpdateRequest $request, string $slug) {
        $valid = $request->validated();

        $campaign = Campaign::where('link', $slug)->firstOrFail();
        $page = $campaign->page;

        if($request->hasFile('image')) { $image_id = Image::createFromRequest($request->file('image'))->id; }
        else { $image_id = $page->image_id; }

        if($request->has('links')) {
            Link::where('page_id', $page->id)->delete();

            $links = collect($request->get('links'))->map(function ($link) use ($page) {
                return [
                    'platform' => $link['platform'],
                    'url' => $link['url'],
                    'page_id' => $page->id,
                    'created_at' => now(), 'updated_at' => now()
                ];
            })->toArray();

            Link::insert($links);
        }

        $page->title = $valid['title'];
        $page->text = $valid['text'];
        $page->image_id = $image_id;

        return $page->save() ? response("Success", 200) : response("Failed", 500);
    }
}
