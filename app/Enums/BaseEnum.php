<?php

namespace App\Enums;

abstract class BaseEnum
{
    /**
     * Get all constants of the class.
     *
     * @return array
     */
    public static function getConstants(): array
    {
        try {
            $reflection = new \ReflectionClass(static::class);
            return $reflection->getConstants();
        } catch (\ReflectionException $exception) {
            return [];
        }
    }

}
