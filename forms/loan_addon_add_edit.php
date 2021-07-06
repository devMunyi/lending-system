<section class="content-header">
    <h1>
        <?php echo arrow_back('loan-products','Repayments'); ?>
        <?php
        $aid = $_GET['addOnId'];
        if ($sid > 0) {
            $cust = fetchonerow('s_staff', "uid='" . decurl($sid) . "'");
            $customer_id = $_GET['customer-add-edit'];

            echo "AddOn <small>Edit</small>";
        } else {
            $cust = array();
            $customer_id = "";
            echo "AddOn <small>Add</small>";
        }
        ?>

    </h1>
    <ol class="breadcrumb">
        <li><a href="index"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">AddOn/Add</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">

            <!-- /.box -->

            <div class="box">

                <!-- /.box-header -->
                <div class="row">
                    <div class="col-sm-2">


                    </div>
                    <div class="col-xs-1"></div>
                    <div class="col-sm-6">
                        <!-- /.box-header -->

                        <h3>Loan AddOn <?php
                            if($aid > 0){
                                ?>
                                <a class="text-blue font-14 pull-right"
                                   href="customers?customer-add-edit=<?php echo $sid; ?>&referees">New AddOn
                                    <i class="fa fa-angle-double-right"></i></a>
                            <?php
                            }
                            ?></h3>
                            <form class="form-horizontal" onsubmit="return false;" method="post">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="addon_name" class="col-sm-3 control-label">Name</label>

                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="addon_name">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="addon_description" class="col-sm-3 control-label">Description</label>

                                        <div class="col-sm-9">
                                            <textarea class="form-control" id="addon_description"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="addon_amount" class="col-sm-3 control-label">Amount</label>

                                        <div class="col-sm-9">
                                            <input type="number" class="form-control" placeholder="In % or a Fixed Value" id="addon_amount">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="amount_type" class="col-sm-3 control-label">Type</label>

                                        <div class="col-sm-9">
                                            <select id="amount_type" class="form-control">
                                                <option value="PERCENTAGE">Percentage</option>
                                                <option value="FIXED_VALUE">Fixed Value</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="addon_name" class="col-sm-3 control-label">Loan Stage</label>

                                        <div class="col-sm-9">
                                            <select id="loan_stage" class="form-control">
                                                <option value="0">--Select One</option>
                                                <option value="CREATION">During Creation</option>
                                                <option value="APPROVAL">During Approval</option>
                                                <option value="PARTIAL_DEFAULT">Partial Default</option>
                                                <option value="FINAL_DEFAULT">Final Default</option>
                                                <option value="LOAN_EXTENSION">During Loan Extension</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="automatic" class="col-sm-3 control-label">Apply Automatically</label>

                                        <div class="col-sm-9">
                                            <select id="automatic" class="form-control">
                                                <option value="0">No</option>
                                                <option value="1">Yes</option>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9">
                                        <div class="box-footer">
                                            <br/>
                                            <button type="submit" class="btn btn-lg btn-default">Cancel</button>
                                            <button type="submit"
                                                    class="btn btn-success bg-green-gradient btn-lg pull-right"
                                                    onclick="addon_save('<?php echo $sid; ?>');">
                                                Save
                                            </button>
                                        </div>
                                    </div>

                                </div>
                                <!-- /.box-body -->

                                <!-- /.box-footer -->
                            </form>



                    </div>
                    <div class="col-sm-2 box-body">


                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
</section>
