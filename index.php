<?php

//include the class once
include_once './class/ukTaxWeek.php';

//instantiate the class
$taxWeek = new UKTaxWeeks();

//Get the tax week of the date
$myDate = '05/04/2018';
echo "Comparing date $myDate <br />";
echo 'The tax week of this year is: '.$taxWeek->getTaxWeekByDate($myDate).'<br />';

//Get tax week of the date when the financial year starts on another day (1st February, for example - 01/02)
$financialYearStartDate = '01/10';
echo "if the tax year started on $financialYearStartDate the financial week would be ".$taxWeek->getTaxWeekByDate($myDate, $financialYearStartDate);
