<h3>Group Permissions</h3>
<div class="row">
    <div class="col-sm-2">
        <h4>User Groups</h4>
        <table class="table  table-bordered">
        <?php
        $i = 0;
        $g = $_GET['g'];
        $o_user_groups_ = fetchtable('o_user_groups',"status=1", "uid", "desc", "0,10", "uid ,name ,description ,status ");
        while($s = mysqli_fetch_array($o_user_groups_))
        {
            $i = $i + 1;
            $uid = $s['uid'];
            $name = $s['name'];
            $description = $s['description'];
            if($g == $uid){
                $name = "<b>".$name."</b>";
            }
            echo "<tr><td><a href='settings?group-permissions&g=$uid'>$i. $name</a></td></tr>";
        }
        ?>
        </table>
    </div>
    <div class="col-sm-3 scroll-hor">
        <h4>Tables</h4>
        <table class="table  table-striped table-condensed">
        <?php
        if(isset($_GET['g'])){
           /////---------List All Tables
            $t = $_GET['t'];
            $tables = array();
            $showtables= mysqli_query($con,"SHOW TABLES FROM ".$dbname);
            while($table = mysqli_fetch_array($showtables)) { // go through each row that was returned in $result
                array_push($tables, $table[0]);
            }

           for($i=0; $i<sizeof($tables); ++$i){
               $ii = $i+1;
               $tbl = $tables[$i];
               if($t == $tbl){
                   $tbl = "<b>".$tbl."</b>";
               }

               echo "<tr><td><a class='text-navy' href='settings?group-permissions&g=$g&t=".$tables[$i]."'>$ii. ".$tbl."</a></td></tr>";
           }
        }
        else{
            echo "<i>Select a Group First</i>";
        }
        ?>
        </table>
    </div>
    <div class="col-sm-4 font-13 scroll-hor">
        <h4>Records</h4>
        <table class="table  table-striped table-condensed">
            <?php
            if(isset($_GET['t'])){
                /////---------List All Tables
                $t = $_GET['t'];
                $recid = $_GET['r'];
                $sql =  "SELECT * from $t where uid > 0";

                $result=mysqli_query($con, $sql);
                $loop = 0;
                ///////------Write table heads
                $obj = mysqli_fetch_array($result);
                $times = 0;
                foreach($obj as $field => $value) {
                    $times+=1;
                    $head.="<tr>";
                    if(!is_numeric($field)){
                        $head_.="<th>".$field."</th>";
                    } /////This is not a real key. Only Mysql knows what it is
                    $head.="</tr>";

                }

                echo $head.$head_;

                while($row = mysqli_fetch_array($result)) {
                    $rec.="<tr>";
                    foreach($row as $r => $v) {
                        //echo "Key=" . $r . ", Value=" . $v;

                        if(!is_numeric($r)){
                            if($recid == $v['uid']){
                                $b = "text-bold";
                            }
                            else{
                                $b = "";
                            }

                            $rec.="<td class='$b'><a href=\"settings?group-permissions&g=$g&t=$t&r=".$v['uid']."\">".$v."</a></td>";
                        } /////This is not a real key. Only Mysql knows what it is



                    }
                    $rec.="</tr>";

                    echo $rec;
                    $rec = "";
                    $loop = $loop + 1;
                }
                echo $head.$head_;
            }
            else{
                echo "<i>Select a Table First</i>";
            }
            ?>
        </table>
    </div>
    <div class="col-sm-3">
        <table class="table table-bordered">
            <?php
            if((isset($_GET['g'])) && (isset($_GET['t']))){
                $load_perms = 1;
                ?>
              <div id="perm">
                  Loading
              </div>
            <?php
            }
            ?>

        </table>
    </div>

</div>

