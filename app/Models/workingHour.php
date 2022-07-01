<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkingHour extends Model
{
    use HasFactory;
    public const WEEK =
    [
        'Saturday',
        'Sunday',
        'Monday',
        'Tuesday',
        'Wednesday',
        'Thursday',
        'Friday'
    ];
    protected $fillable = [
        'restaurant_id',
        'day',
        'open_time',
        'close_time',
    ];


    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }



}
