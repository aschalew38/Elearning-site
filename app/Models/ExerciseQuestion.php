<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExerciseQuestion extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function exercise()
    {
        return $this->belongsTo(Exercise::class);
    }
    public function exercise_options()
    {
        return $this->hasMany(ExerciseOption::class);
    }
    public function exercise_answer()
    {
        // dd($this->id);
        return $this->hasOne(ExerciseAnswer::class);
    }
}