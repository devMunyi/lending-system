<?php
session_start();
include_once ("../php_functions/functions.php");
include_once ("../configs/conn.inc");




$where_ =  $_POST['where_'];
$offset_ =  $_POST['offset'];
$rpp_ =  $_POST['rpp'];
$page_no = $_POST['page_no'];
$orderby =  $_POST['orderby'];
$dir =  $_POST['dir'];
$search_ = trim($_POST['search_']);


$limit = "$offset_, $rpp_";
$offset_2 = $offset_ + $rpp_;
$limit2 = $offset_+$rpp_;
$rows = "";

if((input_available($search_)) == 1){
    $andsearch = " AND (name LIKE '%$search_%' || email = '%$search_%' || phone = '%$search_%' )";
}
else{
    $andsearch = "";
}

//-----------------------------Reused Query
$o_users_ = fetchtable('o_users',"$where_ AND status > 0 $andsearch", "$orderby", "$dir", "$limit", "uid ,name ,email ,phone ,join_date ,user_group ,branch ,status ");
///----------Paging Option
$alltotal = countotal("o_users","$where_ AND status > 0 $andsearch");
///==========Paging Option
while($c = mysqli_fetch_array($o_users_))
{
    $uid = $c['uid'];    $encstaff = encurl($uid);
    $name = $c['name'];
    $email = $c['email'];
    $phone = $c['phone'];
    $join_date = $c['join_date'];
    $user_group = $c['user_group'];
    $branch = $c['branch'];
    $status = $c['status'];

    if($branch > 0) {
        $br = fetchonerow("o_branches", "uid='$branch'", "uid, name");
        $branch_name = $br['name'];
    }
    else{
        $branch_name = "<i>No Branch</i>";
    }

    $f = fetchonerow("o_staff_statuses","uid='$status'","name");
    $status_name = $f['name'];

    $row.=" <tr><td>$uid</td><td><span class='font-16'>$name </td><td><span>$email </span></td>
 <td><span>$phone</span></td><td>$user_group</td><td><span>$branch_name</span></td>
 <td><span>$join_date</span></td>
 <td><span>$status_name </span></td><td><span><a href='?staff=$encstaff'><span class='fa fa-eye text-green'></span></a></span></td></tr>";

    //////------Paging Variable ---
    //$page_total = $page_total + 1;
    /////=======Paging Variable ---


}

echo   trim($row)."<tr style='display: none;'><td><input type='text' id='_alltotal_' value='$alltotal'><input type='text' id='_pageno_' value='$page_no'></td></tr>";