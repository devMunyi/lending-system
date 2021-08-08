<div class="row">
    <div class="col-xs-12">

        <!-- /.box -->

        <div class="box">
            <div class="box-header bg-info">
                <div class="row">
                    <div class="col-md-10">
                        <?php
                        if(isset($_GET['approvals'])) {

                            ?>
                            <h3 class="box-title">

                                <a class="btn font-16 text-black font-bold" href=""><i class="fa fa-check-square-o"></i>REQUIRES YOUR APPROVAL <label id="approvals" class="label label-danger"></label></a>
                            </h3>
                            <?php
                        }
                        else {
                            ?>
                            <h3 class="box-title">
                                <select class="btn font-16 btn-default btn-md btn-default text-bold top-select" id="loan_order" onchange="loan_filters()">
                                    <option value="desc">Newest First</option>
                                    <option value="asc">Oldest First</option>
                                </select>
                                <select class="btn font-16 btn-default btn-md btn-default text-bold top-select" id="sel_product" onchange="loan_filters()">
                                    <option value="0">All Products</option>
                                    <?php
                                    $o_loan_products_ = fetchtable('o_loan_products',"status=1", "name", "asc", "0,100", "uid ,name ");
                                    while($t = mysqli_fetch_array($o_loan_products_))
                                    {
                                        $uid = $t['uid'];
                                        $name = $t['name'];
                                        echo "<option value='$uid'>$name</option>";
                                    }

                                    ?>

                                </select>
                                <select class="btn font-16 btn-default btn-md btn-default text-bold top-select" id="sel_branch" onchange="loan_filters()">
                                    <option value="0">All Branches</option>
                                    <?php
                                    $o_branches_ = fetchtable('o_branches',"status!=0", "name", "asc", "0,100", "uid ,name ");
                                    while($w = mysqli_fetch_array($o_branches_))
                                    {
                                        $uid = $w['uid'];
                                        $name = $w['name'];
                                        echo "<option value='$uid'>$name</option>";
                                    }
                                    ?>
                                </select>
                                <select class="btn font-16 btn-default btn-md btn-default text-bold top-select" id="sel_stage" onchange="loan_filters()">
                                    <option value="0">All Stages</option>
                                    <?php
                                    $o_loan_stages_ = fetchtable('o_loan_stages',"status=1", "uid", "desc", "0,100", "uid ,name ");
                                    while($p = mysqli_fetch_array($o_loan_stages_))
                                    {
                                        $uid = $p['uid'];
                                        $name = $p['name'];
                                        echo "<option value='$uid'>$name</option>";
                                    }

                                    ?>
                                </select>
                                <select class="btn font-16 btn-default btn-md btn-default text-bold top-select" id="sel_status" onchange="loan_filters()">
                                    <option>All Statuses</option>
                                    <?php
                                    $o_loan_statuses_ = fetchtable('o_loan_statuses',"status=1", "name", "desc", "0,100", "uid ,name ");
                                    while($l = mysqli_fetch_array($o_loan_statuses_))
                                    {
                                        $uid = $l['uid'];
                                        $name = $l['name'];
                                        echo "<option value='$uid'>$name</option>";
                                    }
                                    ?>
                                </select>

                            </h3>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="col-md-2">

                        <a href="loans?loan-add-edit" class="btn btn-success float-right"><i class="fa fa-plus"></i> CREATE LOAN</a>
                    </div>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table font-13 table-bordered table-condensed table-striped">
                    <thead>
                    <tr>
                        <th>CODE</th>
                        <th>Customer</th>
                        <th>Amount</th>
                        <th>AddOns</th>
                        <th>Deductions</th>
                        <th>Repaid</th>
                        <th>Balance</th>
                        <th>Given</th>
                        <th>Due</th>
                        <th>Stage</th>
                        <th>Status</th>
                        <th>Flag</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody id="loan_list">




                    </tbody>
                    <tfoot>
                    <tr>
                        <th>CODE</th>
                        <th>Customer</th>
                        <th>Amount</th>
                        <th>AddOns</th>
                        <th>Deductions</th>
                        <th>Repaid</th>
                        <th>Balance</th>
                        <th>Given</th>
                        <th>Due</th>
                        <th>Stage</th>
                        <th>Status</th>
                        <th>Flag</th>
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
<?php
echo "<div style='display: none;'>".paging_values_hidden('status > -1',0,10,'uid','desc','','loan_list')."</div>"
?>