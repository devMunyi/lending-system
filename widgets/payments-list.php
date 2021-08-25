<section class="content-header">
    <h1>
        Incoming Payments
        <small>List</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="index"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Payments</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">

            <!-- /.box -->

            <div class="box">
                <div class="box-header bg-info">
                    <div class="row">
                        <div class="col-md-9">
                            <h3 class="box-title">
                                <select class="btn font-16 btn-md btn-default text-bold top-select" id="repayment_method" onchange="repayment_filters()">
                                    <option value = "0"> All Payments</option>
                                    <?php
                                    $pay_methods = fetchtable("o_payment_methods", "status > 0", "uid", "asc", "0,100", "uid, name" );
                                    while ($m = mysqli_fetch_array($pay_methods)) {
                                        $uid = $m['uid'];
                                        $name = $m['name'];
                                        echo "<option value=\"$uid\">$name</option>";
                                    }
                                    ?>
                                </select>

                                <select class="btn font-16 btn-md btn-default text-bold top-select" id="repayment_order" onchange="repayment_filters()">
                                    <option value="desc">Newest First</option>
                                    <option value="asc">Oldest First</option>
                                </select>


                                <select class="btn font-16 btn-md btn-default text-bold top-select" id="sel_branch" onchange="repayment_filters()">
                                    <option value="0">All Branches</option>
                                    <?php
                                    $o_branches_ = fetchtable('o_branches',"status > 0", "name", "asc", "0,100", "uid ,name ");
                                    while($w = mysqli_fetch_array($o_branches_))
                                    {
                                        $uid = $w['uid'];
                                        $name = $w['name'];
                                        echo "<option value='$uid'>$name</option>";
                                    }
                                    ?>
                                </select>
                            </h3>

                        </div>

                        <div class="col-md-3">

                            <a href="?add-edit" class="btn btn-success pull-right"><i class="fa fa-plus"></i> RECORD PAYMENT</a>
                        </div>
                        
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-condensed table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Customer</th>
                            <th>Amount Paid</th>
                            <th>Pay Method</th>
                            <th>Record Type</th>
                            <th>Transaction Code</th>
                            <th>Loan Balance</th>
                            <th>Pay Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody id="payment_list">



                        </tbody>
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Customer</th>
                            <th>Amount Paid</th>
                            <th>Pay Method</th>
                            <th>Record Type</th>
                            <th>Transaction Code</th>
                            <th>Loan Balance</th>
                            <th>Pay Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
</section>
<?php
echo "<div style='display: none;'>".paging_values_hidden("uid > 0",0,10,"uid","desc"," ","payment_list")."</div>";
?>
