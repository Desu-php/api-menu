<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class InstitutionRequest extends FormRequest
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
        $logo = [];

        if (empty($this->id)){
            $logo = ['image', 'mimes:jpeg,bmp,png,jpg', 'max:1000'];
        }

        return [
            'user_id' => ['nullable', 'integer', 'exists:users,id'],
            'name' => ['required'],
            'slug' => ['required', Rule::unique('institutions')->ignore($this->id)],
            'currency_id' => ['nullable', 'integer'],
            'phone' => ['nullable'],
            'logo' => ['nullable'] + $logo,
            'wifi_password' => ['nullable'],
        ];
    }
}
