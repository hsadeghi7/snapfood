<?php

namespace App\Models;

use App\Models\Cart;
use App\Models\User;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'body',
        'user_id',
        'cart_id',
        'parent_id',
        'restaurant_id',
        'is_approve',
        'score'
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
