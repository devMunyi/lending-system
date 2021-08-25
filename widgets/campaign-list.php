<?php
$curdate = $date;
/*
$all_date = fetchonerow("o_campaign", "uid > 0 AND status > 0");

$all_date_camp = new array();
$past_date_camp = new array();
*/
?>

<section class="content-header">
                <h1>
                    Broadcasts
                    <small>List</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="index"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Broadcasts</li>
                </ol>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">

                        <!-- /.box -->

                        <div class="box">
                            <div class="box-header bg-info">
                                <div class="row">
                                    <div class="col-md-10">
                                        <h3 class="box-title font-16">
                                            <a class="btn font-16 btn-md bg-navy btn-default text-bold" href="#" onclick="all_campaigns('sort_1')"><i class="fa fa-clone"></i> All Campaigns</a>
                                            <a class="btn font-16 btn-md btn-default text-bold" href="#"onclick="past_campaigns('sort_2')"><i class="fa fa-arrow-left"></i> Past</a>
                                            <a class="btn font-16 btn-md  btn-default text-bold" href="#" onclick='running_campaigns("default_sort")'><i class="fa fa-arrow-down"></i>Current</a>
                                            <a class="btn font-16 btn-md btn-default text-bold" href="#" onclick="future_campaigns('sort_3')"><i class="fa fa-arrow-right"></i> Upcoming</a>
                                            <a class="btn font-16 btn-md btn-default text-bold" href="#"
                                            onclick="repetitive_campaigns('sort_4')"><i class="fa fa-recycle"></i> Repetitive</a>
                                        </h3>
                                    </div>
                                    <div class="col-md-2">

                                        <a class="btn btn-success float-right" href='?campaign-add-edit'><i class="fa fa-plus"></i>ADD NEW</a>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Campaign Name</th>
                                        <th>Running Date</th>
                                        <th>Running Status</th>
                                        <th>Frequency</th>
                                        <th>Repetitive</th>
                                        <th>Target Audience</th>
                                        <th>Campaign Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody id="campaign_list">

                                    
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Campaign Name</th>
                                        <th>Running Date</th>
                                        <th>Running Status</th>
                                        <th>Frequency</th>
                                        <th>Repetitive</th>
                                        <th>Target Audience</th>
                                        <th>Campaign Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.col -->
                </div>
            </section>

            <?php
            echo "<div style= 'display:none'>".paging_values_hidden2("uid > 0", 0, 10, 'running_date', 'desc', '','campaign_list', 'default_sort').'</div>';
        ?>