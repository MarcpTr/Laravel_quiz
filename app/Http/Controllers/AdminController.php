<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Quiz;
use App\Models\Category;
use App\Models\Level;

class AdminController extends Controller
{

    public function index()
    {
        if (Auth::user()->name === "admin") {
            $quizzes = Quiz::all();
            return view("admin.quizzes.index", compact("quizzes"));
        } else {
            return redirect()->route('quizzes.index');
        }
    }
}
