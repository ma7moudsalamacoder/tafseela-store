<?php

namespace Modules\Identity\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class ChangePasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'current_password.required' => trans('identity::validation.current_password_required'),
            'password.required' => trans('identity::validation.password_required'),
            'password_confirmation.required' => trans('identity::validation.password_confirmation_required'),
            'password_confirmation.same' => trans('identity::validation.password_confirmation_same'),
            'current_password' => 'required|string|hash_check',
            'password' => ['required', Password::min(8)->letters()->numbers()->symbols()->uncompromised()],
            'password_confirmation' => 'required|string|same:password',
        ];
    }

    public function messages(): array
    {
        return [
            'current_password.required' => trans('identity::validation.current_password_required'),
            'current_password.hash_check' => trans('identity::validation.current_password_hash_check'),
            'password.required' => trans('identity::validation.password_required'),
            'password.min' => trans('identity::validation.password_min'),
            'password.letters' => trans('identity::validation.password_letters'),
            'password.numbers' => trans('identity::validation.password_numbers'),
            'password.symbols' => trans('identity::validation.password_symbols'),
            'password.uncompromised' => trans('identity::validation.password_uncompromised'),
            'password_confirmation.required' => trans('identity::validation.password_confirmation_required'),
            'password_confirmation.same' => trans('identity::validation.password_confirmation_same'),
        ];
    }
}


