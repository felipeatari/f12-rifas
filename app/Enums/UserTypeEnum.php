<?php

namespace App\Enums;

enum UserTypeEnum: string
{
    case Admin = 'admin';
    case Client = 'client';
    case Afilliate = 'affiliate';
}
