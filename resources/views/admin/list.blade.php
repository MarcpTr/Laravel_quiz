@extends('layouts.app')
@section('content')
@foreach ($quizzes as $quiz)
<a href="{{ route('quizzes.quiz', $quiz->id) }}">
    <h2>{{ $quiz->title }}</h2>
    <p>{{$quiz->description}}</p>
    <img src="{{ asset('storage/' . $quiz->imageRef) }}" alt="Imagen del quiz">
    <form action="{{ route('admin.delete', $quiz->id) }}" method="post">  
        @csrf
        @method("DELETE")
        <button type="submit">Eliminar</button>
    </form>
</a>
    @endforeach
@endsection