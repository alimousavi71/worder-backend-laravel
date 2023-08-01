<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\Auth\Normal\LoginRequest;
use App\Http\Resources\Api\User\Auth\LoginResponse;
use App\Models\User;
use App\Repositories\IUserRepo;
use App\Service\Response\ResponseService;
use Exception;
use Hash;

class LoginController extends Controller
{
    public function __construct(private readonly IUserRepo $userRepo)
    {

    }

    public function login(LoginRequest $request)
    {
        try {

            /*User::query()->update([
                'password' => bcrypt('12345678')
            ]);*/

            $user = $this->userRepo->exist($request->get('email'));
            if (! $user) {
                return ResponseService::failure(trans('api.auth.login.email_notfound'), 404);
            }
            if (! Hash::check($request->get('password'), $user->password)) {
                return ResponseService::failure(trans('api.auth.login.password_invalidate'), 404);
            }

            /* Login Record */
            $this->userRepo->logLogin($user);

            $token = $user->createToken('USER_API_TOKEN', ['user'])->plainTextToken;
            $data['user'] = new LoginResponse($user);
            $data['token'] = $token;

            return ResponseService::success(trans('api.auth.login.success'), $data);
        } catch (Exception $e) {
            report($e);

            return ResponseService::failure(trans('api.auth.login.filed'), 500);
        }
    }
}
