<?php

namespace App\Http\Actions\Project;

use App\Models\Project;

class SetFeaturedAction {

    public static function execute(Project $project, array $data): bool
    {
        $project->featured = $data['featured'];
        return $project->save();
    }

}
