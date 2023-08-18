<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Exam\StoreRequest;
use App\Repositories\IExamRepo;
use App\Service\Response\ResponseService;

class ExamController extends Controller
{
    public function __construct(private readonly IExamRepo $examRepo)
    {
    }

    public function create(StoreRequest $request)
    {
        try {
            $user = auth('sanctum')->user();

            return ResponseService::success(trans('api.exam.success'));
        } catch (\Exception $e) {
            report($e);

            return ResponseService::failure(trans('api.exception'), 500);
        }
    }
}
