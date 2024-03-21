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
        // Validate the request
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Add validation for image file
            'category_id' => 'required|exists:categories,id', // Make sure the category ID exists in the categories table
        ]);
    
        // Handle file upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public'); // Store the uploaded file in the storage/app/public/images directory
            $imageUrl = asset('storage/' . $imagePath); // Get the URL of the uploaded image
        } else {
            $imageUrl = null; // If no image is uploaded, set the URL to null
        }
    
        // Create the recipe
        $recipe = new Recipe();
        $recipe->title = $request->input('title');
        $recipe->description = $request->input('description');
        $recipe->image = $imageUrl; // Save the image URL to the recipe
        $recipe->user_id = auth()->user()->id;
        $recipe->save();
    
        // Attach categories to the recipe
        $categories = $request->input('category_id');
        $recipe->categories()->attach($categories);
    
        // Redirect to a success page or back to the form with a success message
        return redirect()->route('recipes.index')->with('success', 'Recipe created successfully.');
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
        // Find the recipe by its ID
        $recipe = Recipe::findOrFail($id);
        
        // Check if the authenticated user owns this recipe
        if ($recipe->user_id !== auth()->id()) {
            return redirect()->route('recipes.index')->with('error', 'You do not have permission to edit this recipe.');
        }
        
        // Retrieve all categories for populating the dropdown
        $categories = Category::all();
        
        // Pass the recipe, categories, and existing values to the view
        return view('recipes.edit', [
            'recipe' => $recipe,
            'categories' => $categories,
            'title' => $recipe->title,
            'description' => $recipe->description,
            'image' => $recipe->image,
        ]);
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the request
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Allow null or valid image file
            'category_id' => 'required|exists:categories,id',
        ]);
    
        // Find the recipe
        $recipe = Recipe::findOrFail($id);
    
        // Check if the authenticated user owns this recipe
        if ($recipe->user_id !== auth()->id()) {
            return redirect()->route('recipes.index')->with('error', 'You do not have permission to edit this recipe.');
        }
    
        // Update title and description
        $recipe->title = $request->input('title');
        $recipe->description = $request->input('description');
    
        // Handle image update
        if ($request->hasFile('image')) {
            // Delete the previous image file
            Storage::disk('public')->delete($recipe->image);
    
            // Upload and store the new image
            $imagePath = $request->file('image')->store('images', 'public');
            $imageUrl = asset('storage/' . $imagePath);
            $recipe->image = $imageUrl;
        }
    
        // Update the recipe
        $recipe->save();
    
        // Attach categories to the recipe
        $categories = $request->input('category_id');
        $recipe->categories()->sync($categories);
    
        // Redirect with success message
        return redirect()->route('recipes.index')->with('success', 'Recipe updated successfully.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
 
public function destroy($id)
{
    // Find the recipe by ID
    $recipe = Recipe::findOrFail($id);
    
    // Check if the authenticated user owns this recipe
    if ($recipe->user_id !== auth()->id()) {
        return redirect()->route('recipes.index')->with('error', 'You do not have permission to delete this recipe.');
    }
    
    // Delete the recipe
    $recipe->delete();
    
    return redirect()->route('recipes.index')->with('success', 'Recipe deleted successfully.');
}
}
