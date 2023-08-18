<?php

namespace App\Http\Requests\Admin\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'email' => 'required|unique:admins,email|email',
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'password' => 'required|min:8|max:255',
            'avatar' => 'nullable|image|mimes:png,jpg,jpeg|max:2000',
            'role' => 'required|exists:roles,id',
        ];
    }
}
