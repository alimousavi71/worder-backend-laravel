<?php

namespace App\Http\Requests\Api\User\Auth\SocialLogin;

use Illuminate\Foundation\Http\FormRequest;

class GoogleOneTabRequest extends FormRequest
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
        $r['clientId'] = 'required';
        $r['credential'] = 'required';

        return $r;
    }
}
