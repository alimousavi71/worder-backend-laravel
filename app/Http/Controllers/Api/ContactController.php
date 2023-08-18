<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Contact\StoreRequest;
use App\Models\User;
use App\Repositories\IContactRepo;
use App\Service\Response\ResponseService;
use Exception;

class ContactController extends Controller
{
    public function __construct(private readonly IContactRepo $contactRepo)
    {
    }

    public function save(StoreRequest $request)
    {
        try {
            //TODO fix this with auth
            $user = User::find(1);

            $this->contactRepo->save([
                'comment' => $request->get('comment'),
                'user_id' => $user->id,
                'rate' => $request->get('rate'),
                'is_seen' => false,
                'is_public' => false,
                'is_collaboration' => $request->get('is_collaboration', false),
                'agent' => $request->userAgent(),
            ]);

            return ResponseService::success(trans('api.contact.success'));
        } catch (Exception $e) {
            report($e);

            return ResponseService::failure(trans('api.exception'), 500);
        }
    }
}
