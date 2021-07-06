<?php
$pid = decurl($_GET['product']);
$y = fetchonerow("o_loan_products","uid='$pid'","*");
$name = $y['name'];
$description = $y['description'];
$period = $y['period'];
$period_units = $y['period_units'];
$min_amount = $y['min_amount'];
$max_amount = $y['max_amount'];
$pay_frequency = $y['pay_frequency'];
$percent_breakdown = $y['percent_breakdown'];
$added_date = $y['added_date'];
$status = $y['status'];   $status_name = status($status);

        $total_addons = countotal("o_product_addons","product_id='$pid' AND status=1");
        $total_deductions = countotal("o_product_deductions","product_id='$pid' AND status=1");
?>
<section class="content-header">
    <h1>
        Product Details
        <small><?php echo $name; ?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="index"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Products</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">

            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs nav-justified font-16">
                    <li class="nav-item nav-100 active"><a href="#tab_1" data-toggle="tab" aria-expanded="false"><i class="fa fa-info"></i> Details</a></li>
                    <li class="nav-item nav-100"><a href="#tab_2" data-toggle="tab" aria-expanded="false"><i class="fa fa-plus-circle"></i> AddOns</a></li>
                    <li class="nav-item nav-100"><a href="#tab_3" data-toggle="tab" aria-expanded="false"><i class="fa fa-minus-circle"></i> Deductions</a></li>
                    <li class="nav-item nav-100"><a href="#tab_4" data-toggle="tab" aria-expanded="false"><i class="fa fa-check-circle"></i> Loan Stages</a></li>
                    <li class="nav-item nav-100"><a href="#tab_5" data-toggle="tab" aria-expanded="false"><i class="fa fa-gear"></i> Reminder Settings</a></li>
                    <li class="nav-item nav-100"><a href="#tab_6" data-toggle="tab" aria-expanded="false"><i class="fa fa-bar-chart"></i> Stats</a></li>



                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">

                        <div class="row">
                            <div class="col-md-2">
                                <span class="info-box-icon"><i class="fa fa-info"></i></span>
                            </div>
                            <div class="col-md-7">
                                <table class="table-bordered font-14 table table-hover">
                                    <tr><td class="text-bold">CODE</td><td><?php echo $pid; ?></td></tr>
                                    <tr><td class="text-bold">Product Name</td><td><h3><?php echo $name; ?></h3></td></tr>
                                    <tr><td class="text-bold">Description</td><td><?php echo $description; ?></td></tr>
                                    <tr><td class="text-bold">Period</td><td><?php echo $period; ?> <?php echo $period_units; ?></td></tr>
                                    <tr><td class="text-bold">Payment Frequency</td><td><?php echo $pay_frequency; ?></td></tr>
                                    <tr><td class="text-bold">Min Value</td><td><?php echo $min_amount; ?></td></tr>
                                    <tr><td class="text-bold">Maximum Value</td><td><?php echo $max_amount; ?> </td></tr>
                                    <tr><td class="text-bold">AddOns</td><td><a href="" class="label label-default font-14"><?php echo $total_addons; ?> Addons</a></td></tr>
                                    <tr><td class="text-bold">Deductions</td><td><a href="" class="label label-default font-14"><?php echo $total_deductions; ?> Deductions</a></td></tr>
                                    <tr><td class="text-bold">Status</td><td><span class="text-success"><?php echo $status_name; ?></span></td></tr>

                                </table>
                            </div>
                            <div class="col-md-3">
                                <table class="table">
                                    <tr><td><button class="btn btn-success btn-block  btn-md grid-width-10"><i class="fa fa-plus-circle"></i> Add New Product</button></td></tr>
                                    <tr><td><button class="btn btn-primary btn-block btn-md"><i class="fa fa-pencil"></i> Edit this Product</button></td></tr>
                                    <tr><td><button class="btn btn-danger btn-block btn-md"><i class="fa  fa-times"></i> Delete this Product</button></td></tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_2">
                        <div class="row">
                            <div class="col-md-2">
                                <span class="info-box-icon"><i class="fa fa-plus-circle"></i></span>
                            </div>
                            <div class="col-md-7">
                                <table class="table-bordered font-14 table table-hover">
                                    <thead><tr><th>Name</th><th>Amount</th><th>Stage</th><th>Applied Automatically</th></th><th>Status</th></tr></thead>
                                    <tbody>
                                    <?php
                                    $o_addons_ = fetchtable('o_addons',"status=1", "uid", "desc", "0,50", "uid ,name ,description ,amount ,amount_type ,loan_stage, automatic ");
                                    while($c = mysqli_fetch_array($o_addons_))
                                    {
                                        $uid = $c['uid'];
                                        $name = $c['name'];
                                        $description = $c['description'];
                                        $amount = $c['amount'];
                                        $amount_type = $c['amount_type'];
                                        $loan_stage = $c['loan_stage'];
                                        $automatic = $c['automatic'];
                                              if($automatic == 1){
                                                  $auto = "YES";
                                              }else{
                                                  $auto = 'NO';
                                              }

                                              $addon = addon_exists($uid, $pid);


                                        echo "<tr><td>$name</td><td>$amount ($amount_type)</td><td>$loan_stage</td><td style='text-align: center;'>$auto</td><td> <span id='a$uid$pid'>$addon</span></td> </tr>";
                                    }
                                    ?>


                                    </tbody>


                                </table>
                            </div>
                            <div class="col-md-3">
                                <table class="table">
                                    <tr><td><a href="details?add-addon&return-to=loan_product=loan-products?product=<?php echo encurl($pid); ?>" class="btn btn-success"><i class="fa  fa-plus"></i> New Addon</a></td></tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_3">
                        <div class="row">
                            <div class="col-md-2">
                                <span class="info-box-icon"><i class="fa fa-plus-circle"></i></span>
                            </div>
                            <div class="col-md-7">
                                <table class="table-bordered font-14 table table-hover">
                                    <thead><th>Name</th><th>Amount</th><th>Stage</th><th>Applied Automatically</th><th>Status</th></tr></thead>
                                    <tbody>
                                    <?php
                                    $o_addons_ = fetchtable('o_deductions',"status=1", "uid", "desc", "0,50", "uid ,name ,description ,amount ,amount_type ,loan_stage, automatic ");
                                    while($c = mysqli_fetch_array($o_addons_))
                                    {
                                        $uid = $c['uid'];
                                        $name = $c['name'];
                                        $description = $c['description'];
                                        $amount = $c['amount'];
                                        $amount_type = $c['amount_type'];
                                        $loan_stage = $c['loan_stage'];
                                        $automatic = $c['automatic'];
                                        if($automatic == 1){
                                            $auto = "YES";
                                        }else{
                                            $auto = 'NO';
                                        }

                                        $deduction = deduction_exists($uid, $pid);

                                        echo "<tr><td>$name</td><td>$amount ($amount_type)</td><td>$loan_stage</td><td style='text-align: center;'>$auto</td><td> <span id='d$uid$pid'>$deduction</span> </td> </tr>";
                                    }
                                    ?>


                                    </tbody>


                                </table>
                            </div>
                            <div class="col-md-3">
                                <table class="table">
                                    <tr><td><a href="details?add-deduction&return-to=loan_product=loan-products?product=<?php echo encurl($pid); ?>" class="btn btn-success"><i class="fa  fa-plus"></i> New Deduction</a></td></tr>
                                </table>

                            </div>
                        </div>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_4">
                        <div class="row">
                            <div class="col-md-2">
                                <span class="info-box-icon"><i class="fa fa-check-circle"></i></span>
                            </div>
                            <div class="col-md-7">
                                <table class="table table-bordered font-14 table table-hover">
                                    <tr><th>#</th><th>Name</th><th>Description</th><th style="width: 20%;" colspan="2"> Status </th></tr>
                                    <tbody>
                                    <?php
                                    $stage = 1;
                                    $o_loan_stages_ = fetchtable('o_loan_stages',"status=1", "stage_order", "asc", "0,10", "uid ,name ,description ,stage_order ,permissions ");
                                    while($i = mysqli_fetch_array($o_loan_stages_))
                                    {
                                        $uid = $i['uid'];
                                        $name = $i['name'];
                                        $description = $i['description'];
                                        $stage_order = $i['stage_order'];
                                        $permissions = $i['permissions'];

                                        $stage_val = stage_exists($uid, $pid);

                                        echo "<tr><td>$stage</td><td>$name</td><td>$description</td><td colspan='2'><span id='s$uid$pid'>$stage_val</span></td></tr>";
                                        $stage = $stage + 1;
                                    }
                                    ?>
                                    </tbody>
                                    <tr><th>#</th><th>Name</th><th>Description</th><th colspan="2">Status</th></tr>

                                </table>
                            </div>
                            <div class="col-md-3">
                                <table class="table">
                                    <tr><td><a href="details?add-loan-stage&return-to=loan_product=loan-products?product=<?php echo encurl($pid); ?>" class="btn btn-success"><i class="fa  fa-plus"></i> New Stage</a></td></tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_5">
                        <div class="row">
                            <div class="col-md-2">
                                <span class="info-box-icon"><i class="fa fa-minus"></i></span>
                            </div>
                            <div class="col-md-7">
                                <table class="table-bordered font-14 table table-hover">
                                    <tbody>
                                    <tr><td>Total Customers</td><td>6</td> </tr>
                                    <tr><td>Total Active Loans</td><td>6</td> </tr>
                                    <tr><td>Total Repaid Loans</td><td>6</td> </tr>
                                    <tr><td>Total Defaulted Loans</td><td>6</td> </tr>

                                    </tbody>


                                </table>
                            </div>
                            <div class="col-md-3">
                                <table class="table">
                                    <tr><td><button class="btn btn-success"><i class="fa  fa-external-link-square"></i> Go to Loans</button></td></tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_6">
                        <div class="row">
                            <div class="col-md-2">
                                <span class="info-box-icon"><i class="fa fa-plus-circle"></i></span>
                            </div>
                            <div class="col-md-7">
                                <table class="table-bordered font-14 table table-hover">
                                    <thead><th>Name</th><th>Amount</th><th>Stage</th><th>Status</th></tr></thead>
                                    <tbody>
                                    <?php
                                    $o_addons_ = fetchtable('o_deductions',"status=1", "uid", "desc", "0,50", "uid ,name ,description ,amount ,amount_type ,loan_stage ");
                                    while($c = mysqli_fetch_array($o_addons_))
                                    {
                                        $uid = $c['uid'];
                                        $name = $c['name'];
                                        $description = $c['description'];
                                        $amount = $c['amount'];
                                        $amount_type = $c['amount_type'];
                                        $loan_stage = $c['loan_stage'];
                                        $status = "<a onclick=\"\" class=\"text-success\"><i class=\"fa fa-check\"></i> Added </a>";
                                        echo "<tr><td>$name</td><td>$amount ($amount_type)</td><td>$loan_stage</td><td> $status </td> </tr>";
                                    }
                                    ?>


                                    </tbody>


                                </table>
                            </div>
                            <div class="col-md-3">
                                <table class="table">
                                    <tr><td><a href="details?add-deduction&return-to=loan_product=loan-products?product=<?php echo encurl($pid); ?>" class="btn btn-success"><i class="fa  fa-plus"></i> New Deduction</a></td></tr>
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