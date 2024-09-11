<?php

namespace App\Http\Actions;

use App\Http\Actions\Project\SetFeaturedAction;
use App\Models\Project;

class ActionRegistry {

    public static array $actionRegistry = [

        Project::class => [
            "set-featured" => SetFeaturedAction::class
        ]

    ];

    private array $registry;

    public function __construct(string $modelType)
    {
        $this->registry = self::$actionRegistry[$modelType];
    }

    public function exist(string $action) { return array_key_exists($action, $this->registry); }

    public function action(string $action) { return $this->registry[$action]; }

}
