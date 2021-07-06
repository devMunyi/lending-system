<section class="content-header">
    <h1>
        <?php echo arrow_back('loans','Loans'); ?>
        <?php
        $sid = $_GET['customer-add-edit'];
        if ($sid > 0) {
            $cust = fetchonerow('s_staff', "uid='" . decurl($sid) . "'");
            $customer_id = $_GET['customer-add-edit'];

            echo "Loan <small>Edit</small>";
        } else {
            $cust = array();
            $customer_id = "";
            echo "Loan <small>Add</small>";
        }
        ?>

    </h1>
    <ol class="breadcrumb">
        <li><a href="index"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Loan/Create</li>
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

                            <h3>Create a New Loan </h3>
                            <form class="form-horizontal" autocomplete="off" onsubmit="return false;" method="post">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="customer" class="col-sm-3 control-label">Customer</label>

                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" autocomplete="off" onkeyup="search_cust();" id="customer_search" placeholder="Start typing customer name ...">
                                            <input type="hidden" id="customer_id_">
                                        <div id="customer_results">

                                        </div>
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label for="product" class="col-sm-3 control-label">Product</label>

                                        <div class="col-sm-9">
                                            <select class="form-control" name="type_" id="product">
                                                <option value="0">--Select One</option>
                                                <?php
                                                $o_loan_products_ = fetchtable('o_loan_products',"status=1", "name", "asc", "0,10", "uid ,name ,description ");
                                                while($o = mysqli_fetch_array($o_loan_products_))
                                                {
                                                    $uid = $o['uid'];
                                                    $name = $o['name'];
                                                    $description = $o['description'];
                                                    echo "<option value=\"$uid\">$name</option>";
                                                }

                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="amount" class="col-sm-3 control-label">Amount</label>

                                        <div class="col-sm-9">
                                            <input class="form-control text-bold font-18" type="number" id="amount" placeholder="0.00">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="comments" class="col-sm-3 control-label">Comments</label>

                                        <div class="col-sm-9">
                                           <textarea class="form-control" id="comments"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9">
                                        <div class="box-footer">
                                            <br/>
                                            <button type="submit" class="btn btn-lg btn-default">Cancel</button>
                                            <button type="submit"
                                                    class="btn btn-success bg-green-gradient btn-lg pull-right"
                                                    onclick="create_loan('<?php echo $sid; ?>');">
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
                        <?php
                        include_once ("widgets/calculator.php");
                        ?>

                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
</section>
