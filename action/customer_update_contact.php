<?php
include_once ("../php_functions/functions.php");
include_once ("../configs/conn.inc");

$contact_id = $_POST['contact_id'];
$contact_type = $_POST['contact_type'];
$customer_id = $_POST['customer_id'];
$value = $_POST['value'];
$status = 1;

if($contact_id > 0){
    $contact_id_dec = decurl($contact_id);
}
else{
    echo errormes('Contact ID Not Selected');
    die();
}

if(($contact_type) > 0){
    //////---------Check if contact type exists
    $exists = checkrowexists("o_customer_contacts","contact_type='$contact_type' AND uid!='$contact_id_dec' AND status=1");
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



$create = updatedb('o_customer_contacts',"contact_type='$contact_type', value='$value'","uid='".decurl($contact_id)."'");
if($create == 1)
{
    echo sucmes('Contact Updated Successfully');
    $proceed = 1;

}
else
{
    echo errormes('Unable to Update Contact');
}


?>
<script>
    let proceed = '<?php echo $proceed; ?>';
    if(proceed === "1"){
        contact_list('<?php echo $customer_id; ?>','EDIT');
    }
</script>
