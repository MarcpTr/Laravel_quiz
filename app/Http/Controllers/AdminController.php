<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Quiz;
class AdminController extends Controller
{
    public function createQuiz()
    {
        if(Auth::user()->name=="admin")
        return view("admin.create");
    return redirect("404");
    }
  
    public function storeQuiz(Request $request){
        $validated = $request->validate([
            'quiz.title' => 'required|string|max:255',
            'quiz.description' => 'required|string',
            'quiz.image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'quiz.questions' => 'required|array|min:1',
            'quiz.questions.*.question' => 'required|string',
            'quiz.questions.*.answers' => 'required|array|size:4',
            'quiz.questions.*.answers.*.option' => 'required|string',
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
        ]);
        
    foreach ($quizData['questions'] as $qData) {
        $question = $quiz->questions()->create([
            'question' => $qData['question']
        ]);

        foreach ($qData['answers'] as $index => $answerData) {
            $question->answers()->create([
                'option' => $answerData['option'],
                'is_correct' => $index == $qData['correct']
            ]);
        }
    }
        return response()->json(['message' => 'Quiz recibido correctamente', 'data' => $quizData]);

    }
}
