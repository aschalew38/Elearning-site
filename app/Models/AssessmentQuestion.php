<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssessmentQuestion extends Model
{
    use HasFactory;
    public function Assessment()
    {
        return $this->belongsTo(Assessment::class);
    }
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}