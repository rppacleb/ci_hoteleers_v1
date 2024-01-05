$(document).ready(function () {
  var homeurl = baseurl + "/signup";

  //$('.signup_final').html(load_company_form()); // to remove

  $(".btn_show_pass").tooltip();

  $(document.body).on("click", "button.btn_signup", function (e) {
    var btn = $(this);
    var type = $(this).attr("aria-type");
    var btn_text = "Sign up as a " + type;
    var url = baseurl + "/signup/samplelang";
    console.log($("#frm_signup"));
    $.ajax({
      url: url,
      data: $("#frm_signup").serialize(),
      type: "POST",
      dataType: "JSON",
      beforeSend: function (data) {
        btn.text("Processing...");
        btn.attr("disabled", "disabled");
      },
    })
      .done(function (data) {
        console.log(data);
        return;
        //alert(Object.keys(data.messages).length);
        if (data.success === true) {
          var msg_html = "";
          var arr = [];
          for (var i = 0; i <= data.messages.length - 1; i++) {
            for (var element in data.messages[i]) {
              arr.push(data.messages[i][element]);
              msg_html += data.messages[i][element] + "\n";
            } //end for
          } //End for

          $("button.btn_submit").attr("aria-type", type);

          if (type.toLowerCase() == "applicant") {
            //$('button.btn_submit').trigger('click');
            signup_as_applicant(btn, btn_text, type.toLowerCase());
          } else if (type.toLowerCase() == "company") {
            //company form here
            $("#signup_init").addClass("d-none");
            $(".signup_final").html(load_company_form());

            load_dropdowns("dial_code");

            var url = baseurl + "/get/signup/industry/0";
            var dropdown = $("select[name=header\\[industry\\]]");
            load_dropdown(url, dropdown, "industry");
            load_dropdowns("industry");

            var url = baseurl + "/get/job_post/olocation";
            var dropdown = $("select[name=header\\[location\\]]");
            load_dropdown(url, dropdown, "location");
            load_dropdowns("location");

            $(".signup_final_button").removeClass("d-none");
            $("input[name=header\\[work_email\\]]").val(
              $("input[name=header\\[username\\]]").val()
            );

            //load google map upon showing of company form
            /*
                    var script = document.createElement('script');
                    script.onload = function () {};
                    script.src = "https://maps.googleapis.com/maps/api/js?language=en&key=AIzaSyAGyohoEluWcR09ZROWb0cSHKa-QoqZmwM&libraries=places&callback=initMap";
                    document.head.appendChild(script);
                    */
            //end load google map upon showing of company form

            //end company form here
            btn.text(btn_text);
            btn.removeAttr("disabled");
          } //end if

          //window.location.replace(homeurl);
        } else {
          var msg_html = "";
          var arr = [];
          for (var i = 0; i <= data.messages.length - 1; i++) {
            for (var element in data.messages[i]) {
              arr.push(data.messages[i][element]);
              msg_html += data.messages[i][element] + "\n";
            } //end for
          } //End for

          $.notify(msg_html, {
            position: "top center",
            className: "error",
            arrowShow: true,
          });

          btn.text(btn_text);
          btn.removeAttr("disabled");
        }
      })
      .fail(function (e) {
        alert(e.responseText);
        btn.text(btn_text);
        btn.removeAttr("disabled");
        $.notify(e.responseText, {
          position: "top center",
          className: "error",
          arrowShow: true,
        });
      })
      .always(function (e) {});
  });

  $(document.body).on("click", "button.btn_signup_company", function (e) {
    $("#signup_init").remove();
    $(".signup_final").html(load_company_form());
    $(".btn_signup_company").addClass(".btn_signup");
    $(".signup_final_button").removeClass("d-none");
    $(".btn_submit_company").removeClass("btn_submit");

    var btn = $(this);
    var type = $(this).attr("aria-type");
    var btn_text = "Sign up as a " + type;
    var url = baseurl + "/signup/validate_init";

    load_dropdowns("dial_code");
    load_dropdowns("honorifics");

    var url = baseurl + "/get/signup/industry/0";
    var dropdown = $("select[name=header\\[industry\\]]");
    load_dropdown(url, dropdown, "industry");
    load_dropdowns("industry");

    var url = baseurl + "/get/job_post/olocation";
    var dropdown = $("select[name=header\\[location\\]]");
    load_dropdown(url, dropdown, "location");
    load_dropdowns("location");
  });

  $(document.body).on("click", "button.btn_submit_company", function (e) {
    var btn = $("button.btn_signup");
    var btn_text = "Submit";
    var type = $(".btn_submit_company").attr("aria-type").toLowerCase();
    var url = baseurl + "/signup/signup/" + type;

    $.ajax({
      url: url,
      data: $("#frm_signup").serialize(),
      type: "POST",
      dataType: "JSON",
      beforeSend: function (data) {
        btn.text("Processing...");
        btn.attr("disabled", "disabled");
      },
    })
      .done(function (data) {
        //alert(Object.keys(data.messages).length);
        if (data.success === true) {
          var msg_html = "";
          var arr = [];
          for (var i = 0; i <= data.messages.length - 1; i++) {
            for (var element in data.messages[i]) {
              arr.push(data.messages[i][element]);
              msg_html += data.messages[i][element] + "\n";
            } //end for
          } //End for

          /*$.notify(msg_html,{ 
                    position:"top center",
                    className:"success",
                    arrowShow : true
                });*/

          btn.text(btn_text);
          btn.removeAttr("disabled");

          if (type == "company") {
            $(".signup_final").html(load_company_form());

            $("#signup_modal").modal("show");
          } else {
            $("#signup_modal2").modal("show");
          } //end if

          //window.location.replace(homeurl);
        } else {
          var msg_html = "";
          var arr = [];
          for (var i = 0; i <= data.messages.length - 1; i++) {
            for (var element in data.messages[i]) {
              arr.push(data.messages[i][element]);
              msg_html += data.messages[i][element] + "\n";
            } //end for
          } //End for

          $.notify(msg_html, {
            position: "top center",
            className: "error",
            arrowShow: true,
          });

          btn.text(btn_text);
          btn.removeAttr("disabled");
        }
      })
      .fail(function (e) {
        alert(e.responseText);
        btn.text(btn_text);
        btn.removeAttr("disabled");
        $.notify(e.responseText, {
          position: "top center",
          className: "error",
          arrowShow: true,
        });
      })
      .always(function (e) {});
  });

  function signup_as_applicant(btn, btn_text, type) {
    var url = baseurl + "/signup/signup/" + type;

    $.ajax({
      url: url,
      data: $("#frm_signup").serialize(),
      type: "POST",
      dataType: "JSON",
      beforeSend: function (data) {
        btn.text("Processing...");
        btn.attr("disabled", "disabled");
      },
    })
      .done(function (data) {
        //alert(Object.keys(data.messages).length);
        if (data.success === true) {
          var msg_html = "";
          var arr = [];
          for (var i = 0; i <= data.messages.length - 1; i++) {
            for (var element in data.messages[i]) {
              arr.push(data.messages[i][element]);
              msg_html += data.messages[i][element] + "\n";
            } //end for
          } //End for

          /*$.notify(msg_html,{ 
                    position:"top center",
                    className:"success",
                    arrowShow : true
                });*/

          btn.text(btn_text);
          btn.removeAttr("disabled");

          if (type == "company") {
            $(".signup_final").html(load_company_form());

            $("#signup_modal").modal("show");
          } else {
            $("#signup_modal2").modal("show");
          } //end if

          //window.location.replace(homeurl);
        } else {
          var msg_html = "";
          var arr = [];
          for (var i = 0; i <= data.messages.length - 1; i++) {
            for (var element in data.messages[i]) {
              arr.push(data.messages[i][element]);
              msg_html += data.messages[i][element] + "\n";
            } //end for
          } //End for

          $.notify(msg_html, {
            position: "top center",
            className: "error",
            arrowShow: true,
          });

          btn.text(btn_text);
          btn.removeAttr("disabled");
        }
      })
      .fail(function (e) {
        alert(e.responseText);
        btn.text(btn_text);
        btn.removeAttr("disabled");
        $.notify(e.responseText, {
          position: "top center",
          className: "error",
          arrowShow: true,
        });
      })
      .always(function (e) {});
  } //end function

  $(document.body).on("click", "button.btn_submit", function (e) {
    var btn = $("button.btn_signup");
    var btn_text = "Submit";
    var type = $(this).attr("aria-type").toLowerCase();
    var url = baseurl + "/signup/signup/" + type;

    $.ajax({
      url: url,
      data: $("#frm_signup").serialize(),
      type: "POST",
      dataType: "JSON",
      beforeSend: function (data) {
        btn.text("Processing...");
        btn.attr("disabled", "disabled");
      },
    })
      .done(function (data) {
        //alert(Object.keys(data.messages).length);
        if (data.success === true) {
          var msg_html = "";
          var arr = [];
          for (var i = 0; i <= data.messages.length - 1; i++) {
            for (var element in data.messages[i]) {
              arr.push(data.messages[i][element]);
              msg_html += data.messages[i][element] + "\n";
            } //end for
          } //End for

          /*$.notify(msg_html,{ 
                    position:"top center",
                    className:"success",
                    arrowShow : true
                });*/

          btn.text(btn_text);
          btn.removeAttr("disabled");

          if (type == "company") {
            $(".signup_final").html(load_company_form());

            $("#signup_modal").modal("show");
          } else {
            $("#signup_modal2").modal("show");
          } //end if

          //window.location.replace(homeurl);
        } else {
          var msg_html = "";
          var arr = [];
          for (var i = 0; i <= data.messages.length - 1; i++) {
            for (var element in data.messages[i]) {
              arr.push(data.messages[i][element]);
              msg_html += data.messages[i][element] + "\n";
            } //end for
          } //End for

          $.notify(msg_html, {
            position: "top center",
            className: "error",
            arrowShow: true,
          });

          btn.text(btn_text);
          btn.removeAttr("disabled");
        }
      })
      .fail(function (e) {
        alert(e.responseText);
        btn.text(btn_text);
        btn.removeAttr("disabled");
        $.notify(e.responseText, {
          position: "top center",
          className: "error",
          arrowShow: true,
        });
      })
      .always(function (e) {});
  });

  //events
  //===============================================================================================================================

  // Submit "Sign up as Applicant" form on Enter key press
  $(document.body).on("keypress", "#signup_init input", function (e) {
    if (e.which == 13) {
      $("button.btn_signup").click();
      return false;
    }
  });

  // Submit "Sign up as Company" form on Enter key press
  $(document.body).on("keypress", "div.signup_final input", function (e) {
    if (e.which == 13) {
      $("button.btn_submit_company").click();
      return false;
    }
  });

  $(document.body).on("click", "#frm_signup .btn_show_pass", function (e) {
    var type = $(this).attr("aria-type");
    var x;
    if (type == "password") {
      x = $("#frm_signup input[name=header\\[password\\]]");
    } else {
      x = $("#frm_signup input[name=header\\[confirm_password\\]]");
    } //end if

    if (x.attr("type") === "password") {
      x.prop("type", "text");
      $(this).find(".input-group-text").html('<i class="fa fa-eye-slash"></i>');
    } else {
      x.prop("type", "password");
      $(this).find(".input-group-text").html('<i class="fa fa-eye"></i>');
    }
  });

  //load industry autocomplete
  $(document.body).on(
    "focus",
    "input[id=header\\[industry_text\\]]",
    function () {
      if (!$(this).hasClass("wauto")) {
        load_industry_autocomplete(
          $(this),
          $("input[name=header\\[industry\\]]")
        );
        $(this).addClass("wauto");
      } //End if
    }
  ); //focus
  $(document.body).on(
    "blur",
    "input[id=header\\[industry_text\\]]",
    function () {
      if ($(this).val() == "") {
        $("input[name=header\\[industry\\]]").val("");
      } //end if

      if ($("input[name=header\\[industry\\]]").val() == "") {
        $(this).val("");
      } //end if
    }
  ); //blur

  //location change
  $(document.body).on(
    "change",
    "select[name=header\\[location\\]]",
    function () {
      $("input[name=header\\[country\\]]").val($(this).val());
    }
  ); //blur
  //end location change

  //location change
  /*$(document.body).on('change','select[name=header\\[dial_code\\]]',function(){
        var dial_code = $(this).val();
        var dial_code_name = $('select[name=header\\[dial_code\\]] option:selected').text();

        if(dial_code_name.indexOf('ID') >= 0){
            //Indonesia
            $('input[name=header\\[contact_number\\]]').attr('placeholder','834 XXX XXXX');
        }else if(dial_code_name.indexOf('PH') >= 0){
            //Philippines
            $('input[name=header\\[contact_number\\]]').attr('placeholder','917 XXX XXXX');
        }else if(dial_code_name.indexOf('TH') >= 0){
            //Thailand
            $('input[name=header\\[contact_number\\]]').attr('placeholder','8 XXXX XXXX');
        }else if(dial_code_name.indexOf('AU') >= 0){
            //Australia
            $('input[name=header\\[contact_number\\]]').attr('placeholder','4XX XXX XXX');
        }else{
            //other countries
            $('input[name=header\\[contact_number\\]]').attr('placeholder','XXXX XXXX (XXXX)');
        }//end if
        
    })//blur
    */
  //end location change

  //===============================================================================================================================
  //end events

  //autocomplete
  //===============================================================================================================================
  function load_dropdowns(type) {
    $("select[name=header\\[" + type + "\\]]").multiselect({
      enableFiltering: true,
      //selectAllValue: 'multiselect-all',
      //selectAllText: 'Select All',
      //includeSelectAllOption : true,

      maxHeight: 300,
      enableCaseInsensitiveFiltering: true,
    });
  } //end function

  //load dropdown
  function load_dropdown(url, dropdown, type) {
    //var url     = baseurl + "/get/signup/industry/0";
    $.ajax({
      url: url,
      type: "POST",
      dataType: "JSON",
      async: false,
      beforeSend: function () {},
    })
      .done(function (response) {
        var html = '<option value="">Select</option>';

        for (var key in response.data) {
          if (response.data[key].job_title !== undefined) {
            html +=
              '<option value="' +
              response.data[key].job_title +
              '">' +
              response.data[key].job_title +
              "</option>";
          } else if (response.data[key].language !== undefined) {
            html +=
              '<option value="' +
              response.data[key].language +
              '">' +
              response.data[key].language +
              "</option>";
          } else if (response.data[key].skills !== undefined) {
            html +=
              '<option value="' +
              response.data[key].skills +
              '">' +
              response.data[key].skills +
              "</option>";
          } else {
            if (type == "location") {
              html +=
                '<option value="' +
                response.data[key].name +
                '">' +
                response.data[key].name +
                "</option>";
            } else {
              html +=
                '<option value="' +
                response.data[key].id +
                '">' +
                response.data[key].name +
                "</option>";
            } //end if
          } //end if
        } //end for
        dropdown.html(html);
      })
      .fail(function (e) {
        alert(e.responseText);
      })
      .always(function (e) {});
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

  var url = baseurl + "/get/signup/industry/0";
  var dropdown = $("select[name=header\\[industry\\]]");
  load_dropdown(url, dropdown, "industry");
  load_dropdowns("industry");

  //TODO continue the location
  var url = baseurl + "/get/job_post/olocation";
  var dropdown = $("select[name=header\\[location\\]]");
  load_dropdown(url, dropdown, "location");
  load_dropdowns("location");

  //Customer autocomplete
  function load_industry_autocomplete(html, html_id) {
    var url = baseurl + "/get/signup/industry/0";
    html
      .autocomplete({
        serviceUrl: url,
        type: "GET",
        dataType: "json",
        showNoSuggestionNotice: true,
        noSuggestionNotice: "Sorry, no matching results",
        autoSelectFirst: true,
        triggerSelectOnValidInput: true,
        orientation: "auto",
        transformResult: function (response) {
          return {
            suggestions: $.map(response.data, function (dataItem) {
              if (
                dataItem.name.toLowerCase().indexOf(html.val().toLowerCase()) >
                -1
              ) {
                return { value: dataItem.name, data: dataItem.id };
              } //end if
            }),
          };
        },
        onSelect: function (suggestion) {
          html_id.val(suggestion.data);
        },

        onSearchComplete: function (query, suggestions) {
          if (suggestions.length == 0) {
            html_id.val("");
          } //end if
        },
      })
      .blur(function () {
        if (html_id.val() == "") {
          html.val("");
        }
      });
  }
  //===============================================================================================================================
  //end autocomplete

  //template
  //===============================================================================================================================
  function load_company_form() {
    $(".signup-company").removeClass("col-xl-4");
    $(".signup-company").addClass("col-xl-5");
    // if ($(window).width() >= 1025){
    //     $('.signup-spacer').css('width', '29%');
    // }
    $("h5.card-title").html("Employer Sign up");

    var html = "";

    html += '<div class="form-group row">';
    html +=
      '<label class="col-4 col-form-label align-self-center">Prefix <span class="text-danger fw-bolder">*</span></label>';
    html += '<div class="col align-self-center">';
    html += '<div class="input-group input-group-sm">';
    html += '<select name="header[honorifics]">';
    html += '<option value="" selected>Select</option>';
    html += '<option value="Mr.">Mr.</option>';
    html += '<option value="Ms.">Ms.</option>';
    html += "</select>";
    html += "</div>";
    html += "</div><!--./col-10-->";
    html += "</div><!--./form-group-->";

    html += '<div class="form-group row">';
    html +=
      '<label class="col-4 col-form-label align-self-center">First Name <span class="text-danger fw-bolder">*</span></label>';
    html += '<div class="col align-self-center">';
    html +=
      '<input class="form-control form-control-sm" type="text" name="header[first_name]" maxlength="100" style="font-size: 15px !important;"/>';
    html += "</div><!--./col-10-->";
    html += "</div><!--./form-group-->";
    html += '<div class="form-group row">';
    html +=
      '<label class="col-4 col-form-label align-self-center">Last Name <span class="text-danger fw-bolder">*</span></label>';
    html += '<div class="col align-self-center">';
    html +=
      '<input class="form-control form-control-sm" type="text" name="header[last_name]" maxlength="100" style="font-size: 15px !important;"/>';
    html += "</div><!--./col-10-->";
    html += "</div><!--./form-group-->";
    html += '<div class="form-group row">';
    html +=
      '<label class="col-4 col-form-label align-self-center">Work Email <span class="text-danger fw-bolder">*</span></label>';
    html += '<div class="col align-self-center">';
    html +=
      '<input placeholder="Email@email.com" class="form-control form-control-sm" type="text" name="header[work_email]" maxlength="100" style="font-size: 15px !important;"/>';
    html += "</div><!--./col-10-->";
    html += "</div><!--./form-group-->";

    // -------Start Company Contact Number ------------------------

    // html += '<div class="form-group row">';
    //     html += '<label class="col-4 col-form-label align-self-center">Contact Number <span class="text-danger fw-bolder">*</span></label>';
    //     html += '<div class="col-3 align-self-center" style="width: 29%;">';
    //         html += '<select class="custom-select custom-select-sm" name="header[dial_code]">';
    //         html +='<option selected>Select</option>';
    //         for(var key in country_dial_code){
    //             //$dial_code = $country_dial_code["data"][$x];
    //             html +='<option value="'+country_dial_code[key].dial_code+'">'+country_dial_code[key].code+' '+country_dial_code[key].dial_code+'</option>';
    //         }//end for
    //         html += '</select>';
    //     html += '</div><!--./col-10-->';
    //     html += '<div class="col align-self-center">';
    //         html += '<input placeholder="" class="form-control form-control-sm" type="text" name="header[contact_number]" maxlength="12"/>';
    //     html += '</div><!--./col-10-->';
    // html += '</div><!--./form-group-->';

    html += '<div class="form-group row">';
    html +=
      '<label class="col-4 col-form-label align-self-center">Contact Number <span class="text-danger fw-bolder">*</span></label>';
    html +=
      '<div class="col-3 align-self-center" style="width:28%;padding-right:unset">';
    html += '<div class="input-group input-group-sm">';
    html += '<select name="header[dial_code]">';
    html += "<option selected>Select</option>";
    for (var key in country_dial_code) {
      //$dial_code = $country_dial_code["data"][$x];
      html +=
        '<option value="' +
        country_dial_code[key].dial_code +
        '">' +
        country_dial_code[key].code +
        " " +
        country_dial_code[key].dial_code +
        "</option>";
    } //end for
    html += "</select>";
    html += "</div>";
    html += "</div><!--./col-10-->";
    html += '<div class="col align-self-center">';
    html +=
      '<input placeholder="" class="form-control form-control-sm" type="text" name="header[contact_number]" maxlength="12" style="font-size: 15px !important;"/>';
    html += "</div><!--./col-10-->";
    html += "</div><!--./form-group-->";

    // -------END Company Contact Number ----------------------------

    html += '<div class="form-group row">';
    html +=
      '<label class="col-4 col-form-label align-self-center">Company Name <span class="text-danger fw-bolder">*</span></label>';
    html += '<div class="col align-self-center">';
    html +=
      '<input class="form-control form-control-sm" type="text" name="header[company_name]" maxlength="100" style="font-size: 15px !important;"/>';
    html += "</div><!--./col-10-->";
    html += "</div><!--./form-group-->";

    html += '<div class="form-group row">';
    html +=
      '<label class="col-4 col-form-label align-self-center">Location <span class="text-danger fw-bolder">*</span></label>';
    html += '<div class="col align-self-center">';
    html += '<div class="input-group input-group-sm">';
    html +=
      '<input class="form-control form-control-sm d-none" type="text" name="placeholder[location]"/>';
    html += '<select name="header[location]"></select>';
    html += "</div>";
    html += "</div><!--./col-10-->";
    html += "</div><!--./form-group-->";

    /*html += '<div class="form-group row">';
          html += '<label class="col-3 col-form-label">Lat</label>';
          html += '<div class="col">';
            html += '<input readonly class="form-control form-control-sm" type="text" name="header[lat]"/>';
          html += '</div><!--./col-10-->';
        html += '</div><!--./form-group-->';

        html += '<div class="form-group row">';
          html += '<label class="col-3 col-form-label">Lng</label>';
          html += '<div class="col">';
            html += '<input readonly class="form-control form-control-sm" type="text" name="header[lng]"/>';
          html += '</div><!--./col-10-->';
        html += '</div><!--./form-group-->';

        html += '<div class="form-group row">';
          html += '<label class="col-3 col-form-label">Locality</label>';
          html += '<div class="col">';
            html += '<input readonly class="form-control form-control-sm" type="text" name="header[locality]"/>';
          html += '</div><!--./col-10-->';
        html += '</div><!--./form-group-->';

        html += '<div class="form-group row">';
          html += '<label class="col-3 col-form-label">Administrative Area Level 1</label>';
          html += '<div class="col">';
            html += '<input readonly class="form-control form-control-sm" type="text" name="header[administrative_area_level_1]"/>';
          html += '</div><!--./col-10-->';
        html += '</div><!--./form-group-->';*/

    html += '<div class="form-group row d-none">';
    html += '<label class="col-4 col-form-label">Country</label>';
    html += '<div class="col">';
    html +=
      '<input readonly class="form-control form-control-sm" type="text" name="header[country]"/>';
    html += "</div><!--./col-10-->";
    html += "</div><!--./form-group-->";

    html += '<div class="form-group row">';
    html +=
      '<label class="col-4 col-form-label align-self-center">Designation <span class="text-danger fw-bolder">*</span></label>';
    html += '<div class="col align-self-center">';
    html +=
      '<input class="form-control form-control-sm" type="text" name="header[designation]" maxlength="100" style="font-size: 15px !important;"/>';
    html += "</div><!--./col-10-->";
    html += "</div><!--./form-group-->";

    /*html += '<div class="form-group row">';
            html += '<label class="col-3 col-form-label">Industry <span class="text-danger fw-bolder">*</span></label>';
            html += '<div class="col-2 d-none">';
                html += '<input readonly class="form-control form-control-sm" type="text" name="header[industry]"/>';
            html += '</div>';
            html += '<div class="col">';
                html += '<div class="input-group input-group-sm">';
                    html += '<input class="form-control form-control-sm" type="text" id="header[industry_text]"/>';
                    html += '<div class="input-group-append">';
                        html += '<span class="input-group-text"><i class="fa fa-list"></i></span>';
                    html += '</div><!--./input-group-append-->';
                html += '</div><!--./input-group input-group-sm-->';
            html += '</div><!--./col-10-->';
        html += '</div><!--./form-group-->';*/

    html += '<div class="form-group row">';
    html +=
      '<label class="col-4 col-form-label align-self-center">Industry <span class="text-danger fw-bolder">*</span></label>';
    html += '<div class="col align-self-center">';
    html += '<div class="input-group input-group-sm">';
    html +=
      '<input class="form-control form-control-sm d-none" type="text" name="placeholder[industry]"/>';
    html += '<select name="header[industry]"></select>';
    html += "</div>";
    html += "</div><!--./col-10-->";
    html += "</div><!--./form-group-->";

    return html;
  } //end function
  //===============================================================================================================================
  //end template

  $("#loading").hide();
}); //End document.ready
