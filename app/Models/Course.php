<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Course extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory;
    Protected $guarded=[];

    public function category_course()
    {
        return $this->belongsTo( CategoryCourse ::class);
    }
    public function lecturer()
    {
        return $this->belongsTo(Lecturer ::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    public function parts()
    {
        return $this->hasMany(Part ::class);
    }

    public function userfavorites()
    {
        return $this->belongsToMany(User::class,'favorites',);
    }

//    public function myCourses()
//
//    {
//        return $this->belongsToMany(User::class,'my_courses',);
//    }

}
