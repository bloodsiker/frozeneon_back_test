<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * @var UserService
     */
    private $service;

    /**
     * @param  UserService  $userService
     */
    public function __construct(UserService $userService)
    {
        $this->service = $userService;
    }

    /**
     * @param  ProfileRequest  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function addMoney(ProfileRequest $request)
    {
        // TODO: task 4, пополнение баланса

        $result = $this->service->addMoney((float) $request->get('sum'));

        return response()->json($result);
    }
}
