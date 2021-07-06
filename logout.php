<?php
session_start();
include_once ("php_functions/functions.php");
include_once ("configs/conn.inc");
$token = $_SESSION['o-token'];
$session_keydest = updatedb('o_tokens',"statue=0, expiry_date='$fulldate'","token='$token'");
session_destroy();
unset($_SESSION['o-token']);

header('location: login.php');
?>

$token = $_SESSION['o-token'];
$valid = validatetoken($token);
if($valid == 0){
    echo "<meta http-equiv=\"refresh\" content=\"0; URL=login?loggedout\" />";
    die("Your session is invalid");
}
else{
    ////=======Good to go
}
