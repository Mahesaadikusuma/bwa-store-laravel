<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required|string|max:50',
            'email' => 'required|email:dns|unique:users', 
            // unique:users
            //IN ITU UNTUK INPUTANNYA CUMA 2 NYAITU ADMIN DAN USER
            'roles' => 'nullable|string|in:ADMIN,USER',
        ];
    }
}
