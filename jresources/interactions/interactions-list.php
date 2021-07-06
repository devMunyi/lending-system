<?php
session_start();
include_once ("../../php_functions/functions.php");
include_once ("../../configs/conn.inc");




$where_ =  $_POST['where_'];
$offset_ =  $_POST['offset'];
$rpp_ =  $_POST['rpp'];
$orderby =  $_POST['orderby'];
$dir =  $_POST['dir'];
$search_ = trim($_POST['search_']);
$customer = $_POST['customer'];


$limit = "$offset_, $rpp_";
$offset_2 = $offset_ + $rpp_;
$limit2 = $offset_+$rpp_;
$rows = "";

if($customer > 0){
    $andcustomer = " AND customer_id='$customer'";
}
else{
    $andcustomer = " ";
}
if((input_available($search_)) == 1){
    $andsearch = " AND (transcript LIKE '%$search_%')";
}
else{
    $andsearch = "";
}

//-----------------------------Reused Query
$o_conversations = fetchtable('o_customer_conversations',"$where_ AND status > 0 $andsearch $andcustomer", "$orderby", "$dir", "$limit", "*");
///----------Paging Option
$alltotal = countotal("o_customer_conversations","$where_ AND status > 0 $andsearch");
///==========Paging Option
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


           if($loan_id > 0){
               $bal = 0.00;
           }

        $row = $row."<tr>
    <td>$uid</td>
    <td><span class=\"font-16\">$customer_name <br/> ".flag($flag)."</span>
    </td>
    <td><i class=\"fa ".$meth['details']."\"></i><br/><span class='font-13'>".$meth['name']."</span></td>
    <td><span>$conversation_date</span><br/> <span class=\"text-muted font-12\">".fancydate($conversation_date)."</span></td>
    <td>$agent_name</td>
    <td><span>$transcript</span></td>
    <td><span>$next_interaction</span><br/> <span class=\"text-muted font-12\">".fancydate($next_interaction)."</span></td>
    <td><span>Loan: $loan_id</span><br/> <span class=\"text-muted font-12 font-bold\">Balance: $bal</span></td>
    
    <td><span><a class='pointer' onclick=\"view_interaction($uid);\"><span class=\"fa fa-eye text-green\"></span></a></span><h4><a href='interactions?customer=".encurl($customer_id)."'><i class=\"fa fa-reorder text-blue\"></i></a></h4></td>
</tr>";

        //////------Paging Variable ---
        $page_total = $page_total + 1;
        /////=======Paging Variable ---

    }

}
else{
    $row = "<tr><td colspan='8'><i>No Records Found</i></td></tr>";
}

echo   trim($row)."<tr style='display: none ;'><td colspan='8'>".paging_values_hidden($where_,$offset_,$rpp_,$orderby,$dir,$search_,'load_interactions',$page_total, $alltotal)."</td></tr>";

?>

