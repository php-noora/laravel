<?php

namespace App\Models;

use App\Models\tickets\Ticket;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class CategoryCourse extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory ;
    protected $fillable = [
        'name',
        'image'
    ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
