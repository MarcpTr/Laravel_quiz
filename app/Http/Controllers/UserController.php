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

        $attemptsRaw = QuizAttempt::with(['quiz.questions', 'userAnswers.answer'])
            ->where('user_id', $user->id)
            ->get();

        $totalAnswers = 0;
        $correctAnswersTotal = 0;
        $totalQuizzes = $attemptsRaw->count();
        $uniqueQuizzes = $attemptsRaw->pluck('quiz.id')->unique()->count();

        $attempts = $attemptsRaw->map(function ($attempt) use (&$totalAnswers, &$correctAnswersTotal) {
            $totalQuestions = $attempt->quiz->questions->count();

            $correctAnswers = $attempt->userAnswers->filter(function ($userAnswer) {
                return $userAnswer->answer->is_correct;
            })->count();

            $answerCount = $attempt->userAnswers->count();
            $totalAnswers += $answerCount;
            $correctAnswersTotal += $correctAnswers;

            return [
                'quiz_attempt_id' => $attempt->id,
                'quiz_title' => $attempt->quiz->title,
                'quiz_image' => $attempt->quiz->imageRef,
                'attempt_number' => $attempt->attempt_number,
                'correct_answers_count' => $correctAnswers,
                'total_questions' => $totalQuestions,
            ];
        });

        $summary = [
            'different_quizzes' => $uniqueQuizzes,
            'total_quizzes' => $totalQuizzes,
            'total_answers' => $totalAnswers,
            'correct_answers' => $correctAnswersTotal,
            'attempts' => $attempts,
        ];
        return view("user.profile", compact('summary', "user"));
    }
    public function result($attemptId)
    {
        $attempt = QuizAttempt::where('id', $attemptId)
            ->where('user_id', Auth::id())
            ->first();

        if (!$attempt) {
            abort(404);
        }
        $userAnswers = UserAnswer::with(['answer', 'question.answers'])
            ->where('quiz_attempt_id', $attemptId)
            ->get();
        if ($userAnswers->isEmpty()) {
            abort(404);
        }
        return view('quiz.results', compact('userAnswers'));
    }
}
