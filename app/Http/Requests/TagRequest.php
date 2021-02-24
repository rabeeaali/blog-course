<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
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
        if ($this->getMethod() === 'POST') {
            return ['name' => 'required|string|max:100|unique:tags',];
        }

        if ($this->getMethod() === 'PUT') {
            return ['name' => ['required', 'string', 'max:100', Rule::unique('tags')->ignore($this->tag->id)]];
        }
    }
}
