<?php

namespace App\Http\Requests;

use App\Rules\IndiaPhoneNumber;
use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'nullable|string|',
            'email' => 'required|email',
            'phone' => ['required', new IndiaPhoneNumber,'regex:/[0-9]{9}'],
            'role' => 'nullable|integer',
            'file' => 'nullable|mimes:jpeg,jpg,png,pdf,gif|max:10000',
            'description' => 'nullable'
        ];
    }
}
