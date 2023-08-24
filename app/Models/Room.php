<?php

namespace App\Models;

use App\Models\RoomType;
use App\Models\StudentDormitory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Room extends Model
{
    use HasFactory;

    protected $table ='rooms';
    protected $guarded = [];
    
    public function roomType()
    {
        return $this->belongsTo(RoomType::class);
    }

    public function dormitory()
    {
        return $this->belongsTo(Dormitory::class);
    }
    
    public function students()
    {
        return $this->hasMany(StudentDormitory::class);
    }
}
