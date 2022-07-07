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
        return auth()->user()->hasPermissionTo('sellerPermission');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'bail|required|unique:restaurants,name|min:4|max:20',
            'title' => 'required',
            'phone' => 'bail|required|phone:IR',
            'type' => 'bail|required|in:' . implode(',', Category::getRestaurantCategories()),
            'image'=>'bail|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }
}
