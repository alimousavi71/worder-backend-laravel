<?php

namespace App\Http\Resources\Api\User\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LoginResponse extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        /**
         * @var $this User
         */
        $r['id'] = $this->id;
        $r['avatar'] = $this->avatar ? asset($this->avatar) : '';
        $r['firstname'] = $this->firstname;
        $r['lastname'] = $this->lastname;

        return $r;
    }
}
