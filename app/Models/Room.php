<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $guarded;

    protected $with =  ['images', 'amenities', 'feedbacks'];

    protected $casts = [
        'created_at' => 'date:Y-m-d H:i:s',
        'updated_at' => 'date:Y-m-d H:i:s',
    ];

    public function images()
    {
        return $this->hasMany(RoomImages::class);
    }

    public function amenities()
    {
        return $this->hasMany(RoomAmenity::class);
    }


    public function feedbacks()
    {
        return $this->hasMany(RoomFeedBack::class, 'room_id', 'id');
    }
}
