<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\Auth\Normal\ForgetRequest;
use App\Notifications\User\Auth\ForgetCode;
use App\Repositories\IUserRepo;
use App\Service\Response\ResponseService;
use Exception;

class ForgetController extends Controller
{
    public function __construct(private readonly IUserRepo $userRepo)
    {

    }

    public function forget(ForgetRequest $request)
    {
        try {
            $user = $this->userRepo->exist($request->get('email'));
            if (! $user) {
                return ResponseService::failure(trans('api.auth.forget.email_notfound'), 404);
            }

            $otpCode = $this->userRepo->checkOtpExist($user->email);

            if ($otpCode) {
                return ResponseService::success(trans('api.auth.forget.sent'), 200);
            }

            $otpCode = $this->userRepo->creatOtpCode($user->email);

            $user->notify(new ForgetCode($otpCode->code));

            return ResponseService::success(trans('api.auth.forget.success'));
        } catch (Exception $e) {
            report($e);

            return ResponseService::failure(trans('api.auth.forget.filed'), 500);

        }
    }
}
