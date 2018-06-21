<?php

//include the class once
include_once('class/ukTaxWeek.php');

//instantiate the class
$taxWeek = new UKTaxWeeks

//Get the tax week of the date
$myDate = "01/06/2018";
echo $taxWeek->getTaxWeekByDate($myDate);

//Get tax week of the date when the financial year starts on another day (1st February, for example - 01/02)
$financialYearStartDate = "01/02";
echo $taxWeek->getTaxWeekByDate($myDate,$financialYearStartDate);

?>