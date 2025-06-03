@extends('layouts.app')
@section('content')
    <main class="max-w-4xl mx-auto p-6 bg-gray-50 rounded-lg shadow-md">

        <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Resultados de tu intento</h2>
        <div class="space-y-6">

            @foreach ($userAnswers as $userAnswer)
                <div class="bg-white p-5 rounded-lg shadow border-l-4 border-green-500">
                    <p class="font-semibold text-gray-800 mb-2">
                        <span class="text-gray-600">Pregunta:</span> {{ $userAnswer->question->question_text }}
                    </p>
                    <p class="text-gray-700">
                        <span class="font-semibold text-gray-600">Tu respuesta:</span> {{ $userAnswer->answer->answer_text }}
                    @if ($userAnswer->answer->is_correct)
                    <span class="text-green-600 font-bold ml-2">(Correcta)</span>
                </p>
                    @else
                    <span class="text-red-600 font-bold ml-2">(Incorrecta)</span>
                        </p>
                        <p class="text-sm text-gray-600 mt-1">
                            <span class="font-semibold">Respuesta correcta:</span>
                        @php
                            $correctAnswer = $userAnswer->question->answers->firstWhere('is_correct', true);
                        @endphp
                        {{ $correctAnswer ? $correctAnswer->answer_text : 'No disponible' }}
                    </p>
                    @endif
                    
                </div>
            @endforeach
        </div>
    </main>
@endsection
