<?php

use App\Enums\DayInLettersEnum;
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

if (!function_exists('castDateStringForRequestDocs')) {
    function castDateStringForRequestDocs(string $date)
    {
        $carbon = Carbon::parse($date);

        return ucfirst($carbon->localeDayOfWeek) . ' ' .  $carbon->day . ' de ' . ucfirst($carbon->monthName)  . ' del ' . $carbon->year;
    }
}


/**
 *  create dates in this format ejem:
 *  uno de diciembre del dos mil veintidós 
 */
if (!function_exists('castDateStringForMinutes')) {
    function castDateStringForMinutes(string $date): string
    {
        $carbon = Carbon::parse($date);

        $dayInLetters  = castDateInLetters($carbon->day);
      

        return ucfirst($dayInLetters) . ' de ' . ucfirst($carbon->monthName) . ' del ' . $carbon->year;
    }
}


/**
 * Cast date int in letters
 */
if (!function_exists('castDateInLetters')) {
    function castDateInLetters(int $date): string
    {
        switch ($date) {
            case 1:
                return DayInLettersEnum::UNO->value;
            case 2:
                return DayInLettersEnum::DOS->value;
            case 3:
                return DayInLettersEnum::TRES->value;
            case 4:
                return DayInLettersEnum::CUATRO->value;
            case 5:
                return DayInLettersEnum::CINCO->value;
            case 6:
                return DayInLettersEnum::SEIS->value;
            case 7:
                return DayInLettersEnum::SIETE->value;
            case 8:
                return DayInLettersEnum::OCHO->value;
            case 9:
                return DayInLettersEnum::NUEVE->value;
            case 10:
                return DayInLettersEnum::DIEZ->value;
            case 11:
                return DayInLettersEnum::ONCE->value;
            case 12:
                return DayInLettersEnum::DOCE->value;
            case 13:
                return DayInLettersEnum::TRECE->value;
            case 14:
                return DayInLettersEnum::CATORCE->value;
            case 15:
                return DayInLettersEnum::QUINCE->value;
            case 16:
                return DayInLettersEnum::DIECI_SEIS->value;
            case 17:
                return DayInLettersEnum::DIECI_SIETE->value;
            case 18:
                return DayInLettersEnum::DIECI_OCHO->value;
            case 19:
                return DayInLettersEnum::DIECI_NUEVE->value;
            case 20:
                return DayInLettersEnum::VEINTE->value;
            case 21:
                return DayInLettersEnum::VEINTI_UNO->value;
            case 22:
                return DayInLettersEnum::VEINTI_DOS->value;
            case 23:
                return DayInLettersEnum::VEINTI_TRES->value;
            case 24:
                return DayInLettersEnum::VEINTI_CUATRO->value;
            case 25:
                return DayInLettersEnum::VEINTI_CINCO->value;
            case 26:
                return DayInLettersEnum::VEINTI_SEIS->value;
            case 27:
                return DayInLettersEnum::VEINTI_SIETE->value;
            case 28:
                return DayInLettersEnum::VEINTI_OCHO->value;
            case 29:
                return DayInLettersEnum::VEINTI_NUEVE->value;
            case 30:
                return DayInLettersEnum::TREINTA->value;
            case 31:
                return DayInLettersEnum::TREINTA_UNO->value;

            default:
                return DayInLettersEnum::UNO->value;
        }
    }
}


if (!function_exists('castYearInletters')) {
    function castYearInletters(int $year)
    {
        $unidades = ['', 'uno', 'dos', 'tres', 'cuatro', 'cinco', 'seis', 'siete', 'ocho', 'nueve'];
        $decenas = ['', '', 'veinte', 'treinta', 'cuarenta', 'cincuenta', 'sesenta', 'setenta', 'ochenta', 'noventa'];

        $anioEnLetras = '';

        $anio = str_pad($year, 4, '0', STR_PAD_LEFT);

        // Obtén las unidades y decenas de cada dígito del año
        $unidadMil = $unidades[$anio[0]];
        $decenaCentena = $decenas[$anio[1]];
        $unidadCentena = $unidades[$anio[2]];
        $unidadDecena = $unidades[$anio[3]];

        // Construye la representación en letras del año
        $anioEnLetras .= $unidadMil != '' ? $unidadMil . ' mil ' : '';
        $anioEnLetras .= $decenaCentena != '' ? $decenaCentena . ' ' : '';
        $anioEnLetras .= $unidadCentena != '' ? $unidadCentena . ' ' : '';

        // Agrega el "y" si hay decenas y unidades
        if ($decenaCentena != '' && $unidadDecena != '') {
            $anioEnLetras .= 'y ';
        }

        $anioEnLetras .= $unidadDecena != '' ? $unidadDecena : '';

        return $anioEnLetras;
    }
}
