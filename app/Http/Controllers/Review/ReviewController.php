<?php

namespace App\Http\Controllers\Review;

use App\Helpers\Action\ActionEngine;
use App\Helpers\CRUD\CrudHelpers;
use App\Http\Requests\Project\ContactCreateRequest;
use App\Models\Project;
use App\Models\Review;

class ReviewController extends \App\Http\Controllers\DashboardController
{

    public function index() { return $this->view("entity.review.index"); }

    public function all() { return response(Review::all(), 200); }

    public function get(int $id) { return CrudHelpers::get(Review::class, $id); }

    public function delete(int $id) { return CrudHelpers::delete(Review::class, $id); }

    public function create(ContactCreateRequest $request) {

        $validated = $request->validated();

        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();

        $image->storeAs('public/uploads/review', $imageName);

        $project = new Project([
            "name" => $validated["name"],
            "tag" => $validated["description"],
            "content" => $validated["description"],
            "image_name" => $validated["image"] ?? "default.png",
            "image_url" => "/uploads/review/" . ($validated["image"] ?? "default.png"),
        ]);

        $project->save();

        return response()->json([ "status" => "success" ]);

    }

}
