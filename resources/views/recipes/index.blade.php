@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ route('recipes.create') }}" class="btn btn-primary">Create Recipe</a>
        <h1>Welkom {{ auth()->user()->name }}, maak hier je recepten aan</h1>

    
        <div class="row">
            @foreach($recipes as $recipe)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <img src="{{ $recipe->image }}" class="card-img-top" alt="Recipe Image">
                            <h5 class="card-title">{{ $recipe->title }}</h5>
                            <p class="card-text">{{ $recipe->description }}</p> 
                            @if ($recipe->user) <!-- Check if user relationship exists -->
                                <p class="card-text">Created by: {{ $recipe->user->name }}</p>
                            @else
                                <p class="card-text">Created by: Unknown User</p> <!-- Display a default message if user is null -->
                            @endif
                            <p class="card-text">Categories:
                                @foreach($recipe->categories as $category)
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
