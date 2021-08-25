<?php
session_start();
include_once ("../../php_functions/functions.php");
include_once ("../../configs/conn.inc");


$where_ =  $_POST['where_'];
$sort_option = $_POST['sort_option'];
$offset_ =  $_POST['offset'];
$rpp_ =  $_POST['rpp'];
$page_no = $_POST['page_no'];
$orderby =  $_POST['orderby'];
$dir =  $_POST['dir'];
$search_ = trim($_POST['search_']);
$customer = $_POST['customer'];
//$cust_id = decurl($_POST['cust_id']);


$limit = "$offset_, $rpp_";
$offset_2 = $offset_ + $rpp_;
$limit2 = $offset_+$rpp_;
$rows = "";


$cust_array = array();
$customers = fetchtable2("o_customers","full_name LIKE \"%$search_%\"","uid","asc","uid");

$customer_lists = mysqli_num_rows($customers);
if($customer_lists > 0) {
    while ($cu = mysqli_fetch_array($customers)) {
        $customer_uid = $cu['uid'];
        array_push($cust_array, $customer_uid);
    }
    $customer_list = implode(",", $cust_array);
    $orcustomer = " OR `customer_id` IN ($customer_list)";
}
else{
    $orcustomer = "";
}


$convers_array = array();
$convers_ = fetchtable2("o_conversation_methods", "name LIKE \"%$search_%\"", "uid", "asc", "uid");
$convers_count = mysqli_num_rows($convers_);
if($convers_count > 0){
    while($convers_list = mysqli_fetch_array($convers_)){
        $convers_id = $convers_list['uid'];
        array_push($convers_array, $convers_id);
    }
    $cust_convers_list = implode(", ", $convers_array);
    $orcustconversation = " OR `conversation_method` IN ($cust_convers_list)";
}



if($customer > 0){
    $andcustomer = " AND customer_id='$customer'";
}
else{
    $andcustomer = " ";
}
if((input_available($search_)) == 1){
    $andsearch = " AND (transcript LIKE \"%$search_%\" OR conversation_date LIKE \"%$search_%\" OR next_interaction LIKE \"%$search_%\" $orcustomer $orcustconversation)";
}
else{
    $andsearch = "";
}

//-----------------------------Reused Query


//displaying list based on sort options
if($sort_option == "sort_1"){
    //face to face interactions
    $o_conversations = fetchtable('o_customer_conversations',"$where_ AND conversation_method = 1 AND status > 0 $andsearch $andcustomer", "$orderby", "$dir", "$limit", "uid, customer_id, agent_id, loan_id, conversation_method, DATE(conversation_date) AS conversation_date, next_interaction, transcript, flag, next_steps, outcome");
    ///----------Paging Option
    $alltotal = countotal("o_customer_conversations","$where_ AND conversation_method = 1 AND status > 0 $andsearch");
    ///==========Paging Option

}elseif($sort_option == "sort_2"){
    //chat interactions
    $o_conversations = fetchtable('o_customer_conversations',"$where_ AND conversation_method = 2 AND status > 0 $andsearch $andcustomer", "$orderby", "$dir", "$limit", "uid, customer_id, agent_id, loan_id, conversation_method, DATE(conversation_date) AS conversation_date, next_interaction, transcript, flag, next_steps, outcome");
    ///----------Paging Option
    $alltotal = countotal("o_customer_conversations","$where_ AND conversation_method = 2 AND status > 0 $andsearch");
    ///==========Paging Option
}elseif($sort_option == "sort_3"){
    //call interactions
    $o_conversations = fetchtable('o_customer_conversations',"$where_ AND conversation_method = 3 AND status > 0 $andsearch $andcustomer", "$orderby", "$dir", "$limit", "uid, customer_id, agent_id, loan_id, conversation_method, DATE(conversation_date) AS conversation_date, next_interaction, transcript, flag, next_steps, outcome");
    ///----------Paging Option
    $alltotal = countotal("o_customer_conversations","$where_ AND conversation_method = 3 AND status > 0 $andsearch");
    ///==========Paging Option
}else{
    //default or all interactions
     $o_conversations = fetchtable('o_customer_conversations',"$where_ AND status > 0 $andsearch $andcustomer", "$orderby", "$dir", "$limit", "uid, customer_id, agent_id, loan_id, conversation_method, DATE(conversation_date) AS conversation_date, next_interaction, transcript, flag, next_steps, outcome");
    ///----------Paging Option
    $alltotal = countotal("o_customer_conversations","$where_ AND status > 0 $andsearch");
    ///==========Paging Option
}

