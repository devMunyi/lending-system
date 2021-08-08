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
    <title><?php echo $company['name']; ?> | Notifications</title>
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
        <section class="content-header">
            <h1>Profile
                <small>Profile</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="index"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Profile</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
        <!-- Main content -->

        <?php

            ?>
            <div class="_list">
                <div class="row">
                    <div class="col-xs-2">
                        <ol class="list-group">
                            <li class="list-group-item">
                                <a href="profile?notifications">Notifications</a>
                            </li>
                            <li class="list-group-item">
                                <a href="profile?details">Profile Details</a>
                            </li>

                        </ol>
                    </div>
                    <div class="col-xs-8">

                        <!-- /.box -->

                        <div class="box">
                            <div class="box-header">

                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-10">
                                        <?php
                                        if(isset($_GET['notifications'])) {
                                            ?>
                                            <h4>My Notifications</h4>
                                            <ul class="list-group list-unstyled" id="all_notifs">
                                                <li>Loading...</li>
                                            </ul>
                                            <?php
                                        }
                                        elseif (isset($_GET['password'])){
                                            ?>
                                            <h4>Update Password</h4>
                                            <form class="form-horizontal" autocomplete="off" onsubmit="return false;" method="post">
                                                <div class="box-body">
                                                    <div class="form-group">
                                                        <label for="old_password" class="col-sm-3 control-label">Current Password</label>

                                                        <div class="col-sm-9">
                                                            <input class="form-control" autocomplete="off" type="password" id="old_password">
                                                        </div>

                                                    </div>
                                                    <div class="form-group">
                                                        <label for="new_password" class="col-sm-3 control-label">New Password</label>

                                                        <div class="col-sm-9">
                                                            <input class="form-control" autocomplete="off" type="password" id="new_password">
                                                        </div>

                                                    </div>
                                                    <div class="col-sm-3"></div>
                                                    <div class="col-sm-9">
                                                        <div class="box-footer">
                                                            <br/>
                                                            <button type="submit" class="btn btn-lg btn-default">Cancel</button>
                                                            <button type="submit"
                                                                    class="btn btn-success bg-green-gradient btn-lg pull-right"
                                                                    onclick="update_password();">
                                                                Update
                                                            </button>
                                                        </div>
                                                    </div>

                                                </div>
                                                <!-- /.box-body -->

                                                <!-- /.box-footer -->
                                            </form>
                                            <?php
                                        }
                                        else{
                                            ?>
                                               <h4>My Profile</h4>
                                            <table class="table table-bordered">
                                                <tr><td>Name</td><td><?php echo $userd['name']; ?></td></tr>
                                                <tr><td>email</td><td><?php echo $userd['email']; ?></td></tr>
                                                <tr><td>Phone</td><td><?php echo $userd['phone']; ?></td></tr>
                                                <tr><td>Join Date</td><td><?php echo $userd['join_date']; ?></td></tr>
                                                <tr><td>Group</td><td><?php echo $group_name; ?></td></tr>
                                                <tr><td>Branch</td><td><?php echo fetchrow('o_branches',"uid='".$userd['branch']."'","name"); ?></td></tr>

                                            </table>
                                            <hr/>
                                            <a class="btn bg-blue" href="profile?password"><i class="fa fa-lock"></i> Update your password</a>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                </div>
            </div>
        </section>
            <?php

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
            notif_list('#all_notifs', 0, 10);
            pager('#example1');
    })
</script>
</body>
</html>
