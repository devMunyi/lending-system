<?php
include_once ("../php_functions/functions.php");
include_once ("../configs/conn.inc");
$search = $_POST['key'];

echo "<table class='table table-striped table-condensed'>";
$o_customers_ = fetchtable('o_customers',"full_name LIKE '%$search%' || primary_mobile LIKE '%$search%' || email_address LIKE '%$search%' || national_id LIKE '%$search%'", "uid", "desc", "0,10", "uid ,full_name ,primary_mobile ,email_address ,national_id ,status ");
while($e = mysqli_fetch_array($o_customers_))
{
    $uid = $e['uid'];
    $full_name = $e['full_name'];
    $primary_mobile = $e['primary_mobile'];
    $email_address = $e['email_address'];
    $national_id = $e['national_id'];
    $status = $e['status'];
    echo "<tr><td><a class='pointer' onclick=\"select_client('$full_name (ID: $national_id)','$uid');\"><span class='font-bold font-16 text-blue'>$full_name</span> <br/>
    Email: $email_address | Phone: $primary_mobile</a></td></tr>";
}
echo "</table>";
