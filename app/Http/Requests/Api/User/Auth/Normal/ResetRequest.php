<?php

namespace App\Http\Requests\Api\User\Auth\Normal;

use Illuminate\Foundation\Http\FormRequest;

class ResetRequest extends FormRequest
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
            'code' => 'required',
            'email' => 'required|email|max:255',
            'password' => 'required|min:6|same:confirm_password',
        ];
    }
}