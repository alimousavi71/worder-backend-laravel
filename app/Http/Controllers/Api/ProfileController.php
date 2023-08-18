<?php

namespace App\Http\Controllers\Api;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\Profile\PasswordRequest;
use App\Http\Requests\Api\User\Profile\UpdateRequest;
use App\Http\Resources\Api\User\Profile\UserResponse;
use App\Models\User;
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
            //TODO fix this with auth
            $user = User::find(1);

            $counter[] = [
                'title' => trans('api.counter.allWord'),
                'counter' => Helper::abbreviateNumber($this->userRepo->wordsById($user->id)->count()),
                'target' => '',
                'icon' => '/images/t1.png',
            ];

            $counter[] = [
                'title' => trans('api.counter.pendingWord'),
                'counter' => Helper::abbreviateNumber($this->userRepo->pendingWordById($user->id)->count()),
                'target' => '',
                'icon' => '/images/t2.png',
            ];

            $counter[] = [
                'title' => trans('api.counter.learnedWords'),
                'counter' => Helper::abbreviateNumber($this->userRepo->learnWordById($user->id)->count()),
                'target' => '',
                'icon' => '/images/t3.png',
            ];

            $counter[] = [
                'title' => trans('api.counter.exams'),
                'counter' => 0,
                'target' => '',
                'icon' => '/images/t4.png',
            ];

            return ResponseService::success(trans('api.profile.success'), [
                'counters' => $counter,
            ]);

        } catch (Exception $e) {
            report($e);

            return ResponseService::failure(trans('api.exception'), 500);
        }
    }

    public function info()
    {
        try {
            //TODO fix this with auth
            $user = User::withCount('words')->find(1);

            return response()->json([
                'status' => 200,
                'message' => trans('api.profile.info_success'),
                'user' => new UserResponse($user),
            ]);

        } catch (Exception $e) {
            report($e);

            return ResponseService::failure(trans('api.exception'), 500);
        }
    }

    public function signout()
    {
        try {
            auth('sanctum')->user()->tokens()->delete();

            return ResponseService::success(trans('api.profile.signout.success'));

        } catch (Exception $e) {
            report($e);

            return ResponseService::failure(trans('api.exception'), 500);
        }
    }

    public function update(UpdateRequest $request)
    {
        try {
            //TODO fix this with auth
            $user = User::query()->find(1);

            $this->userRepo->updateProfile($user->id, $request->get('firstname'), $request->get('lastname'));

            return ResponseService::success(trans('api.profile.update_success'));

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
