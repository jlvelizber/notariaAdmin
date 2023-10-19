<?php

use App\Models\Role;
use Carbon\Carbon;

if (!function_exists('getDefaultRole')) {
    function getDefaultRole()
    {
        return Role::where('name', Role::DEFAULT_ROLE)->select('id')->first()->id;
    }
}


if (!function_exists('checkValidDate')) {
    function checkValidDate(string $date, string $format = 'Y-m-d')
    {
        $d = DateTime::createFromFormat($format, $date);
        // The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
        return $d && $d->format($format) === $date;
    }
}

if(!function_exists('castDateStringForRequestDocs')) 
{
    function castDateStringForRequestDocs(string $date)
    {
        $carbon = Carbon::parse($date);

        return ucfirst($carbon->localeDayOfWeek) .' '.  $carbon->day .' de '. ucfirst($carbon->monthName)  .' de '. $carbon->year;
    }
}
