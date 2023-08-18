<?php

namespace App\Http\Controllers\Api;

use App\Enums\Database\Contact\ERate;
use App\Enums\Database\Exam\ExamType;
use App\Enums\Database\Exam\RepositoryType;
use App\Enums\Database\WordReport\EWordReportReason;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\General\Avatar\AvatarResponse;
use App\Models\Avatar;
use App\Service\Response\ResponseService;
use Exception;

class GeneralController extends Controller
{
    public function index()
    {
        try {
            $data['examTypes'] = ExamType::asApi();
            $data['repository'] = RepositoryType::asApi();
            $data['reportTypes'] = EWordReportReason::asApi();
            $data['rates'] = ERate::asApi();
            $data['avatars'] = AvatarResponse::collection(Avatar::query()->get());

            return ResponseService::success(trans('api.general.success'), $data);
        } catch (Exception $e) {
            report($e);

            return ResponseService::failure(trans('api.exception'), 500);
        }
    }
}
