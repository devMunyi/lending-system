<?php
session_start();
include_once ("../../php_functions/functions.php");
include_once ("../../configs/conn.inc");

$userd = session_details();
$title = $_POST['title'];
$description = $_POST['description'];
$campaign_date = $_POST['date'];
$target_customers = $_POST['target_customers'];
$status = $_POST['status'];

////////////////validation
if((input_length($title, 3)) == 0){
    echo errormes("Title is too short");
    die();
}
else{
    $exists = checkrowexists('o_campaigns',"name='$title' AND status=1");
    if($exists == 1){
        echo errormes("Campaign with similar title exists");
        die();
    }
}

if((input_length($campaign_date, 10)) == 0){
    echo errormes("Date is required");
    die();
}
if($target_customers > 0){}
else{
    echo errormes("Please select target customers");
    die();
}


///////////------------------Save
$fds = array('name','description','running_date','target_customers','added_date','added_by','status');
$vals = array("$title","$description","$campaign_date","$target_customers","$fulldate",$userd['uid'], $status);

$create = addtodb('o_campaigns', $fds, $vals);
if($create == 1){
    echo sucmes('Campaign created successfully');
    $proceed = 1;
    $last_campaign = fetchmax('o_campaigns',"name='$title'","uid","uid");
    $cid = $last_campaign['uid'];
}
else{
    echo errormes('Unable to create campaign');
}

?>


<script>
    if('<?php echo $proceed ?>'){
        setTimeout(function () {
            gotourl('broadcasts?campaign=<?php echo encurl($cid); ?>');
        }, 1500);

    }
</script>
