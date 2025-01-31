<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\tickets\Ticket;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, interactsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
//    protected $guarded=[];
      protected $fillable=[

          'first_name',
          'last_name',
          'date_of_birth',
          'phone_number',
          'email',
          'profile_photo_path',
      ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */

    public function otp(){
        return $this->hasOne(Otp::class);
    }
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

    public function courseFavorites()
    {
        return $this->belongsToMany(Course::class,'favorites',);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

//    public function myCourses ()
//    {
//        return $this->belongsToMany(Course::class,'my_courses',);
//    }
}
