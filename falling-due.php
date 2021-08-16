<?php
session_start();
include_once("php_functions/authenticator.php");
include_once ("php_functions/functions.php");
include_once ("configs/conn.inc");

$company = company_settings();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $company['name']; ?> | Falling Due</title>
    <!-- Tell the browser to be responsive to screen width -->
    <?php
    include_once('header_includes.php');
    ?>
</head>
<body class="hold-transition skin-purple sidebar-mini">
<div class="wrapper">

    <?php
    include_once('header.php');
    ?>
    <!-- Left side column. contains the logo and sidebar -->
    <?php
    include_once('menu.php');
    ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->


        <!-- Main content -->


            <section class="content-header">
                <h1>
                    Falling Due
                    <small>List</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="index"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Falling Due</li>
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
                                                <a onclick="defaulters_filter('all')" class="btn font-16 btn-md bg-navy text-bold" href="#"><i class="fa fa-clone"></i>All</a>
                                                <a onclick="defaulters_filter('today')" class="btn font-16 btn-md btn-danger text-bold" href="#"><i class="fa fa-info-circle"></i> Today</a>
                                                <a onclick="defaulters_filter('tomorrow')" class="btn font-16 btn-md btn-warning text-bold" href="#"><i class="fa fa-chevron-circle-right"></i> Tomorrow</a>
                                                <a onclick="defaulters_filter('2days')" class="btn font-16 btn-md bg-orange text-bold" href="#"><i class="fa fa-chevron-circle-right"></i> 2 Days</a>
                                                <a onclick="defaulters_filter('3days')" class="btn font-16 btn-md btn-primary text-bold" href="#"><i class="fa fa-chevron-circle-right"></i> 3 Days</a>
                                                <a onclick="defaulters_filter('7days')" class="btn font-16 btn-md bg-purple text-bold" href="#"><i class="fa fa-chevron-circle-right"></i> 7 Days</a>
                                                <a onclick="defaulters_filter('14days')" class="btn font-16 btn-md btn-success text-bold" href="#"><i class="fa fa-chevron-circle-right"></i> 14 Days</a>
                                                <a onclick="defaulters_filter('custom')" class="btn font-16 btn-md btn-default text-bold" href="#"><i class="fa fa-chevron-circle-right"></i> Custom</a>
                                          </h3>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>CODE</th>
                                        <th>Customer</th>
                                        <th>Amount</th>
                                        <th>AddOns</th>
                                        <th>Deductions</th>
                                        <th>Repaid</th>
                                        <th>Balance</th>
                                        <th>Given Date</th>
                                        <th>Due Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody id="falling_due_list">

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
                                        <th>Given Date</th>
                                        <th>Due Date</th>
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
            echo "<div style='display: none ;'>".paging_values_hidden2('uid > 0',0,10,'uid','desc','', 'falling_due_list', 'all')."</div>";
            ?>
        <!-- /.content -->
    </div>

    <!-- /.content-wrapper -->
    <?php
    include_once("footer.php");
    ?>


    <!-- Control Sidebar -->

    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<?php
include_once("footer_includes.php");
?>
<script>
    $(function () {
        /*$('#example1').DataTable()
        $('#example2').DataTable({
            'paging'      : true,
            'lengthChange': false,
            'searching'   : false,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false
        })
        */
        falling_due_list();
        pager('#example1');

    })
</script>
</body>
</html>
