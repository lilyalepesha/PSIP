<?php

namespace App\Http\Requests\Authentication;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
//        return !Auth::check();
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'email' => __('custom.auth.email'),
            'password' => __('custom.auth.password'),
            'password_confirmation' => __('custom.auth.password_confirmation'),
        ];
    }

    /**
     * @param $key
     * @param $default
     * @return array|mixed|string[]
     */
    public function validated($key = null, $default = null)
    {
        return array_merge(
            parent::validated($key, $default),
            [
                'name' => 'Пользователь'
            ]
        );
    }
}
