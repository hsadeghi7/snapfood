<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Restaurant extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'address',
        'phone',
        'type',
        'image',
        'user_id',
        'is_active',
        'latitude',
        'longitude',
    ];


    /**
     * Get all of the category for the post.
     */
    public function categories()
    {

        return $this->morphToMany(Category::class, 'categorizeable');
    }

    /**
     * Get all of the workingHour for the post.
     */
    public function workingHours()
    {
        return $this->hasMany(WorkingHour::class);
    }
}
