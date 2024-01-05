$(document).ready(function(){   
    $(document.body).on('click','button[name=btn_submit]',function(e){
       
       var btn = $(this);
       var process_start_txt  = 'Processing...';
       var process_end_txt    = 'Submit';
       
        var logout_url = baseurl + '/home/logout';
    	var homeurl    = baseurl + '/change_email';
    	var url        = baseurl + '/change_email/submit';
         
    	$.ajax({
            url: url,
            data: $('#frm_change_email').serialize(),
            type: "POST",
            dataType: "JSON",
            beforeSend : (function (data){
                btn.text(process_start_txt);
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

                
                setTimeout(function(){
                    window.location.replace(logout_url);
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
                
                btn.text(process_end_txt);
                btn.removeAttr('disabled');
            }
        }).fail(function(e){
            alert(JSON.stringify(e));
            $.notify(e.responseText,{ 
                position:"top center",
                className:"error",
                arrowShow : true
            });

            btn.text(process_end_txt);
            btn.removeAttr('disabled');
        }).always(function(e){

        });
        
    })


    //events
    //===============================================================================================================================
    //old password
    $(document.body).on('click','#frm_forgot_password #btn_show_pass',function(e){
        var x = $('#frm_forgot_password input[name=header\\[old_password\\]]');
        if (x.attr('type') === "password") {
            x.prop("type", "text");
            $(this).find('.input-group-text').html('<i class="fa fa-eye-slash"></i>');
        } else {
            x.prop("type", "password");
            $(this).find('.input-group-text').html('<i class="fa fa-eye"></i>');
        }
    });
    //new password
    $(document.body).on('click','#frm_forgot_password #btn_show_pass2',function(e){
        var x = $('#frm_forgot_password input[name=header\\[new_password\\]]');
        if (x.attr('type') === "password") {
            x.prop("type", "text");
            $(this).find('.input-group-text').html('<i class="fa fa-eye-slash"></i>');
        } else {
            x.prop("type", "password");
            $(this).find('.input-group-text').html('<i class="fa fa-eye"></i>');
        }
    });

    $(document.body).on('click','button.close',function(e){
        

        if(confirm("Are you sure you want to close this window?")){
           window.location.replace(baseurl+'/home');
        }//end if
    });
    //===============================================================================================================================
    //end events

    $('#loading').hide();
});//End document.ready

