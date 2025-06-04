@extends('layouts.app')
@section('content')
    <a href="{{ route('logout') }}" class="bg-red-500"
        onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
        {{ __('Logout') }}
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
    @foreach ($attempts as $attempt)
        <x-attempt :attempt="$attempt" />
    @endforeach
@endsection
