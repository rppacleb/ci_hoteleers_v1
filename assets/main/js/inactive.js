

$(document).ready(function(){
    //highlight
    $('#side_account_management_inactive').removeClass('text-muted');
    $('#side_account_management_inactive').addClass('active');
    $('#side_account_management_inactive').css({'opacity': 0.8, "background-color": "rgb(0, 41, 170)"});
    //end highlight

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
    
    $("#side_account_management_collapse").addClass('show');
    $("#collapse_link i").removeClass('fa-chevron-down');
    $("#collapse_link i").addClass('fa-chevron-up');
    
    var homeurl     = baseurl + '/account_management';

    //prospect
    load_record(0,'inactive','inactive_container','inactive_pagination','inactive_loader',function(){
        
    });
    

    //load record
    function load_record(page,type,container,pagination,loader,callback){
        var view_url = baseurl + '/account_management/view/';

        

        if(type == 'active' || type == 'inactive' || type == 'pause'){
            view_url = baseurl + '/employer/view/';
        }//end if

        var data            = {};
            data.page       = page;
            data.status     = $('select[name=header\\[sort\\]]').val();
            data.keyword    = $('input[name=header\\[keyword\\]]').val();



        var url         = baseurl + '/get/inactive/'+type;
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
                    
                    
                    //$('.pagination_result').empty();
                    //$('.pagination_result').html(start_page+' - '+end_page+' of '+ toCurrency_precision(data.total_result,0)+' result(s)')

                    $.each(data.data, function (key, value) {
                        var html = '';

                        html += '<div class="row mb-3">';
                            html += '<div class="col">';
                                //var btn_class   = "border border-warning";
                                var btn_class   = "";
                                if(value.status.toLowerCase() == 'approved'){
                                    //btn_class= "border border-success";
                                }//end if
                                if(value.status.toLowerCase() == 'declined'){
                                    //btn_class= "border border-danger";
                                }//end if

                                var company_placeholder           = value.company_name;
                                //var company_placeholder_length    = value.company_name.length;

                                //if(company_placeholder_length > 50){
                                    //company_placeholder = company_placeholder+'...';
                                //}//end if

                                html += '<div class="card '+btn_class+'">';
                                    html += '<div class="card-body">';
                                        html += '<div class="row">';
                                            
                                            html += '<div class="col-3 align-self-center">';
                                                html += company_placeholder;
                                            html += '</div><!--./col-->';
                                            html += '<div class="col align-self-center">';
                                                html += value.location_placeholder;
                                            html += '</div><!--./col-->';
                                            html += '<div class="col align-self-center">';
                                                html += value.industry;
                                            html += '</div><!--./col-->';

                                            if(type == 'prospect'){
                                                html += '<div class="col align-self-center">';
                                                    html += value.application_date;
                                                html += '</div><!--./col-->';
                                            }else if(type == 'active' || type == 'inactive'){
                                                html += '<div class="col align-self-center">';
                                                    html += value.start_date;
                                                html += '</div><!--./col-->';
                                                html += '<div class="col align-self-center">';
                                                    html += value.end_date;
                                                html += '</div><!--./col-->';
                                            }//end if
                                            

                                            html += '<div class="text-center col-xl-1 col-lg-1 col-md-12 col-sm-12 col-xs-12 align-self-center" style="min-width:1in;">';
                                                
                                                   
                                                      
                                                html += '<a href="'+view_url+value.id+'?side_menu=side_account_management_inactive&type=inactive" class="text-link btn_view" style="padding: 0rem;">View</a>';
                                                       
                                                
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
                    //$('.pagination_result').empty();
                    
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

                callback();
            }).fail(function(e){
                
                $('#loading').hide();
                callback();
            }).always(function(e){

        });
    }//end load_record




    $(document.body).on('click','button[name=btn_login]',function(e){
       
       
        
    	var homeurl    = baseurl + '/home';
    	var url        = baseurl + '/login/login';
         
    	$.ajax({
            url: url,
            data: $('#frm_login').serialize(),
            type: "POST",
            dataType: "JSON",
            beforeSend : (function (data){
                $('button[name=btn_login]').text('Logging in...');
                $('button[name=btn_login]').attr('disabled','disabled');
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

                
                setTimeout(function(){
                    window.location.replace(homeurl);
                },2000)
    			//window.location.replace(homeurl);
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

                $('button[name=btn_login]').text('Login');
                $('button[name=btn_login]').removeAttr('disabled');
            }
        }).fail(function(e){
            alert(e.responseText);
            $.notify(e.responseText,{ 
				position:"top center",
				style:'happyblue',
				className:"error",
				
			});

            $('button[name=btn_login]').text('Login');
            $('button[name=btn_login]').removeAttr('disabled');
        }).always(function(e){

        });
        
    })



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
    
    // Search company on Enter key press
    $(document.body).on('keypress','input[name=header\\[keyword\\]]',function(e){
        if (e.which == 13) {
            load_record(0,'prospect','prospect_container','prospect_pagination','prospect_loader',function(){
                load_record(0,'active','active_container','active_pagination','active_loader',function(){
                    load_record(0,'inactive','inactive_container','inactive_pagination','inactive_loader',function(){
                        
                    });
                });    
            });

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
        load_record(0,'signup','main_container','main_pagination','main_loader');
    })//end if
    //end filter by

    //find
    $(document.body).on('click','button.btn_find',function(e){

        load_record(0,'prospect','prospect_container','prospect_pagination','prospect_loader',function(){
            load_record(0,'active','active_container','active_pagination','active_loader',function(){
                load_record(0,'inactive','inactive_container','inactive_pagination','inactive_loader',function(){

                });
            });    
        });
    })//end if
    //end find

    //find
    $(document.body).on('blur','input[name=header\\[keyword\\]]',function(e){
        load_record(0,'prospect','prospect_container','prospect_pagination','prospect_loader',function(){
            load_record(0,'active','active_container','active_pagination','active_loader',function(){
                load_record(0,'inactive','inactive_container','inactive_pagination','inactive_loader',function(){

                });
            });    
        });
    })//end if
    //end find

    //find; Refreshing the result/s when the search word is removed.
    $(document.body).on('input','input[name=header\\[keyword\\]]',function(e){
        if (e.currentTarget.value === '') {
            load_record(0,'prospect','prospect_container','prospect_pagination','prospect_loader',function(){
                load_record(0,'active','active_container','active_pagination','active_loader',function(){
                    load_record(0,'inactive','inactive_container','inactive_pagination','inactive_loader',function(){
                        
                    });
                });    
            });
        }//end if
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
        url             = baseurl + '/partner_application/submit_data';
        
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


                        //load_record(0,type,type+'_container',type+'_pagination',type+'_loader');
                        //$(frm_id+' input[name=header\\[id\\]').val('');
                        //$(frm_id+' input[name=header\\[name\\]').val('');

                        load_record(0,'signup','main_container','main_pagination','main_loader');

                        btn.text(btn_text);
                        btn.removeAttr('disabled');
                        $(".outside_button *").css('pointer-events','auto');

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
    //=====================================================================================================================
    //end events




});//End document.ready

