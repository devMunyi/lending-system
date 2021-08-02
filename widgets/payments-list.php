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
                                <a class="btn font-16 btn-md btn-default text-bold" href="#" onclick="mobile_payments('default_sort')"><i class="fa fa-chevron-circle-right"></i> All Payments</a>

                                <a class="btn font-16 btn-md btn-default text-bold" href="#" onclick="mobile_payments('sort_2')"><i class="fa fa-chevron-circle-right"></i> Mobile</a>
                                <a class="btn font-16 btn-md btn-default text-bold" href="#" onclick="bank_payments('sort_3')"><i class="fa fa-chevron-circle-right"></i> Bank</a>
                                <a class="btn font-16 btn-md btn-default text-bold" href="#" onclick="cash_payments('sort_4')"><i class="fa fa-chevron-circle-right"></i> Cash</a>


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
                            <th>Branch</th>
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
                        <tbody id="payment_list">



                        </tbody>
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Customer</th>
                            <th>Branch</th>
                            <th>Amount</th>
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
echo "<div style='display: none;'>".paging_values_hidden2("uid > 0",0,10,"uid","desc"," ","payment_list", "default_sort")."</div>";
?>
