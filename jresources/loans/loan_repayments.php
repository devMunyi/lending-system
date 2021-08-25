<?php
include_once("../../php_functions/functions.php");
include_once("../../configs/conn.inc");

$loan_id = $_GET['loan_id'];
if($loan_id > 0){
    $loan_d = fetchonerow('o_loans',"uid='".decurl($loan_id)."'","uid, customer_id");
    $customer_id = $loan_d['customer_id'];
    if($customer_id > 0){
        $cust_ = fetchonerow("o_customers", "uid = \"$customer_id\"", "full_name, primary_mobile");
        $cust_names = $cust_['full_name'];
        $cust_phone = $cust_['primary_mobile'];
    }else{
        echo "<i>Customer ID is invalid</i>";
    }
}
else{
    echo "<i>Loan ID is invalid</i>";
    die();
}


?>

<table class="table-bordered font-14 table table-hover">
    <thead><tr><th>ID</th><th>Transaction Code</th><th>Amount</th><th>Date Repaid</th><th>Payer Details</th><th>Payment Method</th><th>Status</th><th>Action</th></tr></thead>
    <tbody>
    <?php
    //-----------------------------Reused Query
    $o_pays_ = fetchtable('o_incoming_payments', "customer_id=$customer_id AND status > 0", "uid", "desc", "0,100", "*");
    ///----------Paging Option
    $alltotal = countotal("o_incoming_payments", "customer_id=$customer_id AND status > 0");
    ///==========Paging Option
    if ($alltotal > 0) {
        while ($q = mysqli_fetch_array($o_pays_)) {
            $uid = $q['uid'];
            $payment_md = $q['payment_method']; $payment_method = fetchrow('o_payment_methods',"uid='$payment_md'","name");
            $mobile_number = $q['mobile_number'];
            $amount = money($q['amount']);
            $transaction_code = $q['transaction_code'];
            $payment_date = $q['payment_date']; 
            $record_method = $q['record_method'];


            $loan_id = $q['loan_id'];
            if($loan_id > 0){
            $loan_balance_ = $q['loan_balance'];
            $loan_balance = money($loan_balance_);
            $l = loan_obj($loan_id);
            $next_due = $l['next_due_date'];
            } else{
                $loan_balance = "<i>Unspecified</i>";
                $next_due ="<i>Unspecified</i>";
            }


            echo "<tr>
            <td>$uid</td>
            <td><span>$transaction_code</span></td>
            <td><span>$amount</span>
            </td>
            <td><span>$payment_date</span><br/> <span>".fancydate($payment_date)."</span></td>
            <td><span>$cust_names</span><br>$cust_phone</td>
            <td>$payment_method</td>
            <td><span class=\"text-green\"><i class=\"fa fa-check\"></i> Added</span></td>
            <td><span><a href=\"incoming-payments?repayment=".encurl($uid)."\"><span class=\"fa fa-eye text-green\"></span></a></span><h4></h4></td>
            </tr>";

            //////------Paging Variable ---
            //$page_total = $page_total + 1;
            /////=======Paging Variable ---


        }
    }else{
        echo "<tr><td colspan='13'><i>No Records Found</i></td></tr>";
    }                                                                                           
    ?>
    </tbody>


</table>