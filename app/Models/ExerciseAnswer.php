<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExerciseAnswer extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function exercise_question()
    {
        return $this->belongsTo(ExerciseQuestion::class);
    }
    public function exercise_option()
    {
        return $this->belongsTo(ExerciseOption::class);
    }
}