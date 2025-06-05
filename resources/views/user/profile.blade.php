@extends('layouts.app')

@section('content')
    <main class="pt-10 px-6 max-w-7xl mx-auto">

        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
            <div>
                <p class="text-lg font-semibold">👤 {{ $user->name }}</p>
                <p class="text-sm text-gray-600">📧 {{ $user->email }}</p>
                <p class="text-sm text-gray-500">📅 Miembro desde: {{ $user->created_at->format('d M Y') }}</p>
            </div>
            <div>
                <a href="{{ route('logout') }}" class="inline-block bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Cerrar sesión
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            </div>
        </div>

        
        <h2 class="text-2xl font-bold mb-4">Resumen de Intentos</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <div class="bg-blue-400 text-white p-4 rounded shadow">
                <h5 class="text-lg font-semibold">Quizzes Diferentes</h5>
                <p class="text-2xl">{{ $summary['different_quizzes'] }}</p>
            </div>
            <div class="bg-blue-200 text-black p-4 rounded shadow">
                <h5 class="text-lg font-semibold">Intentos Totales</h5>
                <p class="text-2xl">{{ $summary['total_quizzes'] }}</p>
            </div>
            <div class="bg-orange-300 text-black p-4 rounded shadow">
                <h5 class="text-lg font-semibold">Respuestas Totales</h5>
                <p class="text-2xl">{{ $summary['total_answers'] }}</p>
            </div>
            <div class="bg-green-200 text-black p-4 rounded shadow">
                <h5 class="text-lg font-semibold">Correctas Totales</h5>
                <p class="text-2xl">{{ $summary['correct_answers'] }}</p>
            </div>
        </div>

        <h3 class="text-xl font-bold mb-4">Detalle de Intentos</h3>
        <div class="overflow-x-auto bg-white shadow rounded-lg">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold">#</th>
                        <th class="px-4 py-3 text-left font-semibold">Quiz</th>
                        <th class="px-4 py-3 text-left font-semibold">Imagen</th>
                        <th class="px-4 py-3 text-left font-semibold">Intento</th>
                        <th class="px-4 py-3 text-left font-semibold">Correctas</th>
                        <th class="px-4 py-3 text-left font-semibold">Totales</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach ($summary['attempts'] as $attempt)
                        <tr>
                            <td class="px-4 py-2">{{ $attempt['quiz_attempt_id'] }}</td>
                            <td class="px-4 py-2">{{ $attempt['quiz_title'] }}</td>
                            <td class="px-4 py-2">
                                @if ($attempt['quiz_image'])
                                    <img src="{{ asset('storage/' . $attempt['quiz_image']) }}" alt="Quiz Image" class="w-14 h-14 object-cover rounded">
                                @else
                                    <span class="italic text-gray-400">Sin imagen</span>
                                @endif
                            </td>
                            <td class="px-4 py-2">{{ $attempt['attempt_number'] }}</td>
                            <td class="px-4 py-2">{{ $attempt['correct_answers_count'] }}</td>
                            <td class="px-4 py-2">{{ $attempt['total_questions'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </main>
@endsection
