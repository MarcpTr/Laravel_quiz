@extends('layouts.app')
@section('content')
<div>
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 p-4">
    @foreach ($quizzes as $quiz)
        <x-quizcard :id="$quiz->id" :description="$quiz->description" :title="$quiz->title" :image="$quiz->imageRef" />
    @endforeach
</div > 
<div class="m-8"> {{ $quizzes->withQueryString()->links() }}</div>
  
</div>
@endsection
