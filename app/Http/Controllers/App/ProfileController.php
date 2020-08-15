<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        $customer = \Auth::guard('customer')->user();
        return view('app::pages.profile.profile_show', compact('customer'));
    }
}
