<?php

use App\Models\Role;

if(!function_exists('getDefaultRole'))
{
    function getDefaultRole()
    {
        return Role::where('name','customer')->select('id')->first()->id;
    }
}