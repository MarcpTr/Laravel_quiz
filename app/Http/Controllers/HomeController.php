<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $quizzes = Quiz::query()->latest()
        ->limit(8)
        ->get();
     return view("home", ["quizzes" => $quizzes]);
    }
}
