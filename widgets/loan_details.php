<?php
$loan_id = $_GET['loan'];
recalculate_loan(decurl($loan_id));
$l = fetchonerow("o_loans","uid='".decurl($loan_id)."'","*");
$total_repaid = total_repaid(decurl($loan_id));
$balance = loan_balance(decurl($loan_id));
$product_ = fetchonerow("o_loan_products","uid='".$l['product_id']."'","name, disburse_method");
$product_name = $product_['name'];
$stage_name = fetchrow('o_loan_stages',"uid='".$l['loan_stage']."'","name");
$last_repay_date = "";    $last_repay_date_peep = "";
$next_repay_date = "";    $next_repay_date_peep = "";
$customer = fetchonerow("o_customers","uid='".$l['customer_id']."'","full_name, primary_mobile, national_id");
$status = $l['status'];
$state_name = loan_state($status);


$method = fetchonerow("o_disburse_methods","uid='".$product_['disburse_method']."'","name, via_api");
$method_name = $method['name'];
$via_api = $method['via_api'];
if($via_api == 1){
    $mode = "Automatically";
}
else{
    $mode = "Manually";
}

?>

<section class="content-header">
    <h1>
        Loan Details
        <small>Loan #<?php echo $loan_id;?> </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="index"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Loans</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <?php
            if(isset($_GET['just-created'])){
                 echo "<div class=\"alert bg-green\">
                <span class=\"text-white font-16 font-italic font-bold\"><i class=\"icon fa fa-check-circle\"></i> The Loan Was Created Successfully. You can add the AddOns or Deductions Now</span>
            </div>";
            }
            else{
              echo ' <div class="alert bg-yellow-gradient">
                <span class="text-black font-18 text-bold"><i class="icon fa fa-warning"></i> This loan requires your action</span>
            </div>';
            }
            ?>

            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs nav-justified font-16">
                    <li class="nav-item nav-100 active"><a href="#tab_1" data-toggle="tab" aria-expanded="false"><i class="fa fa-info"></i> Loan Info</a></li>
                    <li class="nav-item nav-100"><a href="#tab_2" onclick="loan_addons('<?php echo $loan_id; ?>')" data-toggle="tab" aria-expanded="false"><i class="fa fa-plus-circle"></i> AddOns</a></li>
                    <li class="nav-item nav-100"><a href="#tab_3" onclick="loan_deductions('<?php echo $loan_id; ?>')" data-toggle="tab" aria-expanded="false"><i class="fa fa-minus-circle"></i> Deductions</a></li>
                    <li class="nav-item nav-100"><a href="#tab_7" data-toggle="tab" aria-expanded="false"><i class="fa fa-calendar"></i> Pay Schedule</a></li>
                    <li class="nav-item nav-100"><a href="#tab_8" onclick="loan_collateral_list('<?php echo $loan_id; ?>')" data-toggle="tab" aria-expanded="false"><i class="fa fa-car"></i> Collateral</a></li>
                    <li class="nav-item nav-100"><a href="#tab_4" data-toggle="tab" aria-expanded="false"><i class="fa fa-arrow-circle-o-down"></i> Repayments</a></li>
                    <li style="display: none;" class="nav-item nav-100"><a href="#tab_5" data-toggle="tab" aria-expanded="false"><i class="fa fa-exchange"></i> Engagements</a></li>
                    <li class="nav-item nav-100"><a href="#tab_6" data-toggle="tab" aria-expanded="false"><i class="fa fa-clock-o"></i> Events</a></li>


                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">

                        <div class="row">
                            <div class="col-md-2">
                                <span class="info-box-icon"><i class="fa fa-info"></i></span>
                            </div>
                            <div class="col-md-6">
                                <table class="table-bordered font-14 table table-hover">
                                    <tr><td class="text-bold">CODE</td><td class="font-light font-18"><?php echo $loan_id; ?></td></tr>
                                    <tr><td class="text-bold">Customer</td><td><span class="font-16"><?php echo $customer['full_name'];  ?></span>
                                            <br/><span class="font-italic"><?php echo $customer['national_id'];  ?></span>
                                            <span class="font-italic text-muted"></span> <a href="customers?customer=<?php echo $l['customer_id'] ?>"><i class="fa fa-external-link"></i></a></td></tr>
                                    <tr><td class="text-bold">Amount</td><td><h4 class="text-bold"><?php echo money($l['loan_amount']);  ?></h4></td></tr>
                                    <tr><td class="text-bold">AddOns</td><td><?php echo money(loan_addons(decurl($loan_id))); ?></td></tr>
                                    <tr><td class="text-bold">Deductions</td><td><?php echo money(loan_deductions(decurl($loan_id))); ?></td></tr>
                                    <tr><td class="text-bold">Disbursed Amount</td><td><?php echo money($l['disbursed_amount']); ?></td></tr>
                                    <tr><td class="text-bold">Repayable Amount</td><td><?php echo money($l['total_repayable_amount']); ?></td></tr>
                                    <tr><td class="text-bold">Repaid</td><td><?php echo money($total_repaid); ?></td></tr>
                                    <tr><td class="text-bold">Balance</td><td><h4 class="text-red text-bold"><?php echo money($balance); ?></h4> </td></tr>
                                    <tr><td class="text-bold">Product</td><td><?php echo $product_name; ?></td></tr>
                                    <tr><td class="text-bold">Given Date</td><td><?php echo $l['given_date']; ?></td></tr>
                                    <tr><td class="text-bold">Due Date</td><td><?php echo $l['final_due_date']; ?></td></tr>
                                    <tr><td class="text-bold">Last Repay Date</td><td><?php echo $last_repay_date; ?>  <span class="label label-default"><?php echo ($last_repay_date_peep); ?></span></td></tr>
                                    <tr><td class="text-bold">Next Repay Date</td><td><?php echo $next_repay_date; ?>  <span class="label label-default"><?php echo ($next_repay_date_peep); ?></span></td></tr>
                                    <tr><td class="text-bold">Stage</td><td><?php echo ($stage_name); ?></td></tr>
                                    <tr><td class="text-bold">Status</td><td><?php echo ($state_name); ?></td></tr>

                                </table>
                                <table class="table">
                                    <tr><td><button class="btn btn-primary  btn-md grid-width-10"><i class="fa fa-edit"></i> Modify</button> - <button class="btn btn-default btn-md"><i class="fa fa-flag"></i>Flag</button> <button onclick="loan_action('<?php echo $loan_id ?>',0, 'Delete this loan')" class="btn btn-danger btn-md pull-right"><i class="fa fa-trash"></i>Delete Loan</button></td></tr>
                                </table>
                            </div>
                            <div class="col-md-4">
                                <?php

                                if($status == 1) {
                                    ?>
                                    <h4 class="font-bold">Loan Stages</h4>
                                    <div id="loan_stages">
                                        Loading stages...
                                    </div>

                                    <?php
                                }
                                elseif ($status == 2){
                                    //////------Pending Disbursement
                                   echo "<h4 class=\"font-bold\">Loan Status ".$state_name."</h4>";
                                   if($via_api == 1) {
                                       $resend_action = "<button class='btn btn-block btn-primary bg-blue-gradient'><i class='fa fa-refresh'></i> Resend</button>";
                                       echo "<div class='well well-sm'>
                                           <h4 class='font-italic'>The loan will be sent automatically via <b>$method_name</b> </h4>
                                            $resend_action
                                          </div>";
                                   }
                                   else{
                                       $record_action = "<button class='btn btn-block btn-primary bg-blue-gradient'><i class='fa fa-check'></i> Done</button>";
                                       echo "<div class='well well-sm'>
                                           <h4 class='font-italic'>Please send the funds manually via <b>$method_name</b> </h4>
                                           $record_action
                                          </div>";
                                   }

                                }
                                elseif ($status == 3){
                                    echo "<h4 class=\"font-bold\">Loan Status ".$state_name."</h4>";
                                }
                                elseif ($status == 4){
                                    echo "<h4 class=\"font-bold\">Loan Status ".$state_name."</h4>";
                                }
                                elseif ($status == 5){
                                    ////-------Cleared
                                    echo "<h4 class=\"font-bold\">Loan Status ".$state_name."</h4>";
                                    echo "<br/><div class='well well-sm'><button class='btn btn-block btn-primary bg-blue-gradient'>Mark as Not Cleared</button></div>";
                                }
                                elseif ($status == 6){
                                    echo "<h4 class=\"font-bold\">Loan Status ".$state_name."</h4>";


                                }
                                ?>


                            </div>
                        </div>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_2">
                        <div class="row">
                            <div class="col-md-2">
                                <span class="info-box-icon"><i class="fa fa-plus-circle"></i></span>
                            </div>
                            <div class="col-md-7" id="loan_addons">
                                   Loading...
                            </div>
                            <div class="col-md-3">
                                <table class="table">
                                    <tr><td><button class="btn btn-default"><i class="fa  fa-gear"></i> AddOn Settings</button></td></tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_3">
                        <div class="row">
                            <div class="col-md-2">
                                <span class="info-box-icon"><i class="fa fa-minus"></i></span>
                            </div>
                            <div class="col-md-7">
                                <div class="col-md-7" id="loan_deductions">
                                    Loading...
                                </div>
                            </div>
                            <div class="col-md-3">
                                <table class="table">
                                    <tr><td><button class="btn btn-default"><i class="fa  fa-gear"></i> Deduction Settings</button></td></tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_4">
                        <div class="row">
                            <div class="col-md-2">
                                <span class="info-box-icon"><i class="fa fa-arrow-circle-o-down"></i></span>
                            </div>
                            <div class="col-md-7">
                                <table class="table-bordered font-14 table table-hover">
                                    <thead><tr><th>ID</th><th>Transcode</th><th>Amount</th><th>Date</th><th>Payer Details</th><th>Payer Method</th><th>Status</th><th>Action</th></tr></thead>
                                    <tbody>
                                    <tr><td>1</td><td>RTGFFEEERTGF</td><td>40,000.00</td><td>5/6/2001</td><td>Jonah Ngarama <br/> 0716456789</td><td>Mpesa</td><td> <span class="text-success"><i class="fa fa-check"></i> Added </span></td><td> <a><i class="fa  fa-eye"></i> </a></td> </tr>
                                    <tr><td>1</td><td>RTGFFEEERTGF</td><td>40,000.00</td><td>5/6/2001</td><td>Jonah Ngarama <br/> 0716456789</td><td>Cash</td><td><span class="text-success"><i class="fa fa-check"></i> Added </span></td><td> <a><i class="fa  fa-eye"></i> </a></td> </tr>

                                    </tbody>


                                </table>
                            </div>
                            <div class="col-md-3">
                                <table class="table">
                                    <tr><td><button class="btn btn-success btn-block btn-md"><i class="fa fa-plus"></i> Record Payment</button></td></tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_5">
                        <div class="row">
                            <div class="col-md-2">
                                <span class="info-box-icon"><i class="fa fa-exchange"></i></span>
                            </div>
                            <div class="col-md-7">
                                <table class="table-bordered font-14 table table-hover">
                                    <thead><tr><th>Date</th><th>Agent</th><th>Method</th><th>Outcome</th></tr></thead>
                                    <tbody>
                                    <tr><td>4/01/2020 5:00AM</td><td>Jonah Ngarama</td><td><i class="fa fa-phone"></i> Call</td><td>Closed</td> </tr>
                                    <tr><td>Toyota Corolla</td><td>Motor Vehicle</td><td><i class="fa fa-phone"></i> Call</td><td>Call Back</td> </tr>

                                    </tbody>


                                </table>
                            </div>
                            <div class="col-md-3">
                                <table class="table">
                                    <tr><td><button class="btn btn-success btn-block btn-md"><i class="fa fa-plus"></i> New Engagement</button></td></tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_6">
                        <div class="row">
                            <div class="col-md-2">
                                <span class="info-box-icon"><i class="fa fa-clock-o"></i></span>
                            </div>
                            <div class="col-md-10">
                                <table class="table-bordered font-14 table table-hover">
                                    <thead><tr><th>Event</th><th>Date</th></tr></thead>
                                    <tbody>
                                    <?php
                                    $o_events_ = fetchtable('o_events',"tbl='o_loans' AND fld='".decurl($loan_id)."'", "uid", "desc", "0,100", "uid ,event_details ,event_date ");
                                    if(mysqli_num_rows($o_events_) > 0) {
                                        while ($k = mysqli_fetch_array($o_events_)) {
                                            $uid = $k['uid'];
                                            $event_details = $k['event_details'];
                                            $event_date = $k['event_date'];
                                            echo "<tr><td>$event_details</td><td>$event_date</td> </tr>";
                                        }
                                    }
                                    else{
                                        echo "<tr><td colspan='2'> <i>No Records Found</i></td> </tr>";
                                    }

                                    ?>




                                    </tbody>


                                </table>
                            </div>

                        </div>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_7">
                        <div class="row">
                            <div class="col-md-2">
                                <span class="info-box-icon"><i class="fa fa-minus"></i></span>
                            </div>
                            <div class="col-md-7">
                                <table class="table-bordered font-14 table table-hover">
                                    <thead><tr><th>Date</th><th>Amount</th><th>Status</th</tr></thead>
                                    <tbody>
                                    <?php

                                    $schedule = repay_schedule(decurl($loan_id));
                                    echo "$schedule";

                                    ?>

                                    </tbody>


                                </table>
                            </div>
                            <div class="col-md-3">
                                <table class="table">
                                    <tr><td><button class="btn btn-default"><i class="fa  fa-print"></i> Print Schedule</button></td></tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="tab_8">
                        <div class="row">
                            <div class="col-md-2">
                                <span class="info-box-icon"><i class="fa fa-car"></i></span>
                            </div>
                            <div class="col-md-7" id="collateral_">
                               Loading collateral ...
                            </div>
                            <div class="col-md-3">
                                <table class="table">
                                    <tr><td><button class="btn btn-default"><i class="fa  fa-edit"></i> Edit Schedule</button></td></tr>
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