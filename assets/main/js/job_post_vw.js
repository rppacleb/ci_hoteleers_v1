

$(document).ready(function(){
    //highlight
    $('#side_create_jp').removeClass('text-muted');
    $('#side_create_jp').addClass('active');
    $('#side_create_jp').css({'opacity': 0.8, "background-color": "rgb(0, 41, 170)"});
    //end highlight

    if (window.location.href.indexOf("add") > -1) {
        autosize($('.jp-textarea'));
    }

    if (window.location.href.indexOf("view") > -1) {
        $('.jpvw-select').remove();
    }

    if ($(window).width() >= 1441 ) {
        $('.container-fluid').css({'max-width': '1440px'});
    } else if ($(window).width() >= 1360 && $(window).width() <= 1440) {
        $('.container-fluid').css({'max-width': '1350px'});
    } else if ($(window).width() >= 1200 && $(window).width() <= 1359) {
        $('.container-fluid').css({'max-width': '1200px'});
    }

    
    var homeurl         = baseurl + '/job_post';
    var homeurl_txt     = 'job_post';
    var urlimgdef       = baseurl + '/files/images/default/image.png';
    var upload_path     = baseurl + '/files/uploads/';
    var dropdown_loaded = 0;
   // load_record(0,'signup','main_container','main_pagination','main_loader');

   //alert(moment('4/30/2016', 'MM/DD/YYYY').add(1, 'day'));

   //Initialize date time picker
   var date1 = new Date();
   var date = addDays(date1,119);
   var today = new Date(date1.getFullYear(), date1.getMonth(), date1.getDate());
   var end_date = new Date(date.getFullYear(), date.getMonth(), date.getDate());
    $('input[name=header\\[job_expiration_date\\]]').datetimepicker({
        format: 'M/D/YYYY',
        minDate: today,
        maxDate : end_date

    });



    $(document.body).on('change','input[name=placeholder\\[customRadio\\]]',function(e){
            var radio_val = $(this).val();
            

            var date1       = new Date();
            var date        = addDays(date1,(radio_val - 1));
            var today       = new Date(date1.getFullYear(), date1.getMonth(), date1.getDate());
            var end_date    = new Date(date.getFullYear(), date.getMonth(), date.getDate());
            end_date = formatDate(end_date,"");
            $('input[name=header\\[job_expiration_date\\]]').val(end_date).focus();
    })

    $(document.body).on('blur','input[name=header\\[job_expiration_date\\]]',function(e){
        var val          = new Date($(this).val());
        var today        = new Date();
        var diff         = DateDiff.inDays(today, val);

        var contract_date = new Date();
        if(employer_default.end_date !== undefined || employer_default.end_date !== null){
            contract_date = new Date(employer_default.end_date);
        }//end if
         

        

        if(parseInt(diff) > 120){
            var msg_html = 'Max validty for job expiration is 120 days!';
            $.notify(msg_html,{ 
                position:"top center",
                className:"error",
                arrowShow : true
            });

            //$(this).val(formatDate(today,''));
            $(this).focus();
        }else{
            var msg_html = "Job expiration date("+formatDate(val,'')+") cannot exceed the contract date("+formatDate(contract_date,'')+")!"
            if(val > contract_date){
                $.notify(msg_html,{ 
                    position:"top center",
                    className:"error",
                    arrowShow : true
                });

                //$(this).val(formatDate(today,''));
                $(this).focus();
            }//end if
        }//end if


    })
    //end load record

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
        check_account_status();
    })
    //end load record

    $('input[name=header\\[id\\]]').trigger('blur');
    





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
    

    //remove perks and benefits
    $(document.body).on('click','button.remove_perks_benefits ',function(e){
        var id          = $(this).attr('aria-id');
        var url         = baseurl + '/manage_dropdown/remove_data';
        var btn         = $(this);
        var btn_text    = '';

        var data                    = {};
            data.header             = {}
            data.header.id          = id;
        if(confirm("Are you sure you want to remove this item?")){
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
                        // The order of this function call is important to
                        // properly rerender the previously selected "perks and benefits".
                        var previously_selected = selected_perks_and_benefits();
                        load_perks_and_benefits();
                        select_perks_and_benefits(previously_selected);
                        
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

                        btn.parent().empty();
                    
                        
                        $(".outside_button *").css('pointer-events','auto');
                        // setTimeout(function(){
                        //     window.location.replace(view_url);;
                        //     //btn.text(btn_text);
                        //     btn.removeAttr('disabled');
                        // },2000)



                        
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
    })
    //end remove perks and benefits
    
    //cancel
    $(document.body).on('click','button.btn_cancel',function(e){
        if(confirm("Are you sure you want to cancel creating a job post?")){
                window.location.href = baseurl+'/active_jobs';
        }
    })//end cancel

    //submit
    $(document.body).on('click','button.btn_submit',function(e){
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
        
        var data                    = {};
            data.header             = {}
            data.header.id          = id;
            data.header.status      = type;
            data.header.username    = $(this).attr('aria-username');

        btn_text = "Publish";

        if(parseInt(isActive)){
            btn_text = "Publish";
        }else{
            btn_text = "Save Draft";
        }//end if
        $('input[name=header\\[inactive\\]]').val(0);
      
        if(confirm("Are you sure you want to publish this record?")){


            $.ajax({
                url: url,
                type: "POST",
                data: $('#frm_data_entry').serialize()+"&isActive="+isActive,
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


                        view_url += data.data.id;
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
    
    //submit modal
    $(document.body).on('click','button#btn_modal_submit',function(e){
        var btn         = $(this);
        var btn_text    = '';
        var type        = $(this).attr('aria-type');

        var homeurl     = baseurl + '/manage_dropdown';
        var url         = baseurl;
        var frm;
        var frm_id      = '';
        
        url     += '/manage_dropdown/save_data/'+type;
        frm     = $('#frm_'+type).serialize();
        frm_id  = '#frm_'+type;

        btn_text = 'Submit';


        

        
        var to_save = false;

        if($.trim($('#frm_'+type).find('.row').html()).length == 0){
            to_save = true;
        }else{
            to_save = confirm('Are you sure you want to save all item(s)?');
        }//end if

        if(to_save){
            $.ajax({
                url: url,
                data: frm,
                type: "POST",
                dataType: "JSON",
                beforeSend : (function (data){
                    btn.text('Processing...');
                    btn.attr('disabled','disabled');
                })
            }).done(function (data) {
                
                //alert(Object.keys(data.messages).length);
                if (data.success === true){
                    // The order of this function call is important to
                    // properly rerender the previously selected "perks and benefits".
                    var previously_selected = selected_perks_and_benefits();
                    load_perks_and_benefits();
                    select_perks_and_benefits(previously_selected);

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
                    //$(frm_id+'').find('.row').empty();

                    btn.text(btn_text);
                    btn.removeAttr('disabled');

                    $('div.modal-header').find('button.close').trigger('click');
                    // setTimeout(function(){
                    //     location.reload();
                    // },2000)

                    /*
                    setTimeout(function(){
                        window.location.replace(homeurl);
                    },2000)
                    */
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
    //end submit modal
    //end submit

    //save as draft
    $(document.body).on('click','button.btn_draft',function(e){

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
        
        var data                    = {};
            data.header             = {}
            data.header.id          = id;
            data.header.status      = type;
            data.header.username    = $(this).attr('aria-username');

        btn_text = "Save as Draft";
 
        $('input[name=header\\[inactive\\]]').val(1);
        if(confirm("Are you sure you want to save this record?")){


            $.ajax({
                url: url,
                type: "POST",
                data: $('#frm_data_entry').serialize(),
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


                        view_url += data.data.id;
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
    //end save as draft


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

    //location change
    $(document.body).on('change','select[name=header\\[location\\]]',function(){
        $('input[name=header\\[country\\]]').val($(this).val());
    })//blur
    //end location change

    //append data
    $(document.body).on('click','.btn_add_append',function(e){
        var type = $(this).attr('aria-type');
            type_txt = type.replace(/_/g,' ');
        var name = $('input[name=header\\['+type+'_name\\]]').val().trim();
        var html = '';

        var dup = 0;
        $('#frm_'+type).find("input").each(function(){
            var value = $(this).val();
            if(value.toLowerCase() === name.toLowerCase()){
                dup = 1;
                return false;
            }//end if
        });

        if(name == ""){
            var msg_html = 'Please enter '+type_txt+' name!'
            $.notify(msg_html,{ 
                position:"top center",
                className:"error",
                arrowShow : true
            });
            $('input[name=header\\['+type+'_name\\]]').focus();
        }else{
            if(dup == 0){
                    html += '<div class="col">';
                        html += '<small class="text-muted">'+name+'</small>';
                        html += '<button title="Remove" class="text-danger close remove_append" aria-type="'+type+'">&times;</button>';

                        html += '<input name="row[name][]" maxlength="200" class="d-none form-control form-control-sm mb-2" type="text" value="'+name+'">'
                    html += '</div>';

                    $('#frm_'+type).find('.row').append(html);
            }else{
                var msg_html = 'Duplicate entry of '+type_txt+' name!'
                $.notify(msg_html,{ 
                    position:"top center",
                    className:"error",
                    arrowShow : true
                });
            }//end
            
            $('input[name=header\\['+type+'_name\\]]').val("").focus();
        }//end if
        
    })
    //end append data

    //keydown append
    $(document.body).on('keydown','.input_add_append',function(e){
        var keycode = (e.keyCode ? e.keyCode : e.which);

        if(keycode == '13'){
            var type = $(this).attr('aria-type');
            type_txt = type.replace(/_/g,' ');
            var name = $('input[name=header\\['+type+'_name\\]]').val().trim();
            var html = '';

            var dup = 0;
            $('#frm_'+type).find("input").each(function(){
                var value = $(this).val();
                if(value.toLowerCase() === name.toLowerCase()){
                    dup = 1;
                    return false;
                }//end if
            });

            if(name == ""){
                var msg_html = 'Please enter '+type_txt+' name!'
                $.notify(msg_html,{ 
                    position:"top center",
                    className:"error",
                    arrowShow : true
                });
                $('input[name=header\\['+type+'_name\\]]').focus();
            }else{
                if(dup == 0){
                        html += '<div class="col">';
                            html += '<small class="text-muted">'+name+'</small>';
                            html += '<button title="Remove" class="text-danger close remove_append" aria-type="'+type+'">&times;</button>';

                            html += '<input name="row[name][]" maxlength="200" class="d-none form-control form-control-sm mb-2" type="text" value="'+name+'">'
                        html += '</div>';

                        $('#frm_'+type).find('.row').append(html);
                }else{
                    var msg_html = 'Duplicate entry of '+type_txt+' name!'
                    $.notify(msg_html,{ 
                        position:"top center",
                        className:"error",
                        arrowShow : true
                    });
                }//end
                
                $('input[name=header\\['+type+'_name\\]]').val("").focus();
            }//end if    
        }//end if
    })
    
    //end keydown append

    //remove appended data
    $(document.body).on('click','.remove_append',function(e){
        $(this).parent().remove();
    })
    //remove appended data

    //=====================================================================================================================
    //end events

    


    

    //sourcing
    //=======================================================================================================================
    //load data
    function load_data(param){
        var url         = homeurl + '/load_data/'+param.id+'?isActive='+isActive+'&user_id='+user_id+'&employer_id='+employer_id;
        var btn         = $('.btn_submit');
        var btn_text    = 'Publish';

        
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
                    if(parseInt(isActive)){
                        btn_text    = 'Publish';
                    }else{
                        btn_text    = 'Save Draft';
                    }//end if
                    
                    //view and edit mode
                    //----------------------------------------------------------------------------------------------------
                        if(employer[0].doc_image === null || employer[0].doc_image == ""){
                            $('img[id=header\\[company_logo\\]]').attr('src',urlimgdef); 
                        }else{
                            $('img[id=header\\[company_logo\\]]').attr('src',upload_path+employer[0].doc_image);

                        }//end if
                        $('h6[id=header\\[company_name\\]]').html(employer[0].company_name);
                        $('p[id=header\\[location\\]]').html('<small class="text-muted">'+employer[0].locality+'</small>');
                        $('p[id=header\\[date_created\\]]').html('<small class="text-muted">Joined '+employer[0].joined_date+'</small>');

                        
                        
                        $('#frm_data_entry input[name=header\\[job_title\\]]').val(data.job_title);
                        $('#frm_data_entry select[name=header\\[department\\]]').multiselect('select',data.department);
                        $('#frm_data_entry input[name=placeholder\\[department\\]]').val(data.department_text);
                        $('#frm_data_entry select[name=header\\[industry\\]]').multiselect('select',data.industry);
                        $('#frm_data_entry input[name=placeholder\\[industry\\]]').val(data.industry_text);
                        $('#frm_data_entry select[name=header\\[job_level\\]]').multiselect('select',data.job_level);
                        $('#frm_data_entry input[name=placeholder\\[job_level\\]]').val(data.job_level_text);
                        $('#frm_data_entry select[name=header\\[job_type\\]]').multiselect('select',data.job_type);
                        $('#frm_data_entry input[name=placeholder\\[job_type\\]]').val(data.job_type_text);
                        $('#frm_data_entry select[name=header\\[education\\]]').multiselect('select',data.education);
                        $('#frm_data_entry input[name=placeholder\\[education\\]]').val(data.education_text);

                        $('#frm_data_entry input[name=placeholder\\[customRadio\\]][value='+data.job_expiration_days+']').prop('checked',true);

                        

                        //$('#frm_data_entry input[id=header\\[department_text\\]]').val(data.department_text);
                        //$('#frm_data_entry input[name=header\\[industry\\]]').val(data.industry);
                        //$('#frm_data_entry input[id=header\\[industry_text\\]]').val(data.industry_text);
                        //$('#frm_data_entry input[name=header\\[job_level\\]]').val(data.job_level);
                        //$('#frm_data_entry input[id=header\\[job_level_text\\]]').val(data.job_level_text);
                        //$('#frm_data_entry input[name=header\\[job_type\\]]').val(data.job_type);
                        //$('#frm_data_entry input[id=header\\[job_type_text\\]]').val(data.job_type_text);
                        //$('#frm_data_entry input[name=header\\[education\\]]').val(data.education);
                        //$('#frm_data_entry input[id=header\\[education_text\\]]').val(data.education_text);

                         
                       
                       
                        
                        $('#frm_data_entry select[name=header\\[location\\]]').multiselect('select',data.location);
                        $('#frm_data_entry input[name=placeholder\\[location\\]]').val(data.location);

                        $('#frm_data_entry input[name=header\\[country\\]]').val(data.country);
                        
                        //$('#frm_data_entry textarea[name=header\\[job_description\\]]').val(data.job_description);
                        //alert(data.job_description)

                        const job_description =  $('#frm_data_entry textarea[name=header\\[job_description\\]]').jqte({
                                // b: false,
                                br: false,
                                center: false,
                                color: false,
                                fsize: false,
                                format: false,
                                i: false,
                                indent: false,
                                link: false,
                                left: false,
                                outdent: false,
                                remove: false,
                                right: false,
                                rule: false,
                                sub: false,
                                sup: false,
                                strike: false,
                                u: false,
                                unlink: false,
                                source: false
                        });
                       
                        job_description.jqteVal(data.job_description);


                        var str = data.job_description;
                        var rows = str.split(/\r\n|\r|\n/).length;
                        if (rows > 1) {
                            rows *= 1;
                        } else {
                            rows *= 2;
                        }
                        //$('#frm_data_entry textarea[name=header\\[job_description\\]]').attr('rows',rows);

                        //$('#frm_data_entry textarea[name=header\\[qualification\\]]').val(data.qualification);
                        const qualification =  $('#frm_data_entry textarea[name=header\\[qualification\\]]').jqte({
                            // b: false,
                            br: false,
                            center: false,
                            color: false,
                            fsize: false,
                            format: false,
                            i: false,
                            indent: false,
                            link: false,
                            left: false,
                            outdent: false,
                            remove: false,
                            right: false,
                            rule: false,
                            sub: false,
                            sup: false,
                            strike: false,
                            u: false,
                            unlink: false,
                            source: false
                        });
                        
                        qualification.jqteVal(data.qualification);

                        //rich text editor
                        if(param.mode == 'view'){
                            //$('.texteditor').jqte();
                            $('.jqte').css({
                                'margin': '0',
                                'border': 'none',
                                'height' : 'auto !important'
                               
                            });
                            $('.jqte_editor').css('resize', 'none');
                            $('.jqte_toolbar').remove();
                            $('.jqte_editor').attr('contenteditable', false);
                        }//END IF

                        var str = data.qualification;
                        var rows = str.split(/\r\n|\r|\n/).length;
                        if (rows > 1) {
                            rows *= 1;
                        } else {
                            rows *= 2;
                        }
                        //$('#frm_data_entry textarea[name=header\\[qualification\\]]').attr('rows',rows);
                        

                        $('#frm_data_entry select[name=header\\[salary_currency\\]]').multiselect('select',data.salary_currency);
                        $('#frm_data_entry input[name=placeholder\\[salary_currency\\]]').val(data.salary_currency);
                        

                        $('#frm_data_entry select[name=header\\[salary_type\\]]').val(data.salary_type);
                        $('#frm_data_entry input[name=placeholder\\[salary_type\\]]').val(data.salary_type);

                        if(param.mode == 'view'){
                            $('#frm_data_entry select[name=header\\[salary_type\\]]').addClass('d-none');
                        }//end if
                        


                        

                        if(param.mode == 'view'){
                            $('#frm_data_entry input[name=header\\[salary_from\\]]').val(toCurrency(data.salary_from));
                            $('#frm_data_entry input[name=header\\[salary_to\\]]').val(toCurrency(data.salary_to));
                            if(data.salary_from <= 0 && data.salary_to <= 0){
                                $('#frm_data_entry input[name=header\\[salary_from\\]]').parent().parent().addClass('d-none');
                            }//end if
                        }else{
                            $('#frm_data_entry input[name=header\\[salary_from\\]]').val(parseFloat(data.salary_from).toFixed(0));
                            $('#frm_data_entry input[name=header\\[salary_to\\]]').val(parseFloat(data.salary_to).toFixed(0));
                        }//end if
                        


                        


                        $('#frm_data_entry input[name=header\\[job_expiration_date\\]]').val(data.job_expiration_date);
                        /*$('#frm_data_entry input[name=header\\[job_expiration_date\\]]').focus(function(){
                            $(this).blur(); 
                        });*/
                        $('#frm_data_entry input[name=header\\[vacancies\\]]').val(data.vacancies);

                        
                        var perks_and_benefits = JSON.parse(data.perks_and_benefits);

                        for(var key in perks_and_benefits){
                            
                            $('input[name=header\\[perks_and_benefits\\]\\[\\]]').each(function(e){
                                //alert($(this).val());
                                if(perks_and_benefits[key] == $(this).val()){
                                    $(this).prop('checked',true);
                                    return false;
                                }//end if
                            })
                        }//end for
                        
                        

                        
                    //----------------------------------------------------------------------------------------------------
                    //end view and edit mode
                }else{
                    //alert(employer_default.industry)
                    //add mode
                    //----------------------------------------------------------------------------------------------------
                    $('#frm_data_entry select[name=header\\[industry\\]]').multiselect('select',employer_default.industry);
                    
                    if(employer[0].doc_image === null || employer[0].doc_image == ""){
                        $('img[id=header\\[company_logo\\]]').attr('src',urlimgdef); 
                    }else{
                        $('img[id=header\\[company_logo\\]]').attr('src',upload_path+employer[0].doc_image);

                    }//end if
                    $('h6[id=header\\[company_name\\]]').html(employer[0].company_name);
                    $('p[id=header\\[location\\]]').html('<small class="text-muted">'+employer[0].locality+'</small>');
                    $('p[id=header\\[date_created\\]]').html('<small class="text-muted">Joined '+employer[0].joined_date+'</small>');
                    //----------------------------------------------------------------------------------------------------
                    //end add mode
                }//end if

                autosize($('.jp-textarea'));

                


                if(param.mode == 'view'){
                    $('#frm_data_entry input:not([readonly]),#frm_data_entry textarea:not([readonly]),select,button').addClass(param.mode);
                    //$('#frm_data_entry input:not([readonly]),textarea:not([readonly]),select').addClass('form-control-plaintext');
                    
                    $('.to_hide').addClass('d-none');
                    //$('#frm_data_entry .tooltip_icon').addClass('d-none');


                    $('#frm_data_entry .input-group-append').addClass('d-none');


                    $('#frm_data_entry select.'+param.mode+'').removeClass('custom-select');


                    $('#frm_data_entry button.'+param.mode+', input.'+param.mode+',textarea.'+param.mode+',select.'+param.mode+'').removeClass('form-control');
                    $('#frm_data_entry button.'+param.mode+', input.'+param.mode+':not([type=checkbox]),textarea.'+param.mode+',select.'+param.mode+'').addClass('form-control-plaintext');

                    $('#frm_data_entry button.'+param.mode+', input.'+param.mode+',textarea.'+param.mode+',select.'+param.mode+'').prop('disabled',true);
                    //$('#frm_data_entry button:not(".multiselect")').addClass('d-none');
                    $('#frm_data_entry input[name^=placeholder]').removeClass('d-none');

                    $('#frm_data_entry button').addClass('d-none');

                    $('.btn_submit').addClass('d-none');

                    $('.btn_edit').removeClass('mr-4');
                    /*if (parseInt(data.applicant_count) > 0) {
                        $('.btn_edit').addClass('d-none');
                    }*/

                    $('.jpvw-currsalary').removeClass('col-3');
                    $('.jpvw-currsalary').addClass('col-1');

                    //custom can be omitted
                    $('#frm_data_entry input#search_location').parent().parent().addClass('d-none');
                    $('#frm_data_entry textarea[name=header\\[location\\]]').parent().parent().removeClass('d-none');
                    $('#frm_data_entry textarea[name=header\\[location\\]]').addClass('form-control-plaintext');
                    $('#frm_data_entry textarea[name=header\\[location\\]]').removeClass('form-control');

                }//end if

                btn.html(btn_text);
                $(".outside_button *").css('pointer-events','auto');
            }else{
                
                //add mode
                //----------------------------------------------------------------------------------------------------
                //alert(JSON.stringify(employer));
                if(param.mode == "add"){
                    if(dropdown_loaded == 0){
                        load_filter_dropdowns();    
                    }//end if
                    $('#frm_data_entry select[name=header\\[industry\\]]').multiselect('select',employer_default.industry);
                    $('#frm_data_entry select[name=header\\[location\\]]').multiselect('select',employer_default.location);
                    if(employer[0].doc_image === null || employer[0].doc_image == ""){
                        $('img[id=header\\[company_logo\\]]').attr('src',urlimgdef); 
                    }else{
                        $('img[id=header\\[company_logo\\]]').attr('src',upload_path+employer[0].doc_image);

                    }//end if
                    $('h6[id=header\\[company_name\\]]').html(employer[0].company_name);
                    $('p[id=header\\[location\\]]').html('<small class="text-muted">'+employer[0].locality+'</small>');
                    $('p[id=header\\[date_created\\]]').html('<small class="text-muted">Joined '+employer[0].joined_date+'</small>');

                    var date = new Date();
                    var expMonth = date.getMonth() + 5;
                    var expDay = date.getDate();
                    var expYear = date.getFullYear();

                    if (expMonth > 12) {
                        expMonth -= 12;
                        expYear = date.getFullYear() + 1;
                    }
                    
                    var expDate = (expMonth<10 ? '0' : '') + expMonth + '/' +
                                (expDay<10 ? '0' : '') + expDay + '/' + expYear;

                    /*$('#frm_data_entry input[name=header\\[job_expiration_date\\]]').val(expDate);
                    $('#frm_data_entry input[name=header\\[job_expiration_date\\]]').focus(function(){
                        $(this).blur(); 
                    });*/
                    
                    $('.jpvw-backbtn').remove();
                    //rich text editor
                    $('.texteditor').jqte({
                        // b: false,
                        br: false,
                        center: false,
                        color: false,
                        fsize: false,
                        fsizes : ["15"],
                        funit : "px",
                        format: false,
                        i: false,
                        indent: false,
                        link: false,
                        left: false,
                        outdent: false,
                        remove: false,
                        right: false,
                        rule: false,
                        sub: false,
                        sup: false,
                        strike: false,
                        u: false,
                        unlink: false,
                        source: false
                    });
                    $('.jqte').css({
                        'margin': '0',
                      });
                    $('.jqte_editor').css('resize', 'none');
                    //end rich text editor
                }else{
                    window.location.replace(baseurl+'/home');
                }
                


               
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
            $(".outside_button *").css('pointer-events','auto');
            $('#loading').hide();
        }).always(function(e){

        });
    }//end load_record
    //=======================================================================================================================
    //end load data

    function selected_perks_and_benefits() {
        var selected = [];
        $('div[name="perks_and_benefits"] input:checked').each(function() {
            selected.push($(this).attr('value'));
        });

        return selected;
    }

    function select_perks_and_benefits(selected) {
        for(var key in selected){
            $('input[name=header\\[perks_and_benefits\\]\\[\\]]').each(function(e){
                if(selected[key] == $(this).val()){
                    $(this).prop('checked',true);
                    return false;
                }
            })
        }
    }

    function load_perks_and_benefits(){
        var url = baseurl + "/job_post/perks_and_benefits";
        $.ajax({
            url: url,
            type: "GET",
            dataType: "JSON",
            async : false,
        }).done(function (response) {
            var html = '<div class="col">';
            var dataCount = response.perks_and_benefits.length;
            var first_col = (dataCount % 2) > 0 ? parseInt((dataCount / 2) + 1) : (dataCount / 2);
            
            for (let key = 0; key < dataCount; key++) {
                const value = response.perks_and_benefits[key];
                
                if(key > (first_col - 1)){
                    break;
                }//end if

                html += '<div class="row">';
                    html += '<div class="col">';

                        if(value['user_type'] !== 'admin'){
                            html += '<button class="close remove_perks_benefits text-danger" type="button" data-dismiss="modal" aria-label="Close" aria-id="'+value['id']+'">';
                                html += '<span aria-hidden="true">×</span>'; 
                            html += '</button>';
                        }//end if

                        html += '<label>';
                            html += ' <input value="'+value['id']+'" type="checkbox" name="header[perks_and_benefits][]"/> '+value['name'];
                        html += '</label>';  
                    html += '</div>';
                html += '</div>';

            }//end for loop
            html += '</div>';

            html += '<div class="col">';
            for (let key = 0; key < dataCount; key++) {
                const value = response.perks_and_benefits[key];

                if(key > (first_col - 1)){
                    html += '<div class="row">';
                        html += '<div class="col">';
                            if(value['user_type'] !== 'admin'){
                                    html += '<button class="close remove_perks_benefits text-danger" type="button" data-dismiss="modal" aria-label="Close" aria-id="'+value['id']+'">';
                                    html += '<span aria-hidden="true">×</span>';
                                html += '</button>';
                            }//end if
                        
                            
                            html += '<label>';
                                html += ' <input value="'+value['id']+'" type="checkbox" name="header[perks_and_benefits][]"/> '+value['name'];
                            html += '</label>';    
                        html += '</div>';
                    html += '</div>';
                }//end if

            }//end for loop
            html += '</div>';

            $('div[name="perks_and_benefits"').html(html);
        }).fail(function(e){
            alert(e.responseText);

        });
    }

    function check_account_status(){
        var url = homeurl;
        url = homeurl + "/check_account_status";

        $.ajax({
            url: url,
            type: "GET",
            dataType: "JSON",
        })
            .done(function (data) {
                if (data.success === false) {
                    var msg_html = "";
                    var arr = [];
                    for (var i = 0; i <= data.messages.length - 1; i++) {
                        for (var element in data.messages[i]) {
                            arr.push(data.messages[i][element]);
                            msg_html += data.messages[i][element] + "\n";
                        }
                    }

                    $.notify(msg_html, {
                    position: "top center",
                    className: "error",
                    arrowShow: true,
                    });

                }
            })
            .fail(function (e) {
                alert(e.responseText);
            })
            .always(function (e) {});
      
    }

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
                    }else if(type == 'salary_currency'){
                        html += '<option value="'+response.data[key].code+'">'+response.data[key].code+'</option>';
                    }else{
                        html += '<option value="'+response.data[key].id+'">'+response.data[key].name+'</option>';
                    }//end if
                }
                
                
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
        load_perks_and_benefits();

        var url     = baseurl + "/get/job_post/odepartment";
        var dropdown    = $('select[name=header\\[department\\]]');
        load_dropdown(url,dropdown,'department');
        load_dropdowns('department');

        var url     = baseurl + "/get/signup/industry/0";
        var dropdown    = $('select[name=header\\[industry\\]]');
        load_dropdown(url,dropdown,'industry');
        load_dropdowns('industry');

        var url     = baseurl + "/get/job_post/ojob_level";
        var dropdown    = $('select[name=header\\[job_level\\]]');
        load_dropdown(url,dropdown,'job_level');
        load_dropdowns('job_level');

        var url     = baseurl + "/get/job_post/ojob_type";
        var dropdown    = $('select[name=header\\[job_type\\]]');
        load_dropdown(url,dropdown,'job_type');
        load_dropdowns('job_type');

        var url     = baseurl + "/get/job_post/oeducation";
        var dropdown    = $('select[name=header\\[education\\]]');
        load_dropdown(url,dropdown,'education');
        load_dropdowns('education');

        var url     = baseurl + "/get/job_post/olocation";
        var dropdown    = $('select[name=header\\[location\\]]');
        load_dropdown(url,dropdown,'location');
        load_dropdowns('location');

        var url     = baseurl + "/get/job_post/ocurrency";
        var dropdown    = $('select[name=header\\[salary_currency\\]]');
        load_dropdown(url,dropdown,'salary_currency');
        load_dropdowns('salary_currency');
        


        dropdown_loaded = 1;
    }//end if

    



    //Industry autocomplete
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
                     $(".outside_button *").css('pointer-events','none');
                     btn.html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Processing...');
                     btn.attr('disabled','disabled');
                })
            }).done(function (data) {
                
               
                if(data.success === true){

                    var file = data.data.file[0];
                    

                    setTimeout(function(){
                    
                        btn.html('Upload Image');
                        btn.removeAttr('disabled');
                        $(".outside_button *").css('pointer-events','auto');
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
                        $(".outside_button *").css('pointer-events','auto');
                    },2000)
                }
                
                
            }).fail(function(data){
                alert(JSON.stringify(data));
                //setTimeout(function(){
                        
                    //$('#uploadErrorCont').html(data.responseText)
                    btn.html('Upload Image');
                    btn.removeAttr('disabled');
                    $(".outside_button *").css('pointer-events','auto');
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
                     $(".outside_button *").css('pointer-events','none');
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
                        $(".outside_button *").css('pointer-events','auto');
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
                        $(".outside_button *").css('pointer-events','auto');
                    },2000)
                }
                
                
            }).fail(function(data){
                alert(JSON.stringify(data));
                //setTimeout(function(){
                        
                    //$('#uploadErrorCont').html(data.responseText)
                    btn.html('Upload Image');
                    btn.removeAttr('disabled');
                    $(".outside_button *").css('pointer-events','auto');
                //},2000)
            }).always(function(e){

            });
        }
        //End upload image

        
    //===============================================================================================================================
    //End upload image


    //modal
    //=======================================================================================================================
    //Lookup Modal
    $('#add_new_modal').on('shown.bs.modal',function(e){
        //Set Title

        var param   = {};
        var title   = $(e.relatedTarget).data('title');
        title       = title.replace(/_/g,' ');
        //title       = title.toUpperCase();
        var type    = $(e.relatedTarget).data('type');
        var id      = $(e.relatedTarget).data('id');

        param.id    = id;
        param.type  = type;
        //alert(id)
        $('#add_new_modal_title').html(title);
        $('#btn_modal_submit').attr('aria-type',type);


        //$('#btnOk').html('<span class="spinner-grow spinner-grow-sm"></span></span> Loading...');
        //$('#btnOk').attr('disabled','disabled');

        var html_table      = load_edit_form(param);
            $('#add_new_modal_body').html(html_table);
            //$('#frm_'+type+'_edit input[name=header\\[id\\]]').val(id).trigger('blur');
    });

    $('#add_new_modal').on('hide.bs.modal',function(e){
        $('#add_new_modal_title').empty();
        $('#add_new_modal_body').empty();
    })
    //End Lookup Modal
    //=======================================================================================================================
    //end modal

    //table template
    //=======================================================================================================================
    function load_edit_form(param){
        var html = '';

        html += '<form id="frm_perks_and_benefits">';
            html += '<div class="row row-cols-2 mb-3">';
            html += '</div>';
        html += '</form><!--./form-->';
        html += '<input maxlength="200" placeholder="Name" class="modal-input-field form-control form-control-md mb-2 input_add_append" aria-type="perks_and_benefits" type="text" name="header[perks_and_benefits_name]"/>';
        html += '<div class="text-right">';
            html += '<button class="btn btn-pill-sm btn-pill-sm-outline-light text-primary btn_add_append" aria-type="perks_and_benefits"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add New Perks & Benefits</button> ';
        html += '</div><!--./div-->';

       
        return html;
    }//end if
    //=======================================================================================================================
    //end table template

});//End document.ready

