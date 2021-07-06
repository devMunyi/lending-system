function dbaction(resource,params, callback){
    let server_ = $('#server_').val();
    let fields=params;
    $.ajax({
        method:'POST',
        url:server_+resource,
        data:fields,
        beforeSend:function()
        {
            $("#processing").show();
        },

        complete:function ()
        {
            $("#processing").hide();
        },
        success: function(feedback)
        {
            callback(feedback);
        },
        error: function (err) {
            callback(err);
        }


    });
}

function feedback(mtype = 'NOTICE', dtype = 'TOAST', target = '.feedback', message, secs = 5) {
    let fmessage = "";
    $(target).text("");
    if (mtype === 'NOTICE') {
        fmessage = "<span class='info notice'>" + message + "</span>";
    } else if (mtype === 'ERROR') {
        fmessage = "<span class='info error'>" + message + "</span>";
    } else if (mtype === 'SUCCESS') {
        fmessage = "<span class='info success'>" + message + "</span>";
    }
    if (dtype === 'TOAST') {
        $('#standardnotif').html("").css("display", "none").removeClass(mtype);
        $('#standardnotif').html(message).fadeIn("fast").addClass(mtype + "x");
        setTimeout(function () {
            $('#standardnotif').html("").fadeOut('fast').removeClass(mtype);
            $(target).html("");
        }, 1000 * secs);
    } else if (dtype === 'INLINE') {
        $(target).html(fmessage);
        setTimeout(function () {
            $(target).html("");
            $(target).html("");
        }, 1000 * secs);
    }
}

function load_std(resource,targetdiv,params) {
    let fields = params;
    let thislocation = $('#server_').val();

    $.ajax({
        method:'GET',
        url:thislocation+resource,
        data:fields,
        beforeSend:function()
        {
            $("#processing").show();
        },

        complete:function ()
        {
            $("#processing").show();
        },
        success: function(feedback)
        {
            $(targetdiv).html(feedback);

        }

    });
}

function reload(){
    location.reload();
}
function gotourl(url){
    window.location.href = url;
}

function pager(tableid) {

    $("<div class=\"row page-header\">\n" +
        "                        <div class=\"col-sm-6\"><span class=\"font-18 font-italic text-black\"><span id='total_results_'>0</span> Records Found</span></div>\n" +
        "                        <div class=\"col-sm-6\"><input type=\"text\" class=\"form-control\" id='search_' onkeyup='search();' placeholder=\"Search\"></div>\n" +
        "                    </div>\n").insertBefore(tableid);

    $("<div class=\"pager\" id=\"pager_foot\">\n" +
        "                        <nav aria-label=\"Pager\">\n" +
        "                            <ul class=\"list-group\">\n" +
        "                                <li  class=\"page-item\">\n" +
        "                                    <a class=\"page-link btn  bg-blue text-bold\" id='prev_' href=\"#\" onclick=\"prev()\" tabindex=\"-1\"><i class='fa fa-arrow-left'></i> Previous</a>\n" +
        "                                </li>\n" +
        "                                <li class=\"page-item\"> <i>Page 1</i> </li>\n" +
        "                                <li  class=\"page-item\">\n" +
        "                                    <a class=\"page-link btn  bg-blue text-bold\" id='next_' onclick=\"next()\" href=\"#\">Next <i class='fa fa-arrow-right'></i></a>\n" +
        "                                </li>\n" +
        "                            </ul>\n" +
        "                        </nav>\n" +
        "                    </div>").insertAfter(tableid);



}
function next() {
    let current_offset = parseInt($('#_offset_').val());
    let current_rpp = parseInt($('#_rpp_').val());
    let func = $('#_func_').val();
    let nex = current_offset + current_rpp;
    if(nex < 0){
        nex = 0;
    }
    $('#_offset_').val(nex);
    var fn = eval(func);
}
function prev() {
    let current_offset = parseInt($('#_offset_').val());
    let current_rpp = parseInt($('#_rpp_').val());
    let func = $('#_func_').val();
    let prev = current_offset - current_rpp;
    if(prev < 0){
        prev = 0;
    }
    $('#_offset_').val(prev);
    var fn = eval(func);
}
function search() {
    let search_ = $('#search_').val().trim();
    if(search_) {
       // $('#_search_').val(search_);
        $('#_search_').val(search_);
        $('#_offset_').val(0);
        let func = $('#_func_').val();
        var fn = eval(func);
        setTimeout(function () {
            var html = $('.table').html();
           // $('.table').html(html.replace(/mercy/gi, '<strong>$&</strong>'));
        },100);
    }
    else{
        pager_home();
    }
}

function orderby(fld, dir){
    $('#_orderby_').val(fld);
    $('#_dir_').val(dir);

    $('#_offset_').val(0);
    let func = $('#_func_').val();
    var fn = eval(func);
    setTimeout(function () {
        var html = $('.table').html();
        // $('.table').html(html.replace(/mercy/gi, '<strong>$&</strong>'));
    },100);
}

function pager_home() {
    $('#_offset_').val(0);
    //$('#_search_').val("");
    let func = $('#_func_').val();
    var fn = eval(func);
}

function pager_refactor() {
    let current_offset = parseInt($('#_offset_').val());
    let current_rpp = parseInt($('#_rpp_').val());
    let total_records = parseInt($('#_alltotal_').val());
   $('#total_results_').html(total_records);
   if(((current_offset)) > 0){
       $("#prev_").removeClass("disabled");
   }
   else{
       $("#prev_").addClass("disabled");
   }

   if((current_rpp+current_offset) >= total_records){
       $("#next_").addClass("disabled");
   }
   else{
       $("#next_").removeClass("disabled");
   }

}








