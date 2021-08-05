<?php
session_start();
include_once ("../php_functions/functions.php");
include_once ("../configs/conn.inc");


$where_ =  $_POST['where_'];
$sort_option = $_POST['sort_option'];
$offset_ =  $_POST['offset'];
$rpp_ =  $_POST['rpp'];
$page_no = $_POST['page_no'];
$orderby =  $_POST['orderby'];
$dir =  $_POST['dir'];
$search_ = trim($_POST['search_']);


$limit = "$offset_, $rpp_";
$offset_2 = $offset_ + $rpp_;
$limit2 = $offset_+$rpp_;
$rows = "";

$run_array = array();
$run_ = fetchtable2("o_campaign_running_statuses", "name LIKE \"%$search_%\"", "uid", "asc", "uid");
$run_count = mysqli_num_rows($run_);
if($run_count > 0){
    while($run_list = mysqli_fetch_array($run_)){
        $run_id = $run_list['uid'];
        array_push($run_array, $run_id);
    }
    $camp_run_list = implode(", ", $run_array);
    $orcamprunstate = " OR running_status IN ($camp_run_list)";
}


$frequency_array = array();
$frequency_ = fetchtable2("o_campaign_frequencies", "name LIKE \"%$search_%\"", "uid", "asc", "uid");
$frequency_count = mysqli_num_rows($frequency_);
if($frequency_count > 0){
    while($freq_list = mysqli_fetch_array($frequency_)){
        $freq_id = $freq_list['uid'];
        array_push($frequency_array, $freq_id);
    }
    $camp_freq_list = implode(", ", $frequency_array);
    $orcampfreq = " OR frequency IN ($camp_freq_list)";
}

$repetitive_array = array();
$repetitive = fetchtable2("o_campaigns_repetition_status", "name LIKE \"%$search_%\"", "uid", "asc", "uid");
$repetitive_count = mysqli_num_rows($repetitive);
if($repetitive_count > 0){
    while($rep_list = mysqli_fetch_array($repetitive)){
        $repetitive_id = $rep_list['uid'];
        array_push($repetitive_array, $repetitive_id);
    }
    $camp_repetitive_list = implode(", ", $repetitive_array);
    $orcamprepetitive = " OR repetitive IN ($camp_repetitive_list)";
}

$audience_array = array();
$audience = fetchtable2("o_campaign_target_customers", "name LIKE \"%$search_%\"", "uid", "asc", "uid");
$audience_count = mysqli_num_rows($audience);
if($audience_count > 0){
    while($aud_list = mysqli_fetch_array($audience)){
        $audience_id = $aud_list['uid'];
        array_push($audience_array, $audience_id);
    }
    $target_audience_list = implode(", ", $audience_array);
    $ortargetaudience = "OR target_customers IN ($target_audience_list)";
}


if((input_available($search_)) == 1){
    $andsearch = " AND (name LIKE \"%$search_%\" OR running_date LIKE \"%$search_%\" OR target_customers LIKE \"%$search_%\" $ortargetaudience $orcamprepetitive $orcampfreq $orcamprunstate)";
}
else{
    $andsearch = "";
}

//-----------------------------Reused Query

//displaying list based on sort options
if($sort_option == "sort_1"){
    //All campaigns
    $o_campaigns_ = fetchtable("o_campaigns","$where_ AND status > 0 $andsearch", "$orderby", "$dir", "$limit","uid, name, description, running_date, running_status, frequency, repetitive, added_date, target_customers, status");

    ///----------Paging Option
    $alltotal = countotal("o_campaigns","$where_ AND status > 0 $andsearch");

    ///==========Paging Option
}elseif($sort_option == "sort_2"){
    //past campaigns
    $o_campaigns_ = fetchtable("o_campaigns","$where_  AND running_date < \"$date\" AND status = 1 $andsearch", "$orderby", "$dir", "$limit","uid, name, description, running_date, running_status, frequency, repetitive, added_date, target_customers, status");

    ///----------Paging Option
    $alltotal = countotal("o_campaigns","$where_ AND running_date < \"$date\" AND status = 1 $andsearch");

    ///==========Paging Option
}elseif($sort_option == "sort_3"){
    //upcoming campaigns
    $o_campaigns_ = fetchtable("o_campaigns","$where_  AND running_date > \"$date\" AND status = 1 $andsearch", "$orderby", "$dir", "$limit","uid, name, description, running_date, running_status, frequency, repetitive, added_date, target_customers, status");

    ///----------Paging Option
    $alltotal = countotal("o_campaigns","$where_ AND running_date > \"$date\" AND status = 1 $andsearch");

    ///==========Paging Option
}elseif($sort_option == "sort_4"){
    //repetitive campaigns
     $o_campaigns_ = fetchtable("o_campaigns","$where_  AND repetitive = 1 AND status > 0 $andsearch", "$orderby", "$dir", "$limit","uid, name, description, running_date, running_status, frequency, repetitive, added_date, target_customers, status");

    ///----------Paging Option
    $alltotal = countotal("o_campaigns","$where_ AND repetitive = 1 AND status > 0 $andsearch");

    ///==========Paging Option
}else{
    //default or running campaign(s)
     $o_campaigns_ = fetchtable("o_campaigns","$where_  AND (running_date = \"$date\" OR target_customers = 2) AND status > 0 $andsearch", "$orderby", "$dir", "$limit","uid, name, description, running_date, running_status, frequency, repetitive, added_date, target_customers, status");

    ///----------Paging Option
    $alltotal = countotal("o_campaigns","$where_ AND (running_date = \"$date\" OR target_customers = 2) AND status > 0 $andsearch");

    ///==========Paging Option

}

