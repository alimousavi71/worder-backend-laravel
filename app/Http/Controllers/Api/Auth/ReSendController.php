<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\Auth\Normal\ResendRequest;
use App\Notifications\User\Auth\ResendCode;
use App\Repositories\IUserRepo;
use App\Service\Response\ResponseService;
use Exception;

class ReSendController extends Controller
{
    public function __construct(private readonly IUserRepo $userRepo)
    {

    }

    public function resend(ResendRequest $request)
    {
        try {
            $user = $this->userRepo->exist($request->get('email'));
            if (! $user) {
                return ResponseService::failure(trans('api.auth.resend.email_notfound'), 404);
            }

            $otpCode = $this->userRepo->checkOtpExist($user->email);
            if ($otpCode) {
                return ResponseService::success(trans('api.auth.resend.sent'), 200);
            }

            $otpCode = $this->userRepo->creatOtpCode($user->email);

            $user->notify(new ResendCode($otpCode->code));

            return ResponseService::success(trans('api.auth.resend.success'), 404);
        } catch (Exception $e) {
            report($e);

            return ResponseService::failure(trans('api.auth.resend.filed'), 500);

        }
    }
}
