@extends('layouts.app')
@section('content')
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 p-4">
        @foreach ($quizzes as $quiz)
            <x-quizcard :id="$quiz->id" :description="$quiz->description" :title="$quiz->title" :image="$quiz->imageRef" />
            <form action="{{ route('quizzes.destroy', $quiz->id) }}" method="post">
                @csrf
                @method('DELETE')
                <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded" type="submit">Eliminar</button>
            </form>
        @endforeach
    </div>
@endsection
