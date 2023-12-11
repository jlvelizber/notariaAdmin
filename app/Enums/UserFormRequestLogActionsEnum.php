<?php

namespace App\Enums;

enum  UserFormRequestLogActionsEnum: string
{
    case CREATE = 'create';
    case UPDATE = 'update';
    case DESTROY = 'destroy';
}
