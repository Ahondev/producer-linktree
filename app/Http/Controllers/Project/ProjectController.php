<?php

namespace App\Http\Controllers\Project;

use App\Helpers\Action\ActionEngine;
use App\Helpers\CRUD\CrudHelpers;
use App\Http\Requests\Project\ContactCreateRequest;
use App\Models\Project;

class ProjectController extends \App\Http\Controllers\DashboardController
{

    public function index() { return $this->view("entity.project.index"); }

    public function all() { return response(Project::all(), 200); }

    public function get(int $id) { return CrudHelpers::get(Project::class, $id); }

    public function delete(int $id) { return CrudHelpers::delete(Project::class, $id); }

    public function create(ContactCreateRequest $request) {

        $validated = $request->validated();

        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();

        $image->storeAs('public/uploads/project', $imageName);

        $project = new Project([
            "name" => $validated["name"],
            "description" => $validated["description"],
            "image_name" => $validated["image"] ? $imageName : "default.png",
            "image_url" => "uploads/project/" . ($validated["image"] ? $imageName:  "default.png"),
            "link" => $validated["link"],
            "featured" => false,
        ]);

        $project->save();

        return response()->json([ "status" => "success" ]);

    }

    public function action(int $id)
    {

        $success = ActionEngine::handle(Project::class, $id);

        if($success) { return response()->json(["status" => "success"]); }
        else { return response()->json(["status" => "error", "error" => "An error occured"], 500); }

    }

}
