<?php
session_start();
include_once("../../php_functions/functions.php");
include_once("../../configs/conn.inc");

$loan_id = $_GET['loan_id'];
if($loan_id > 0){
    $loan_d = fetchonerow('o_loans',"uid='".decurl($loan_id)."'","product_id");
}
else{
    echo "<i>Loan ID is invalid</i>";
}

?>

<table class="table-bordered font-14 table table-hover">
    <thead><tr><th>Name</th><th>Amount</th><th>Status</th><th>Action</th></tr></thead>
    <tbody>
    <?php
    $o_product_addons_ = fetchtable('o_product_addons',"product_id=".$loan_d['product_id']." AND status=1", "uid", "desc", "0,100", "uid ,addon_id ,date_added ");
   if((mysqli_num_rows($o_product_addons_)) == 0){
      echo "<tr><td colspan='4'>No AddOns specified in settings</td> </tr>";
   }
    while($d = mysqli_fetch_array($o_product_addons_))
    {
        $uid = $d['uid'];
        $addon_id = $d['addon_id'];
        $date_added = $d['date_added'];

        $addon_d = fetchonerow('o_addons',"uid='$addon_id'","name, description,amount, amount_type, automatic");
        $addon_exists = checkrowexists('o_loan_addons',"loan_id='".decurl($loan_id)."' AND status=1 AND addon_id = '$addon_id'");

        if($addon_exists == 1){
            $act = "<td><span class=\"text-success\"><i class=\"fa fa-check\"></i> Added </span></td><td> <a onclick=\"loan_addon_action('REMOVE', '$loan_id', '$addon_id')\" class=\"btn btn-danger btn-sm  btn-md\"><i class=\"fa  fa-minus\"></i> Remove</a>";
        }
        else{
            $act = "<td><span class=\"text-danger\"><i class=\"fa fa-times\"></i> Not Added </span></td><td> <a onclick=\"loan_addon_action('ADD','$loan_id','$addon_id')\" class=\"btn btn-success btn-sm  btn-md\"><i class=\"fa  fa-plus\"></i> Add</a>";
        }


        echo "<tr><td>".$addon_d['name']."</td><td>".$addon_d['amount']."</td>$act </tr>";
    }

    ?>





    </tbody>


</table>