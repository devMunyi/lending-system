<?php
session_start();
include_once ("../../php_functions/functions.php");
include_once ("../../configs/conn.inc");


$where_ =  $_POST['where_'];
$offset_ =  $_POST['offset'];
$rpp_ =  $_POST['rpp'];
$page_no = $_POST['page_no'];
$orderby =  $_POST['orderby'];
$dir =  $_POST['dir'];
$search_ = trim($_POST['search_']);
$camp_id = $_POST['camp_id'];

$camp_ = fetchonerow("o_campaigns", "uid = '$camp_id'", "status, target_customers");
$camp_status = $camp_["status"];
$camp_target_audience = $camp_["target_customers"];


$limit = "$offset_, $rpp_";
$offset_2 = $offset_ + $rpp_;
$limit2 = $offset_+$rpp_;
$rows = "";

if((input_available($search_)) == 1){
    $andsearch = " AND (full_name LIKE '%$search_%' OR branch LIKE '%$search_%' )";
}
else{
    $andsearch = "";
}

//-----------------------------Reused Query


$dob_curdate = substr($date, 5);

/*$cust_added_date = fetchrow("o_customers", "uid > 0 and status = 1", "added_date");

$days_passed_ = datediff($cust_added_date, $date);
*/

$loaned_cust_arr = array();

$loaned_cust = fetchrow('o_loans', "(total_repayable_amount - total_repaid) > 0 AND (status = 2 OR status = 3)", "customer_id");


if($camp_status == 1 AND ($camp_target_audience == 1)){
    $o_users_ = fetchtable("o_customers","$where_ AND uid NOT IN($loaned_cust) AND status = 1 $andsearch", "$orderby", "$dir", "$limit", "uid ,primary_mobile, full_name, dob, branch, status");
    $alltotal = countotal("o_customers","$where_ AND uid  NOT IN($loaned_cust) AND status = 1 $andsearch");
}elseif($camp_status == 1 AND ($camp_target_audience == 2 )){
    $o_users_ = fetchtable("o_customers","$where_ AND SUBSTRING(dob, 6) = \"$dob_curdate\" AND status = 1 $andsearch", "$orderby", "$dir", "$limit", "uid ,primary_mobile, full_name, branch, status");
    $alltotal = countotal("o_customers","$where_ AND SUBSTRING(dob, 6) = \"$dob_curdate\" AND status = 1 $andsearch");
}elseif($camp_status == 1 AND ($camp_target_audience == 3)){
    $o_users_ = fetchtable("o_customers","$where_ AND status = 1 $andsearch", "$orderby", "$dir", "$limit", "uid ,primary_mobile, full_name, dob, branch, status");
    $alltotal = countotal("o_customers","$where_ AND status = 1 $andsearch");
}


if($alltotal > 0) {
        while ($l = mysqli_fetch_array($o_users_)) {
            $uid = $l['uid'];  $uid_enc = encurl($uid);
            $full_name = $l['full_name'];
            $phone_number = $l['primary_mobile'];
            $branch = $l['branch'];                    $branch_name = fetchrow('o_branches',"uid='$branch'","name");
            $status = $l['status'];                    $state = fetchonerow("o_customer_statuses","code='$status'","color, name");


            $row .= "<tr><td>$uid</td>
                                <td><span>$full_name</span><br/> <span class='text-muted font-13 font-bold'>$phone_number</span>
                                </td>
                                <td><span>$branch_name</span></td>
                                <td><span class='label ".$state['color']."'>".$state['name']." </span></td>
                                <td><span><a href='customers?customer=$uid_enc'><span class='fa fa-eye text-green'></span></td>
                            </tr>                    ";

            //////------Paging Variable ---
            //$page_total = $page_total + 1;
            /////=======Paging Variable ---


        }
    }else{
    $row = "<tr><td colspan='8'><i>No Records Found</i></td></tr>";
}
///----------Paging Option

///==========Paging Option

 echo   trim($row)."<tr style='display: none;'><td><input type='text' id='_alltotal_' value='$alltotal'><input type='text' id='_pageno_' value='$page_no'><input type='text' id ='_dob_' value = '$dob'></td></tr>";
 ?>