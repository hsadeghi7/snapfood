<?php

namespace App\Http\Requests;

use App\Models\WorkingHour;
use Illuminate\Foundation\Http\FormRequest;

class StoreworkingHourRequest extends FormRequest
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
            'day'=>'bail|required|in:'.implode(',',WorkingHour::WEEK),
            'open_time'=>'bail|required|date_format:H:i|after:11:00|before:23:00',
            'close_time'=>'bail|required|date_format:H:i|after:open_time|after:11:00|before:23:00',
        ];
    }
}
