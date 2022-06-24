<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;



    /**Relations */
    public function categories()
    {
        return $this->morphMany(Restaurant::class, 'categoryable');
    }
}
