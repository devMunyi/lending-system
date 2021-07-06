<section class="content-header">
    <h1>
        Loan Products
        <small>List</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="index"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Loan Products</li>
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
                            <h3 class="box-title">

                                <a class="btn font-18 text-black font-bold" href=""> All Products</a>


                            </h3>
                        </div>
                        <div class="col-md-2">

                            <a href="?add-edit" class="btn btn-success float-right"><i class="fa fa-plus"></i> NEW PRODUCT</a>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>

                            <th>Name</th>
                            <th>Description</th>
                            <th>Period</th>
                            <th>Min</th>
                            <th>Max</th>
                            <th>Payment Frequency</th>
                            <th>Payment BreakDown</th>
                            <th>Status</th>
                            <th>Action</th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $o_loan_products_ = fetchtable('o_loan_products',"uid>0", "uid", "desc", "0,10", "uid ,name ,description ,period ,period_units ,min_amount ,max_amount ,pay_frequency ,percent_breakdown ,added_date ,status ");
                        while($u = mysqli_fetch_array($o_loan_products_))
                        {
                            $uid = $u['uid'];
                            $name = $u['name'];
                            $description = $u['description'];
                            $period = $u['period'];
                            $period_units = $u['period_units'];
                            $min_amount = $u['min_amount'];
                            $max_amount = $u['max_amount'];
                            $pay_frequency = $u['pay_frequency'];
                            $percent_breakdown = $u['percent_breakdown'];
                            $added_date = $u['added_date'];
                            $status = status($u['status']);

                            echo " <tr><td><span><span class=\"text-bold font-24 font-bold\">$name</span></span></td>
                            <td><span>$description</span></td>
                            <td><span>$period $period_units</span></td>
                   
                            <td><span>$min_amount</span></td>
                            <td><span>$max_amount</span></td>
                            <td><span>$pay_frequency</span></td>
                            <td><span>$percent_breakdown</span></td>
                            <td><span>$status</span></td>
                            <td><span><a href=\"loan-products?product=".encurl($uid)."\"><i class=\"fa fa-eye\"></i></a></span></td>
                        </tr>";
                        }
                        ?>



                        </tbody>
                        <tfoot>
                        <tr>

                            <th>Name</th>
                            <th>Description</th>
                            <th>Period</th>
                            <th>Min</th>
                            <th>Max</th>
                            <th>Payment Frequency</th>
                            <th>Payment BreakDown</th>
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