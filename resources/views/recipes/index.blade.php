@extends('layouts.app')

@section('content')

<div class="container">
    <h1 class="text-2xl font-bold mb-4 ml-6">Welkom {{ auth()->user()->name }}, maak hier je recepten aan</h1>
    <a href="{{ route('recipes.create') }}" class="btn btn-active btn-secondary ml-6 mb-4">Create Recipe</a>
  

    <div class="overflow-x-auto">
        <table class="table">
            <thead>
                <tr>
                    <th>Afbeelding</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Created by</th>
                    <th>Categories</th>
                    <th>Visibility</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recipes as $recipe)
                <tr>
                    <td><img src="{{ $recipe->image }}" alt="Recipe Image" style="width: 120px; height: 120px; object-fit: cover;"></td>
                    <td>{{ $recipe->title }}</td>
                    <td>{{ $recipe->description }}</td>
                    <td>
                        @if ($recipe->user) 
                        {{ $recipe->user->name }}
                        @else
                        Unknown User
                        @endif
                    </td>
                    <td>
                        @foreach($recipe->categories as $category)
                        <span class="badge badge-primary">{{ $category->name }}</span>
                        @endforeach
                    </td>
                    <td>
                        <span class="badge badge-{{ $recipe->visibility === 'public' ? 'secondary' : 'ghost' }}">
                            {{ ucfirst($recipe->visibility) }}
                        </span>
                    </td>                    
                    <td>
                        <form action="{{ route('recipes.destroy', $recipe->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                        <a href="{{ route('recipes.edit', $recipe->id) }}" class="btn btn-primary btn-sm">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
