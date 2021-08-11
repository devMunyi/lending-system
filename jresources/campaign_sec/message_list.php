<?php
session_start();
include_once ("../php_functions/functions.php");
include_once ("../configs/conn.inc");

$campaign =  $_POST['campaign'];


if($campaign > 0){
    $o_campaign_messages = fetchtable('o_campaign_messages',"campaign_id = $campaign AND status = 1");
    if((mysqli_num_rows($o_campaign_messages)) < 1){
        $message_row = "<tr><td colspan='3' class='font-italic'>No Contacts</td></tr>";
    }else {
        while ($t = mysqli_fetch_array($o_campaign_messages)) {
            $uid = $t['uid'];
            $message = $t['message'];

             "<a href=\"brodcasts?campaign=$customer&contact=".encurl($uid)."\" title='Edit' class='pointer text-blue'><i class='fa fa-edit'></i></a> " . " <a onclick=\"delete_contact('".encurl($uid)."')\" title='Delete' class='pointer text-red'><i class='fa fa-trash'></i></a>";
        }
    }
}else{
    echo errormes("Campaign not selected");
}