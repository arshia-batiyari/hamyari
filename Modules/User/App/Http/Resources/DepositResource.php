<?php 
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DepositResource extends JsonResource
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
            'user' => [
                'id' => $this->user->id ?? null,
                'name' => $this->user->name ?? null,
                'mobile' => $this->user->mobile ?? null,
            ],
            'amount' => $this->amount,
            'type' => $this->type,
            'status' => $this->status,
            'image_url' => $this->getFirstMediaUrl('receipts'), 
        ];
    }

    private function getImageUrl(): ?string
    {
        if ($this->type === 'receipt' && $this->image_path ?? false) {
            return asset('storage/' . $this->image_path);
        }
        
        return null;
    }
}