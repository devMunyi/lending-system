/////---------------------Other
function modal_view(resource, params, title = "Details") {
    $('#mainModal').modal('toggle');
    let server_ = $('#server_').val();
    let fields = params;
    $.ajax({
        method: 'POST',
        url: server_ + resource,
        data: fields,
        beforeSend: function () {
            $("#processing").show();
        },

        complete: function () {
            $("#processing").hide();
        },
        success: function (feedback) {
            $('#mainModal').html("<div class=\"modal-dialog\">\n" +
                "\n" +
                "    <!-- Modal content-->\n" +
                "    <div class=\"modal-content\">\n" +
                "        <div class=\"modal-header\">\n" +
                "            <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>\n" +
                "            <h3 class=\"modal-title\">" + title + "</h3>\n" +
                "        </div>\n" +
                "        <div class=\"modal-body\">\n" + feedback + "</div>\n" +
                "        <div class=\"modal-footer\">\n" +
                "            <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Close</button>\n" +
                "        </div>\n" +
                "    </div>\n" +
                "\n" +
                "</div>");
        },
        error: function (err) {
            $('#mainModal').html(err);
        }


    });


}

function modal_hide() {
    $('#mainModal').modal('toggle');
}

function clear_form(formid) {
    document.getElementById(formid).reset();
}


//////////--------------Notifications
function notifications_count() {
    let params = "";
    dbaction("/action/notifications_count", params, function (feed) {
        if ((parseInt(feed)) > 0) {
            $('#notif_count').html(feed).fadeIn('fast');
        } else {
            $('#notif_count').html("").css('display', 'none');
        }
    });

}

function notifications_count_reset() {
    let params = "";
    $('#notif_count').fadeOut('fast');
    dbaction("/action/notifications_count_reset", params, function (feed) {
    });

}

function message_list() {

    $('#message_drop').html("<li class=\"header\">You have 4 messages</li>\n" +
        "                        <li>\n" +
        "                            <!-- inner menu: contains the actual data -->\n" +
        "                            <ul class=\"menu\">\n" +
        "                                <li><!-- start message -->\n" +
        "                                    <a href=\"#\">\n" +
        "                                        <div class=\"pull-left\">\n" +
        "                                            <img src=\"dist/img/user2-160x160.jpg\" class=\"img-circle\" alt=\"User Image\">\n" +
        "                                        </div>\n" +
        "                                        <h4>\n" +
        "                                            Support Team\n" +
        "                                            <small><i class=\"fa fa-clock-o\"></i> 5 mins</small>\n" +
        "                                        </h4>\n" +
        "                                        <p>Why not buy a new awesome theme?</p>\n" +
        "                                    </a>\n" +
        "                                </li>\n" +
        "                                <!-- end message -->\n" +
        "                                <li>\n" +
        "                                    <a href=\"#\">\n" +
        "                                        <div class=\"pull-left\">\n" +
        "                                            <img src=\"dist/img/user3-128x128.jpg\" class=\"img-circle\" alt=\"User Image\">\n" +
        "                                        </div>\n" +
        "                                        <h4>\n" +
        "                                            OnePay Design Team\n" +
        "                                            <small><i class=\"fa fa-clock-o\"></i> 2 hours</small>\n" +
        "                                        </h4>\n" +
        "                                        <p>Why not buy a new awesome theme?</p>\n" +
        "                                    </a>\n" +
        "                                </li>\n" +
        "                                <li>\n" +
        "                                    <a href=\"#\">\n" +
        "                                        <div class=\"pull-left\">\n" +
        "                                            <img src=\"dist/img/user4-128x128.jpg\" class=\"img-circle\" alt=\"User Image\">\n" +
        "                                        </div>\n" +
        "                                        <h4>\n" +
        "                                            Developers\n" +
        "                                            <small><i class=\"fa fa-clock-o\"></i> Today</small>\n" +
        "                                        </h4>\n" +
        "                                        <p>Why not buy a new awesome theme?</p>\n" +
        "                                    </a>\n" +
        "                                </li>\n" +
        "                                <li>\n" +
        "                                    <a href=\"#\">\n" +
        "                                        <div class=\"pull-left\">\n" +
        "                                            <img src=\"dist/img/user3-128x128.jpg\" class=\"img-circle\" alt=\"User Image\">\n" +
        "                                        </div>\n" +
        "                                        <h4>\n" +
        "                                            Sales Department\n" +
        "                                            <small><i class=\"fa fa-clock-o\"></i> Yesterday</small>\n" +
        "                                        </h4>\n" +
        "                                        <p>Why not buy a new awesome theme?</p>\n" +
        "                                    </a>\n" +
        "                                </li>\n" +
        "                                <li>\n" +
        "                                    <a href=\"#\">\n" +
        "                                        <div class=\"pull-left\">\n" +
        "                                            <img src=\"dist/img/user4-128x128.jpg\" class=\"img-circle\" alt=\"User Image\">\n" +
        "                                        </div>\n" +
        "                                        <h4>\n" +
        "                                            Reviewers\n" +
        "                                            <small><i class=\"fa fa-clock-o\"></i> 2 days</small>\n" +
        "                                        </h4>\n" +
        "                                        <p>Why not buy a new awesome theme?</p>\n" +
        "                                    </a>\n" +
        "                                </li>\n" +
        "                            </ul>\n" +
        "                        </li>\n" +
        "                        <li class=\"footer\"><a href=\"#\">See All Messages</a></li>");
}

