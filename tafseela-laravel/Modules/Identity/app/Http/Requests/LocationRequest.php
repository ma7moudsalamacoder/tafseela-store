<?php

namespace Modules\Identity\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LocationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'type' => 'required|string|in:home,work,other',
            'label' => 'nullable|string|max:100',
            'recipient_name' => 'required|string|max:100',
            'recipient_phone' => 'required|string|max:20',
            'country_id' => 'nullable|exists:countries,id',
            'city_id' => 'nullable|exists:cities,id',
            'state' => 'nullable|string|max:100',
            'district' => 'nullable|string|max:100',
            'street' => 'nullable|string|max:255',
            'address_line_1' => 'nullable|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'building_no' => 'nullable|string|max:50',
            'floor_no' => 'nullable|string|max:20',
            'apartment_no' => 'nullable|string|max:20',
            'postal_code' => 'nullable|string|max:20',
            'landmark' => 'nullable|string|max:255',
            'latitude' => 'nullable|between:-90,90',
            'longitude' => 'nullable|between:-180,180',
            'delivery_notes' => 'nullable|string|max:500',
            'is_default' => 'nullable|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'type.required' => trans('identity::validation.type_required'),
            'type.in' => trans('identity::validation.type_in'),
            'label.max' => trans('identity::validation.label_max'),
            'recipient_name.required' => trans('identity::validation.recipient_name_required'),
            'recipient_name.max' => trans('identity::validation.recipient_name_max'),
            'recipient_phone.required' => trans('identity::validation.recipient_phone_required'),
            'recipient_phone.max' => trans('identity::validation.recipient_phone_max'),
            'country_id.exists' => trans('identity::validation.country_id_exists'),
            'city_id.exists' => trans('identity::validation.city_id_exists'),
            'state.max' => trans('identity::validation.state_max'),
            'district.max' => trans('identity::validation.district_max'),
            'street.max' => trans('identity::validation.street_max'),
            'address_line_1.max' => trans('identity::validation.address_line_1_max'),
            'address_line_2.max' => trans('identity::validation.address_line_2_max'),
            'building_no.max' => trans('identity::validation.building_no_max'),
            'floor_no.max' => trans('identity::validation.floor_no_max'),
            'apartment_no.max' => trans('identity::validation.apartment_no_max'),
            'postal_code.max' => trans('identity::validation.postal_code_max'),
            'landmark.max' => trans('identity::validation.landmark_max'),
            'latitude.between' => trans('identity::validation.latitude_between'),
            'longitude.between' => trans('identity::validation.longitude_between'),
            'delivery_notes.max' => trans('identity::validation.delivery_notes_max'),
            'is_default.boolean' => trans('identity::validation.is_default_boolean'),
        ];
    }
}

