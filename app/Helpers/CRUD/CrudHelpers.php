<?php

namespace App\Helpers\CRUD;

class CrudHelpers {

    public static function get($modelType, int $id) {

        $modelID = $id;
        $modelName = $modelType;
        $entity = $modelType::where("id", $modelID)->take(1)->get();

        if($entity->isEmpty()) {
            return response()->json(
                [
                    "status" => "error",
                    "error" => "No ".$modelName  ." with ID " . $modelID
                ]
                , 402
            );
        }

        return response($entity, 200);
    }

    public static function delete($modelType, int $id) {

        $modelID = $id;
        $modelName = $modelType;
        $entity = $modelType::where("id", $modelID)->take(1)->get();

        if($entity->isEmpty()) {
            return response()->json(
                [
                    "status" => "error",
                    "error" => "No ".$modelName  ." with ID " . $modelID
                ]
                , 402
            );
        }

        $entity->get(0)->delete();

        return response()->json(
            [
                "status" => "success",
            ]
        );

    }

}
