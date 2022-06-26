<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Food extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'price', 'coupon', 'foodParty', 'ingredients', 'foodCategory', 'image', 'user_id', 'categoryable_type', 'categoryable_id'];

    protected $table='foods';


    /**
     * Get all of the category for the post.
     */
    public function categories()
    {
        return $this->morphToMany(Category::class, 'categorizeable');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
