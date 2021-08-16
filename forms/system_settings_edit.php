<?php
session_start();
include_once ("../php_functions/functions.php");
include_once ("../configs/conn.inc");

/////----------Session Check
$userd = session_details();
if($userd == null){
    die(errormes("Your session is invalid. Please re-login"));
    exit();
}
/////---------End of session check

$row = fetchonerow("platform_settings", "uid > 0", "*");
$name_ = $row['name'];
$logo_ = $row['logo'];
$icon_ = $row['icon'];
$link_ = $row['link'];
?>
            <form class="form-horizontal" id="doc-upload" method="POST" action="action/system/system_settings_update" enctype="multipart/form-data">
                <div class="box-body">
                    <div class="form-group">
                        <label for="name" class="col-sm-3 control-label">Name</label>

                        <div class="col-sm-9">
                            <input class="form-control" type="text" name="name" id="name" value="<?php echo $name_; ?> ">
                        </div>

                    </div>

                    <div class="form-group">

                        <label for="file_" class="col-sm-3 control-label">Logo</label>
                        <div class="col-sm-9">
                            <input type="file" class="form-control" id="file_" name="file_">
                        </div>
                    </div>

                    <div class="form-group">

                        <label for="make_thumbnail" class="col-sm-3 control-label">Make a Thumbnail</label>

                        <div class="col-sm-9">
                            <label> <input type="checkbox" value="1" CHECKED id="make_thumbnail" name="make_thumbnail"> Yes</label>
                        </div>
                    </div>

                    <div class="col-sm-3"></div>
                    <div class="col-sm-9">
                        <div class="box-footer">
                            <br/>
                            <div class="prgress">
                                <div class="messagedoc-upload" id="message"></div>
                                <div class="progressdoc-upload" id="progress">
                                    <div class="bardo-upload" id="bar"></div>
                                    <br/>
                                    <div class="percentdoc-upload" id="percent"></div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-lg btn-default">Cancel</button>
                            <button type="submit" class="btn btn-success btn-lg pull-right" onclick="formready('doc-upload');">Submit </button>
                        </div>
                    </div>
                    
                </div>
                <!-- /.box-body -->

                <!-- /.box-footer -->
            </form>
