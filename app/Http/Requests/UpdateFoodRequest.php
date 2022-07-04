<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;

class UpdateFoodRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->hasRole('seller');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'=>'required|string|max:255',
            'price'=>'required|numeric',
            'ingredients'=>'max:255',
            'foodCategory'=>'required|in:'.implode(',', Category::getFoodCategories()),
            'image'=>'image|mimes:jpeg,png,jpg|max:2048'
        ];
    }
}
