<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\Auth\SocialLogin\GoogleOneTabRequest;
use App\Http\Requests\Api\User\Auth\SocialLogin\LoginRequest;
use App\Http\Resources\Api\User\Auth\LoginResponse;
use App\Repositories\IUserRepo;
use App\Service\Response\ResponseService;
use Exception;
use Google_Client;
use Laravel\Socialite\Facades\Socialite;

class GoogleLoginController extends Controller
{
    public function __construct(private readonly IUserRepo $userRepo)
    {

    }

    public function loginWithTab(GoogleOneTabRequest $request)
    {
        $client = new Google_Client(['client_id' => $request->get('clientId')]);
        $payload = $client->verifyIdToken($request->get('credential'));
        if ($payload) {
            return $this->loginDo(
                $payload['email'],
                $payload['name'],
                $payload['given_name'],
                $payload['picture'],
            );
        } else {
            return ResponseService::failure(trans('api.auth.login.user_notfound'), 404);
        }
    }

    public function loginNormal(LoginRequest $request)
    {
        try {
            $token = $request->get('access_token');
            if ($request->get('credential')) {
                $token = $request->get('credential');
            }

            $userSocial = Socialite::driver('google')
                ->stateless()
                ->userFromToken($token);

            return $this->loginDo(
                $userSocial->getEmail(),
                $userSocial->getName(),
                $userSocial->getNickname(),
                $userSocial->getAvatar(),
            );
        } catch (Exception $e) {
            report($e);

            return ResponseService::failure(trans('api.auth.login.social.filed'), 500);
        }
    }

    private function loginDo($email, $name, $nikName, $avatar)
    {
        $user = $this->userRepo->exist($email);

        if ($user) {
            /* Login Record */
            $this->userRepo->logLogin($user);

            $token = $user->createToken('USER_API_TOKEN', ['user'])->accessToken;
            $data['user'] = new LoginResponse($user);
            $data['token'] = $token;

            return ResponseService::success(trans('api.auth.login.social.success'), $data);
        }

        /* Register New User */
        $lastName = '';
        if (str($name)->contains(' ')) {
            $ex = explode(' ', $name);
            $firstName = $ex[0];
            $lastName = $ex[1];
        } else {
            $firstName = $nikName;
        }
        $user = $this->userRepo->registerSocial($email, $firstName, $lastName);

        if ($avatar) {
            $this->userRepo->updateAvatar($user, $avatar);
        }

        /* Login Record */
        $this->userRepo->logLogin($user);

        $token = $user->createToken('USER_API_TOKEN', ['user'])->accessToken;
        $data['user'] = new LoginResponse($user);
        $data['token'] = $token;

        return ResponseService::success(trans('api.auth.login.social.success'), $data);
    }
}
