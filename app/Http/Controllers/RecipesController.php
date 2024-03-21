<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get the currently authenticated user
        $user = auth()->user();
    
        // Fetch only the recipes associated with the authenticated user
        $recipes = $user->recipes()->with('categories')->latest()->get();
        
        // Get all categories
        $categories = Category::all();
    
        // Pass the recipes and categories data to the view
        return view('recipes.index', compact('recipes', 'categories'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all(); // Retrieve all categories
        return view('recipes.create', compact('categories'));
    }


    public function store(Request $request)
    {
      
    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
