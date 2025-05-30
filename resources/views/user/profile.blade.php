@extends('layouts.app')
@section('content')

Profile

@foreach($attempts as $attempt)
    <div>
        <h3>
            Intento en quiz: <strong>{{ $attempt->quiz->title }}</strong> - 
            Fecha: {{ $attempt->created_at->format('d/m/Y H:i') }}
        </h3>
        <ul>
            @foreach($attempt->userAnswers as $answer)
                <li>
                    <strong>Pregunta:</strong> {{ $answer->question->question_text }}<br>
                    <strong>Respuesta:</strong> {{ $answer->answer->answer_text }} 
                    @if($answer->answer->is_correct)
                        <span style="color: green;">✔ Correcta</span>
                    @else
                        <span style="color: red;">✘ Incorrecta</span>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
@endforeach

@endsection