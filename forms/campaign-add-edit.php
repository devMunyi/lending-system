<section class="content-header">
    <?php
    $cid = $_GET['campaign-add-edit'];
    if($cid > 0){
        $campaign = fetchonerow('o_campaigns',"uid='".decurl($cid)."'");
        $cid = $_GET['campaign-add-edit'];

    echo " <h1>".arrow_back('broadcasts','Broadcasts')."Edit Campaign </h1>";
    }
    else{
    echo " <h1>".arrow_back('broadcasts','Broadcasts'). "Add Campaign </h1>";
        $campaign = array();
        $cid = "";
    }
    ?>

    <ol class="breadcrumb">
        <li><a href="index"><i class="fa fa-dashboard"></i> Home</a></li>
        <?php if($cid > 0){
            echo "<li class=\"active\">Campaign/Edit</li>";
        }else{
            echo "<li class=\"active\">Campaign/Add</li>";
        }
        ?>
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
                                    <input type="hidden" id="cid" value="<?php echo $cid; ?>">
                                    <label for="title" class="col-sm-3 control-label">Title</label>

                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="<?php echo $campaign['name']; ?>"  id="title" placeholder="Campaign title">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="description" class="col-sm-3 control-label">Description</label>

                                    <div class="col-sm-9">
                                        <textarea class="form-control" id="description"><?php echo $campaign['description']; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="date" class="col-sm-3 control-label">Running Date</label>

                                    <div class="col-sm-9">
                                        <input type="date" class="form-control"  id="date" 
                                        value="<?php echo $campaign['running_date'] ;?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="date" class="col-sm-3 control-label">Frequency</label>

                                    <div class="col-sm-9">
                                        <select class="form-control" id="frequency">
                                            <option value="">--Select One</option>
                                            <?php 
                                            $frequencies = fetchtable("o_campaign_frequencies", "status = 1", "uid", "asc", "0,10", "uid, name");

                                            while($recs_1 = mysqli_fetch_array($frequencies)){
                                                $uid_1 = $recs_1['uid'];
                                                $name_1 = $recs_1['name'];

                                                if($campaign['frequency'] == $uid_1){
                                                    $sel_1 = 'SELECTED';
                                                }else{
                                                    $sel_1 = '';
                                                }  
                                                echo "<option $sel_1 value = \"$uid_1\">$name_1</option>";
                                            }                                         
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="date" class="col-sm-3 control-label">Repetitive</label>

                                    <div class="col-sm-9">
                                        <select class="form-control" id="repetitive">
                                            <option value="">--Select One</option>
                                            <?php
                                            $repetition = fetchtable("o_campaigns_repetition_status", "status = 1", "uid", "asc", "0,10", "uid, name");
                                            while($recs_2 = mysqli_fetch_array($repetition)){
                                                $uid_2 = $recs_2['uid'];
                                                $name_2 = $recs_2['name'];
                                                if($campaign['repetitive'] == $uid_2){
                                                    $sel_2 = 'SELECTED';
                                                }else{
                                                    $sel_2 = '';
                                                }
                                                echo "<option $sel_2 value=\"$uid_2\">$name_2</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="target_customers" class="col-sm-3 control-label">Target Customers</label>

                                    <div class="col-sm-9">
                                        <select class="form-control" id="target_customers">
                                            <option value="">--Select One</option>
                                            <?php

                                            $target_customers_ = fetchtable("o_campaign_target_customers","status = 1", "uid", "asc", "0,10", "uid ,name");
                                            while($recs_3 = mysqli_fetch_array($target_customers_))
                                            {
                                                $uid_3 = $recs_3['uid'];
                                                $name_3 = $recs_3['name'];
                                                if($campaign["target_customers"] == $uid_3){
                                                    $sel_3 = 'SELECTED';
                                                }else{
                                                    $sel_3 = '';
                                                }

                                                echo "<option $sel_3 value=\"$uid_3\">$name_3</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="status" class="col-sm-3 control-label">Status</label>

                                    <div class="col-sm-9">
                                        <select class="form-control" id="status">
                                            <option value="1">Active</option>
                                            <option value="2">Inactive</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-3"></div>
                                <div class="col-sm-9">
                                    <div class="box-footer">
                                        <br/>
                                        <button type="submit" class="btn btn-lg btn-default">Cancel</button>
                                        <button type="submit" class="btn btn-success btn-lg pull-right" onclick="save_campaign();">Save</button>
                                    </div>
                                </div>

                            </div>
                            <!-- /.box-body -->

                            <!-- /.box-footer -->
                        </form>

                    </div>
                    <div class="col-sm-3 box-body">
                        <?php
                        /*if($cid > 1) {
                        }
                        else{
                            ?>
                            <button class="btn btn-danger btn-md pull-right"><i class="fa fa-ban"></i> Stop Campaign </button>
                            <?php
                        }*/
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
