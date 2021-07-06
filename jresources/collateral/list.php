<?php
session_start();
include_once ("../../php_functions/functions.php");
include_once ("../../configs/conn.inc");

$customer =  $_POST['customer'];
$action = $_POST['action'];


if($customer > 0){
    $o_customer_collateral = fetchtable('o_collateral',"customer_id = ".decurl($customer)." AND status = 1", "uid", "asc", "0,100", "uid ,category ,title ,description");
    if((mysqli_num_rows($o_customer_collateral)) > 0){

        while ($c = mysqli_fetch_array($o_customer_collateral)) {
            $uid = $c['uid'];
            $category = $c['category'];    $category_name = fetchrow("o_asset_categories","uid=$category","name");
            $title = $c['title'];
            $description = $c['description'];


            if($action == 'EDIT') {
                $act = "<a href=\"customers?customer-add-edit=$customer&collateral=".encurl($uid)."\" title='Edit' class='pointer text-blue'><i class='fa fa-edit'></i></a> " . "<a onclick=\"delete_collateral('".encurl($uid)."')\" title='Delete' class='pointer text-red'><i class='fa fa-trash'></i></a>"." <a onclick=\"view_collateral('".encurl($uid)."')\" title='View' class='pointer text-green'><i class='fa fa-eye'></i></a>";
            }else{
                $act = "--";
            }
            $_row.= "<tr id='ref".encurl($uid)."'><td>$category_name</td><td>$title</td><td>$act</td></tr>";
        }
    }
    else{
        $_row = "<tr><td colspan='3' class='font-italic'>No Collateral </td></tr>";
    }
    echo "<table class='table table-condensed table-striped table-bordered' style='width: 99%;'>
<tr><th>Category</th><th>Title</th><th>_Action_</th></tr>$_row<tr><th>Category</th><th>Title</th><th>Action</th></tr></table>";
}
else{
    echo errormes("Customer not selected");
}