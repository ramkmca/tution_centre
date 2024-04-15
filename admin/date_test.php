<?php
$date1 = "2016-11-05";
$date2 = "2016-12-06";

$diff = abs(strtotime($date2) - strtotime($date1));

 $month = floor($diff / (30*60*60*24));
echo $fee_month = $month+1;
?>