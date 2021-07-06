<?php
include_once ("php_functions/functions.php");
include_once ("configs/conn.inc");
include_once ("php_functions/functions.php");
include_once ("configs/conn.inc");

$company = company_settings();

$company = company_settings();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $company['name']; ?> | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <?php
    include_once ('header_includes.php');
    ?>
</head>
<body class="hold-transition login-page">

<div class="login-box">
    <div class="login-logo">
        <img src="dist/img/<?php echo $company['logo'] ?>"  alt="<?php  echo $company['name']?>" style="font-weight: bold;" height="100px">
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Login to your account</p>

        <form onsubmit="return false;" method="post">
            <div class="form-group has-feedback">
                <input type="text" class="form-control" id="inp_email" placeholder="Email or Phone">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" id="inp_password" class="form-control" placeholder="Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">

                <div class="col-xs-7">
                    <div class="checkbox icheck">
                        <label style="margin-left: 20px;">
                             <input type="checkbox"> Remember Me
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" onclick="login()" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div>
                <!-- /.col -->
            </div>
        </form>


        <!-- /.social-auth-links -->


    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<?php
include_once "configs/20200902.php";
?>
<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script src="scripts/common.js"></script>
<script src="scripts/authentication.js"></script>

</body>
</html>
