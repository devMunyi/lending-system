<?php
session_start();
include_once ("../php_functions/functions.php");
include_once ("../configs/conn.inc");




$where_ =  $_POST['where_'];
$offset_ =  $_POST['offset'];
$rpp_ =  $_POST['rpp'];
$orderby =  $_POST['orderby'];
$dir =  $_POST['dir'];
$search_ = trim($_POST['search_']);


$limit = "$offset_, $rpp_";
$offset_2 = $offset_ + $rpp_;
$limit2 = $offset_+$rpp_;
$rows = "";

if((input_available($search_)) == 1){
    $andsearch = " AND (full_name LIKE '%$search_%' OR email_address LIKE '%$search_%' OR primary_mobile LIKE '%$search_%' )";
}
else{
    $andsearch = "";
}

//-----------------------------Reused Query
$o_users_ = fetchtable('o_customers',"$where_ AND status > 0 $andsearch", "$orderby", "$dir", "$limit", "uid ,full_name ,primary_mobile ,email_address ,physical_address, town ,passport_photo ,national_id ,gender ,dob ,added_by ,added_date ,branch ,primary_product ,loan_limit ,events ,status");
///----------Paging Option
$alltotal = countotal("o_customers","$where_ AND status > 0 $andsearch");
///==========Paging Option
if($alltotal > 0) {
    while ($l = mysqli_fetch_array($o_users_)) {
        $uid = $l['uid'];         $uid_enc = encurl($uid);
        $full_name = $l['full_name'];
        $primary_mobile = $l['primary_mobile'];
        $email_address = $l['email_address'];
        $physical_address = $l['physical_address'];
        $town = $l['town'];                                $town_name = fetchrow('o_towns',"uid='$town'","name");
        $passport_photo = $l['passport_photo'];
        $national_id = $l['national_id'];
        $gender = $l['gender'];
        $dob = $l['dob'];
        $added_by = $l['added_by'];
        $added_date = $l['added_date'];
        $branch = $l['branch'];                    $branch_name = fetchrow('o_branches',"uid='$branch'","name");
        $primary_product = $l['primary_product'];  $primary_product_name = fetchrow('o_loan_products',"uid='$primary_product'","name");
        $loan_limit = $l['loan_limit'];
        $events = $l['events'];
        $status = $l['status'];                    $state = fetchonerow("o_customer_statuses","code='$status'","color, name");

                 $latest_loan = array();
                 $total_loans = 4;

                 $passport_photo = fetchrow('o_documents',"category='1' AND tbl='o_customers' AND rec='$uid' AND status=1","stored_address");
                 if(!$passport_photo){
                    $profile = "";
                 }
                 else{
                     $profile = "<img src=\"uploads_/thumb_$passport_photo\" height=\"65px\">";
                 }

        $row .= "<tr><td>$uid</td>
                            <td style='padding: 0;'><span>$profile</span></td>
                            <td><span class=\"font-400\">$full_name</span><br/> <span class=\"text-muted font-13 font-bold\">$email_address</span>
                            </td>
                            <td><span>$primary_mobile </span></td>
                            <td><span>$branch_name</span><br/> <span class=\"text-muted font-13 font-bold\">Prod: $primary_product_name</span></td>
                            <td><span>".$latest_loan['amount']."</span><br/> <span class=\"text-red font-13 font-bold\">Bal: ".$latest_loan['balance']." &bull; Due: ".$latest_loan['due_date']."</span>
                            </td>
                            <td><span>$physical_address</span><br/> <span class=\"text-muted font-13 font-bold\">$town_name</span></td>
                            <td><span class='label ".$state['color']."'>".$state['name']." </span><br/> <span class=\"text-muted font-13 font-bold\">$total_loans Loans</span></td>
                            <td><span><a href=\"?customer=$uid_enc\"><span class=\"fa fa-eye text-green\"></span></a></span><h4><a><i class=\"fa fa-comments-o text-blue\"></i></a></h4></td>
                        </tr>
";

        //////------Paging Variable ---
        $page_total = $page_total + 1;
        /////=======Paging Variable ---


    }
}
else{
    $row = "<tr><td colspan='8'><i>No Records Found</i></td></tr>";
}

echo   trim($row)."<tr style='display: none;'><td><input type=\"hiddenn\" id=\"_alltotal_\" value='$alltotal'><input type=\"hiddenn\" id=\"_pagetotal_\" value='$page_total'></td></tr>";