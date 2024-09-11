<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnalyticsController extends DashboardController
{
    public function analytics() {
        return $this->view('pages.analytics');
    }
}
