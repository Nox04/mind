<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AuthResource.
 * @property mixed token
 * @property string name
 * @property string email
 * @property mixed id
 */
class AuthResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'name' => $this->name,
            'token' => $this->token->accessToken,
            'expires_at' => $this->token->token->expires_at,
        ];
    }
}
