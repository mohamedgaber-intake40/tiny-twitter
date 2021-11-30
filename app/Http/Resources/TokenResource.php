<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class TokenResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'access_token' => Str::after($this->plainTextToken, '|'),
            'expired_at'   => $this->getTokenExpirationTime(),
        ];
    }

    private function getTokenExpirationTime()
    {
        if (!config('sanctum.expiration'))
            return null;

        return Carbon::parse($this->accessToken->create_at)
                     ->addMinutes(config('sanctum.expiration'));
    }
}
