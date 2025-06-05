@extends('layouts.app')
@section('title')
    {{ $quiz->title }}
@endsection
@section('content')
<main class="max-w-6xl mx-auto p-6 bg-gray-50">
    <div class="text-center mb-8">
      <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $quiz->title}}</h1>
      <p class="text-gray-600 max-w-2xl mx-auto">{{ $quiz->description}}</p>
    </div>
    <div class="mb-10">

<img class="w-full h-64 object-cover rounded-lg shadow-md" src="{{ asset('storage/' . $quiz->imageRef) }}" alt="Imagen del quiz">  </div>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form id="quizForm" action="{{ route('quiz.submit', $quiz->id) }}" method="POST" class="space-y-6">
    @csrf
    <input type="hidden" name="quiz_token" value="{{ $token }}">

    @foreach ($questions as $question)
    <div class="bg-white p-5 rounded-lg shadow-md">
        <strong class="block text-gray-800 mb-3">{{ $question->question_text }}</strong>
        <ul class="space-y-2 text-sm text-gray-700">
            @foreach ($question->answers as $answer)
                <li>
                    <label>
                        <input type="radio" 
                               name="answers[{{ $question->id }}]" 
                               value="{{ $answer->id }}" required>
                        {{ $answer->answer_text }}
                    </label>
                </li>
            @endforeach
        </ul>
    </div>
@endforeach

<div class="text-center mt-8">
<button id="submitBtn" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 px-6 rounded-md transition-colors duration-300" type="submit">Enviar respuestas</button>
</div>
</form>

@endsection