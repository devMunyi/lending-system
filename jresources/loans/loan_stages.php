<?php
session_start();
include_once("../../php_functions/functions.php");
include_once("../../configs/conn.inc");

$loan_id = $_GET['loan_id'];


$l = fetchonerow("o_loans","uid='".decurl($loan_id)."'","*");
?>


<table style="width: 100%; text-align: center" class="table table-striped font-18">

    <?php
    //////-----------Stages
    $o_product_stages_ = fetchtable('o_product_stages', "product_id=" . $l['product_id'] . " AND status=1", "stage_order", "asc", "0,100", "uid ,stage_id, is_final_stage ");
    if (mysqli_num_rows($o_product_stages_) > 0) {
        $st = 1;
        while ($b = mysqli_fetch_array($o_product_stages_)) {
            $uid = $b['uid'];
            $stage_id = $b['stage_id'];
            $stage_name = fetchrow("o_loan_stages", "uid=$stage_id", "name");
            $is_final_stage = $b['is_final_stage'];
            if ($l['loan_stage'] == $stage_id) {
                $action1 = "<button onclick=\"modal_view('/jresources/loans/loan_stage_approve','loan_id=$loan_id','Approve to Next Stage')\" class='btn btn-success btn-sm'><i class='fa fa-check'></i>Approve</button>";
                $action2 = "<button class='btn btn-danger btn-sm'><i class='fa fa-times'></i> Reject</button>";
                echo "<tr class='font-18 font-bold text-green'><td colspan='2'><span class='badge bg-green-gradient'>$st</span> $stage_name (Current) <br/><div class='inaction'> $action1 $action2</div></td></tr>";
            } else {
                echo "<tr><td colspan='2'><span class='badge'>$st</span> $stage_name</td></tr>";
            }
            echo "<tr><td  colspan='2'><i class='fa fa-arrow-down'></i></td></tr>";
            $st = $st + 1;
        }
    } else {
        echo "<tr><td class='text-orange font-14 font-bold'><i class='fa fa-info-circle'></i> This product has no product stages</td></tr>";
    }
    ?>
</table>