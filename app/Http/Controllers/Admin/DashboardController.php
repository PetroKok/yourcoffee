<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        \DB::enableQueryLog();
        Category::create([
            'ru' => [
                'title' => 'test'
            ],
            'uk' => [
                'title' => 'test'
            ],
            'position' => 2
        ]);
        dd(\DB::getQueryLog());
        return view('admin::index');
    }
}
