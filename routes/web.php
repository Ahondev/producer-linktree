<?php

use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\App\AppController;
use App\Http\Controllers\Authentication\AuthenticationController;
use App\Http\Controllers\Campaign\CampaignController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\StorageController;
use App\Http\Middleware\IsAdministrator;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

# === INDEX ROUTE
Route::get("/", AppController::class)->name("home");
# ===

# DASHBOARD ROUTES
Route::middleware(IsAdministrator::class)
    ->prefix("dashboard")->group(function () {
        Route::get("/", DashboardController::class);
        Route::get("/campaigns", [CampaignController::class, "index"]);
        Route::get("/campaigns/{slug}", [CampaignController::class, "single"]);
        Route::get("/analytics", [AnalyticsController::class, "analytics"]);
    });
# ===

# AUTHENTICATION ROUTES
Route::match(["GET", "POST"], "/login", [AuthenticationController::class, "login"])
    ->middleware(RedirectIfAuthenticated::class);

Route::match(["POST"], "/logout", [AuthenticationController::class, "logout"]);
# ===

# === STORAGE ROUTES
Route::get("/storage/image", [StorageController::class, "image"]);
# ===

# === DYNAMIC LINK ROUTES
Route::get("/{campaign_name}", AppController::class);
# ===
