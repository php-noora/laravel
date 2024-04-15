<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    use HasFactory;
    Protected $fillable =[
        'name',
        'Number_videos',
        'course_id',

    ];



    public function course()
    {
        return $this->belongsTo(Course ::class);
    }
}
