<section class="content-header">
    <?php
    $customer_ = $_GET['customer'];
    $customer_id= decurl($customer_);
    $cust = fetchonerow('o_customers',"uid='$customer_id'");
    $town  = fetchrow('o_towns',"uid='".$cust['town']."'","name");
    $added_by  = fetchrow('o_customers',"uid='". $cust['added_by']."'","full_name");
    $branch  = fetchrow('o_branches',"uid='". $cust['branch']."'","name");
    $product  = fetchrow('o_loan_products',"uid='". $cust['primary_product']."'","name");
    $state  = fetchonerow('o_customer_statuses',"code='". $cust['status']."'","name, color");
    $status = "<span class='label ".$state['color']."'>".$state['name']."</span>";

    $passport_photo = fetchrow('o_documents',"category='1' AND tbl='o_customers' AND rec='$customer' AND status=1","stored_address");
    if(!$passport_photo){
        $profile = "";
    }
    else{
        $profile = "<img src='uploads_/$passport_photo' class='img-bordered' width='100%'>";
    }

    if(isset($_GET['type'])) {
        $view = $_GET['type'];
    }
    else{
        $view = 'Customer';
    }
    ?>
    <h1>
        <?php echo $view; ?> Details
        <small><?php echo $cust['full_name']; ?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="index"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?php echo $cust['full_name']; ?></li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs nav-justified font-16">
                    <li class="nav-item nav-100 active"><a href="#tab_1" data-toggle="tab" aria-expanded="false"><i class="fa fa-info"></i> Bio Info</a></li>
                    <li class="nav-item nav-100"><a href="#tab_2" data-toggle="tab" aria-expanded="false"><i class="fa fa-phone"></i> Contact Info</a></li>
                    <li class="nav-item nav-100"><a href="#tab_3" data-toggle="tab" aria-expanded="false"><i class="fa fa-money"></i> Account Info</a></li>
                    <li class="nav-item nav-100"><a href="#tab_4" data-toggle="tab" aria-expanded="false"><i class="fa fa-users"></i> Referees</a></li>
                    <li class="nav-item nav-100"><a href="#tab_5" data-toggle="tab" aria-expanded="false"><i class="fa fa-tag"></i> Collateral</a></li>
                    <li class="nav-item nav-100"><a href="#tab_7" data-toggle="tab" aria-expanded="false"><i class="fa fa-cloud-upload"></i> Uploads</a></li>
                    <li class="nav-item nav-100"><a href="#tab_6" data-toggle="tab" aria-expanded="false"><i class="fa fa-clock-o"></i> Events</a></li>


                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        <div class="row">
                            <div class="col-md-2">
                                <?php echo $profile; ?>
                            </div>
                            <div class="col-md-7">
                                <h3>Primary Information</h3>
                                <table class="table-bordered font-14 table table-hover">
                                    <tr><td class="text-bold">UID</td><td><?php echo $customer_; ?></td></tr>
                                    <tr><td class="text-bold">Full Name</td><td class="font-18 font-bold"><?php echo $cust['full_name']; ?></td></tr>
                                    <tr><td class="text-bold">Primary Mobile</td><td class="font-18 font-bold"><?php echo $cust['primary_mobile']; ?></td></tr>
                                    <tr><td class="text-bold">Email</td><td><?php echo $cust['email_address']; ?></td></tr>
                                    <tr><td class="text-bold">Physical Address</td><td><?php echo $cust['physical_address']; ?> <br/><?php echo $town; ?></td></tr>
                                    <tr><td class="text-bold">Identification Number</td><td><?php echo $cust['national_id']; ?></td></tr>
                                    <tr><td class="text-bold">Gender</td><td><?php echo $cust['gender']; ?></td></tr>
                                    <tr><td class="text-bold">DOB</td><td><?php echo $cust['dob']; ?></td></tr>
                                    <tr><td class="text-bold">Added By</td><td><?php echo $added_by; ?></td></tr>
                                    <tr><td class="text-bold">Date Added</td><td><?php echo $cust['added_date']; ?></td></tr>
                                    <tr><td class="text-bold">Branch</td><td><?php echo $branch; ?></td></tr>
                                    <tr><td class="text-bold">Product</td><td><?php echo $product; ?></td></tr>
                                    <tr><td class="text-bold">Status</td><td><?php echo $status; ?></td></tr>

                                </table>
                                <h3>Other Information</h3>
                                <table class="table-bordered font-14 table table-hover">
                                    <table class="table table-bordered font-14 table table-hover">
                                        <?php
                                        $o_key_values_ = fetchtable('o_key_values',"tbl='o_customers' AND record='$customer'", "uid", "desc", "0,10", "key_ ,value_ ");
                                        while($v = mysqli_fetch_array($o_key_values_))
                                        {
                                            $key_ = $v['key_'];
                                            $value_ = $v['value_'];
                                            echo "<tr><td class=\"text-bold\">$key_</td><td>$value_</td></tr>";
                                        }
                                        ?>

                                   
                                </table>

                            </div>
                            <div class="col-md-3">
                                <table class="table">
                                    <tr><td><a href="customers?customer-add-edit=<?php echo  $customer_; ?>&bio" class="btn btn-primary btn-block  btn-md grid-width-10"><i class="fa fa-pencil"></i> Update Profile</a></td></tr>
                                    <tr><td><a href="loans?loan-add-edit&customer=<?php echo $customer_ ?>" class="btn btn-success btn-block btn-md"><i class="fa fa-plus"></i> Give a Loan</a></td></tr>
                                    <tr><td><button class="btn btn-warning btn-block btn-md"><i class="fa  fa-file-excel-o"></i> Start a Report</button></td></tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_2">
                        <div class="row">
                            <div class="col-md-2">
                                <span class="info-box-icon"><i class="fa fa-phone"></i></span>
                            </div>
                            <div class="col-md-7">
                                <table class="table-bordered font-14 table table-hover">
                                    <tr><td class="text-bold">Primary Phone</td><td><?php echo $cust['primary_mobile']; ?></td></tr>
                                    <?php
                                    $o_customer_contacts_ = fetchtable('o_customer_contacts',"customer_id='$customer' AND status = 1", "uid", "desc", "0,100", "uid ,contact_type ,value ,status ");
                                    while($y = mysqli_fetch_array($o_customer_contacts_))
                                    {
                                        $uid = $y['uid'];
                                        $contact_type = $y['contact_type'];   $contact_type_name = fetchrow('o_contact_types',"uid='$contact_type'","name");
                                        $value = $y['value'];
                                        $status = $y['status'];
                                        echo "<tr><td class=\"text-bold\">$contact_type_name</td><td>$value</td></tr>";
                                    }
                                    ?>


                                </table>
                            </div>
                            <div class="col-md-3">
                                <table class="table">
                                    <tr><td><a href="customers?customer-add-edit=<?php echo $customer_; ?>&contact" class="btn btn-success btn-block  btn-md"><i class="fa  fa-plus"></i> Add/Edit Contact</a></td></tr>
                                    <tr style="display: none;"><td><button class="btn btn-primary btn-block btn-md"><i class="fa  fa-pencil"></i> Edit Contact</button></td></tr>
                                    <tr style="display: none;"><td><button class="btn btn-danger btn-block btn-md"><i class="fa  fa-times"></i> Remove Contact</button></td></tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_3">
                        <div class="row">
                            <div class="col-md-2">
                                <span class="info-box-icon"><i class="fa fa-money"></i></span>
                            </div>
                            <div class="col-md-7">
                                <table class="table-bordered font-12 table table-hover">
                                    <tr><td class="text-bold">Current Loan</td><td><a class="badge bg-gray-light font-16 text-blue">J15362 <i class="fa text-green fa-level-up"></i></a></td></tr>
                                    <tr><td class="text-bold">Total Loans</td><td><a class="badge bg-gray-light font-16 text-blue">5 <i class="fa text-green fa-level-up"></i></a></td></tr>
                                    <tr><td class="text-bold">Credit Worthiness</td><td><span class="badge bg-gray-light font-16 text-black">Ksh. 500,000</span></td></tr>
                                    <tr><td class="text-bold">Bank Info</td><td><a class="badge bg-gray-light font-16 text-blue">3 Accounts <i class="fa text-green fa-level-up"></i></a></td></tr>
                                    <tr><td class="text-bold">Debit Info</td><td> <a class="badge bg-gray-light font-16 text-blue">View <i class="fa text-green fa-level-up"></i></a></td></tr>
                                    <tr><td class="text-bold">Credit Info</td><td><a class="badge bg-gray-light font-16 text-blue">View <i class="fa text-green fa-level-up"></i></a></td></tr>


                                </table>
                            </div>
                            <div class="col-md-3">
                                <table class="table">
                                    <tr><td><button class="btn btn-success btn-block  btn-md"><i class="fa  fa-plus"></i> Give Loan</button></td></tr>
                                    <tr><td><button class="btn btn-primary btn-block btn-md"><i class="fa  fa-pencil"></i> Edit Account</button></td></tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_4">
                        <div class="row">
                            <div class="col-md-2">
                                <span class="info-box-icon"><i class="fa fa-users"></i></span>
                            </div>
                            <div class="col-md-7">
                                <table class="table-bordered font-14 table table-hover">
                                    <thead>
                                    <tr><th>Name</th><th>ID No.</th><th>Mobile No.</th><th>Email</th><th>Physical Address</th><th>Relationship</th></tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $o_customer_referees_ = fetchtable('o_customer_referees',"status=1 AND customer_id='$customer'", "uid", "desc", "0,10", "uid ,referee_name ,id_no ,mobile_no ,physical_address ,email_address ,relationship ,status ");
                                    while($y = mysqli_fetch_array($o_customer_referees_))
                                    {
                                        $uid = $y['uid'];
                                        $referee_name = $y['referee_name'];
                                        $id_no = $y['id_no'];
                                        $mobile_no = $y['mobile_no'];
                                        $physical_address = $y['physical_address'];
                                        $email_address = $y['email_address'];
                                        $relationship = $y['relationship'];   $relationship_name  = fetchrow("o_referee_relationships","uid='$relationship'","name");
                                        $status = $y['status'];
                                        echo "  <tr><td>$referee_name</td><td>$id_no</td><td>$mobile_no</td><td>$email_address</td><td>$physical_address</td><td>$relationship_name</td> </tr>";
                                    }
                                    ?>




                                    </tbody>


                                </table>
                            </div>
                            <div class="col-md-3">
                                <table class="table">
                                    <tr><td><a href="customers?customer-add-edit=<?php echo $customer_; ?>&referees" class="btn btn-success btn-block btn-md"><i class="fa fa-plus"></i> Add/Edit Referee</a></td></tr>
                                    <tr style="display: none;"><td><button class="btn btn-primary btn-block  btn-md grid-width-10"><i class="fa fa-pencil"></i> Update Referee</button></td></tr>
                                    <tr style="display: none"><td><button class="btn btn-danger btn-block btn-md"><i class="fa fa-times"></i> Remove Referee</button></td></tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_5">
                        <div class="row">
                            <div class="col-md-2">
                                <span class="info-box-icon"><i class="fa fa-tag"></i></span>
                            </div>
                            <div class="col-md-8">
                                <table class="table-bordered font-14 table table-hover">
                                    <thead><tr><th>Category</th><th>Title</th><th>Description</th><th>Current Worth</th><th>Ref Number</th><th>File Number</th><th>Added Date</th><th>Status</th></tr></thead>
                                    <tbody>
                                    <?php
                                    $o_collateral_ = fetchtable('o_collateral',"status=1 AND customer_id='$customer'", "uid", "desc", "0,10", "uid ,category ,title ,description ,money_value ,document_scan_address ,doc_reference_no ,filling_reference_no ,added_date ,added_by ,status ");
                                    while($i = mysqli_fetch_array($o_collateral_))
                                    {
                                        $uid = $i['uid'];
                                        $category = $i['category'];   $category_name = fetchrow('o_asset_categories',"uid='$category'","name");
                                        $title = $i['title'];
                                        $description = $i['description'];
                                        $money_value = $i['money_value'];
                                        $document_scan_address = $i['document_scan_address'];
                                        $doc_reference_no = $i['doc_reference_no'];
                                        $filling_reference_no = $i['filling_reference_no'];
                                        $added_date = $i['added_date'];
                                        $added_by = $i['added_by'];
                                        $status = $i['status'];

                                        $a = fetchonerow("o_collateral_statuses","code = '$status'","uid, code, name, status");
                                            $uid = $a['uid'];
                                             $code = $a['code'];
                                             $name = $a['name'];


                                        echo "<tr><td>$category_name</td><td>$title</td><td>$description</td><td>$money_value</td><td>$doc_reference_no</td><td>$filling_reference_no</td><td>$added_date</td><td>$name</td></tr>";
                                    }


                                    ?>

                                    </tbody>


                                </table>
                            </div>
                            <div class="col-md-2">
                                <table class="table">
                                    <tr><td><a href="customers?customer-add-edit=<?php echo $customer_; ?>&collateral" class="btn btn-success btn-block btn-md"><i class="fa fa-plus"></i> Add/Edit Collateral</a></td></tr>
                                    <tr style="display: none;"><td><button class="btn btn-primary btn-block  btn-md grid-width-10"><i class="fa fa-pencil"></i> Update Collateral</button></td></tr>
                                    <tr style="display: none;"><td><button class="btn btn-danger btn-block btn-md"><i class="fa fa-times"></i> Remove Collateral</button></td></tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_6">
                        <div class="row">
                            <div class="col-md-2">
                                <span class="info-box-icon"><i class="fa fa-clock-o"></i></span>
                            </div>
                            <div class="col-md-10">
                                <table class="table-bordered font-14 table table-hover">
                                    <thead><tr><th>Event</th><th>Date</th></tr></thead>
                                    <tbody>
                                <?php
                                $o_events_ = fetchtable('o_events',"tbl='o_customers' AND fld='$customer'", "uid", "asc", "0,10", "uid ,event_details ,event_date ,event_by ,status ");
                                while($d = mysqli_fetch_array($o_events_))
                                {
                                    $uid = $d['uid'];
                                    $event_details = $d['event_details'];
                                    $event_date = $d['event_date'];
                                    $event_by = $d['event_by'];
                                    $status = $d['status'];

                                    echo " <tr><td>$event_details</td><td>$event_date</td> </tr>";
                                }
                                ?>

                                    </tbody>


                                </table>
                            </div>

                        </div>
                    </div>
                    <div class="tab-pane" id="tab_7">
                        <div class="row">
                            <div class="col-md-2">
                                <span class="info-box-icon"><i class="fa fa-cloud-upload"></i></span>
                            </div>
                            <div class="col-md-8">
                                <div class="row">

                                <?php
                                $o_documents_ = fetchtable('o_documents',"tbl='o_customers' AND rec='$customer' AND status=1", "uid", "desc", "0,10", "uid ,code_name ,title ,description ,category ,stored_address ");
                                while($q = mysqli_fetch_array($o_documents_))
                                {
                                    $uid = $q['uid'];
                                    $code_name = $q['code_name'];
                                    $title = $q['title'];
                                    $description = $q['description'];
                                    $category = $q['category'];
                                    $stored_address = $q['stored_address'];

                                    echo "<a target='_blank' class='pointer' onclick=\"view_file('".encurl($uid)."','VIEW');\"><div class=\"box box-solid col-sm-5\" style=\"width: 30%; margin: 1em;\">
                                     <img class='img-bordered' src=\"uploads_/$stored_address\" width='100%'>
                                    <div class=\"box-body\">
                                   
                                        <h5 class=\"box-title\">$title</h5>
                                       
                                        
                                    </div>
                                </div></a>";
                                }
                                ?>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <table class="table">
                                    <tr><td><a href="customers?customer-add-edit=<?php echo $customer_; ?>&uploads" class="btn btn-success btn-block btn-md"><i class="fa fa-plus"></i> Upload File</a></td></tr>
                                    <tr style="display: none;"><td><button class="btn btn-primary btn-block  btn-md grid-width-10"><i class="fa fa-pencil"></i> Update File</button></td></tr>
                                    <tr style="display: none;"><td><button class="btn btn-danger btn-block btn-md"><i class="fa fa-times"></i> Delete File</button></td></tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.tab-content -->
            </div>
        </div>
    </div>
</section>