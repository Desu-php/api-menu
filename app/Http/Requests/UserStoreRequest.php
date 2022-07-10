<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
        $isUpdate = !empty($this->id);
        $password = $isUpdate ? 'nullable' : 'required';
        $email = $isUpdate ? ',id,'.$this->id : '';
        return [
            'name' => 'required|min:2|max:64',
            'email' => ['required', 'unique:users'.$email, 'email'],
            'password' => $password.'|confirmed|min:6',
            'role' => ['required', 'integer', 'exists:roles,id'],
        ];
    }
}
