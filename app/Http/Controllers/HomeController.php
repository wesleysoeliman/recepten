<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class HomeController extends Controller
{    
    public function index()
    {
        // Retrieve recipes with associated users
        $recipes = Recipe::with('user')->whereHas('user')->get();
        
        // Pass the recipes data to the view
        return view('welcome', ['recipes' => $recipes]);
    }
    
}
