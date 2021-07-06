<?php
session_start();
include_once ("../../php_functions/functions.php");
include_once ("../../configs/conn.inc");

$userd = session_details();
if($userd == null){
    die(errormes("Your session is invalid. Please re-login"));
    exit();
}

$ref_id = $_POST['ref_id'];
if($ref_id > 0){
    $update = updatedb('o_customer_referees', "status=0", "uid=".decurl($ref_id));
    if($update == 1)
    {
        echo sucmes('Success deleting referee');
        $proceed = 1;

    }
    else
    {
        echo errormes('Unable to delete referee');
    }
}
else{
    die(errormes("Referee invalid"));
    exit();
}

?>

<script>
    let proceed_ = '<?php echo $proceed; ?>';
    if(proceed_ === "1"){
        setTimeout(function () {
        $('#ref<?php echo $ref_id; ?>').fadeOut('fast');
        },400);
    }
</script>







