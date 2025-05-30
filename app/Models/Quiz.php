<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Quiz extends Model
{
    protected $fillable=["title", "description", "imageRef","level_id", "category_id"];
    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }
    public function level()
    {
        return $this->belongsTo(Level::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
