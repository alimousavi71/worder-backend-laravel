<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\IWordRepo;

class TestController extends Controller
{
    public function __construct(private readonly IWordRepo $wordRepo)
    {
    }

    public function wordOptions()
    {
        return $this->wordRepo->makeOptions([], [], 30);
    }
}
