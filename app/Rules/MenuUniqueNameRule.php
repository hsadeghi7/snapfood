<?php

namespace App\Rules;

use App\Models\Menu;
use Illuminate\Contracts\Validation\Rule;

class MenuUniqueNameRule implements Rule
{
    private $foodId;
    private $restaurantId;


    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        $this->foodId = $request->food_id;
        $this->restaurantId = $request->restaurant_id;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $menu = Menu::where('food_id', $value)
            ->where('menuable_id', $this->restaurantId)
            ->first();
        if ($menu) {
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return  ['error' => 'The food is already taken.'];
    }
}