function notif_list(target, offset, rpp) {
    let where = $('#_where_').val();
    if (!where) {
        where = "uid > 0";
    }
    let orderby = $('#_orderby_').val();
    if (!orderby) {
        orderby = 'uid';
    }
    let dir = $('#_dir_').val();
    if (!dir) {
        dir = 'desc'
    }
    let search = $('#search_').val();
    if (!search) {
        search = "";
    }
    let params = "where_=" + where + "&offset=" + offset + "&rpp=" + rpp + "&orderby=" + orderby + "&dir=" + dir + "&search_=" + search;
    dbaction("/jresources/notifications_list", params, function (feed) {
        console.log(params);
        notifications_count_reset();

        $(target).html(feed + "<li class=\"footer\"><a href=\"profile?notifications\">View all</a></li>");
        setTimeout(function () {
            pager_refactor();
        }, 200);

    });

}

/////////--------------End of notifications
/////---------------------

/////////---------------Staff Update
function staff_save() {
    let sid = parseInt($('#sid').val());
    let name = $('#full_name').val();
    let email = $('#email_').val();
    let phone = $('#phone_number').val();
    let national_id = $('#national_id').val();
    let password = $('#passwo').val();
    let user_group = $('#group_').val();
    let branch = $('#branch_').val();
    let status = $('#status_').val();

    let endpoint = "staff_save";
    if (sid > 0) {
        endpoint = "update";
    }

    let params = "name=" + name + "&email=" + email + "&phone=" + phone + "&user_group=" + user_group + "&branch=" + branch + "&status=" + status + "&sid=" + sid + "&national_id=" + national_id + "&password=" + password;
    dbaction("/action/staff/" + endpoint, params, function (feed) {
        console.log(feed);
        feedback("DEFAULT", "TOAST", ".feedback_", feed, "4");
    })
}

function staff_list() {
    let where = $('#_where_').val();
    if (!where) {
        where = "uid > 0";
    }
    let offset = $('#_offset_').val();
    if (!offset) {
        offset = 0;
    }
    let rpp = $('#_rpp_').val();
    if (!rpp) {
        rpp = 10;
    }
    let orderby = $('#_orderby_').val();
    if (!orderby) {
        orderby = 'uid';
    }
    let dir = $('#_dir_').val();
    if (!dir) {
        dir = 'desc'
    }
    let search = $('#search_').val();
    if (!search) {
        search = "";
    }


    let params = "where_=" + where + "&offset=" + offset + "&rpp=" + rpp + "&orderby=" + orderby + "&dir=" + dir + "&search_=" + search;
    dbaction("/jresources/staff_list", params, function (feed) {
        console.log(params);
        $('#staff_list').html(feed);
        setTimeout(function () {
            pager_refactor();
        }, 200);

    })
}

function update_password() {
    let old_pass = $('#old_password').val();
    let new_password = $('#new_password').val();

    let params = "old_pass=" + old_pass + "&new_pass=" + new_password;
    dbaction("/action/password_change", params, function (feed) {
        console.log(JSON.stringify(feed));
        feedback("DEFAULT", "TOAST", ".feedback_", feed, "3");
    })

}

/////////==============End of staff update

