<?php

namespace Gamer\Services;

class MenuService
{

    /**
     * @return array[]
     *
     * @psalm-return non-empty-list<array<empty, empty>>
     */
    public static function getAdminMenu(): array
    {
        $gamer = [];
        $gamer[] = [
        ];

        return $gamer;
    }
}
