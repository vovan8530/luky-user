<?php

namespace App\Helpers;

class NumberHelper
{
    /**
     * @return int
     */
    public static function randomLuckyNumber(): int
    {
        return rand(1, 1000);
    }

    /**
     * @param  int  $num
     * @return bool
     */
    public static function isNumberEven(int $num): bool
    {
        return $num % 2 === 0;
    }

    /**
     * @param  int  $evenNum
     * @return int
     */
    public static function toPercentLucky(int $evenNum): int
    {
        switch ($evenNum) {
            case $evenNum > 900:
                (int)$winNum = ($evenNum / 100) * 70;
                break;
            case $evenNum > 600:
                (int)$winNum = ($evenNum / 100) * 50;
                break;
            case $evenNum > 300:
                (int)$winNum = ($evenNum / 100) * 30;
                break;
            case $evenNum <= 300:
                (int)$winNum = ($evenNum / 100) * 10;
                break;
        }
        return $winNum;
    }
}