/////////--------------Customers
function customer_save() {
    let uid = parseInt($('#cid').val());
    let url = 'customer_save';
    if (uid > 0) {
        url = 'customer_update';
    } else {
        url = 'customer_save';
    }
    let full_name = $('#full_name').val();
    let primary_mobile = $('#phone_number').val();
    let email_address = $('#email_').val();
    let physical_address = $('#main_address').val();
    let town = $('#town_').val();
    let national_id = $('#national_id').val();
    let gender = $('input[name="gender"]:checked').val();
    let dob = $('#dob').val();
    let branch = $('#branch_').val();
    let primary_product = $('#primary_product').val();
    let loan_limit = $('#loan_limit').val();
    let status = $('#status_').val();
    let params = "cid=" + uid + "&full_name=" + full_name + "&primary_mobile=" + primary_mobile + "&email_address=" + email_address + "&physical_address=" + physical_address + "&town=" + town + "&national_id=" + national_id + "&gender=" + gender + "&dob=" + dob + "&branch=" + branch + "&primary_product=" + primary_product + "&loan_limit=" + loan_limit + "&status=" + status;
    dbaction("/action/" + url, params, function (feed) {
        console.log(JSON.stringify(feed));
        feedback("DEFAULT", "TOAST", ".feedback_", feed, "4");
    });
}

function customer_save_additional_contact(cid, contact_id) {
    let url = "customer_save_contact";
    if ((parseInt(contact_id)) > 0) {
        url = "customer_update_contact";
    } else {
        url = "customer_save_contact";
    }

    let customer_id = cid;
    let contact_type = $('#contact_type').val();
    let value = $('#contact_value').val();
    let params = "customer_id=" + customer_id + "&contact_type=" + contact_type + "&value=" + value + "&contact_id=" + contact_id;
    dbaction("/action/" + url, params, function (feed) {
        console.log(JSON.stringify(feed));
        feedback("DEFAULT", "TOAST", ".feedback_", feed, "4");
    })
}

function customer_add_referee(cid) {
    let customer_id = cid;
    let refId = $('#ref_id').val();
    let referee_name = $('#full_name').val();
    let id_no = $('#national_id').val();
    let mobile_no = $('#phone_number').val();
    let physical_address = $('#main_address').val();
    let email_address = $('#email_').val();
    let relationship = $('#relationship').val();

    let action = 'save_new';
    if ((parseInt(refId)) > 0) {
        action = "update";
    }

    let params = "customer_id=" + customer_id + "&referee_name=" + referee_name + "&id_no=" + id_no + "&mobile_no=" + mobile_no + "&physical_address=" + physical_address + "&email_address=" + email_address + "&relationship=" + relationship + "&ref_id=" + refId;
    dbaction("/action/referees/" + action, params, function (feed) {
        console.log(JSON.stringify(feed));
        feedback("DEFAULT", "TOAST", ".feedback_", feed, "4");
    })

}

function customer_add_collateral(cid) {

    let endpoint = "save_new";
    let col_id = $('#col_id').val();
    if ((parseInt(col_id)) > 0) {
        endpoint = "update";
    } else {

    }

    let customer_id = cid;
    let category = $('#category').val();
    let title = $('#title').val();
    let description = $('#description').val();
    let money_value = $('#money_value').val();
    let doc_reference_no = $('#reference_number').val();
    let filling_reference_no = $('#physical_file_number').val();
    let digital_file_number = $('#digital_file_number').val();
    let params = "&customer_id=" + customer_id + "&category=" + category + "&title=" + title + "&description=" + description + "&money_value=" + money_value + "&doc_reference_no=" + doc_reference_no + "&filling_reference_no=" + filling_reference_no + "&money_value=" + money_value + "&col_id=" + col_id + "&digital_file_number=" + digital_file_number;
    dbaction("/action/collateral/" + endpoint, params, function (feed) {
        console.log(JSON.stringify(feed));
        feedback("DEFAULT", "TOAST", ".feedback_", feed, "4");
    })
}

function customer_list() {
    let where = $('#_where_').val();
    if (!where) {
        where = "uid > 0";
    }
    let offset = $('#_offset_').val();
    if (!offset) {
        offset = 0;
    }
    let rpp = $('#_rpp_').val();
    if (!rpp) {
        rpp = 10;
    }
    let orderby = $('#_orderby_').val();
    if (!orderby) {
        orderby = 'uid';
    }
    let dir = $('#_dir_').val();
    if (!dir) {
        dir = 'desc'
    }
    let search = $('#search_').val();
    if (!search) {
        search = "";
    }


    let params = "where_=" + where + "&offset=" + offset + "&rpp=" + rpp + "&orderby=" + orderby + "&dir=" + dir + "&search_=" + search;
    dbaction("/jresources/customer_list", params, function (feed) {
        console.log(params);
        $('#customer_list').html(feed);
        setTimeout(function () {
            pager_refactor();
        }, 500);

    })
}

function contact_list(customer, action) {

    let params = "customer=" + customer + "&action=" + action;
    dbaction("/jresources/contact_list", params, function (feed) {
        console.log(JSON.stringify(feed));
        $('#contacts_').html(feed)
    })
}

