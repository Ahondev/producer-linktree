<?php

namespace App\Http\Controllers\Contact;

use App\Helpers\CRUD\CrudHelpers;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardController;
use App\Http\Requests\Contact\CampaignCreateRequest;
use App\Models\Contact;

class ContactController extends DashboardController
{
    public function index() { return $this->view("entity.contact.index"); }

    public function all() { return response(Contact::all(), 200); }

    public function get(int $id) { return CrudHelpers::get(Contact::class, $id); }

    public function delete(int $id) { return CrudHelpers::delete(Contact::class, $id); }

    public function create(CampaignCreateRequest $request) {

        $validated = $request->validated();

        $contact = new Contact([
            "name" => $validated["name"],
            "email" => $validated["email"],
            "company" => $validated["company"],
            "subject" => $validated["subject"],
            "message" => $validated["message"],
            "ip_address" => request()->ip(),
        ]);


        $success = $contact->save();

        if($success) { return response()->json([ "status" => "success" ]); }
        else { return response()->json([ "status" => "error" ], 403); }

    }

    public function subjects() {
        return response()->json([Contact::$subjects, 200]);
    }
}
