<?php
namespace Modules\User\App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DepositResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user' => [
                'id' => $this->user->id ?? null,
                'name' => $this->user->name ?? null,
                'mobile' => $this->user->mobile ?? null,
            ],
            'amount' => $this->amount,
            'type' => $this->type,
            'status' => $this->status,
            'image_url' => $this->getFirstMediaUrl('receipts'), 
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}