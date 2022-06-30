<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            // 'name'=>'required|max:255',
            'title'=>'required|max:255',
            'phone'=>'phone:IR',
            'account_number'=>'required|numeric',
            // 'type'=>'required|in:'.implode(',', Category::getRestaurantCategories()),
        ];
    }
}
