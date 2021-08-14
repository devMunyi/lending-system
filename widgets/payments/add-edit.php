<?php
$rep_id = $_GET['add-edit'];
?>

<section class="content-header">
    <h1>
        <?php
        if($rep_id  > 0){
            $p = fetchonerow("o_incoming_payments","uid='".decurl($rep_id)."'","*");

            echo arrow_back("incoming-payments?repayment=".$rep_id,"Payment")." Edit Payment
        <small>Payment #$rep_id</small>";
        }
        else{
            echo arrow_back("incoming-payments","Payments")."Add Payment<small>New</small>";
            $P = array();
        }
        ?>

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

                    <li class="nav-item nav-100 active"><a href="#tab_1" data-toggle="tab" aria-expanded="false"><i class="fa fa-save"></i> Record Payment</a></li>
                    <li class="nav-item nav-100"><a href="#tab_2" data-toggle="tab" aria-expanded="false"><i class="fa fa-cloud-upload"></i> Upload Payments (CSV File Only)</a></li>



                </ul>
                <div class="tab-content">

                    <!-- /.tab-pane -->
                    <!-- /.tab-pane -->
                    <div class="tab-pane active" id="tab_1">
                        <div class="row">
                            <div class="col-md-2">
                                <span class="info-box-icon"><i class="fa fa-save"></i></span>
                            </div>
                            <div class="col-md-6">

                                <form class="form-horizontal" onsubmit="return false;">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="payment_code" class="col-sm-3 control-label">Transaction Code</label>
                                            <div class="col-sm-9">
                                                <input type="hidden" value="<?php echo $_GET['add-edit']; ?>" id="pid">
                                                <input type="text" class="form-control" value="<?php echo $p['transaction_code'] ?>" id="payment_code" name="title">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="payment_code" class="col-sm-3 control-label">Amount</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" value="<?php echo $p['amount'] ?>" id="amount" name="amount">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="mobile_number" class="col-sm-3 control-label">Mobile Number</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control"  value="<?php echo $p['mobile_number']; ?>" id="mobile_number" name="mobile_number">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="loan_code" class="col-sm-3 control-label">Loan Code</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control"  value="<?php echo encurl($p['loan_id']); ?>" id="loan_code" name="loan_code">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="description" class="col-sm-3 control-label">Comments</label>

                                            <div class="col-sm-9">
                                                <textarea class="form-control" id="comments" name="description"><?php echo $p['comments']; ?></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="payment_method" class="col-sm-3 control-label">Payment Method</label>

                                            <div class="col-sm-9">
                                                <select class="form-control" name="type_" id="payment_method">
                                                    <option value="0">--Select One</option>
                                                    <?php
                                                    $met = fetchtable('o_payment_methods',"status=1", "uid", "asc", "0,10", "uid ,name ,account_details ");
                                                    while($m = mysqli_fetch_array($met))
                                                    {
                                                        $uid = $m['uid'];
                                                        $name = $m['name'];
                                                        if($uid == $p['payment_method']){
                                                            $selected = 'SELECTED';
                                                        }else{
                                                            $selected = "";
                                                        }
                                                        echo "<option $selected value=\"$uid\">$name</option>";
                                                    }

                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">

                                            <label for="date_made" class="col-sm-3 control-label">Date Made</label>

                                            <div class="col-sm-9">
                                                <input type="date" class="form-control"  value="<?php echo datefromdatetime2($p['payment_date']) ?>" id="date_made">
                                            </div>
                                        </div>


                                        <div class="col-sm-3">

                                        </div>
                                        <div class="col-sm-9">
                                            <div class="box-footer">
                                                <br>
                                                <button type="submit" class="btn btn-lg btn-default">Cancel</button>
                                                <button type="submit" class="btn btn-success btn-lg pull-right" onclick="payment_save();">Save
                                                </button>
                                            </div>

                                        </div>

                                    </div>
                                    <!-- /.box-body -->

                                    <!-- /.box-footer -->
                                </form>
                            </div>
                            <div class="col-md-4">
                                <?php
                                if($rep_id  > 0){
                                    echo "<a class='btn btn-primary' href='incoming-payments?add-edit'><i class='fa fa-plus'></i> New Payment</a>";
                                }
                                ?>
                            </div>

                        </div>
                    </div>
                    <div class="tab-pane" id="tab_2">
                        <div class="row">
                            <div class="col-md-2">
                                <span class="info-box-icon"><i class="fa fa-cloud-upload"></i></span>
                            </div>
                            <div class="col-md-6">
                                <form class="form-horizontal" id="doc-upload" method="POST" action="action/payments/upload" enctype="multipart/form-data">
                                    <div class="box-body">

                                        <div class="form-group">
                                            <label for="file_" class="col-sm-3 control-label">File</label>

                                            <div class="col-sm-9">
                                                <input type="file" class="form-control" id="file_" name="file_">
                                            </div>
                                        </div>
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-9">
                                            <div class="box-footer">
                                                <br>
                                                <div class="prgress">
                                                    <div class="messagedoc-upload" id="message"></div>
                                                    <div class="progressdoc-upload" id="progress">
                                                        <div class="bardoc-upload" id="bar"></div>
                                                        <br>
                                                        <div class="percentdoc-upload" id="percent"></div>
                                                    </div>
                                                </div>

                                                <button type="submit" class="btn btn-lg btn-default">Cancel</button>
                                                <button type="submit" class="btn btn-success btn-lg pull-right" onclick="formready('doc-upload');">Upload
                                                </button>
                                            </div>

                                        </div>

                                    </div>
                                    <!-- /.box-body -->

                                    <!-- /.box-footer -->
                                </form>
                            </div>

                        </div>
                    </div>

                </div>
                <!-- /.tab-content -->
            </div>
        </div>
    </div>
</section>
