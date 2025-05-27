<?php

namespace App\Http\Controllers;

use App\Models\QuizAttempt;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function profile()
    {
        $user = Auth::User();
        $attempts = Auth::User()
            ->quizAttempts()
            ->with(['quiz', 'userAnswers.question', 'userAnswers.answer'])
            ->latest()
            ->get();
        return view("user.profile", compact('attempts'));
    }
}
