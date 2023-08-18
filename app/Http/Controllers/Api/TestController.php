<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Word\CreateRequest;
use App\Http\Requests\Api\Word\PickupRequest;
use App\Models\User;
use App\Repositories\IUserRepo;
use App\Repositories\IWordRepo;
use App\Service\Response\ResponseService;
use Exception;

class WordController extends Controller
{
    public function __construct(private readonly IWordRepo $wordRepo, private readonly IUserRepo $userRepo)
    {
    }

    public function learn()
    {
        try {
            //TODO fix this with auth
            $user = User::find(1);

            $userWordsLearned = $this->userRepo->wordsById($user->id);
            $userWordsLearnedIds = $userWordsLearned->pluck('word_id')->toArray();

            $words = $this->wordRepo->findLearnWords($userWordsLearnedIds);

            return ResponseService::success(trans('api.word.learn.success'), $words);
        } catch (Exception $e) {
            report($e);

            return ResponseService::failure(trans('api.exception'), 500);
        }
    }

    public function pickup(PickupRequest $request)
    {
        try {
            //TODO fix this with auth
            $user = User::find(1);

            $wordCheckExist = $this->wordRepo->findById($request->get('word_id'));
            if (! $wordCheckExist) {
                return ResponseService::failure(trans('api.word.notfound'), 404);
            }

            $userPicked = $this->userRepo->pickedWord($user->id, $wordCheckExist->id);
            if ($userPicked) {
                return ResponseService::failure(trans('api.word.picked'), 422);
            }

            $this->userRepo->pickWord($user->id, $wordCheckExist->id);

            return ResponseService::success(trans('api.word.pickup.success'));
        } catch (Exception $e) {
            report($e);

            return ResponseService::failure(trans('api.exception'), 500);
        }
    }

    public function store(CreateRequest $request)
    {
        try {
            //TODO fix this with auth
            $user = User::find(1);

            $word = $this->wordRepo->findByWord($request->get('word'));
            if ($word) {
                $picked = $this->userRepo->pickedWord($user->id, $word->id);
                if (! $picked) {
                    $this->userRepo->pickWord($user->id, $word->id);
                }

                return ResponseService::failure(trans('api.word.exist'), 200);
            }

            $this->wordRepo->createUserWord($request->get('word'), $request->get('translate'), $user->id);

            return ResponseService::success(trans('api.word.new.success'));
        } catch (Exception $e) {
            report($e);

            return ResponseService::failure(trans('api.exception'), 500);
        }
    }
}
