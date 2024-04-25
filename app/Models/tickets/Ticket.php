<?php

namespace App\Models\tickets;

use App\Models\CategoryCourse;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable =
        [
            'subject',
            'description',
            'status',
            'seen',
            'reference_id',
            'user_id',
            'category_course_id',
            'priority_id',
            'ticket_id'
        ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function admin()
    {
        return $this->belongsTo(TicketAdmin::class, 'reference_id');
    }

    public function category()
    {
        return $this->belongsTo(CategoryCourse::class);
    }


}
