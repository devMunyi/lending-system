<section class="content-header">
    <?php 
    $campaign = $_GET["campaign"];
    $campaign_id = decurl($campaign);
    $campaign_ = fetchonerow("o_campaigns", "uid = '$campaign_id'");
    $camp_id_ = $campaign_["uid"];
    $camp_id = encurl($camp_id_);
    $camp_name = $campaign_["name"];
    $camp_message = $campaign_["description"];
    $camp_added_date = $campaign_["added_date"];
    $camp_running_date = $campaign_["running_date"];
    $camp_running_status_ = $campaign_['running_status']; $camp_running_status = fetchrow("o_campaign_running_statuses", "uid = $camp_running_status_", "name");
    $camp_frequency = $campaign_['frequency']; $frequency = fetchrow("o_campaign_frequencies", "uid = $camp_frequency", "name");
    $camp_repetitive = $campaign_['repetitive']; $repetition_status = fetchrow("o_campaigns_repetition_status", "uid = $camp_repetitive", "name");
    $camp_target_ = $campaign_["target_customers"]; $camp_target_audience = fetchrow("o_campaign_target_customers", "uid = '$camp_target_'", "name");
    $camp_status = $campaign_["status"]; $state = fetchonerow("o_campaign_statuses","code='$camp_status'","color, name");
    $status = "<span class='label ".$state['color']."'>".$state['name']."</span>"
    ?>
                <h1>
                    <?php echo arrow_back('broadcasts','Broadcasts'); ?>
                    BroadCast Details
                    <small><?php echo $camp_name; ?></small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="index"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active"><?php echo $camp_name; ?></li>
                </ol>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs nav-justified font-16">
                                <li class="nav-item nav-100 active"><a href="#tab_1" data-toggle="tab" aria-expanded="false"><i class="fa fa-info"></i> Info</a></li>
                                <li class="nav-item nav-100"><a href="#tab_2" data-toggle="tab" aria-expanded="false"><i class="fa fa-link"></i> Audience</a></li>
                                <li class="nav-item nav-100"><a href="#tab_3" data-toggle="tab" aria-expanded="false"><i class="fa fa-envelope"></i> Campaign Message</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <span class="info-box-icon"><i class="fa fa-info"></i></span>
                                        </div>
                                        <div class="col-md-7">
                                            <table class="table-bordered font-14 table table-hover">
                                                <tr><td class="text-bold">UID</td><td><?php echo $camp_id; ?></td></tr>
                                                <tr><td class="text-bold">Campaign Name</td><td><?php echo $camp_name; ?></td></tr>
                                                <tr><td class="text-bold">Message</td><td><?php echo $camp_message; ?></td></tr>
                                                <tr><td class="text-bold">Added Date</td><td><?php echo $camp_added_date; ?><br><span class="text-orange font-13 font-bold"><?php echo fancydate($camp_added_date); ?></span></td></tr>
                                                <tr><td class="text-bold">Running Date</td><td><?php echo $camp_running_date; ?><br><span class="text-orange font-13 font-bold"><?php echo fancydate($camp_running_date); ?></span></td></tr>
                                                <tr><td class="text-bold">Running Status<td><?php echo $camp_running_status; ?></td></td></tr>
                                                <tr><td class="text-bold">Frequency</td><td><?php echo $frequency; ?></td></tr>
                                                <tr><td class="text-bold">Repetitive</td><td><?php echo $repetition_status; ?></td></tr>
                                                <tr><td class="text-bold">Target Audience</td><td><?php echo $camp_target_audience; ?></td></tr>
                                                <tr><td class="text-bold">Campaign Status</td><td><span class="text-success"><?php echo $status; ?></span></td></tr>

                                            </table>
                                        </div>
                                        <div class="col-md-3">
                                            <table class="table">
                                                <tr><td><a href="?campaign-add-edit" class="btn btn-success btn-block btn-md"><i class="fa fa-plus"></i> New Campaign</a></td></tr>
                                                <?php 
                                                if($camp_status == 1){
                                                    ?>
                                                <tr><td><a href="?campaign-add-edit=<?php echo $camp_id;?>"  class="btn btn-primary btn-block btn-md"><i class="fa fa-edit"></i> Update Campaign </button></td></tr>
                                                
                                                <tr><td><button onclick="disable_campaign('<?php echo $camp_id_;?>', 'disable this campaign')" class="btn btn-warning btn-block btn-md"><i class="fa fa-ban"></i> Stop Campaign</button></td></tr>

                                                <tr><td><button onclick="delete_campaign('<?php echo $camp_id_; ?>', 'delete this campaign')" class="btn btn-danger btn-block btn-md"><i class="fa fa-times"></i> Delete Campaign</button></td></tr>
                                                <?php }
                                                 ?>

                                                 <?php 
                                                 if($camp_status == 2){
                                                    ?>
                                                   <tr><td><button onclick="enable_campaign('<?php echo $camp_id_ ; ?>', 'enable this campaign')" class="btn btn-primary btn-block btn-md"><i class="fa fa-check-square-o"></i>Enable Campaign</button></td></tr>

                                                   <tr><td><button onclick="delete_campaign('<?php echo $camp_id_; ?>', 'delete this campaign')" class="btn btn-danger btn-block btn-md"><i class="fa fa-times"></i> Delete Campaign</button></td></tr> 

                                                 <?php }
                                                 ?>
                                                
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="tab_2">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <?php 
                                            if($camp_status == 2){
                                                ?>
                                                <span class="info-box-icon"><i class="fa fa-exclamation-triangle"></i></span>
                                            <?php }else{?>
                                                <span class="info-box-icon"><i class="fa fa-link"></i></span>
                                             <?php }?>
                                        </div>
                                        <div class="col-md-7">
                            <?php
                            $o_users_ = fetchtable('o_customers',"uid > 0 AND status > 1", "uid", "desc", "0,10");
                            while ($l = mysqli_fetch_array($o_users_)) {
                            $uid = $l['uid'];         $uid_enc = encurl($uid);
                            $full_name = $l['full_name'];
                            $branch = $l['branch'];                    
                            $branch_name = fetchrow('o_branches',"uid='$branch'","name");
                            $status = $l['status'];                    
                            $state = fetchonerow("o_customer_statuses","code='$status'"," color, name");
                            }?>
                                            <div id="inactive_campaign"></div>
                                            <table id="example2" class="table-bordered font-14 table table-hover">
                                                <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Customer</th>
                                                    <th>Branch</th>
                                                    <th>Status</th>
                                                    <th>Action</th>

                                                </tr>
                                                </thead>
                                                <tbody id="audience_list">
                                                    <p style="display:none;"><input id="_camp_id_" type="text" name="" value="<?php echo $camp_id_; ?>"></p>
                                                    
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Customer</th>
                                                    <th>Branch</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <div class="col-md-3">
                                            <table class="table">
                                                <?php 
                                            if($camp_status == 2){?>

                                                <tr><td><a href="?campaign-add-edit" class="btn btn-success btn-block btn-md"><i class="fa fa-plus"></i> New Campaign</a></td></tr>
                                                <tr><td><button onclick="enable_campaign('<?php echo $camp_id_ ; ?>', 'enable this campaign')" class="btn btn-primary btn-block btn-md"><i class="fa fa-check-square-o"></i>Enable Campaign</button></td></tr>

                                                <tr><td><button onclick="delete_campaign('<?php echo $camp_id_; ?>', 'delete this campaign')" class="btn btn-danger btn-block btn-md"><i class="fa fa-times"></i> Delete Campaign</button></td></tr>

                                            <?php }
                                            ?>
                                            </table>
                                            
                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->

                                <div class="tab-pane" id="tab_3">
                                    <div class="box-body">
                                        <div style="margin-top: 20px;" class="row">
                                            <div class="col-sm-2">
                                                <span style="align-content: center;" class="info-box-icon"><i class="fa fa-pencil"></i></span>
                                            </div>
                                            <div class = "col-sm-10">
                                            <form class="form-horizontal" onsubmit="return false"; method="post">
                                                <div class="form-group">
                                                    <label class="control-label col-sm-3">Message</label>
                                                    <div class="col-sm-7">
                                                        <textarea class="form-control" id="message"></textarea>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-sm-3"></div>
                                                <div class="col-sm-7">
                                                <div class="box-footer">
                                                    <br/>
                                                    <button type="submit" class="btn btn-lg btn-default btn-flat">Cancel</button>
                                                    <button type="submit" class="btn btn-primary btn-lg btn-flat pull-right" onclick="save_message();">Save</button>
                                                </div>
                                    </div>
                                            </form>
                                        </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div>
                    </div>
                </div>
            </section>


<?php
            echo "<div style= 'display:none'>".paging_values_hidden('uid > 0', 0, 10, 'uid', 'desc', '', 'audience_list')."</div>";
        ?>