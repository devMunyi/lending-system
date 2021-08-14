<?php
session_start();
include_once ("../../php_functions/functions.php");
include_once ("../../configs/conn.inc");

/////----------Session Check
$userd = session_details();
if($userd == null){
    die(errormes("Your session is invalid. Please re-login"));
    exit();
}
/////---------End of session check
/////--------User Group Check
/*if($userd['user_group'] !== 1){
    die(errormes("You have no permission to change system settings"));
}*/
/////---------End of User Group Check
$name = $_POST['name'];
$logo = $_POST['logo'];
$icon = $_POST['icon'];
$link = $_POST['link'];
$events = "Settings updated at [$fulldate] by [".$userd['name']."{".$userd['uid']."}"."$username]";

///////----------Validation
if((input_available($name)) == 0){
    die(errormes("Name is required"));
}elseif((input_length($name, 2)) == 0){
    die(errormes("Name is too short"));
}

if((input_available($logo)) == 0){
    die(errormes("logo is required"));
}elseif((input_length($logo, 5)) == 0){
    die(errormes("Logo is too short"));
}

if((input_available($icon)) == 0){
    die(errormes("Icon is required"));
}elseif((input_length($icon, 5)) == 0){
    die(errormes("Icon is too short"));
}

if((input_available($link)) == 0){
    die(errormes("Link is required"));
}elseif((input_length($link, 10)) == 0){
    die(errormes("Link is too short"));
}


//////-----------End of validation
$update_flds = " name=\"$name\", logo=\"$logo\", icon=\"$icon\", link=\"$link\"";
$update = updatedb('platform_settings', $update_flds, "uid=1");

if($update == 1){
    echo sucmes('Settings Updated Successfully');
    $proceed = 1;
    store_event('platform_settings', "1" ,"$events");

}else{
        echo errormes('Unable to Update Settings');
}

?>

<script>
    let proceed = '<?php echo $proceed; ?>';
    if(proceed === "1"){
        setTimeout(function () {
            reload();
        },2500);
    }
</script>
