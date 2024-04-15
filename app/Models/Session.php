<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Session extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory;
    protected $fillable =[
        'name',
        'Duration_course',
        'video',
        'part_id',

        ];
}
