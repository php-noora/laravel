<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Article extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory;

    protected $fillable=[
        'title',
        'image',
        'Short_description',
        'description',
        'Visit',

    ];
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
