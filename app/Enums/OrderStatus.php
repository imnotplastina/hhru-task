<?php

namespace App\Enums;

enum OrderStatus: string
{
    case NEW = 'новый';
    case COMPLETED = 'завершен';

    public static function values(): array
    {
        return array_map(fn(self $case) => $case->value, self::cases());
    }
}
