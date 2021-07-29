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
                        <div class="col-md-10">

                            <h3 class="box-title">


                                <a class="btn font-16 btn-md btn-default text-bold" href=""><i class="fa fa-info-circle"></i> ALL Payments</a>
                                <a class="btn font-16 btn-md btn-default text-bold" href=""><i class="fa fa-chevron-circle-right"></i> Latest</a>
                                <a class="btn font-16 btn-md btn-default text-bold" href=""><i class="fa fa-chevron-circle-right"></i> Mobile</a>
                                <a class="btn font-16 btn-md btn-default text-bold" href=""><i class="fa fa-chevron-circle-right"></i> Bank</a>
                                <a class="btn font-16 btn-md btn-default text-bold" href=""><i class="fa fa-chevron-circle-right"></i> Cash</a>

                            </h3>


                        </div>
                        <div class="col-md-2">

                            <a href="?add-edit" class="btn btn-success float-right"><i class="fa fa-plus"></i> RECORD PAYMENT</a>
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
echo "<div style='display: none;'>".paging_values_hidden('status > -1',0,10,'uid','desc','','payment_list')."</div>";
?>
