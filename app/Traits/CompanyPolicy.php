<?php

namespace App\Traits;

use App\Enums\UserTypeEnum;

trait CompanyPolicy
{
    public static function canViewAny(): bool
    {
        return auth()->check()
            && in_array(auth()->user()->type, [UserTypeEnum::Company, UserTypeEnum::CityHall]);
    }
}
    
