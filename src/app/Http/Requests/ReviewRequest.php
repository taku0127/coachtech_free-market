<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
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
            //
            'rating' => 'required|numeric|min:1|max:5',

        ];
    }

    public function messages()
    {
        return [
            'rating.required' => '評価を選択してください',
            'rating.numeric' => '評価は数字で入力してください',
        ];
    }
}
