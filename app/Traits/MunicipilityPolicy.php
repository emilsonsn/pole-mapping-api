<?php

namespace App\Traits;

trait MunicipilityPolicy
{
    public static function canViewAny(): bool
    {
        return auth()->check()
            && auth()->user()->type === \App\Enums\UserTypeEnum::CityHall;
    }
}
    
