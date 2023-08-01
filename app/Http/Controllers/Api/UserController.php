<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\User\Word\WordCollection;
use App\Models\User;
use App\Repositories\IUserRepo;
use App\Service\Response\ResponseService;
use Exception;

class UserController extends Controller
{
    public function __construct(private readonly IUserRepo $userRepo)
    {
    }

    public function words()
    {
        try {
            //TODO fix this with auth
            $user = User::find(1);

            return new WordCollection($this->userRepo->words($user));
        } catch (Exception $e) {
            report($e);

            return ResponseService::failure(trans('api.exception'), 500);
        }
    }
}