function delete_contact(contact_id) {
    var result = confirm('Are you sure you want to delete this contact?');
    if (result) {
        var params = "contact_id=" + contact_id;
        dbaction('/action/contact_delete', params, function (feed) {
            feedback("DEFAULT", "TOAST", ".feedback_", feed, "4");
        });
    }
}

function referee_list(customer, action) {

    let params = "customer=" + customer + "&action=" + action;
    dbaction("/jresources/referees/referee_list", params, function (feed) {
        console.log(JSON.stringify(feed));
        $('#referees_').html(feed)
    })
}

function collateral_list(customer, action) {

    let params = "customer=" + customer + "&action=" + action;
    dbaction("/jresources/collateral/list", params, function (feed) {
        console.log(JSON.stringify(feed));
        $('#collateral_').html(feed);
    })
}

function loan_collateral_list(loan_id) {

    let params = "loan_id=" + loan_id;
    load_std('/jresources/loans/loan_collateral', '#collateral_', params);
}

function loan_collateral_action(loan_id, collateral_id, action) {

    let params = "loan_id=" + loan_id + "&collateral_id=" + collateral_id + "&action=" + action;
    dbaction("/action/loan/collateral", params, function (feed) {
        feedback("DEFAULT", "TOAST", ".feedback_", feed, "3");
    });

}

function upload_list(customer, action) {

    let params = "customer=" + customer + "&action=" + action;
    dbaction("/jresources/files/list", params, function (feed) {
        console.log(JSON.stringify(feed));
        $('#uploads_').html(feed);
    })
}

function delete_file(fileId) {
    var result = confirm('Are you sure you want to delete this file?');
    if (result) {
        var params = "file_id=" + fileId;
        dbaction('/action/files/delete', params, function (feed) {
            feedback("DEFAULT", "TOAST", ".feedback_", feed, "4");
        });
    }
}


function view_file(file_id, mode) {
    modal_view('/jresources/files/view_one', "file_id=" + file_id + "&mode=" + mode, "File Details");
}

function view_collateral(col_id) {
    modal_view('/jresources/collateral/view_one', "col_id=" + col_id, "Collateral Details");
}

function view_referee(ref_id) {
    modal_view('/jresources/referees/view_one', "ref_id=" + ref_id, "Referee Details");
}

function delete_referee(refid) {
    var result = confirm('Are you sure you want to delete this referee?');
    if (result) {
        var params = "ref_id=" + refid;
        dbaction('/action/referees/delete', params, function (feed) {
            feedback("DEFAULT", "TOAST", ".feedback_", feed, "4");
        });
    }
}

function delete_collateral(refid) {
    var result = confirm('Are you sure you want to delete this collateral?');
    if (result) {
        var params = "ref_id=" + refid;
        dbaction('/action/collateral/delete', params, function (feed) {
            feedback("DEFAULT", "TOAST", ".feedback_", feed, "4");
        });
    }
}

function other_list(tbl, record, action) {

    let params = "action=" + action + "&tbl=" + tbl + "&record=" + record;
    dbaction("/jresources/customer_sec/list", params, function (feed) {
        console.log(JSON.stringify(feed));
        $('#other_').html(feed);
    })
}

function save_other(tbl, record) {
    let other_id = parseInt($('#other_id').val());
    let endpoint = "create";
    if (other_id > 0) {
        endpoint = "update";
    } else {

    }
    let key_ = $('#key_').val();
    let value_ = $('#value_').val();
    let params = "tbl=" + tbl + "&record=" + record + "&key_=" + key_ + "&value_=" + value_ + "&recid=" + other_id;

    dbaction("/action/customer_sec/" + endpoint, params, function (feed) {
        console.log(JSON.stringify(feed));
        feedback("DEFAULT", "TOAST", ".feedback_", feed, "4");
    })
}

function delete_other(refid) {
    var result = confirm('Are you sure you want to delete this entry?');
    if (result) {
        var params = "ref_id=" + refid;
        dbaction('/action/customer_sec/delete', params, function (feed) {
            feedback("DEFAULT", "TOAST", ".feedback_", feed, "4");
        });
    }
}

/////////////-----------------------------Loans
function search_cust() {
    let customer_search = $('#customer_search').val();
    $('#customer_id_').val("");
    if (customer_search) {
        let params = "key=" + customer_search;
        dbaction('/jresources/loan_customer_find', params, function (result) {
            $('#customer_results').slideDown("fast");
            $('#customer_results').html(result);
        })
    } else {
        $('#customer_results').fadeOut("fast");
    }
}

function select_client(name, uid) {

    $('#customer_search').val(name);
    $('#customer_id_').val(uid);
    $('#customer_results').fadeOut("fast");
}

