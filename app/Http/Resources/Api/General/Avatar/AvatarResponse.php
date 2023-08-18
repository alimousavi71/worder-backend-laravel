<?php

namespace App\Http\Resources\Api\General\Avatar;

use App\Models\Avatar;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AvatarResponse extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array
     */
    public function toArray(Request $request)
    {
        /**
         * @var $this Avatar
         */
        $r['id'] = $this->id;
        $r['icon'] = asset($this->icon);

        return $r;
    }
}
