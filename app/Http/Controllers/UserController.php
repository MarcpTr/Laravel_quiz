<?php

namespace App\Http\Controllers;

use App\Models\UserAnswer;
use App\Models\QuizAttempt;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function profile()
    {
        $user = Auth::User();
      
    $attempts = QuizAttempt::with(['quiz.questions', 'userAnswers.answer'])
        ->where('user_id', $user->id)
        ->get()
        ->map(function ($attempt) {
            $totalQuestions = $attempt->quiz->questions->count();

            $correctAnswers = $attempt->userAnswers->filter(function ($userAnswer) {
                return $userAnswer->answer->is_correct;
            })->count();

            return [
                'quiz_attempt_id' => $attempt->id,
                'quiz_title' => $attempt->quiz->title,
                'quiz_image' => $attempt->quiz->imageRef,
                'attempt_number' => $attempt->attempt_number,
                'correct_answers_count' => $correctAnswers,
                'total_questions' => $totalQuestions,
            ];
        });
        return view("user.profile", compact('attempts'));
    }
    public function result($attemptId)
    {
        $userAnswers = UserAnswer::with(['answer', 'question.answers'])
            ->where('quiz_attempt_id', $attemptId)
            ->get();
        if ($userAnswers->isEmpty()) {
            abort(404);
        }
        return view('quiz.results', compact('userAnswers'));
    }
}
