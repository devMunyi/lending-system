



<section class="content-header">
    <?php
    $cid = $_GET['add-edit-campaign'];
    if($cid > 0){
        $campaign = fetchonerow('o_campaigns',"uid='".decurl($cid)."'");

    echo " <h1>       Edit Campaign    </h1>";
    }
    else{
    echo " <h1>       Add Campaign    </h1>";
        $campaign = array();
    }
    ?>

    <ol class="breadcrumb">
        <li><a href="index"><i class="fa fa-dashboard"></i> Home</a></li>

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
                                    <label for="date" class="col-sm-3 control-label">Date</label>

                                    <div class="col-sm-9">
                                        <input type="date" class="form-control"  id="date">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="target_customers" class="col-sm-3 control-label">Target Customers</label>

                                    <div class="col-sm-9">
                                        <select class="form-control" id="target_customers">
                                            <option value="0">--Select One</option>
                                            <?php

                                            $recs = fetchtable('o_campaign_target_customers',"status=1", "name", "asc", "100", "uid ,name");
                                            while($r = mysqli_fetch_array($recs))
                                            {
                                                $uid = $r['uid'];
                                                $name = $r['name'];

                                                echo "<option value=\"$uid\">$name</option>";
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
                        if($sid > 1) {
                        }
                        else{
                            ?>
                            <button class="btn btn-danger btn-md pull-right"><i class="fa fa-ban"></i> Stop Campaign </button>
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
