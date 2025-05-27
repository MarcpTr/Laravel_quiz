<h2>Resultados de tu intento</h2>

@foreach ($userAnswers as $userAnswer)
    <div style="margin-bottom: 1rem;">
        <strong>Pregunta:</strong> {{ $userAnswer->question->question }}<br>
        <strong>Tu respuesta:</strong> {{ $userAnswer->answer->option }} 
        @if($userAnswer->answer->is_correct)
            <span style="color: green; font-weight: bold;">(Correcta)</span>
        @else
            <span style="color: red; font-weight: bold;">(Incorrecta)</span>
            <br>
            <strong>Respuesta correcta:</strong> 
            {{-- Mostrar la opción correcta --}}
            @php
                $correctAnswer = $userAnswer->question->answers->firstWhere('is_correct', true);
            @endphp
            {{ $correctAnswer ? $correctAnswer->option : 'No disponible' }}
        @endif
    </div>
@endforeach
