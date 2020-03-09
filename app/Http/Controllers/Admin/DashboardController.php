<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Label;

class DashboardController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        return view('admin::index');
    }
}
