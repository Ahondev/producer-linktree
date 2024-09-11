<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Http\Repository\ProjectRepository;
use App\Models\Campaign;
use App\Models\Contact;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AppController extends Controller {

    function __invoke($campaign_name = false): View | RedirectResponse
    {
        if($campaign_name) {
            $campaign = Campaign::where('link', $campaign_name)->with('page.links', 'page.image')->first();
            if(!$campaign) { return redirect()->route('home'); }

            $campaign->views = $campaign->views + 1;
            $campaign->save();
        }

        else { $campaign = Campaign::orderBy('created_at', 'desc')->first(); }

        return view('app.campaign.campaign', [
            'campaign' => $campaign,
            'page' => $campaign->page,
            'appearance' => $campaign->appearance,
            'links' => $campaign->page->links,
        ]);

    }

}
