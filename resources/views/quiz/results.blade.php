@extends('layouts.app')
@section('content')
<h2>Resultados de tu intento</h2>

@foreach ($userAnswers as $userAnswer)
    <div style="margin-bottom: 1rem;">
        <strong>Pregunta:</strong> {{ $userAnswer->question->question_text }}<br>
        <strong>Tu respuesta:</strong> {{ $userAnswer->answer->answer_text }} 
        @if($userAnswer->answer->is_correct)
            <span style="color: green; font-weight: bold;">(Correcta)</span>
        @else
            <span style="color: red; font-weight: bold;">(Incorrecta)</span>
            <br>
            <strong>Respuesta correcta:</strong> 
            @php
                $correctAnswer = $userAnswer->question->answers->firstWhere('is_correct', true);
            @endphp
            {{ $correctAnswer ? $correctAnswer->answer_text : 'No disponible' }}
        @endif
    </div>
@endforeach
@endsection