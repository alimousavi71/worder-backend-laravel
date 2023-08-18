<?php

namespace App\Http\Controllers\Api;

use App\Enums\Database\Exam\RepositoryType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Exam\StoreRequest;
use App\Http\Requests\Api\Exam\WordRequest;
use App\Repositories\IExamRepo;
use App\Repositories\IUserRepo;
use App\Repositories\IWordRepo;
use App\Service\Response\ResponseService;
use Exception;

class ExamController extends Controller
{
    public function __construct(private readonly IExamRepo $examRepo, private readonly IWordRepo $wordRepo, private readonly IUserRepo $userRepo)
    {
    }

    public function words(WordRequest $request)
    {
        try {
            $user = auth('sanctum')->user();

            $nowWords = $this->userRepo
                ->wordsById($user->id);

            $data = [];

            $data['words'] = [];
            switch ($request->get('repository')) {
                case RepositoryType::MyWord:
                    $ids = $nowWords->shuffle()->pluck('word_id')->toArray();
                    $data['words'] = $this->wordRepo->makeOptions($ids, [], 30, true);
                    break;

                case RepositoryType::Random:
                    $ids = $nowWords->pluck('word_id')->toArray();
                    $data['words'] = $this->wordRepo->makeOptions([], $ids, 30, true);
                    break;

                case RepositoryType::LowRepetition:
                    $ids = $nowWords->sortBy('repeat')->pluck('word_id')->toArray();
                    $data['words'] = $this->wordRepo->makeOptions($ids, [], 30, false, true);
                    break;

                case RepositoryType::Repetitive:
                    $ids = $nowWords->sortByDesc('repeat')->pluck('word_id')->toArray();
                    $data['words'] = $this->wordRepo->makeOptions($ids, [], 30, false, true);
                    break;

                case RepositoryType::Harder:
                    $ids = $nowWords->sortByDesc('wrong_answer')->pluck('word_id')->toArray();
                    $data['words'] = $this->wordRepo->makeOptions($ids, [], 30, false, true);
                    break;

            }
            $data['count'] = count($data['words']);

            return ResponseService::success(trans('api.exam.word.success'), $data);
        } catch (Exception $e) {
            report($e);

            return ResponseService::failure(trans('api.exception'), 500);

        }
    }

    public function save(StoreRequest $request)
    {
        try {
            $user = auth('sanctum')->user();

            return ResponseService::success(trans('api.exam.success'));
        } catch (Exception $e) {
            report($e);

            return ResponseService::failure(trans('api.exception'), 500);
        }
    }
}
