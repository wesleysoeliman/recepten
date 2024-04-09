@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold mb-4">Recepten details van {{ auth()->user()->name }}</h1>
    <div class="bg-white shadow-md p-8 rounded-lg">
        <h2 class="text-xl font-semibold mb-4">{{ $recipe->title }}</h2>    
        <img src="{{ $recipe->image }}" alt="{{ $recipe->title }}" class="w-full max-h-180 object-cover mb-4 rounded-lg">
        <p class="text-gray-700">{{ $recipe->description }}</p>
    </div>
</div>
@endsection
