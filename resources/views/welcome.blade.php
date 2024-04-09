@extends('layouts.app')

@section('content')

<div class="hero-section text-center py-32 bg-red-200">
    <div class="container">
        <h1 class="pb-2">Welcome to Our Recipe Platform</h1>
        <p class="pb-5">Create an account to share your own recipes with the community</p>
        <a href="{{ route('register') }}" class="btn btn-primary">Create an Account</a>
    </div>
</div>

<div class="w-4/5 mx-auto mt-5">
    <h1 class="pb-4">Featured Recipes</h1>
    <form action="{{ route('recipes.index') }}" method="GET" class="relative mb-4" id="filter-form">
        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 13.707a1 1 0 0 1-1.414-1.414l3-3a1 1 0 0 1 1.414 1.414l-3 3z"/></svg>
        </div>
    </form>
    
    <div class="flex flex-wrap flex-col md:flex-row justify-between gap-2" id="recipes-container">
        @foreach ($recipes as $recipe)
        <div class="card card-compact bg-base-100 shadow-xl w-1/4 mb-4">
            <figure><img src="{{ $recipe->image }}" alt="{{ $recipe->title }}" class="w-96 h-auto"/></figure>
            <div class="card-body">
                <h2 class="card-title">{{$recipe->title}}</h2>
                <p>Created by: {{$recipe->user->name}}</p>
                <p>Categories:
                    @foreach($recipe->categories as $category)
                        {{ $category->name }}
                        @if (!$loop->last)
                            ,
                        @endif
                    @endforeach
                </p>
                <div class="card-actions justify-end">
                    <a href="{{ route('recipes.show', $recipe->id) }}" class="btn btn-primary">View Recipe</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
