<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;

class StoreFoodRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->hasPermissionTo('adminPermission');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'=>'bail|required|unique:foods,name|string|max:255',
            'price'=>'bail|required|numeric',
            'ingredients'=>'bail|max:255',
            'foodCategory'=>'bail|required|in:'.implode(',', Category::getFoodCategories()),
            'image'=>'bail|image|mimes:jpeg,png,jpg|max:2048'
        ];
    }
}
