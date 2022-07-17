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
        return [
            'user_id' => ['nullable', 'integer', 'exists:users,id'],
            'city_id' => ['nullable', 'integer', 'exists:cities,id'],
            'name' => ['required'],
            'slug' => ['required', Rule::unique('institutions')->ignore($this->id)],
            'design' => ['nullable'],
            'color' => ['nullable'],
            'currency_id' => ['nullable', 'integer'],
            'phone' => ['nullable'],
            'logo' => ['nullable', 'image', 'mimes:jpeg,bmp,png,jpg', 'max:1000'],
            'background_image' => ['nullable', 'image', 'mimes:jpeg,bmp,png,jpg', 'max:1000'],
            'wifi_password' => ['nullable'],
            'country_id' => ['nullable', 'integer', 'countries:exists,id'],
            'address' => ['nullable']


        ];
    }
}
