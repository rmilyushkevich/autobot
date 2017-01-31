<?php

namespace App\Helpers;

use Carbon\Carbon;

class YearHelper
{
    public static function getYears($from = 1980)
    {
        $currentYear = Carbon::now()->year;
        return range($from, $currentYear);
    }
}