if($alltotal > 0) {
    while ($l = mysqli_fetch_array($o_campaigns_)) {
        $uid = $l['uid'];         $uid_enc = encurl($uid);
        $campaign_name = $l["name"];
        $description = $l['description'];
        $added_date = $l["added_date"];
        $running_state_ = $l["running_status"]; $running_state = fetchonerow("o_campaign_running_statuses", "uid = $running_state_", "name, color_code");
        $running_date = $l["running_date"];
        $frequency = $l["frequency"]; $frequency_ = fetchrow("o_campaign_frequencies", "uid = $frequency", "name");
        $repetitive = $l["repetitive"]; $repetition_ = fetchrow("o_campaigns_repetition_status", "uid = $repetitive", "name");
        $target_customers = $l["target_customers"]; $target_audience = fetchrow("o_campaign_target_customers", "uid ='$target_customers'", "name");
        $status = $l['status']; $state = fetchonerow("o_campaign_statuses","code='$status'","color, name");


        $cust_with_loans = fetchrow('o_loans', "(total_repayable_amount - total_repaid) > 0 AND (status = 2 OR status = 3)", "customer_id");
        $dob_curdate = substr($date, 5);

        if($target_customers == 1){
            $cust_numbers = countotal("o_customers","$where_ AND uid NOT IN($cust_with_loans) AND status = 1");
        }elseif($target_customers == 2){
            $cust_numbers = countotal("o_customers", "uid >= 1 AND SUBSTRING(dob, 6) = \"$dob_curdate\" AND status = 1");
        }elseif($target_customers == 3) {
            $cust_numbers =  countotal("o_customers", "uid >= 1 AND status = 1");
        }else{}
        
        //filter happy campaign to run daily 
        if($frequency_ == "Daily" AND $repetition_ == "Yes" AND $target_customers = 2){
            $row .= "<tr><td>$uid</td>
                            <td><span class='font-16'>$campaign_name</span></td>
                            <td><span>$date</span><br/> <span class=\"text-orange font-13 font-bold\">".fancydate($date)."</span></td>
                            <td><span class = 'label custom-color' style = 'background-color:".$running_state['color_code']."'>".$running_state['name']."</td>
                            <td><span>$frequency_</span></td>
                            <td><span>$repetition_</span></td>
                            <td><span>$target_audience</span><br><span class='badge'>$cust_numbers</span></td>
                            <td><span class='label ".$state['color']."'>".$state['name']." </span></td>
                            <td><span><a href='?campaign=$uid_enc'><span class='fa fa-eye text-green'></span></td>
                        </tr>
                ";

        }else{
            $row .= "<tr><td>$uid</td>
                            <td><span class='font-16'>$campaign_name</span></td>
                            <td><span>$running_date</span><br/> <span class=\"text-orange font-13 font-bold\">".fancydate($running_date)."</span></td>
                            <td><span class = 'label custom-color' style = 'background-color:".$running_state['color_code']."'>".$running_state['name']."</td>
                            <td><span>$frequency_</span></td>
                            <td><span>$repetition_</span></td>
                            <td><span>$target_audience</span><br><span class='badge'>$cust_numbers</span></td>
                            <td><span class='label ".$state['color']."'>".$state['name']." </span></td>
                            <td><span><a href='?campaign=$uid_enc'><span class='fa fa-eye text-green'></span></td>
                        </tr>
                ";
        }

        //////------Paging Variable ---
        //$page_total = $page_total + 1;
        /////=======Paging Variable ---


    }
}
else{
    $row = "<tr><td colspan='8'><i>No Records Found</i></td></tr>";
}

echo   trim($row)."<tr style='display: none;'><td><input type='text' id='_alltotal_' value='$alltotal'><input type='text' id='_pageno_' value='$page_no'></td></tr>";

