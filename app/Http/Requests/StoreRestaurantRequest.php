<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;

class StoreRestaurantRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->role === 'seller';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:restaurants,name|min:4|max:20',
            'address' => 'required',
            'phone' => 'required|phone:IR',
            'type' => 'required|in:' . implode(',', Category::getRestaurantCategories()),
            'image'=>'image|mimes:jpeg,png,jpg|max:2048',
        ];
    }
}
