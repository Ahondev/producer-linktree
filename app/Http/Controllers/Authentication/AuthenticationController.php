<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\DashboardController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends DashboardController
{

    function login() {
        if (request()->method() === "GET") { return $this->view("authentication.login"); }
        if (request()->method() === "POST") {

            if(!request()->has("email") || !request()->has("password")) { return response(false, 400); }

            $email = request()->get("email");
            $password = request()->get("password");

            $admin = User::where("name", "Admin")->first();

            if($email !== $admin->email){ return response(false, 403); }
            if(!Hash::check($password, $admin->password)){ return response(false, 403); }

            Auth::login($admin);

            return response(true, 200);

        }
        return redirect("/");
    }

    function logout() {
        $user = auth()->user();
        if($user === null){ return response(false, 500); }
        Auth::logout();
        return response(true, 200);
    }

}
