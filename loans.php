<?php
session_start();
include_once("php_functions/authenticator.php");
$company = company_settings();
include_once ("php_functions/functions.php");
include_once ("configs/conn.inc");

$company = company_settings();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $company['name']; ?> | Loans</title>
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
            if(isset($_GET['loan'])){
                $loan_ = $_GET['loan'];
               include_once ('widgets/loan_details.php');
            }
            elseif(isset($_GET['loan-add-edit'])){
                include_once ('forms/loan-add-edit-form.php');
            }
            else {
                ?>
                <section class="content-header">
                    <h1>
                        Loans
                        <small>List</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Loans</li>
                    </ol>
                </section>
        <section class="content">
            <?php
            include_once ('widgets/loan_list.php');
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
        loan_list();
        pager('#example1');
        if('<?php echo $loan_ ?>'){
            loan_stages('<?php echo $loan_; ?>');
        }
    })
</script>

</body>
</html>
