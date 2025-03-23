<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function postedBy()
    {
        return User::where('id', $this->posted_by)->first();
        // return $this->belongsTo(User::class);
    }
}
