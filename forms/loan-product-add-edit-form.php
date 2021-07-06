<section class="content-header">
    <h1>
        <?php echo arrow_back('loan-products','Loan Products'); ?>
        <?php
        $sid = $_GET['product-add-edit'];
        if ($sid > 0) {
            $cust = fetchonerow('s_staff', "uid='" . decurl($sid) . "'");
            $customer_id = $_GET['customer-add-edit'];

            echo "Product <small>Edit</small>";
        } else {
            $cust = array();
            $customer_id = "";
            echo "Product <small>Add</small>";
        }
        ?>

    </h1>
    <ol class="breadcrumb">
        <li><a href="index"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Product/Add</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">

            <!-- /.box -->

            <div class="box">

                <!-- /.box-header -->
                <div class="row">

                    <div class="col-xs-1"></div>
                    <div class="col-sm-6">
                        <!-- /.box-header -->
                        <!-- form start -->

                        <h3>Create a New Loan Product </h3>
                        <form class="form-horizontal" onsubmit="return false;" method="post">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="product_name" class="col-sm-3 control-label">Product Name</label>

                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" id="product_name">
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label for="description" class="col-sm-3 control-label">Product Description</label>

                                    <div class="col-sm-9">
                                        <textarea class="form-control" id="description"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="period" class="col-sm-3 control-label">Period</label>

                                    <div class="col-sm-5">
                                        <input class="form-control" type="number" id="period" placeholder="1">
                                    </div>
                                    <div class="col-sm-4">
                                       <select class="form-control" id="period_units">
                                           <option value="1">Day(s)</option>
                                           <option value="7">Week(s)</option>
                                           <option value="30">Month(s)</option>
                                           <option value="365">Year(s)</option>
                                       </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="min_amount" class="col-sm-3 control-label">Min Amount</label>

                                    <div class="col-sm-9">
                                        <input class="form-control" type="number" id="min_amount">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="max_amount" class="col-sm-3 control-label">Max Amount</label>

                                    <div class="col-sm-9">
                                        <input class="form-control" type="number" id="max_amount">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="pay_frequency" class="col-sm-3 control-label">Pay Frequency</label>

                                    <div class="col-sm-9">
                                        <select class="form-control" id="pay_frequency">
                                            <option value="0">Any</option>
                                            <option value="1">Daily</option>
                                            <option value="7">Weekly</option>
                                            <option value="14">ByWeekly</option>
                                            <option value="30">Monthly</option>
                                            <option value="60">Two Months</option>
                                            <option value="90">Quarterly</option>
                                            <option value="180">SemiAnnually</option>
                                            <option value="360">Annually</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="payment_breakdown" class="col-sm-3 control-label">Payment Breakdown</label>

                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" placeholder="e.g. 20, 30, 50. Leave black for equal breakdown" id="payment_breakdown">
                                    </div>
                                </div>

                                <div class="col-sm-3"></div>
                                <div class="col-sm-9">
                                    <div class="box-footer">
                                        <br/>
                                        <button type="submit" class="btn btn-lg btn-default">Cancel</button>
                                        <button type="submit"
                                                class="btn btn-success bg-green-gradient btn-lg pull-right"
                                                onclick="save_loan_product('<?php echo $pid; ?>');">
                                            Create
                                        </button>
                                    </div>
                                </div>

                            </div>
                            <!-- /.box-body -->

                            <!-- /.box-footer -->
                        </form>

                    </div>
                    <div class="col-xs-1"></div>
                    <div class="col-sm-4 card">


                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
</section>
