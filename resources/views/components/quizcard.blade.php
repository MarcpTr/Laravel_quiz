<a href="{{ route('quiz.play', $id) }}"
    class="block max-w-sm rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300 bg-white">
    <img class="w-full h-48 object-cover" src="{{ asset('storage/' . $image) }}" alt="{{ $title }}">
    <div class="p-4">
        <h2 class="text-xl font-semibold text-gray-800 mb-2 hover:text-indigo-600 transition-colors duration-300">{{ $title }} </h2>
        <p class="text-gray-600 text-sm">
            {{ $description }}
        </p>
    </div>
</a>
