<?php
session_start();
include_once ("../../php_functions/functions.php");
include_once ("../../configs/conn.inc");

$ref_id = $_POST['ref_id'];

echo "<table class='table table-bordered'>";
if($ref_id > 0){
    $l = fetchonerow('o_customer_referees', "uid=".decurl($ref_id),"*");
    $added_date = $l['added_date'];
    $referee_name = $l['referee_name'];
    $id_no = $l['id_no'];
    $mobile_no = $l['mobile_no'];
    $physical_address = $l['physical_address'];
    $email_address = $l['email_address'];
    $relationship = $l['relationship'];  $relationship_name = fetchrow('o_referee_relationships',"uid='$relationship'","name");

    echo "<tr><td>Name</td><td class='font-bold'>$referee_name</td></tr>";
    echo "<tr><td>ID Number</td><td class='font-bold'>$id_no</td></tr>";
    echo "<tr><td>Mobile No.</td><td class='font-bold'>$mobile_no</td></tr>";
    echo "<tr><td>Physical Address</td><td class='font-bold'>$physical_address</td></tr>";
    echo "<tr><td>Email Address</td><td class='font-bold'>$email_address</td></tr>";
    echo "<tr><td>Relationship</td><td class='font-bold'>$relationship_name</td></tr>";



}
else{
    die(errormes("Referee invalid"));
    exit();
}
echo "</table>";