<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Answer extends Model
{
   
    protected $fillable = ['answer_text', 'is_correct', 'question_id'];

    protected $casts = [
        'is_correct' => 'boolean',
    ];

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
    
    public function userAnswers()
    {
        return $this->hasMany(UserAnswer::class);
    }
}
