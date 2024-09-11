<?php

namespace App\Http\Repository;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\View\View;

class ProjectRepository {

    static function featured(): array|\Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
    {
        return Project::where("featured", true)
            ->limit(6)
            ->get()
        ;
    }

}
