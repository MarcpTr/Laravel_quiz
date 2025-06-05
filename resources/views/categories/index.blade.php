@extends('layouts.app')
@section('title')
    Categorias
@endsection
@section('content')
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 p-4">

    @foreach ($categories as $category)
        <x-categorycard :id="$category->id" :name="$category->name" :image="$category->imageRef"  />
    @endforeach
</div>

@endsection
