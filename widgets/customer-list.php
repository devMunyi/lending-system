<section class="content-header">
    <h1>
        <?php
        if(isset($_GET['type'])) {
            $view = $_GET['type'];
        }
        else{
            $view = 'Customer';
        }
        echo $view; ?>
        <small>List</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="index"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?php echo $view; ?></li>
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
                                <select class="btn font-16 btn-md btn-default text-bold top-select" id="customer_order" onchange="customer_filters()">
                                    <option value="desc">Newest First</option>
                                    <option value="asc">Oldest First</option>
                                </select>


                                <select class="btn font-16 btn-md btn-default text-bold top-select" id="sel_branch" onchange="customer_filters()">
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

                            <a class="btn btn-success float-right" href="?customer-add-edit"><i class="fa fa-plus"></i> ADD NEW</a>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-condensed table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Passport</th>
                            <th>Customer Name</th>
                            <th>Phone</th>
                            <th>Branch</th>
                            <th>Latest Loan</th>
                            <th>Address</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody id="customer_list">


                        </tbody>
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Passport</th>
                            <th>Customer Name</th>
                            <th>Phone</th>
                            <th>Branch</th>
                            <th>Latest Loan</th>
                            <th>Address</th>
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
echo "<div style='display: none ;'>".paging_values_hidden('uid > 0',0,10,'uid','desc','', 'customer_list', 1)."</div>"
?>