<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\Profile\PasswordRequest;
use App\Http\Requests\Api\User\Profile\UpdateRequest;
use App\Repositories\IUserRepo;
use App\Service\Response\ResponseService;
use Exception;

class ProfileController extends Controller
{
    public function __construct(private readonly IUserRepo $userRepo)
    {
    }

    public function index()
    {
        try {
            $user = auth('sanctum')->user();

            $data['words_count'] = $this->userRepo->wordsById($user->id)->count();
            $data['words_learned_count'] = $this->userRepo->learnWordById($user->id)->count();
            $data['words_pending_count'] = $this->userRepo->pendingWordById($user->id)->count();
            $data['exams_count'] = 0;

            return ResponseService::success(trans('api.profile.success'), $data);

        } catch (Exception $e) {
            report($e);

            return ResponseService::failure(trans('api.exception'), 500);
        }
    }

    public function update(UpdateRequest $request)
    {
        try {
            $user = auth('sanctum')->user();

            $this->userRepo->updateProfile($user->id, $request->get('firstname'), $request->get('lastname'));

            return ResponseService::success(trans('api.profile.update.success'));

        } catch (Exception $e) {
            report($e);

            return ResponseService::failure(trans('api.exception'), 500);
        }
    }

    public function updatePassword(PasswordRequest $request)
    {
        try {
            $user = auth('sanctum')->user();

            $this->userRepo->updatePassword($user->id, $request->get('password'));

            return ResponseService::success(trans('api.profile.password.success'));

        } catch (Exception $e) {
            report($e);

            return ResponseService::failure(trans('api.exception'), 500);
        }
    }
}
