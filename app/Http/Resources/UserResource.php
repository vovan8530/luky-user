<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * @param  Request  $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        /* @var User|self $this */
        return [
            'id' => $this->id,
            'type' => $this->type,
            'link_page_a' => $this->link_page_a,
            'name' => $this->name,
            'phone' => $this->phone,
        ];
    }
}
