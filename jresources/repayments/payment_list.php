<?php
session_start();
include_once("../../php_functions/functions.php");
include_once("../../configs/conn.inc");


$where_ = $_POST['where_'];
$offset_ = $_POST['offset'];
$rpp_ = $_POST['rpp'];
$orderby = $_POST['orderby'];
$dir = $_POST['dir'];
$search_ = trim($_POST['search_']);


$limit = "$offset_, $rpp_";
$offset_2 = $offset_ + $rpp_;
$limit2 = $offset_ + $rpp_;
$rows = "";

///////////////-------------------Search customers with full keyword
$cust_array = array();
$customers = fetchtable('o_customers',"full_name LIKE '%$search_%' OR primary_mobile ='$search_' OR email_address='$search_' OR national_id='$search_'","uid","asc","10","uid");
$customer_hits = mysqli_num_rows($customers);
if($customer_hits > 0) {
    while ($cu = mysqli_fetch_array($customers)) {
        $customer_uid = $cu['uid'];
        array_push($cust_array, $customer_uid);
    }
    $customet_list = implode(",", $cust_array);
    $orcustomer = " OR customer_id in ($customet_list)";
}
else{
    $orcustomer = "";
}

///////////////===================End of search customers with full_keyword

if ((input_available($search_)) == 1) {
    $andsearch = " AND (uid = '".decurl($search_)."' OR DATE(payment_date) LIKE '%$search_%' OR transaction_code = '%$search_%' OR loan_id = '$search_' OR amount = '$search_' $orcustomer)";
} else {
    $andsearch = "";
}

//-----------------------------Reused Query
$o_pays_ = fetchtable('o_incoming_payments', "$where_ AND status > 0 $andsearch", "$orderby", "$dir", "$limit", "*");
///----------Paging Option
$alltotal = countotal("o_incoming_payments", "$where_ AND status > 0 $andsearch");
///==========Paging Option
if ($alltotal > 0) {
    while ($q = mysqli_fetch_array($o_pays_)) {
        $uid = $q['uid'];
        $customer_id = $q['customer_id'];
        $payment_method = $q['payment_method']; $pay_meth = fetchrow('o_payment_methods',"uid='$payment_method'","name");
        $mobile_number = $q['mobile_number'];
        $amount = money($q['amount']);
        $transaction_code = $q['transaction_code'];
        $payment_date = $q['payment_date'];
        $record_method = $q['record_method'];

        if($customer_id > 0){
            $i = fetchonerow("o_customers","uid='$customer_id'","full_name, primary_mobile, national_id");
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
    <td>$uid</td>
    <td><a href=\"customers?cust=3232\"><span class=\"font-16\">$full_name</span><br/> <span class=\"text-muted font-13 font-bold\">$national_id</span></a>
    </td>
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
        $page_total = $page_total + 1;
        /////=======Paging Variable ---


    }
} else {
    echo "<tr><td colspan='13'><i>No Records Found</i></td></tr>";
}

//echo trim($row) . "<tr style='display: none ;'><td colspan='8'>" . paging_values_hidden($where_, $offset_, $rpp_, $orderby, $dir, $search_, 'loan_list', $page_total, $alltotal) . "</td></tr>";
echo   trim($row)."<tr style='display: none;'><td><input type=\"hiddenn\" id=\"_alltotal_\" value='$alltotal'><input type=\"hiddenn\" id=\"_pagetotal_\" value='$page_total'></td></tr>";
?>





















