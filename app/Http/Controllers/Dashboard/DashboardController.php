<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class DashboardController extends \App\Http\Controllers\DashboardController
{

    function __invoke(): View { return $this->view("pages.analytics"); }

}
