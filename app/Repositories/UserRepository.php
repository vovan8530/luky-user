<?php

namespace App\Repositories;

use App\Models\Lucky;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;


class UserRepository implements UserRepositoryInterface
{
    /**
     * @param  User  $user
     * @param  string  $newLinkPageA
     * @return User
     */
    public function updateLink(User $user, string $newLinkPageA): User
    {
        return $user
            ->updateOrCreate(
                ['id' => $user->id],
                ['link_page_a' => $newLinkPageA, 'is_active' => 1]
            );
    }

    /**
     * @param  User  $user
     * @return bool
     */
    public function deactivateLink(User $user): bool
    {
        return $user->update(['is_active' => 0]);
    }


    /**
     * @param  Request  $request
     * @param  int  $luckyNumber
     * @param  int  $winNumber
     * @return Lucky
     */
    public function luckyUser(Request $request, int $luckyNumber, int $winNumber = 0): Lucky
    {
        return Lucky::create(
            [
                'lucky_number' => $luckyNumber,
                'winning_number' => $winNumber,
                'user_id' => $request->user()->id
            ]
        );
    }

    /**
     * @param  User  $user
     * @return array
     */
    public function history(User $user): array
    {

        return Lucky::query()
            ->where('user_id', $user->id)
            ->select('lucky_number', 'winning_number')
            ->latest()
            ->take(3)
            ->get()
            ->toArray();
    }
}
