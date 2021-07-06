<?php
$sid = decurl($_GET['staff']);
$p = fetchonerow("o_users","uid='$sid'","*");
?>
<section class="content-header">
    <h1>
        Staff Details
        <small><?php echo $p['name']; ?> </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="index"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Staff</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs nav-justified font-16">
                    <li class="nav-item nav-100 active"><a href="#tab_1" data-toggle="tab" aria-expanded="false"><i class="fa fa-info"></i> Info</a></li>
                    <li class="nav-item nav-100"><a href="#tab_2" data-toggle="tab" aria-expanded="false"><i class="fa fa-lock"></i> Permissions</a></li>



                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        <div class="row">
                            <div class="col-md-2">
                                <span class="info-box-icon"><i class="fa fa-info"></i></span>
                            </div>
                            <div class="col-md-7">
                                <table class="table-bordered font-14 table table-hover">
                                    <?php

                                    $uid = $p['uid'];
                                    $name = $p['name'];
                                    $email = $p['email'];
                                    $phone = $p['phone'];
                                    $join_date = $p['join_date'];
                                    $pass1 = $p['pass1'];
                                    $user_group = $p['user_group'];
                                    $branch = $p['branch'];
                                    $status = $p['status'];

                                    if($branch > 0) {
                                        $br = fetchonerow("o_branches", "uid='$branch'", "uid, name");
                                        $branch_name = $br['name'];
                                    }
                                    else{
                                        $branch_name = "<i>No Branch</i>";
                                    }

                                    $user_group_name = fetchrow('o_user_groups',"uid='$user_group'","name");

                                    $f = fetchonerow("o_staff_statuses","uid='$status'","name");
                                    $status_name = $f['name'];
                                    ?>
                                    <tr><td class="text-bold">UID</td><td><?php echo $uid; ?></td></tr>
                                    <tr><td class="text-bold">Name</td><td><?php echo $name; ?></td></tr>
                                    <tr><td class="text-bold">Phone</td><td><?php echo $phone; ?></td></tr>
                                    <tr><td class="text-bold">Email</td><td><?php echo $email; ?></td></tr>
                                    <tr><td class="text-bold">Group</td><td><?php echo $user_group_name; ?> </td></tr>
                                    <tr><td class="text-bold">Branch</td><td><?php echo $branch_name; ?></td></tr>
                                    <tr><td class="text-bold">Join Date</td><td><?php echo $join_date; ?></td></tr>
                                    <tr><td class="text-bold">Status</td><td> <?php echo $status_name; ?> </td></tr>

                                </table>
                            </div>
                            <div class="col-md-3">
                                <table class="table">
                                    <tr><td><a href="staff?add-edit=<?php echo encurl($sid); ?>" class="btn btn-warning btn-block btn-md"><i class="fa fa-edit"></i> Edit Staff</a></td></tr>
                                    <tr><td><a href="staff?add-edit" class="btn btn-success btn-block btn-md"><i class="fa fa-plus"></i> New Staff</a></td></tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_2">
                        <div class="row">
                            <div class="col-md-2">
                                <span class="info-box-icon"><i class="fa fa-link"></i></span>
                            </div>
                            <div class="col-md-8">
                                <h3>Group Permissions</h3>
                                <table class="table-bordered font-14 table table-hover">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Permission Name</th>
                                        <th>Create</th>
                                        <th>Read</th>
                                        <th>Update</th>
                                        <th>Delete</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td><span>Staff </span><br/></td>
                                        <td><span class="fa fa-check text-success"></span></td>
                                        <td><span class="fa fa-check text-success"></span></td>
                                        <td><span class="fa fa-check text-success"></span></td>
                                        <td><span class="fa fa-times text-danger"></span></td>

                                    </tr>


                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Permission Name</th>
                                        <th>Create</th>
                                        <th>Read</th>
                                        <th>Update</th>
                                        <th>Delete</th>

                                    </tr>
                                    </tfoot>
                                </table>

                                <h3>Individual Permissions</h3>
                                <table class="table-bordered font-14 table table-hover">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Permission Name</th>
                                        <th>Create</th>
                                        <th>Read</th>
                                        <th>Update</th>
                                        <th>Delete</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td><span>Staff </span><br/></td>
                                        <td><span class="fa fa-check text-success"></span></td>
                                        <td><span class="fa fa-check text-success"></span></td>
                                        <td><span class="fa fa-check text-success"></span></td>
                                        <td><span class="fa fa-times text-danger"></span></td>

                                    </tr>


                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Permission Name</th>
                                        <th>Create</th>
                                        <th>Read</th>
                                        <th>Update</th>
                                        <th>Delete</th>

                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="col-md-2">
                                <table class="table">
                                    <tr><td><button class="btn btn-success btn-block  btn-md"><i class="fa  fa-plus"></i> Add Interaction</button></td></tr>

                                </table>
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