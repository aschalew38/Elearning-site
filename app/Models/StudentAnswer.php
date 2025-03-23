<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAnswer extends Model
{
    use HasFactory;
    protected $guarded = [];
    function key(){
    return $this->belongsTo(Key::class,"key_id");
    }
}
