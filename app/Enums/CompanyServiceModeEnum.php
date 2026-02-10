<?php

namespace App\Enums;
enum CompanyServiceModeEnum: string
{
    case Register = 'REGISTER';
    case Maintenance = 'MAINTENANCE'; 
    case RegisterMaintenance = 'REGISTER_MAINTENANCE';
}
