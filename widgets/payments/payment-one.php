<section class="content-header">
    <?php
    $rep_ = $_GET['repayment']; $rep = decurl($rep_);
    $j = fetchonerow("o_incoming_payments","uid= $rep","*");
    $customer_id = $j['customer_id'];
    $payment_method = $j['payment_method'];
    $mobile_number = $j['mobile_number'];
    $amount = $j['amount'];
    $transaction_code = $j['transaction_code'];
    $loan_id = $j['loan_id'];
    $payment_date = $j['payment_date'];
    $record_method = $j['record_method'];
    $status = $j['status'];

    $pay_meth = fetchrow('o_payment_methods',"uid='$payment_method'","name");
    if($customer_id > 0){
        $i = fetchonerow("o_customers","uid='$customer_id'","full_name, primary_mobile, national_id");
        $full_name = $i['full_name'];
        $primary_mobile = $i['primary_mobile'];
        $national_id = $i['national_id'];
    }
    else{
        $full_name = "<i>Unspecified</i>";
    }
    $loan_id = $j['loan_id'];
    if($loan_id > 0){
        $loan_balance_ = $j['loan_balance'];
        $loan_balance = money($loan_balance_);
        $l = loan_obj($loan_id);
        $next_due = $l['next_due_date'];
    } else{
        $loan_balance = "<i>Unspecified</i>";
        $next_due ="<i>Unspecified</i>";
    }
    ?>
    <h1>
     <?php echo arrow_back("incoming-payments","Payments") ?>   Payment Info
        <small>Payment #<?php echo encurl($rep); ?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="index"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Payments</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs nav-justified font-16">
                    <li class="nav-item nav-100 active"><a href="#tab_1" data-toggle="tab" aria-expanded="false"><i class="fa fa-info"></i> Payment Info</a></li>
                    <li class="nav-item nav-100"><a href="#tab_4" data-toggle="tab" aria-expanded="false"><i class="fa fa-clock-o"></i> Other Payments</a></li>


                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">

                        <div class="row">
                            <div class="col-md-2">
                                <span class="info-box-icon"><i class="fa fa-info"></i></span>
                            </div>
                            <div class="col-md-7">
                                <table class="table-bordered font-14 table table-hover">
                                    <tr><td class="text-bold">UID</td><td><?php echo $rep_; ?></td></tr>
                                    <tr><td class="text-bold">Customer</td><td><?php echo $full_name; ?>
                                            <span class="font-italic text-muted"></span><?php echo $national_id; ?> <a href="customers?customer=<?php echo encurl($customer_id) ?>"><i class="fa fa-external-link"></i></a></td></tr>
                                    <tr><td class="text-bold">Amount</td><td><h4 class = "text-bold text-20"><?php echo money($amount); ?></h4></td></tr>
                                    <tr><td class="text-bold">Pay Method</td><td><?php echo $pay_meth; ?></td></tr>
                                    <tr><td class="text-bold">Record Type</td><td><?php echo $record_method; ?></td></tr>
                                    <tr><td class="text-bold">Loan Balance</td><td><h4 class="text-bold text-20 text-danger"><?php echo $loan_balance_; ?></h4></td></tr>
                                    <tr><td class="text-bold">Pay Date</td><td><?php echo $payment_date; ?> </td></tr>
                                    <tr><td class="text-bold">Transaction Code</td><td><?php echo $transaction_code; ?></td></tr>


                                </table>
                            </div>
                            <div class="col-md-3">
                                <table class="table">
                                    <tr><td><a href="incoming-payments?add-edit" class="btn btn-success btn-block  btn-md grid-width-10"><i class="fa fa-plus"></i> Add a Payment</a></td></tr>
                                    <tr><td><a href="incoming-payments?add-edit=<?php echo $rep_; ?>" class="btn btn-warning btn-block btn-md"><i class="fa fa-pencil"></i> Edit this Payment</a></td></tr>

                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.tab-pane -->
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_4">
                        <div class="row">
                            <div class="col-md-2">
                                <span class="info-box-icon"><i class="fa fa-clock-o"></i></span>
                            </div>
                            <div class="col-md-8">
                                <table class="table-bordered font-14 table table-hover">
                                    <thead>
                                    <tr>
                                        <th>ID</th>

                                        <th>Amount</th>
                                        <th>Pay Method</th>
                                        <th>Record Type</th>
                                        <th>Transaction Code</th>
                                        <th>Loan Balance</th>
                                        <th>Pay Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php

                                    //-----------------------------Reused Query
                                    $o_pays_ = fetchtable('o_incoming_payments', "customer_id=$customer_id AND status > 0", "uid", "desc", "0,1000", "*");
                                    ///----------Paging Option
                                    $alltotal = countotal("o_incoming_payments", "customer_id=$customer_id AND status > 0");
                                    ///==========Paging Option
                                    if ($alltotal > 0) {
                                        while ($q = mysqli_fetch_array($o_pays_)) {
                                            $uid = $q['uid'];
                                            $payment_method = $q['payment_method']; $pay_meth = fetchrow('o_payment_methods',"uid='$payment_method'","name");
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


                                            $row .= "<tr>
    <td>$uid</td>
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
                                      echo $row;
                                    ?>


                                    </tbody>


                                </table>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- /.tab-content -->
            </div>
        </div>
    </div>
</section>
