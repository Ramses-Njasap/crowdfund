<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CrowdFund;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show()
    {
        $categories = Category::all();
        return view('home', ['categories' => $categories]);
    }
}
