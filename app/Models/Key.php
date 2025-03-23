<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Key extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function QuestionKey()
    {
        return $this->hasMany(QuestionKey::class);
    }
    public function Answer()
    {
        return $this->hasMany(Answer::class);
    }
}