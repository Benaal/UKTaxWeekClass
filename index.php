<?php

//include the src once
include_once './src/ukTaxWeek.php';

//instantiate the src
$tax_week = new \kayrah87\UKTaxWeekClass\UKTaxWeeks();

//Get the tax week of the date
$my_date = '13/03/2019';
echo "Comparing date $my_date <br />";
echo 'The tax week of this year is: '.$tax_week->getTaxWeekByDate($my_date).'<br />';

//Get tax week of the date when the financial year starts on another day (1st February, for example - 01/02)
$financial_year_start_date = '01/10';
echo "if the tax year started on $financial_year_start_date the financial week would be ".$tax_week->getTaxWeekByDate($my_date, $financial_year_start_date);
