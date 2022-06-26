<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'phone',
        'address',
        // 'name',
        // 'type',
        'account_number',
    ];

    public static function getProfile()
    {
        return Profile::where('user_id', auth()->id())->first();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