if($alltotal > 0) {
    $row = "";
    while ($i = mysqli_fetch_array($o_conversations)) {
        $uid = $i['uid'];
        $customer_id = $i['customer_id'];    $customer_name = fetchrow('o_customers',"uid='$customer_id'","full_name");

        $agent_id = $i['agent_id'];          $agent_name = fetchrow('o_users',"uid='$agent_id'","name");
        $loan_id = $i['loan_id'];
        $conversation_method = $i['conversation_method'];  $meth = fetchonerow('o_conversation_methods',"uid='$conversation_method'","name, details");
        $conversation_date = $i['conversation_date'];
        $next_interaction = $i['next_interaction'];
        $transcript = $i['transcript'];
        $flag = $i['flag'];
        $next_steps = $i['next_steps'];
        $outcome = $i['outcome'];                        $outc = fetchrow('o_conversation_outcome',"uid='$outcome'","name");

           if($customer_id > 0){
               $l = fetchmaxid("o_loans", "customer_id = $customer_id AND status > 0", "uid, loan_balance");
               $loan_id = encurl($l['uid']);
               $loan_bal = $l['loan_balance'];

               if($loan_bal < 0){
                $loan_bal = 0;
               }

               if($loan_id < 1){
                $loan_id = "<b>Null</b>";
               }
            }
                $row = $row."<tr><td>$uid</td>
                    <td><span class=\"font-16\">$customer_name <br/> ".flag($flag)."</span>
                    </td>
                    <td><i class=\"fa ".$meth['details']."\"></i><br/><span class='font-13'>".$meth['name']."</span></td>
                    <td><span>$conversation_date</span><br/> <span class=\"text-muted font-12\">".fancydate($conversation_date)."</span></td>
                    <td>$agent_name</td>
                    <td><span>$transcript</span></td>
                    <td><span>$next_interaction</span><br/> <span class=\"text-muted font-12\">".fancydate($next_interaction)."</span></td>
                    <td><span>Loan ID: <span class=\"text-bold\">$loan_id</span></span><br/> <span class=\"text-muted font-12 font-bold\">Balance: <span class=\"text-danger\">".money($loan_bal)."</span></span></td>
                    
                    <td><span title =\"click to view this interaction's details\"><a class='pointer' onclick=\"view_interaction($uid);\"><span class=\"fa fa-eye text-green\"></span></a></span><h4 title =\"click to view this customer's other interactions\"><a href='interactions?customer=".encurl($customer_id)."'><i class=\"fa fa-reorder text-blue\"></i></a></h4></td>
                    </tr>";

        //////------Paging Variable ---
        //$page_total = $page_total + 1;
        /////=======Paging Variable ---

    }

}
else{
    $row = "<tr><td colspan='8'><i>No Records Found</i></td></tr>";
}
    
//if()
 echo trim($row)."<tr style = 'display: none'><td><input type='text' id='_alltotal_' value=\"$alltotal\"/></td><td><input type='text' id='_pageno_' value=\"$page_no\"></td></tr>";
        /*echo trim($row)."<tr style='display: one ;'><td colspan='8'>".paging_values_hidden($where_,$offset_,$rpp_,$orderby,$dir,$search_,'load_interactions')."</td></tr><tr style = 'display: one'><td><input type='text' id='_alltotal_' value=\"$alltotal\"/></td><input type='text' id='_pageno_' value=\"$page_no\"></td></tr>";
        */
?>

