<?php

namespace App\Repositories\Interfaces;


use App\Models\Lucky;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;


interface UserRepositoryInterface
{
    /**
     * @param  User  $user
     * @param  string  $newLinkPageA
     * @return User
     */
    public function updateLink(User $user, string $newLinkPageA): User;

    /**
     * @param  User  $user
     * @return bool
     */
    public function deactivateLink(User $user): bool;

    /**
     * @param  Request  $request
     * @param  int  $luckyNumber
     * @param  int  $winNumber
     * @return Lucky
     */
    public function luckyUser(Request $request, int $luckyNumber, int $winNumber = 0): Lucky;

    /**
     * @return mixed
     */
    public function history(User $user): array;
}

