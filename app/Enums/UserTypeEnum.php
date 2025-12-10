<?php

namespace App\Enums;

enum UserTypeEnum: string
{
    case Admin = 'ADMIN';
    case CityHall = 'CITY_HALL';
    case Company = 'COMPANY';
    case User = 'USER';
}