<?php

namespace App\Enums;

enum PostStatusEnum: string
{
    case DRAFT = 'draft';
    case PUBLISHED = 'published';

    public static function values(): array
    {
        return [
            self::DRAFT->value,
            self::PUBLISHED->value
        ];
    }
}