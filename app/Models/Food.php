<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Food extends Model
{
    use HasFactory;




/**Relations */
    public function categories()
    {
        return $this->morphMany(Category::class, 'categoryable');
    }
}
