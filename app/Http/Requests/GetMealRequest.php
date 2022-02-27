<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class GetMealRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {

        return [
            'lang' => 'required|max:2',
            'with' => 'sometimes|string',
            'diff_time' => 'sometimes|numeric',
            'category'=> 'sometimes|numeric',
            'perPage' => 'sometimes|numeric',
            'page' => 'sometimes|numeric',
            'tags' =>'sometimes|string|max:50'
        ];
    }
}
