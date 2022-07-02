<?php

namespace App\Http\Requests;

use App\Models\Category;
use App\Models\Restaurant;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRestaurantRequest extends FormRequest
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
            'name' => 'required|min:4|max:20|unique:restaurants,name,'.$this->restaurant->id,
            'title' => 'required',
            'phone' => 'required|phone:IR',
            'type' => 'required|in:' . implode(',', Category::getRestaurantCategories()),
            'image'=>'image|mimes:jpeg,png,jpg|max:2048',
        ];
    }
}
