@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Welcome to Our Recipe Platform</h1>
    <h2>Featured Recipes</h2>
    <div class="row">
        @foreach ($recipes as $recipe)
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="{{ $recipe->image }}" class="card-img-top" alt="Recipe Image" style="width: 100%; height: 200px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">{{ $recipe->title }}</h5>
                    <p class="card-text">{{ $recipe->description }}</p>
                    <p class="card-text">Created by: {{ $recipe->user->name }}</p>
                    <p class="card-text">Categories:
                        @foreach ($recipe->categories as $category)
                            <span class="badge badge-primary">{{ $category->name }}</span>
                        @endforeach
                    </p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
