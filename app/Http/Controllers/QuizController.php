<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Question;
use App\Models\UserAnswer;
use App\Models\QuizAttempt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    public function quizzes()
    {
        $quizzes = Quiz::all();
        return view("quizzes.quizzes", ["quizzes" => $quizzes]);
    }
    public function quiz($id)
    {
        $quiz = Quiz::find($id);
        if ($quiz === null)
            abort(404);
        $questions = Question::with('answers')->where('quiz_id', $id)->get();
        return view("quizzes.quiz", compact('quiz', 'questions'));
    }
    public function submit(Request $request, $id)
    {
        $questionsCount = Quiz::withCount('questions')->where('id', $id)->value('questions_count');
        $validated = $request->validate([
            'answers' => ['required', 'array', "size:$questionsCount"],
            'answers.*' => 'required|integer|exists:answers,id',
        ], [
            'answers.size' => 'Debes responder todas las preguntas.',
        ]);

        $userId = Auth::user() ? Auth::id() : 0;
        $attempt = QuizAttempt::create([
            'user_id' => $userId,
            'quiz_id' => $id,
            "attempt_number" => "7"
        ]);
        foreach ($validated['answers'] as $questionId => $answerId) {
            UserAnswer::create([
                'user_id' => $userId,
                'question_id' => $questionId,
                'answer_id' => $answerId,
                'quiz_attempt_id' => $attempt->id,
            ]);
        }
        return redirect()->route('quiz.results', ["attempt" => $attempt->id]);
    }
    public function results($attemptId)
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
