<?php
include_once ("../../php_functions/functions.php");
include_once ("../../configs/conn.inc");

$customer_id = $_POST['customer_id'];    $customer_id_dec = decurl($customer_id);
$added_date = $fulldate;
$referee_name = $_POST['referee_name'];
$id_no = $_POST['id_no'];
$mobile_no = make_phone_valid($_POST['mobile_no']);
$physical_address = $_POST['physical_address'];
$email_address = $_POST['email_address'];
$relationship = $_POST['relationship'];
$status = 1;

if((input_length($referee_name, 3)) == 0){
    echo errormes("Referee name is too short");
    die();
}

if((input_length($id_no, 5)) == 1){
    //////---------Check if contact type exists
    $exists = checkrowexists("o_customer_referees","id_no='$id_no' AND customer_id='$customer_id_dec' AND status=1");
    if($exists == 1){
        echo errormes('This referee is already added');
        die();
    }
    else{

    }
}
else{
    echo  errormes("National ID of referee is required");
    die();
}

if((validate_phone($mobile_no)) == 0){
    echo errormes("Referee's mobile number is invalid");
    die();
}
if($relationship > 0){

}else{
    echo errormes("Referee's relationship is required");
    die();
}



$fds = array('customer_id','added_date','referee_name','id_no','mobile_no','physical_address','email_address','relationship','status');
$vals = array("".decurl($customer_id)."","$added_date","$referee_name","$id_no","$mobile_no","$physical_address","$email_address","$relationship","$status");
$create = addtodb('o_customer_referees',$fds,$vals);
if($create == 1)
{
    echo sucmes('Referee Added Successfully');
    $proceed = 1;

}
else
{
    echo errormes('Unable to Add Referee');
}


?>
<script>
    let proceed = '<?php echo $proceed; ?>';
    if(proceed === "1"){
        setTimeout(function () {
            referee_list('<?php echo $customer_id; ?>','EDIT');
            clear_form('ref_form');
        },100);
    }
</script>
