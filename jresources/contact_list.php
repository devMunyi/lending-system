<?php
session_start();
include_once ("../php_functions/functions.php");
include_once ("../configs/conn.inc");

$customer =  $_POST['customer'];
$action = $_POST['action'];


if($customer > 0){
    $o_customer_contacts_ = fetchtable('o_customer_contacts',"customer_id = ".decurl($customer)." AND status = 1", "uid", "asc", "0,100", "uid ,contact_type ,value ,status ");
    if((mysqli_num_rows($o_customer_contacts_)) < 1){
        $contact_row = "<tr><td colspan='3' class='font-italic'>No Contacts</td></tr>";
    }
    else {
        while ($t = mysqli_fetch_array($o_customer_contacts_)) {
            $uid = $t['uid'];
            $contact_type = $t['contact_type']; $type_name = fetchrow('o_contact_types',"uid='$contact_type'","name");
            $value = $t['value'];
            if($action == 'EDIT') {
                $act = "<a href=\"customers?customer-add-edit=$customer&contact=".encurl($uid)."\" title='Edit' class='pointer text-blue'><i class='fa fa-edit'></i></a> " . " <a onclick=\"delete_contact('".encurl($uid)."')\" title='Delete' class='pointer text-red'><i class='fa fa-trash'></i></a>";
            }else{
                $act = "--";
            }
            $contact_row.= "<tr id='cont".encurl($uid)."'><td>$type_name</td><td>$value</td><td>$act</td></tr>";
        }
    }
    echo "<table class='table table-condensed table-striped table-bordered' style='width: 99%;'><tr><th>Type</th><th>Details</th><th>Action</th></tr>$contact_row<tr><th>Type</th><th>Details</th><th>Action</th></tr></table>";
}
else{
    echo errormes("Customer not selected");
}