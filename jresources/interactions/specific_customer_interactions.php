<?php
session_start();
include_once ("../../php_functions/functions.php");
include_once ("../../configs/conn.inc");


/*$where_ =  $_POST['where_'];
$sort_option = $_POST['sort_option'];
$offset_ =  $_POST['offset'];
$rpp_ =  $_POST['rpp'];
$page_no = $_POST['page_no'];
$orderby =  $_POST['orderby'];
$dir =  $_POST['dir'];
$search_ = trim($_POST['search_']);
*/
$customer = decurl($_POST['customer']);

$limit = "$offset_, $rpp_";
$offset_2 = $offset_ + $rpp_;
$limit2 = $offset_+$rpp_;
$rows = "";

if($customer > 0) {
    //query for specific customer list
        $o_specific_conversations_ = fetchtable('o_customer_conversations',"customer_id = $customer AND status > 0", "uid", "desc", "0,100", "uid, customer_id, agent_id, loan_id, conversation_method, DATE(conversation_date) AS conversation_date, next_interaction, transcript, flag, next_steps, outcome");
        while ($sp_i = mysqli_fetch_array($o_specific_conversations_)) {
            $sp_uid = $sp_i['uid'];
            $sp_customer_id = $sp_i['customer_id'];    $sp_customer_name = fetchrow('o_customers',"uid='$sp_customer_id'","full_name");

            $sp_agent_id = $sp_i['agent_id'];          $sp_agent_name = fetchrow('o_users',"uid='$sp_agent_id'","name");
            $sp_loan_id = $sp_i['loan_id'];
            $sp_conversation_method = $sp_i['conversation_method'];  $sp_meth = fetchonerow('o_conversation_methods',"uid='$sp_conversation_method'","name, details");
            $sp_conversation_date = $sp_i['conversation_date'];
            $sp_next_interaction = $sp_i['next_interaction'];
            $sp_transcript = $sp_i['transcript'];
            $sp_flag = $sp_i['flag'];
            $sp_next_steps = $sp_i['next_steps'];
            $sp_outcome = $sp_i['outcome'];                        $sp_outc = fetchrow('o_conversation_outcome',"uid='$sp_outcome'","name");
                    
            $row = $row."<tr><td>$sp_uid</td>
            <td><span class=\"font-16\">$sp_customer_name <br/> ".flag($sp_flag)."</span>
            </td>
            <td><i class=\"fa ".$sp_meth['details']."\"></i><br/><span class='font-13'>".$sp_meth['name']."</span></td>
            <td><span>$sp_conversation_date</span><br/> <span class=\"text-muted font-12\">".fancydate($sp_conversation_date)."</span></td>
            <td>$sp_agent_name</td>
            <td><span>$sp_transcript</span></td>
            <td><span>$sp_next_interaction</span><br/> <span class=\"text-muted font-12\">".fancydate($sp_next_interaction)."</span></td>
            <td><span>Loan: $sp_loan_id</span><br/> <span class=\"text-muted font-12 font-bold\">Balance: $bal</span></td>
            <td><span><a class='pointer' onclick=\"view_interaction($sp_uid);\"><span class=\"fa fa-eye text-green\"></span></a></span></td>
            </tr>";
        }
}else{
    $row = "<tr><td colspan='8'><i>No Records Found</i></td></tr>";
}
echo trim($row)."<tr style = 'display: none'><td><input type='text' id='_alltotal_' value=\"$alltotal\"/></td><td><input type='text' id='_pageno_' value=\"$page_no\"></td></tr>";
?>

