<?php

declare(strict_types=1);

namespace App\Modules\Api\News\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                => $this->getId(),
            'url'               => $this->getUrl(),
            'title'             => $this->getTitle(),
            'short_description' => $this->getShortDescription(),
            'text'              => $this->getText(),
            'status'            => $this->getStatus(),
            'created_at'        => $this->getCreatedAt(),
        ];
    }
}
