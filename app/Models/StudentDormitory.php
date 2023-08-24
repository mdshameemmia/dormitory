<?php

namespace App\Models;

use App\Models\Room;
use App\Models\Dormitory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentDormitory extends Model
{
    use HasFactory;

    protected $table ='student_dormitories';
    protected $guarded = [];

    public function room()
    {
        return  $this->belongsTo(Room::class);
    }

    public function dormitory()
    {
        return  $this->belongsTo(Dormitory::class);
    }


}
