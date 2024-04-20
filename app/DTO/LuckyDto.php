<?php

namespace App\DTO;

use AllowDynamicProperties;
use App\Helpers\ArrayHelper;
use Illuminate\Contracts\Support\Arrayable;

#[AllowDynamicProperties]
class LuckyDto implements Arrayable
{

    /**
     * @var int
     */
    protected int $lucky_number;

    /**
     * @var int
     */
    protected int $winning_number;

    /**
     * @var int
     */
    protected int $user_id;


    /**
     * LuckyDto constructor.
     *
     * @param  int  $luckyNumber
     * @param  int  $winningNumber
     * @param  int  $userId
     */
    public function __construct(
        int $luckyNumber,
        int $winningNumber,
        int $userId,
    ) {
        $this->luckyNumber = $luckyNumber;
        $this->winningNumber = $winningNumber;
        $this->userId = $userId;
    }

    /**
     * @return int
     */
    public function getLuckyNumber(): int
    {
        return $this->luckyNumber;
    }

    /**
     * @return int
     */
    public function getWinningNumber(): int
    {
        return $this->winningNumber;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }


    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'lucky_number' => $this->luckyNumber,
            'winning_number' => $this->winningNumber,
            'user_id' => $this->userId,
        ];
    }

    /**
     * @param  array  $attributes
     * @return LuckyDto
     */
    public static function createFromArray(array $attributes): self
    {
        return new self(
            (int) ArrayHelper::getNotEmptyValue($attributes, 'lucky_number'),
            (int) ArrayHelper::getNotEmptyValue($attributes, 'winning_number'),
            (int) ArrayHelper::getNotEmptyValue($attributes, 'user_id'),
        );
    }
}

