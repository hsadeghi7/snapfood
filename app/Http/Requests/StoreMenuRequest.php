<?php

namespace App\Http\Requests;

use App\Rules\MenuUniqueNameRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreMenuRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'food_id' => ['bail','required', new MenuUniqueNameRule($this)],
            'restaurant_id' => 'bail|required',
            'coupon' => 'bail|required',
        ];
    }
}
