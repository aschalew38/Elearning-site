<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExerciseOption extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function exercise_Question()
    {
        return $this->belongsTo(ExerciseQuestion::class);
    }
    public function exercise_answer()
    {
        return $this->hasOne(ExerciseAnswer::class);
    }
}