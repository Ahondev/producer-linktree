<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class DashboardController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function view(string $view, array $data = null) {

        $user = auth()->user();

        $context = ['component' => $view];
        if($user) { $context['user'] = str_replace('"', "'", json_encode([
            "name" => $user->name,
            "email" => $user->email
        ])); }
        if($data) { $context['data'] = $data; }

        return view("dashboard.entrypoint", ['context' => (object) $context]);
    }

}
