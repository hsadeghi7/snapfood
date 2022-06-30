<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'role',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * Get the foods for the user.
     */
    public function foods(){
        return $this->hasMany(Food::class);
    }


        /**
     * Get the restaurants for the user.
     */
    public function restaurants(){
        return $this->hasMany(Restaurant::class);
    }

            /**
     * Get the menus for the user.
     */
    // public function menus(){
    //     return $this->hasMany(Menu::class);
    // }


        /**
     * Get the profiles for the user.
     */
    public function profile(){
        return $this->hasOne(Profile::class);
    }


    /**
     * Get the addresses for the user.
     */
    public function addresses(){
        return $this->morphMany(Address::class, 'addressable');
    }


}
