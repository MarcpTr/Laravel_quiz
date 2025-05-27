@extends('layouts.app')
@section('content')

Profile

@foreach($attempts as $attempt)
    <div class="attempt">
        <h3>Intento en quiz: {{$attempt->quiz->title}} - Fecha: {{$attempt->created_at }}</h3>
        <ul>
            @foreach($attempt->userAnswers as $answer)
                <li>
                    Pregunta: {{ $answer->question->question }} <br>
                    Respuesta: {{ $answer->answer->option }} 
                    @if($answer->answer->is_correct)
                        <strong style="color: green">✔ Correcta</strong>
                    @else
                        <strong style="color: red">✘ Incorrecta</strong>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
@endforeach
@endsection