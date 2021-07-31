<?php
session_start();
include_once ("../../php_functions/functions.php");
include_once ("../../configs/conn.inc");

$customer =  $_POST['customer'];
$action = $_POST['action'];


if($customer > 0){
    $o_customer_referees_ = fetchtable('o_customer_referees',"customer_id = ".decurl($customer)." AND status = 1", "uid", "asc", "0,100", "uid ,referee_name, id_no, mobile_no, physical_address, email_address ,relationship ,status ");
    if((mysqli_num_rows($o_customer_referees_)) > 0){

        while ($t = mysqli_fetch_array($o_customer_referees_)) {
            $uid = $t['uid'];
            $referee_name = $t['referee_name'];
            $referee_relationship = $t['relationship'];
                   $relationship_name = fetchrow('o_customer_referee_relationships',"uid='$referee_relationship'","name");

            if($action == 'EDIT') {
                $act = "<a href=\"customers?customer-add-edit=$customer&referees=".encurl($uid)."\" title='Edit' class='pointer text-blue'><i class='fa fa-edit'></i></a> " . "<a onclick=\"delete_referee('".encurl($uid)."')\" title='Delete' class='pointer text-red'><i class='fa fa-trash'></i></a>"." <a onclick=\"view_referee('".encurl($uid)."')\" title='View' class='pointer text-green'><i class='fa fa-eye'></i></a>";
            }else{
                $act = "--";
            }
            $referee_row.= "<tr id='ref".encurl($uid)."'><td>$referee_name</td><td>$relationship_name</td><td>$act</td></tr>";
        }
    }
    else{
        $referee_row = "<tr><td colspan='3' class='font-italic'>No Referees </td></tr>";
    }
    echo "<table class='table table-condensed table-striped table-bordered' style='width: 99%;'>
<tr><th>Name</th><th>Relationship</th><th>_Action_</th></tr>$referee_row<tr><th>Name</th><th>Relationship</th><th>Action</th></tr></table>";
}
else{
    echo errormes("Customer not selected");
}