<?php
session_start();
include_once ("../../php_functions/functions.php");
include_once ("../../configs/conn.inc");


$action = $_POST['action'];
$tbl = $_POST['tbl'];
$record = $_POST['record'];


if($record > 0){
    $o_other = fetchtable('o_key_values',"tbl = '$tbl' AND record='".decurl($record)."' AND status = 1", "uid", "asc", "0,100", "uid ,key_ ,value_ ");
    if((mysqli_num_rows($o_other)) > 0){
        while ($c = mysqli_fetch_array($o_other)) {
            $uid = $c['uid'];
           $key = $c['key_'];
           $value = $c['value_'];


            if($action == 'EDIT') {
                $act = "<a href=\"customers?customer-add-edit=".$record."&other=".encurl($uid)."\" title='Edit' class='pointer text-blue'><i class='fa fa-edit'></i></a> " . "<a onclick=\"delete_other('".encurl($uid)."')\" title='Delete' class='pointer text-red'><i class='fa fa-trash'></i></a>";
            }else{
                $act = "--";
            }
            $_row.= "<tr id='ref".encurl($uid)."'><td>$key</td><td>$value</td><td>$act</td></tr>";
        }
    }
    else{
        $_row = "<tr><td colspan='3' class='font-italic'>No Other Info </td></tr>";
    }
    echo "<table class='table table-condensed table-striped table-bordered' style='width: 99%;'>
<tr><th>Name</th><th>Value</th><th>_Action_</th></tr>$_row<tr><th>Category</th><th>Title</th><th>Action</th></tr></table>";
}
else{
    echo errormes("Customer not selected");
}