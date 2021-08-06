<section class="content-header">
    <h1>
        Staff
        <small>List</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="index"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Staff</li>
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
                                <select class="btn font-16 btn-md btn-default text-bold top-select" id="group_" onchange="staff_filters()">
                                            <option value="0">All Users</option>
                                            <?php

                                            $recs = fetchtable('o_user_groups',"uid>0", "uid", "asc", "100", "uid ,name");
                                            while($r = mysqli_fetch_array($recs))
                                            {
                                                $uid = $r['uid'];
                                                $name = $r['name'];
                                                echo "<option value=\"$uid\">$name</option>";
                                            }
                                            ?>
                                        </select>
                                <select class="btn font-16 btn-md btn-default text-bold top-select" id="staff_order" onchange="staff_filters()">
                                    <option value="desc">Newest First</option>
                                    <option value="asc">Oldest First</option>
                                </select>

                                <select class="btn font-16 btn-md btn-default text-bold top-select" id="sel_branch" onchange="staff_filters()">
                                    <option value="0">All Branches</option>
                                    <?php
                                    $o_branches_ = fetchtable('o_branches',"status > 0", "name", "asc", "0,100", "uid ,name ");
                                    while($w = mysqli_fetch_array($o_branches_))
                                    {
                                        $uid = $w['uid'];
                                        $name = $w['name'];
                                        echo "<option value='$uid'>$name</option>";
                                    }
                                    ?>
                                </select>
                            </h3>
                        </div>
                        <div class="col-md-2">

                            <a href="staff?add-edit" class="btn btn-success float-right"><i class="fa fa-plus"></i> NEW STAFF</a>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">

                    <table id="example1" class="display table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Staff Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Group</th>
                            <th>Branch</th>
                            <th>Added Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody id="staff_list">



                        </tbody>
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Staff Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Group</th>
                            <th>Branch</th>
                            <th>Added Date</th>
                            <th>Status</th>
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
echo "<div style='display: none;'>".paging_values_hidden('uid > 0',0,10,'uid','desc','','staff_list')."</div>"
?>