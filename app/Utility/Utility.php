<?php

namespace App\Utility;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Utility
{
    /**
     * Converts a time in the format H:i:s.z to the equivalent number of milliseconds
     */
    private static function to_millis(string $date):int
    {
        list($H, $i, $s, $z) = \preg_split("/[:.]/", $date);
        return (int) $H * 3600000 + (int) $i * 60000 + (int) $s * 1000 + (int) $z;
    }

    /**
     * Converts number of milliseconds to the equivalent time in the format H:i:s.z
     */
    private static function to_time(int $millis):string
    {
        $H = $millis >= 3600000 ? (int) \strval($millis / 3600000) : '00';
        $i = $millis >= 60000 ? \strval($millis / 60000 % 60) : '00';
        $s = $millis >= 1000 ? \strval($millis / 1000 % 60): '00';
        $z = \strval($millis % 1000);
        $H = str_pad($H, 2, "0", STR_PAD_LEFT);
        $i = str_pad($i, 2, "0", STR_PAD_LEFT);
        $s = str_pad($s, 2, "0", STR_PAD_LEFT);
        $z = str_pad($z, 3, "0", STR_PAD_LEFT);
        return $H.':'.$i.':'.$s.'.'.$z;
    }

    /**
     * Sums 2 times in the format H:i:s.z
     */
    public static function sum_time(string $time1, string $time2, string $operation = '+'):string
    {
        $t1 = self::to_millis($time1);
        $t2 = self::to_millis($time2);
        $t_tot = '';
        if ($operation == '+') {
            $t_tot = self::to_time($t1 + $t2);
        }else if($operation == '-') {
            $t_tot = self::to_time($t1 - $t2);
        }
        return $t_tot;
    }
}
