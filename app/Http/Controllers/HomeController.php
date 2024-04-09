<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Category;

use Illuminate\Http\Request;

class HomeController extends Controller
{    
    public function index()
    {
        // Retrieve only public recipes with associated users and categories
        $recipes = Recipe::with(['user', 'categories'])
                    ->where('visibility', 'public')
                    ->whereHas('user')
                    ->get();
        
        // Retrieve all categories
        $categories = Category::all();

        // Pass the recipes data and categories to the view
        return view('welcome', ['recipes' => $recipes, 'categories' => $categories]);
    }
}
