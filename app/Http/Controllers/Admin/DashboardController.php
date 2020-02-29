<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Locale;
use Illuminate\Http\Request;

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
