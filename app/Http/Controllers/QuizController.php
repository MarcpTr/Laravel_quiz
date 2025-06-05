<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Quiz;
use App\Models\Level;
use App\Models\Question;
use App\Models\UserAnswer;
use App\Models\QuizAttempt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class QuizController extends Controller
{


    public function index(Request $request)
    {
        $query = Quiz::query();
        if ($request->has('level')) {
            $query->where('level_id', $request->query('level'));
        }
        if ($request->has('category')) {
            $query->where('category_id', $request->query('category'));
        }
        $quizzes = $query->paginate(10);
        return view("quizzes.index", ["quizzes" => $quizzes]);
    }

    public function play($id)
    {
        $token = (string) Str::uuid();
        session(['quiz_submit_token' => $token]);
        $quiz = Quiz::find($id);
        if ($quiz === null)
            abort(404);
        $questions = Question::with('answers')->where('quiz_id', $id)->get();
        return view("quizzes.play", compact('quiz', 'questions', 'token'));
    }
    public function submit(Request $request, $id)
    {
        $submittedToken = $request->input('quiz_token');
        $sessionToken = session('quiz_submit_token');
        if (!$submittedToken || $submittedToken !== $sessionToken) {
            return redirect()->back()->with('error', 'Este formulario ya fue enviado o es inválido.');
        }
        session()->forget('quiz_submit_token');

        $questionsCount = Quiz::withCount('questions')->where('id', $id)->value('questions_count');
        $validated = $request->validate([
            'answers' => ['required', 'array', "size:$questionsCount"],
            'answers.*' => 'required|integer|exists:answers,id',
        ], [
            'answers.size' => 'Debes responder todas las preguntas.',
        ]);

        $userId = Auth::user() ? Auth::id() : 0;
        $attemptNumber = QuizAttempt::where('user_id', $userId)
            ->where('quiz_id', $id)
            ->count() + 1;
        $attempt = QuizAttempt::create([
            'user_id' => $userId,
            'quiz_id' => $id,
            "attempt_number" => $attemptNumber
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
    public function create()
    {
        if (Auth::user()->name == "admin") {
            $levels = Level::pluck('name', 'id')->toArray();
            $categories = Category::pluck('name', 'id')->toArray();
            return view("admin.quizzes.create", compact("levels", "categories"));
        }
        return redirect("404");
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'quiz.title' => 'required|string|max:255',
            'quiz.description' => 'required|string',
            'quiz.image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'quiz.level_id' => 'required|exists:levels,id',
            'quiz.category_id' => 'required|exists:categories,id',
            'quiz.questions' => 'required|array|min:1',
            'quiz.questions.*.question_text' => 'required|string',
            'quiz.questions.*.answers' => 'required|array|size:4',
            'quiz.questions.*.answers.*.answer_text' => 'required|string',
            'quiz.questions.*.correct' => 'required|in:0,1,2,3',
        ]);
        $quizData = $validated['quiz'];
        if ($request->hasFile('quiz.image')) {
            $path = $request->file('quiz.image')->store('quizzes', 'public');
        } else {
            $path = null;
        }
        $quiz = Quiz::create([
            'title' => $quizData['title'],
            'description' => $quizData['description'],
            'imageRef' => $path,
            'level_id' => $quizData['level_id'],
            'category_id' => $quizData['category_id']
        ]);

        foreach ($quizData['questions'] as $qData) {
            $question = $quiz->questions()->create([
                'question_text' => $qData['question_text']
            ]);

            foreach ($qData['answers'] as $index => $answerData) {
                $question->answers()->create([
                    'answer_text' => $answerData['answer_text'],
                    'is_correct' => $index == $qData['correct']
                ]);
            }
        }
        return redirect()->route('admin.quizzes.index');
    }
    public function destroy($id)
    {
        Quiz::find($id)->delete();
        return redirect()->route('admin.quizzes.index');
    }
}
