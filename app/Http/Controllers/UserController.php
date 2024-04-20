<?php

namespace App\Http\Controllers;

use App\Models\Lucky;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * @var UserService
     */
    protected UserService $service;

    /**
     * @param  UserService  $service
     */
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }


    /**
     * @param  Request  $request
     * @return User
     */
    public function updateLink(Request $request): User
    {
        $user = $request->user();
        return $this->service->updateLink($user);
    }

    /**
     * @param  Request  $request
     * @return bool
     */
    public function deactivateLink(Request $request): bool
    {
        $user = $request->user();
        return $this->service->deactivateLink($user);
    }

    /**
     * @param  Request  $request
     * @return Lucky
     */
    public function lucky(Request $request): Lucky
    {
        return $this->service->luckyNumber($request);
    }

    /**
     * @param  Request  $request
     * @return array
     */
    public function history(Request $request): array
    {
        return $this->service->history($request);
    }
}
