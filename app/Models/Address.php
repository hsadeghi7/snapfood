<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'latitude',
        'longitude',
        'addressable_id',
        'addressable_type',
    ];

    public function addressable()
    {
        return $this->morphTo();
    }
    public function getDefaultAddressAttribute()
    {
        if ($this->is_default) {
            return 'Default Address';
        }
        return false;
    }
}
