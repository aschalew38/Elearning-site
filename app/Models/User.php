<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;
use Nagy\LaravelRating\Traits\Rate\CanRate;
use Nagy\LaravelRating\Traits\Like\CanLike;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;
    // use CanRate, CanLike;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $guarded = [];
    protected $hidden = ['password', 'remember_token'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function enrolled_courses()
    {
        // return $this->hasMany(Enroll::class,"user_id","id");
        return  Course::join(
            'enrolls',
            'course_id',
            'courses.id'
        )
            ->where('enrolls.user_id', $this->id)
            ->get();
    }

    public function courses()
    {
        return $this->hasMany(Course::class, 'Instructor_id');
    }
    public function News()
    {
        return $this->hasMany(News::class, 'posted_by');
    }

  function blogs(){
    return $this->hasMany(Blog::class);
  }

}
