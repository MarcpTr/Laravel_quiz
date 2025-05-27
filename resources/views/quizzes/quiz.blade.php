<h1>{{ $quiz->title}}</h1>
<p>{{ $quiz->description}}</p>
<img src="{{ asset('storage/' . $quiz->imageRef) }}" alt="Imagen del quiz">

@foreach ($questions as $question)
    <div>
        <strong>{{ $question->question }}</strong>
        <ul>
            @foreach ($question->answers as $answer)
                <li>{{ $answer->option }} 
                    @if ($answer->is_correct)
                        <strong>(Correcta)</strong>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
@endforeach