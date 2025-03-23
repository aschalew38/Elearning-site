<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $guarded=[];
    function author(){
        return $this->belongsTo(User::class,"user_id");
    }
function gallery(){
    return $this->hasMany(BlogGallery::class,"blog_id","id");
}
function comments(){
    return $this->hasMany(BlogComment::class,"blog_id","id");
}
}
