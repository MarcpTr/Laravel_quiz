<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name("home");

Route::get('/quizzes', [QuizController::class, 'index'])->name('quizzes.index');
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/quiz/{id}', [QuizController::class, 'play'])->name('quiz.play');
Route::post("/quiz/{id}/submit", [QuizController::class, "submit"])->name("quiz.submit");
Route::get('/result/{attempt}', [UserController::class, 'result'])->name('quiz.results');

Route::middleware(['middleware' => 'auth'])->group(function(){
    Route::get("/profile", [UserController::class, "profile"])->name("user.profile"); 

    Route::get("/admin/quizzes", [AdminController::class, "index"])->name("admin.quizzes.index");
    Route::get("/quizzes/create", [QuizController::class, "create"])->name("quizzes.create");
    Route::delete("/quizzes/delete/{id}", [QuizController::class, "destroy"])->name("quizzes.destroy");
    Route::post("/quiz", [QuizController::class, "store"])->name("quizzes.store");   

    Route::get("/category/create/", [CategoryController::class, "create"])->name("categories.create");
    Route::post("/create/category", [CategoryController::class, "store"])->name("categories.store");
});
