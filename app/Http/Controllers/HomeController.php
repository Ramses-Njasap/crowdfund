<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CrowdFund;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function show()
    {
        $categories = Category::all();
        $crowdfunds = CrowdFund::all();
        return view('home', compact('categories', 'crowdfunds'));
    }
}
