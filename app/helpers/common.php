<?php

use App\Models\Role;

if (!function_exists('getDefaultRole')) {
    function getDefaultRole()
    {
        return Role::where('name', Role::DEFAULT_ROLE)->select('id')->first()->id;
    }
}
