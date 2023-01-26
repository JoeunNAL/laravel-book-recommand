<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class LoginFormDataRequest extends FormRequest
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
            'email' => ['required', 'email'],
            'password' => ['required', Password::min(8)],
        ];
    }

    public function messages() 
    {
        return [
            'email' => '이메일과 비밀번호가 일치하지 않습니다.',
            'password.min' => '비밀번호는 최소 8자리입니다.'
        ];
    }
}
