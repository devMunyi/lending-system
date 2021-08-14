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
            <form class="form-horizontal" autocomplete="off" onsubmit="return false;" method="post">
                <div class="box-body">
                    <div class="form-group">
                        <label for="name" class="col-sm-3 control-label">Name</label>

                        <div class="col-sm-9">
                            <input class="form-control" type="text" id="name" value="<?php echo $name_; ?> ">
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="logo" class="col-sm-3 control-label">Logo</label>

                        <div class="col-sm-9">
                            <input class="form-control" type="text" id="logo" value="<?php echo $logo_; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="icon" class="col-sm-3 control-label">Icon</label>

                        <div class="col-sm-9">
                            <input class="form-control" type="text" id="icon" value="<?php echo $icon_; ?>">
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="link" class="col-sm-3 control-label">Link</label>

                        <div class="col-sm-9">
                            <input class="form-control" type="text" id="link" value="<?php echo $link_; ?>">
                        </div>
                    </div>
                    <div class="col-sm-3"></div>
                    <div class="col-sm-9">
                        <div class="box-footer">
                            <br/>
                            <button type="submit" class="btn btn-lg btn-default">Cancel</button>
                            <button type="submit"
                                    class="btn btn-success btn-lg pull-right"
                                    onclick="save_settings();">
                                Save
                            </button>
                        </div>
                    </div>

                </div>
                <!-- /.box-body -->

                <!-- /.box-footer -->
            </form>
