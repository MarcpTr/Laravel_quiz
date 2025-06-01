<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Quiz;
use App\Models\Category;
use App\Models\Level;

class AdminController extends Controller
{
    public function createQuiz()
    {
        if (Auth::user()->name == "admin") {
            $levels= Level::pluck('name', 'id')->toArray();
            $categories= Category::pluck('name', 'id')->toArray();
            return view("admin.create", compact("levels", "categories"));
        }
        return redirect("404");
    }
    public function listQuizzes()
    {
        $quizzes = Quiz::all();
        return view("admin.list", compact("quizzes"));
    }
    public function deleteQuiz($id)
    {
        Quiz::find($id)->delete();
        return redirect()->route('admin.list');
    }
    public function storeQuiz(Request $request)
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
            'category_id' =>$quizData['category_id']
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
        return redirect()->route('admin.list');
    }
}
