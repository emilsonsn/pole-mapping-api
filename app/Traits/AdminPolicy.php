<?php

namespace App\Traits;

trait AdminPolicy
{
    public static function canViewAny(): bool
    {
        return auth()->check()
            && auth()->user()->type === \App\Enums\UserTypeEnum::Admin;
    }
}
    
