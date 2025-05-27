@extends('layouts.app')
@section('content')
@foreach ($quizzes as $quiz)
<a href="{{ route('quizzes.quiz', $quiz->id) }}">
    <h2>{{ $quiz->title }}</h2>
    <p>{{$quiz->description}}</p>
    <img src="{{ asset('storage/' . $quiz->imageRef) }}" alt="Imagen del quiz">
</a>
    @endforeach
@endsection