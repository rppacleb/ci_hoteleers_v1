

$(document).ready(function(){
    var homeurl         = baseurl + '/employer';
    var homeurl_txt     = 'employer';
    var urlimgdef       = baseurl + '/files/images/default/image.png';
    var upload_path     = baseurl + '/files/uploads/';
    var dropdown_loaded = 0;
   // load_record(0,'signup','main_container','main_pagination','main_loader');

    if(side_menu !== ""){
        $('#'+side_menu).removeClass('text-muted');
        $('#'+side_menu).addClass('active');
        $('#'+side_menu).css({'opacity': 0.8, "background-color": "rgb(0, 41, 170)"}); 
        $("#side_account_management_collapse").addClass('show');
        $("#collapse_link i").removeClass('fa-chevron-down');
        $("#collapse_link i").addClass('fa-chevron-up');
    }else{
        $('#side_account_management').removeClass('text-muted');
        $('#side_account_management').addClass('active');
        $('#side_account_management').css({'opacity': 0.8, "background-color": "rgb(0, 41, 170)"});
    }//end if

    if ($(window).width() >= 1441 ) {
        $('.container-fluid').css({'max-width': '1440px'});
        $('#side_menu').css('width', '18%');
    } else if ($(window).width() >= 1360 && $(window).width() <= 1440) {
        $('.container-fluid').css({'max-width': '1350px'});
        $('#side_menu').css('width', '20%');
    } else if ($(window).width() >= 1200 && $(window).width() <= 1359) {
        $('.container-fluid').css({'max-width': '1200px'});
        $('#side_menu').css('width', '23%');
    }

    if (window.location.href.indexOf("edit") > -1) {
        $('.evw-prefixcol').removeClass('col-1');
        $('.evw-prefixcol').addClass('col-2');
    } else if (window.location.href.indexOf("view") > -1) {
        $('.evw-prefixcol').css('width', '9.333333%');
        if (window.location.href.indexOf("type=inactive") > -1) {
            $('.evw-adduser').addClass('d-none');
        }
    }

   load_record(0,'user','main_container','main_pagination','main_loader');
   

   load_record2(0,'history','history_container','history_pagination','history_loader');

   //alert(moment('4/30/2016', 'MM/DD/YYYY').add(1, 'day'));

   //Initialize date time picker
    $('input[name=header\\[start_date\\]]').datetimepicker({
        format: 'M/D/YYYY',
        defaultDate : new Date()

    });

    $('input[name=header\\[start_time\\]]').datetimepicker({
        format: 'LT',
        defaultDate : new Date()
    });

    $('input[name=header\\[end_date\\]]').datetimepicker({
        format: 'M/D/YYYY',
        defaultDate : new Date()
    });

    $('input[name=header\\[end_time\\]]').datetimepicker({
        format: 'LT',
        defaultDate : new Date()
    });

    //load_data
    //load record
    $(document.body).on('blur','input[name=header\\[id\\]]',function(e){
        var id          = $(this).val();
        var type        = $(this).attr('aria-type');

        var param       = {};
        //param["type"]   = type;
        param["id"]     = id;
        param["mode"]   = type;
        load_data(param);
    })
    //end load record

    $('input[name=header\\[id\\]]').trigger('blur');
    


    //user list
    //load record
    function load_record(page,type,container,pagination,loader){

        var homeurl_txt = 'user';
        var edit_url = baseurl + '/user/edit/';
        var view_url = homeurl + '/view/';
        var user_url  = baseurl + '/user';
        var user_view_url = baseurl + '/user/view/';
    
        var data                    = {};
            data.page               = page;
            data.filter_field       = 't3.employer';
            data.filter             = employer;
            data.keyword            = $('input[name=header\\[keyword\\]]').val();


        var url         = baseurl + '/get/'+homeurl_txt+'/'+type;


        $.ajax({
            url: url,
            type: "POST",
            data: data,
            dataType: "JSON",
            beforeSend : function(){
                $('#'+loader+'').html('<div class="col-2"></div><div class="col text-center"><div class="spinner-grow text-muted"></div><div class="col-2"></div></div>');
            },
        }).done(function (data) {
              
        
                if(data.data !== null){

                    $('#'+container+'').empty();
                    $('#'+loader+'').empty();

                    var start_page = 1;
                    var end_page   = (data.per_page);

                    if(page > 0){
                        start_page  = ((page - 1) * data.per_page) <= 0? 1 : ((page - 1) * data.per_page) + 1;
                        end_page    = page * (data.per_page);
                    }//end if

                    if(end_page > data.total_result){
                        end_page = data.total_result;
                    }//end if
                    
                    
                    $('.pagination_result').empty();
                    $('.pagination_result').html(start_page+' - '+end_page+' of '+ toCurrency_precision(data.total_result,0)+' result(s)')

                    $.each(data.data, function (key, value) {
                        var html = '';

                        html += '<div class="row mb-3">';

                            html += '<div class="col">';
                                html += '<div class="card">';
                                    html += '<div class="card-body">';
                                        html += '<div class="row">';
                                          
                                            html += '<div class="col align-self-center">';
                                                if(type !== 'user_archived'){
                                                    html += '<a style="text-decoration:none;" class="text-link" href="'+user_view_url+value.id+'?employer='+employer+'&side_menu='+side_menu+'">'+value.name+'</a>';
                                                }else{
                                                    html += '<a style="text-decoration:none;" class="text-link" href="'+user_view_url+value.id+'?employer='+employer+'&side_menu='+side_menu+'&is_archived=T">'+value.name+'</a>';
                                                }
                                                
                                            html += '</div><!--./col-->';
                                            html += '<div class="col align-self-center">';
                                                html += value.designation;
                                            html += '</div><!--./col-->';
                                            html += '<div class="col align-self-center" style="width:3.2in;">';
                                                html += value.email_add;
                                            html += '</div><!--./col-->';
                                            html += '<div class="text-right col-xl-2 col-lg-2 col-md-12 col-sm-12 col-xs-12 align-self-center" style="min-width:2in;">';
                                                //html += '<div class="btn-group btn-group-toggle">';
                                                    
                                                    var btn_class= "btn-outline-dark disabled";

                                                    
                                                    //html += '<a href="'+view_url+value.id+'?employer='+employer+'" class="mr-2 btn btn-pill-sm btn-pill-outline-link text-link btn_view">View</a>';
                                                    if(type !== 'user_archived'){
                                                        var add_url = "";
                                                        if(title_type !== ""){
                                                            add_url = "&type="+title_type;
                                                        }
                                                        html += '<a href="'+edit_url+value.id+'?employer='+employer+'&side_menu='+side_menu+add_url+'" class="mr-2 btn btn-pill-sm btn-pill-outline-link text-link btn_view">Edit</a>';
                                                        html += '<button aria-id="'+value.id+'" class="btn btn-pill-sm btn-pill-outline-primary text-primary btn_delete">Delete</button>';
                                                    }//end if
                                                    
                                                    
                                                    
                                                    //html += '<a href="'+view_url+value.id+'" class="btn btn-pill-sm '+btn_class+' btn_view">'+value.activated+'</a>';

                                                    //if(declined == ""){
                                                        //html += '<button aria-id="'+value.id+'" aria-type="2" aria-username="'+value.username+'" class="'+approved+' btn btn-pill-sm btn-pill-outline-link text-link btn_submit">Approve</button>';
                                                    //}//end if
                                                    //if(approved == ""){
                                                        //html += '<button aria-id="'+value.id+'" aria-type="3" aria-username="'+value.username+'" class="'+declined+' btn btn-pill-sm btn-pill-outline-primary text-primary btn_submit">Decline</button>';
                                                    //}//end if
                                                //html += '</div>';
                                            html += '</div><!--./col-->';
                                        html += '</div><!--./row-->';
                                    html += '</div><!--./card-body-->';
                                html += '</div><!--./card-->';
                            html += '</div><!--./col-->';
                            
                           
                        html += '</div><!--./row-->';

                        
                        $('#'+container+'').append(html);
                    });

                    //pagination
                    
                    
                    if(page == 0){
                      

                        
                        var param = {};
                        param.total_page    = data.total_page;
                        param.page          = 1;
                        param.pagination    = pagination;
                        load_pagination(param);
                        


                        $('.'+pagination+' > li.page-item:first').addClass('active');
                        
                    }//end if
                    //end pagination
                }else{
                    $('#'+container+'').empty();
                    $('#'+loader+'').empty();
                    $('.'+pagination+'').empty();
                    $('.pagination_result').empty();
                    
                    var html = '';
                        html += '<div class="row">';
                            html += '<div class="col">';
                                html += '<div class="text-center">';
                                    html += '<b>No Result</b>';       
                                html += '</div>';
                            html += '</div>';
                        html += '</div>';
                    $('#'+container+'').html(html);
                }//end if

                $('#loading').hide();
            }).fail(function(e){
                alert(e.responseText);
                $('#loading').hide();
            }).always(function(e){

        });
    }//end load_record
    //end user list


    //load record
    function load_record2(page,type,container,pagination,loader){

        var homeurl_txt = 'employer_history';
        var edit_url = baseurl + '/user/edit/';
        var view_url = homeurl + '/view/';
        var user_url  = baseurl + '/user';
    
        var data                    = {};
            data.page               = page;
            data.filter_field       = 't3.employer';
            data.filter             = employer;
            data.keyword            = $('input[name=header\\[keyword\\]]').val();
            data.id                 = employer;

        var url         = baseurl + '/get/'+homeurl_txt+'/'+type;


        $.ajax({
            url: url,
            type: "POST",
            data: data,
            dataType: "JSON",
            beforeSend : function(){
                $('#'+loader+'').html('<div class="col-2"></div><div class="col text-center"><div class="spinner-grow text-muted"></div><div class="col-2"></div></div>');
            },
        }).done(function (data) {
              
        
                if(data.data !== null){

                    $('#'+container+'').empty();
                    $('#'+loader+'').empty();

                    var start_page = 1;
                    var end_page   = (data.per_page);

                    if(page > 0){
                        start_page  = ((page - 1) * data.per_page) <= 0? 1 : ((page - 1) * data.per_page) + 1;
                        end_page    = page * (data.per_page);
                    }//end if

                    if(end_page > data.total_result){
                        end_page = data.total_result;
                    }//end if
                    
                    
                    $('.pagination_result').empty();
                    $('.pagination_result').html(start_page+' - '+end_page+' of '+ toCurrency_precision(data.total_result,0)+' result(s)')

                    $.each(data.data, function (key, value) {
                        var html = '';

                        html += '<div class="row mb-3">';

                            html += '<div class="col">';
                                
                                        html += '<div class="row">';
                                          
                                            html += '<div class="col align-self-center text-link">';
                                                html += value.start_date;
                                            html += '</div><!--./col-->';
                                            html += '<div class="col align-self-center">';
                                                html += value.end_date;
                                            html += '</div><!--./col-->';
                                            html += '<div class="col align-self-center">';
                                            html += value.status.charAt(0).toUpperCase() + value.status.slice(1);
                                            html += '</div><!--./col-->';
                                            html += '<div class="col align-self-center">';
                                                html += value.date_created;
                                            html += '</div><!--./col-->';
                                            /*html += '<div class="text-right col-xl-2 col-lg-2 col-md-12 col-sm-12 col-xs-12 align-self-center" style="min-width:1in;">';
                                                    var btn_class= "btn-outline-dark disabled";                                                    
                                                    html += '<a href="'+view_url+value.id+'?side_menu='+side_menu+'" class="mr-2 btn btn-pill-sm btn-pill-outline-link text-link btn_view">View</a>';
                                            html += '</div><!--./col-->';*/
                                        html += '</div><!--./row-->';
                                  
                            html += '</div><!--./col-->';
                            
                           
                        html += '</div><!--./row-->';

                        
                        $('#'+container+'').append(html);
                    });

                    //pagination
                    
                    
                    if(page == 0){
                      

                        
                        var param = {};
                        param.total_page    = data.total_page;
                        param.page          = 1;
                        param.pagination    = pagination;
                        load_pagination(param);
                        


                        $('.'+pagination+' > li.page-item:first').addClass('active');
                        
                    }//end if
                    //end pagination
                }else{
                    $('#'+container+'').empty();
                    $('#'+loader+'').empty();
                    $('.'+pagination+'').empty();
                    $('.pagination_result').empty();
                    
                    var html = '';
                        html += '<div class="row">';
                            html += '<div class="col">';
                                html += '<div class="text-center">';
                                    html += '<b>No Result</b>';       
                                html += '</div>';
                            html += '</div>';
                        html += '</div>';
                    $('#'+container+'').html(html);
                }//end if

                $('#loading').hide();
            }).fail(function(e){
                alert(e.responseText);
                $('#loading').hide();
            }).always(function(e){

        });
    }//end load_record
    //end user list




    function load_pagination(param) {
        //test
        var pgntn_current_page  = parseInt((param.page === 0? 1 : param.page));
        var pgntn_total_page    = param.total_page;
        var pgntn_per_pages     = 8;
        var pgntn_per_page      = (parseInt(pgntn_current_page) * pgntn_per_pages);
     
        var init_ctr = 1;
        if(pgntn_per_page > pgntn_total_page){
            pgntn_per_page = pgntn_total_page;
        }//end if
        
       
        init_ctr = (pgntn_per_page - pgntn_per_pages) + 1;

        if(param.page == 0 || param.page == 1){
            init_ctr = 1;
        }//end if
        //alert(init_ctr);

         
        $('.'+param.pagination+'').empty();

        //previous button
        if(pgntn_current_page > 1){
            var html = '';
             html = '<li class="page-item" aria-page="prev" aria-total_page="'+pgntn_total_page+'" aria-current_page="'+pgntn_current_page+'"><a class="page-link">Prev</a></li>';
            $('.'+param.pagination+'').append(html);
        }//end if
        //end previous button

        for (var i = init_ctr; i <= pgntn_per_page; i++) {
            var html = '';
            
                html += '<li class="page-item" aria-page="'+i+'" aria-total_page="'+pgntn_total_page+'"><a class="page-link">'+i+'</a></li>';
                $('.'+param.pagination+'').append(html);

        }//end if

        //next button
        if(pgntn_per_page !== pgntn_total_page){
            var html = '';
             html = '<li class="page-item" aria-page="next" aria-total_page="'+pgntn_total_page+'" aria-current_page="'+pgntn_current_page+'"><a class="page-link">Next</a></li>';
            $('.'+param.pagination+'').append(html);
        }//end if
        //end test
        //end next button
    }//end function


    //event
    //=====================================================================================================================
    //pagination button

     $(document.body).on('click','li.page-item',function(e){
        var page = $(this).attr('aria-page');
        var type = $(this).parent().attr('aria-type');
        
        if(page == 'next'){
            var total_page      = $(this).attr('aria-total_page');
            var current_page    = parseInt($(this).attr('aria-current_page'))+1;
            var param = {};
            param.total_page    = total_page;
            param.page          = current_page;
            param.pagination    = type+'_pagination';
            load_pagination(param);
        }else if(page == 'prev'){
            var total_page      = $(this).attr('aria-total_page');
            var current_page    = parseInt($(this).attr('aria-current_page'))-1;

            var param = {};
            param.total_page    = total_page;
            param.page          = current_page;
            param.pagination    = type+'_pagination';
            load_pagination(param);
        }else{
            $('.'+type+'_pagination > li.page-item').removeClass('active');
            $(this).addClass('active');
            load_record2(page,'user','history_container','history_pagination','history_loader');
        }
     
        
    });
    //end pagination button

    //delete
    $(document.body).on('click','button.btn_delete',function(e){
        var url         = baseurl+"/user";
        url             += '/delete_data';
        var id          = $(this).attr('aria-id');

        var btn         = $(this);
        var btn_text    = 'Delete';
        
        var data               = {};
            data.header        = {};
            data.header.id     = id;


        if(confirm("Are you sure you want to delete this item?")){
            $.ajax({
                url: url,
                type: "POST",
                data : data,
                dataType: "JSON",
                beforeSend : (function (data){
                    btn.text('Processing...');
                    btn.attr('disabled','disabled');
                })
            }).done(function (data) {
                
                //alert(Object.keys(data.messages).length);
                if (data.success === true){
                    
                    var msg_html    = '';
                    var arr         = [];
                    for (var i = 0; i <= data.messages.length - 1; i++) {
                        for (var element in data.messages[i]) {
                            arr.push(data.messages[i][element]);
                            msg_html += data.messages[i][element] + '\n';
                        }//end for
                    }//End for

                    $.notify(msg_html,{ 
                        position:"top center",
                        className:"success",
                        arrowShow : true
                    });

                    load_record(0,'user','main_container','main_pagination','main_loader');
                    

                    btn.text(btn_text);
                    btn.removeAttr('disabled');

                } else {
                    var msg_html    = '';
                    var arr         = [];
                    for (var i = 0; i <= data.messages.length - 1; i++) {
                        for (var element in data.messages[i]) {
                            arr.push(data.messages[i][element]);
                            msg_html += data.messages[i][element] + '\n';
                        }//end for
                    }//End for

                    $.notify(msg_html,{ 
                        position:"top center",
                        className:"error",
                        arrowShow : true
                    });

                    btn.text(btn_text);
                    btn.removeAttr('disabled');
                }
            }).fail(function(e){
                alert(e.responseText);
               

                btn.text(btn_text);
                btn.removeAttr('disabled');
            }).always(function(e){

            });
        }//end if

        
        
    })//end btn_add
    //end delete
    
    
    //approve
    $(document.body).on('click','.btn_submit',function(e){
        var view_url     = homeurl + '/view/';

        var id          = $(this).attr('aria-id');
        var btn         = $(this);
        var btn_text    = '';
        var id          = $(this).attr('aria-id');
        var type        = $(this).attr('aria-type');
        var type_text   = "";

       
        var url         = homeurl;
        url             = homeurl + '/submit_data';
        var url_view    = homeurl + '/view';
        
        var frm_id      = '';
        
        //var data                            = {};
        var data        = $('#frm_data_entry').serialize() + '&action='+action;
            //data.header             = {}
            //data.header.id          = id;
            //data.header.status      = type;
            //data.header.username    = $(this).attr('aria-username');

        btn_text = "Save";
 
      
        if(confirm("Are you sure you want to submit this record?")){


            $.ajax({
                url: url,
                type: "POST",
                data: data,
                dataType: "JSON",
                beforeSend : function(){
                    $(".outside_button *").css('pointer-events','none');
                     btn.text('Processing...');
                    btn.attr('disabled','disabled');

                },
            }).done(function (data) {
                   
                    //alert(Object.keys(data.messages).length);
                    if (data.success === true){
                        
                        var msg_html    = '';
                        var arr         = [];
                        for (var i = 0; i <= data.messages.length - 1; i++) {
                            for (var element in data.messages[i]) {
                                arr.push(data.messages[i][element]);
                                msg_html += data.messages[i][element] + '\n';
                            }//end for
                        }//End for

                        $.notify(msg_html,{ 
                            position:"top center",
                            className:"success",
                            arrowShow : true
                        });


                        view_url += data.data.id+'?side_menu='+side_menu;
                        setTimeout(function(){
                            window.location.replace(view_url);;
                            btn.text(btn_text);
                            btn.removeAttr('disabled');
                        },2000)

                        
                        //load_record(0,type,type+'_container',type+'_pagination',type+'_loader');
                        //$(frm_id+' input[name=header\\[id\\]').val('');
                        //$(frm_id+' input[name=header\\[name\\]').val('');

                        //load_record(0,'signup','main_container','main_pagination','main_loader');

                        

                    } else {
                        var msg_html    = '';
                        var arr         = [];
                        for (var i = 0; i <= data.messages.length - 1; i++) {
                            for (var element in data.messages[i]) {
                                arr.push(data.messages[i][element]);
                                msg_html += data.messages[i][element] + '\n';
                            }//end for
                        }//End for

                        $.notify(msg_html,{ 
                            position:"top center",
                            className:"error",
                            arrowShow : true
                        });

                        btn.text(btn_text);
                        btn.removeAttr('disabled');
                        $(".outside_button *").css('pointer-events','auto');
                    }
                }).fail(function(e){
                    alert(e.responseText);
                   

                    btn.text(btn_text);
                    btn.removeAttr('disabled');
                    $(".outside_button *").css('pointer-events','auto');
                }).always(function(e){

            });
        }//end if
    })//end if
    //end approve


    //pause
    $(document.body).on('click','.btn_deactivate, .btn_pause',function(e){
        var view_url     = homeurl + '/view/';

        var id          = $(this).attr('aria-id');
        var btn         = $(this);
        var btn_text    = '';
        var id          = $(this).attr('aria-id');
        var type        = $(this).attr('aria-type');
        var type_text   = "";

       
        var url         = homeurl;
        url             = homeurl + '/process_account';
        var url_view    = homeurl + '/view';
        
        var frm_id      = '';
        
        var data        = $('#frm_data_entry').serialize() + '&header[process_type]='+type;



        

        btn_text = "Processing...";
        
        if(type == 'renew'){
            var edit_url = homeurl + '/edit/';
            window.location.replace(edit_url+id+'?side_menu='+side_menu+'&action=renew');
        }else{
            if(confirm("Are you sure you want to "+type+" this employer?")){
                $.ajax({
                    url: url,
                    type: "POST",
                    data: data,
                    dataType: "JSON",
                    beforeSend : function(){
                        $("button").css('pointer-events','none');
                        $("a").css('pointer-events','none');
                        $("input").css('pointer-events','none');
                         btn.text('Processing...');
                        btn.attr('disabled','disabled');

                    },
                }).done(function (data) {
                       
                        //alert(Object.keys(data.messages).length);
                        if (data.success === true){
                            
                            var msg_html    = '';
                            var arr         = [];
                            for (var i = 0; i <= data.messages.length - 1; i++) {
                                for (var element in data.messages[i]) {
                                    arr.push(data.messages[i][element]);
                                    msg_html += data.messages[i][element] + '\n';
                                }//end for
                            }//End for

                            $.notify(msg_html,{ 
                                position:"top center",
                                className:"success",
                                arrowShow : true
                            });

                            if(side_menu == 'side_account_management'){
                                view_url = baseurl + '/account_management';
                            }else if(side_menu == 'side_account_management_active'){
                                view_url = baseurl + '/active';
                            }else if(side_menu == 'side_account_management_inactive'){
                                view_url = baseurl + '/inactive';
                            }else if(side_menu == 'side_account_management_paused'){
                                view_url = baseurl + '/paused';
                            }//end if
                            
                            setTimeout(function(){
                                window.location.replace(view_url);;
                                btn.text(btn_text);
                                btn.removeAttr('disabled');
                            },2000)

                            
                            //load_record(0,type,type+'_container',type+'_pagination',type+'_loader');
                            //$(frm_id+' input[name=header\\[id\\]').val('');
                            //$(frm_id+' input[name=header\\[name\\]').val('');

                            //load_record(0,'signup','main_container','main_pagination','main_loader');

                            

                        } else {
                            var msg_html    = '';
                            var arr         = [];
                            for (var i = 0; i <= data.messages.length - 1; i++) {
                                for (var element in data.messages[i]) {
                                    arr.push(data.messages[i][element]);
                                    msg_html += data.messages[i][element] + '\n';
                                }//end for
                            }//End for

                            $.notify(msg_html,{ 
                                position:"top center",
                                className:"error",
                                arrowShow : true
                            });

                            btn.text(btn_text);
                            btn.removeAttr('disabled');
                            $("button").css('pointer-events','auto');
                            $("a").css('pointer-events','auto');
                            $("input").css('pointer-events','auto');
                        }
                    }).fail(function(e){
                        alert(e.responseText);
                       

                        btn.text(btn_text);
                        btn.removeAttr('disabled');
                        $("button").css('pointer-events','auto');
                        $("a").css('pointer-events','auto');
                        $("input").css('pointer-events','auto');
                    }).always(function(e){

                });
            }//end if
        }//end if
        
    })//end if


    //archive
    $(document.body).on('click','.btn_archive',function(e){
        var view_url     = homeurl + '/view/';

        var id          = $(this).attr('aria-id');
        var btn         = $(this);
        var btn_text    = '';
        var id          = $(this).attr('aria-id');
        var type        = $(this).attr('aria-type');
        var type_text   = "";

       
        var url         = homeurl;
        url             = homeurl + '/archive';
        var url_view    = homeurl + '/view';
        
        var frm_id      = '';
        
        var data        = $('#frm_data_entry').serialize() + '&header[process_type]='+type;



        

        btn_text = "Archive";
      
        if(confirm("Archiving this employer will remove all the user linked to it. Are you sure you want to continue?")){
            $.ajax({
                url: url,
                type: "POST",
                data: data,
                dataType: "JSON",
                beforeSend : function(){
                    $("button").css('pointer-events','none');
                    $("a").css('pointer-events','none');
                    $("input").css('pointer-events','none');
                     btn.text('Processing...');
                     btn.attr('disabled','disabled');

                },
            }).done(function (data) {
                   
                    //alert(Object.keys(data.messages).length);
                    if (data.success === true){
                        
                        var msg_html    = '';
                        var arr         = [];
                        for (var i = 0; i <= data.messages.length - 1; i++) {
                            for (var element in data.messages[i]) {
                                arr.push(data.messages[i][element]);
                                msg_html += data.messages[i][element] + '\n';
                            }//end for
                        }//End for

                        $.notify(msg_html,{ 
                            position:"top center",
                            className:"success",
                            arrowShow : true
                        });

                        if(side_menu == 'side_account_management'){
                            view_url = baseurl + '/account_management';
                        }else if(side_menu == 'side_account_management_active'){
                            view_url = baseurl + '/active';
                        }else if(side_menu == 'side_account_management_inactive'){
                            view_url = baseurl + '/inactive';
                        }else if(side_menu == 'side_account_management_paused'){
                            view_url = baseurl + '/paused';
                        }//end if
                        
                        setTimeout(function(){
                            window.location.replace(view_url);;
                            btn.text(btn_text);
                            btn.removeAttr('disabled');
                        },2000)

                        
                        //load_record(0,type,type+'_container',type+'_pagination',type+'_loader');
                        //$(frm_id+' input[name=header\\[id\\]').val('');
                        //$(frm_id+' input[name=header\\[name\\]').val('');

                        //load_record(0,'signup','main_container','main_pagination','main_loader');

                        

                    } else {
                        var msg_html    = '';
                        var arr         = [];
                        for (var i = 0; i <= data.messages.length - 1; i++) {
                            for (var element in data.messages[i]) {
                                arr.push(data.messages[i][element]);
                                msg_html += data.messages[i][element] + '\n';
                            }//end for
                        }//End for

                        $.notify(msg_html,{ 
                            position:"top center",
                            className:"error",
                            arrowShow : true
                        });

                        btn.text(btn_text);
                        btn.removeAttr('disabled');
                        $("button").css('pointer-events','auto');
                        $("a").css('pointer-events','auto');
                        $("input").css('pointer-events','auto');
                    }
                }).fail(function(e){
                    alert(e.responseText);
                   

                    btn.text(btn_text);
                    btn.removeAttr('disabled');
                    $("button").css('pointer-events','auto');
                    $("a").css('pointer-events','auto');
                    $("input").css('pointer-events','auto');
                }).always(function(e){

            });
        }//end if
        
        
    })//end if
    //end archive


    //load industry autocomplete
    $(document.body).on('focus','input[id=header\\[industry_text\\]]',function(){
        if(!$(this).hasClass('wauto')){
            load_industry_autocomplete($(this),$('input[name=header\\[industry\\]]'));
            $(this).addClass('wauto');
        }//End if
    })//focus
    $(document.body).on('blur','input[id=header\\[industry_text\\]]',function(){
        if($(this).val() == ""){
            $('input[name=header\\[industry\\]]').val('');
        }//end if

        if($('input[name=header\\[industry\\]]').val() == ''){
            $(this).val('');
        }//end if
    })//blur

    //location change
    $(document.body).on('change','select[name=header\\[location\\]]',function(){
        $('input[name=header\\[country\\]]').val($(this).val());
    })//blur
    //end location change



    //=====================================================================================================================
    //end events

    


    

    //sourcing
    //=======================================================================================================================
    //load data
    function load_data(param){
        var url         = homeurl + '/load_data/'+param.id;
        var btn         = $('.btn_submit');
        var btn_deactivate = $('.btn_deactivate');
        var btn_pause = $('.btn_pause');
        var btn_text    = 'Save';
        $.ajax({
            url: url,
            type: "POST",
            dataType: "JSON",
            beforeSend : function(){
                $(".outside_button *").css('pointer-events','none');
                //$('#'+loader+'').html('<div class="col-12 text-center"><div class="spinner-grow text-muted"></div></div>');
                btn.html('<div class="spinner-grow"></div>');
            },
        }).done(function (response) {

            if(response.data !== null){
                if(dropdown_loaded == 0){
                    load_filter_dropdowns();    
                }//end if

                var data = response.data[0];
                
                

                if(param.mode == 'edit' || param.mode == 'view'){
                    //view and edit mode
                    //----------------------------------------------------------------------------------------------------
                        if(parseInt(data.expired)){

                            btn_deactivate.text('Renew');
                            btn_deactivate.attr('aria-type','renew');

                            btn_pause.addClass('d-none');

                            if(param.mode == 'edit'){
                                btn_deactivate.addClass('d-none');
                            }
                        }else{
                            if(parseInt(data.deactivated)){
                                btn_deactivate.text('Reactivate');
                                btn_deactivate.attr('aria-type','reactivate');

                            }//end if
                        }
                        

                        if(parseInt(data.paused)){
                            btn_pause.text('Resume');
                            btn_pause.attr('aria-type','resume');
                        }//end if

                        $('#frm_data_entry input[name=header\\[doc_image\\]]').val(data.doc_image);
                        $('#frm_data_entry input[name=file\\[old_doc_image\\]]').val(data.doc_image);
                        $('#frm_data_entry input[name=header\\[company_name\\]]').val(data.company_name);
                        $('.company_name_breadcrumbs').html(data.company_name);
                        $('#frm_data_entry textarea[name=header\\[about\\]]').val(data.about);
                        // var str = data.about;
                        // var rows = (str.length / 41);
                        //     rows = Math.ceil(rows);
                        
                            
                        // $('#frm_data_entry textarea[name=header\\[about\\]]').attr('rows',rows);

                        $('#frm_data_entry input[name=header\\[website\\]]').val(data.website);
                        $('#frm_data_entry select[name=header\\[dial_code\\]]').val(data.employer_dial_code);
                        $('#frm_data_entry input[name=header\\[contact_number\\]]').val(data.employer_contact_number);

                        $('#frm_data_entry input[name=header\\[start_date\\]]').val(data.start_date);
                        $('#frm_data_entry input[name=header\\[start_time\\]]').val(data.start_time);
                        $('#frm_data_entry input[name=header\\[end_date\\]]').val(data.end_date);
                        $('#frm_data_entry input[name=header\\[end_time\\]]').val(data.end_time);
                        $('#frm_data_entry textarea[name=header\\[other_notes\\]]').val(data.other_notes);

                        $('h6[id=header\\[company_name\\]]').html(data.company_name);
                        
                        
                        $('p[id=header\\[location\\]]').html('<small class="text-muted">'+data.location+'</small>');

                        

                        
                        $('#frm_data_entry input[name=header\\[country\\]]').val(data.country);
                        $('#frm_data_entry select[name=header\\[industry\\]]').multiselect('select',data.industry);
                        $('#frm_data_entry input[name=placeholder\\[industry\\]]').val(data.industry_text);

                        $('#frm_data_entry select[name=header\\[location\\]]').multiselect('select',data.location);
                        $('#frm_data_entry input[name=placeholder\\[location\\]]').val(data.location);
                        //$('#frm_data_entry input[name=header\\[industry\\]]').val(data.industry);
                        //$('#frm_data_entry input[id=header\\[industry_text\\]]').val(data.industry_text);



                        $('p[id=header\\[date_created\\]]').html('<small class="text-muted">Joined '+data.joined_date+'</small>');
                        
                        if(data.doc_image === null || data.doc_image == ""){
                            $('img[id=header\\[company_logo\\]]').attr('src',urlimgdef); 
                        }else{
                            $('img[id=header\\[company_logo\\]]').attr('src',upload_path+data.doc_image);
                        }//end if

                        //contact person

                        $('#frm_data_entry input[name=signup\\[id\\]]').val(data.signup);
                        $('#frm_data_entry select[name=signup\\[honorifics\\]]').val(data.honorifics);
                        $('#frm_data_entry input[name=signup\\[first_name\\]]').val(data.first_name);
                        $('#frm_data_entry input[name=signup\\[last_name\\]]').val(data.last_name);
                        $('#frm_data_entry input[name=signup\\[designation\\]]').val(data.designation);
                        $('#frm_data_entry input[name=signup\\[work_email\\]]').val(data.work_email);
                        $('#frm_data_entry select[name=signup\\[dial_code\\]]').val(data.dial_code);
                        $('#frm_data_entry input[name=signup\\[contact_number\\]]').val(data.contact_number);
                        //end contact person
                        
                       

                        //populate lines
                        var html            = ''
                        var html_form       = '';
                        var total_size      = 0;
                        var total_files     = 0;
                        var data_lines  = response.data;
                        for(var key in data_lines){
                            var src = "";
                            if(data_lines[key].line_doc_image === null || data_lines[key].line_doc_image == ""){
                                continue;
                                src = urlimgdef;
                            }else{
                                src = upload_path+data_lines[key].line_doc_image;;   
                            }//end if
                            total_files += 1;
                            total_size += catchIsNaN(data_lines[key]['line_file_size']);;
                           
                            html += '<div class="col mb-3">';
                                
                                html += '<button aria-line="'+data_lines[key]['line']+'" type="button" class="close remove to_hide" aria-label="Close">';
                                  html += '<span aria-hidden="true" class="text-danger">&times;</span>';
                                html += '</button>';

                                html += '<img src="'+src+'" class="img-fluid rounded" style="width:200px;height:150px;">';
                            html += '</div><!--./col-->';

                            html_form += '<div class="col mb-3 remove-'+data_lines[key]['line']+' d-none">';
                                html_form += '<input readonly name="row[line][]" value="'+data_lines[key]['line']+'" class="form-control form-control-sm" />';
                                html_form += '<input readonly name="row[doc_image][]" value="'+data_lines[key]['line_doc_image']+'" class="form-control form-control-sm" />';
                                html_form += '<input readonly name="row[file_size][]" value="'+data_lines[key]['line_file_size']+'" class="form-control form-control-sm" />'
                                html_form += '<input readonly name="row[doc_content][]" value="" class="form-control form-control-sm" />';
                            html_form += '</div><!--./col-->';
                        }//end for

                        $('input[name=file\\[total_uploaded_file\\]]').val(total_size.toFixed(2));
                        $('input[name=file\\[total_files\\]]').val(total_files);

                        $('#image_cont').append(html);
                        $('#image_cont_form').append(html_form);
                        autosize($('.evw-textarea'));
                        //end populate lines
                    //----------------------------------------------------------------------------------------------------
                    //end view and edit mode
                }else{
                    //add mode
                    //----------------------------------------------------------------------------------------------------
                    $('img[id=header\\[company_logo\\]]').attr('src',urlimgdef); 
                    //----------------------------------------------------------------------------------------------------
                    //end add mode
                }//end if

                


                if(param.mode == 'view'){

                    $('#frm_data_entry > .edit_view input:not([readonly]),#frm_data_entry > .edit_view textarea:not([readonly]),#frm_data_entry > .edit_view select,button').addClass(param.mode);
                    //$('#frm_data_entry input:not([readonly]),textarea:not([readonly]),select').addClass('form-control-plaintext');
                    
                    $('.to_hide').addClass('d-none');
                    //$('#frm_data_entry .tooltip_icon').addClass('d-none');


                    $('#frm_data_entry > .edit_view .input-group-append').addClass('d-none');
                    $('#frm_data_entry > .edit_view select.'+param.mode+'').removeClass('custom-select');
                    $('#frm_data_entry > .edit_view input.'+param.mode+',#frm_data_entry > .edit_view textarea.'+param.mode+',#frm_data_entry > .edit_view select.'+param.mode+'').removeClass('form-control');
                    $('#frm_data_entry > .edit_view input.'+param.mode+',#frm_data_entry > .edit_view textarea.'+param.mode+',#frm_data_entry > .edit_view select.'+param.mode+'').addClass('form-control-plaintext');
                    $('#frm_data_entry > .edit_view input.'+param.mode+',#frm_data_entry > .edit_view textarea.'+param.mode+',#frm_data_entry > .edit_view select.'+param.mode+'').prop('disabled',true);
                    $('#frm_data_entry > .edit_view input[name^=placeholder]').removeClass('d-none');
                    //$('#frm_data_entry > .edit_view button').addClass('d-none');


                    $('#frm_data_entry > .disable_view input:not([readonly]),#frm_data_entry > .disable_view textarea:not([readonly]),#frm_data_entry > .disable_view select,button').addClass(param.mode);
                    $('#frm_data_entry > .disable_view .input-group-append').addClass('d-none');
                    $('#frm_data_entry > .disable_view select.'+param.mode+'').removeClass('custom-select');
                    $('#frm_data_entry > .disable_view button.'+param.mode+',#frm_data_entry > .disable_view input.'+param.mode+',#frm_data_entry > .disable_view textarea.'+param.mode+',#frm_data_entry > .disable_view select.'+param.mode+'').removeClass('form-control');
                    $('#frm_data_entry > .disable_view button.'+param.mode+',#frm_data_entry > .disable_view input.'+param.mode+',#frm_data_entry > .disable_view textarea.'+param.mode+',#frm_data_entry > .disable_view select.'+param.mode+'').addClass('form-control-plaintext');
                    $('#frm_data_entry > .disable_view button.'+param.mode+',#frm_data_entry > .disable_view input.'+param.mode+',#frm_data_entry > .disable_view textarea.'+param.mode+',#frm_data_entry > .disable_view select.'+param.mode+'').prop('disabled',true);
                    $('#frm_data_entry > .disable_view input[name^=placeholder]').removeClass('d-none');
                    $('#frm_data_entry > .disable_view button').addClass('d-none');

                    $('.evw-asterisk').addClass('d-none');
                    //$('.btn_submit').addClass('d-none');

                }else if(param.mode == 'edit'){

                    $('#frm_data_entry > .disable_view input:not([readonly]),#frm_data_entry > .disable_view textarea:not([readonly]),#frm_data_entry > .disable_view select,button').addClass(param.mode);
                    $('#frm_data_entry > .disable_view .input-group-append').addClass('d-none');
                    $('#frm_data_entry > .disable_view select.'+param.mode+'').removeClass('custom-select');
                    $('#frm_data_entry > .disable_view button.'+param.mode+',#frm_data_entry > .disable_view input.'+param.mode+',#frm_data_entry > .disable_view textarea.'+param.mode+',#frm_data_entry > .disable_view select.'+param.mode+'').removeClass('form-control');
                    $('#frm_data_entry > .disable_view button.'+param.mode+',#frm_data_entry > .disable_view input.'+param.mode+',#frm_data_entry > .disable_view textarea.'+param.mode+',#frm_data_entry > .disable_view select.'+param.mode+'').addClass('form-control-plaintext');
                    $('#frm_data_entry > .disable_view button.'+param.mode+',#frm_data_entry > .disable_view input.'+param.mode+',#frm_data_entry > .disable_view textarea.'+param.mode+',#frm_data_entry > .disable_view select.'+param.mode+'').prop('readonly',true);
                    $('#frm_data_entry > .disable_view button.'+param.mode+',#frm_data_entry > .disable_view input.'+param.mode+',#frm_data_entry > .disable_view textarea.'+param.mode+',#frm_data_entry > .disable_view select.'+param.mode+'').css('pointer-events','none');
                    $('#frm_data_entry > .disable_view input[name^=placeholder]').removeClass('d-none');
                    $('#frm_data_entry > .disable_view button').addClass('d-none');
                }//end if

                btn.html(btn_text);
                $(".outside_button *").css('pointer-events','auto');
            }else{
                //add mode
                //----------------------------------------------------------------------------------------------------
                $('img[id=header\\[company_logo\\]]').attr('src',urlimgdef);
                btn.html(btn_text);
                $(".outside_button *").css('pointer-events','auto');
                //----------------------------------------------------------------------------------------------------
                //end add mode
            }//end if

            if(dropdown_loaded == 0){
                load_filter_dropdowns();    
            }//end if

            $('#loading').hide();
        }).fail(function(e){
            alert(e.responseText);
            btn.html(btn_text);
            $('#loading').hide();
        }).always(function(e){

        });
    }//end load_record
    //=======================================================================================================================
    //end load data


    //autocomplete
    //===============================================================================================================================
    function load_dropdowns(type){
        
        $('select[name=header\\['+type+'\\]]').multiselect({
            enableFiltering : true,
            //selectAllValue: 'multiselect-all',
            //selectAllText: 'Select All',
            //includeSelectAllOption : true,
            
            maxHeight: 300,
            enableCaseInsensitiveFiltering : true
       });
    }//end function



    //load dropdown
    function load_dropdown(url,dropdown,type){
        //var url     = baseurl + "/get/signup/industry/0";
        $.ajax({
            url: url,
            type: "POST",
            dataType: "JSON",
            async : false,
            beforeSend : function(){
              
            },
        }).done(function (response) {
            
            var html = '<option value="">Select</option>';

            for(var key in response.data){
                if(response.data[key].job_title !== undefined){
                    html += '<option value="'+response.data[key].job_title+'">'+response.data[key].job_title+'</option>';    
                }else if(response.data[key].language !== undefined){
                    html += '<option value="'+response.data[key].language+'">'+response.data[key].language+'</option>';    
                }else if(response.data[key].skills !== undefined){
                    html += '<option value="'+response.data[key].skills+'">'+response.data[key].skills+'</option>';    
                }else{
                    if(type == 'location'){
                        html += '<option value="'+response.data[key].name+'">'+response.data[key].name+'</option>';
                    }else{
                        html += '<option value="'+response.data[key].id+'">'+response.data[key].name+'</option>';
                    }//end if
                    
                }//end if
                
                
            }//end for
            dropdown.html(html);

        }).fail(function(e){
            alert(e.responseText);
            
        }).always(function(e){

        });
        /*html.autocomplete({
            serviceUrl: url,
            type : 'GET',
            dataType : 'json',
            showNoSuggestionNotice: true,
            noSuggestionNotice: 'Sorry, no matching results',
            autoSelectFirst : true,
            triggerSelectOnValidInput : true,
            orientation : 'auto',
            transformResult: function(response) {
                return {
                    suggestions: $.map(response.data, function(dataItem) {
                        if (dataItem.name.toLowerCase().indexOf(html.val().toLowerCase()) > -1) {
                           return { value: dataItem.name, data: dataItem.id }; 
                        }//end if
                    })
                };  
            },
            onSelect: function(suggestion) {
                html_id.val(suggestion.data);

            },

            onSearchComplete : function (query, suggestions) {
                if(suggestions.length == 0){
                    html_id.val('');
                }//end if


            }
        }).blur(function(){
            if(html_id.val() == ''){
                html.val('');
            }
        });*/
    }

   
    function load_filter_dropdowns(){
        var url     = baseurl + "/get/signup/industry/0";
        var dropdown    = $('select[name=header\\[industry\\]]');
        load_dropdown(url,dropdown,'industry')
        load_dropdowns('industry');

        var url         = baseurl + "/get/job_post/olocation";
        var dropdown    = $('select[name=header\\[location\\]]');
        load_dropdown(url,dropdown,'location')
        load_dropdowns('location');

        dropdown_loaded = 1;
    }//end function

    //Customer autocomplete
    function load_industry_autocomplete(html,html_id){
        var url     = baseurl + "/get/signup/industry/0";
        html.autocomplete({
            serviceUrl: url,
            type : 'GET',
            dataType : 'json',
            showNoSuggestionNotice: true,
            noSuggestionNotice: 'Sorry, no matching results',
            autoSelectFirst : true,
            triggerSelectOnValidInput : true,
            orientation : 'auto',
            transformResult: function(response) {
                return {
                    suggestions: $.map(response.data, function(dataItem) {
                        if (dataItem.name.toLowerCase().indexOf(html.val().toLowerCase()) > -1) {
                           return { value: dataItem.name, data: dataItem.id }; 
                        }//end if
                    })
                };  
            },
            onSelect: function(suggestion) {
                html_id.val(suggestion.data);
            },

            onSearchComplete : function (query, suggestions) {
                if(suggestions.length == 0){
                    html_id.val('');
                }//end if

            }
        }).blur(function(){
            if(html_id.val() == ''){
                html.val('');
            }
        });
    }
    //===============================================================================================================================
    //end autocomplete
    //upload trigger
    $(document.body).on('click','button[name=btn_upload]',function(e){
        upload_image();
    })
    //end upload trigger

    //upload trigger multiple
    $(document.body).on('click','button[name=btn_upload_multiple]',function(e){
        upload_image_multiple();
    })
    //end upload trigger multiple

    //validate file
    $(document.body).on('change','input[name=header\\[company_file\\]\\[\\]]',function() {
        var fileInput = $(this);
        var totalSize = 0;
        fileInput.each(function() {
            for (var i = 0; i < this.files.length; i++) {
              totalSize += (this.files[i].size / 1024) / 1024;
            }//end for
        });

        if (totalSize > 40) {
            var msg_html = "Max file size of 40MB exceeded!"
            $.notify(msg_html,{ 
                position:"top center",
                className:"error",
                arrowShow : true
            });
        }//end if



    });
    //validate file

    //remove trigger
    $(document.body).on('click','button[name=btn_remove]',function(e){
        
        $('img[id=header\\[company_logo\\]]').attr('src',(urlimgdef));
        $('input[name=file\\[doc_content\\]]').val('');
        $('input[name=header\\[doc_image\\]]').val('');
        //$('input[name=header\\[doc_image\\]]').val('');
    })
    //end remove trigger

    //remove trigger
    $(document.body).on('click','.remove',function(e){
        
        var line = $(this).attr('aria-line');

        $(this).parent().remove();
        $('.remove-'+line).remove();


        var total_size = 0;
        $('input[name=row\\[file_size\\]\\[\\]]').each(function(){
            total_size += catchIsNaN($(this).val());
        })
        $('input[name=file\\[total_uploaded_file\\]]').val(total_size.toFixed(2));
        $('input[name=file\\[total_files\\]]').val($('input[name=row\\[line\\]\\[\\]]').length);
    })
    //end remove trigger

    //remove trigger
    $(document.body).on('click','button[name=btn_remove_multiple]',function(e){
        
        $('#image_cont_form').empty();
        $('#image_cont').empty();
        var total_size = 0;
        $('input[name=row\\[file_size\\]\\[\\]]').each(function(){
            total_size += catchIsNaN($(this).val());
        })
        $('input[name=file\\[total_uploaded_file\\]]').val(total_size.toFixed(2));
        $('input[name=file\\[total_files\\]]').val($('input[name=row\\[line\\]\\[\\]]').length);
    })
    //end remove trigger
    //Upload image
    //===============================================================================================================================
        //upload image
        function  upload_image(){
            var url         = homeurl + '/do_upload';
            var btn         = $('button[name=btn_upload]');
            var formData    = new FormData($("#frm_data_entry")[0]);

            
                //formData.append('action', action);
            $.ajax({
                url : url,  // Controller URL
                type : 'POST',
                data : formData,
                async : false,
                cache : false,
                contentType : false,
                processData : false,
                dataType : 'JSON',
                beforeSend : (function (data){
                     
                     btn.html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Processing...');
                     btn.attr('disabled','disabled');
                })
            }).done(function (data) {
                
               
                if(data.success === true){

                    var file = data.data.file[0];
                    

                    setTimeout(function(){
                    
                        btn.html('Upload Image');
                        btn.removeAttr('disabled');
                        $('input[name=file\\[doc_content\\]]').val(file.file);
                        $('img[id=header\\[company_logo\\]]').attr('src',"data:image/jpeg;base64, "+file.file);
                        $('input[name=header\\[doc_image\\]]').val(file.file_attr.name);
                        //$(form+' img#patientimg').attr('src',"data:image/jpeg;base64, "+data.header.file);
                    },2000)
                }else{
                    setTimeout(function(){

                        var msg_html    = '';
                        var arr         = [];
                        for (var i = 0; i <= data.messages.length - 1; i++) {
                            for (var element in data.messages[i]) {
                                arr.push(data.messages[i][element]);
                                msg_html += data.messages[i][element] + '\n';
                            }//end for
                        }//End for

            
                        $.notify(msg_html,{ 
                            position:"top center",
                            className:"error",
                            arrowShow : true
                        });
                        btn.html('Upload Image');
                        btn.removeAttr('disabled');
                    },2000)
                }
                
                
            }).fail(function(data){
                alert(JSON.stringify(data));
                //setTimeout(function(){
                        
                    //$('#uploadErrorCont').html(data.responseText)
                    btn.html('Upload Image');
                    btn.removeAttr('disabled');
                //},2000)
            }).always(function(e){

            });
        }
        //End upload image

        //upload image multiple
        function  upload_image_multiple(){
            var url         = homeurl + '/do_upload_multiple';
            var btn         = $('button[name=btn_upload_multiple]');
            var formData    = new FormData($("#frm_data_entry")[0]);

            
                //formData.append('action', action);
            $.ajax({
                url : url,  // Controller URL
                type : 'POST',
                data : formData,
                async : false,
                cache : false,
                contentType : false,
                processData : false,
                dataType : 'JSON',
                beforeSend : (function (data){
                     
                     btn.html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Processing...');
                     btn.attr('disabled','disabled');
                })
            }).done(function (data) {
                
               
                if(data.success === true){

                    var files = data.data.file;
                    var urlimg200x150 = 'https://dummyimage.com/200x150/dee2e6/6c757d.jpg';
                    var html        = '';
                    var html_form   = '';

                    setTimeout(function(){
                    
                        btn.html('Upload Image');
                        btn.removeAttr('disabled');
                        var total_files = catchIsNaN($('input[name=file\\[total_files\\]]').val());
                        var total_size = catchIsNaN($('input[name=file\\[total_uploaded_file\\]]').val());

                        
                        var ctr = $('input[name=row\\[line\\]\\[\\]]:last').val() === undefined? 1 : parseInt($('input[name=row\\[line\\]\\[\\]]:last').val())+1;
                        for(var key in files){
                            var file = files[key];
                            html += '<div class="col mb-3">';
                                html += '<button aria-line="'+ctr+'" type="button" class="close remove" aria-label="Close">';
                                    html += '<span aria-hidden="true" class="text-danger">&times;</span>';
                                html += '</button>';
                                html += '<img src="data:image/jpeg;base64,'+file.file+'" class="img-fluid rounded" style="width:200px;height:150px;">';
                            
                            html += '</div><!--./col-->';

                            html_form += '<div class="col mb-3 remove-'+ctr+' d-none">';

                                html_form += '<input readonly name="row[line][]" value="'+ctr+'" class="form-control form-control-sm" />';
                                html_form += '<input readonly name="row[doc_image][]" value="'+file.file_attr.name+'" class="form-control form-control-sm" />';
                                html_form += '<input readonly name="row[file_size][]" value="'+file.file_attr.file_size+'" class="form-control form-control-sm" />'
                                html_form += '<input readonly name="row[doc_content][]" value="'+file.file+'" class="form-control form-control-sm" />';
                                
                            html_form += '</div><!--./col-->';

                            total_size += parseFloat(file.file_attr.file_size);

                            total_files += 1;
                            ctr += 1;
                           //console.log(file['file_attr'].name) + '<br/>';
                        }//end for



                        
                        
                        $('#image_cont').append(html);
                        $('#image_cont_form').append(html_form);

                        total_size = 0;
                        $('input[name=row\\[file_size\\]\\[\\]]').each(function(){
                            total_size += catchIsNaN($(this).val());
                        })

                        $('input[name=file\\[total_uploaded_file\\]]').val(total_size.toFixed(2));

                        $('input[name=file\\[total_files\\]]').val($('input[name=row\\[line\\]\\[\\]]').length);
                        
                    },2000)
                }else{
                    setTimeout(function(){

                        var msg_html    = '';
                        var arr         = [];
                        for (var i = 0; i <= data.messages.length - 1; i++) {
                            for (var element in data.messages[i]) {
                                arr.push(data.messages[i][element]);
                                msg_html += data.messages[i][element] + '\n';
                            }//end for
                        }//End for

            
                        $.notify(msg_html,{ 
                            position:"top center",
                            className:"error",
                            arrowShow : true
                        });
                        btn.html('Upload Image');
                        btn.removeAttr('disabled');
                    },2000)
                }
                
                
            }).fail(function(data){
                alert(JSON.stringify(data));
                //setTimeout(function(){
                        
                    //$('#uploadErrorCont').html(data.responseText)
                    btn.html('Upload Image');
                    btn.removeAttr('disabled');
                //},2000)
            }).always(function(e){

            });
        }
        //End upload image

        
    //===============================================================================================================================
    //End upload image













    //modal
     $('#archived_modal').on('shown.bs.modal',function(e){

        //Set Title
        var param   = {};
        var title   = 'Archived Users'
        var type    = $(e.relatedTarget).data('type');
        
        

       //param.id    = user_id;
        //param.type  = type;
        //alert(id)
        $('#archived_modal_title').html(title);
        load_record(0,'user_archived','archived_container','archived_pagination','archived_loader');



        //$('#btnOk').html('<span class="spinner-grow spinner-grow-sm"></span></span> Loading...');
        //$('#btnOk').attr('disabled','disabled');

        //var html_table      = load_preference_form(param);
        //$('#archived_modal_body').html(html_table);
        //load_industry_autocomplete();



    });

    $('#archived_modal').on('hide.bs.modal',function(e){
        //$('#archived_modal_title').empty();
        //$('#archived_modal_body').empty();
    })
    //end modal

});//End document.ready