function create_loan() {

    let customer_id = $('#customer_id_').val();
    let product_id = $('#product').val();
    let loan_amount = $('#amount').val();
    let application_mode = 'MANUAL';
    let params = "customer_id=" + customer_id + "&product_id=" + product_id + "&loan_amount=" + loan_amount + "&application_mode=" + application_mode;
    dbaction("/action/loan/loan_create", params, function (feed) {
        feedback("DEFAULT", "TOAST", ".feedback_", feed, "4");
    })

}

function loan_list() {
    let where = $('#_where_').val();
    if (!where) {
        where = "uid > 0";
    }
    let offset = $('#_offset_').val();
    if (!offset) {
        offset = 0;
    }
    let rpp = $('#_rpp_').val();
    if (!rpp) {
        rpp = 10;
    }
    let orderby = $('#_orderby_').val();
    if (!orderby) {
        orderby = 'uid';
    }
    let dir = $('#_dir_').val();
    if (!dir) {
        dir = 'desc'
    }
    let search = $('#search_').val();
    if (!search) {
        search = "";
    }


    let params = "where_=" + where + "&offset=" + offset + "&rpp=" + rpp + "&orderby=" + orderby + "&dir=" + dir + "&search_=" + search;
    dbaction("/jresources/loans/loan_list", params, function (feed) {
        console.log(params);
        $('#loan_list').html(feed);
        setTimeout(function () {
            pager_refactor();
        }, 500);

    })
}

function loan_filters() {
    let loan_order = $('#loan_order').val();
    let sel_product = parseInt($('#sel_product').val());
    let sel_branch = parseInt($('#sel_branch').val());
    let sel_stage = parseInt($('#sel_stage').val());
    let sel_status = parseInt($('#sel_status').val());

    let wher = " uid >-1";
    $('#_dir_').val(loan_order);
    if (sel_product > 0) {
        wher += " AND product_id =" + sel_product;
    }
    if (sel_branch > 0) {
        wher += " AND current_branch=" + sel_branch;
    }
    if (sel_stage > 0) {
        wher += " AND loan_stage=" + sel_stage;
    }
    if (sel_status > 0) {
        wher += " AND status=" + sel_status;
    }

    console.log("filt " + wher);

    if (wher) {
        $('#_where_').val(wher);
        $('#_offset_').val(0);

        pager_home();
    } else {
        $('#_where_').val(" status > -1");
        $('#_offset_').val(0);
    }


}

function loan_addons(loan_id) {
    let params = "loan_id=" + loan_id;
    load_std('/jresources/loans/loan_addons', '#loan_addons', params);
}

function loan_stages(loan_id) {
    let params = "loan_id=" + loan_id;
    load_std('/jresources/loans/loan_stages', '#loan_stages', params);
}


function loan_addon_action(action, loan_id, addon_id) {
    let params = "action=" + action + "&loan_id=" + loan_id + "&addon_id=" + addon_id;
    dbaction("/action/loan/loan_addon", params, function (feed) {
        feedback("DEFAULT", "TOAST", ".feedback_", feed, "3");
    });
}

function loan_deductions(loan_id) {
    let params = "loan_id=" + loan_id;
    load_std('/jresources/loans/loan_deductions', '#loan_deductions', params);
}

function loan_deductions_action(action, loan_id, deduction_id) {
    let params = "action=" + action + "&loan_id=" + loan_id + "&deduction_id=" + deduction_id;
    dbaction("/action/loan/loan_deduction", params, function (feed) {
        feedback("DEFAULT", "TOAST", ".feedback_", feed, "3");
    });
}

function loan_action(loan_id, act, title) {
    var result = confirm('Are you sure you want to ' + title + '?');
    if (result) {
        var params = "loan_id=" + loan_id + "&act=" + act;
        dbaction('/action/loan/action', params, function (feed) {
            feedback("DEFAULT", "TOAST", ".feedback_", feed, "4");
        });
    }
}

///////////-----------------------------End of Loans

//////////-----------------------------Repayments
function payment_list() {
    let where = $('#_where_').val();
    if (!where) {
        where = "uid > 0";
    }
    let offset = $('#_offset_').val();
    if (!offset) {
        offset = 0;
    }
    let rpp = $('#_rpp_').val();
    if (!rpp) {
        rpp = 10;
    }
    let orderby = $('#_orderby_').val();
    if (!orderby) {
        orderby = 'uid';
    }
    let dir = $('#_dir_').val();
    if (!dir) {
        dir = 'desc'
    }
    let search = $('#search_').val();
    if (!search) {
        search = "";
    }


    let params = "where_=" + where + "&offset=" + offset + "&rpp=" + rpp + "&orderby=" + orderby + "&dir=" + dir + "&search_=" + search;
    dbaction("/jresources/repayments/payment_list", params, function (feed) {
        console.log(params);
        $('#payment_list').html(feed);
        setTimeout(function () {
            pager_refactor();
        }, 500);

    })
}

