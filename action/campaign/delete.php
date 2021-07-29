<?php
session_start();
include_once ("../../php_functions/functions.php");
include_once ("../../configs/conn.inc");

$userd = session_details();
if($userd == null){
    die(errormes("Your session is invalid. Please re-login"));
    exit();
}

$campaign_id = $_POST['campaign_id'];

if($campaign_id > 0){

    //check if campaign is past and already run
    $camp = checkrowexists("o_campaigns", "uid = $campaign_id AND running_date < $date AND (running_status = 2 OR running_status = 3) AND repetitive = 1");
    if($camp){
    }else{
        die(errormes("Campaign running or already run cannot be deleted"));
        exit();
    }

    $update = updatedb('o_campaigns', "status=0", "uid= $campaign_id");
    if($update == 1)
    {
        echo sucmes('Success deleting campaign');
        $proceed = 1;

    }
    else
    {
        die(errormes('Unable to delete campaign'));
        die();
    }
}
else{
    die(errormes("Campaign ID invalid"));
    exit();
}

?>

<script>
    let proceed_ = '<?php echo $proceed; ?>';
    if(proceed_ === "1"){
        setTimeout(function () {
        	gotourl("broadcasts");
        },2000);
    }
</script>







