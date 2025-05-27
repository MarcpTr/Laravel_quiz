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
            ->with('quiz')
            ->latest()// muestra primero los ultimos
            ->get();
          
        return view("user.profile", compact('attempts'));
    }
}
