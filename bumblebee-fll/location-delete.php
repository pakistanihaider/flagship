<?php

/**
 * @author Alvin herbert
 * @copyright 2015
 */

include ('header.php');

if(isset($_GET['id']))
{
$location_id=$_GET['id'];
$roomrows = mysql_query("SELECT * FROM fll_roomtypes WHERE id_location='$location_id'");
$room_count = mysql_num_rows($roomrows);
if ($room_count > 0){
    $sql=mysql_query("delete fll_location, fll_roomtypes from fll_location, fll_roomtypes where fll_location.id_location='$location_id' and fll_roomtypes.id_location='$location_id'");
} else {
    $sql=mysql_query("delete from fll_location where id_location='$location_id'");
}

//Activity Log info
$loggedinas=$_GET['logger'];
$location=$_GET['location'];
$useraction="delete location item: $location";
//log activity
$activity = "INSERT INTO fll_activity ". 
        "(log_user, user_action, log_time) ". 
        "VALUES ('$loggedinas', '$useraction', NOW())";
        $retval = mysql_query( $activity, $conn );
        
if($sql)
{
	echo "<script>window.location='location-list.php?&ok=2'</script>";
}
}

?>