function payment_save() {
    let pid = parseInt($('#pid').val());
    let endpoint = 'create';
    if(pid > 0){
      endpoint = 'update';
    }
    let payment_method = $('#payment_method').val();
    let mobile_number = $('#mobile_number').val();
    let amount = $('#amount').val();
    let transaction_code = $('#payment_code').val();
    let loan_id = $('#loan_code').val();
    let payment_date = $('#date_made').val();
    let comments = $('#comments').val();
    let record_method = "MANUAL";
    let params = "payment_method=" + payment_method + "&mobile_number=" + mobile_number + "&amount=" + amount + "&transaction_code=" + transaction_code + "&loan_id=" + loan_id + "&comments="+ comments + "&payment_date=" + payment_date + "&record_method=" + record_method + "&pid="+pid;
    dbaction("/action/payments/"+endpoint, params, function (feed) {
        console.log(JSON.stringify(feed));
        feedback("DEFAULT", "TOAST", ".feedback_", feed, "4");
    })
}

/////////------------------------------End of repayments
function formready(formid) {
    formhandler('#' + formid);
}


function formhandler(formid) {

    var options = {
        beforeSend: function () {
            $("#progress").show();
            //clear everything
            $("#bar").width('0%');
            $("#message").html("");
            $("#percent").html("0%");
        },
        uploadProgress: function (event, position, total, percentComplete) {
            $("#bar").width(percentComplete + '%');
            $("#percent").html(percentComplete + '%');

        },
        success: function () {
            $("#bar").width('100%');
            $("#percent").html('100%');

        },
        complete: function (response) {
            $("#message").html("<font color='green'>" + response.responseText + "</font>");
            ///if success, refresh form
            var res = response.responseText;
            var suc = (res.search("ucces"))
            if (suc >= 0) {
                $(formid)[0].reset();
            }


        },
        error: function () {
            $("#message").html("<font color='red'> ERROR: unable to upload files</font>");

        }

    };

    $(formid).ajaxForm(options);

}


function save_loan_product() {
    let name = $('#product_name').val();
    let description = $('#description').val();
    let period = $('#period').val();
    let period_units = $('#period_units').val();
    let min_amount = $('#min_amount').val();
    let max_amount = $('#max_amount').val();
    let pay_frequency = $('#pay_frequency').val();
    let percent_breakdown = $('#payment_breakdown').val();
    let params = "name=" + name + "&description=" + description + "&period=" + period + "&period_units=" + period_units + "&min_amount=" + min_amount + "&max_amount=" + max_amount + "&pay_frequency=" + pay_frequency + "&percent_breakdown=" + percent_breakdown;
    dbaction("/action/loan_product_save", params, function (feed) {
        console.log(JSON.stringify(feed));
        feedback("DEFAULT", "TOAST", ".feedback_", feed, "4");
    })
}

function addon_save() {
    let name = $('#addon_name').val();
    let description = $('#addon_description').val();
    let amount = $('#addon_amount').val();
    let amount_type = $('#amount_type').val();
    let loan_stage = $('#loan_stage').val();
    let automatic = $('#automatic').val();
    let params = "name=" + name + "&description=" + description + "&amount=" + amount + "&amount_type=" + amount_type + "&loan_stage=" + loan_stage + "&automatic=" + automatic;
    dbaction("/action/addon_save", params, function (feed) {
        console.log(JSON.stringify(feed));
        feedback("DEFAULT", "TOAST", ".feedback_", feed, "4");
    })

}

function deduction_save() {
    let name = $('#deduction_name').val();
    let description = $('#deduction_description').val();
    let amount = $('#deduction_amount').val();
    let amount_type = $('#amount_type').val();
    let loan_stage = $('#loan_stage').val();
    let automatic = $('#automatic').val();
    let params = "name=" + name + "&description=" + description + "&amount=" + amount + "&amount_type=" + amount_type + "&loan_stage=" + loan_stage + "&automatic=" + automatic;
    dbaction("/action/deduction_save", params, function (feed) {
        console.log(JSON.stringify(feed));
        feedback("DEFAULT", "TOAST", ".feedback_", feed, "4");
    })

}


