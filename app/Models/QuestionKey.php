<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionKey extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
    public function key()
    {
        return $this->belongsTo(Key::class);
    }
}