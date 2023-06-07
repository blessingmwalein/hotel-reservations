<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomFeedBack extends Model
{
    use HasFactory;
    protected $guarded;

    protected $with = ['user'];

    protected $casts = [
        'created_at' => 'date:Y-m-d H:i:s',
        'updated_at' => 'date:Y-m-d H:i:s',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
