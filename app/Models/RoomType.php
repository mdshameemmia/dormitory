<?php

namespace App\Models;

use App\Models\Room;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RoomType extends Model
{
    use HasFactory;

    protected $table ='room_types';
    protected $guarded = [];


    public function room()
    {
        return $this->hasOne(Room::class);
    }

}
