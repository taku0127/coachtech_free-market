<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'name' => 'required',
            'image' => 'image|mimes:jpeg,png'
        ];
    }

    public function messages(){
        return [
            'name.required' => 'お名前を入力してください',
            'image.image' => '画像をアップロードしてください',
            'image.mimes' => '画像はJPEGかPNG形式でアップロードしてください'
        ];
    }
}
