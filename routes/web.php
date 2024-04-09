<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecipesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('welcome');


Route::get('/recipes', [RecipesController::class, 'index'])->name('recipes.index');
Route::get('/recipes/create', [RecipesController::class, 'create'])->name('recipes.create');
Route::post('/recipes', [RecipesController::class, 'store'])->name('recipes.store');
Route::get('/recipes/{recipe}', [RecipesController::class, 'show'])->name('recipes.show');
Route::get('/recipes/{recipe}/edit', [RecipesController::class, 'edit'])->name('recipes.edit');
Route::put('/recipes/{recipe}', [RecipesController::class, 'update'])->name('recipes.update');
Route::delete('/recipes/{recipe}', [RecipesController::class, 'destroy'])->name('recipes.destroy');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
