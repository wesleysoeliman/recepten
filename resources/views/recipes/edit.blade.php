@extends('layouts.app')

@section('content')
<div class="container">

<form action="{{ route('recipes.update', $recipe->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" name="title" value="{{ $recipe->title }}" required>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" id="description" name="description" rows="4" required>{{ $recipe->description }}</textarea>
    </div>
    <div class="form-group">
        <label for="image">Image</label>
        <input type="file" class="form-control-file" id="image" name="image">
        <img src="{{ $recipe->image }}" alt="Current Image" style="max-width: 200px;">
    </div>
    <button type="submit" class="btn btn-primary">Update Recipe</button>
</form>
</div>
@endsection