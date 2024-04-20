<?php

namespace App\Services;

use App\DTO\UserDto;
use App\Helpers\LinkHelper;
use App\Helpers\NumberHelper;
use App\Models\Lucky;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserService
{
    /**
     * @var UserRepositoryInterface
     */
    protected UserRepositoryInterface $userRepository;

    /**
     * @var User
     */
    protected User $user;

    /**
     * @param  User  $user
     * @param  UserRepositoryInterface|null  $userRepository
     */
    public function __construct(User $user, UserRepositoryInterface $userRepository = null)
    {
        $this->userRepository = $userRepository;
        $this->user = $user;
    }

    /**
     * @return User
     */
    public function getAttribute(): User
    {
        return $this->user;
    }

    /**
     * @param  User  $user
     * @param  UserDto  $dto
     * @return User
     */
    public function updateUser(User $user, UserDto $dto): User
    {
        $service = new UserService($user);
        $service
            ->changeAttributes($dto)
            ->commitChanges();

        return $service->getAttribute();
    }

    /**
     * @param  UserDto  $dto
     * @return $this
     */
    public function changeAttributes(UserDto $dto): self
    {
        $this->user->fill($dto->toArray());
        return $this;
    }


    /**
     * @return $this
     */
    public function commitChanges(): self
    {
        $this->user->save();
        return $this;
    }

    /**
     * @param  User  $user
     * @return User
     */
    public function updateLink(User $user): User
    {
        $newLinkPageA = LinkHelper::createSignedURL($user);
        return $this->userRepository->updateLink($user, $newLinkPageA);
    }

    /**
     * @param  User  $user
     * @return bool
     */
    public function deactivateLink(User $user): bool
    {
        return $this->userRepository->deactivateLink($user);
    }

    /**
     * @param  Request  $request
     * @return Lucky
     */
    public function luckyNumber(Request $request): Lucky
    {
        $luckyNumber = NumberHelper::randomLuckyNumber();
        if (NumberHelper::isNumberEven($luckyNumber)) {
            $winNumber = NumberHelper::toPercentLucky($luckyNumber);
            return $this->userRepository->luckyUser($request, $luckyNumber, $winNumber);
        }

        return $this->userRepository->luckyUser($request, $luckyNumber);
    }

    /**
     * @param  Request  $request
     * @return array
     */
    public function history(Request $request): array
    {
        $user = $request->user();
        return $this->userRepository->history($user);
    }

}
