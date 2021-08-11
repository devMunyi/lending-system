<?php
session_start();
include_once ("../../../php_functions/functions.php");
include_once ("../../../configs/conn.inc");

$userd = session_details();
$added_by = $userd['uid'];
$message = $_POST['message'];
$campaign_id = decurl($_POST['campaign_id']); 


////////////////validation
if(input_available($message) == 0){
    echo errormes(x: "Message is required");
    die();
}else{
    $exists = checkrowexists("o_campaign_messages","campaign_id = $campaign_id");
    if($exists == 1){
        echo errormes("Message for this campaign already exists");
        die();
    }
}


///////////------------------Save
$fds = array("campaign_id","message", "added_by");
$vals = array("$campaign_id","$message", "$added_by");

$create = addtodb('o_campaign_messages', $fds, $vals);
if($create == 1){
    echo sucmes('Message created successfully');
    $proceed = 1;
}
else{
    echo errormes('Unable to create message');
}

?>


<script>
    if('<?php echo $proceed ?>'){
        setTimeout(function () {
            reload();
            //gotourl('broadcasts?campaign=<?php// echo encurl($campaign_id); ?>');
        }, 1500);

    }
</script>