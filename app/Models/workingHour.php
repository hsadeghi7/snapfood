<?php

namespace App\Models;

use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
