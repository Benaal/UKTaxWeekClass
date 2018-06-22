<?php
/* This file is part of the UK Tax Weeks Class found at
 * www.whitehurstmedia.co.uk
 *
 * Copyright (C) 2018 Kay Whitehurst - All Rights Reserved
 * You may use, distribute and modify this code under the
 * terms of the GPL 3.0 license, which can be found at
 * https://www.gnu.org/licenses/gpl-3.0.en.html
 *
 * Please consider appropriate references and credits.
 */

class UKTaxWeeks
{
    public function getTaxWeekByDate($wDate, $floorDate = '06/04')
    {
        /*
          * Get the Tax week number based upon $wDate - The date you're querying -
          * and optionally $floorDate, which defaults to the UK tax start
          * date of 06/04
          */

        //because we use the UK date format dd/mm/yyyy, convert this to US mm/dd/yyyy
        $bits = explode('/', $wDate);
        $wDate = $bits[1].'/'.$bits[0].'/'.$bits[2];

        //convert the provided date to a query string/timestamp
        $qDate = strtotime($wDate);

        //Calculate This Day, This Month and This Year from current datetime
        $tDay = date('d', $qDate);
        $tMonth = date('m', $qDate);
        $tYear = date('Y', $qDate);

        //Calculate Comparison Day and Comparison Month from floorDate
        $floorBits = explode('/', $floorDate);
        $cDay = $floorBits[0];
        $cMonth = $floorBits[1];

        $floorDate = $floorBits[1].'/'.$floorBits[0];

        //decide whether the start of the tax year for the given date was this calendar year or last
        if ((int) $tMonth > (int) $cMonth) {
            $scenario = 1;
        } elseif ($tMonth == $cMonth) {
            if ($tDay >= $cDay) {
                $scenario = 1;
            } else {
                $scenario = 2;
            }
        } elseif ($tMonth < $cMonth) {
            $scenario = 2;
        }

        if ($scenario == 1) {
            //Today is in year 1 - Start of the tax year is in this calendar year
            $offset = date('W', strtotime($floorDate.'/'.$tYear));
            //Week 1 was already $offset weeks into the year. Calculate tax week accordingly
            $taxWeekNumber = date('W', $qDate) - ($offset - 2) - 1;
        } elseif ($scenario == 2) {
            //Today is in year 0 - Start of the tax year was in last calendar year
            $fullYearWeeks = $this->getIsoWeeksInYear($tYear - 1);

            $floorWeek = date('W', strtotime($floorDate.'/'.($tYear - 1)));

            //subtract the base week number from the whole year to account for 53 week years.
            $offset = $fullYearWeeks - $floorWeek;

            //calculate previous years weeks (offset) + this year's week count
            $taxWeekNumber = $offset + date('W', strtotime("$tMonth/$tDay/$tYear")) - 1;
        }

        return $taxWeekNumber;
    }

    public function getIsoWeeksInYear($year)
    {
        $date = new DateTime();
        $date->setISODate($year, 53);

        return $date->format('W') === '53' ? 53 : 52;
    }
}
