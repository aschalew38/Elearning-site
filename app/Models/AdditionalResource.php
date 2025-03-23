<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionalResource extends Model
{
    use HasFactory;
    protected $table = "additional_resources";
    protected $primaryKey = "id";
    protected $fillable = ['url','title','overview','type'];
}
