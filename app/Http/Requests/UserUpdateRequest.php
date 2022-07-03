<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
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
            'name' => 'required|min:2|max:64',
            'email' => ['nullable', Rule::unique('users')->ignore($this->user)],
            'password' => 'sometimes|nullable|confirmed|min:9',
            'role_id' => ['integer', 'required'],
        ];
    }
}
