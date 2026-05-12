<?php

namespace Modules\Order\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'status' => $this->status,
            'promo_code' => $this->promo_code,
            'grand_total' => $this->grand_total,
            'discount' => $this->discount,
            'tax' => $this->tax,
            'details' => OrderDetailResource::collection($this->whenLoaded('details')),
            'created_at' => $this->created_at,
        ];
    }
}
