<h1>{{ $quiz->title}}</h1>
<p>{{ $quiz->description}}</p>
<img src="{{ asset('storage/' . $quiz->imageRef) }}" alt="Imagen del quiz">

<form action="{{ route('submit', $quiz->id) }}" method="POST">
    @csrf
    @foreach ($questions as $question)
    <div>
        <strong>{{ $question->question }}</strong>
        <ul>
            @foreach ($question->answers as $answer)
                <li>
                    <label>
                        <input type="radio" 
                               name="answers[{{ $question->id }}]" 
                               value="{{ $answer->id }}">
                        {{ $answer->option }}
                    </label>
                </li>
            @endforeach
        </ul>
    </div>
@endforeach
<button type="submit">Enviar respuestas</button>

</form>
