<?php

/**
 * @author Alvin herbert
 * @copyright 2015
 */

include ('header.php');

if(isset($_GET['id']))
{

$flight_id=$_GET['id'];
$flighttimerows = mysql_query("SELECT * FROM gnd_flighttime WHERE id_flight='$flight_id'");
$flighttime_count = mysql_num_rows($flighttimerows);
if ($flighttime_count > 0){
    $sql=mysql_query("delete gnd_flights, gnd_flighttime from gnd_flights, gnd_flighttime where gnd_flights.id_flight='$flight_id' and gnd_flighttime.id_flight='$flight_id'");
} else {
    $sql=mysql_query("delete from gnd_flights where id_flight='$flight_id'");
}

//Activity Log info
$loggedinas=$_GET['logger'];
$flight=$_GET['flight'];
$useraction="delete flight number: $flight";
//log activity
$activity = "INSERT INTO gnd_activity ". 
        "(log_user, user_action, log_time) ". 
        "VALUES ('$loggedinas', '$useraction', NOW())";
        $retval = mysql_query( $activity, $conn );

if($sql)
{
header('location:flight-list.php');
}
}

?>