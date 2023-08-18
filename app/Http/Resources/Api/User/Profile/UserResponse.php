<?php

namespace App\Http\Resources\Api\User\Profile;

use App\Helper\Helper;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResponse extends JsonResource
{
    public function toArray($request)
    {
        /**
         * @var $this User
         */
        $r['id'] = $this->id;
        $r['firstname'] = $this->firstname;
        $r['lastname'] = $this->lastname;
        $r['avatar'] = $this->avatar ? asset($this->avatar) : asset('default/avatar.jpeg');
        $r['email'] = $this->email;

        if ($this->loadCount('words')) {
            $r['allWords'] = Helper::abbreviateNumber($this->words_count);
        }

        return $r;
    }
}
