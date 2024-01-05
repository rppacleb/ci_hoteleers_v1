

$(document).ready(function(){

    var homeurl         = baseurl + '/applicant_search';
    var homeurl_txt     = 'applicant_search';
    var urlimgdef       = baseurl + '/files/images/default/user.png';
    var urlimgnotfound  = baseurl + '/assets/img/main/image-not-found.svg';
    var upload_path     = baseurl + '/files/uploads/';
   // load_record(0,'signup','main_container','main_pagination','main_loader');

   //alert(moment('4/30/2016', 'MM/DD/YYYY').add(1, 'day'));

    //highlight
    if(mod_type !== ""){
        $('#'+mod_type).removeClass('text-muted');
        $('#'+mod_type).addClass('active');
        $('#'+mod_type).css({'opacity': 0.8, "background-color": "rgb(0, 41, 170)"});
    }else{
        mod_type = 'side_active_jobs';
        $('#'+mod_type).removeClass('text-muted');
        $('#'+mod_type).addClass('active');
        $('#'+mod_type).css({'opacity': 0.8, "background-color": "rgb(0, 41, 170)"});
    }//end if

    //set step from dropdown
    function highlightStep(){
        var selectedValue = $('select[name=header\\[status\\]]').val();

        $('.step').removeClass('active');
        $(".step").removeClass("complete");
        if(selectedValue == 'short listed'){
            $('#step2').addClass('active');
            $('#step2').prevAll().addClass("complete").removeClass("active");
        } else if(selectedValue == 'for interview'){
            $('#step3').addClass('active');
            $('#step3').prevAll().addClass("complete").removeClass("active");
        } else if(selectedValue == 'offered'){
            $('#step4').addClass('active');
            $('#step4').prevAll().addClass("complete").removeClass("active");
        } else if(selectedValue == 'hired'){
            $('#step5').addClass('active');
            $('#step5').prevAll().addClass("complete").removeClass("active");
        } else {
            $('#step1').addClass('active');
        } 
    }
    //set step from dropdown end

    //stepper function
    $('.step').on('click', function() {
        var selectedValue = $(this).data('step');
        var dropdownValue = $('select[name=header\\[status\\]]').val();
        var defaultText = $(this).find('.step-title').text();
        var $stepTitle = $(this).find('.step-title');
        var tempText = 'Processing';

        if (selectedValue !== dropdownValue && selectedValue !== "" && selectedValue !== "for interview") {
        
        var notification = "Are you sure you want to move this record to "+ selectedValue + "?";
        if (selectedValue === "short listed") {
            notification = "Are you sure you want to Shortlist the candidate?";
        }

        var view_url     = window.location.href;

        var id          = $(this).attr('aria-id');
        //var btn         = $(this);
        var btn_text    = '';
        var id          = $(this).attr('aria-id');
        var type        = $(this).attr('aria-type');
        var type_text   = "";

       
        var url         = homeurl;
        url             = homeurl + '/submit_data';
        var url_view    = homeurl + '/view';
        


        
        var data                    = {};
            data.header             = {};
            data.header.id          = job_post_id;
            data.header.user_id     = user;
            data.header.status      = $(this).data('step');
            data.header.if_current  = 1;


      
            if(confirm(notification)){

            $.ajax({
                url: url,
                type: "POST",
                data: data,
                dataType: "JSON",
                beforeSend : function(){
                    $(".outside_button *").css('pointer-events','none');
                    $stepTitle.text('Processing');
                    $('.step').addClass('disabled');

                },
            }).done(function (data) {
                   
                    //alert(Object.keys(data.messages).length);
                    if (data.success === true){
                        console.log(JSON.stringify(data.messages));
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


                        //view_url += data.data.id;
                        setTimeout(function(){
                            window.location.replace(view_url);;
                            $stepTitle.text(defaultText);
                            $('.step').removeClass('disabled');
                        },2000)

                        //load_record(0,type,type+'_container',type+'_pagination',type+'_loader');
                        //$(frm_id+' input[name=header\\[id\\]').val('');
                        //$(frm_id+' input[name=header\\[name\\]').val('');

                        //load_record(0,'signup','main_container','main_pagination','main_loader');

                    } else {
                        console.log(JSON.stringify(data.messages));
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

                        $stepTitle.text(defaultText);
                        $('.step').removeClass('disabled');
                        $(".outside_button *").css('pointer-events','auto');
                    }
                }).fail(function(e){
                    alert(e.responseText);

                    $stepTitle.text(defaultText);
                    $('.step').removeClass('disabled');
                    $(".outside_button *").css('pointer-events','auto');
                }).always(function(e){

            });
        }
        } else if (selectedValue == 'for interview') {
            //check if there's a pending interview
            var data = {};
            data.job_post_id = job_post_id;
            data.user_id = user;
            const param = {
                "url" : homeurl + '/check_interview',
                "data" : data
            }
            const w_interview = w_pending_interview(param);
            
            if(!w_interview["success"]){
                if(confirm("You'll be redirected to the Schedule Interview page. Click OK to proceed.")){
                    var interview_url = baseurl+'/schedule/add/0?user_id='+user+'&job_post='+job_post_id+'';
                    window.location.replace(interview_url);
                }//end if
            }else{
                var msg_html = 'There\'s already an ongoing interview for this applicant. Please wait for the interview to finish to schedule a new one!';
                $.notify(msg_html,{ 
                    position:"top center",
                    className:"error",
                    arrowShow : true
                });
            }//end if
            //end check if there's a pending interview

            
        }//end if
      });
    //stepper function end
    
    //end highlight

    if ($(window).width() >= 1441 ) {
        $('.container-fluid').css({'max-width': '1440px'});
    } else if ($(window).width() >= 1360 && $(window).width() <= 1440) {
        $('.container-fluid').css({'max-width': '1350px'});
    } else if ($(window).width() >= 1200 && $(window).width() <= 1359) {
        $('.container-fluid').css({'max-width': '1200px'});
    }

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
    
    
    //approve
    $(document.body).on('click','button.btn_submit',function(e){
        var view_url     = window.location.href;

        var id          = $(this).attr('aria-id');
        var btn         = $(this);
        var btn_text    = '';
        var id          = $(this).attr('aria-id');
        var type        = $(this).attr('aria-type');
        var type_text   = "";

       
        var url         = homeurl;
        url             = homeurl + '/submit_data';
        var url_view    = homeurl + '/view';
        


        
        var data                    = {};
            data.header             = {};
            data.header.id          = job_post_id;
            data.header.user_id     = user;
            data.header.status      = $('select[name=header\\[status\\]]').val();
            data.header.if_current  = 1;
         

        btn_text = "Submit";
    
      
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
                        console.log(JSON.stringify(data.messages));
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


                        //view_url += data.data.id;
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
                        console.log(JSON.stringify(data.messages));
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


    //load industry autocomplete
    $(document.body).on('focus','input[id=row_industry\\[industry_text\\]\\[\\]]',function(){
        if(!$(this).hasClass('wauto')){

            var input = $(this).parent().parent();
            load_industry_autocomplete($(this),input.parent().find('input[name=row_industry\\[industry\\]\\[\\]]'));
            $(this).addClass('wauto');
        }//End if
    })//focus
    $(document.body).on('blur','input[id=row_industry\\[industry_text\\]\\[\\]]',function(){
        var input = $(this).parent().parent();
        if($(this).val() == ""){
            input.parent().find('input[name=row_industry\\[industry\\]\\[\\]]').val('');
        }//end if

        if(input.parent().find('input[name=row_industry\\[industry\\]\\[\\]]').val() == ''){
            $(this).val('');
        }//end if
    })//blur


    //load education autocomplete
    $(document.body).on('focus','input[id=row_education\\[education_text\\]\\[\\]]',function(){
        if(!$(this).hasClass('wauto')){
            var input = $(this).parent().parent();
            load_education_autocomplete($(this),input.parent().find('input[name=row_education\\[education\\]\\[\\]]'));

            //load_education_autocomplete($(this),$('input[name=row_education\\[education\\]\\[\\]]'));
            $(this).addClass('wauto');
        }//End if
    })//focus
    $(document.body).on('blur','input[id=row_education\\[education_text\\]\\[\\]]',function(){
        var input = $(this).parent().parent();
        if($(this).val() == ""){
            input.find('input[name=row_education\\[education\\]\\[\\]]').val('');
        }//end if

        if(input.find('input[name=row_education\\[education\\]\\[\\]]').val() == ''){
            $(this).val('');
        }//end if
    })//blur

    //load job level autocomplete
    $(document.body).on('focus','input[id=row_job_level\\[job_level_text\\]\\[\\]]',function(){
        if(!$(this).hasClass('wauto')){

            var input = $(this).parent().parent();
            load_job_level_autocomplete($(this),input.parent().find('input[name=row_job_level\\[job_level\\]\\[\\]]'));
            $(this).addClass('wauto');
        }//End if
    })//focus
    $(document.body).on('blur','input[id=row_job_level\\[job_level_text\\]\\[\\]]',function(){
        var input = $(this).parent().parent();
        if($(this).val() == ""){
            input.parent().find('input[name=row_job_level\\[job_level\\]\\[\\]]').val('');
        }//end if

        if(input.parent().find('input[name=row_job_level\\[job_level\\]\\[\\]]').val() == ''){
            $(this).val('');
        }//end if
    })//blur


    //load job type autocomplete
    $(document.body).on('focus','input[id=row_job_type\\[job_type_text\\]\\[\\]]',function(){
        if(!$(this).hasClass('wauto')){

            var input = $(this).parent().parent();
            load_job_type_autocomplete($(this),input.parent().find('input[name=row_job_type\\[job_type\\]\\[\\]]'));
            $(this).addClass('wauto');
        }//End if
    })//focus
    $(document.body).on('blur','input[id=row_job_type\\[job_type_text\\]\\[\\]]',function(){
        var input = $(this).parent().parent();
        if($(this).val() == ""){
            input.parent().find('input[name=row_job_type\\[job_type\\]\\[\\]]').val('');
        }//end if

        if(input.parent().find('input[name=row_job_type\\[job_type\\]\\[\\]]').val() == ''){
            $(this).val('');
        }//end if
    })//blur

    //load job type autocomplete
    $(document.body).on('focus','input[id=row_department\\[department_text\\]\\[\\]]',function(){
        if(!$(this).hasClass('wauto')){

            var input = $(this).parent().parent();
            load_department_autocomplete($(this),input.parent().find('input[name=row_department\\[department\\]\\[\\]]'));
            $(this).addClass('wauto');
        }//End if
    })//focus
    $(document.body).on('blur','input[id=row_department\\[department_text\\]\\[\\]]',function(){
        var input = $(this).parent().parent();
        if($(this).val() == ""){
            input.parent().find('input[name=row_department\\[department\\]\\[\\]]').val('');
        }//end if

        if(input.parent().find('input[name=row_department\\[department\\]\\[\\]]').val() == ''){
            $(this).val('');
        }//end if
    })//blur



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


    })
    //end remove trigger

    //remove trigger
    $(document.body).on('click','button[name=btn_remove_multiple]',function(e){
        
        //$('img[id=header\\[company_logo\\]]').attr('src',(urlimgdef));
        $('#image_cont').empty();
        $('input[name=file\\[resume_content\\]]').val('');
        $('input[name=header\\[resume\\]]').val('');
        
    })
    //end remove trigger


    //add experience
    $(document.body).on('click','button[name=btn_add_experience]',function(e){
        var param       = {};
        var line = catchIsNaN($('input[name=row_experience\\[line\\]\\[\\]]:last').val()) + 1;

        var table_html = load_experience_form(param);
        $('#experience_content').append(table_html);
        

        $('input[name=row_experience\\[line\\]\\[\\]]:last').val(line);

        //Initialize date time picker
        $('input[name=row_experience\\[start_date\\]\\[\\]]').datetimepicker({
            format: 'M/D/YYYY'

        });

        $('input[name=row_experience\\[end_date\\]\\[\\]]').datetimepicker({
            format: 'M/D/YYYY'
        });

        $('input[name=row_experience\\[designation\\]\\[\\]]:last').focus();
    })
    //end add experience

    //add skills
    $(document.body).on('click','button[name=btn_add_skills]',function(e){
        var param           = {};
        var line            = catchIsNaN($('input[name=row_skills\\[line\\]\\[\\]]:last').val()) + 1;
        var table_html      = load_skills_form(param);
        $('#skills_content').append(table_html);
        $('input[name=row_skills\\[line\\]\\[\\]]:last').val(line);
        $('input[name=row_skills\\[skills\\]\\[\\]]:last').focus();
    })
    //end add skills

    //add education
    $(document.body).on('click','button[name=btn_add_education]',function(e){
        var param           = {};
        var line            = catchIsNaN($('input[name=row_education\\[line\\]\\[\\]]:last').val()) + 1;
        var table_html      = load_education_form(param);
        $('#education_content').append(table_html);
        $('input[name=row_education\\[line\\]\\[\\]]:last').val(line);

        //Initialize date time picker
        $('input[name=row_education\\[start_date\\]\\[\\]]').datetimepicker({
            format: 'M/D/YYYY'

        });

        $('input[name=row_education\\[end_date\\]\\[\\]]').datetimepicker({
            format: 'M/D/YYYY'
        });

        $('input[name=row_education\\[school\\]\\[\\]]:last').focus();
    })
    //end add education

    //add skills
    $(document.body).on('click','button[name=btn_add_language]',function(e){
        var param           = {};
        var line            = catchIsNaN($('input[name=row_language\\[line\\]\\[\\]]:last').val()) + 1;
        var table_html      = load_language_form(param);
        $('#language_content').append(table_html);
        $('input[name=row_language\\[line\\]\\[\\]]:last').val(line);
        $('input[name=row_language\\[language\\]\\[\\]]:last').focus();
    })
    //end add skills

    //add certification and licenses
    $(document.body).on('click','button[name=btn_add_certification]',function(e){
        var param       = {};
        var line        = catchIsNaN($('input[name=row_certification\\[line\\]\\[\\]]:last').val()) + 1;
        var table_html  = load_certification_form(param);
        $('#certification_content').append(table_html);
        $('input[name=row_certification\\[line\\]\\[\\]]:last').val(line);
        $('input[name=row_certification\\[certification\\]\\[\\]]:last').focus();
    })
    //end add certification and licenses

    //add projects
    $(document.body).on('click','button[name=btn_add_projects]',function(e){
        var param       = {};
        var line        = catchIsNaN($('input[name=row_projects\\[line\\]\\[\\]]:last').val()) + 1;
        var table_html = load_projects_form(param);
        $('#projects_content').append(table_html);
        
        $('input[name=row_projects\\[line\\]\\[\\]]:last').val(line);
        $('input[name=row_projects\\[projects\\]\\[\\]]:last').focus();
    })
    //end add projects

    //add seminar and training
    $(document.body).on('click','button[name=btn_add_seminar_training]',function(e){
        var param       = {};
        var line        = catchIsNaN($('input[name=row_seminar_training\\[line\\]\\[\\]]:last').val()) + 1;
        var table_html = load_seminar_training_form(param);
        $('#seminar_training_content').append(table_html);
        
        $('input[name=row_seminar_training\\[line\\]\\[\\]]:last').val(line);
        $('input[name=row_seminar_training\\[seminar_training\\]\\[\\]]:last').focus();
    })
    //end add seminar and training

    //add awards and achievement
    $(document.body).on('click','button[name=btn_add_awards_achievements]',function(e){
        var param       = {};
        var line        = catchIsNaN($('input[name=row_award_achievement\\[line\\]\\[\\]]:last').val()) + 1;
        var table_html = load_awards_achievements_form(param);
        $('#awards_achievements_content').append(table_html);
        
        $('input[name=row_award_achievement\\[line\\]\\[\\]]:last').val(line);
        $('input[name=row_award_achievement\\[award_achievement\\]\\[\\]]:last').focus();
    })
    //end add awards and achievement

    //add affiliations
    $(document.body).on('click','button[name=btn_add_affiliations]',function(e){
        var param       = {};
        var line        = catchIsNaN($('input[name=row_affiliation\\[line\\]\\[\\]]:last').val()) + 1;
        var table_html = load_affiliations_form(param);
        $('#affiliations_content').append(table_html);
        
        $('input[name=row_affiliation\\[line\\]\\[\\]]:last').val(line);
        $('input[name=row_affiliation\\[affiliation\\]\\[\\]]:last').focus();
    })
    //end add affiliations


    //add industry
    $(document.body).on('click','button[name=btn_add_industry]',function(e){
        var param       = {};
        var line        = catchIsNaN($('input[name=row_industry\\[line\\]\\[\\]]:last').val()) + 1;
        var table_html = load_industry_form(param);
        $('#industry_content').append(table_html);

        
        $('input[name=row_industry\\[line\\]\\[\\]]:last').val(line);
        $('input[id=row_industry\\[industry_text\\]\\[\\]]:last').focus();
    })
    //end add affiliations

    //add affiliations
    $(document.body).on('click','button[name=btn_add_job_level]',function(e){
        var param       = {};
        var line        = catchIsNaN($('input[name=row_job_level\\[line\\]\\[\\]]:last').val()) + 1;
        var table_html = load_job_level_form(param);
        $('#job_level_content').append(table_html);
        
        $('input[name=row_job_level\\[line\\]\\[\\]]:last').val(line);
        $('input[id=row_job_level\\[job_level_text\\]\\[\\]]:last').focus();
    })
    //end add affiliations

    //add affiliations
    $(document.body).on('click','button[name=btn_add_job_type]',function(e){
        var param       = {};
        var line        = catchIsNaN($('input[name=row_job_type\\[line\\]\\[\\]]:last').val()) + 1;
        var table_html = load_job_type_form(param);
        $('#job_type_content').append(table_html);
        
        $('input[name=row_job_type\\[line\\]\\[\\]]:last').val(line);
        $('input[id=row_job_type\\[job_type_text\\]\\[\\]]:last').focus();
    })
    //end add affiliations

    //add department
    $(document.body).on('click','button[name=btn_add_department]',function(e){
        var param       = {};
        var line        = catchIsNaN($('input[name=row_department\\[line\\]\\[\\]]:last').val()) + 1;
        var table_html = load_department_form(param);
        $('#department_content').append(table_html);
        
        $('input[name=row_department\\[line\\]\\[\\]]:last').val(line);
        $('input[id=row_department\\[department_text\\]\\[\\]]:last').focus();
    })
    //end add affiliations

    //remove experience
    $(document.body).on('click','button.close',function(e){
        var input = $(this).parent().parent();
            input = input.parent();
        $(this).parent().parent().remove();
        
        ctr = 1;
        input.find('input[name*=line]').each(function(){
            $(this).val(ctr);
            ctr += 1;
        });

    })
    //end remove experience

    $(document.body).on('change','input[id*=if_current]',function(e){
        var is_checked = $(this).is(':checked');
            if(is_checked){
                is_checked = 1;
            }else{
                is_checked = 0;
            }//end if


        var input   = $(this).parent().parent();
            input   = input.parent().parent();
            input   = input.parent().find('input[name*=if_current]');
            input.val(0);
           
        
        var checkboxes = $(this).parent().parent();
            checkboxes  = checkboxes.parent().parent();
            checkboxes  = checkboxes.parent().find('input[id*=if_current]:checked');
            checkboxes.prop('checked',false);
            
        
        var current_input   = $(this).parent().parent();
            current_input   = current_input.parent().find('input[name*=if_current]');
            $(this).prop('checked',is_checked);
            current_input.val(is_checked);
            
            //$(this).prop('checked',is_checked);
    })
    $(document.body).on('change','select[name=header\\[status\\]]',function(e){
        var status = $(this).val();
        var interview_url = baseurl+'/schedule/add/0?user_id='+user+'&job_post='+job_post_id+'';
        
        if(status == 'for interview'){
           // alert(interview_url);
            window.location.replace(interview_url);
        }
    })
    //=====================================================================================================================
    //end events

    


    

    //sourcing
    //=======================================================================================================================
    //check interview
    function w_pending_interview(param){
        var response = {};
        $.ajax({
            url: param.url,
            type: "POST",
            async : false,
            data: param.data,
            dataType: "JSON",
            beforeSend : function(){
            },
            }).done(function (data) {
                response = data;
            }).fail(function(e){
                alert(e.responseText);
            });
        
        return response
    }//end function
    //end check interview

    
    
    //load data
    function load_data(param){
        var url         = homeurl + '/load_data/'+param.id+'?job_post='+job_post_id+'&user_id='+user_id+'&employer_id='+employer_id;
        var btn         = $('.btn_submit');
        var btn_text    = 'Submit';
        var compare_with_url = baseurl + '/compare_applicant?job_post='+job_post_id+'&user_id='+param.id+'&employer_id='+employer_id;
        $.ajax({
            url: url,
            type: "POST",
            dataType: "JSON",
            beforeSend : function(){
                $(".outside_button *").css('pointer-events','none');
                btn.html('<div class="spinner-grow"></div>');
                btn.attr('disabled',true);
            },
        }).done(function (response) {

            if(response.data !== null && response.data !== undefined){

                var data = response.data[0];

                
                if(data !== undefined){

                   

                    if(param.mode == 'edit' || param.mode == 'view'){
                        //view and edit mode
                        //----------------------------------------------------------------------------------------------------
                            
                            $('span[id=job_title]').text(data.job_title);
                            
                            $('select[name=header\\[status\\]]').val(data.status);
                            //side profile
                            $('#frm_data_entry input[name=header\\[doc_image\\]]').val(data.doc_image);
                            $('#frm_data_entry input[name=file\\[old_doc_image\\]]').val(data.doc_image);
                            
                            $('h6[id=header\\[company_name\\]]').text(data.full_name);
                            $('p[id=header\\[date_created\\]]').html('<small class="text-muted">Joined '+data.joined_date+'</small>');
                            
                            
                            var img_src = urlimgdef;
                            if(data.doc_image !== null || data.doc_image !== ""){
                                img_src = upload_path+data.doc_image;
                            }//end if

                            if(!data.doc_image){
                                img_src = urlimgdef;
                            }//end if

                            if(!image.imageExists(img_src)){
                                img_src = urlimgnotfound;
                            }//end if

                            
                            

                            $('img[id=header\\[company_logo\\]]').attr('src',img_src);

                            $('small[id=header\\[userid\\]]').html('ID: '+data.id);

                            //resume file
                            $('#frm_data_entry input[name=header\\[resume\\]]').val(data.resume);
                            $('#frm_data_entry input[name=file\\[old_resume\\]]').val(data.resume);

                            var html = '';

                            html += '<div class="form-group row" style="margin-left: auto; margin-right: auto;">';
                                html += '<div class="col-1">';
                                html += '</div><!--./col-1-->';
                                html += '<div class="col-8 align-self-center">';
                                    html += data.resume;
                                html += '</div><!--./col-10-->';
                                html += '<div class="col-3">';
                                        html += '<a href="'+upload_path+data.resume+'" class="btn btn-md btn-primary" target="_blank">Preview</a>';
                                html += '</div><!--./col-10-->';                                
                            html += '</div><!--./form-group-->';

                           
                            if(data.resume !== ""){
                                $('#image_cont').html(html);
                            }//end if
                            


                            //primary info
                            $('#frm_data_entry input[name=header\\[first_name\\]]').val(data.first_name);
                            $('#frm_data_entry input[name=header\\[middle_name\\]]').val(data.middle_name);
                            $('#frm_data_entry input[name=header\\[last_name\\]]').val(data.last_name);
                            $('#frm_data_entry input[name=header\\[email_add\\]]').val(data.email_add);
                            $('#frm_data_entry select[name=header\\[dial_code\\]]').val(data.dial_code);
                            $('#frm_data_entry input[name=header\\[contact_number\\]]').val(data.contact_number);
                            $('#frm_data_entry textarea[name=header\\[highlights\\]]').val(data.highlights);
                            /* var str = data.highlights;
                            var rows = str.split(/\r\n|\r|\n/).length;
                            rows += 8;
                            $('#frm_data_entry textarea[name=header\\[highlights\\]]').attr('rows',rows); */

                            data.internship = parseInt(data.internship);
                            $('#frm_data_entry input[name=header\\[internship\\]]').prop('checked',data.internship);
                            //end primary info

                            if(param.mode == 'view') {
                                if(data.internship == 0){
                                    $('.asvw-internship').remove();
                                }
                            }

                            compare_with_url += '&status='+data.status;

                            $('a.btn_compare').attr('href',compare_with_url);

                            //location
                            $('#frm_data_entry input[id=search_location]').val(data.location);
                            $('p[id=header\\[location\\]]').html('<small class="text-muted">'+data.location+'</small>');
                            $('#frm_data_entry input[name=header\\[location\\]]').val(data.location);
                            $('#frm_data_entry input[name=header\\[country\\]]').val(data.country);
                            
                            
                            //end location


                            if(parseInt(data.is_interviewed)){

                                $('.btn_for_interview').addClass('d-none');
                            }//end if
                            
                            if(data.status == "" || data.status == "hired"){
                                $('.btn_compare').addClass('d-none');
                            }//end if
                            
                            
                            
                            

                            //populate lines
                            //experience
                            html            = '';
                            data_lines      = response.line_experience;
                            for(var key in data_lines){
                                html += '<div class="card mb-2">';
                                    html += '<div class="card-body">';
                                        html += '<button type="button" class="close" aria-label="Close">';
                                            html += '<span aria-hidden="true">&times;</span>';
                                        html += '</button>';
                                    html += '</div>';
                                    html += '<div class="card-body">';
                                    

                                    html += '<div class="form-group row d-none">';
                                        html += '<label class="col-3 col-form-label text-right align-self-center">Line</label>';
                                        html += '<div class="col align-self-center">';
                                            html += '<input value="'+data_lines[key]['line']+'" readonly class="form-control form-control-sm" type="text" name="row_experience[line][]" maxlength="100"/>';
                                        html += '</div><!--./col-10-->';
                                    html += '</div><!--./form-group-->';

                                    html += '<div class="form-group row">';
                                        html += '<label class="col-3 col-form-label text-right align-self-center">Position</label>';
                                        html += '<div class="col align-self-center">';
                                            html += '<input value="'+data_lines[key]['designation']+'" class="form-control form-control-sm" type="text" name="row_experience[designation][]" maxlength="100"/>';
                                        html += '</div><!--./col-10-->';
                                    html += '</div><!--./form-group-->';

                                    html += '<div class="form-group row">';
                                        html += '<label class="col-3 col-form-label text-right align-self-center">Company Name</label>';
                                        html += '<div class="col align-self-center">';
                                            html += '<input value="'+data_lines[key]['company_name']+'" class="form-control form-control-sm" type="text" name="row_experience[company_name][]" maxlength="100"/>';
                                        html += '</div><!--./col-10-->';
                                    html += '</div><!--./form-group-->';

                                    /* var str = data_lines[key]['short_description'];
                                    var rows = str.split(/\r\n|\r|\n/).length;
                                    rows += 8; */

                                    html += '<div class="form-group row">';
                                        html += '<label class="col-3 col-form-label text-right align-self-center">Short description</label>';
                                        html += '<div class="col align-self-center">';
                                            html += '<textarea class="form-control form-control-sm asvw-textarea" name="row_experience[short_description][]">'+data_lines[key]['short_description']+'</textarea>';
                                        html += '</div><!--./col-10-->';
                                    html += '</div><!--./form-group-->';

                                    if(param.mode == 'view') {
                                        if(data_lines[key]['if_current'] == 0){
                                            html += '<div class="form-group row">';
                                                html += '<label class="col-3 col-form-label text-right align-self-center">Start Date</label>';
                                                html += '<div class="col-3 align-self-center">';
                                                    html += '<div class="input-group input-group-sm">';
                                                        html += '<input value="'+data_lines[key]['start_date_placeholder']+'" class="form-control-sm d-none" type="text" name="placeholder[start_date][]"/>';
                                                        html += '<input value="'+data_lines[key]['start_date']+'" class="form-control form-control-sm" type="text" name="row_experience[start_date][]"/>';
                                                        html += '<div class="input-group-append">';
                                                            html += '<span class="input-group-text"><i class="fa fa-calendar"></i></span>';
                                                        html += '</div><!--./input-group-append-->';
                                                    html += '</div><!--./input-group input-group-sm-->';
                                                html += '</div><!--./col-->';
                                                
                                                html += '<label class="col-2 col-form-label text-right align-self-center">End Date</label>';
                                                html += '<div class="col-3 align-self-center">';
                                                    html += '<div class="input-group input-group-sm date">';
                                                        html += '<input value="'+data_lines[key]['end_date_placeholder']+'" class="form-control-sm d-none" type="text" name="placeholder[end_date][]"/>';
                                                        html += '<input value="'+data_lines[key]['end_date']+'" class="form-control form-control-sm" type="text" name="row_experience[end_date][]"/>';
                                                        html += '<div class="input-group-append">';
                                                            html += '<span class="input-group-text"><i class="fa fa-calendar"></i></span>';
                                                        html += '</div><!--./input-group-append-->';
                                                    html += '</div><!--./input-group input-group-sm-->';
                                                html += '</div><!--./col-10-->';
                                            html += '</div><!--./form-group-->';
                                        } else {
                                            html += '<div class="form-group row">';
                                                html += '<label class="col-3 col-form-label text-right align-self-center">Start Date</label>';
                                                html += '<div class="col-3 align-self-center" style="width: 18.666667%;">';
                                                    html += '<div class="input-group input-group-sm">';
                                                        html += '<input value="'+data_lines[key]['start_date_placeholder']+'" class="form-control-sm d-none" type="text" name="placeholder[start_date][]"/>';
                                                        html += '<input value="'+data_lines[key]['start_date']+'" class="form-control form-control-sm" type="text" name="row_experience[start_date][]"/>';
                                                        html += '<div class="input-group-append">';
                                                            html += '<span class="input-group-text"><i class="fa fa-calendar"></i></span>';
                                                        html += '</div><!--./input-group-append-->';
                                                    html += '</div><!--./input-group input-group-sm-->';
                                                html += '</div><!--./col-->';

                                                html += '<div class="col-1 align-self-center" style="width: 11.333333%;">-';
                                                html += '</div><!--./col-->';
                                                html += '<label class="col-2 col-form-label align-self-center">Present</label>';
                                            html += '</div><!--./form-group-->';
                                        }
                                    } else {
                                        html += '<div class="form-group row">';
                                            html += '<label class="col-3 col-form-label text-right align-self-center">Start Date</label>';
                                            html += '<div class="col-3 align-self-center">';
                                                html += '<div class="input-group input-group-sm">';
                                                    html += '<input value="'+data_lines[key]['start_date_placeholder']+'" class="form-control-sm d-none" type="text" name="placeholder[start_date][]"/>';
                                                    html += '<input value="'+data_lines[key]['start_date']+'" class="form-control form-control-sm" type="text" name="row_experience[start_date][]"/>';
                                                    html += '<div class="input-group-append">';
                                                        html += '<span class="input-group-text"><i class="fa fa-calendar"></i></span>';
                                                    html += '</div><!--./input-group-append-->';
                                                html += '</div><!--./input-group input-group-sm-->';
                                            html += '</div><!--./col-->';
                                            
                                            html += '<label class="col-2 col-form-label text-right align-self-center" id="edlabel'+key+'">End Date</label>';
                                            html += '<div class="col-3 align-self-center" id="edcol'+key+'">';
                                                html += '<div class="input-group input-group-sm date">';
                                                    html += '<input value="'+data_lines[key]['end_date_placeholder']+'" class="form-control-sm d-none" type="text" name="placeholder[end_date][]"/>';
                                                    html += '<input value="'+data_lines[key]['end_date']+'" class="form-control form-control-sm" type="text" name="row_experience[end_date][]"/>';
                                                    html += '<div class="input-group-append">';
                                                        html += '<span class="input-group-text"><i class="fa fa-calendar"></i></span>';
                                                    html += '</div><!--./input-group-append-->';
                                                html += '</div><!--./input-group input-group-sm-->';
                                            html += '</div><!--./col-10-->';
                                        html += '</div><!--./form-group-->';
                                    }

                                    if(param.mode == 'view') {
                                        // if(data_lines[key]['if_current'] == 1){
                                        //     html += '<div class="form-group row">';
                                        //         html += '<label class="col-3 col-form-label text-right align-self-center">If Current</label>';
                                        //         html += '<div class="col-1 align-self-center">';
                                        //             html += '<input '+(data_lines[key]['if_current'] == 1? 'checked' : '')+' value="false" type="checkbox" class="w-auto" id="row_experience[if_current][]"/>';
                                        //         html += '</div><!--./col-10-->';
                                        //     html += '</div><!--./form-group-->';
                                        // }
                                    } else {
                                        html += '<div class="form-group row">';
                                            html += '<label class="col-3 col-form-label text-right align-self-center">If Current</label>';
                                            html += '<div class="col-1 align-self-center">';
                                                html += '<input '+(data_lines[key]['if_current'] == 1? 'checked' : '')+' value="false" type="checkbox" class="w-auto" id="row_experience[if_current][]"/>';
                                            html += '</div><!--./col-10-->';
                                        html += '</div><!--./form-group-->';
                                    }

                                    html += '<div class="form-group row d-none">';
                                        html += '<label class="col-3 col-form-label text-right align-self-center">If Current</label>';
                                        html += '<div class="col-1 align-self-center">';
                                            html += '<input value="'+data_lines[key]['if_current']+'" type="text" name="row_experience[if_current][]"/>';
                                        html += '</div><!--./col-10-->';
                                    html += '</div><!--./form-group-->';
                                

                                html += '</div>';
                            html += '</div>';
                        }//end for
                        $('#experience_content').html(html);
                        //experience



                        //skills
                        html            = '';
                        data_lines      = response.line_skills;
                        for(var key in data_lines){
                            html += '<div class="card mb-3">';
                                html += '<div class="card-body asvw-skillsbtn">';
                                    html += '<button type="button" class="close" aria-label="Close">';
                                        html += '<span aria-hidden="true">&times;</span>';
                                    html += '</button>';
                                html += '</div>';
                                html += '<div class="card-body asvw-skillscardbody">';

                                    html += '<div class="form-group row d-none">';
                                        html += '<label class="col-3 col-form-label text-right align-self-center">Line</label>';
                                        html += '<div class="col align-self-center">';
                                            html += '<input value="'+data_lines[key]['line']+'" readonly class="form-control form-control-sm" type="text" name="row_skills[line][]" maxlength="100"/>';
                                        html += '</div><!--./col-10-->';
                                    html += '</div><!--./form-group-->';

                                    html += '<div class="form-group row asvw-skillsrow">';
                                        html += '<label class="col-1 col-form-label text-right align-self-center"></label>';
                                        html += '<div class="col align-self-center">';
                                            html += '<input value="'+data_lines[key]['skills']+'" class="form-control form-control-sm" type="text" name="row_skills[skills][]" maxlength="200"/>';
                                        html += '</div><!--./col-10-->';
                                    html += '</div><!--./form-group-->';                
                                html += '</div>';
                            html += '</div>'; 
                        }//end for
                        $('#skills_content').html(html);
                        //end skills


                        //education
                        html            = '';
                        data_lines      = response.line_education;
                        for(var key in data_lines){
                            html += '<div class="card mb-2">';
                                html += '<div class="card-body">';
                                    html += '<button type="button" class="close" aria-label="Close">';
                                        html += '<span aria-hidden="true">&times;</span>';
                                    html += '</button>';
                                html += '</div>';
                                html += '<div class="card-body">';

                                    html += '<div class="form-group row d-none">';
                                        html += '<label class="col-3 col-form-label text-right align-self-center">Line</label>';
                                        html += '<div class="col align-self-center">';
                                            html += '<input value="'+data_lines[key]['line']+'" readonly class="form-control form-control-sm" type="text" name="row_education[line][]" maxlength="100"/>';
                                        html += '</div><!--./col-10-->';
                                    html += '</div><!--./form-group-->';

                                    html += '<div class="form-group row">';
                                        html += '<label class="col-3 col-form-label text-right align-self-center">University/School</label>';
                                        html += '<div class="col align-self-center">';
                                            html += '<input value="'+data_lines[key]['school']+'" class="form-control form-control-sm" type="text" name="row_education[school][]" maxlength="200"/>';
                                        html += '</div><!--./col-10-->';
                                    html += '</div><!--./form-group-->';

                                    html += '<div class="form-group row">';
                                        html += '<label class="col-3 col-form-label text-right align-self-center">Degree/Field of Study</label>';
                                        html += '<div class="col align-self-center">';
                                            html += '<input value="'+data_lines[key]['degree']+'" class="form-control form-control-sm" type="text" name="row_education[degree][]" maxlength="200"/>';
                                        html += '</div><!--./col-10-->';
                                    html += '</div><!--./form-group-->';


                                    

                                    html += '<div class="form-group row">';
                                        html += '<label class="col-3 col-form-label text-right align-self-center">Education</label>';
                                        html += '<div class="col-2 d-none align-self-center">';
                                            html += '<input value="'+data_lines[key]['education']+'" readonly class="form-control form-control-sm" type="text" name="row_education[education][]"/>';
                                        html += '</div>';
                                        html += '<div class="col">';
                                            html += '<div class="input-group input-group-sm">';
                                                html += '<input value="'+data_lines[key]['education_text']+'" class="form-control form-control-sm" type="text" id="row_education[education_text][]"/>';
                                                html += '<div class="input-group-append">';
                                                    html += '<span class="input-group-text"><i class="fa fa-list"></i></span>';
                                                html += '</div><!--./input-group-append-->';
                                            html += '</div><!--./input-group input-group-sm-->';
                                        html += '</div><!--./col-10-->';
                                    html += '</div><!--./form-group-->';


                                    if(param.mode == 'view') {
                                        if(data_lines[key]['if_current'] == 0){
                                            html += '<div class="form-group row">';
                                                html += '<label class="col-3 col-form-label text-right align-self-center">Start Date</label>';
                                                html += '<div class="col-3 align-self-center">';
                                                    html += '<div class="input-group input-group-sm">';
                                                        html += '<input value="'+data_lines[key]['start_date_placeholder']+'" class="form-control-sm d-none" type="text" name="placeholder[start_date][]"/>';
                                                        html += '<input value="'+data_lines[key]['start_date']+'" class="form-control form-control-sm" type="text" name="row_education[start_date][]"/>';
                                                        html += '<div class="input-group-append">';
                                                            html += '<span class="input-group-text"><i class="fa fa-calendar"></i></span>';
                                                        html += '</div><!--./input-group-append-->';
                                                    html += '</div><!--./input-group input-group-sm-->';
                                                html += '</div><!--./col-->';
    
                                                html += '<label class="col-2 col-form-label text-right align-self-center">End Date</label>';
                                                html += '<div class="col-3 align-self-center">';
                                                    html += '<div class="input-group input-group-sm date">';
                                                        html += '<input value="'+data_lines[key]['end_date_placeholder']+'" class="form-control-sm d-none" type="text" name="placeholder[end_date][]"/>';
                                                        html += '<input value="'+data_lines[key]['end_date']+'" class="form-control form-control-sm" type="text" name="row_education[end_date][]"/>';
                                                        html += '<div class="input-group-append">';
                                                            html += '<span class="input-group-text"><i class="fa fa-calendar"></i></span>';
                                                        html += '</div><!--./input-group-append-->';
                                                    html += '</div><!--./input-group input-group-sm-->';
                                                html += '</div><!--./col-10-->';
                                            html += '</div><!--./form-group-->';
                                        } else {
                                            html += '<div class="form-group row">';
                                                html += '<label class="col-3 col-form-label text-right align-self-center">Start Date</label>';
                                                html += '<div class="col-3 align-self-center" style="width: 18.666667%;">';
                                                    html += '<div class="input-group input-group-sm">';
                                                        html += '<input value="'+data_lines[key]['start_date_placeholder']+'" class="form-control-sm d-none" type="text" name="placeholder[start_date][]"/>';
                                                        html += '<input value="'+data_lines[key]['start_date']+'" class="form-control form-control-sm" type="text" name="row_education[start_date][]"/>';
                                                        html += '<div class="input-group-append">';
                                                            html += '<span class="input-group-text"><i class="fa fa-calendar"></i></span>';
                                                        html += '</div><!--./input-group-append-->';
                                                    html += '</div><!--./input-group input-group-sm-->';
                                                html += '</div><!--./col-->';

                                                html += '<div class="col-1 align-self-center" style="width: 11.333333%;">-';
                                                html += '</div><!--./col-->';
                                                html += '<label class="col-2 col-form-label align-self-center">Present</label>';
                                            html += '</div><!--./form-group-->';
                                        }
                                    } else {
                                        html += '<div class="form-group row">';
                                            html += '<label class="col-3 col-form-label text-right align-self-center">Start Date</label>';
                                            html += '<div class="col-3 align-self-center">';
                                                html += '<div class="input-group input-group-sm">';
                                                    html += '<input value="'+data_lines[key]['start_date_placeholder']+'" class="form-control-sm d-none" type="text" name="placeholder[start_date][]"/>';
                                                    html += '<input value="'+data_lines[key]['start_date']+'" class="form-control form-control-sm" type="text" name="row_education[start_date][]"/>';
                                                    html += '<div class="input-group-append">';
                                                        html += '<span class="input-group-text"><i class="fa fa-calendar"></i></span>';
                                                    html += '</div><!--./input-group-append-->';
                                                html += '</div><!--./input-group input-group-sm-->';
                                            html += '</div><!--./col-->';

                                            html += '<label class="col-2 col-form-label text-right align-self-center" id="ed_educationlabel'+key+'">End Date</label>';
                                            html += '<div class="col-3 align-self-center" id="ed_educationcol'+key+'">';
                                                html += '<div class="input-group input-group-sm date">';
                                                    html += '<input value="'+data_lines[key]['end_date_placeholder']+'" class="form-control-sm d-none" type="text" name="placeholder[end_date][]"/>';
                                                    html += '<input value="'+data_lines[key]['end_date']+'" class="form-control form-control-sm" type="text" name="row_education[end_date][]"/>';
                                                    html += '<div class="input-group-append">';
                                                        html += '<span class="input-group-text"><i class="fa fa-calendar"></i></span>';
                                                    html += '</div><!--./input-group-append-->';
                                                html += '</div><!--./input-group input-group-sm-->';
                                            html += '</div><!--./col-10-->';
                                        html += '</div><!--./form-group-->';
                                    }

                                    if(param.mode == 'view') {
                                        // if(data_lines[key]['if_current'] == 1){
                                        //     html += '<div class="form-group row">';
                                        //         html += '<label class="col-3 col-form-label text-right align-self-center">If Current</label>';
                                        //         html += '<div class="col-1 align-self-center">';
                                        //             html += '<input '+(data_lines[key]['if_current'] == 1? 'checked' : '')+' class="w-auto" type="checkbox" id="row_education[if_current][]"/>';
                                        //         html += '</div><!--./col-10-->';
                                        //     html += '</div><!--./form-group-->';
                                        // }
                                    } else {
                                        html += '<div class="form-group row">';
                                            html += '<label class="col-3 col-form-label text-right align-self-center">If Current</label>';
                                            html += '<div class="col-1 align-self-center">';
                                                html += '<input '+(data_lines[key]['if_current'] == 1? 'checked' : '')+' class="w-auto" type="checkbox" id="row_education[if_current][]"/>';
                                            html += '</div><!--./col-10-->';
                                        html += '</div><!--./form-group-->';
                                    }

                                    html += '<div class="form-group row d-none">';
                                        html += '<label class="col-3 col-form-label text-right align-self-center">If Current</label>';
                                        html += '<div class="col-1 align-self-center">';
                                            html += '<input value="'+data_lines[key]['if_current']+'" type="text" name="row_education[if_current][]"/>';
                                        html += '</div><!--./col-10-->';
                                    html += '</div><!--./form-group-->';

                                html += '</div>';
                            html += '</div>';
                        }//end for
                        $('#education_content').html(html);
                        //end education

                        //language
                        html            = '';
                        data_lines  = response.line_language;
                        for(var key in data_lines){
                            html += '<div class="card mb-3">';
                                html += '<div class="card-body asvw-skillsbtn">';
                                    html += '<button type="button" class="close" aria-label="Close">';
                                        html += '<span aria-hidden="true">&times;</span>';
                                    html += '</button>';
                                html += '</div>';
                                html += '<div class="card-body asvw-skillscardbody">';
                                    html += '<div class="form-group row d-none">';
                                        html += '<label class="col-3 col-form-label text-right align-self-center">Line</label>';
                                        html += '<div class="col align-self-center">';
                                            html += '<input value="'+data_lines[key]['line']+'" readonly class="form-control form-control-sm" type="text" name="row_language[line][]" maxlength="100"/>';
                                        html += '</div><!--./col-10-->';
                                    html += '</div><!--./form-group-->';

                                    html += '<div class="form-group row asvw-skillsrow">';
                                        html += '<label class="col-1 col-form-label text-right align-self-center"></label>';
                                        html += '<div class="col align-self-center">';
                                            html += '<input value="'+data_lines[key]['language']+'" class="form-control form-control-sm" type="text" name="row_language[language][]" maxlength="200"/>';
                                        html += '</div><!--./col-10-->';
                                    html += '</div><!--./form-group-->';                
                                html += '</div>';
                            html += '</div>';
                        }//end for
                        $('#language_content').html(html);
                        //end language


                        //certifications and licenses
                        html            = '';
                        data_lines  = response.line_certification;
                        for(var key in data_lines){
                            html += '<div class="card mb-3">';
                                html += '<div class="card-body asvw-skillsbtn">';
                                    html += '<button type="button" class="close" aria-label="Close">';
                                        html += '<span aria-hidden="true">&times;</span>';
                                    html += '</button>';
                                html += '</div>';
                                html += '<div class="card-body asvw-skillscardbody">';
                                    html += '<div class="form-group row d-none">';
                                        html += '<label class="col-3 col-form-label text-right align-self-center">Line</label>';
                                        html += '<div class="col align-self-center">';
                                            html += '<input value="'+data_lines[key]['line']+'" readonly class="form-control form-control-sm" type="text" name="row_certification[line][]" maxlength="100"/>';
                                        html += '</div><!--./col-10-->';
                                    html += '</div><!--./form-group-->';

                                    html += '<div class="form-group row">';
                                        html += '<label class="col-lg-3 col-xl-3 col-auto col-form-label text-right align-self-center">Certification & License</label>';
                                        html += '<div class="col-lg-8 col-xl-8 col-auto align-self-center">';
                                            html += '<input value="'+data_lines[key]['certification']+'" class="form-control form-control-sm" type="text" name="row_certification[certification][]" maxlength="200"/>';
                                        html += '</div><!--./col-10-->';
                                    html += '</div><!--./form-group-->';

                                

                                    html += '<div class="form-group row">';
                                        html += '<label class="col-lg-3 col-xl-3 col-auto col-form-label text-right align-self-center">Issued Date</label>';
                                        html += '<div class="col-lg-3 col-xl-3 col-auto align-self-center">';
                                            html += '<div class="input-group input-group-sm">';
                                                html += '<input value="'+data_lines[key]['issued_date_placeholder']+'" placeholder="M/D/YYYY" class="form-control form-control-sm" type="text" name="row_certification[issued_date][]"/>';
                                                html += '<div class="input-group-append">';
                                                    html += '<span class="input-group-text"><i class="fa fa-calendar"></i></span>';
                                                html += '</div><!--./input-group-append-->';
                                            html += '</div><!--./input-group input-group-sm-->';
                                        html += '</div><!--./col-->';

                                        html += '<label class="col-lg-2 col-xl-2 col-auto col-form-label text-right align-self-center">Exp. Date</label>';
                                        html += '<div class="col-lg-3 col-xl-3 col-auto align-self-center">';
                                            if(data_lines[key]['expiration_date_placeholder'] == null){
                                                data_lines[key]['expiration_date_placeholder'] = 'No Expiration';
                                            }//end if
                                            html += '<div class="input-group input-group-sm date">';
                                                html += '<input value="'+data_lines[key]['expiration_date_placeholder'] +'" placeholder="M/D/YYYY" class="form-control form-control-sm" type="text" name="row_certification[expiration_date][]"/>';
                                                html += '<div class="input-group-append">';
                                                    html += '<span class="input-group-text"><i class="fa fa-calendar"></i></span>';
                                                html += '</div><!--./input-group-append-->';
                                            html += '</div><!--./input-group input-group-sm-->';
                                        html += '</div><!--./col-10-->';
                                    html += '</div><!--./form-group-->';
                                                  
                                html += '</div>';
                            html += '</div>';
                        }//end for
                        $('#certification_content').html(html);
                        //end certifications and licenses

                        //projects
                        html            = '';
                        data_lines  = response.line_projects;
                        for(var key in data_lines){
                            html += '<div class="card mb-3">';
                                html += '<div class="card-body asvw-skillsbtn">';
                                    html += '<button type="button" class="close" aria-label="Close">';
                                        html += '<span aria-hidden="true">&times;</span>';
                                    html += '</button>';
                                html += '</div>';
                                html += '<div class="card-body asvw-skillscardbody">';
                                    html += '<div class="form-group row d-none">';
                                        html += '<label class="col-3 col-form-label text-right align-self-center">Line</label>';
                                        html += '<div class="col align-self-center">';
                                            html += '<input value="'+data_lines[key]['line']+'" readonly class="form-control form-control-sm" type="text" name="row_projects[line][]" maxlength="100"/>';
                                        html += '</div><!--./col-10-->';
                                    html += '</div><!--./form-group-->';

                                    html += '<div class="form-group row asvw-skillsrow">';
                                        html += '<label class="col-1 col-form-label text-right align-self-center"></label>';
                                        html += '<div class="col align-self-center">';
                                            html += '<input value="'+data_lines[key]['projects']+'" class="form-control form-control-sm" type="text" name="row_projects[projects][]" maxlength="200"/>';
                                        html += '</div><!--./col-10-->';
                                    html += '</div><!--./form-group-->';                
                                html += '</div>';
                            html += '</div>';
                        }//end for
                        $('#projects_content').html(html);
                        //end projects

                        //seminar and trainings
                        html            = '';
                        data_lines  = response.line_seminars_trainings;
                        for(var key in data_lines){
                            html += '<div class="card mb-3">';
                                html += '<div class="card-body asvw-skillsbtn">';
                                    html += '<button type="button" class="close" aria-label="Close">';
                                        html += '<span aria-hidden="true">&times;</span>';
                                    html += '</button>';
                                html += '</div>';
                                html += '<div class="card-body asvw-skillscardbody">';
                                    html += '<div class="form-group row d-none">';
                                        html += '<label class="col-3 col-form-label text-right align-self-center">Line</label>';
                                        html += '<div class="col align-self-center">';
                                            html += '<input value="'+data_lines[key]['line']+'" readonly class="form-control form-control-sm" type="text" name="row_seminar_training[line][]" maxlength="100"/>';
                                        html += '</div><!--./col-10-->';
                                    html += '</div><!--./form-group-->';

                                    html += '<div class="form-group row asvw-skillsrow">';
                                        html += '<label class="col-1 col-form-label text-right align-self-center"></label>';
                                        html += '<div class="col align-self-center">';
                                            html += '<input value="'+data_lines[key]['seminar_training']+'" class="form-control form-control-sm" type="text" name="row_seminar_training[seminar_training][]" maxlength="200"/>';
                                        html += '</div><!--./col-10-->';
                                    html += '</div><!--./form-group-->';                
                                html += '</div>';
                            html += '</div>';
                        }//end for
                        $('#seminar_training_content').html(html);
                        //end seminar and trainings


                        //awards and achievements
                        html            = '';
                        data_lines  = response.line_awards_achievements;
                        for(var key in data_lines){
                            html += '<div class="card mb-3">';
                                html += '<div class="card-body asvw-skillsbtn">';
                                    html += '<button type="button" class="close" aria-label="Close">';
                                        html += '<span aria-hidden="true">&times;</span>';
                                    html += '</button>';
                                html += '</div>';
                                html += '<div class="card-body asvw-skillscardbody">';
                                    html += '<div class="form-group row d-none">';
                                        html += '<label class="col-3 col-form-label text-right align-self-center">Line</label>';
                                        html += '<div class="col align-self-center">';
                                            html += '<input value="'+data_lines[key]['line']+'" readonly class="form-control form-control-sm" type="text" name="row_award_achievement[line][]" maxlength="100"/>';
                                        html += '</div><!--./col-10-->';
                                    html += '</div><!--./form-group-->';

                                    html += '<div class="form-group row asvw-skillsrow">';
                                        html += '<label class="col-1 col-form-label text-right align-self-center"></label>';
                                        html += '<div class="col align-self-center">';
                                            html += '<input value="'+data_lines[key]['award_achievement']+'" class="form-control form-control-sm" type="text" name="row_award_achievement[award_achievement][]" maxlength="200"/>';
                                        html += '</div><!--./col-10-->';
                                    html += '</div><!--./form-group-->';                
                                html += '</div>';
                            html += '</div>';
                        }//end for
                        $('#awards_achievements_content').html(html);
                        //end awards and achievements

                        //affiliations
                        html            = '';
                        data_lines  = response.line_affiliations;
                        for(var key in data_lines){
                            html += '<div class="card mb-3">';
                                html += '<div class="card-body asvw-skillsbtn">';
                                    html += '<button type="button" class="close" aria-label="Close">';
                                        html += '<span aria-hidden="true">&times;</span>';
                                    html += '</button>';
                                html += '</div>';
                                html += '<div class="card-body asvw-skillscardbody">';
                                    html += '<div class="form-group row d-none">';
                                        html += '<label class="col-3 col-form-label text-right align-self-center">Line</label>';
                                        html += '<div class="col align-self-center">';
                                            html += '<input value="'+data_lines[key]['line']+'" readonly class="form-control form-control-sm" type="text" name="row_affiliation[line][]" maxlength="100"/>';
                                        html += '</div><!--./col-10-->';
                                    html += '</div><!--./form-group-->';

                                    html += '<div class="form-group row asvw-skillsrow">';
                                        html += '<label class="col-1 col-form-label text-right align-self-center"></label>';
                                        html += '<div class="col align-self-center">';
                                            html += '<input value="'+data_lines[key]['affiliation']+'" class="form-control form-control-sm" type="text" name="row_affiliation[affiliation][]" maxlength="200"/>';
                                        html += '</div><!--./col-10-->';
                                    html += '</div><!--./form-group-->';                
                                html += '</div>';
                            html += '</div>';
                        }//end for
                        $('#affiliations_content').html(html);
                        //end affiliations

                        //industry
                        html            = '';
                        data_lines  = response.line_industry;
                        for(var key in data_lines){
                            html += '<div class="card mb-2">';
                                html += '<div class="card-body">';
                                    html += '<button type="button" class="close" aria-label="Close">';
                                        html += '<span aria-hidden="true">&times;</span>';
                                    html += '</button>';
                                html += '</div>';
                                html += '<div class="card-body">';
                                    html += '<div class="form-group row d-none">';
                                        html += '<label class="col-3 col-form-label text-right align-self-center">Line</label>';
                                        html += '<div class="col align-self-center">';
                                            html += '<input value="'+data_lines[key]['line']+'" readonly class="form-control form-control-sm" type="text" name="row_industry[line][]" maxlength="100"/>';
                                        html += '</div><!--./col-10-->';
                                    html += '</div><!--./form-group-->';

                                    html += '<div class="form-group row">';
                                        html += '<label class="col-3 col-form-label text-right align-self-center">Industry</label>';
                                        html += '<div class="col-2 d-none align-self-center">';
                                            html += '<input value="'+data_lines[key]['industry']+'" readonly class="form-control form-control-sm" type="text" name="row_industry[industry][]"/>';
                                        html += '</div>';
                                        html += '<div class="col align-self-center">';
                                            html += '<div class="input-group input-group-sm">';
                                                html += '<input value="'+data_lines[key]['industry_text']+'" class="form-control form-control-sm" type="text" id="row_industry[industry_text][]"/>';
                                                html += '<div class="input-group-append">';
                                                    html += '<span class="input-group-text"><i class="fa fa-list"></i></span>';
                                                html += '</div><!--./input-group-append-->';
                                            html += '</div><!--./input-group input-group-sm-->';
                                        html += '</div><!--./col-10-->';
                                    html += '</div><!--./form-group-->';
                                html += '</div>';
                            html += '</div>';
                        }//end for
                        $('#industry_content').html(html);
                        //end industry

                        //job level
                        html            = '';
                        data_lines      = response.line_job_level;
                        for(var key in data_lines){
                            html += '<div class="card mb-2">';
                                html += '<div class="card-body">';
                                    html += '<button type="button" class="close" aria-label="Close">';
                                        html += '<span aria-hidden="true">&times;</span>';
                                    html += '</button>';
                                html += '</div>';
                                html += '<div class="card-body">';
                                    html += '<div class="form-group row d-none">';
                                        html += '<label class="col-3 col-form-label text-right align-self-center">Line </label>';
                                        html += '<div class="col align-self-center">';
                                            html += '<input value="'+data_lines[key]['line']+'" readonly class="form-control form-control-sm" type="text" name="row_job_level[line][]" maxlength="100"/>';
                                        html += '</div><!--./col-10-->';
                                    html += '</div><!--./form-group-->';

                                    html += '<div class="form-group row">';
                                        html += '<label class="col-3 col-form-label text-right align-self-center">Job Level </label>';
                                        html += '<div class="col-2 d-none align-self-center">';
                                            html += '<input value="'+data_lines[key]['job_level']+'" readonly class="form-control form-control-sm" type="text" name="row_job_level[job_level][]"/>';
                                        html += '</div>';
                                        html += '<div class="col align-self-center">';
                                            html += '<div class="input-group input-group-sm">';
                                                html += '<input value="'+data_lines[key]['job_level_text']+'" class="form-control form-control-sm" type="text" id="row_job_level[job_level_text][]"/>';
                                                html += '<div class="input-group-append">';
                                                    html += '<span class="input-group-text"><i class="fa fa-list"></i></span>';
                                                html += '</div><!--./input-group-append-->';
                                            html += '</div><!--./input-group input-group-sm-->';
                                        html += '</div><!--./col-10-->';
                                    html += '</div><!--./form-group-->';
                                html += '</div>';
                            html += '</div>';
                        }//end for
                        $('#job_level_content').html(html);
                        //end job level


                        //job type
                        html            = '';
                        data_lines      = response.line_job_type;
                        for(var key in data_lines){
                            html += '<div class="card mb-2">';
                                html += '<div class="card-body">';
                                    html += '<button type="button" class="close" aria-label="Close">';
                                        html += '<span aria-hidden="true">&times;</span>';
                                    html += '</button>';
                                html += '</div>';
                                html += '<div class="card-body">';
                                    html += '<div class="form-group row d-none">';
                                        html += '<label class="col-3 col-form-label text-right align-self-center">Line </label>';
                                        html += '<div class="col align-self-center">';
                                            html += '<input value="'+data_lines[key]['line']+'" readonly class="form-control form-control-sm" type="text" name="row_job_type[line][]" maxlength="100"/>';
                                        html += '</div><!--./col-10-->';
                                    html += '</div><!--./form-group-->';

                                    html += '<div class="form-group row">';
                                        html += '<label class="col-3 col-form-label text-right align-self-center">Job Type </label>';
                                        html += '<div class="col-2 d-none align-self-center">';
                                            html += '<input value="'+data_lines[key]['job_type']+'" readonly class="form-control form-control-sm" type="text" name="row_job_type[job_type][]"/>';
                                        html += '</div>';
                                        html += '<div class="col align-self-center">';
                                            html += '<div class="input-group input-group-sm">';
                                                html += '<input value="'+data_lines[key]['job_type_text']+'" class="form-control form-control-sm" type="text" id="row_job_type[job_type_text][]"/>';
                                                html += '<div class="input-group-append">';
                                                    html += '<span class="input-group-text"><i class="fa fa-list"></i></span>';
                                                html += '</div><!--./input-group-append-->';
                                            html += '</div><!--./input-group input-group-sm-->';
                                        html += '</div><!--./col-10-->';
                                    html += '</div><!--./form-group-->';
                                html += '</div>';
                            html += '</div>';
                        }//end for
                        $('#job_type_content').html(html);
                        //end job type


                        //department
                        html            = '';
                        data_lines      = response.line_department;
                        for(var key in data_lines){
                            html += '<div class="card mb-2">';
                                html += '<div class="card-body">';
                                    html += '<button type="button" class="close" aria-label="Close">';
                                        html += '<span aria-hidden="true">&times;</span>';
                                    html += '</button>';
                                html += '</div>';
                                html += '<div class="card-body">';
                                    html += '<div class="form-group row d-none">';
                                        html += '<label class="col-3 col-form-label text-right align-self-center">Line </label>';
                                        html += '<div class="col align-self-center">';
                                            html += '<input value="'+data_lines[key]['line']+'" readonly class="form-control form-control-sm" type="text" name="row_department[line][]" maxlength="100"/>';
                                        html += '</div><!--./col-10-->';
                                    html += '</div><!--./form-group-->';

                                    html += '<div class="form-group row">';
                                        html += '<label class="col-3 col-form-label text-right align-self-center">Department </label>';
                                        html += '<div class="col-2 d-none align-self-center">';
                                            html += '<input value="'+data_lines[key]['department']+'" readonly class="form-control form-control-sm" type="text" name="row_department[department][]"/>';
                                        html += '</div>';
                                        html += '<div class="col align-self-center">';
                                            html += '<div class="input-group input-group-sm">';
                                                html += '<input value="'+data_lines[key]['department_text']+'" class="form-control form-control-sm" type="text" id="row_department[department_text][]"/>';
                                                html += '<div class="input-group-append">';
                                                    html += '<span class="input-group-text"><i class="fa fa-list"></i></span>';
                                                html += '</div><!--./input-group-append-->';
                                            html += '</div><!--./input-group input-group-sm-->';
                                        html += '</div><!--./col-10-->';
                                    html += '</div><!--./form-group-->';
                                html += '</div>';
                            html += '</div>';
                        }//end for
                        $('#department_content').html(html);
                        //end department


                        //line move to
                        html            = '';
                        var html2       = '';
                        var html3       = '';
                        var html4       = '';
                        var html5       = '';
                        data_lines      = response.line_move_to;

                        
                        for(var key in data_lines){
                            const map_data = data_lines[key];
                            
                            if(map_data["status"] == ''){
                                //html += '<small>'+map_data["application_date"]+'</small><br/>';

                                html += '<tr>';
                                    html += '<td>';
                                        html += '<small>Applied on</small>';
                                    html += '</td>';
                                    html += '<td>';
                                        html += '<small>'+map_data["application_date"]+'</small><br/>'
                                    html += '</td>';
                                html += '</tr>';

                            }//end if 

                            if(map_data["status"] == 'for interview'){
                                //html2 += '<small>'+map_data["application_date"]+'</small><br/>';

                                html2 += '<tr>';
                                    html2 += '<td>';
                                        html2 += '<small>For interview on</small>';
                                    html2 += '</td>';
                                    html2 += '<td>';
                                        html2 += '<small>'+map_data["application_date"]+'</small><br/>'
                                    html2 += '</td>';
                                html2 += '</tr>';
                                //html2 += '<small>'+map_data["application_date"]+'</small><br/>';

                            }//end if 

                            if(map_data["status"] == 'cancelled'){
                                //html2 += '<small>'+map_data["application_date"]+'</small><br/>';

                                html5 += '<tr>';
                                    html5 += '<td>';
                                        html5 += '<small>Cancelled interview</small>';
                                    html5 += '</td>';
                                    html5 += '<td>';
                                        html5 += '<small>'+map_data["application_date"]+'</small><br/>'
                                    html5 += '</td>';
                                html2 += '</tr>';
                                //html2 += '<small>'+map_data["application_date"]+'</small><br/>';

                            }//end if 

                            if(map_data["status"] == 'offered'){
                                //html3 += '<small>'+map_data["application_date"]+'</small><br/>';

                                html3 += '<tr>';
                                    html3 += '<td>';
                                        html3 += '<small>Offered on</small>';
                                    html3 += '</td>';
                                    html3 += '<td>';
                                        html3 += '<small>'+map_data["application_date"]+'</small><br/>'
                                    html3 += '</td>';
                                html3 += '</tr>';

                            }//end if 

                            if(map_data["status"] == 'hired'){
                                //html4 += '<small>'+map_data["application_date"]+'</small><br/>';

                                html4 += '<tr>';
                                    html4 += '<td>';
                                        html4 += '<small>Hired on</small>';
                                    html4 += '</td>';
                                    html4 += '<td>';
                                        html4 += '<small>'+map_data["application_date"]+'</small><br/>'
                                    html4 += '</td>';
                                html4 += '</tr>';
                            }//end if 
                            
                        }//end for

                        if(html !== ''){
                            $('#activity_logs').removeClass('d-none');
                            $('#activity_logs').append(html);
                            //$('#activity_logs').removeClass('d-none');
                            //$('#line_move_to_content_da_container').removeClass('d-none');
                            //$('#line_move_to_content_da').html(html);
                        }//end if

                        if(html2 !== ''){
                            $('#activity_logs').append(html2);
                            //$('#line_move_to_content_di_container').removeClass('d-none');
                            //$('#line_move_to_content_di').html(html2);
                        }//end if

                        if(html5 !== ''){
                            $('#activity_logs').append(html5);
                            //$('#line_move_to_content_di_container').removeClass('d-none');
                            //$('#line_move_to_content_di').html(html2);
                        }//end if

                        if(html3 !== ''){
                            $('#activity_logs').append(html3);
                           //$('#line_move_to_content_do_container').removeClass('d-none');
                            //$('#line_move_to_content_do').html(html3);
                        }//end if

                        if(html4 !== ''){
                            $('#activity_logs').append(html4);
                            //$('#line_move_to_content_dh_container').removeClass('d-none');
                            //$('#line_move_to_content_dh').html(html4);
                        }//end if
                        //end line move to

                        autosize($('.asvw-textarea'));
                        $('.asvw-withsel').contents(':not(input)').remove();
                        
                        if(parseInt(data.is_closed) > 0){
                            $('button.btn_submit').addClass('d-none');
                            $('a.btn_for_interview').addClass('d-none');
                        }else{
                            
                            if(data.status == 'hired' || data.status == 'offered'){
                                $('a.btn_for_interview').addClass('d-none');
                            }//end if
                            if(data.status == 'hired'){
                                
                               // $('button.btn_submit').addClass('d-none');
                            }//end if
                        }//end if

                        //$('input[name=file\\[total_uploaded_file\\]]').val(total_size.toFixed(2));
                        //$('input[name=file\\[total_files\\]]').val(total_files);

                        //$('#image_cont').append(html);
                        //$('#image_cont_form').append(html_form);
                        //end populate lines
                        //----------------------------------------------------------------------------------------------------
                        //end view and edit mode
                        
                        //run stepper
                        highlightStep();
                        //run stepper end

                    }else{
                        //add mode
                        //----------------------------------------------------------------------------------------------------
                        $('img[id=header\\[company_logo\\]]').attr('src',urlimgdef); 
                        //----------------------------------------------------------------------------------------------------
                        //end add mode
                    }//end if

                    


                    if(param.mode == 'view'){
                        $('#frm_data_entry input:not([readonly]),textarea:not([readonly]),select,button').addClass(param.mode);
                        //$('#frm_data_entry input:not([readonly]),textarea:not([readonly]),select').addClass('form-control-plaintext');
                        
                        $('.to_hide').addClass('d-none');
                        //$('#frm_data_entry .tooltip_icon').addClass('d-none');


                        $('#frm_data_entry .input-group-append').addClass('d-none');


                        $('#frm_data_entry select.'+param.mode+'').removeClass('custom-select');


                        $('#frm_data_entry button.'+param.mode+', input.'+param.mode+',textarea.'+param.mode+',#frm_data_entry select.'+param.mode+'').removeClass('form-control');
                        $('#frm_data_entry button.'+param.mode+', input.'+param.mode+',textarea.'+param.mode+',#frm_data_entry select.'+param.mode+'').addClass('form-control-plaintext');

                        $('#frm_data_entry button.'+param.mode+', input.'+param.mode+',textarea.'+param.mode+',#frm_data_entry select.'+param.mode+'').prop('disabled',true);
                        $('#frm_data_entry button').addClass('d-none');

                        $('#frm_data_entry input[name^=placeholder]').removeClass('d-none');

                        $('#frm_data_entry input[name^=row_experience\\[start_date\\]\\[\\]]').addClass('d-none');
                        $('#frm_data_entry input[name^=row_experience\\[end_date\\]\\[\\]]').addClass('d-none');
                        $('#frm_data_entry input[name^=row_education\\[start_date\\]\\[\\]]').addClass('d-none');
                        $('#frm_data_entry input[name^=row_education\\[end_date\\]\\[\\]]').addClass('d-none');

                        //$('.btn_submit').addClass('d-none');

                        //custom can be omitted
                        $('#frm_data_entry input#search_location').parent().parent().addClass('d-none');
                        $('#frm_data_entry textarea[name=header\\[location\\]]').parent().parent().removeClass('d-none');
                        $('#frm_data_entry textarea[name=header\\[location\\]]').addClass('form-control-plaintext');
                        $('#frm_data_entry textarea[name=header\\[location\\]]').removeClass('form-control');

                        $('.asvw-asterisk').addClass('d-none');
                        $('.asvw-skillsbtn').addClass('d-none');
                        $('.asvw-skillsrow').css({'margin-bottom': '0'});
                        $('.asvw-skillscardbody').css({'padding': '0.5rem 1rem'});
                        $('.asvw-addBtn').addClass('d-none');
                    }//end if
                }else{
                    window.location.replace(baseurl+'/home');
                }//end if

                btn.html(btn_text);
                btn.attr('disabled',false);
                $(".outside_button *").css('pointer-events','auto');
            }else{

                //add mode
                //----------------------------------------------------------------------------------------------------
                $('img[id=header\\[company_logo\\]]').attr('src',urlimgdef);
                btn.html(btn_text);
                btn.attr('disabled',false);
                $(".outside_button *").css('pointer-events','auto');
                //----------------------------------------------------------------------------------------------------
                //end add mode
            }//end if
            $('#loading').hide();
        }).fail(function(e){
            alert(e.responseText);
            btn.html(btn_text);
            btn.attr('disabled',false);
            $(".outside_button *").css('pointer-events','auto');
            $('#loading').hide();
        }).always(function(e){

        });
    }//end load_record
    //=======================================================================================================================
    //end load data


    //autocomplete
    //===============================================================================================================================
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
    //===============================================================================================================================
    //end autocomplete
    

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

                        

                        
                        var ctr = $('input[name=row\\[line\\]\\[\\]]:last').val() === undefined? 1 : parseInt($('input[name=row\\[line\\]\\[\\]]:last').val())+1;
                        for(var key in files){
                            var file = files[key];
                            $('input[name=file\\[resume_content\\]]').val(file.file);
                            $('input[name=header\\[resume\\]]').val(file.file_attr.name);

                            html += '<div class="col mb-3">';
                             
                                html += '<h1 class="text-center"><i class="fa fa-file-word"></i></h1>';
                                html += '<p class="text-center">'+file.file_attr.name+'</p>';
                            html += '</div><!--./col-->';

                           

                            ctr += 1;
                           //console.log(file['file_attr'].name) + '<br/>';
                        }//end for



                        
                        
                        $('#image_cont').html(html);
                        //$('#image_cont_form').html(html_form);

                       
                        
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


    //form template
    //===============================================================================================================================
    function load_experience_form(param){
        var html = '';

            

            html += '<div class="card mb-2">';
                html += '<div class="card-body">';
                    html += '<button type="button" class="close" aria-label="Close">';
                        html += '<span aria-hidden="true">&times;</span>';
                    html += '</button>';
                html += '</div>';
                html += '<div class="card-body">';
                

                    html += '<div class="form-group row d-none">';
                        html += '<label class="col-4 col-form-label text-link">Line </label>';
                        html += '<div class="col">';
                            html += '<input readonly class="form-control form-control-sm" type="text" name="row_experience[line][]" maxlength="100"/>';
                        html += '</div><!--./col-10-->';
                    html += '</div><!--./form-group-->';

                    html += '<div class="form-group row">';
                        html += '<label class="col-4 col-form-label text-link">Position </label>';
                        html += '<div class="col">';
                            html += '<input class="form-control form-control-sm" type="text" name="row_experience[designation][]" maxlength="100"/>';
                        html += '</div><!--./col-10-->';
                    html += '</div><!--./form-group-->';

                    html += '<div class="form-group row">';
                        html += '<label class="col-4 col-form-label text-link">Company Name </label>';
                        html += '<div class="col">';
                            html += '<input class="form-control form-control-sm" type="text" name="row_experience[company_name][]" maxlength="100"/>';
                        html += '</div><!--./col-10-->';
                    html += '</div><!--./form-group-->';

                    html += '<div class="form-group row">';
                        html += '<label class="col-4 col-form-label text-link">Short description</label>';
                        html += '<div class="col">';
                            html += '<textarea class="form-control form-control-sm" name="row_experience[short_description][]" maxlength="600"></textarea>';
                        html += '</div><!--./col-10-->';
                    html += '</div><!--./form-group-->';

                    html += '<div class="form-group row">';
                        html += '<label class="col-4 col-form-label text-link">Start Date</label>';
                        html += '<div class="col">';
                            html += '<div class="input-group input-group-sm">';
                                html += '<input class="form-control form-control-sm" type="text" name="row_experience[start_date][]"/>';
                                html += '<div class="input-group-append">';
                                    html += '<span class="input-group-text"><i class="fa fa-calendar"></i></span>';
                                html += '</div><!--./input-group-append-->';
                            html += '</div><!--./input-group input-group-sm-->';
                        html += '</div><!--./col-->';
                    html += '</div><!--./form-group-->';

                    html += '<div class="form-group row">';
                        html += '<label class="col-4 col-form-label text-link">End Date</label>';
                        html += '<div class="col">';
                            html += '<div class="input-group input-group-sm date">';
                                html += '<input class="form-control form-control-sm" type="text" name="row_experience[end_date][]"/>';
                                html += '<div class="input-group-append">';
                                    html += '<span class="input-group-text"><i class="fa fa-calendar"></i></span>';
                                html += '</div><!--./input-group-append-->';
                            html += '</div><!--./input-group input-group-sm-->';
                        html += '</div><!--./col-10-->';
                    html += '</div><!--./form-group-->';

                    html += '<div class="form-group row">';
                        html += '<label class="col-4 col-form-label text-link">If Current</label>';
                        html += '<div class="col">';
                            html += '<input type="checkbox" class="w-auto" checked value="false" id="row_experience[if_current][]"/>';
                        html += '</div><!--./col-10-->';
                    html += '</div><!--./form-group-->';

                    html += '<div class="form-group row d-none">';
                        html += '<label class="col-4 col-form-label text-link">If Current</label>';
                        html += '<div class="col">';
                            html += '<input value="0" type="text" name="row_experience[if_current][]"/>';
                        html += '</div><!--./col-10-->';
                    html += '</div><!--./form-group-->';
                

                html += '</div>';
            html += '</div>';
        return html;
    }//end


    function load_skills_form(param){
        var html = '';

            

            html += '<div class="card mb-2">';
                html += '<div class="card-body">';
                    html += '<button type="button" class="close" aria-label="Close">';
                        html += '<span aria-hidden="true">&times;</span>';
                    html += '</button>';
                html += '</div>';
                html += '<div class="card-body">';

                    html += '<div class="form-group row d-none">';
                        html += '<label class="col-4 col-form-label text-link">Line </label>';
                        html += '<div class="col">';
                            html += '<input readonly class="form-control form-control-sm" type="text" name="row_skills[line][]" maxlength="100"/>';
                        html += '</div><!--./col-10-->';
                    html += '</div><!--./form-group-->';

                    html += '<div class="form-group row">';
                        html += '<label class="col-4 col-form-label text-link"></label>';
                        html += '<div class="col">';
                            html += '<input class="form-control form-control-sm" type="text" name="row_skills[skills][]" maxlength="200"/>';
                        html += '</div><!--./col-10-->';
                    html += '</div><!--./form-group-->';                
                html += '</div>';
            html += '</div>';
        return html;
    }//end

    function load_education_form(param){
        var html = '';
            html += '<div class="card mb-2">';
                html += '<div class="card-body">';
                    html += '<button type="button" class="close" aria-label="Close">';
                        html += '<span aria-hidden="true">&times;</span>';
                    html += '</button>';
                html += '</div>';
                html += '<div class="card-body">';

                    html += '<div class="form-group row d-none">';
                        html += '<label class="col-4 col-form-label text-link">Line </label>';
                        html += '<div class="col">';
                            html += '<input readonly class="form-control form-control-sm" type="text" name="row_education[line][]" maxlength="100"/>';
                        html += '</div><!--./col-10-->';
                    html += '</div><!--./form-group-->';

                    html += '<div class="form-group row">';
                        html += '<label class="col-4 col-form-label text-link">University/School </label>';
                        html += '<div class="col">';
                            html += '<input class="form-control form-control-sm" type="text" name="row_education[school][]" maxlength="200"/>';
                        html += '</div><!--./col-10-->';
                    html += '</div><!--./form-group-->';

                    html += '<div class="form-group row">';
                        html += '<label class="col-4 col-form-label text-link">Degree/Field of Study </label>';
                        html += '<div class="col">';
                            html += '<input class="form-control form-control-sm" type="text" name="row_education[degree][]" maxlength="200"/>';
                        html += '</div><!--./col-10-->';
                    html += '</div><!--./form-group-->';


                    

                    html += '<div class="form-group row">';
                        html += '<label class="col-4 col-form-label text-link">Education </label>';
                        html += '<div class="col-2 d-none">';
                            html += '<input readonly class="form-control form-control-sm" type="text" name="row_education[education][]"/>';
                        html += '</div>';
                        html += '<div class="col">';
                            html += '<div class="input-group input-group-sm">';
                                html += '<input class="form-control form-control-sm" type="text" id="row_education[education_text][]"/>';
                                html += '<div class="input-group-append">';
                                    html += '<span class="input-group-text"><i class="fa fa-list"></i></span>';
                                html += '</div><!--./input-group-append-->';
                            html += '</div><!--./input-group input-group-sm-->';
                        html += '</div><!--./col-10-->';
                    html += '</div><!--./form-group-->';


                    html += '<div class="form-group row">';
                        html += '<label class="col-4 col-form-label text-link">Start Date</label>';
                        html += '<div class="col">';
                            html += '<div class="input-group input-group-sm">';
                                html += '<input class="form-control form-control-sm" type="text" name="row_education[start_date][]"/>';
                                html += '<div class="input-group-append">';
                                    html += '<span class="input-group-text"><i class="fa fa-calendar"></i></span>';
                                html += '</div><!--./input-group-append-->';
                            html += '</div><!--./input-group input-group-sm-->';
                        html += '</div><!--./col-->';
                    html += '</div><!--./form-group-->';

                    html += '<div class="form-group row">';
                        html += '<label class="col-4 col-form-label text-link">End Date</label>';
                        html += '<div class="col">';
                            html += '<div class="input-group input-group-sm date">';
                                html += '<input class="form-control form-control-sm" type="text" name="row_education[end_date][]"/>';
                                html += '<div class="input-group-append">';
                                    html += '<span class="input-group-text"><i class="fa fa-calendar"></i></span>';
                                html += '</div><!--./input-group-append-->';
                            html += '</div><!--./input-group input-group-sm-->';
                        html += '</div><!--./col-10-->';
                    html += '</div><!--./form-group-->';

                    html += '<div class="form-group row">';
                        html += '<label class="col-4 col-form-label text-link">If Current</label>';
                        html += '<div class="col">';
                            html += '<input type="checkbox" class="w-auto" id="row_education[if_current][]"/>';
                        html += '</div><!--./col-10-->';
                    html += '</div><!--./form-group-->';

                    html += '<div class="form-group row d-none">';
                        html += '<label class="col-4 col-form-label text-link">If Current</label>';
                        html += '<div class="col">';
                            html += '<input value="0" type="text" name="row_education[if_current][]"/>';
                        html += '</div><!--./col-10-->';
                    html += '</div><!--./form-group-->';

                html += '</div>';
            html += '</div>';
        return html;
    }//end

    function load_language_form(param){
        var html = '';

            

            html += '<div class="card mb-2">';
                html += '<div class="card-body">';
                    html += '<button type="button" class="close" aria-label="Close">';
                        html += '<span aria-hidden="true">&times;</span>';
                    html += '</button>';
                html += '</div>';
                html += '<div class="card-body">';
                    html += '<div class="form-group row d-none">';
                        html += '<label class="col-4 col-form-label text-link">Line </label>';
                        html += '<div class="col">';
                            html += '<input readonly class="form-control form-control-sm" type="text" name="row_language[line][]" maxlength="100"/>';
                        html += '</div><!--./col-10-->';
                    html += '</div><!--./form-group-->';

                    html += '<div class="form-group row">';
                        html += '<label class="col-4 col-form-label text-link"></label>';
                        html += '<div class="col">';
                            html += '<input class="form-control form-control-sm" type="text" name="row_language[language][]" maxlength="200"/>';
                        html += '</div><!--./col-10-->';
                    html += '</div><!--./form-group-->';                
                html += '</div>';
            html += '</div>';
        return html;
    }//end

    function load_certification_form(param){
        var html = '';

            

            html += '<div class="card mb-2">';
                html += '<div class="card-body">';
                    html += '<button type="button" class="close" aria-label="Close">';
                        html += '<span aria-hidden="true">&times;</span>';
                    html += '</button>';
                html += '</div>';
                html += '<div class="card-body">';
                    html += '<div class="form-group row d-none">';
                        html += '<label class="col-4 col-form-label text-link">Line </label>';
                        html += '<div class="col">';
                            html += '<input readonly class="form-control form-control-sm" type="text" name="row_certification[line][]" maxlength="100"/>';
                        html += '</div><!--./col-10-->';
                    html += '</div><!--./form-group-->';

                    html += '<div class="form-group row">';
                        html += '<label class="col-4 col-form-label text-link"></label>';
                        html += '<div class="col">';
                            html += '<input class="form-control form-control-sm" type="text" name="row_certification[certification][]" maxlength="200"/>';
                        html += '</div><!--./col-10-->';
                    html += '</div><!--./form-group-->';                
                html += '</div>';
            html += '</div>';
        return html;
    }//end

    function load_projects_form(param){
        var html = '';

            

            html += '<div class="card mb-2">';
                html += '<div class="card-body">';
                    html += '<button type="button" class="close" aria-label="Close">';
                        html += '<span aria-hidden="true">&times;</span>';
                    html += '</button>';
                html += '</div>';
                html += '<div class="card-body">';
                    html += '<div class="form-group row d-none">';
                        html += '<label class="col-4 col-form-label text-link">Line </label>';
                        html += '<div class="col">';
                            html += '<input readonly class="form-control form-control-sm" type="text" name="row_projects[line][]" maxlength="100"/>';
                        html += '</div><!--./col-10-->';
                    html += '</div><!--./form-group-->';

                    html += '<div class="form-group row">';
                        html += '<label class="col-4 col-form-label text-link"></label>';
                        html += '<div class="col">';
                            html += '<input class="form-control form-control-sm" type="text" name="row_projects[projects][]" maxlength="200"/>';
                        html += '</div><!--./col-10-->';
                    html += '</div><!--./form-group-->';                
                html += '</div>';
            html += '</div>';
        return html;
    }//end

    function load_seminar_training_form(param){
        var html = '';

            html += '<div class="card mb-2">';
                html += '<div class="card-body">';
                    html += '<button type="button" class="close" aria-label="Close">';
                        html += '<span aria-hidden="true">&times;</span>';
                    html += '</button>';
                html += '</div>';
                html += '<div class="card-body">';
                    html += '<div class="form-group row d-none">';
                        html += '<label class="col-4 col-form-label text-link">Line </label>';
                        html += '<div class="col">';
                            html += '<input readonly class="form-control form-control-sm" type="text" name="row_seminar_training[line][]" maxlength="100"/>';
                        html += '</div><!--./col-10-->';
                    html += '</div><!--./form-group-->';

                    html += '<div class="form-group row">';
                        html += '<label class="col-4 col-form-label text-link"></label>';
                        html += '<div class="col">';
                            html += '<input class="form-control form-control-sm" type="text" name="row_seminar_training[seminar_training][]" maxlength="200"/>';
                        html += '</div><!--./col-10-->';
                    html += '</div><!--./form-group-->';                
                html += '</div>';
            html += '</div>';
        return html;
    }//end

    function load_awards_achievements_form(param){
        var html = '';

            html += '<div class="card mb-2">';
                html += '<div class="card-body">';
                    html += '<button type="button" class="close" aria-label="Close">';
                        html += '<span aria-hidden="true">&times;</span>';
                    html += '</button>';
                html += '</div>';
                html += '<div class="card-body">';
                    html += '<div class="form-group row d-none">';
                        html += '<label class="col-4 col-form-label text-link">Line </label>';
                        html += '<div class="col">';
                            html += '<input readonly class="form-control form-control-sm" type="text" name="row_award_achievement[line][]" maxlength="100"/>';
                        html += '</div><!--./col-10-->';
                    html += '</div><!--./form-group-->';

                    html += '<div class="form-group row">';
                        html += '<label class="col-4 col-form-label text-link"></label>';
                        html += '<div class="col">';
                            html += '<input class="form-control form-control-sm" type="text" name="row_award_achievement[award_achievement][]" maxlength="200"/>';
                        html += '</div><!--./col-10-->';
                    html += '</div><!--./form-group-->';                
                html += '</div>';
            html += '</div>';
        return html;
    }//end

    function load_affiliations_form(param){
        var html = '';

            html += '<div class="card mb-2">';
                html += '<div class="card-body">';
                    html += '<button type="button" class="close" aria-label="Close">';
                        html += '<span aria-hidden="true">&times;</span>';
                    html += '</button>';
                html += '</div>';
                html += '<div class="card-body">';
                    html += '<div class="form-group row d-none">';
                        html += '<label class="col-4 col-form-label text-link">Line </label>';
                        html += '<div class="col">';
                            html += '<input readonly class="form-control form-control-sm" type="text" name="row_affiliation[line][]" maxlength="100"/>';
                        html += '</div><!--./col-10-->';
                    html += '</div><!--./form-group-->';

                    html += '<div class="form-group row">';
                        html += '<label class="col-4 col-form-label text-link"></label>';
                        html += '<div class="col">';
                            html += '<input class="form-control form-control-sm" type="text" name="row_affiliation[affiliation][]" maxlength="200"/>';
                        html += '</div><!--./col-10-->';
                    html += '</div><!--./form-group-->';                
                html += '</div>';
            html += '</div>';
        return html;
    }//end


    function load_industry_form(param){
        var html = '';
            
            html += '<div class="card mb-2">';
                html += '<div class="card-body">';
                    html += '<button type="button" class="close" aria-label="Close">';
                        html += '<span aria-hidden="true">&times;</span>';
                    html += '</button>';
                html += '</div>';
                html += '<div class="card-body">';
                    html += '<div class="form-group row d-none">';
                        html += '<label class="col-4 col-form-label text-link">Line </label>';
                        html += '<div class="col">';
                            html += '<input readonly class="form-control form-control-sm" type="text" name="row_industry[line][]" maxlength="100"/>';
                        html += '</div><!--./col-10-->';
                    html += '</div><!--./form-group-->';

                    html += '<div class="form-group row">';
                        html += '<label class="col-4 col-form-label text-link">Industry </label>';
                        html += '<div class="col-2 d-none">';
                            html += '<input readonly class="form-control form-control-sm" type="text" name="row_industry[industry][]"/>';
                        html += '</div>';
                        html += '<div class="col">';
                            html += '<div class="input-group input-group-sm">';
                                html += '<input class="form-control form-control-sm" type="text" id="row_industry[industry_text][]"/>';
                                html += '<div class="input-group-append">';
                                    html += '<span class="input-group-text"><i class="fa fa-list"></i></span>';
                                html += '</div><!--./input-group-append-->';
                            html += '</div><!--./input-group input-group-sm-->';
                        html += '</div><!--./col-10-->';
                    html += '</div><!--./form-group-->';
                html += '</div>';
            html += '</div>';

        return html;
    }//end

    function load_job_level_form(param){
        var html = '';
            html += '<div class="card mb-2">';
                html += '<div class="card-body">';
                    html += '<button type="button" class="close" aria-label="Close">';
                        html += '<span aria-hidden="true">&times;</span>';
                    html += '</button>';
                html += '</div>';
                html += '<div class="card-body">';
                    html += '<div class="form-group row d-none">';
                        html += '<label class="col-4 col-form-label text-link">Line </label>';
                        html += '<div class="col">';
                            html += '<input readonly class="form-control form-control-sm" type="text" name="row_job_level[line][]" maxlength="100"/>';
                        html += '</div><!--./col-10-->';
                    html += '</div><!--./form-group-->';

                    html += '<div class="form-group row">';
                        html += '<label class="col-4 col-form-label text-link">Job Level </label>';
                        html += '<div class="col-2 d-none">';
                            html += '<input readonly class="form-control form-control-sm" type="text" name="row_job_level[job_level][]"/>';
                        html += '</div>';
                        html += '<div class="col">';
                            html += '<div class="input-group input-group-sm">';
                                html += '<input class="form-control form-control-sm" type="text" id="row_job_level[job_level_text][]"/>';
                                html += '<div class="input-group-append">';
                                    html += '<span class="input-group-text"><i class="fa fa-list"></i></span>';
                                html += '</div><!--./input-group-append-->';
                            html += '</div><!--./input-group input-group-sm-->';
                        html += '</div><!--./col-10-->';
                    html += '</div><!--./form-group-->';
                html += '</div>';
            html += '</div>';

        return html;
    }//end


    function load_job_type_form(param){
        var html = '';
            html += '<div class="card mb-2">';
                html += '<div class="card-body">';
                    html += '<button type="button" class="close" aria-label="Close">';
                        html += '<span aria-hidden="true">&times;</span>';
                    html += '</button>';
                html += '</div>';
                html += '<div class="card-body">';
                    html += '<div class="form-group row d-none">';
                        html += '<label class="col-4 col-form-label text-link">Line </label>';
                        html += '<div class="col">';
                            html += '<input readonly class="form-control form-control-sm" type="text" name="row_job_type[line][]" maxlength="100"/>';
                        html += '</div><!--./col-10-->';
                    html += '</div><!--./form-group-->';

                    html += '<div class="form-group row">';
                        html += '<label class="col-4 col-form-label text-link">Job Type </label>';
                        html += '<div class="col-2 d-none">';
                            html += '<input readonly class="form-control form-control-sm" type="text" name="row_job_type[job_type][]"/>';
                        html += '</div>';
                        html += '<div class="col">';
                            html += '<div class="input-group input-group-sm">';
                                html += '<input class="form-control form-control-sm" type="text" id="row_job_type[job_type_text][]"/>';
                                html += '<div class="input-group-append">';
                                    html += '<span class="input-group-text"><i class="fa fa-list"></i></span>';
                                html += '</div><!--./input-group-append-->';
                            html += '</div><!--./input-group input-group-sm-->';
                        html += '</div><!--./col-10-->';
                    html += '</div><!--./form-group-->';
                html += '</div>';
            html += '</div>';

        return html;
    }//end


    function load_department_form(param){
        var html = '';
            html += '<div class="card mb-2">';
                html += '<div class="card-body">';
                    html += '<button type="button" class="close" aria-label="Close">';
                        html += '<span aria-hidden="true">&times;</span>';
                    html += '</button>';
                html += '</div>';
                html += '<div class="card-body">';
                    html += '<div class="form-group row d-none">';
                        html += '<label class="col-4 col-form-label text-link">Line </label>';
                        html += '<div class="col">';
                            html += '<input readonly class="form-control form-control-sm" type="text" name="row_department[line][]" maxlength="100"/>';
                        html += '</div><!--./col-10-->';
                    html += '</div><!--./form-group-->';

                    html += '<div class="form-group row">';
                        html += '<label class="col-4 col-form-label text-link">Department </label>';
                        html += '<div class="col-2 d-none">';
                            html += '<input readonly class="form-control form-control-sm" type="text" name="row_department[department][]"/>';
                        html += '</div>';
                        html += '<div class="col">';
                            html += '<div class="input-group input-group-sm">';
                                html += '<input class="form-control form-control-sm" type="text" id="row_department[department_text][]"/>';
                                html += '<div class="input-group-append">';
                                    html += '<span class="input-group-text"><i class="fa fa-list"></i></span>';
                                html += '</div><!--./input-group-append-->';
                            html += '</div><!--./input-group input-group-sm-->';
                        html += '</div><!--./col-10-->';
                    html += '</div><!--./form-group-->';
                html += '</div>';
            html += '</div>';

        return html;
    }//end
    //===============================================================================================================================
    //end form template


                    
                    
                    

});//End document.ready

