<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Restaurant extends Model
{
    use HasFactory;
    public const WEEK =
    [
        'Saturday' => 'Saturday',
        'Sunday' => 'Sunday',
        'Monday' => 'Monday',
        'Tuesday' => 'Tuesday',
        'Wednesday' => 'Wednesday',
        'Thursday' => 'Thursday',
        'Friday' => 'Friday',
    ];


    /**
     * Get all of the category for the post.
     */
    public function categories()
    {

        return $this->morphToMany(Category::class, 'categorizeable');
    }
}
