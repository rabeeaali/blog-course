<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
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
        $rules = [
            'name' => 'required|string|max:255',
            'is_admin' => 'required|in:0,1',
        ];

        if ($this->getMethod() == 'POST') {
            $rules += [
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|min:6'
            ];
        }

        if ($this->getMethod() == 'PUT') {
            $rules += [
                'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($this->user->id)],
                'password' => 'nullable|min:6',
            ];
        }

        return $rules;
    }
}
