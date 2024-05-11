<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    use HasFactory;
    Protected $fillable =[
        'name_part',
        'Number_session',
        'course_id',

    ];



    public function course()
    {
        return $this->belongsTo(Course ::class);
    }

    public function sessions()
    {
        return $this->hasMany(Session ::class);
    }
}
