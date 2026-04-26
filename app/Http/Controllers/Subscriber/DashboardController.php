<?php

namespace App\Http\Controllers\Subscriber;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('subscriber.dashboard');
    }
}
