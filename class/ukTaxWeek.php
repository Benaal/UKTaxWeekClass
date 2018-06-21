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

Class UKTaxWeeks
{
  
  function getTaxWeekByDate($wDate,$floorDate = "06/04")
  {
    // Get the Tax week number based upon $wDate - The date you're querying - 
    // and optionally $floorDate, which defaults to the UK tax start 
    // date of 06/04
    
    //convert the provided date to a query string/timestamp
    $qDate = strtotime($wDate);
    
    //Calculate This Day, This Month and This Year from current datetime
    $tDay = date("d",$qDate);
    $tMonth = date("m",$qDate);    
    $tYear = date("Y",$qDate);
    
    //Calculate Comparison Day and Comparison Month from floorDate
    $cDay = intval(ltrim($floorDate,2));
    $cMonth = intval(rtrim($floorDate,2));
    
    
    if($tMonth > $cMonth)
    {
      if ($tDay > $cDay)
      {
        //Today is in year 1 - Start of the tax year is in this calendar year
        $offset = date("W",$floorDate . "/" . $tYear);
        
        //Week 1 was already $offset weeks into the year. Calculate tax week accordingly
        $taxWeekNumber = date("W",$qDate) - ($offset - 1);
      }
    } else
    {
      //Today is in year 0 - Start of the tax year was in last calendar year
      $fullYearWeeks = date("W","31/12/" . $tYear - 1);
      $floorWeek = date("W",$floorDate . "/" . ($tYear - 1));
      
      //subtract the base week number from the whole year to account for 53 week years.
      $offset = $fullYearWeeks - $floorWeek;
      
      //calxculate previous years weeks (offset) + this year's week count
      $taxWeekNumber = $offset + date("W",$qDate);
    }
    
    return $taxWeekNumber
  }
  
}
?>