function product_addon_save(pid, aid, action) {
    let params = "addon_id=" + aid + "&product_id=" + pid + "&action=" + action;
    dbaction("/action/product_addon_save", params, function (feed) {
        let jso = JSON.parse(feed);
        let result = jso.result_;
        let final_ = jso.final_;
        console.log(result);
        if (result === 1) {
            let button = "";
            feedback("SUCCESS", "TOAST", ".feedback_", "Success", "2");
            if (final_ === 1) {
                button = "<a onclick=\"product_addon_save(" + pid + ", " + aid + ", 'REMOVE')\" title=\"Click to Remove\" class=\"text-success pointer\"><i class=\"fa fa-check\"></i> Added </a>";
            } else {
                button = "<a onclick=\"product_addon_save(" + pid + ", " + aid + ", 'ADD')\" title=\"Click to Add\" class=\"text-primary pointer\"><i class=\"fa fa-times-circle\"></i> Not Added </a>";
            }
            $('#a' + aid + pid).html(button);
            console.log(aid + pid);
        } else {
            feedback("ERROR", "TOAST", ".feedback_", "<div class=\"alert danger\"> Error Occurred </span>", "2");
        }
        // feedback("DEFAULT", "TOAST", ".feedback_", feed, "2");
    })

}

function product_deduction_save(pid, did, action) {
    let params = "deduction_id=" + did + "&product_id=" + pid + "&action=" + action;
    dbaction("/action/product_deduction_save", params, function (feed) {
        console.log(feed);
        let jso = JSON.parse(feed);
        let result = jso.result_;
        let final_ = jso.final_;
        if (result === 1) {
            let button = "";
            feedback("SUCCESS", "TOAST", ".feedback_", "Success", "2");
            if (final_ === 1) {
                button = "<a onclick=\"product_deduction_save(" + pid + ", " + did + ", 'REMOVE')\" title=\"Click to Remove\" class=\"text-success pointer\"><i class=\"fa fa-check\"></i> Added </a>";
            } else {
                button = "<a onclick=\"product_deduction_save(" + pid + ", " + did + ", 'ADD')\" title=\"Click to Add\" class=\"text-primary pointer\"><i class=\"fa fa-times-circle\"></i> Not Added </a>";
            }
            $('#d' + did + pid).html(button);
        } else {
            feedback("ERROR", "TOAST", ".feedback_", "<div class=\"alert danger\"> Error Occurred </span>", "2");
        }
        // feedback("DEFAULT", "TOAST", ".feedback_", feed, "2");
    })

}

function product_stage_save(pid, did, action) {
    let params = "stage_id=" + did + "&product_id=" + pid + "&action=" + action;
    dbaction("/action/product_stage_save", params, function (feed) {
        console.log(feed);
        let jso = JSON.parse(feed);
        let result = jso.result_;
        let final_ = jso.final_;
        if (result === 1) {
            let button = "";
            feedback("SUCCESS", "TOAST", ".feedback_", "Success", "2");
            if (final_ === 1) {
                button = "<a onclick=\"product_stage_save(" + pid + ", " + did + ", 'REMOVE')\" title=\"Click to Remove\" class=\"text-success pointer\"><i class=\"fa fa-check\"></i> Added </a>";
            } else {
                button = "<a onclick=\"product_stage_save(" + pid + ", " + did + ", 'ADD')\" title=\"Click to Add\" class=\"text-primary pointer\"><i class=\"fa fa-times-circle\"></i> Not Added </a>";
            }
            $('#s' + did + pid).html(button);
        } else {
            feedback("ERROR", "TOAST", ".feedback_", "<div class=\"alert danger\"> Error Occurred </span>", "2");
        }
        // feedback("DEFAULT", "TOAST", ".feedback_", feed, "2");
    })

}

///////--------------------------Loan Stage
function stage_save() {
    let name = $('#deduction_name').val();
    let description = $('#deduction_description').val();
    let stage_order = $('#stage_order').val();
    let can_addon = $('#can_addon').val();
    let can_deduct = $('#can_deduct').val();
    let params = "name=" + name + "&description=" + description + "&stage_order=" + stage_order + "&can_addon=" + can_addon + "&can_deduct=" + can_deduct;
    dbaction("/action/loan_stage_save", params, function (feed) {
        console.log(JSON.stringify(feed));
        feedback("DEFAULT", "TOAST", ".feedback_", feed, "4");
    });
}

function move_stage(loan_id) {
    let comments = $('#comments_').val();
    let params = "loan_id=" + loan_id + "&comment=" + comments;
    dbaction("/action/loan/move_stage", params, function (feed) {
        console.log(JSON.stringify(feed));
        feedback("DEFAULT", "TOAST", ".feedback_", feed, "4");
    });
}

