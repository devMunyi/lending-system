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
 $customers = fetchtable('o_customers',"full_name LIKE '%$search_%' OR primary_mobile LIKE '%$search_%' OR email_address LIKE '%$search_%' OR national_id LIKE '%$search_%'","uid","asc","10","uid");
 $customer_lists = mysqli_num_rows($customers);
 if($customer_lists > 0) {
     while ($cu = mysqli_fetch_array($customers)) {
        $customer_uid = $cu['uid'];
        array_push($cust_array, $customer_uid);
     }
     $customer_list = implode(",", $cust_array);
     $orcustomer = " OR customer_id in ($customer_list)";
 }
 else{
     $orcustomer = "";
 }

///////////////===================End of search customers with full_keyword

if ((input_available($search_)) == 1) {
    $andsearch = " AND (uid = '$search_' OR given_date LIKE '%$search_%' OR next_due_date LIKE '%$search_%' OR final_due_date LIKE '%$search_%' OR loan_amount LIKE '%$search_%' $orcustomer)";
} else {
    $andsearch = "";
}


//-----------------------------Reused Query including filters
if($sort_option == "today"){
    //falling due today
    $o_loans_ = fetchtable('o_loans', "$where_ AND  status IN (3, 4) AND (DATEDIFF(final_due_date, \"$date\") = 0 OR DATEDIFF(next_due_date, \"$date\") = 0) $andsearch", "$orderby", "$dir", "$limit", "*");
    ///----------Paging Option
    $alltotal = countotal("o_loans", "$where_ AND status IN (3, 4) AND (DATEDIFF(final_due_date, \"$date\") = 0 OR DATEDIFF(next_due_date, \"$date\") = 0) $andsearch");
}elseif($sort_option == "tomorrow"){
    //falling due tomorrow
    $o_loans_ = fetchtable('o_loans', "$where_ AND status IN (3, 4) AND (DATEDIFF(final_due_date, \"$date\") = 1 OR DATEDIFF(next_due_date, \"$date\") = 1) $andsearch", "$orderby", "$dir", "$limit", "*");
    ///----------Paging Option
    $alltotal = countotal("o_loans", "$where_ AND status IN (3, 4) AND (DATEDIFF(final_due_date, \"$date\") = 1 OR DATEDIFF(next_due_date, \"$date\") = 1) $andsearch");
    ///==========Paging Option
}elseif($sort_option == "2days"){
    //falling in 2 days
    $o_loans_ = fetchtable('o_loans', "$where_ AND status IN (3, 4) AND (DATEDIFF(final_due_date, \"$date\") <= 2 OR DATEDIFF(next_due_date, \"$date\") <= 2) AND DATEDIFF(next_due_date, \"$date\") >= 0 $andsearch", "$orderby", "$dir", "$limit", "*");
    ///----------Paging Option
    $alltotal = countotal("o_loans", "$where_ AND status IN (3, 4) AND (DATEDIFF(final_due_date, \"$date\") <= 2 OR DATEDIFF(next_due_date, \"$date\") <= 2) AND DATEDIFF(next_due_date, \"$date\") >= 0 $andsearch");
    ///==========Paging Option
}elseif($sort_option == "3days"){
    //falling in 3 days
    $o_loans_ = fetchtable('o_loans', "$where_ AND status IN (3, 4) AND (DATEDIFF(final_due_date, \"$date\") <= 3 OR DATEDIFF(next_due_date, \"$date\") <= 3) AND DATEDIFF(next_due_date, \"$date\") >= 0 $andsearch", "$orderby", "$dir", "$limit", "*");
    ///----------Paging Option
    $alltotal = countotal("o_loans", "$where_ AND status IN (3, 4)  AND (DATEDIFF(final_due_date, \"$date\") <= 3 OR DATEDIFF(next_due_date, \"$date\") <= 3) AND DATEDIFF(next_due_date, \"$date\") >= 0 $andsearch");
    ///==========Paging Option
}elseif($sort_option == "7days"){
    //falling in 7 days
    $o_loans_ = fetchtable('o_loans', "$where_ AND status IN (3, 4) AND (DATEDIFF(final_due_date, \"$date\") <= 7 OR DATEDIFF(next_due_date, \"$date\") <= 7) AND DATEDIFF(next_due_date, \"$date\") >= 0 $andsearch", "$orderby", "$dir", "$limit", "*");
    ///----------Paging Option
    $alltotal = countotal("o_loans", "$where_ AND status IN (3, 4) AND (DATEDIFF(final_due_date, \"$date\") <= 7 OR DATEDIFF(next_due_date, \"$date\") <= 7) AND DATEDIFF(next_due_date, \"$date\") >= 0 $andsearch");
    ///==========Paging Option
}elseif($sort_option == "14days"){
    //falling in 14 days
    $o_loans_ = fetchtable('o_loans', "$where_ AND status IN (3, 4) AND (DATEDIFF(final_due_date, \"$date\") <= 14 OR DATEDIFF(next_due_date, \"$date\") <= 14) AND DATEDIFF(next_due_date, \"$date\") >= 0 $andsearch", "$orderby", "$dir", "$limit", "*");
    ///----------Paging Option
    $alltotal = countotal("o_loans", "$where_ AND status IN (3, 4) AND (DATEDIFF(final_due_date, \"$date\") <= 14 OR DATEDIFF(next_due_date, \"$date\") <= 14) AND DATEDIFF(next_due_date, \"$date\") >= 0 $andsearch");
    ///==========Paging Option
}elseif($sort_option == "uncommited"){
    //uncommitted
    $o_loans_ = fetchtable("o_loans", "$where_ AND status IN (3, 4) AND (DATEDIFF(final_due_date, \"$date\") < 0 OR DATEDIFF(next_due_date, \"$date\") < 0) AND loan_balance > 0 AND total_repaid = 0.00 AND DATEDIFF($date, given_date) >= 7 $andsearch", "$orderby", "$dir", "$limit", "*");
    ///----------Paging Option
    $alltotal = countotal("o_loans", "$where_ AND status IN (3, 4) AND (DATEDIFF(final_due_date, \"$date\") < 0 OR DATEDIFF(next_due_date, \"$date\") < 0) AND loan_balance > 0 AND total_repaid = 0.00 AND DATEDIFF($date, given_date) >= 7 $andsearch");
}else{
    $o_loans_ = fetchtable('o_loans', "$where_ AND status IN (3, 4) AND (DATEDIFF(Final_due_date, \"$date\") >= 0 OR DATEDIFF(Final_due_date, \"$date\") >= 0) $andsearch", "$orderby", "$dir", "$limit", "*");
    ///----------Paging Option
    $alltotal = countotal("o_loans", "$where_ AND status IN (3, 4) AND (DATEDIFF(final_due_date, \"$date\") >= 0 OR DATEDIFF(Final_due_date, \"$date\") >= 0) $andsearch");
    ///==========Paging Option
}

