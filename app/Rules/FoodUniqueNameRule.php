<?php

namespace App\Rules;

use App\Models\Food;
use Illuminate\Contracts\Validation\Rule;

class FoodUniqueNameRule implements Rule
{
    private $userId;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        $this->userId = $request->user_id;
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
        return !Food::where('user_id', $this->userId)->where('name', $value)->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Food name is already taken.';
    }
}
