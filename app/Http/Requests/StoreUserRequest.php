<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->role === 'admin';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $allowedRoles = auth()->id() === 5 ? 'in:admin,user' : 'in:user';
        return [
            'name' => ['required' , 'string' , 'max:255'],
            'email' => ['required' , 'email' , 'max:255' , 'unique:users'],
            'password' => ['required' , 'string' , 'min:8'],
            'role' => ['required' , $allowedRoles]
        ];
    }
}
