<?php

namespace App\Http\Requests\Api\User\Auth\SocialLogin;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
        if ($this->has('credential')) {
            $r['credential'] = 'required';
        } else {
            $r['access_token'] = 'required';
        }

        return $r;
    }
}
