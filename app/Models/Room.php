<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $guarded = [];
    public  function booking()
    {
        return $this->hasMany(Booking::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function image()
    {
        return $this->hasMany(Image::class);
    }
    public function review()
    {
        return $this->hasMany(Review::class);
    }
    public  function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
