<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function quizzes(){
        $quizzes=Quiz::all();
        return view("quizzes.quizzes", ["quizzes" => $quizzes]);
    }
    public function quiz($id){
        $quiz=Quiz::find($id);
        $questions = Question::with('answers')->where('quiz_id', $id)->get();
        return view("quizzes.quiz", compact('quiz', 'questions'));
    }
    public function submit(Request $request){
        $validated = $request->validate([
            'answers' => 'required|array',
            'answers.*' => 'required|integer|exists:answers,id',
        ]);
    }
}
