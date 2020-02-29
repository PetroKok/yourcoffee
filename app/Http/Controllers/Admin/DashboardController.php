<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Ingredients;
use App\Models\Locale;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $ing = Ingredients::create([
            'ru' => [
                'name' => 'test',
                'description' => 'test',
            ],
            'uk' => [
                'name' => 'test',
                'description' => 'test',
            ],
            'en' => [
                'name' => 'test',
                'description' => 'test',
            ],
            'price' => 100,
            'image' => '100',
        ]);

        dd($ing);
        return view('admin::index');
    }
}
