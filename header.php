<?php
session_start();
if(isset($_SESSION['o-token'])){

    $token = $_SESSION['o-token'];
    $valid = validatetoken($token);
    if($valid == 0){
     header("location:login");
     die("<h3>Session Expired<a href='logout'>Login Again</a></h3>");
    }
    else{
        $token_user = fetchrow('o_tokens',"token='$token'","userid");
        $userd = fetchonerow('o_users',"uid='$token_user'","uid, name, email, phone, join_date, user_group, branch, status");
        $group_name = fetchrow('o_user_groups',"uid='".$userd['user_group']."'","name");
    }

}
else{
    header("location:login");
    die("<h3>Session Expired<a href='logout'>Login Again</a></h3>");
}


?>
<header class="main-header" style="background-color: #333333 !important;">
    <div id="standardnotif" class="alert alert-dismissible"></div>
    <!-- Logo -->
    <a href="index" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>O</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><img src="dist/img/<?php echo $company['logo']; ?>" style="height: 50px;"></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->
                <li style="display: none;" class="dropdown messages-menu">
                    <a href="#" onclick="message_list();" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-envelope-o"></i>
                        <label class="label label-lg label-danger" id="msg_count"></label>
                    </a>
                    <ul class="dropdown-menu" id="message_drop">

                    </ul>
                </li>
                <!-- Notifications: style can be found in dropdown.less -->
                <li class="dropdown notifications-menu">
                    <a href="#" onclick="notif_list('#notif_drop',0,5);" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <label class="label font-16 label-danger" id="notif_count"></label>
                    </a>
                    <ul class="dropdown-menu" id="notif_drop">

                    </ul>
                </li>
                <!-- Tasks: style can be found in dropdown.less -->

                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" onclick="notif_list();" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="dist/img/user.png" class="user-image" alt="User Image"> <?php echo $userd['name']; ?>
                        <span class="hidden-xs">

                        </span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="dist/img/user.png" class="img-circle" alt="User Image">

                            <p>
                                <?php
                                echo $userd['name'];
                                ?>
                                <small><?php echo $group_name; ?></small>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <li class="user-body">

                            <!-- /.row -->
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="profile?profile" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="logout" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->
                <li style="display: none;">
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>