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

namespace kayrah87\UKTaxWeekClass;

use Carbon\Carbon;

class UKTaxWeeks
{
    public function __construct()
    {
        require('vendor/autoload.php');
    }

    public function getTaxWeekByDate($query_date, $floor_date = '06/04')
    {
        /*
          * Get the Tax week number based upon $wDate - The date you're querying -
          * and optionally $floorDate, which defaults to the UK tax start
          * date of 06/04
          */

        //parse the given dates in carbon to ensure we are working with apples and apples
        $given_date = Carbon::parse(Carbon::createFromFormat('d/m/Y', $query_date, 'Europe/London'));
        $start_date = Carbon::parse(Carbon::createFromFormat('d/m/Y', $floor_date . '/' . $given_date->year, 'Europe/London'));

        if ($given_date < $start_date) {
            //we are in previous financial year
            //update the start date
            $start_date->subYear();
        }

        return $start_date->diffInWeeks($given_date);
    }
}
