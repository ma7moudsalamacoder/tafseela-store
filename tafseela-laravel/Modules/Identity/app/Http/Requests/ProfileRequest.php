<?php

namespace Modules\Identity\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'phone' => 'nullable|string|max:20',
            'country_id' => 'nullable|exists:countries,id',
            'city_id' => 'nullable|exists:cities,id',
            'date_of_birth' => 'nullable|date_format:Y-m-d|before:today',
            'gender' => 'nullable|string|in:male,female,other',
            'bio' => 'nullable|string|max:500',
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required' => trans('identity::validation.first_name_required'),
            'first_name.max' => trans('identity::validation.first_name_max'),
            'last_name.required' => trans('identity::validation.last_name_required'),
            'last_name.max' => trans('identity::validation.last_name_max'),
            'phone.max' => trans('identity::validation.phone_max'),
            'country_id.exists' => trans('identity::validation.country_id_exists'),
            'city_id.exists' => trans('identity::validation.city_id_exists'),
            'date_of_birth.date_format' => trans('identity::validation.date_of_birth_date_format'),
            'date_of_birth.before' => trans('identity::validation.date_of_birth_before'),
            'gender.in' => trans('identity::validation.gender_in'),
            'bio.max' => trans('identity::validation.bio_max'),
        ];
    }
}

