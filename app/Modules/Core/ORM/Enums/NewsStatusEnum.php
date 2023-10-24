<?php

declare(strict_types=1);

namespace App\Modules\Core\ORM\Enums;

enum NewsStatusEnum:string
{
    case ACTIVE = 'active';
    case IN_ACTIVE = 'inactive';

    /**
     * @return array
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
