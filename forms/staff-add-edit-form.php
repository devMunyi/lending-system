<section class="content-header">
    <h1>
        <?php echo arrow_back('staff','Staff'); ?>
        <?php
        $sid = $_GET['add-edit'];
        if($sid > 0){
            $staff = fetchonerow('o_users',"uid='".decurl($sid)."'");
            echo "Staff <small>Edit</small>";
            $pass = "";
        }
        else{
            $staff = array();
            $pass = generateRandomString(6);
            echo "Staff <small>Add</small>";
        }
        ?>

    </h1>
    <ol class="breadcrumb">
        <li><a href="index"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Staff/Add</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">

            <!-- /.box -->

            <div class="box">

                <!-- /.box-header -->
                <div class="row">
                    <div class="col-sm-7 box-body">
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form class="form-horizontal" onsubmit="return false;" method="post">
                            <div class="box-body">
                                <div class="form-group">
                                    <input type="hidden" id="sid" value="<?php echo $sid; ?>">
                                    <label for="full_name" class="col-sm-3 control-label">Full Name</label>

                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="<?php echo $staff['name'] ?>" id="full_name" placeholder="First Middle Last">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email_" class="col-sm-3 control-label">Email</label>

                                    <div class="col-sm-9">
                                        <input type="email" class="form-control" value="<?php echo $staff['email'] ?>" autocomplete="OFF" id="email_" placeholder="Preferably a work email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="national_id" class="col-sm-3 control-label">National ID</label>

                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="<?php echo $staff['national_id'] ?>" id="national_id" placeholder="8 Characters">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="phone_number" class="col-sm-3 control-label">Phone Number</label>

                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="phone_number" value="<?php echo $staff['phone'] ?>" placeholder="07...">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="passwo" class="col-sm-3 control-label">Password</label>

                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="passwo" value="<?php echo $pass; ?>" placeholder="Unchanged">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="group_" class="col-sm-3 control-label">Group</label>

                                    <div class="col-sm-9">
                                        <select class="form-control" id="group_">
                                            <option value="0">--Select One</option>
                                            <?php

                                            $recs = fetchtable('o_user_groups',"uid>0", "name", "asc", "100", "uid ,name");
                                            while($r = mysqli_fetch_array($recs))
                                            {
                                                $uid = $r['uid'];
                                                $name = $r['name'];
                                                if($uid ==  $staff['user_group']){
                                                    $g_selected = 'SELECTED';
                                                }
                                                else{
                                                    $g_selected = "";
                                                }
                                                echo "<option $g_selected value=\"$uid\">$name</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="branch_" class="col-sm-3 control-label">Branch</label>

                                    <div class="col-sm-9">
                                        <select class="form-control" id="branch_">
                                            <option value="0">--Select One</option>
                                            <?php
                                            $o_branches_ = fetchtable('o_branches',"uid>0", "uid", "desc", "0,10", "uid ,name ");
                                            while($b = mysqli_fetch_array($o_branches_))
                                            {
                                                $uid = $b['uid'];
                                                $name = $b['name'];
                                                if($uid ==  $staff['branch']){
                                                    $b_selected = 'SELECTED';
                                                }
                                                else{
                                                    $b_selected = "";
                                                }

                                                echo "<option $b_selected value='$uid'>$name</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="status_" class="col-sm-3 control-label">Status</label>

                                    <div class="col-sm-9">
                                        <select class="form-control" id="status_">
                                            <option value="0">--Select One</option>
                                            <?php
                                            $o_staff_statuses_ = fetchtable('o_staff_statuses',"uid>0", "uid", "asc", "0,20", "uid ,name ");
                                            while($r = mysqli_fetch_array($o_staff_statuses_))
                                            {
                                                $uid = $r['uid'];
                                                $name = $r['name'];
                                                if($uid == $staff['status']){
                                                    $selected = "SELECTED";
                                                }else{
                                                    $selected = "";
                                                }
                                                echo "<option $selected value=\"$uid\">$name</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-3"></div>
                                <div class="col-sm-9">
                                <div class="box-footer">
                                    <br/>
                                    <button type="submit" class="btn btn-lg btn-default">Cancel</button>
                                    <button type="submit" class="btn btn-success btn-lg pull-right" onclick="staff_save();">Save</button>
                                </div>
                                </div>

                            </div>
                            <!-- /.box-body -->

                            <!-- /.box-footer -->
                        </form>

                    </div>
                    <div class="col-sm-3 box-body">
                        <?php
                        if($sid > 1) {
                        }
                        else{
                            ?>
                            <button class="btn btn-danger btn-md pull-right"><i class="fa fa-ban"></i> Block Member </button>
                            <?php
                        }
                        ?>

                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
</section>
