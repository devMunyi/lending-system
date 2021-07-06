<?php
session_start();
include_once ("../../php_functions/functions.php");
include_once ("../../configs/conn.inc");

$userd = session_details();
if($userd == null){
    die(errormes("Your session is invalid. Please re-login"));
    exit();
}

$group_id = $_POST['group_id'];
$user_id = $_POST['user_id'];
$tbl = $_POST['tbl'];
$rec = $_POST['rec'];
$act = $_POST['act'];
$value = $_POST['val'];



if($group_id > 0 || $user_id > 0){}
else{
    die(errormes("Please select group or user"));
    exit();
}

if((input_available($tbl)) == 0){
    die(errormes("Please select table"));
    exit();
}

$current_record = fetchonerow('o_permissions',"group_id='$group_id' AND user_id='$user_id' AND tbl='$tbl' AND rec='$rec'","uid, general_, create_, read_, update_, delete_");
$uid = $current_record['uid'];
if($uid > 0){
    if((input_available($act))){
       $up = updatedb('o_permissions',"$act='$value'","uid='$uid'");
       if($up == 1){
           $success = 1;
       }
    }
    $general = zerotone($current_record['general_']);
    $create = zerotone($current_record['create_']);
    $read = zerotone($current_record['read_']);
    $update = zerotone($current_record['update_']);
    $delete = zerotone($current_record['delete_']);
    echo "<tr><td><a onclick=\"permissions('$group_id', '$user_id', '$tbl', '$rec', 'general_', $general);\" class=\"pointer\">".toggleico(($general))."</a> General Action</td></tr>";
    echo "<tr><td><a onclick=\"permissions('$group_id', '$user_id', '$tbl', '$rec', 'create_', $create);\" class=\"pointer\">".toggleico(($create))."</a> Create</td></tr>";
    echo "<tr><td><a onclick=\"permissions('$group_id', '$user_id', '$tbl', '$rec', 'read_', $read);\" class=\"pointer\">".toggleico(($read))."</a> Read</td></tr>";
    echo "<tr><td><a onclick=\"permissions('$group_id', '$user_id', '$tbl', '$rec', 'update_', $update);\" class=\"pointer\">".toggleico(($update))."</a> Update</td></tr>";
    echo "<tr><td><a onclick=\"permissions('$group_id', '$user_id', '$tbl', '$rec', 'delete_', $delete);\" class=\"pointer\">".toggleico(($delete))."</a> Delete</td></tr>";
}
else{
    if((input_available($act))){
        if($act == 'general_'){
            $general_ = $value;
        }
        if($act == 'create_'){
            $create_ = $value;
        }
        if($act == 'read_'){
            $read_ = $value;
        }
        if($act == 'update_'){
            $update_ = $value;
        }
        if($act == 'delete_'){
            $delete_ = $value;
        }


        $fds = array('group_id','user_id','tbl','rec','general_','create_','read_','update_','delete_');
        $vals = array("$group_id","$user_id","$tbl","$rec","$general_","$create_","$read_","$update_","$delete_");
        $create = addtodb('o_permissions',$fds,$vals);
        if($create == 1){
                $success = 1;
        }

    }
    $general = $create = $read = $update = $delete = 0;
    echo "<tr><td><a onclick=\"permissions('$group_id', '$user_id', '$tbl', '$rec', 'general_', 1);\" class=\"pointer\"><i class=\"fa fa-times text-red\"></i></a> General Action</td></tr>";
    echo "<tr><td><a onclick=\"permissions('$group_id', '$user_id', '$tbl', '$rec', 'create_', 1);\" class=\"pointer\"><i class=\"fa fa-times text-red\"></i></a> Create</td></tr>";
    echo "<tr><td><a onclick=\"permissions('$group_id', '$user_id', '$tbl', '$rec', 'read_', 1);\" class=\"pointer\"><i class=\"fa fa-times text-red\"></i></a> Read</td></tr>";
    echo "<tr><td><a onclick=\"permissions('$group_id', '$user_id', '$tbl', '$rec', 'update_', 1);\" class=\"pointer\"><i class=\"fa fa-times text-red\"></i></a> Update</td></tr>";
    echo "<tr><td><a onclick=\"permissions('$group_id', '$user_id', '$tbl', '$rec', 'delete_', 1);\" class=\"pointer\"><i class=\"fa fa-times text-red\"></i></a> Delete</td></tr>";

}
$g = "($group_id, $user_id, '$tbl', $rec, '$act', '$value')";


?>
<script>
    if('<?php echo $success ?>'){
        permissions('<?php echo $group_id; ?>', '<?php echo $user_id; ?>', '<?php echo $tbl; ?>', '<?php echo $rec ?>', '', '');
    }
</script>

