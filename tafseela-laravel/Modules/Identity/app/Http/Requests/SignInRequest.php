<?php

namespace Modules\Identity\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignInRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email.required' => trans('identity::validation.email_required'),
            'email.email' => trans('identity::validation.email_email'),
            'password.required' => trans('identity::validation.password_required'),
            'email' => 'required|email',
            'password' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => trans('identity::validation.email_required'),
            'email.email' => trans('identity::validation.email_email'),
            'password.required' => trans('identity::validation.password_required'),
        ];
    }
}

