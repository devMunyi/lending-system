<?php
session_start();
include_once("../../php_functions/functions.php");
include_once("../../configs/conn.inc");


$where_ = $_POST['where_'];
$offset_ = $_POST['offset'];
$rpp_ = $_POST['rpp'];
$page_no = $_POST['page_no'];
$orderby = $_POST['orderby'];
$dir = $_POST['dir'];
$search_ = trim($_POST['search_']);
$sort_option = $_POST['sort_option'];


$limit = "$offset_, $rpp_";
$offset_2 = $offset_ + $rpp_;
$limit2 = $offset_ + $rpp_;
$rows = "";

///////////////-------------------Search customers with full keyword
$cust_array = array();
$customers = fetchtable2("o_customers","full_name LIKE \"%$search_%\" OR primary_mobile LIKE \"%$search_%\" OR email_address LIKE \"%$search_%\" OR national_id LIKE \"%$search_%\"","uid","asc","uid");

$customer_lists = mysqli_num_rows($customers);
if($customer_lists > 0) {
    while ($cu = mysqli_fetch_array($customers)) {
        $customer_uid = $cu['uid'];
        array_push($cust_array, $customer_uid);
    }
    $customer_list = implode(",", $cust_array);
    $orcustomer = " OR `customer_id` IN ($customer_list)";
}
else{
    $orcustomer = "";
}

$pay_array = array();
$payment_meth_ = fetchtable2("o_payment_methods", "name LIKE \"%$search_%\"", "uid", "asc", "uid");
$payment_meth_count = mysqli_num_rows($payment_meth_);
if($payment_meth_count > 0){
    while($pyt_list = mysqli_fetch_array($payment_meth_)){
        $pyt_id = $pyt_list['uid'];
        array_push($pay_array, $pyt_id);
    }
    $pyt_meth_list = implode(", ", $pay_array);
    $orpaymethod = " OR `payment_method` IN ($pyt_meth_list)";
}

$branch_array = array();
$branch_ = fetchtable2("o_branches", "name LIKE \"%$search_%\"", "uid", "asc", "uid");
$branch_count = mysqli_num_rows($branch_);
if($branch_count > 0){
    while($branch_list = mysqli_fetch_array($branch_)){
        $branch_id = $branch_list['uid'];
        array_push($branch_array, $branch_id);
    }
    $cust_branch_list = implode(", ", $branch_array);
    $orcustbranch = " OR `branch_id` IN ($cust_branch_list)";
}

///////////////===================End of search customers with full_keyword

if ((input_available($search_)) == 1) {

    $andsearch = "AND (uid = \"$search_\" OR DATE(payment_date) LIKE \"%$search_%\" OR transaction_code LIKE \"%$search_%\" OR amount LIKE \"%$search_%\" $orcustomer  $orpaymethod $orcustbranch)";
} else {
    $andsearch = "";
}


if($customer_id > 0){
    $i = fetchonerow("o_customers","uid=$customer_id","full_name, primary_mobile, national_id, branch");
    $full_name = $i['full_name'];
    $primary_mobile = $i['primary_mobile'];
    $national_id = $i['national_id'];
    $branch = $i['branch']; $branch_ = fetchrow("o_branches", "uid = $branch", "name");
}else{
    $full_name = "<i>Unspecified</i>";
}

