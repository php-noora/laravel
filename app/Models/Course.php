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
        return $this->hasOne( category_course ::class);
    }
    public function lecturer()
    {
        return $this->belongsTo(Lecturer ::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
