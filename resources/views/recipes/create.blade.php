@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-4">Create a New Recipe</h1>
    <form action="{{ route('recipes.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-control">
            <label class="label" for="title">Title</label>
            <input type="text" class="input input-bordered" id="title" name="title" required>
        </div>
        <div class="form-control">
            <label class="label" for="description">Description</label>
            <textarea class="textarea textarea-bordered" id="description" name="description" rows="4" required></textarea>
        </div>
        <div class="form-control">
            <label class="label" for="image">Image</label>
            <input type="file"  class="file-input file-input-bordered file-input-xs w-full max-w-xs" id="image" name="image" accept="image/*">
        </div>
        <div class="form-control">
            <label class="label" for="category">Category</label>
            <select class="select select-bordered w-full" id="category" name="category_id" required>
                <option value="">Select a category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-control">
            <label class="label" for="visibility">Visibility:</label>
            <select class="select select-bordered w-full" name="visibility" id="visibility">
                <option value="public">Public</option>
                <option value="private">Private</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary mt-4">Create Recipe</button>
    </form>
</div>
@endsection
