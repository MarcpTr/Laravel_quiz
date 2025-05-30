<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizAttempt extends Model
{
    protected $fillable = [
        'user_id', "quiz_id", "attempt_number"
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function userAnswers()
    {
        return $this->hasMany(UserAnswer::class);
    }
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

}
