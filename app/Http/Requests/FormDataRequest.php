<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormDataRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true ;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'price' => 'required',
            'page' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => '제목은 필수 입력사항입니다.',
            'price.required' => '가격은 필수 입력사항입니다. 0 이상으로 입력 가능합니다.',
            'page.required' => '페이지는 필수 입력사항입니다. 1 이상으로 입력 가능합니다.'
        ];
    }
}
