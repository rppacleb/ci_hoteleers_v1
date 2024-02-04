$(document).ready(function () {
  var homeurl = baseurl + "/home";
  var homeurl_txt = "job_post";

  if (parseInt(first_login)) {
    //setTimeout(function(){
    //$('#preference_modal').modal('show');
    load_filter_dropdowns();
    $("#required_modal").modal("show");

    //},2000)

    //alert('sadfasf')
  } //
  if (user_type == "employer") {
    if (!parseInt(password_changed)) {
      //setTimeout(function(){
      $("#password_change_modal").modal("show");
      //},2000)

      //alert('sadfasf')
    } //end if
  } //end if

  if ($(window).width() >= 1441) {
    $(".container-fluid").css({ "max-width": "1440px" });
  } else if ($(window).width() >= 1360 && $(window).width() <= 1440) {
    $(".container-fluid").css({ "max-width": "1350px" });
  } else if ($(window).width() >= 1200 && $(window).width() <= 1359) {
    $(".container-fluid").css({ "max-width": "1200px" });
  }

  $(document.body).on("click", "button[name=btn_login]", function (e) {
    var homeurl = baseurl + "/home";
    var url = baseurl + "/login/login";

    $.ajax({
      url: url,
      data: $("#frm_preference").serialize(),
      type: "POST",
      dataType: "JSON",
      beforeSend: function (data) {
        $("button[name=btn_login]").text("Logging in...");
        $("button[name=btn_login]").attr("disabled", "disabled");
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

          $.notify(msg_html, {
            position: "top center",
            className: "success",
            arrowShow: true,
          });

          setTimeout(function () {
            window.location.replace(homeurl);
          }, 2000);
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

          $("button[name=btn_login]").text("Login");
          $("button[name=btn_login]").removeAttr("disabled");
        }
      })
      .fail(function (e) {
        alert(e.responseText);
        $.notify(e.responseText, {
          position: "top center",
          style: "happyblue",
          className: "error",
        });

        $("button[name=btn_login]").text("Login");
        $("button[name=btn_login]").removeAttr("disabled");
      })
      .always(function (e) {});
  });

  //events
  //=====================================================================================================================

  //submit
  $(document.body).on("click", "button.btn_submit", function (e) {
    var view_url = homeurl + "/view/";

    var btn = $(this);
    var btn_text = "";
    var type_text = "";

    var url = homeurl;
    url = homeurl + "/submit_data";
    var url_view = homeurl + "/view";

    var frm_id = "";

    btn_text = "Submit";

    //if(confirm("Are you sure you want to submit this record?")){

    $.ajax({
      url: url,
      type: "POST",
      data: $("#frm_preference").serialize(),
      dataType: "JSON",
      beforeSend: function () {
        $(".outside_button *").css("pointer-events", "none");
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

          $.notify(msg_html, {
            position: "top center",
            className: "success",
            arrowShow: true,
          });

          setTimeout(function () {
            //window.location.replace(homeurl);
            $("#required_modal").modal("hide");
            $("#submitted_modal").modal("show");
            btn.text(btn_text);
            btn.removeAttr("disabled");
          }, 2000);

          //load_record(0,type,type+'_container',type+'_pagination',type+'_loader');
          //$(frm_id+' input[name=header\\[id\\]').val('');
          //$(frm_id+' input[name=header\\[name\\]').val('');

          //load_record(0,'signup','main_container','main_pagination','main_loader');
        } else {
          var msg_html = "";
          var arr = [];
          for (var i = 0; i <= data.messages.length - 1; i++) {
            for (var element in data.messages[i]) {
              arr.push(data.messages[i][element]);
              msg_html += data.messages[i][element] + "<br/>";
            } //end for
          } //End for

          $("#error_cont").html(
            '<div class="alert alert-danger" style="min-width:100%;">' +
              msg_html +
              "</div>"
          );

          btn.text(btn_text);
          btn.removeAttr("disabled");
          $(".outside_button *").css("pointer-events", "auto");
        }
      })
      .fail(function (e) {
        alert(e.responseText);

        btn.text(btn_text);
        btn.removeAttr("disabled");
        $(".outside_button *").css("pointer-events", "auto");
      })
      .always(function (e) {});
    //}//end if
  }); //end if
  //end submit

  //submit
  $(document.body).on("click", "button.btn_change_password", function (e) {
    var view_url = homeurl + "/view/";

    var btn = $(this);
    var btn_text = "";
    var type_text = "";

    var url = homeurl;
    url = homeurl + "/change_password";
    var url_view = homeurl + "/view";

    var frm_id = "";

    btn_text = "Submit";

    if (confirm("Are you sure you want to submit this record?")) {
      $.ajax({
        url: url,
        type: "POST",
        data: $("#frm_change_password").serialize(),
        dataType: "JSON",
        beforeSend: function () {
          $(".outside_button *").css("pointer-events", "none");
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

            $.notify(msg_html, {
              position: "top center",
              className: "success",
              arrowShow: true,
            });

            setTimeout(function () {
              window.location.replace(homeurl);
              btn.text(btn_text);
              btn.removeAttr("disabled");
            }, 2000);

            //load_record(0,type,type+'_container',type+'_pagination',type+'_loader');
            //$(frm_id+' input[name=header\\[id\\]').val('');
            //$(frm_id+' input[name=header\\[name\\]').val('');

            //load_record(0,'signup','main_container','main_pagination','main_loader');
          } else {
            var msg_html = "";
            var arr = [];
            for (var i = 0; i <= data.messages.length - 1; i++) {
              for (var element in data.messages[i]) {
                arr.push(data.messages[i][element]);
                //msg_html += data.messages[i][element] + '<br/>';
                msg_html += data.messages[i][element] + "\n";
              } //end for
            } //End for

            //$('#error_cont').html('<div class="alert alert-danger">'+msg_html+'</div>');

            $.notify(msg_html, {
              position: "top center",
              className: "error",
              arrowShow: true,
            });

            btn.text(btn_text);
            btn.removeAttr("disabled");
            $(".outside_button *").css("pointer-events", "auto");
          }
        })
        .fail(function (e) {
          alert(e.responseText);

          btn.text(btn_text);
          btn.removeAttr("disabled");
          $(".outside_button *").css("pointer-events", "auto");
        })
        .always(function (e) {});
    } //end if
  }); //end if
  //end submit

  //append data
  $(document.body).on("click", ".btn_add_append", function (e) {
    var type = $(this).attr("aria-type");
    type_txt = type.replace(/_/g, " ");

    var selected = $("select[id=header\\[" + type + "\\]]").val();

    //var id      = $('input[name=header\\['+type+'\\]]').val().trim();
    //var name    = $('input[id=header\\['+type+'_text\\]]').val().trim();

    var html = "";

    var dup = 0;
    $("#cont_" + type)
      .find("input")
      .each(function () {
        var value = $(this).val();
        if (value.toLowerCase() === name.toLowerCase()) {
          dup = 1;
          return false;
        } //end if
      });
    $("#cont_" + type).empty();

    if (selected == "") {
      var msg_html = "Please enter " + type_txt + " name!";
      $.notify(msg_html, {
        position: "top center",
        className: "error",
        arrowShow: true,
      });
      $("input[id=header\\[" + type + "_text\\]]").focus();
    } else {
      if (dup == 0) {
        for (var key in selected) {
          html += '<div class="col">';
          html += '<small class="text-muted">' + selected[key] + "</small>";
          //html += '<button title="Remove" class="text-danger close remove_append" aria-type="'+type+'">&times;</button>';
          html +=
            '<input name="row[' +
            type +
            '][]" class="d-none form-control form-control-sm mb-2" type="text" value="' +
            selected[key] +
            '">';
          html +=
            '<input name="row[name][]" maxlength="200" class="d-none form-control form-control-sm mb-2" type="text" value="' +
            selected[key] +
            '">';
          html += "</div>";
        } //end for

        $("#cont_" + type).append(html);
      } else {
        var msg_html = "Duplicate entry of " + type_txt + " name!";
        $.notify(msg_html, {
          position: "top center",
          className: "error",
          arrowShow: true,
        });
      } //end

      //$('input[name=header\\['+type+'\\]]').val("");
      //$('input[id=header\\['+type+'_text\\]]').val("").focus();
    } //end if
  });
  //end append data

  //remove appended data
  $(document.body).on("click", ".remove_append", function (e) {
    $(this).parent().remove();
  });
  //remove appended data

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

  //load department autocomplete
  $(document.body).on(
    "focus",
    "input[id=header\\[department_text\\]]",
    function () {
      if (!$(this).hasClass("wauto")) {
        load_department_autocomplete(
          $(this),
          $("input[name=header\\[department\\]]")
        );
        $(this).addClass("wauto");
      } //End if
    }
  ); //focus
  $(document.body).on(
    "blur",
    "input[id=header\\[department_text\\]]",
    function () {
      if ($(this).val() == "") {
        $("input[name=header\\[department\\]]").val("");
      } //end if

      if ($("input[name=header\\[department\\]]").val() == "") {
        $(this).val("");
      } //end if
    }
  ); //blur

  //load job level autocomplete
  $(document.body).on(
    "focus",
    "input[id=header\\[job_level_text\\]]",
    function () {
      if (!$(this).hasClass("wauto")) {
        load_job_level_autocomplete(
          $(this),
          $("input[name=header\\[job_level\\]]")
        );
        $(this).addClass("wauto");
      } //End if
    }
  ); //focus
  $(document.body).on(
    "blur",
    "input[id=header\\[job_level_text\\]]",
    function () {
      if ($(this).val() == "") {
        $("input[name=header\\[job_level\\]]").val("");
      } //end if

      if ($("input[name=header\\[job_level\\]]").val() == "") {
        $(this).val("");
      } //end if
    }
  ); //blur

  //load job type autocomplete
  $(document.body).on(
    "focus",
    "input[id=header\\[job_type_text\\]]",
    function () {
      if (!$(this).hasClass("wauto")) {
        load_job_type_autocomplete(
          $(this),
          $("input[name=header\\[job_type\\]]")
        );
        $(this).addClass("wauto");
      } //End if
    }
  ); //focus
  $(document.body).on(
    "blur",
    "input[id=header\\[job_type_text\\]]",
    function () {
      if ($(this).val() == "") {
        $("input[name=header\\[job_type\\]]").val("");
      } //end if

      if ($("input[name=header\\[job_type\\]]").val() == "") {
        $(this).val("");
      } //end if
    }
  ); //blur

  //load education autocomplete
  $(document.body).on(
    "focus",
    "input[id=header\\[education_text\\]]",
    function () {
      if (!$(this).hasClass("wauto")) {
        load_education_autocomplete(
          $(this),
          $("input[name=header\\[education\\]]")
        );
        $(this).addClass("wauto");
      } //End if
    }
  ); //focus
  $(document.body).on(
    "blur",
    "input[id=header\\[education_text\\]]",
    function () {
      if ($(this).val() == "") {
        $("input[name=header\\[education\\]]").val("");
      } //end if

      if ($("input[name=header\\[education\\]]").val() == "") {
        $(this).val("");
      } //end if
    }
  ); //blur

  $(document.body).on(
    "click",
    "#frm_change_password .btn_show_pass",
    function (e) {
      var type = $(this).attr("aria-type");
      var x;
      if (type == "password") {
        x = $("#frm_change_password input[name=header\\[new_password\\]]");
      } else {
        x = $("#frm_change_password input[name=header\\[confirm_password\\]]");
      } //end if

      if (x.attr("type") === "password") {
        x.prop("type", "text");
        $(this)
          .find(".input-group-text")
          .html('<i class="fa fa-eye-slash"></i>');
      } else {
        x.prop("type", "password");
        $(this).find(".input-group-text").html('<i class="fa fa-eye"></i>');
      }
    }
  );

  //add skills
  $(document.body).on("click", "button[name=btn_add_language]", function (e) {
    var param = {};
    var line =
      catchIsNaN($("input[name=row_language\\[line\\]\\[\\]]:last").val()) + 1;
    var table_html = load_language_form(param);
    $("#language_content").append(table_html);
    $("input[name=row_language\\[line\\]\\[\\]]:last").val(line);
    $("input[name=row_language\\[language\\]\\[\\]]:last").focus();
  });
  //end add skills

  //add education
  $(document.body).on("click", "button[name=btn_add_education]", function (e) {
    var param = {};
    var line =
      catchIsNaN($("input[name=row_education\\[line\\]\\[\\]]:last").val()) + 1;
    var table_html = load_education_form(param);
    $("#education_content").append(table_html);

    var url = baseurl + "/get/job_post/oeducation";
    var dropdown = $("select[name=row_education\\[education\\]\\[\\]]:last");

    load_dropdown(url, dropdown);
    load_dropdowns2(dropdown);

    $("input[name=row_education\\[line\\]\\[\\]]:last").val(line);

    //Initialize date time picker
    $("input[name=row_education\\[start_date\\]\\[\\]]").datetimepicker({
      format: "M/YYYY",
    });

    $("input[name=row_education\\[end_date\\]\\[\\]]").datetimepicker({
      format: "M/YYYY",
    });

    $("input[name=row_education\\[school\\]\\[\\]]:last").focus();
  });
  //end add education

  //add industry
  $(document.body).on("click", "button[name=btn_add_industry]", function (e) {
    var param = {};
    var line =
      catchIsNaN($("input[name=row_industry\\[line\\]\\[\\]]:last").val()) + 1;
    var table_html = load_industry_form(param);
    $("#industry_content").append(table_html);
    var url = baseurl + "/get/signup/industry/0";
    var dropdown = $("select[name=row_industry\\[industry\\]\\[\\]]:last");
    load_dropdown(url, dropdown);
    load_dropdowns2(dropdown);

    $("input[name=row_industry\\[line\\]\\[\\]]:last").val(line);
    $("input[id=row_industry\\[industry_text\\]\\[\\]]:last").focus();
  });
  //end add affiliations

  //add affiliations
  $(document.body).on("click", "button[name=btn_add_job_level]", function (e) {
    var param = {};
    var line =
      catchIsNaN($("input[name=row_job_level\\[line\\]\\[\\]]:last").val()) + 1;
    var table_html = load_job_level_form(param);
    $("#job_level_content").append(table_html);

    var url = baseurl + "/get/job_post/ojob_level";
    var dropdown = $("select[name=row_job_level\\[job_level\\]\\[\\]]:last");
    load_dropdown(url, dropdown);
    load_dropdowns2(dropdown);

    $("input[name=row_job_level\\[line\\]\\[\\]]:last").val(line);
    $("input[id=row_job_level\\[job_level_text\\]\\[\\]]:last").focus();
  });
  //end add affiliations

  //add affiliations
  $(document.body).on("click", "button[name=btn_add_job_type]", function (e) {
    var param = {};
    var line =
      catchIsNaN($("input[name=row_job_type\\[line\\]\\[\\]]:last").val()) + 1;
    var table_html = load_job_type_form(param);
    $("#job_type_content").append(table_html);

    var url = baseurl + "/get/job_post/ojob_type";
    var dropdown = $("select[name=row_job_type\\[job_type\\]\\[\\]]:last");
    load_dropdown(url, dropdown);
    load_dropdowns2(dropdown);

    $("input[name=row_job_type\\[line\\]\\[\\]]:last").val(line);
    $("input[id=row_job_type\\[job_type_text\\]\\[\\]]:last").focus();
  });
  //end add affiliations

  //add department
  $(document.body).on("click", "button[name=btn_add_department]", function (e) {
    var param = {};
    var line =
      catchIsNaN($("input[name=row_department\\[line\\]\\[\\]]:last").val()) +
      1;
    var table_html = load_department_form(param);
    $("#department_content").append(table_html);
    var url = baseurl + "/get/job_post/odepartment";
    var dropdown = $("select[name=row_department\\[department\\]\\[\\]]:last");
    load_dropdown(url, dropdown);
    load_dropdowns2(dropdown);

    $("input[name=row_department\\[line\\]\\[\\]]:last").val(line);
    $("input[id=row_department\\[department_text\\]\\[\\]]:last").focus();
  });
  //end add affiliations

  //remove experience
  $(document.body).on("click", "button.close", function (e) {
    var input = $(this).parent().parent();
    input = input.parent();
    $(this).parent().parent().remove();

    ctr = 1;
    input.find("input[name*=line]").each(function () {
      $(this).val(ctr);
      ctr += 1;
    });
  });
  //end remove experience

  $(document.body).on("change", "input[id*=if_current]", function (e) {
    var is_checked = $(this).is(":checked");
    if (is_checked) {
      is_checked = 1;
    } else {
      is_checked = 0;
    } //end if

    var current_input = $(this).parent().parent();
    current_input = current_input.parent().find("input[name*=if_current]");
    $(this).prop("checked", is_checked);
    current_input.val(is_checked);

    var container = $(this).parent().parent();

    container
      .find(
        "input[name=row_education\\[end_date\\]\\[\\]], input[name=row_experience\\[end_date\\]\\[\\]]"
      )
      .parent()
      .parent()
      .removeClass("d-none");
    container
      .find(
        "input[name=row_education\\[end_date\\]\\[\\]], input[name=row_experience\\[end_date\\]\\[\\]]"
      )
      .parent()
      .parent()
      .prev("label")
      .removeClass("d-none");

    //$('input[name=row_education\\[end_date\\]\\[\\]]').parent().parent().removeClass('d-none');
    //$('input[name=row_education\\[end_date\\]\\[\\]]').parent().parent().prev('label').removeClass('d-none');

    if ($(this).is(":checked")) {
      var div = container
        .parent()
        .find(
          "input[name=row_education\\[end_date\\]\\[\\]], input[name=row_experience\\[end_date\\]\\[\\]]"
        );
      var div2 = div.parent().parent();
      div2.addClass("d-none");

      div2.prev("label").addClass("d-none");
      div.val("");
    } else {
      var div = container
        .parent()
        .find(
          "input[name=row_education\\[end_date\\]\\[\\]], input[name=row_experience\\[end_date\\]\\[\\]]"
        );
      var div2 = div.parent().parent();
      div2.removeClass("d-none");
      div2.prev("label").removeClass("d-none");
    } //end if
  });

  //=====================================================================================================================
  //end events

  //autocomplete
  //===============================================================================================================================
  //load dropdown
  function load_dropdown(url, dropdown) {
    //var url     = baseurl + "/get/signup/industry/0";
    $.ajax({
      url: url,
      type: "POST",
      dataType: "JSON",
      async: false,
      beforeSend: function () {},
    })
      .done(function (response) {
        /*var html = '';
            for(var key in response.data){
                html += '<option value="'+response.data[key].id+'">'+response.data[key].name+'</option>';
                
            }//end for
            */

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
            } else if (type == "salary_currency") {
              html +=
                '<option value="' +
                response.data[key].code +
                '">' +
                response.data[key].code +
                "</option>";
            } else {
              html +=
                '<option value="' +
                response.data[key].id +
                '">' +
                response.data[key].name +
                "</option>";
            } //end if
          }
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

  //Industry autocomplete
  function load_industry_autocomplete(html, html_id) {
    var url = baseurl + "/get/signup/industry/0";
    $.ajax({
      url: url,
      type: "POST",
      dataType: "JSON",
      async: false,
      beforeSend: function () {},
    })
      .done(function (response) {
        var html = "";
        for (var key in response.data) {
          html +=
            '<option value="' +
            response.data[key].id +
            '">' +
            response.data[key].name +
            "</option>";
        } //end for
        $("#header\\[industry\\]").html(html);
      })
      .fail(function (e) {
        alert(e.responseText);
        btn.html(btn_text);
        $(".outside_button *").css("pointer-events", "auto");
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

  //department autocomplete
  function load_department_autocomplete(html, html_id) {
    var url = baseurl + "/get/job_post/odepartment";
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

  //job level autocomplete
  function load_job_level_autocomplete(html, html_id) {
    var url = baseurl + "/get/job_post/ojob_level";
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

  //job type autocomplete
  function load_job_type_autocomplete(html, html_id) {
    var url = baseurl + "/get/job_post/ojob_type";
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

  //education autocomplete
  function load_education_autocomplete(html, html_id) {
    var url = baseurl + "/get/job_post/oeducation";
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

  //modal
  //=======================================================================================================================
  //Lookup Modal
  $("#preference_modal").on("shown.bs.modal", function (e) {
    //Set Title
    var param = {};
    var title = "PREFERENCES";
    var type = "preference";

    param.id = user_id;
    param.type = type;
    //alert(id)
    $("#preference_modal_title").html(title);

    //$('#btnOk').html('<span class="spinner-grow spinner-grow-sm"></span></span> Loading...');
    //$('#btnOk').attr('disabled','disabled');

    var html_table = load_preference_form(param);
    $("#preference_modal_body").html(html_table);
    //load_industry_autocomplete();

    var url = baseurl + "/get/signup/industry/0";
    var dropdown = $("#header\\[industry\\]");
    load_dropdown(url, dropdown);
    load_dropdowns("industry");

    url = baseurl + "/get/job_post/ojob_level";
    dropdown = $("#header\\[job_level\\]");
    load_dropdown(url, dropdown);
    load_dropdowns("job_level");

    url = baseurl + "/get/job_post/ojob_type";
    dropdown = $("#header\\[job_type\\]");
    load_dropdown(url, dropdown);
    load_dropdowns("job_type");

    url = baseurl + "/get/job_post/odepartment";
    dropdown = $("#header\\[department\\]");
    load_dropdown(url, dropdown);
    load_dropdowns("department");
  });

  $("#preference_modal").on("hide.bs.modal", function (e) {
    $("#preference_modal_title").empty();
    $("#preference_modal_body").empty();
  });

  $("#password_change_modal").on("shown.bs.modal", function (e) {
    //Set Title
    var param = {};
    var title = "CHANGE PASSWORD";
    var type = "change_password";

    param.id = user_id;
    param.type = type;
    //alert(id)
    $("#password_change_modal_title").html(title);

    //$('#btnOk').html('<span class="spinner-grow spinner-grow-sm"></span></span> Loading...');
    //$('#btnOk').attr('disabled','disabled');

    var html_table = load_change_password_form(param);
    $("#password_change_modal_body").html(html_table);
    //load_industry_autocomplete();
  });

  $("#password_change_modal").on("hide.bs.modal", function (e) {
    $("#password_change_modal_title").empty();
    $("#password_change_modal_body").empty();
  });
  //End Lookup Modal
  //=======================================================================================================================
  //end modal

  //load dropdwowns
  function load_dropdowns(type) {
    $("#header\\[" + type + "\\]").multiselect({
      enableFiltering: true,
      //selectAllValue: 'multiselect-all',
      //selectAllText: 'Select All',
      //includeSelectAllOption : true,

      maxHeight: 300,
      enableCaseInsensitiveFiltering: true,
      onChange: function (element, checked) {
        if (checked) {
          //alert(element.val());

          var html = "";
          $("option:selected", $("#header\\[" + type + "\\]")).each(function (
            element2
          ) {
            html += '<div class="col d-none">';
            html += '<small class="text-muted">' + $(this).val() + "</small>";
            //html += '<button title="Remove" class="text-danger close remove_append" aria-type="'+type+'">&times;</button>';
            html +=
              '<input name="row[' +
              type +
              '][]" class="d-none form-control form-control-sm mb-2" type="text" value="' +
              $(this).val() +
              '">';
            html +=
              '<input name="row[name][]" maxlength="200" class="d-none form-control form-control-sm mb-2" type="text" value="' +
              $(this).val() +
              '">';
            html += "</div>";
          });

          $("#cont_" + type).html(html);
        } else {
          var html = "";

          $("#cont_" + type)
            .find("input[name=row\\[" + type + "\\]\\[\\]]")
            .each(function () {
              var edit_l = $(this).parent();
              var value = $(this).val();

              $("option:selected", $("#header\\[" + type + "\\]")).each(
                function (element2) {
                  if (value.toLowerCase() === $(this).val().toLowerCase()) {
                    html += '<div class="col d-none">';
                    html +=
                      '<small class="text-muted">' + $(this).val() + "</small>";
                    //html += '<button title="Remove" class="text-danger close remove_append" aria-type="'+type+'">&times;</button>';
                    html +=
                      '<input name="row[' +
                      type +
                      '][]" class="d-none form-control form-control-sm mb-2" type="text" value="' +
                      $(this).val() +
                      '">';
                    html +=
                      '<input name="row[name][]" maxlength="200" class="d-none form-control form-control-sm mb-2" type="text" value="' +
                      $(this).val() +
                      '">';
                    html += "</div>";
                  } else {
                    edit_l.remove();
                  } //end if
                }
              );
            });

          $("#cont_" + type).html(html);
        } //end if
      },
    });
  } //end function

  function load_dropdowns2(dropdown) {
    dropdown.multiselect({
      enableFiltering: true,
      //selectAllValue: 'multiselect-all',
      //selectAllText: 'Select All',
      //includeSelectAllOption : true,

      maxHeight: 300,
      enableCaseInsensitiveFiltering: true,
    });
  } //end function

  function load_dropdowns3(type) {
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
            } else if (type == "salary_currency") {
              html +=
                '<option value="' +
                response.data[key].code +
                '">' +
                response.data[key].code +
                "</option>";
            } else {
              html +=
                '<option value="' +
                response.data[key].id +
                '">' +
                response.data[key].name +
                "</option>";
            } //end if
          }
        } //end for
        dropdown.html(html);
      })
      .fail(function (e) {
        alert(e.responseText);
      })
      .always(function (e) {});
  }

  function load_filter_dropdowns() {
    var url = baseurl + "/get/job_post/olocation";
    var dropdown = $("select[name=header\\[location\\]]");
    load_dropdown(url, dropdown, "location");
    load_dropdowns2(dropdown);

    dropdown = $("select[name=header\\[dial_code\\]]");
    load_dropdowns2(dropdown);

    dropdown_loaded = 1;
  } //end function

  //table template
  //=======================================================================================================================
  function load_preference_form(param) {
    var html = "";

    html += '<form id="frm_' + param.type + '">';
    html += '<div class="row">';
    html += '<div class="col">';

    html += "</div>";
    html += "</div>";

    html += '<div class="form-group row d-none">';
    html += '<label class="col-3 col-form-label text-link">Id</label>';
    html += '<div class="col">';
    html +=
      '<input value="' +
      param.id +
      '" readonly class="form-control form-control-sm mb-2" type="text" aria-type="' +
      param.type +
      '" name="header[id]"/>';
    html += "</div>";
    html += "</div>";

    html += '<div class="row">';
    html += '<div class="col-3"></div>';
    html += '<div class="col">';
    html += '<div id="cont_industry" class="row row-cols-3 mb-3">';
    html += "</div>";
    html += "</div>";
    html += "</div>";

    html += '<div class="form-group row">';
    html +=
      '<label class="col-3 col-form-label">Industry <span class="text-danger fw-bolder">*</span></label>';
    html += '<div class="col-2 d-none">';
    //html += '<input readonly class="form-control form-control-sm" type="text" name="header[industry]"/>';
    html += "</div>";
    html += '<div class="col">';
    html += '<div class="input-group input-group-sm">';
    html += '<select id="header[industry]" multiple="multiple">';
    html += "</select>";
    html += "</div><!--./input-group input-group-sm-->";

    /*html += '<div class="input-group input-group-sm">';
                        html += '<input class="form-control form-control-sm" type="text" id="header[industry_text]"/>';
                        html += '<div class="input-group-append btn_add_append" aria-type="industry">';
                            html += '<span class="input-group-text"><i class="fa fa-plus"></i></span>';
                        html += '</div><!--./input-group-append-->';
                    html += '</div><!--./input-group input-group-sm-->';*/
    html += "</div><!--./col-10-->";
    html += "</div><!--./form-group-->";

    html += '<div class="row">';
    html += '<div class="col-3"></div>';
    html += '<div class="col">';
    html += '<div id="cont_job_level" class="row row-cols-3 mb-3">';
    html += "</div>";
    html += "</div>";
    html += "</div>";

    html += '<div class="form-group row">';
    html +=
      '<label class="col-3 col-form-label">Job Level <span class="text-danger fw-bolder">*</span></label>';
    html += '<div class="col-2 d-none">';
    //html += '<input readonly class="form-control form-control-sm" type="text" name="header[job_level]"/>';
    html += "</div>";
    html += '<div class="col">';
    html += '<div class="input-group input-group-sm">';
    html += '<select id="header[job_level]" multiple="multiple">';
    html += "</select>";
    html += "</div><!--./input-group input-group-sm-->";
    html += "</div><!--./col-10-->";
    html += "</div><!--./form-group-->";

    html += '<div class="row">';
    html += '<div class="col-3"></div>';
    html += '<div class="col">';
    html += '<div id="cont_job_type" class="row row-cols-3 mb-3">';
    html += "</div>";
    html += "</div>";
    html += "</div>";

    html += '<div class="form-group row">';
    html +=
      '<label class="col-3 col-form-label">Job Type <span class="text-danger fw-bolder">*</span></label>';
    html += '<div class="col-2 d-none">';
    //html += '<input readonly class="form-control form-control-sm" type="text" name="header[job_type]"/>';
    html += "</div>";
    html += '<div class="col">';
    html += '<div class="input-group input-group-sm">';
    html += '<select id="header[job_type]" multiple="multiple">';
    html += "</select>";
    html += "</div><!--./input-group input-group-sm-->";
    html += "</div><!--./col-10-->";
    html += "</div><!--./form-group-->";

    html += '<div class="row">';
    html += '<div class="col-3"></div>';
    html += '<div class="col">';
    html += '<div id="cont_department" class="row row-cols-3 mb-3">';
    html += "</div>";
    html += "</div>";
    html += "</div>";

    html += '<div class="form-group row">';
    html +=
      '<label class="col-3 col-form-label">Department <span class="text-danger fw-bolder">*</span></label>';
    html += '<div class="col-2 d-none">';
    //html += '<input readonly class="form-control form-control-sm" type="text" name="header[department]"/>';
    html += "</div>";
    html += '<div class="col">';
    html += '<div class="input-group input-group-sm">';
    html += '<select id="header[department]" multiple="multiple">';
    html += "</select>";
    html += "</div><!--./input-group input-group-sm-->";
    html += "</div><!--./col-10-->";
    html += "</div><!--./form-group-->";

    html += '<div class="form-group row">';
    html += '<div id="error_cont" class="col">';
    html += "</div>";
    html += "</div>";

    html += "</form>";
    html += '<div class="text-right">';
    html +=
      '<button class="btn btn-pill-md btn-primary btn_submit" type="button" aria-type="' +
      param.type +
      '">Submit</button>';
    html += "</div>";
    return html;
  } //end if

  function load_change_password_form(param) {
    var html = "";

    html += '<form id="frm_' + param.type + '">';
    html += '<div class="row">';
    html += '<div class="col">';

    html += "</div>";
    html += "</div>";

    html += '<div class="form-group row d-none">';
    html += '<label class="col-3 col-form-label text-link">Id</label>';
    html += '<div class="col">';
    html +=
      '<input value="' +
      param.id +
      '" readonly class="form-control form-control-sm mb-2" type="text" aria-type="' +
      param.type +
      '" name="header[id]"/>';
    html += "</div>";
    html += "</div>";

    html += '<div class="row">';
    html +=
      '<label class="col-xl-4 col-lg-4 col-auto col-form-label">New Password <span class="text-danger fw-bolder">*</span></label>';
    html += '<div class="col">';
    html += '<div class="form-group">';
    html += '<div class="input-group input-group-md">';
    html +=
      '<input value="" name="header[new_password]" type="password" class="form-control" maxlength="50">';
    html +=
      '<div class="input-group-append input-group-addon btn_show_pass" aria-type="password">';
    html += '<div class="input-group-text"><i class="fa fa-eye"></i></div>';
    html += "</div>";
    html += "</div>";
    html += "</div><!--./form-group-->";
    html += "</div><!--./col-->";
    html += "</div><!--./row-->";

    html += '<div class="row">';
    html +=
      '<label class="col-xl-4 col-lg-4 col-auto col-form-label">Confirm Password <span class="text-danger fw-bolder">*</span></label>';
    html += '<div class="col">';
    html += '<div class="form-group input-group-md">';
    html += '<div class="input-group">';
    html +=
      '<input value="" name="header[confirm_password]" type="password" class="form-control" maxlength="50">';
    html +=
      '<div class="input-group-append input-group-addon btn_show_pass" aria-type="confirm_password">';
    html += '<div class="input-group-text"><i class="fa fa-eye"></i></div>';
    html += "</div>";
    html += "</div>";
    html += "</div><!--./form-group-->";
    html += "</div><!--./col-->";
    html += "</div><!--./row-->";

    html += '<div class="row align-items-center justify-content-center mb-3">';
    html +=
      '<label class="col-auto col-form-label text-primary text-right"><span class="fa fa-info-circle"></span></label>';
    html += '<div class="col-auto text-primary">';
    html +=
      "<small>Password must be min. of 8 chars with upper, lower case & number</small>";
    html += "</div>";
    html += "</div>";

    html += "</form>";
    html += '<div class="text-right">';
    html +=
      '<button class="btn btn-pill-md btn-primary btn_change_password" type="button" aria-type="' +
      param.type +
      '">Submit</button>';
    html += "</div>";
    return html;
  } //end if

  function load_education_form(param) {
    var html = "";
    html += '<div class="card mb-2">';
    html += '<div class="card-body">';
    html += '<button type="button" class="close close-btn" aria-label="Close">';
    html += '<span aria-hidden="true" class="close-span">&times;</span>';
    html += "</button>";
    html += "</div>";
    html += '<div class="card-body">';

    html += '<div class="form-group row d-none">';
    html +=
      '<label class="col-3 col-form-label text-right align-self-center">Line <span class="text-danger fw-bolder">*</span></label>';
    html += '<div class="col-8 align-self-center">';
    html +=
      '<input readonly class="form-control form-control-sm" type="text" name="row_education[line][]" maxlength="100"/>';
    html += "</div><!--./col-10-->";
    html += "</div><!--./form-group-->";

    if ($(window).width() <= 1024) {
      html += '<div class="form-group row">';
      html +=
        '<label class="col-4 col-sm-4 col-md-4 col-lg-3 col-xl-3 col-form-label text-right align-self-center">University /<br/>School <span class="text-danger fw-bolder">*</span></label>';
      html +=
        '<div class="col-8 col-sm-8 col-md-6 col-lg-8 col-xl-8 align-self-center">';
      html +=
        '<input class="form-control form-control-sm" type="text" name="row_education[school][]" maxlength="200"/>';
      html += "</div><!--./col-10-->";
      html += "</div><!--./form-group-->";

      html += '<div class="form-group row">';
      html +=
        '<label class="col-4 col-sm-4 col-md-4 col-lg-3 col-xl-3 col-form-label text-right align-self-center">Degree/Field of Study <span class="text-danger fw-bolder">*</span></label>';
      html +=
        '<div class="col-8 col-sm-8 col-md-6 col-lg-8 col-xl-8 align-self-center">';
      html +=
        '<input class="form-control form-control-sm" type="text" name="row_education[degree][]" maxlength="200"/>';
      html += "</div><!--./col-10-->";
      html += "</div><!--./form-group-->";
    } else {
      html += '<div class="form-group row">';
      html +=
        '<label class="col-4 col-sm-4 col-md-4 col-lg-3 col-xl-3 col-form-label text-right align-self-center">University/School <span class="text-danger fw-bolder">*</span></label>';
      html +=
        '<div class="col-8 col-sm-8 col-md-6 col-lg-8 col-xl-8 align-self-center">';
      html +=
        '<input class="form-control form-control-sm" type="text" name="row_education[school][]" maxlength="200"/>';
      html += "</div><!--./col-10-->";
      html += "</div><!--./form-group-->";

      html += '<div class="form-group row">';
      html +=
        '<label class="col-4 col-sm-4 col-md-4 col-lg-3 col-xl-3 col-form-label text-right align-self-center">Degree/Field of Study <span class="text-danger fw-bolder">*</span></label>';
      html +=
        '<div class="col-8 col-sm-8 col-md-6 col-lg-8 col-xl-8 align-self-center">';
      html +=
        '<input class="form-control form-control-sm" type="text" name="row_education[degree][]" maxlength="200"/>';
      html += "</div><!--./col-10-->";
      html += "</div><!--./form-group-->";
    }

    html += '<div class="form-group row">';
    html +=
      '<label class="col-3 col-form-label text-right align-self-center">Education <span class="text-danger fw-bolder">*</span></label>';
    html += '<div class="col-8 align-self-center">';
    html += '<div class="input-group input-group-sm">';
    html +=
      '<input class="form-control form-control-sm d-none" type="text" name="placeholder[education][]"/>';
    html += '<select name="row_education[education][]"></select>';
    html += "</div>";
    html += "</div><!--./col-10-->";
    html += "</div><!--./form-group-->";

    if ($(window).width() <= 1024) {
      html += '<div class="form-group row">';
      html +=
        '<label class="col-4 col-sm-4 col-md-4 col-lg-3 col-xl-3 col-form-label text-right align-self-center">Start Date</label>';
      html +=
        '<div class="col-8 col-sm-8 col-md-6 col-lg-8 col-xl-8 align-self-center">';
      html += '<div class="input-group input-group-sm">';
      html +=
        '<input class="form-control form-control-sm" type="text" placeholder="MM/YYYY" name="row_education[start_date][]"/>';
      html += '<div class="input-group-append">';
      html +=
        '<span class="input-group-text"><i class="fa fa-calendar"></i></span>';
      html += "</div><!--./input-group-append-->";
      html += "</div><!--./input-group input-group-sm-->";
      html += "</div><!--./col-->";
      html += "</div><!--./form-group-->";

      html += '<div class="form-group row">';
      html +=
        '<label class="col-4 col-sm-4 col-md-4 col-lg-3 col-xl-3 col-form-label text-right align-self-center">End Date</label>';
      html +=
        '<div class="col-8 col-sm-8 col-md-6 col-lg-8 col-xl-8 align-self-center">';
      html += '<div class="input-group input-group-sm date">';
      html +=
        '<input class="form-control form-control-sm" type="text" placeholder="MM/YYYY" name="row_education[end_date][]"/>';
      html += '<div class="input-group-append">';
      html +=
        '<span class="input-group-text"><i class="fa fa-calendar"></i></span>';
      html += "</div><!--./input-group-append-->";
      html += "</div><!--./input-group input-group-sm-->";
      html += "</div><!--./col-10-->";
      html += "</div><!--./form-group-->";
    } else {
      html += '<div class="form-group row">';
      html +=
        '<label class="col-3 col-md-4 col-xl-3 col-lg-3 col-form-label text-right align-self-center">Start Date</label>';
      html += '<div class="col-3 align-self-center">';
      html += '<div class="input-group input-group-sm">';
      html +=
        '<input class="form-control form-control-sm" type="text" placeholder="MM/YYYY" name="row_education[start_date][]"/>';
      html += '<div class="input-group-append">';
      html +=
        '<span class="input-group-text"><i class="fa fa-calendar"></i></span>';
      html += "</div><!--./input-group-append-->";
      html += "</div><!--./input-group input-group-sm-->";
      html += "</div><!--./col-->";

      html +=
        '<label class="col-2 col-form-label text-right align-self-center">End Date</label>';
      html += '<div class="col-3 align-self-center">';
      html += '<div class="input-group input-group-sm date">';
      html +=
        '<input class="form-control form-control-sm" type="text" placeholder="MM/YYYY" name="row_education[end_date][]"/>';
      html += '<div class="input-group-append">';
      html +=
        '<span class="input-group-text"><i class="fa fa-calendar"></i></span>';
      html += "</div><!--./input-group-append-->";
      html += "</div><!--./input-group input-group-sm-->";
      html += "</div><!--./col-10-->";
      html += "</div><!--./form-group-->";
    }

    html += '<div class="form-group row">';
    html +=
      '<label class="col-3 col-form-label text-right align-self-center">If Current</label>';
    html += '<div class="col-1 align-self-center">';
    html +=
      '<input type="checkbox" class="w-auto" id="row_education[if_current][]"/>';
    html += "</div><!--./col-10-->";
    html += "</div><!--./form-group-->";

    html += '<div class="form-group row d-none">';
    html +=
      '<label class="col-3 col-form-label text-right align-self-center">If Current</label>';
    html += '<div class="col-1 align-self-center">';
    html += '<input value="0" type="text" name="row_education[if_current][]"/>';
    html += "</div><!--./col-10-->";
    html += "</div><!--./form-group-->";

    html += "</div>";
    html += "</div>";
    return html;
  } //end

  function load_language_form(param) {
    var html = "";

    html += '<div class="card mb-2">';
    html += '<div class="card-body">';
    html += '<button type="button" class="close close-btn" aria-label="Close">';
    html += '<span aria-hidden="true" class="close-span">&times;</span>';
    html += "</button>";
    html += "</div>";
    html += '<div class="card-body">';
    html += '<div class="form-group row d-none">';
    html +=
      '<label class="col-3 col-form-label text-right align-self-center">Line <span class="text-danger fw-bolder">*</span></label>';
    html += '<div class="col-8 align-self-center">';
    html +=
      '<input readonly class="form-control form-control-sm" type="text" name="row_language[line][]" maxlength="100"/>';
    html += "</div><!--./col-10-->";
    html += "</div><!--./form-group-->";

    html += '<div class="form-group row">';
    html +=
      '<label class="col-3 col-form-label text-right align-self-center"><span class="text-danger fw-bolder">*</span></label>';
    html += '<div class="col-8 align-self-center">';
    html +=
      '<input class="form-control form-control-sm" type="text" name="row_language[language][]" maxlength="200"/>';
    html += "</div><!--./col-10-->";
    html += "</div><!--./form-group-->";
    html += "</div>";
    html += "</div>";
    return html;
  } //end

  function load_industry_form(param) {
    var html = "";

    html += "<div>";
    html += "<div>";
    html += '<button type="button" class="close close-btn" aria-label="Close">';
    html += '<span aria-hidden="true" class="close-span">&times;</span>';
    html += "</button>";
    html += "</div>";
    html += "<div>";

    html += '<div class="form-group row d-none">';
    html +=
      '<label class="col-3 col-form-label text-right align-self-center">Line <span class="text-danger fw-bolder">*</span></label>';
    html += '<div class="col-8 align-self-center">';
    html +=
      '<input readonly class="form-control form-control-sm" type="text" name="row_industry[line][]" maxlength="100"/>';
    html += "</div><!--./col-10-->";
    html += "</div><!--./form-group-->";

    html += '<div class="form-group row">';
    html +=
      '<label class="col-3 col-form-label text-right align-self-center"></label>';
    html += '<div class="col-8 align-self-center">';
    html += '<div class="input-group input-group-sm">';
    html +=
      '<input class="form-control form-control-sm d-none" type="text" name="placeholder[industry][]"/>';
    html += '<select name="row_industry[industry][]"></select>';
    html += "</div>";
    html += "</div><!--./col-10-->";
    html += "</div><!--./form-group-->";
    html += "</div>";
    html += "</div>";

    return html;
  } //end

  function load_job_level_form(param) {
    var html = "";
    html += "<div>";
    html += "<div>";
    html += '<button type="button" class="close close-btn" aria-label="Close">';
    html += '<span aria-hidden="true" class="close-span">&times;</span>';
    html += "</button>";
    html += "</div>";
    html += "<div>";
    html += '<div class="form-group row d-none">';
    html +=
      '<label class="col-3 col-form-label text-right align-self-center">Line <span class="text-danger fw-bolder">*</span></label>';
    html += '<div class="col-8 align-self-center">';
    html +=
      '<input readonly class="form-control form-control-sm" type="text" name="row_job_level[line][]" maxlength="100"/>';
    html += "</div><!--./col-10-->";
    html += "</div><!--./form-group-->";

    html += '<div class="form-group row">';
    html +=
      '<label class="col-3 col-form-label text-right align-self-center"></label>';
    html += '<div class="col-8 align-self-center">';
    html += '<div class="input-group input-group-sm">';
    html +=
      '<input class="form-control form-control-sm d-none" type="text" name="placeholder[job_level][]"/>';
    html += '<select name="row_job_level[job_level][]"></select>';
    html += "</div>";
    html += "</div><!--./col-10-->";
    html += "</div><!--./form-group-->";
    html += "</div>";
    html += "</div>";

    return html;
  } //end

  function load_job_type_form(param) {
    var html = "";
    html += "<div>";
    html += "<div>";
    html += '<button type="button" class="close close-btn" aria-label="Close">';
    html += '<span aria-hidden="true" class="close-span">&times;</span>';
    html += "</button>";
    html += "</div>";
    html += "<div>";
    html += '<div class="form-group row d-none">';
    html +=
      '<label class="col-3 col-form-label text-right align-self-center">Line <span class="text-danger fw-bolder">*</span></label>';
    html += '<div class="col-8 align-self-center">';
    html +=
      '<input readonly class="form-control form-control-sm" type="text" name="row_job_type[line][]" maxlength="100"/>';
    html += "</div><!--./col-10-->";
    html += "</div><!--./form-group-->";

    html += '<div class="form-group row">';
    html +=
      '<label class="col-3 col-form-label text-right align-self-center"></label>';
    html += '<div class="col-8 align-self-center">';
    html += '<div class="input-group input-group-sm">';
    html +=
      '<input class="form-control form-control-sm d-none" type="text" name="placeholder[job_type][]"/>';
    html += '<select name="row_job_type[job_type][]"></select>';
    html += "</div>";
    html += "</div><!--./col-10-->";
    html += "</div><!--./form-group-->";
    html += "</div>";
    html += "</div>";

    return html;
  } //end

  function load_department_form(param) {
    var html = "";
    html += "<div>";
    html += "<div>";
    html += '<button type="button" class="close close-btn" aria-label="Close">';
    html += '<span aria-hidden="true" class="close-span">&times;</span>';
    html += "</button>";
    html += "</div>";
    html += "<div>";
    html += '<div class="form-group row d-none">';
    html +=
      '<label class="col-3 col-form-label text-right align-self-center">Line <span class="text-danger fw-bolder">*</span></label>';
    html += '<div class="col-8 align-self-center">';
    html +=
      '<input readonly class="form-control form-control-sm" type="text" name="row_department[line][]" maxlength="100"/>';
    html += "</div><!--./col-10-->";
    html += "</div><!--./form-group-->";

    html += '<div class="form-group row">';
    html +=
      '<label class="col-3 col-form-label text-right align-self-center"></label>';
    html += '<div class="col-8 align-self-center">';
    html += '<div class="input-group input-group-sm">';
    html +=
      '<input class="form-control form-control-sm d-none" type="text" name="placeholder[department][]"/>';
    html += '<select name="row_department[department][]"></select>';
    html += "</div>";
    html += "</div><!--./col-10-->";
    html += "</div><!--./form-group-->";

    html += "</div>";
    html += "</div>";

    return html;
  } //end
  //=======================================================================================================================
  //end table template
  $("#loading").hide();
}); //End document.ready
