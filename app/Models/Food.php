<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Food extends Model
{
    use HasFactory;




    /**
     * Get all of the category for the post.
     */
    public function categories()
    {
        return $this->morphToMany(Category::class, 'categorizeable');
    }
}