if ($alltotal > 0) {
    while ($n = mysqli_fetch_array($o_loans_)) {
        $uid = $n['uid'];
        $customer_id = $n['customer_id'];
        $i = fetchonerow("o_customers","uid='$customer_id'","full_name, primary_mobile");
        $full_name = $i['full_name'];
        $primary_mobile = $i['primary_mobile'];
        $product_id = $n['product_id'];
        $loan_amount = $n['loan_amount'];
        $disbursed_amount = $n['disbursed_amount'];
        $period = $n['period'];
        $period_units = $n['period_units'];
        $payment_frequency = $n['payment_frequency'];
        $payment_breakdown = $n['payment_breakdown'];
        $total_addons = $n['total_addons'];              $count_addons = countotal('o_loan_addons',"loan_id='$uid' AND status=1","uid");
        $total_deductions = $n['total_deductions'];      $count_deductions = countotal('o_loan_deductions',"loan_id='$uid' AND status=1","uid");
        $total_instalments = $n['total_instalments'];
        $total_instalments_paid = $n['total_instalments_paid'];
        $current_instalment = $n['current_instalment'];
        $given_date = $n['given_date'];
        $next_due_date = $n['next_due_date'];
        $final_due_date = $n['final_due_date'];
        $added_by = $n['added_by'];
        $added_date = $n['added_date'];
        $loan_stage = $n['loan_stage'];
        $loan_flag = flag($n['loan_flag']);
        $current_branch = $n['current_branch'];
        $transaction_code = $n['transaction_code'];
        $transaction_date = $n['transaction_date'];
        $application_mode = $n['application_mode'];
        $status = $n['status'];     $status_d = fetchonerow("o_loan_statuses","uid='".$status."'","name, color_code");
                    $product_name = fetchrow("o_loan_products","uid='".$product_id."'","name");
                   $stage_name = fetchrow('o_loan_stages',"uid='".$loan_stage."'","name");
                   $loan_branch = fetchrow('o_branches',"uid='".$current_branch."'","name");
                        $repaid = total_repaid($uid);
                        $balance = loan_balance($uid);

        $row .= "<tr><td class='font-14 font-bold'>".encurl($uid)."</td>
                        <td><span class=\"font-14\">$full_name <a title='View Customer' href=\"customers?customer=".encurl($customer_id)."\"><i class=\"fa fa-external-link\"></i></a></span><br/> <span class=\"text-muted font-13 font-bold\">$primary_mobile</span>
                        </td>
                        <td><span class=\"text-bold text-blue font-14\">$loan_amount</span><br/> <span class='font-13'>$loan_branch</span></td>
                        <td><span>$total_addons</span><br/> <label class=\"label label-default font-13 font-bold\">$count_addons Total</label>
                        </td>
                        <td><span>$total_deductions</span><br/> <label class=\"label label-default font-13 font-bold\">$count_deductions Total</label></td>
                        <td><span class='text-green'>".money($repaid)."</span></td>
                        <td><span class=\"font-bold text-red font-16\">".money($balance)."</span><br/> <span class=\"text-muted font-13 font-italic\">Next: ".$n['next_due_date']."</span></td>
                        <td><span>$given_date</span><br/> <span class=\"text-orange font-13 font-bold\">".fancydate($given_date)."</span></td>
                        <td><span>$next_due_date</span><br/> <span class=\"text-orange font-13 font-bold\">".fancydate($next_due_date)."</span></td>
                        <td><span class='label custom-color' style='background-color: ".$status_d['color_code'].";'>".$status_d['name']."</span></td>
                        <td><span><a href=\"loans?loan=".encurl($uid)."\"><span class=\"fa fa-eye text-green\"></span></a></span></td>
                    </tr>";

        //////------Paging Variable ---
        //$page_total = $page_total + 1;
        /////=======Paging Variable ---


    }
} else {
    echo "<tr><td colspan='13'><i>No Records Found</i></td></tr>";
}

//echo trim($row) . "<tr style='display: none ;'><td colspan='8'>" . paging_values_hidden($where_, $offset_, $rpp_, $orderby, $dir, $search_, 'loan_list', $page_total, $alltotal) . "</td></tr>";
echo   trim($row)."<tr style='display: none;'><td><input type='hidden' id='_alltotal_' value='$alltotal'><input type='hidden' id='_pageno_' value='$page_no'></td></tr>";
?>
