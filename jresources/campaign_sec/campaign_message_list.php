<?php
session_start();
include_once ("../../php_functions/functions.php");
include_once ("../../configs/conn.inc");

$campaign =  $_POST['campaign'];
$action = $_POST['action'];


if($campaign > 0){
    $campaign_message = fetchtable('o_campaign_messages',"campaign_id = ".decurl($campaign)." AND status = 1", "uid", "desc", "0, 2", "uid, message");
    if((mysqli_num_rows($campaign_message)) < 1){
        $message_row = "<tr><td colspan='3' class='font-italic'>No Message</td></tr>";
    }else {
        while ($m = mysqli_fetch_array($campaign_message)) {
            $uid = $m['uid'];
            $message = $m['message'];
            
            $act = "<a href=\"broadcasts?campaign-add-edit=$campaign&message=".encurl($uid)."\" title='Edit' class='pointer text-blue'><i class='fa fa-edit'></i></a> " . " <a onclick=\"delete_message('".encurl($uid)."')\" title='Delete' class='pointer text-red'><i class='fa fa-trash'></i></a>";

            $message_row.= "<tr id='mess".encurl($uid)."'><td>$message</td><td>$act</td></tr>";
        }
    }
    echo "<table class='table table-striped table-condensed' style='width: 95%;'><tr><th>Message</th><th>Action</th></tr>$message_row<tr><th>Message</th><th>Action</th></tr></table>";
}
else{
    echo errormes("Campaign not selected");
}