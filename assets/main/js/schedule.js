

$(document).ready(function(){
    //highlight
    $('#side_schedule').removeClass('text-muted');
    $('#side_schedule').addClass('active');
    $('#side_schedule').css({'opacity': 0.8, "background-color": "rgb(0, 41, 170)"});
    //end highlight

    if ($(window).width() >= 1441 ) {
        $('.container-fluid').css({'max-width': '1440px'});
    } else if ($(window).width() >= 1360 && $(window).width() <= 1440) {
        $('.container-fluid').css({'max-width': '1350px'});
    } else if ($(window).width() >= 1200 && $(window).width() <= 1359) {
        $('.container-fluid').css({'max-width': '1200px'});
    }

    $('input[name=header\\[date_filter\\]]').datetimepicker({
        format: 'M/D/YYYY'

    });

    var homeurl     = baseurl + '/schedule';
    var homeurl_txt = 'schedule';
    var urlimgdef       = baseurl + '/files/images/default/image.png';
    var upload_path     = baseurl + '/files/uploads/';

    load_record(0,'employer','main_container','main_pagination','main_loader');

    //load record
    function load_record(page,type,container,pagination,loader){
        var edit_url = baseurl + '/schedule/edit/';
        var view_url = baseurl + '/schedule/view/';
        var user_url  = baseurl + '/user';

        var job_post_edit_url = baseurl + '/job_post_copy/edit/';
        var job_post_copy_url = baseurl + '/job_post_copy/copy/';
        var applicant_url     = baseurl + '/applicant_search/view/applied/';

        var data                = {};
            data.page           = page;
            data.keyword        = $('input[name=header\\[keyword\\]]').val();
            data.user_id        = user_id;
            data.employer_id    = employer_id;
            data.date_filter    = $('input[name=header\\[date_filter\\]]').val();

           

           

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

                        var img_src = "";
                        if(value.doc_image === null || value.doc_image == ""){
                           
                            img_src = urlimgdef;
                        }else{
                          
                            img_src = upload_path+value.doc_image;

                        }//end if


                        html += '<div class="row mb-3">';
                            html += '<div class="col">';
                                html += '<div class="card">';
                                    html += '<div class="card-body">';
                                        html += '<div class="row">';
                                            
                                            
                                            //html += '<div class="col-3">';
                                                //html += '<img class="rounded-circle" style="height:0.5in;width:0.5in;" src="'+img_src+'" alt="Card image cap"><br/>'+value.name;
                                            //html += '</div><!--./col-->';
                                            html += '<div class="col-1" style="min-width:0.8in;">';
                                                html += '<img class="rounded-circle" style="height:0.7in;width:0.7in;" src="'+img_src+'" alt="Card image cap"/>';
                                            html += '</div><!--./col-->';
                                            html += '<div class="col align-self-center text-link" style="min-width:1in;">';
                                                html += '<a style="text-decoration:none;" href="'+applicant_url+value.user_id+'?job_post='+value.job_post_id+'&mod_type=side_schedule" class="text-link">'+value.name+'</a>';
                                            html += '</div><!--./col-->';
                                            html += '<div class="col align-self-center text-left">';
                                                html += value.interview_date_txt;
                                            html += '</div><!--./col-->';
                                            html += '<div class="col align-self-center text-left">';
                                                html += value.interview_start_time;
                                            html += '</div><!--./col-->';

                                            if ($(window).width() <= 1440 && $(window).width() >= 1380) {
                                                var job_title_placeholder           = value.job_title.substring(0,20);
                                                var job_title_placeholder_length    = value.job_title.length;
                        
                                                if(job_title_placeholder_length > 20){
                                                    job_title_placeholder = job_title_placeholder+'...';
                                                    html += '<div class="col align-self-center text-left"><h5 style="font-size: 15px; font-weight: 400; font-family: Be Vietnam Pro, sans-serif; margin-top: auto; margin-bottom: auto;" class="text-break" data-schedjob="'+value.job_title+'">';
                                                        html += job_title_placeholder;
                                                    html += '</h5></div><!--./col-->';
                                                } else {
                                                    html += '<div class="col align-self-center text-left">';
                                                        html += value.job_title;
                                                    html += '</div><!--./col-->';
                                                }
                                            } else if ($(window).width() <= 1379 && $(window).width() >= 1281) {
                                                var job_title_placeholder           = value.job_title.substring(0,20);
                                                var job_title_placeholder_length    = value.job_title.length;
                        
                                                if(job_title_placeholder_length > 20){
                                                    job_title_placeholder = job_title_placeholder+'...';
                                                    html += '<div class="col align-self-center text-left"><h5 style="font-size: 15px; font-weight: 400; font-family: Be Vietnam Pro, sans-serif; margin-top: auto; margin-bottom: auto;" class="text-break" data-schedjob="'+value.job_title+'">';
                                                        html += job_title_placeholder;
                                                    html += '</h5></div><!--./col-->';
                                                } else {
                                                    html += '<div class="col align-self-center text-left">';
                                                        html += value.job_title;
                                                    html += '</div><!--./col-->';
                                                }
                                            } else if ($(window).width() <= 1280 && $(window).width() >= 1025) {
                                                var job_title_placeholder           = value.job_title.substring(0,24);
                                                var job_title_placeholder_length    = value.job_title.length;
                        
                                                if(job_title_placeholder_length > 24){
                                                    job_title_placeholder = job_title_placeholder+'...';
                                                    html += '<div class="col align-self-center text-left"><h5 style="font-size: 15px; font-weight: 400; font-family: Be Vietnam Pro, sans-serif; margin-top: auto; margin-bottom: auto;" class="text-break" data-schedjob="'+value.job_title+'">';
                                                        html += job_title_placeholder;
                                                    html += '</h5></div><!--./col-->';
                                                } else {
                                                    html += '<div class="col align-self-center text-left">';
                                                        html += value.job_title;
                                                    html += '</div><!--./col-->';
                                                }
                                            } else {
                                                var job_title_placeholder           = value.job_title.substring(0,22);
                                                var job_title_placeholder_length    = value.job_title.length;
                        
                                                if(job_title_placeholder_length > 22){
                                                    job_title_placeholder = job_title_placeholder+'...';
                                                    html += '<div class="col align-self-center text-left"><h5 style="font-size: 15px; font-weight: 400; font-family: Be Vietnam Pro, sans-serif; margin-top: auto; margin-bottom: auto;" class="text-break" data-schedjob="'+value.job_title+'">';
                                                        html += job_title_placeholder;
                                                    html += '</h5></div><!--./col-->';
                                                } else {
                                                    html += '<div class="col align-self-center text-left">';
                                                        html += value.job_title;
                                                    html += '</div><!--./col-->';
                                                }
                                            }

                                            html += '<div class="text-center col-xl-2 col-lg-2 align-self-center" style="min-width:2in;">';

                                                var w = (window.innerWidth / 2) + 160;
                                                var l = (w / 2) / 2;
                                                var h = (window.innerHeight / 2) + 160;
                                                var t = (h / 2) / 2;
                                                var disabled = "";
                                                //html += '<a target="_blank" title="edit" aria-id="'+value.id+'" onclick="window.open('+"'"+edit_url+value.user_id+'?job_post='+value.job_post_id+"'"+',\'newwindow\',\'width='+w+',height='+h+',status=0,left='+l+',top='+t+'\'); return false;" class="mr-1 btn btn-pill-sm btn-pill-sm-outline-light text-muted btn_save"><i class="fa fa-pencil-alt"></i></a>';
                                                if(value.status == 'cancelled' || value.status == 'completed'){
                                                    disabled = "disabled";
                                                }//end if
                                                html += '<button '+disabled+' title="Remove" aria-id="'+value.id+'" class="mr-2 btn btn-pill-sm btn-pill-sm-outline-light text-danger btn_remove"><i class="fa fa-times"></i></button>'; 
                                                html += '<a href="'+edit_url+value.id+'?user_id='+value.user_id+'&job_post='+value.job_post_id+''+'" class="mr-2 btn btn-pill-sm btn-pill-sm-outline-light text-muted btn_save" title="Edit"><i class="fa fa-pencil"></i></a>';
                                                html += '<a href="'+view_url+value.id+'?user_id='+value.user_id+'&job_post='+value.job_post_id+''+'" class="btn btn-pill-sm btn-pill-outline-link text-link btn_view"><i class="fa fa-calendar-check" aria-hidden="true" style="font-size: 16px"></i></a>';
                                                //html += '<div class="btn-group btn-group-toggle">';
                                                    //var btn_class= "btn-outline-dark disabled";
                                                    //html += '<button title="remove" aria-id="'+value.id+'" class="mr-1 btn btn-pill-sm btn-pill-sm-outline-light text-danger btn_remove"><i class="fa fa-times"></i></button>';
                                                    

                                                    //if(parseInt(value.applicant_count) <= 0){
                                                      
                                                       // html += '<a target="_blank" title="edit" aria-id="'+value.id+'" onclick="window.open('+"'"+job_post_edit_url+value.id+"'"+',\'newwindow\',\'width='+w+',height='+h+',status=0,left='+l+',top='+t+'\'); return false;" class="mr-1 btn btn-pill-sm btn-pill-sm-outline-light text-muted btn_save"><i class="fa fa-pencil-alt"></i></a>';

                                                    //}//end if
                                                    
                                                    //html += '<button type="button" onclick="window.open('+"'"+job_post_copy_url+value.id+"'"+',\'newwindow\',\'width='+w+',height='+h+',status=0,left='+l+',top='+t+'\'); return false;" data-id="'+value.id+'" class="btn btn-pill-sm btn-pill-sm-outline-light text-muted btn_save"><i class="fa fa-copy"></i></button>';

                                                    //html += '<a href="#" class="btn btn-pill-sm btn-pill-outline-link text-link btn_save">Save</a>';
                                                    //html += '<a href="'+view_url+value.id+'" class="btn btn-pill-sm btn-pill-outline-link text-link btn_view">View</a>';
                                                    //html += '<button aria-id="'+value.id+'" class="btn btn-pill-sm btn-pill-outline-primary text-primary btn_delete">Delete</button>';
                                                //html += '</div>';
                                            html += '</div><!--./col-->';
                                        html += '</div><!--./row-->';
                                    html += '</div><!--./card-body-->';
                                html += '</div><!--./card-->';
                            html += '</div><!--./col-->';
                        html += '</div><!--./row-->';


                        /*

                        html += '<div class="row mb-2">';
                            html += '<div class="col-4">';
                                html += '<img class="rounded" style="height:100%;width:100%;" src="'+img_src+'" alt="Card image cap">';
                                
                            html += '</div>';
                            html += '<div class="col">';
                                html += '<div class="card">';
                                     html += '<div class="card-body">';
                                        html += '<h5 class="card-title text-muted">'+value.company_name+'</h5>';
                                        html += '<h5 class="card-title text-link">'+value.job_title+'</h5>';
                                        html += '<div class="row mb-2">';
                                            html += '<div class="col-9">';
                                                html += '<small class="text-muted"><b>'+value.location+'</b></small>';
                                            html += '</div>';
                                            html += '<div class="col">';
                                                html += '<div class="text-right">';
                                                    html += '<small class="text-muted text-right">Apply Before</small>';
                                                html += '</div>';
                                                html += '<div class="text-right">';
                                                    html += '<small class="text-primary text-right"><b>'+value.job_expiration_date+'</b></small>';
                                                html += '</div>';
                                            html += '</div>';
                                        html += '</div>';

                                        html += '<div class="row mb-2">';
                                            html += '<div class="col">';
                                                html += '<div class="text-left">';
                                                    html += '<small class="text-muted">Date Posted</small>';
                                                html += '</div>';
                                                html += '<div class="text-left">';
                                                    html += '<small class="text-muted"><b>'+value.date_created+'</b></small>';
                                                html += '</div>';
                                            html += '</div>';

                                            html += '<div class="col">';
                                                html += '<div class="text-right">';
                                                    html += '<small class="text-muted">Job Type</small>';
                                                html += '</div>';
                                                html += '<div class="text-right">';
                                                    html += '<small class="text-muted"><b>'+value.job_type_text+'</b></small>';
                                                html += '</div>';
                                            html += '</div>';
                                        html += '</div>';

                                        html += '<div class="row mb-2">';
                                            html += '<div class="col">';
                                                html += '<div class="text-right">';
                                                    html += '<div class="btn-group">';
                                                        if(user_id !== 0){
                                                            var btn_attr = "";

                                                            if(parseInt(value.saved)){
                                                                btn_attr = "disabled";
                                                            }
                                                            html += '<button '+btn_attr+' class="btn btn-pill-sm btn-pill-outline-link text-link btn_add_fav" aria-id="'+value.id+'"><i class="fa fa-heart"></i></button>';
                                                        }//end if
                                                        html += '<a href="'+view_url+value.id+'" class="btn btn-pill-sm btn-pill-outline-link text-link btn_view">View</a>';
                                                    html += '</div>';
                                                html += '</div>';
                                            html += '</div>';
                                        html += '</div>';
                                        
                                    html += '</div>';
                                html += '</div>';
                            html += '</div>';
                        html += '</div>';
                        */
                        

                        
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

                        $('#more_job_related').removeClass('d-none');
                        
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
    
    // Search applicant on Enter key press
    $(document.body).on('keypress','input[name=header\\[keyword\\]]',function(e){
        if (e.which == 13) {
            $('button.btn_find').click();
            return false;
        }
    })
    
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
            load_record(page,type,type+'_container',type+'_pagination',type+'_loader'); 
        }
     
        
    });
    //end pagination button

    //filter by
    $(document.body).on('change','select[name=header\\[sort\\]]',function(e){
        load_record(0,'employer','main_container','main_pagination','main_loader');
    })//end if
    //end filter by

    //filter by
    $(document.body).on('blur','input[name=header\\[date_filter\\]]',function(e){
        
        $('.btn_find').trigger('click');
    })//end if
    //end filter by

    //find
    $(document.body).on('click','button.btn_find',function(e){

        load_record(0,'employer','main_container','main_pagination','main_loader');
    })//end if
    //end find

    //find
    $(document.body).on('blur','input[name=header\\[keyword\\]]',function(e){
        load_record(0,'employer','main_container','main_pagination','main_loader');
    })//end if
    //end find

    //find; Refreshing the result/s when the search word is removed.
    $(document.body).on('input','input[name=header\\[keyword\\]]',function(e){
        if (e.currentTarget.value === '') {
            load_record(0,'employer','main_container','main_pagination','main_loader');
        }
    })
    //end find

    //approve
    $(document.body).on('click','button.btn_submit',function(e){
        var id = $(this).attr('aria-id');
        var btn         = $(this);
        var btn_text    = '';
        var id          = $(this).attr('aria-id');
        var type        = $(this).attr('aria-type');
        var type_text   = "";

       
        var url         = homeurl;
        url             += '/partner_application/submit_data';
        
        var frm_id      = '';
        
        var data                    = {};
            data.header             = {}
            data.header.id          = id;
            data.header.status      = type;
            data.header.username    = $(this).attr('aria-username');

        if(type == 2){
            btn_text = 'Approve';
            type_text = "approve"
        }else{
            btn_text = 'Decline';
            type_text = "decline"
        }
 
      
        if(confirm("Are you sure you want to "+type_text+" this partner?")){


            $.ajax({
                url: url,
                type: "POST",
                data: data,
                dataType: "JSON",
                beforeSend : function(){
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


                        //load_record(0,type,type+'_container',type+'_pagination',type+'_loader');
                        //$(frm_id+' input[name=header\\[id\\]').val('');
                        //$(frm_id+' input[name=header\\[name\\]').val('');

                        load_record(0,'signup','main_container','main_pagination','main_loader');

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
    })//end if
    //end approve


    //remove active job post
    $(document.body).on('click','button.btn_remove',function(e){
        
        var view_url     = window.location.href;



        var id          = $(this).attr('aria-id');
        var btn         = $(this);
        var btn_text    = '';

        var type_text   = "";

       
        var url         = homeurl;
        url             = homeurl + '/cancel_schedule/list';
        
        var frm_id      = '';
        
        var data                    = {};
            data.header             = {}
            data.header.id          = id;


        btn_text = '<i class="fa fa-times"></i>';
        
       

      
        if(confirm("This will cancel your schedule!")){


            $.ajax({
                url: url,
                type: "POST",
                data: data,
                dataType: "JSON",
                beforeSend : function(){
                    $(".outside_button *").css('pointer-events','none');
                     //btn.text('Processing...');
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

                    
                        
                        setTimeout(function(){
                            window.location.replace(view_url);;
                            //btn.text(btn_text);
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

                        //btn.text(btn_text);
                        btn.removeAttr('disabled');
                        $(".outside_button *").css('pointer-events','auto');
                    }
                }).fail(function(e){
                    alert(e.responseText);
                   

                    //btn.text(btn_text);
                    btn.removeAttr('disabled');
                    $(".outside_button *").css('pointer-events','auto');
                }).always(function(e){

            });
        }//end if
    })//end if
    //end add favorites

    //load job level autocomplete
    $(document.body).on('focus','input[id=header\\[job_level_text\\]]',function(){
        if(!$(this).hasClass('wauto')){
            load_job_level_autocomplete($(this),$('input[name=header\\[job_level\\]]'));
            $(this).addClass('wauto');
        }//End if
    })//focus
    $(document.body).on('blur','input[id=header\\[job_level_text\\]]',function(){
        if($(this).val() == ""){
            $('input[name=header\\[job_level\\]]').val('');
        }//end if

        if($('input[name=header\\[job_level\\]]').val() == ''){
            $(this).val('');
        }//end if
    })//blur

    //load job type autocomplete
    $(document.body).on('focus','input[id=header\\[job_type_text\\]]',function(){
        if(!$(this).hasClass('wauto')){
            load_job_type_autocomplete($(this),$('input[name=header\\[job_type\\]]'));
            $(this).addClass('wauto');
        }//End if
    })//focus
    $(document.body).on('blur','input[id=header\\[job_type_text\\]]',function(){
        if($(this).val() == ""){
            $('input[name=header\\[job_type\\]]').val('');
        }//end if

        if($('input[name=header\\[job_type\\]]').val() == ''){
            $(this).val('');
        }//end if
    })//blur


    //load education autocomplete
    $(document.body).on('focus','input[id=header\\[education_text\\]]',function(){
        if(!$(this).hasClass('wauto')){
            load_education_autocomplete($(this),$('input[name=header\\[education\\]]'));
            $(this).addClass('wauto');
        }//End if
    })//focus
    $(document.body).on('blur','input[id=header\\[education_text\\]]',function(){
        if($(this).val() == ""){
            $('input[name=header\\[education\\]]').val('');
        }//end if

        if($('input[name=header\\[education\\]]').val() == ''){
            $(this).val('');
        }//end if
    })//blur

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

    //load department autocomplete
    $(document.body).on('focus','input[id=header\\[department_text\\]]',function(){
        if(!$(this).hasClass('wauto')){
            load_department_autocomplete($(this),$('input[name=header\\[department\\]]'));
            $(this).addClass('wauto');
        }//End if
    })//focus
    $(document.body).on('blur','input[id=header\\[department_text\\]]',function(){
        if($(this).val() == ""){
            $('input[name=header\\[department\\]]').val('');
        }//end if

        if($('input[name=header\\[department\\]]').val() == ''){
            $(this).val('');
        }//end if
    })//blur



    //load location autocomplete
    $(document.body).on('focus','input[id=header\\[location_text\\]]',function(){
        if(!$(this).hasClass('wauto')){
            load_location_autocomplete($(this),$('input[name=header\\[location\\]]'));
            $(this).addClass('wauto');
        }//End if
    })//focus
    $(document.body).on('blur','input[id=header\\[location_text\\]]',function(){
        if($(this).val() == ""){
            $('input[name=header\\[location\\]]').val('');
        }//end if

        if($('input[name=header\\[location\\]]').val() == ''){
            $(this).val('');
        }//end if
    })//blur


    //load job title autocomplete
    $(document.body).on('focus','input[name=header\\[job_title\\]]',function(){
        if(!$(this).hasClass('wauto')){
            load_job_title_autocomplete($(this),$('input[name=header\\[job_title\\]]'));
            $(this).addClass('wauto');
        }//End if
    })//focus
    $(document.body).on('blur','input[name=header\\[job_title\\]]',function(){
        var html = $(this);
        if($(this).val() !== ""){
            var name    =   $(this).attr('name');
                name        = name.substring(name.indexOf('[')+1);
                name        = name.substring(0,name.lastIndexOf(']'));
                var dup = 0;
                $('#'+name+'_cont').find(".edit_link").each(function(){
                    var value = $(this).text();

                    if(value.toLowerCase() === html.val().toLowerCase()){
                        dup = 1;
                        return false;
                    }//end if
                });
               
                if(dup == 0){
                    var html_txt = '';
                        html_txt += '<div class="col ">';
                            html_txt += '<small class="d-none"><a style="text-decoration:none;" class="edit_link">'+html.val()+'</a></small>'; 
                            html_txt += '<small><a style="text-decoration:none;">'+html.val()+'</a></small>';                              
                            html_txt += '<button type="button" title="Remove" class="text-danger close remove_append" aria-id="'+html.val()+'">&times;</button>';
                        html_txt += '</div>';         
                    $('#'+name+'_cont').append(html_txt);
                    $(this).val('');
                    $(this).focus();
                    $('.btn_find').trigger('click');
                }//end if
        }//end if

        
    })//blur


    //load job title autocomplete
    $(document.body).on('focus','input[name=header\\[language\\]]',function(){
        if(!$(this).hasClass('wauto')){
            load_language_autocomplete($(this),$('input[name=header\\[language\\]]'));
            $(this).addClass('wauto');
        }//End if
    })//focus
    $(document.body).on('blur','input[name=header\\[language\\]]',function(){
        var html = $(this);
        if($(this).val() !== ""){
            var name    =   $(this).attr('name');
                name        = name.substring(name.indexOf('[')+1);
                name        = name.substring(0,name.lastIndexOf(']'));
                var dup = 0;
                $('#'+name+'_cont').find(".edit_link").each(function(){
                    var value = $(this).text();

                    if(value.toLowerCase() === html.val().toLowerCase()){
                        dup = 1;
                        return false;
                    }//end if
                });
               
                if(dup == 0){
                    var html_txt = '';
                        html_txt += '<div class="col ">';
                            html_txt += '<small class="d-none"><a style="text-decoration:none;" class="edit_link">'+html.val()+'</a></small>'; 
                            html_txt += '<small><a style="text-decoration:none;">'+html.val()+'</a></small>';                              
                            html_txt += '<button type="button" title="Remove" class="text-danger close remove_append" aria-id="'+html.val()+'">&times;</button>';
                        html_txt += '</div>';         
                    $('#'+name+'_cont').append(html_txt);
                    $(this).val('');
                    $(this).focus();
                    $('.btn_find').trigger('click');
                }//end if
        }//end if

        
    })//blur


    //load skills autocomplete
    $(document.body).on('focus','input[name=header\\[skills\\]]',function(){
        if(!$(this).hasClass('wauto')){
            load_skills_autocomplete($(this),$('input[name=header\\[skills\\]]'));
            $(this).addClass('wauto');
        }//End if
    })//focus
    $(document.body).on('blur','input[name=header\\[skills\\]]',function(){
        var html = $(this);
        if($(this).val() !== ""){
            var name    =   $(this).attr('name');
                name        = name.substring(name.indexOf('[')+1);
                name        = name.substring(0,name.lastIndexOf(']'));
                var dup = 0;
                $('#'+name+'_cont').find(".edit_link").each(function(){
                    var value = $(this).text();

                    if(value.toLowerCase() === html.val().toLowerCase()){
                        dup = 1;
                        return false;
                    }//end if
                });
               
                if(dup == 0){
                    var html_txt = '';
                        html_txt += '<div class="col ">';
                            html_txt += '<small class="d-none"><a style="text-decoration:none;" class="edit_link">'+html.val()+'</a></small>'; 
                            html_txt += '<small><a style="text-decoration:none;">'+html.val()+'</a></small>';                              
                            html_txt += '<button type="button" title="Remove" class="text-danger close remove_append" aria-id="'+html.val()+'">&times;</button>';
                        html_txt += '</div>';         
                    $('#'+name+'_cont').append(html_txt);
                    $(this).val('');
                    $(this).focus();
                    $('.btn_find').trigger('click');
                }//end if
        }//end if

        
    })//blur


   
    $(document.body).on('blur','input[name=header\\[years\\]]',function(){
        var html = $(this);
        if($(this).val() !== ""){
            var name    =   $(this).attr('name');
                name        = name.substring(name.indexOf('[')+1);
                name        = name.substring(0,name.lastIndexOf(']'));
                var dup = 0;
                $('#'+name+'_cont').find(".edit_link").each(function(){
                    var value = $(this).text();

                    if(value.toLowerCase() === html.val().toLowerCase()){
                        dup = 1;
                        return false;
                    }//end if
                });

                if(catchIsNaN($(this).val()) == 0){
                    dup = 1;
                }
               
                if(dup == 0){
                    var html_txt = '';
                        html_txt += '<div class="col ">';
                            html_txt += '<small class="d-none"><a style="text-decoration:none;" class="edit_link">'+html.val()+'</a></small>'; 
                            html_txt += '<small><a style="text-decoration:none;">'+html.val()+'</a></small>';                              
                            html_txt += '<button type="button" title="Remove" class="text-danger close remove_append" aria-id="'+html.val()+'">&times;</button>';
                        html_txt += '</div>';         
                    $('#'+name+'_cont').append(html_txt);
                    $(this).val('');
                    $(this).focus();
                    $('.btn_find').trigger('click');
                }//end if
        }//end if

        
    })//blur

    //remove appended data
    $(document.body).on('click','.remove_append',function(e){
        $(this).parent().remove();
        $('.btn_find').trigger('click');
    })
    //remove appended data

    //clear filter
    $(document.body).on('click','a[name=btn_clear_filter]',function(e){
        //$(this).parent().remove();
        $('input[name=header\\[keyword\\]]').val('');
        $('#job_title_cont').empty();
        $('#years_cont').empty();
        $('#education_cont').empty();
        $('#language_cont').empty();
        $('#skills_cont').empty();
        $('#location_cont').empty();
        $('.btn_find').trigger('click');
    })
    //clear filter
    //=====================================================================================================================
    //end events

    //autocomplete
    //===============================================================================================================================
    
    //job title autocomplete
    function load_job_title_autocomplete(html,html_id){
        var url     = baseurl + "/get/job_post/ojob_post";
        html.autocomplete({
            serviceUrl: url,
            type : 'GET',
            dataType : 'json',
            showNoSuggestionNotice: true,
            noSuggestionNotice: 'Sorry, no matching results',
            autoSelectFirst : true,
            triggerSelectOnValidInput : true,
            orientation : 'auto',
            tabDisabled : true,
            transformResult: function(response) {
                return {
                    suggestions: $.map(response.data, function(dataItem) {
                        if (dataItem.job_title.toLowerCase().indexOf(html.val().toLowerCase()) > -1) {
                           return { value: dataItem.job_title, data: dataItem.id }; 
                        }//end if
                    })
                };  
            },
            onSelect: function(suggestion) {
                //html_id.val(suggestion.data);



                var name    = html_id.attr('name');
                name        = name.substring(name.indexOf('[')+1);
                name        = name.substring(0,name.lastIndexOf(']'));
                var dup = 0;
                $('#'+name+'_cont').find(".edit_link").each(function(){
                    var value = $(this).text();
                    if(value.toLowerCase() === suggestion.value.toLowerCase()){
                        dup = 1;
                        return false;
                    }//end if
                });
                
                if(dup == 0){
                    var html_txt = '';
                        html_txt += '<div class="col ">';
                            html_txt += '<small class="d-none"><a style="text-decoration:none;" class="edit_link">'+suggestion.value+'</a></small>'; 
                            html_txt += '<small><a style="text-decoration:none;">'+suggestion.value+'</a></small>';                              
                            html_txt += '<button type="button" title="Remove" class="text-danger close remove_append" aria-id="'+suggestion.value+'">&times;</button>';
                        html_txt += '</div>';         
                    $('#'+name+'_cont').append(html_txt);
                    html.val('');
                    html.focus();
                    $('.btn_find').trigger('click');
                }//end if

                
                
            },

            onSearchComplete : function (query, suggestions) {
               

            }
        })
    }

    //language autocomplete
    function load_language_autocomplete(html,html_id){
        var url     = baseurl + "/get/job_post_no_inactive/profile_language";
        html.autocomplete({
            serviceUrl: url,
            type : 'GET',
            dataType : 'json',
            showNoSuggestionNotice: true,
            noSuggestionNotice: 'Sorry, no matching results',
            autoSelectFirst : true,
            triggerSelectOnValidInput : true,
            orientation : 'auto',
            tabDisabled : true,
            transformResult: function(response) {
                return {
                    suggestions: $.map(response.data, function(dataItem) {
                        if (dataItem.language.toLowerCase().indexOf(html.val().toLowerCase()) > -1) {
                           return { value: dataItem.language, data: dataItem.id }; 
                        }//end if
                    })
                };  
            },
            onSelect: function(suggestion) {
                //html_id.val(suggestion.data);



                var name    = html_id.attr('name');
                name        = name.substring(name.indexOf('[')+1);
                name        = name.substring(0,name.lastIndexOf(']'));
                var dup = 0;
                $('#'+name+'_cont').find(".edit_link").each(function(){
                    var value = $(this).text();
                    if(value.toLowerCase() === suggestion.value.toLowerCase()){
                        dup = 1;
                        return false;
                    }//end if
                });
                
                if(dup == 0){
                    var html_txt = '';
                        html_txt += '<div class="col ">';
                            html_txt += '<small class="d-none"><a style="text-decoration:none;" class="edit_link">'+suggestion.value+'</a></small>'; 
                            html_txt += '<small><a style="text-decoration:none;">'+suggestion.value+'</a></small>';                              
                            html_txt += '<button type="button" title="Remove" class="text-danger close remove_append" aria-id="'+suggestion.value+'">&times;</button>';
                        html_txt += '</div>';         
                    $('#'+name+'_cont').append(html_txt);
                    html.val('');
                    html.focus();
                    $('.btn_find').trigger('click');
                }//end if

                
                
            },

            onSearchComplete : function (query, suggestions) {
               

            }
        })
    }


    //skills autocomplete
    function load_skills_autocomplete(html,html_id){
        var url     = baseurl + "/get/job_post_no_inactive/profile_skills";
        html.autocomplete({
            serviceUrl: url,
            type : 'GET',
            dataType : 'json',
            showNoSuggestionNotice: true,
            noSuggestionNotice: 'Sorry, no matching results',
            autoSelectFirst : true,
            triggerSelectOnValidInput : true,
            orientation : 'auto',
            tabDisabled : true,
            transformResult: function(response) {
                return {
                    suggestions: $.map(response.data, function(dataItem) {
                        if (dataItem.skills.toLowerCase().indexOf(html.val().toLowerCase()) > -1) {
                           return { value: dataItem.skills, data: dataItem.id }; 
                        }//end if
                    })
                };  
            },
            onSelect: function(suggestion) {
                //html_id.val(suggestion.data);



                var name    = html_id.attr('name');
                name        = name.substring(name.indexOf('[')+1);
                name        = name.substring(0,name.lastIndexOf(']'));
                var dup = 0;
                $('#'+name+'_cont').find(".edit_link").each(function(){
                    var value = $(this).text();
                    if(value.toLowerCase() === suggestion.value.toLowerCase()){
                        dup = 1;
                        return false;
                    }//end if
                });
                
                if(dup == 0){
                    var html_txt = '';
                        html_txt += '<div class="col ">';
                            html_txt += '<small class="d-none"><a style="text-decoration:none;" class="edit_link">'+suggestion.value+'</a></small>'; 
                            html_txt += '<small><a style="text-decoration:none;">'+suggestion.value+'</a></small>';                              
                            html_txt += '<button type="button" title="Remove" class="text-danger close remove_append" aria-id="'+suggestion.value+'">&times;</button>';
                        html_txt += '</div>';         
                    $('#'+name+'_cont').append(html_txt);
                    html.val('');
                    html.focus();
                    $('.btn_find').trigger('click');
                }//end if

                
                
            },

            onSearchComplete : function (query, suggestions) {
               

            }
        })
    }




    function load_location_autocomplete(html,html_id){
        var url     = baseurl + "/get/job_post/olocation";
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
            tabDisabled : true,

            beforeRender : function(container, suggestions){
                //container.find('.autocomplete-suggestion').each(function(i, suggestion){
                    //suggestion.append('<input type="checkbox"/>')
                // suggestion.append(); suggestion.preppend(); suggestion.whatever()
                //});


            },
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
                html_id.val(suggestion.data+',');

                var name    = html_id.attr('name');
                name        = name.substring(name.indexOf('[')+1);
                name        = name.substring(0,name.lastIndexOf(']'));
                var dup = 0;
                $('#'+name+'_cont').find(".edit_link").each(function(){
                    var value = $(this).text();
                    if(value.toLowerCase() === suggestion.data.toLowerCase()){
                        dup = 1;
                        return false;
                    }//end if
                });
                
                if(dup == 0){
                    var html_txt = '';
                        html_txt += '<div class="col ">';
                            html_txt += '<small class="d-none"><a style="text-decoration:none;" class="edit_link">'+suggestion.data+'</a></small>'; 
                            html_txt += '<small><a style="text-decoration:none;">'+suggestion.value+'</a></small>';                              
                            html_txt += '<button type="button" title="Remove" class="text-danger close remove_append" aria-id="'+suggestion.data+'">&times;</button>';
                        html_txt += '</div>';         
                    $('#'+name+'_cont').append(html_txt);
                    html.val('');
                    html.focus();
                    $('.btn_find').trigger('click');
                }//end if
     
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


    //education autocomplete
    function load_education_autocomplete(html,html_id){
        var url     = baseurl + "/get/job_post/oeducation";
        html.autocomplete({
            serviceUrl: url,
            type : 'GET',
            dataType : 'json',
            showNoSuggestionNotice: true,
            noSuggestionNotice: 'Sorry, no matching results',
            autoSelectFirst : true,
            triggerSelectOnValidInput : true,
            orientation : 'auto',
            tabDisabled : true,
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

                var name    = html_id.attr('name');
                name        = name.substring(name.indexOf('[')+1);
                name        = name.substring(0,name.lastIndexOf(']'));
                var dup = 0;
                $('#'+name+'_cont').find(".edit_link").each(function(){
                    var value = $(this).text();
                    if(value.toLowerCase() === suggestion.data.toLowerCase()){
                        dup = 1;
                        return false;
                    }//end if
                });
                
                if(dup == 0){
                    var html_txt = '';
                        html_txt += '<div class="col ">';
                            html_txt += '<small class="d-none"><a style="text-decoration:none;" class="edit_link">'+suggestion.data+'</a></small>'; 
                            html_txt += '<small><a style="text-decoration:none;">'+suggestion.value+'</a></small>';                              
                            html_txt += '<button type="button" title="Remove" class="text-danger close remove_append" aria-id="'+suggestion.data+'">&times;</button>';
                        html_txt += '</div>';         
                    $('#'+name+'_cont').append(html_txt);
                    html.val('');
                    html.focus();
                    $('.btn_find').trigger('click');
                }//end if
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



    //department autocomplete
    function load_department_autocomplete(html,html_id){
        var url     = baseurl + "/get/job_post/odepartment";
        html.autocomplete({
            serviceUrl: url,
            type : 'GET',
            dataType : 'json',
            showNoSuggestionNotice: true,
            noSuggestionNotice: 'Sorry, no matching results',
            autoSelectFirst : true,
            triggerSelectOnValidInput : true,
            orientation : 'auto',
            tabDisabled : true,
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

                var name    = html_id.attr('name');
                name        = name.substring(name.indexOf('[')+1);
                name        = name.substring(0,name.lastIndexOf(']'));
                var dup = 0;
                $('#'+name+'_cont').find(".edit_link").each(function(){
                    var value = $(this).text();
                    if(value.toLowerCase() === suggestion.data.toLowerCase()){
                        dup = 1;
                        return false;
                    }//end if
                });
                
                if(dup == 0){
                    var html_txt = '';
                        html_txt += '<div class="col ">';
                            html_txt += '<small class="d-none"><a style="text-decoration:none;" class="edit_link">'+suggestion.data+'</a></small>'; 
                            html_txt += '<small><a style="text-decoration:none;">'+suggestion.value+'</a></small>';                              
                            html_txt += '<button type="button" title="Remove" class="text-danger close remove_append" aria-id="'+suggestion.data+'">&times;</button>';
                        html_txt += '</div>';         
                    $('#'+name+'_cont').append(html_txt);
                    html.val('');
                    html.focus();
                    $('.btn_find').trigger('click');
                }//end if
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

    //job level autocomplete
    function load_job_level_autocomplete(html,html_id){
        var url     = baseurl + "/get/job_post/ojob_level";
        html.autocomplete({
            serviceUrl: url,
            type : 'GET',
            dataType : 'json',
            showNoSuggestionNotice: true,
            noSuggestionNotice: 'Sorry, no matching results',
            autoSelectFirst : true,
            triggerSelectOnValidInput : true,
            orientation : 'auto',
            tabDisabled : true,
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



                var name    = html_id.attr('name');
                name        = name.substring(name.indexOf('[')+1);
                name        = name.substring(0,name.lastIndexOf(']'));
                var dup = 0;
                $('#'+name+'_cont').find(".edit_link").each(function(){
                    var value = $(this).text();
                    if(value.toLowerCase() === suggestion.data.toLowerCase()){
                        dup = 1;
                        return false;
                    }//end if
                });
                
                if(dup == 0){
                    var html_txt = '';
                        html_txt += '<div class="col ">';
                            html_txt += '<small class="d-none"><a style="text-decoration:none;" class="edit_link">'+suggestion.data+'</a></small>'; 
                            html_txt += '<small><a style="text-decoration:none;">'+suggestion.value+'</a></small>';                              
                            html_txt += '<button type="button" title="Remove" class="text-danger close remove_append" aria-id="'+suggestion.data+'">&times;</button>';
                        html_txt += '</div>';         
                    $('#'+name+'_cont').append(html_txt);
                    html.val('');
                    html.focus();
                    $('.btn_find').trigger('click');
                }//end if

                
                
            },

            onSearchComplete : function (query, suggestions) {
                if(suggestions.length == 0){
                    html_id.val('');
                }else{

                    
                }//end if

            }
        }).blur(function(){
            if(html_id.val() == ''){
                html.val('');
            }
        });
    }

    //job type autocomplete
    function load_job_type_autocomplete(html,html_id){
        var url     = baseurl + "/get/job_post/ojob_type";
        html.autocomplete({
            serviceUrl: url,
            type : 'GET',
            dataType : 'json',
            showNoSuggestionNotice: true,
            noSuggestionNotice: 'Sorry, no matching results',
            autoSelectFirst : true,
            triggerSelectOnValidInput : true,
            orientation : 'auto',
            tabDisabled : true,
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

                var name    = html_id.attr('name');
                name        = name.substring(name.indexOf('[')+1);
                name        = name.substring(0,name.lastIndexOf(']'));
                var dup = 0;
                $('#'+name+'_cont').find(".edit_link").each(function(){
                    var value = $(this).text();
                    if(value.toLowerCase() === suggestion.data.toLowerCase()){
                        dup = 1;
                        return false;
                    }//end if
                });
                
                if(dup == 0){
                    var html_txt = '';
                        html_txt += '<div class="col ">';
                            html_txt += '<small class="d-none"><a style="text-decoration:none;" class="edit_link">'+suggestion.data+'</a></small>'; 
                            html_txt += '<small><a style="text-decoration:none;">'+suggestion.value+'</a></small>';                              
                            html_txt += '<button type="button" title="Remove" class="text-danger close remove_append" aria-id="'+suggestion.data+'">&times;</button>';
                        html_txt += '</div>';         
                    $('#'+name+'_cont').append(html_txt);
                    html.val('');
                    html.focus();
                    $('.btn_find').trigger('click');
                }//end if
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


    //modal
    //=======================================================================================================================
    //Lookup Modal
    $('#job_post_modal').on('shown.bs.modal',function(e){
        
            //$('#job_post_modal_body').load('http://localhost:81/hoteleers/job_post/edit/12');
    });

    $('#job_post_modal').on('hide.bs.modal',function(e){
        //$('#job_post_modal_title').empty();
        //$('#job_post_modal_body').empty();
    })
    //End Lookup Modal
    //=======================================================================================================================
    //end modal


});//End document.ready

