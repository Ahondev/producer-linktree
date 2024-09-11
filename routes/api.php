<?php

use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\Appearance\AppearanceController;
use App\Http\Controllers\Campaign\CampaignController;
use App\Http\Controllers\Contact\ContactController;
use App\Http\Controllers\Page\PageController;
use App\Http\Controllers\Review\ReviewController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// api.website.com/campaign

Route::prefix("campaign")->group(function () {

    Route::get("/all", [CampaignController::class, "all"]);
    Route::post("/", [CampaignController::class, "create"]);
    Route::get("/{slug}", [CampaignController::class, "get"]);
    Route::delete("/{slug}", [CampaignController::class, "delete"]);
//    Route::post("/{slug}", [CampaignController::class, "action"]);

});

// api.website.com/page
// slug is associated campaign slug

Route::prefix("page")->group(function () {

//    Route::get("/all", [PageController::class, "all"]);
//    Route::post("/", [PageController::class, "create"]);
//    Route::get("/{slug}", [PageController::class, "get"]);
    Route::put("/{slug}", [PageController::class, "put"]);
//    Route::delete("/{slug}", [PageController::class, "delete"]);
//    Route::post("/{slug}", [PageController::class, "action"]);

});

// api.website.com/appearance
// slug is associated campaign slug

Route::prefix("appearance")->group(function () {

//    Route::get("/all", [PageController::class, "all"]);
//    Route::post("/", [PageController::class, "create"]);
//    Route::get("/{slug}", [PageController::class, "get"]);
    Route::put("/{slug}", [AppearanceController::class, "put"]);
//    Route::delete("/{slug}", [PageController::class, "delete"]);
//    Route::post("/{slug}", [PageController::class, "action"]);

});

