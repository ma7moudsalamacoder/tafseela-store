<?php

namespace Modules\Order\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'product' => $this->product,
            'qty' => $this->qty,
            'price' => $this->price,
            'discount' => $this->discount,
            'subtotal' => $this->price * $this->qty,
        ];
    }
}
