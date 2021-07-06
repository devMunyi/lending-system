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
    $andsearch = " AND (title LIKE '%$search_%' || details = '%$search_%' || source_details = '%$search_%' )";
}
else{
    $andsearch = "";
}

//-----------------------------Reused Query
$o_notifs = fetchtable('o_notifications',"$where_ AND status > 0 AND staff_id = 1 $andsearch", "$orderby", "$dir", "$limit", "*");
///----------Paging Option
$alltotal = countotal("o_notifications","$where_ AND status > 0 AND staff_id = 1 $andsearch");
///==========Paging Option
$row="<li class=\"header font-bold font-14\">You have $alltotal notification(s)</li><li><ul class=\"menu list-unstyled\">";
if($alltotal > 0) {
    while ($k = mysqli_fetch_array($o_notifs)) {
        $uid = $k['uid'];
        $sent_date = $k['sent_date'];
        $source_details = $k['source_details'];
        $title = $k['title'];
        $details = $k['details'];
        $link = $k['link'];
        $status = $k['status'];

        $row .= "<li><a href=\"#\"> <i class='fa fa-bell-o'></i> <span class='font-14 font-bold'>$title</span> <span class='pull-right text-muted'> $sent_date</span> <br/> $details  </a></li>";

        //////------Paging Variable ---
        $page_total = $page_total + 1;
        /////=======Paging Variable ---


    }
}


echo   trim($row."</ul></li>")."<span style='display: none ;'><span>".paging_values_hidden($where_,$offset_,$rpp_,$orderby,$dir,$search_,'customer_list',$page_total, $alltotal)."</span></span>";