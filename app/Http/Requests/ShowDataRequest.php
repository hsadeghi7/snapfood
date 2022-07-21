<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShowDataRequest extends FormRequest
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
            'restaurant_id' => 'bail|required|exists:restaurants,id',
            'time_period' => 'bail|required|integer|min:0|max:365',
        ];
    }
}
