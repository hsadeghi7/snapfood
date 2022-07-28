<?php

namespace App\Models;

use App\Models\Menu;
use App\Models\Category;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Food extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'price', 'ingredients', 'foodCategory', 'image', 'user_id'];

    protected $table = 'foods';

    /**
     * Get all of the category for the post.
     */
    public function categories()
    {
        return $this->morphToMany(Category::class, 'categorizeable');
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function menus()
    {
        return $this->morphMany(Menu::class, 'menuable');
    }
}