//-----------------------------Reused Query
//displaying list based on sort options
if($sort_option == "sort_2"){
    //Sort by mobile payments
    $o_pays_ = fetchtable("o_incoming_payments", "$where_ AND payment_method IN (1, 2) AND status > 0 $andsearch", "$orderby", "$dir", "$limit", "*");
    ///----------Paging Option
    $alltotal = countotal("o_incoming_payments", "$where_ AND payment_method IN (1, 2) AND status > 0 $andsearch");
    ///==========Paging Option
}elseif($sort_option == "sort_3"){
    //Sort by Bank payments
    $o_pays_ = fetchtable("o_incoming_payments", "$where_ AND payment_method = 3 AND status > 0 $andsearch", "$orderby", "$dir", "$limit", "*");
    ///----------Paging Option
    $alltotal = countotal("o_incoming_payments", "$where_ AND payment_method = 3 AND status > 0 $andsearch");
    ///==========Paging Option
}elseif($sort_option == "sort_4"){
    //Sort by cash payments
    $o_pays_ = fetchtable("o_incoming_payments", "$where_ AND payment_method = 4 AND status > 0 $andsearch", "$orderby", "$dir", "$limit", "*");
    ///----------Paging Option
    $alltotal = countotal("o_incoming_payments", "$where_ AND payment_method = 4 AND status > 0 $andsearch");
    ///==========Paging Option
}else{
    //default sort/display all payments
    $o_pays_ = fetchtable("o_incoming_payments", "$where_ AND status > 0 $andsearch", "$orderby", "$dir", "$limit", "*");
    ///----------Paging Option
    $alltotal = countotal("o_incoming_payments", "$where_ AND status > 0 $andsearch");
    ///==========Paging Option
}


if ($alltotal > 0) {
    while ($q = mysqli_fetch_array($o_pays_)) {
        $uid = $q['uid'];
        $customer_id = $q['customer_id'];
        $branch_id = $q['branch_id']; $branch_name_ = fetchrow("o_branches", "uid=$branch_id", "name");
        $payment_method = $q['payment_method']; $pay_meth = fetchrow('o_payment_methods',"uid=\"$payment_method\"","name");
        $mobile_number = $q['mobile_number'];
        $amount = money($q['amount']);
        $transaction_code = $q['transaction_code'];
        $payment_date = $q['payment_date'];
        $record_method = $q['record_method'];

        if($customer_id > 0){
            $i = fetchonerow("o_customers","uid=$customer_id","full_name, primary_mobile, national_id, branch");
            $full_name = $i['full_name'];
            $primary_mobile = $i['primary_mobile'];
            $national_id = $i['national_id'];
        }
        else{
            $full_name = "<i>Unspecified</i>";
        }
        $loan_id = $q['loan_id'];
        if($loan_id > 0){
            $l = loan_obj($loan_id);
            $loan_balance = money($l['loan_balance']);
            $next_due = $l['next_due_date'];
        } else{
            $loan_balance = "<i>Unspecified</i>";
            $next_due ="<i>Unspecified</i>";
        }



    $row .= "<tr>
    <td>$uid</td><
    <td><a href=\"customers?cust=3232\"><span class=\"font-16\">$full_name</span><br/> <span class=\"text-muted font-13 font-bold\">$national_id</span></a>
    </td>
    <td>$branch_name_</td>
    <td><span class=\"text-bold text-blue font-16\">$amount</span></td>
    <td><span>$pay_meth</span>
    </td>
    <td>$record_method</td>
    <td>$transaction_code</td>
    <td><span>$loan_balance</span><br/> <span class=\"text-muted font-13 font-italic\">Next Due: <b>$next_due</b></span></td>
    <td><span>$payment_date</span><br/> <span class=\"text-orange font-13 font-bold\">".fancydate($payment_date)."</span></td>
    <td><span class=\"text-green\"><i class=\"fa fa-check\"></i> Successful</span></td>
    <td><span><a href=\"?repayment=".encurl($uid)."\"><span class=\"fa fa-eye text-green\"></span></a></span><h4></h4></td>
</tr>";

        //////------Paging Variable ---
        //$page_total = $page_total + 1;
        /////=======Paging Variable ---


    }
} else {
    echo "<tr><td colspan='13'><i>No Records Found</i></td></tr>";
}

echo trim($row)."<tr style='display: none;'><td><input type='hidden' id='_alltotal_' value='$alltotal'><input type='hidden' id='_pageno_' value='$page_no'></td></tr>";
?>