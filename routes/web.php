<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

Auth::routes();

Route::get('/', function () {return view('index');});
Route::get('/quizzes', [QuizController::class, 'quizzes'])->name('quizzes.quizzes');
Route::get('/quiz/{id}', [QuizController::class, 'quiz'])->name('quizzes.quiz');
Route::post("/quiz/{id}/submit", [QuizController::class, "submit"])->name("submit");
Route::get('/quiz/results/{attempt}', [QuizController::class, 'results'])->name('quiz.results');
Route::middleware(['middleware' => 'auth'])->group(function(){
    Route::get("/profile", [UserController::class, "profile"])->name("user.profile");
    Route::get("/admin/quizzes/", [AdminController::class, "listQuizzes"])->name("admin.list");
    Route::get("/admin/quizzes/create", [AdminController::class, "createQuiz"])->name("admin.create");
    Route::delete("/admin/quizzes/delete/{id}", [AdminController::class, "deleteQuiz"])->name("admin.delete");
    Route::post("/admin/quizzes", [AdminController::class, "storeQuiz"])->name("admin.store");
    Route::put("/admin/quizzes/{id}", [AdminController::class, "update"])->name("admin.update");
});
