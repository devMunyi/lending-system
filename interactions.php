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
    <title><?php echo $company['name']; ?> | Interactions</title>
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
        if(isset($_GET['interaction'])){
            ?>
            <section class="content-header">
                <h1>
                    Interaction Details
                    <small>Peter Njenga / Paul Kim</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="index"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Interactions</li>
                </ol>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs nav-justified font-16">
                                <li class="nav-item nav-100 active"><a href="#tab_1" data-toggle="tab" aria-expanded="false"><i class="fa fa-info"></i> Info</a></li>
                                <li class="nav-item nav-100"><a href="#tab_2" data-toggle="tab" aria-expanded="false"><i class="fa fa-link"></i> Customer All</a></li>



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
                                                <tr><td class="text-bold">Customer</td><td>Jonah Ngarama Wambui</td></tr>
                                                <tr><td class="text-bold">Primary Mobile</td><td>0716330450</td></tr>
                                                <tr><td class="text-bold">Email</td><td>ngaramajonah@gmail.com</td></tr>
                                                <tr><td class="text-bold">Account</td><td>5447374 <br/>Kiambu</td></tr>
                                                <tr><td class="text-bold">Agent</td><td>67488933</td></tr>
                                                <tr><td class="text-bold">Interaction Method</td><td>M</td></tr>
                                                <tr><td class="text-bold">Interaction Date</td><td>Jan-May-2020</td></tr>
                                                <tr><td class="text-bold">Outcome</td><td>Jonah</td></tr>
                                                <tr><td class="text-bold">Next Interaction</td><td>4/11/2020 12:00AM</td></tr>
                                                <tr><td class="text-bold">Status</td><td><span class="text-success">Active</span></td></tr>

                                            </table>
                                        </div>
                                        <div class="col-md-3">
                                            <table class="table">
                                                <tr><td><button class="btn btn-success btn-block btn-md"><i class="fa fa-plus"></i> New Interaction</button></td></tr>
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
                                                <th>Method</th>
                                                <th>Date</th>
                                                <th>Agent</th>
                                                <th>Outcome</th>
                                                <th>Next Interaction</th>
                                                <th>Account</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td><span>Face2Face </span><br/></td>
                                                <td><span>5th May 2020</span><br/> <span class="text-muted font-13 font-bold">3 Months Ago</span></td>
                                                <td>Paul Gets</td>
                                                <td><span>Not Found</span></td>
                                                <td><span>5th May 2020</span><br/> <span class="text-muted font-13 font-bold">In 4 Months</span></td>
                                                <td><span>Loan: 1234</span><br/> <span class="text-muted font-13 font-bold">Overdue: 56,000.00</span></td>
                                                <td><span><a href="?interaction=123"><span class="fa fa-eye text-green"></span></a></span><h4><a><i class="fa fa-link text-blue"></i></a></h4></td>
                                            </tr>


                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Passport</th>
                                                <th>Phone</th>
                                                <th>Branch</th>
                                                <th>Latest Loan</th>
                                                <th>Address</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                            </tfoot>
                                            </table>
                                        </div>
                                        <div class="col-md-2">
                                            <table class="table">
                                                <tr><td><button class="btn btn-success btn-block  btn-md"><i class="fa  fa-plus"></i> Add Interaction</button></td></tr>

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
                    Interactions
                    <small>List</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="index"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Interactions</li>
                </ol>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-xs-8">

                        <!-- /.box -->

                        <div class="box">
                            <div class="box-header bg-info">
                                <div class="row">
                                    <div class="col-md-10">
                                        <h3 class="box-title font-16">
                                            <a class="btn font-16 btn-md bg-navy text-bold" href="interactions"><i class="fa fa-clone"></i> All</a>
                                            <a class="btn font-16 btn-md btn-default text-black text-bold" href=""><i class="fa fa-user-circle-o"></i> Face to Face</a>
                                            <a class="btn font-16 btn-md btn-default text-black text-bold" href=""><i class="fa fa-comment-o"></i> Chat</a>
                                            <a class="btn font-16 btn-md btn-default text-black text-bold" href=""><i class="fa fa-phone"></i> Call</a>

                                        </h3>
                                    </div>
                                    <div class="col-md-2">

                                        <button class="btn btn-success float-right" onclick="modal_view('/forms/interaction_add_form.php','','New Interaction')">ADD NEW</button>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <table id="example1" class="table table-condensed table-striped">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Customer Name</th>
                                        <th>Method</th>
                                        <th>Date</th>
                                        <th>Agent</th>
                                        <th>Outcome</th>
                                        <th>Next Interaction</th>
                                        <th>Account</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody id="interactions_">



                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Customer Name</th>
                                        <th>Method</th>
                                        <th>Date</th>
                                        <th>Agent</th>
                                        <th>Outcome</th>
                                        <th>Next Interaction</th>
                                        <th>Account</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                    <div class="col-xs-4 scroll-hor">
                        <?php
                        $for_customer = 0;
                        if(isset($_GET['customer'])){
                            $customer_id = $_GET['customer'];
                            $customer_name = fetchrow('o_customers',"uid='".decurl($customer_id)."'","full_name");
                            if($customer_id > 0){
                                $for_customer = 1;
                                ?>
                                <h4>Interactions for <b><?php echo $customer_name; ?></b></h4>
                                <table id="hd" style="background: white; padding: 5px; font-size: 12px;" class="table table-condensed table-striped">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Customer Name</th>
                                        <th>Method</th>
                                        <th>Date</th>
                                        <th>Agent</th>
                                        <th>Outcome</th>
                                        <th>Next Interaction</th>
                                        <th>Account</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody id="interaction_customer">



                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Customer Name</th>
                                        <th>Method</th>
                                        <th>Date</th>
                                        <th>Agent</th>
                                        <th>Outcome</th>
                                        <th>Next Interaction</th>
                                        <th>Account</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                </table>
                               <?php
                            }
                        }
                        if($for_customer == 0){
                            echo "<h4 class='font-italic'>Click <i class='fa fa-reorder text-blue'></i> to view a customer's full interactions</h4>";
                        }
                        ?>

                    </div>
                    <!-- /.col -->
                </div>
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
$('document').ready(function () {
   load_interactions('<?php echo $for_customer; ?>');
});
</script>
</body>
</html>
