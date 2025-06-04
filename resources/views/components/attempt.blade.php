<a href="{{ route('quiz.results', $attempt["quiz_attempt_id"]) }}"
    class="block max-w-sm rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300 bg-white">
    <img class="w-full h-48 object-cover" src="{{ asset('storage/' . $attempt["quiz_image"]) }}" alt="{{ $attempt["quiz_title"] }}">
    <div class="p-4">
        <h2 class="text-xl font-semibold text-gray-800 mb-2 hover:text-indigo-600 transition-colors duration-300">{{ $attempt["quiz_title"]  }} </h2>
        <p class="text-gray-600 text-sm">
            Intento numero: {{ $attempt["attempt_number"] }}
         </p>
         <p class="text-gray-600 text-sm">
             Correctas: {{ $attempt["correct_answers_count"]}}/{{ $attempt["total_questions"]  }}
          </p>
     </div>
 </a>
 