function approve_disburse(loan_id) {
    let comments = $('#comments_').val();
    let params = "loan_id=" + loan_id + "&comment=" + comments;
    dbaction("/action/loan/approve_disburse", params, function (feed) {
        console.log(JSON.stringify(feed));
        feedback("DEFAULT", "TOAST", ".feedback_", feed, "4");
    });
}


///////--------------------------End Loan Stages
///////////----------------------Interactions
function load_interactions(customer) {
    let where = $('#_where_').val();
    if (!where) {
        where = "uid > 0";
    }
    let offset = $('#_offset_').val();
    if (!offset) {
        offset = 0;
    }
    let rpp = $('#_rpp_').val();
    if (!rpp) {
        rpp = 10;
    }
    let orderby = $('#_orderby_').val();
    if (!orderby) {
        orderby = 'uid';
    }
    let dir = $('#_dir_').val();
    if (!dir) {
        dir = 'desc'
    }
    let search = $('#search_').val();
    if (!search) {
        search = "";
    }

    if ((parseInt(customer)) > 0) {
        let params = "where_=" + where + "&offset=" + offset + "&rpp=" + rpp + "&orderby=" + orderby + "&dir=" + dir + "&search_=" + search + "&customer=" + customer;
        dbaction("/jresources/interactions/interactions-list", params, function (feed) {
            console.log(params);
            $('#interaction_customer').html(feed);
            setTimeout(function () {
                pager_refactor();
            }, 200);

        });
    } else {

    }
    let params = "where_=" + where + "&offset=" + offset + "&rpp=" + rpp + "&orderby=" + orderby + "&dir=" + dir + "&search_=" + search + "&customer=0";
    dbaction("/jresources/interactions/interactions-list", params, function (feed) {
        console.log(params);
        $('#interactions_').html(feed);
        setTimeout(function () {
            pager_refactor();
        }, 200);

    });

}

function save_interaction() {
    let customer_id = $('#customer_id_').val();
    let transcript = $('#details').val();
    let conversation_method = $('input[name="conversation_method"]:checked').val();
    let flag = $('input[name="flag"]:checked').val();
    let next_interaction = $('#next_int').val();
    let next_steps = $('#next_stage').val();
    let params = "&customer_id=" + customer_id + "&transcript=" + transcript + "&conversation_method=" + conversation_method + "&next_interaction=" + next_interaction + "&next_steps=" + next_steps + "&flag=" + flag;
    dbaction("/action/interaction_save", params, function (feed) {
        console.log(JSON.stringify(feed));
        feedback("DEFAULT", "TOAST", ".feedback_", feed, "4");
    })
}

function view_interaction(iid) {
    let params = "iid=" + iid;
    modal_view('/jresources/interactions/view-one', params, "Interaction Details");
}

//////////=======================End of interactions
/////////----------------Settings
function permissions(group_id, user_id, tbl, rec, act, value) {

    let params = "group_id=" + group_id + "&user_id=" + user_id + "&tbl=" + tbl + "&rec=" + rec + "&act=" + act + "&val=" + value;

    dbaction("/jresources/permissions/update", params, function (feed) {
        $('#perm').html(feed);
    });
}


////////----------------End of settings


////////////----------------------Reports
function save_report() {
    let uid = parseInt($('#report_id').val());
    let title = $('#title').val();
    let description = $('#description').val();
    let row_query = $('#row_query').val();
    let viewable_by = $('#viewable_by').val();

    let endpoint = "create-new";
    if (uid > 0) {
        endpoint = "update";
    }

    let params = "uid=" + uid + "&title=" + title + "&description=" + description + "&row_query=" + row_query + "&viewable_by=" + viewable_by;

    dbaction("/action/report/" + endpoint, params, function (feed) {
        console.log(JSON.stringify(feed));
        feedback("DEFAULT", "TOAST", ".feedback_", feed, "4");
    })
}

//////////=====================End of reports


///////////-------------Campaign
function save_campaign(){
    let cid = parseInt($('#cid').val());
    let title = $('#title').val();
    let description = $('#description').val();
    let date = $('#date').val();
    let target_customers = $('#target_customers').val();
    let status = $('#status').val();

    let endpoint = "create-new";
    if (cid > 0) {
        endpoint = "update";
    }

    let params = "cid=" + cid + "&title=" + title + "&description=" + description + "&date=" + date + "&target_customers=" + target_customers + "&status="+status;

    dbaction("/action/campaign/" + endpoint, params, function (feed) {
        console.log(JSON.stringify(feed));
        feedback("DEFAULT", "TOAST", ".feedback_", feed, "4");
    })
}

//////////==============End of campaign