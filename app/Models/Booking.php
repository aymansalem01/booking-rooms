<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $cast = [
        'read_at' => 'datetime',
        'start_date' => 'datetime',
        'end_date' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public  function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }
}
