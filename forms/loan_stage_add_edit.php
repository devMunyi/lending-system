<section class="content-header">
    <h1>
        <?php echo arrow_back('loan-products','Loan Products'); ?>
        <?php
        $sid = $_GET['stageId'];
        if ($sid > 0) {
           // $cust = fetchonerow('s_staff', "uid='" . decurl($sid) . "'");
          //  $customer_id = $_GET['customer-add-edit'];

            echo "Loan Stage <small>Edit</small>";
        } else {
            $cust = array();
            $customer_id = "";
            echo "Loan Stage <small>Add</small>";
        }
        $so = fetchmaxid('o_loan_stages',"status = 1","stage_order");
        $stage_order = $so['stage_order'] + 10;
        ?>

    </h1>
    <ol class="breadcrumb">
        <li><a href="index"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Loan Stage/Add</li>
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

                        <h3>Loan Stage <?php
                            if($sid > 0){
                                ?>
                                <a class="text-blue font-14 pull-right"
                                   href="customers?customer-add-edit=<?php echo $sid; ?>&referees">New Loan Stage
                                    <i class="fa fa-angle-double-right"></i></a>
                            <?php
                            }
                            ?></h3>
                            <form class="form-horizontal" onsubmit="return false;" method="post">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="deduction_name" class="col-sm-3 control-label">Name</label>

                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="deduction_name">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="deduction_description" class="col-sm-3 control-label">Description</label>

                                        <div class="col-sm-9">
                                            <textarea class="form-control" id="deduction_description"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="stage_order" class="col-sm-3 control-label">Stage Order</label>

                                        <div class="col-sm-9">
                                            <input type="number" class="form-control" value="<?php echo $stage_order; ?>" placeholder="In % or a Fixed Value" id="stage_order">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="can_addon" class="col-sm-3 control-label">Addon Allowed</label>

                                        <div class="col-sm-9">
                                            <select id="can_addon" class="form-control">
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="can_addon" class="col-sm-3 control-label">Deduction Allowed</label>

                                        <div class="col-sm-9">
                                            <select id="can_deduct" class="form-control">
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
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
                                                    onclick="stage_save('<?php echo $sid; ?>');">
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
