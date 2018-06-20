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
    
    $tDate = strtotime($wDate);
    
    $tDay = date("d");
    $tMonth = date("m");    
    $tYear = date("Y");
    
    if($floorDate == "06/04")
    {
      $cDay = 6;
      $cMonth = 4;
    } else {
      $cDay = intval(ltrim($floorDate,2));
      $cMonth = intval(rtrim($floorDate,2));
    }
    
    
    if($tMonth > $cMonth)
    {
      if ($tDay > $cDay)
      {
        //Today is in year 1 - Start of the tax year is in this calendar year
        
      }
    } else
    {
      //Today is in year 0 - Start of the tax year was in last calendar year
      
    }
    
    return $taxweeknumber
  }
}
?>
