<?php

namespace App\Rules;

use App\Models\workingHour;
use Illuminate\Contracts\Validation\Rule;

class TimeConflict implements Rule
{
    protected $day;
    protected $restaurant_id;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($instance)
    {
        $this->day = $instance->day;
        $this->restaurant_id = $instance->restaurant_id;
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
        $workingHour = workingHour::where('day', $this->day)
            ->where('restaurant_id', $this->restaurant_id)
            ->where('open_time', '<=', $value)
            ->where('close_time', '>=', $value)->get();

            return count($workingHour) > 0 ? false : true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'This Time is set before';
    }
}
