<?php
session_start();
include_once("configs/conn.inc");
include_once ("php_functions/functions.php");
include_once ("configs/conn.inc");

$company = company_settings();

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $company['name']; ?> | Reports</title>
    <!-- Tell the browser to be responsive to screen width -->
    <?php
    include_once('header_includes.php');
    ?>
</head>
<body class="hold-transition skin-purple sidebar-mini">
<div class="wrapper">

    <?php
    include_once('header.php');
    ?>
    <!-- Left side column. contains the logo and sidebar -->
    <?php
    include_once('menu.php');
    ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->


        <!-- Main content -->


        <section class="content-header">
            <h1>
                Reports
                <small>List</small>
                <a href="reports?add-edit" class="btn btn-success" style="margin-left: 30%;"><i class="fa fa-plus pull-right"></i>New Report</a>
            </h1>
            <ol class="breadcrumb">
                <li><a href="index"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Reports</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <?php
                if(isset($_GET['report'])) {
                    $rep_id = $_GET['report'];
                    if($rep_id > 0){
                        $x = fetchonerow("o_reports","uid='".decurl($rep_id)."'","*");
                        $uid = $x['uid'];
                        $title = $x['title'];
                        $description = $x['description'];
                        $row_query = $x['row_query'];
                        $added_by = $x['added_by'];
                        $added_date = $x['added_date'];
                        $viewable_by = $x['viewable_by'];
                    }
                    ?>
                    <div class="col-xs-12">

                    <div class="box box-primary">
                        <div class="box-title well"><div class="row"> <div class="col-xs-6"> <h4 class="font-bold"><?php echo arrow_back('reports','Reports'); ?> <?php echo $title; ?></h4></div>  <div class="col-xs-2"><input type="date" class="form-control"></div> <div class="col-xs-2"> <input type="date" class="form-control"></div><div class="col-xs-2"><button class="btn btn-primary"> RUN <i class="fa fa-arrow-right"></i></button> <a class="pull-right font-16" href="?add-edit=<?php echo $rep_id; ?>"><i class="fa fa-edit"></i></a></div> </div></div>
                        <div class="box-body scroll-hor">
                           <table class="table table-condensed table-striped">
                               <?php

                               $sql =  "$row_query";

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
                                           $rec.="<td>".$v."</td>";
                                       } /////This is not a real key. Only Mysql knows what it is



                                   }
                                   $rec.="</tr>";

                                   echo $rec;
                                   $rec = "";
                                   $loop = $loop + 1;
                               }
                               echo $head.$head_;
                               ?>

                           </table>
                        </div>
                    </div>


                    </div>
                    <?php
                }
                elseif (isset($_GET['add-edit'])){
                    ?>
                <div class="col-xs-12">
                    <!-- /.box -->
                    <div class="row">
                        <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <div class="box box-success">
                                    <div class="box-header with-border">
                                        <h3 class="box-title font-bold"><?php echo arrow_back('reports',"Reports"); ?>Add New Report</h3>

                                        <!-- /.box-tools -->
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        <?php
                                        $z = fetchonerow("o_reports","uid='".decurl($_GET['add-edit'])."'","*");
                                        $uid = $z['uid'];
                                        $title = $z['title'];
                                        $description = $z['description'];
                                        $row_query = $z['row_query'];
                                        $added_by = $z['added_by'];
                                        $added_date = $z['added_date'];
                                        $viewable_by = $z['viewable_by'];
                                        $status = $z['status'];

                                        ?>

                                        <form class="form-horizontal" id="other_frm" onsubmit="return false;" method="post">
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <input type="hidden" id="report_id" value="<?php echo $_GET['add-edit'];  ?>">
                                                    <label for="title" class="col-sm-3 control-label">Title</label>

                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" value="<?php echo $title; ?>" id="title">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="description" class="col-sm-3 control-label">Description</label>

                                                    <div class="col-sm-9">
                                                        <textarea class="form-control"  id="description" aria-invalid="description" placeholder=""><?php echo $title; ?></textarea>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="row_query" class="col-sm-3 control-label">SQL Query</label>

                                                    <div class="col-sm-9">
                                                        <textarea class="form-control" style="height: 160px; background: #0a0a0a; color: lightgrey; font-family: Monospace;"  id="row_query" aria-invalid="description" placeholder=""><?php echo $row_query; ?></textarea>
                                                        <span class="font-italic"> For variables like date user triple curly e.g.  {{{start_date}}}, {{{end_date}}}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="viewable_by" class="col-sm-3 control-label">Viewable by</label>

                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" value="<?php echo $viewable_by; ?>" id="viewable_by">
                                                       <span class="font-italic">Enter the groups separated by comma that can view this report. 0 is for all groups:
                                                           <?php
                                                           $o_user_groups_ = fetchtable('o_user_groups',"status=1", "uid", "asc", "0,100", "uid ,name ");
                                                           while($h = mysqli_fetch_array($o_user_groups_))
                                                           {
                                                               $uid = $h['uid'];
                                                               $name = $h['name'];
                                                               echo "<b>$uid</b> -> $name,";
                                                           }
                                                           ?>
                                                       </span>
                                                    </div>
                                                </div>


                                                <div class="col-sm-3"></div>
                                                <div class="col-sm-9">
                                                    <div class="box-footer">
                                                        <br/>
                                                        <button type="submit" class="btn btn-lg btn-default">Cancel</button>
                                                        <button type="submit" class="btn btn-success btn-lg pull-right"  onclick="save_report();">Save </button>
                                                    </div>
                                                </div>

                                            </div>
                                            <!-- /.box-body -->

                                            <!-- /.box-footer -->
                                        </form>


                                    </div>
                                    <!-- /.box-body -->
                                </div>
                                <!-- /.box -->
                            </div>


                    </div>
                </div>
                    <?php
                }
                else {
                    ?>


                    <div class="col-xs-12">
                        <!-- /.box -->
                        <div class="row">
                            <?php
                            $o_reports_ = fetchtable('o_reports',"status=1", "uid", "desc", "0,10", "uid ,title ,description ,row_query ,added_by ,added_date ,viewable_by ");
                           if((mysqli_num_rows($o_reports_)) == 0) {
                               echo "<h3 class='font-italic'>No reports defined</h3>";
                           }
                           else{
                               while ($x = mysqli_fetch_array($o_reports_)) {
                                   $uid = $x['uid'];
                                   $title = $x['title'];
                                   $description = $x['description'];
                                   $row_query = $x['row_query'];
                                   $added_by = $x['added_by'];
                                   $added_date = $x['added_date'];
                                   $viewable_by = $x['viewable_by'];

                                   echo " <a href=\"?report=".encurl($uid)."\">
                                <div class=\"col-md-3\">
                                    <div class=\"box box-success\">
                                        <div class=\"box-header with-border\">
                                            <h3 class=\"box-title font-bold\">$title</h3>

                                            <!-- /.box-tools -->
                                        </div>
                                        <!-- /.box-header -->
                                        <div class=\"box-body\">
                                            $description
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                    <!-- /.box -->
                                </div>
                            </a>";
                               }
                           }

                            ?>




                        </div>
                        <!-- /.box -->
                    </div>
                    <?php
                }
                ?>
                <!-- /.col -->
            </div>
        </section>



        <!-- /.content -->
    </div>

    <!-- /.content-wrapper -->
    <?php
    include_once("footer.php");
    ?>


    <!-- Control Sidebar -->

    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<?php
include_once("footer_includes.php");
?>
<script>
    $(function () {
        $('#example1').DataTable()
        $('#example2').DataTable({
            'paging'      : true,
            'lengthChange': false,
            'searching'   : false,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false
        })
    })
</script>
</body>
</html>
