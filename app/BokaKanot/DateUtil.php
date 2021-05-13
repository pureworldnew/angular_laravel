<?php namespace App\BokaKanot;

class DateUtil
{
    public function diffHours($startDateTimeString, $endDateTimeString)
    {
        $startDateTime = new \DateTime($startDateTimeString);
        $endDateTime = new \DateTime($endDateTimeString);

        $diff = $endDateTime->diff($startDateTime);
        //dd($diff->h);
        $totalPrice = 0;

        $hours = $this->calcHours($diff->h, $diff->m, $diff->s);

        return $hours;
    }

    public function diffDays($startDateTimeString, $endDateTimeString)
    {
        $startDateTime = new \DateTime($startDateTimeString);
        $endDateTime = new \DateTime($endDateTimeString);

        $diff = $endDateTime->diff($startDateTime);

        $days = $this->calcDays($diff->d, $diff->h, $diff->m, $diff->s);

        return $days;
    }

    private function calcHours($h, $m, $s)
    {
        $hours = $h;

        if(!($m == 0 AND $s == 0))
        {
            $hours = $hours + 1;
        }

        return $hours;
    }

    private function calcDays($d, $h, $m, $s)
    {
        $days = $d;

        if(!($h == 0 ANd $m == 0 AND $s == 0))
        {
            $days = $days + 1;
        }

        return $days;
    }


    public static function days_diff($d1, $d2) {
        $x1 = DateUtil::days($d1);
        $x2 = DateUtil::days($d2);

        if ($x1 && $x2) {
            return abs($x1 - $x2);
        }
    }

    public static function days($x) {

        if (get_class($x) != 'DateTime') {
            return false;
        }

        $y = $x->format('Y') - 1;
        $days = $y * 365;
        $z = (int)($y / 4);
        $days += $z;
        $z = (int)($y / 100);
        $days -= $z;
        $z = (int)($y / 400);
        $days += $z;
        $days += $x->format('z');

        return $days;
    }
}