<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\Auth\Normal\ResetRequest;
use App\Notifications\User\Auth\ResetSuccess;
use App\Repositories\IUserRepo;
use App\Service\Response\ResponseService;
use DB;
use Exception;

class ResetController extends Controller
{
    public function __construct(private readonly IUserRepo $userRepo)
    {

    }

    public function reset(ResetRequest $request)
    {
        try {
            DB::beginTransaction();
            $user = $this->userRepo->exist($request->get('email'));
            if (! $user) {
                return ResponseService::failure(trans('api.auth.reset.email_notfound'), 404);
            }

            $otpCode = $this->userRepo->checkOtpVerify($user->email, $request->get('code'));
            if (! $otpCode) {
                return ResponseService::failure(trans('api.auth.reset.code_invalidate'), 404);
            }

            $this->userRepo->updatePassword($user->id, $request->get('password'));

            $this->userRepo->checkOtpRemove($user->email);
            DB::commit();
            $user->notify(new ResetSuccess());

            return ResponseService::success(trans('api.auth.reset.success'));
        } catch (Exception $e) {
            DB::rollBack();
            report($e);

            return ResponseService::failure(trans('api.exception'), 500);

        }
    }
}
