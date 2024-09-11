<?php

namespace App\Http\Controllers\Campaign;

use App\Helpers\CRUD\CrudHelpers;
use App\Http\Requests\Campaign\CampaignCreateRequest;
use App\Models\Campaign;
use App\Models\Link;

class CampaignController extends \App\Http\Controllers\DashboardController
{

    public function index() { return $this->view("entity.campaign.index"); }

    public function single(string $slug) {
        $campaign = Campaign::where('link', $slug)->firstOrFail();
        $links = Link::where('page_id', $campaign->id)->get();
        return $this->view(
            "entity.campaign.single",
            [
                'campaign' => [...$campaign->toArray(),
                    'page' => [...$campaign->page->toArray(),
                        'image_url' => $campaign->page->image->source,
                        'links' => $links
                    ],
                    'appearance' => $campaign->appearance->toArray(),
                ],
            ]
        );
    }

    public function all() { return response(Campaign::orderBy('created_at', 'desc')->get(), 200); }

    public function get(int $id) { return CrudHelpers::get(Campaign::class, $id); }

    public function delete(int $id) { return CrudHelpers::delete(Campaign::class, $id); }

    public function create(CampaignCreateRequest $request) {

        $validated = $request->validated();

        $campaign = new Campaign([
            'name' => $validated['name'],
            'link' => $validated['link'],
        ]);

        $campaign->save();

        return response()->json([ "status" => "success" ]);

    }

//    public function action(int $id)
//    {
//
//        $success = ActionEngine::handle(Project::class, $id);
//
//        if($success) { return response()->json(["status" => "success"]); }
//        else { return response()->json(["status" => "error", "error" => "An error occured"], 500); }
//
//    }

}
