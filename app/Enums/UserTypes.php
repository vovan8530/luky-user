<?php

namespace App\Enums;

class UserTypes extends BaseEnum
{

    const int ADMIN = 1;

    const int USER = 2;

    /**
     * @var string[]
     */
    public static array $LABELS = [
        self::ADMIN => 'Admin',
        self::USER => 'User',
    ];
}
