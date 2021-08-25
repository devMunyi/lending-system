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
    <title><?php echo $company['name']; ?> | Settings</title>
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
                        Settings
                        <small>List</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Settings</li>
                    </ol>
                </section>
        <section class="content">
                <div class="row">
                    <div class="col-xs-3 font-14">
                        <ol class="list-group">
                            <li class="list-group-item">
                                <a class="text-navy" href="settings?group-permissions"><i class="fa fa-lock"></i> Group Permissions</a>
                            </li>
                            <li class="list-group-item">
                                <a class="text-navy" href="settings?user-permissions"><i class="fa text-red fa-lock"></i> User Permissions</a>
                            </li>
                            <li class="list-group-item">
                                <a class="text-navy" href="settings?general"><i class="fa fa-wrench"></i> General Settings</a>
                            </li>
                            <li class="list-group-item">
                                <a class="text-navy" href="settings?system"><i class="fa fa-gears"></i> System Settings</a>
                            </li>
                        </ol>
                    </div>
                    <div class="col-xs-9">

                        <!-- /.box -->

                        <div class="box">
                            <div class="box-header bg-info">
                                <span class="font-16 text-bold">Settings</span>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <?php
                                if (isset($_GET['user-permissions'])) {
                                    include_once ("widgets/settings/permissions.php");
                                }elseif(isset($_GET['general'])){
                                    include_once ("widgets/settings/permissions.php");
                                }elseif(isset($_GET['system'])){
                                    include_once ("widgets/settings/system_settings.php");
                                }else{
                                    include_once ("widgets/settings/permissions.php");
                                }
                                ?>
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

if((isset($_GET['g'])) && (isset($_GET['t']))) {
    $load_perms = 1;
}
$g = $_GET['g'];
$t = $_GET['t'];
$u = $_GET['u'];
$r = $_GET['r'];
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
       if('<?php echo $load_perms; ?>'){
        permissions('<?php echo $g; ?>','<?php echo $u; ?>','<?php echo $t; ?>','<?php echo $r; ?>','','');
           }
    })
</script>
</body>
</html>
