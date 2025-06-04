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
        $quizzes = Quiz::all();
        return view("admin.quizzes.index", compact("quizzes"));
    }
  
 
}
