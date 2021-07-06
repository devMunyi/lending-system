<?php
include_once ("../php_functions/functions.php");
include_once ("../configs/conn.inc");

$customer_id = $_POST['customer_id'];
$contact_type = $_POST['contact_type'];
$value = $_POST['value'];
$status = 1;

if($customer_id > 0){
    $customer_id_dec = decurl($customer_id);
}
else{
    echo errormes('Customer not selected');
    die();
}

if(($contact_type) > 0){
    //////---------Check if contact type exists
    $exists = checkrowexists("o_customer_contacts","contact_type='$contact_type' AND customer_id='$customer_id_dec' AND status=1");
    if($exists == 1){
        echo errormes('This Contact Already Exists');
        die();
    }
    else{

    }
}
else{
    echo  errormes("Please select Contact Type");
    die();
}
if((input_available($value)) == 0){
    echo errormes("Please enter a value");
    die();
}


$fds = array('customer_id','contact_type','value','status');
$vals = array("$customer_id_dec","$contact_type","$value","$status");
$create = addtodb('o_customer_contacts',$fds,$vals);
if($create == 1)
{
    echo sucmes('Contact Added Successfully');
    $proceed = 1;

}
else
{
    echo errormes('Unable to Add Contact');
}


?>
<script>
    let proceed = '<?php echo $proceed; ?>';
    if(proceed === "1"){
            clear_form('contact_');
        contact_list('<?php echo $customer_id; ?>','EDIT');
    }
</script>
