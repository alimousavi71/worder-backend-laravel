<?php

namespace App\Http\Requests\Api\User\Profile;

use Illuminate\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest
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
        $rule['password'] = 'required|string|min:6|same:password_confirm';
        if (isset($this->user()->passwprd)) {
            $rule['old_password'] = 'required|string|min:6';
        }

        return $rule;
    }
}
