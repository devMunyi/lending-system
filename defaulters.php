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
    <title><?php echo $company['name']; ?> | Defaulters</title>
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
                    Defaulters
                    <small>List</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="index"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Defaulters</li>
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


                                                <a class="btn font-16 btn-md btn-default text-bold" href=""><i class="fa fa-info-circle"></i> ALL Defaulters</a>
                                                <a class="btn font-16 btn-md btn-default text-bold" href=""><i class="fa fa-chevron-circle-right"></i> Newest</a>
                                                <a class="btn font-16 btn-md btn-default text-bold" href=""><i class="fa fa-chevron-circle-right"></i> Oldest</a>
                                                <a class="btn font-16 btn-md btn-default text-bold" href=""><i class="fa fa-chevron-circle-right"></i> Maximum Amount</a>
                                                <a class="btn font-16 btn-md btn-default text-bold" href=""><i class="fa fa-chevron-circle-right"></i> Minimum Amount</a>
                                                <a class="btn font-16 btn-md btn-default text-bold" href=""><i class="fa fa-chevron-circle-right"></i> None-Committed</a>

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
                                        <th>Given</th>
                                        <th>Due</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>1445</td>
                                        <td><span class="font-16">Peter Witu</span><br/> <span class="text-muted font-13 font-bold">0716330450</span>
                                        </td>
                                        <td><span class="text-bold text-blue font-16">50,000.00</span></td>
                                        <td><span>12,000.00</span><br/> <span class="text-red font-13 font-bold">4 Total</span>
                                        </td>
                                        <td><span>15,000.00</span><br/> <span class="text-muted font-13 font-italic">3 Total</span></td>
                                        <td><span>14,000.00</span><br/> <span class="text-muted font-13 font-italic">4 Weeks Ago</span></td>
                                        <td><span class="font-bold text-red">5,000.00</span><br/> <span class="text-muted font-13 font-italic">Next Pay: 14/Jan/2021</span></td>
                                        <td><span>4/6/2020</span><br/> <span class="text-orange font-13 font-bold">3 Weeks Ago</span></td>
                                        <td><span>5/7/2020</span><br/> <span class="text-orange font-13 font-bold">In 2 Months</span></td>
                                        <td><span><span class="label label-success">Active</span> </span></td>
                                        <td><span><a href="?loan=123"><span class="fa fa-eye text-green"></span></a></span><h4><a><i class="fa fa-comments-o text-blue"></i></a></h4></td>
                                    </tr>


                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>CODE</th>
                                        <th>Customer</th>
                                        <th>Amount</th>
                                        <th>Total</th>
                                        <th>Repaid</th>
                                        <th>Balance</th>
                                        <th>Date</th>
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
        $('#example1').DataTable()
        $('#example2').DataTable({
            'paging'      : true,
            'lengthChange': false,
            'searching'   : false,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false
        })
    })
</script>
</body>
</html>
