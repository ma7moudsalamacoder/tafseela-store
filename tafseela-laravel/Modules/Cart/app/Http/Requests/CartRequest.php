<?php

namespace Modules\Cart\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'product_id' => 'required|integer|exists:products,id',
            'product_detail_id' => 'nullable|integer|exists:product_details,id',
            'quantity' => 'required|integer|min:1',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
