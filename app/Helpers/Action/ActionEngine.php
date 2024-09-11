<?php

namespace App\Helpers\Action;

use App\Http\Actions\ActionRegistry;
use App\Models\Project;

class ActionEngine {

    public static function handle($modelType, $id)
    {

        if(!request()->has("action")) {
            return response()->json(["status" => "error", "error" => "Missing 'action' parameter"], 402);
        }

        $action = request()->get("action");
        $actionRegistry = new ActionRegistry($modelType);

        if(!$actionRegistry->exist($action)) {
            return response()->json(
                [
                    "status" => "error",
                    "error" => "Unknown action ${action} for model ${modelType}"
                ]
                , 402
            );
        }

        $modelID = $id;
        $entity = $modelType::where("id", $modelID)->take(1)->get();

        if($entity->isEmpty()) {
            return response()->json(
                [
                    "status" => "error",
                    "error" => "No ". $modelType  ." with ID " . $modelID
                ]
                , 402
            );
        }

        $actionHandler = $actionRegistry->action($action);

        $data = request()->has("data") ? request()->get("data") : [];

        return self::execute($actionHandler, $entity->get(0), $data);

    }

    public static function execute($handler, $entity, $data)
    {
        return $handler::execute($entity, $data);
    }

}
