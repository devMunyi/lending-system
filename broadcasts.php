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
    <title><?php echo $company['name']; ?> | Leads</title>
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

        <?php
        if(isset($_GET['campaign'])){a3wa
            ?>
            <section class="content-header">
                <h1>
                    BroadCast Details
                    <small>Holiday Greatings</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="index"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Broadcasts</li>
                </ol>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs nav-justified font-16">
                                <li class="nav-item nav-100 active"><a href="#tab_1" data-toggle="tab" aria-expanded="false"><i class="fa fa-info"></i> Info</a></li>
                                <li class="nav-item nav-100"><a href="#tab_2" data-toggle="tab" aria-expanded="false"><i class="fa fa-link"></i> Audience</a></li>



                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <span class="info-box-icon"><i class="fa fa-info"></i></span>
                                        </div>
                                        <div class="col-md-7">
                                            <table class="table-bordered font-14 table table-hover">
                                                <tr><td class="text-bold">UID</td><td>12323</td></tr>
                                                <tr><td class="text-bold">Campaign Name</td><td>Birthday Campaign</td></tr>
                                                <tr><td class="text-bold">Message</td><td>Dear {fname}, we would like to wish you a happy Birthday</td></tr>
                                                <tr><td class="text-bold">Added Date</td><td>4th May 2020</td></tr>
                                                <tr><td class="text-bold">Running Date</td><td>4th May 2020 5:00AM</td></tr>
                                                <tr><td class="text-bold">Frequency</td><td>Once</td></tr>
                                                <tr><td class="text-bold">Target Audience</td><td>Birthdays <label class="label label-default">20</label></td></tr>
                                                <tr><td class="text-bold">Status</td><td><span class="text-success">Scheduled</span></td></tr>

                                            </table>
                                        </div>
                                        <div class="col-md-3">
                                            <table class="table">
                                                <tr><td><button class="btn btn-success btn-block btn-md"><i class="fa fa-plus"></i> New Campaign</button></td></tr>
                                                <tr><td><button class="btn btn-warning btn-block btn-md"><i class="fa fa-edit"></i> Edit Campaign</button></td></tr>
                                                <tr><td><button class="btn btn-danger btn-block btn-md"><i class="fa fa-times"></i> Delete Campaign</button></td></tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="tab_2">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <span class="info-box-icon"><i class="fa fa-link"></i></span>
                                        </div>
                                        <div class="col-md-8">
                                            <table class="table-bordered font-14 table table-hover">
                                                <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Customer</th>
                                                    <th>Branch</th>
                                                    <th>Status</th>

                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Paul Gets</td>
                                                    <td>Main</td>
                                                    <td><span>Active </span></td>
                                                </tr>


                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Customer</th>
                                                    <th>Branch</th>
                                                    <th>Status</th>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <div class="col-md-2">
                                            <table class="table">
                                                <tr><td><button class="btn btn-success btn-block  btn-md"><i class="fa  fa-plus"></i> New Campaign</button></td></tr>

                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div>
                    </div>
                </div>
            </section>
            <?php
        }
        else {
            ?>
            <section class="content-header">
                <h1>
                    Broadcasts
                    <small>List</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="index"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Broadcasts</li>
                </ol>
            </section>
            <section class="content">
                <?php
                if(isset($_GET['add-edit-campaign'])){

                    include_once 'forms/campaign.php';
                }
                else if(isset($_GET['campaign'])){
                    ?>
                One Campaign
                <?php
                }
                else{
                    ?>
                    <div class="row">
                        <div class="col-xs-12">

                            <!-- /.box -->

                            <div class="box">
                                <div class="box-header bg-info">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <h3 class="box-title font-16">
                                                <a class="btn font-16 btn-md bg-navy text-bold" href=""><i class="fa fa-clone"></i> All Campaigns</a>
                                                <a class="btn font-16 btn-md btn-default text-black text-bold" href=""><i class="fa fa-arrow-left"></i> Past</a>
                                                <a class="btn font-16 btn-md btn-default text-black text-bold" href=""><i class="fa fa-arrow-down"></i> Running</a>
                                                <a class="btn font-16 btn-md btn-default text-black text-bold" href=""><i class="fa fa-arrow-right"></i> Future</a>
                                                <a class="btn font-16 btn-md btn-default text-black text-bold" href=""><i class="fa fa-recycle"></i> Repetitive</a>

                                            </h3>
                                        </div>
                                        <div class="col-md-2">

                                            <a class="btn btn-success float-right" href="broadcasts?add-edit-campaign"><i class="fa fa-plus"></i> ADD NEW</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Campaign Name</th>
                                            <th>Added Date</th>
                                            <th>Running Date</th>
                                            <th>Frequency</th>
                                            <th>Target Audience</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td><h3>Holiday Wishes</h3> </td>
                                            <td><span>5th May 2020</span><br/> <span class="text-muted font-13 font-bold">3 Months Ago</span></td>
                                            <td><span>6th May 2020 5:00 AM</span><br/> <span class="text-muted font-13 font-bold">Today</span></td>
                                            <td>Once</td>
                                            <td>All Customers</td>
                                            <td><span class="label label-success">Scheduled </span></td>
                                            <td><span><a href="?campaign=123"><span class="fa fa-eye text-green"></span> View</a></span><h4><a class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Stop</a></h4></td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td><h3>Birthday Wishes</h3> </td>
                                            <td><span>5th May 2020</span><br/> <span class="text-muted font-13 font-bold">3 Months Ago</span></td>
                                            <td><span>6th May 2020 5:00 AM</span><br/> <span class="text-muted font-13 font-bold">Today</span></td>
                                            <td>Once</td>
                                            <td>All Customers</td>
                                            <td><span class="label label-success">Scheduled </span></td>
                                            <td><span><a href="?campaign=123"><span class="fa fa-eye text-green"></span> View</a></span><h4><a class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Stop</a></h4></td>
                                        </tr>


                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Campaign Name</th>
                                            <th>Added Date</th>
                                            <th>Running Date</th>
                                            <th>Frequency</th>
                                            <th>Target Audience</th>
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
                <?php
                }
                ?>
            </section>
            <?php
        }
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
