<?php

namespace App\Enums;

enum UserRole: string
{
    case developer = 'developer';
    case admin = 'admin';
    case tester = 'tester';
}
