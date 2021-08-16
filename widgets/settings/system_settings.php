<?php
session_start();
include_once("../../php_functions/functions.php");
include_once("../../configs/conn.inc");

/////----------Session Check
$userd = session_details();
if($userd == null){
    die(errormes("Your session is invalid. Please re-login"));
    exit();
}
/////---------End of session check
?>

<h3>System Settings</h3>
<div class="row">
    <div class="col-md-10">
        <table class="table table-bordered table-condensed">

        <thead><tr><th>Name</th><th>Logo</th><th>Action</th></tr></thead>
        <tbody>
            <?php
            //query platform settings table
            $sys = fetchonerow("platform_settings", "uid = 1", "*");
            $name = $sys['name'];
            $logo = $sys['logo'];
            ?>
            <tr><td><?php echo $name; ?></td><td><?php echo $logo;?></td><td><span class="btn btn-xs alert-warning" onclick="modal_view('/forms/system_settings_edit.php','','Edit Settings')"><i class="fa fa-edit"> </i><span>Edit</span></span></td></tr>
        </tbody>
        <tfoot>
            <tr><th>Name</th><th>Logo</th><th>Action</th></tr>
        </tfoot>
    </table>
    </div>
</div>

