<tr onclick="window.location='{{ route('quiz.results', $quizAttemptId) }}'" role="button"
    tabindex="0"
    class="cursor-pointer hover:bg-gray-100 transition">
    <td class="px-4 py-2">{{ $quizTitle }}</td>
    <td class="px-4 py-2">
            <img src="{{ asset('storage/' . $quizImage) }}" alt="Quiz Image" class="w-14 h-14 object-cover rounded">
    </td>
    <td class="px-4 py-2">{{ $attemptNumber }}</td>
    <td class="px-4 py-2">{{ $correctAnswersCount }}</td>
    <td class="px-4 py-2">{{ $totalQuestions }}</td>
</tr>
