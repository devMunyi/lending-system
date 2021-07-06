<?php
session_start();
include_once ("../../php_functions/functions.php");
include_once ("../../configs/conn.inc");

$userd = session_details();
if($userd == null){
    die(errormes("Your session is invalid. Please re-login"));
    exit();
}

$uid = $_POST['uid'];
$title = $_POST['title'];
$description = $_POST['description'];
$row_query = $_POST['row_query'];
$added_by = $userd['uid'];
$added_date = $fulldate;
$viewable_by = $_POST['viewable_by'];
$status = 1;

if($uid > 0){}
else{
    echo errormes("The report id is required");
    die();
}

if((input_length($title,2)) == 0){
    echo errormes("Title too short");
    die();
}
else{
    if((checkrowexists('o_reports', "title='$title' AND status=1 AND uid!='".decurl($uid)."")) == 1){
        echo errormes("Report will similar title exists");
        die();
    }
}



$update_flds = " title='$title', description='$description', row_query='$row_query', viewable_by='$viewable_by', status='$status'";
$update = updatedb('o_reports', $update_flds, "uid='".decurl($uid)."'");
if($update == 1)
{
    echo sucmes('Report Created Successfully');
    $proceed = 1;

}
else
{
    echo errormes('Unable to Save Report');
}

?>
<script>
    if("<?php echo $proceed; ?>"){
        setTimeout(function () {
            reload();
        },1000);
    }
</script>
