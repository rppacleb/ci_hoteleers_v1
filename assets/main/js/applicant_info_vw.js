$(document).ready(function () {
  /* ADDED - GIAN - START */
  $("#side_menu").addClass("d-none");

  if ($("#side_menu").hasClass("d-none")) {
    $("#right-menu").removeClass("col-xl-10 col-lg-10");
    $("#right-menu").addClass("col-xl-11 col-lg-11");
  }

  $("#contact_number").on("input", function () {
    $(this).val(
      $(this)
        .val()
        .replace(/[^0-9]/g, "")
    );
  });

  if (type == "view") {
    $(".aivw-withcbox").contents(":not(input)").remove();
    $(".aivw-mobcode").contents(":not(input)").remove();
    $(".desktop-aivwmobilenumber .aivw-mobcode").removeClass(
      "col-lg-2 col-xl-2"
    );
    $(".desktop-aivwmobilenumber .aivw-mobcode").addClass("col-lg-1 col-xl-1");
    $(".custom-file-upload").remove();
    $(".custom-file-upload2").remove();
    if ($(window).width() <= 1024) {
      $(".desktop-aivwmobilenumber").remove();
      $(".mobile-aivwmobilenumber-edit").remove();
      $(".mobile-aivwmobilenumber-view").css("display", "flex");
    } else {
      $(".mobile-aivwmobilenumber-edit").remove();
      $(".mobile-aivwmobilenumber-view").remove();
    }
  }

  if (type == "edit") {
    /* $('#aivw-checkbox').css('margin-left', '0');
        $('.aivw-cboxjs input').css('margin-left', '0'); */
    $(".aivw-headlocation").remove();
    $(".aivw-mobcode").removeClass("col-3 col-lg-1 col-xl-1");
    $(".aivw-mobcode").addClass("col-2 col-lg-2 col-xl-2");
    $(".aivw-mobnum").removeClass("col-7");
    $(".aivw-mobnum").addClass("col-6");
    $(".custom-file-upload").css("opacity", 1);
    $(".custom-file-upload2").css("opacity", 1);
    if ($(window).width() <= 1024) {
      $(".desktop-aivwmobilenumber").remove();
      $(".mobile-aivwmobilenumber-edit").css("display", "flex");
      $(".mobile-aivwmobilenumber-view").remove();
    } else {
      $(".mobile-aivwmobilenumber-edit").remove();
      $(".mobile-aivwmobilenumber-view").remove();
    }
  }
  /* ADDED - GIAN - END */

  var homeurl = baseurl + "/applicant_info";
  var homeurl_txt = "applicant_info";
  var urlimgdef = baseurl + "/files/images/default/user.png";
  var urlimgnotfound = baseurl + "/assets/img/main/image-not-found.svg";
  var upload_path = baseurl + "/files/uploads/";
  var dropdown_loaded = 0;
  // load_record(0,'signup','main_container','main_pagination','main_loader');

  //alert(moment('4/30/2016', 'MM/DD/YYYY').add(1, 'day'));

  //load_data
  //load record
  $(document.body).on("blur", "input[name=header\\[id\\]]", function (e) {
    var id = $(this).val();
    var type = $(this).attr("aria-type");

    var param = {};
    //param["type"]   = type;
    param["id"] = id;
    param["mode"] = type;
    load_data(param);
  });
  //end load record

  $("input[name=header\\[id\\]]").trigger("blur");

  function load_pagination(param) {
    //test
    var pgntn_current_page = parseInt(param.page === 0 ? 1 : param.page);
    var pgntn_total_page = param.total_page;
    var pgntn_per_pages = 8;
    var pgntn_per_page = parseInt(pgntn_current_page) * pgntn_per_pages;

    var init_ctr = 1;
    if (pgntn_per_page > pgntn_total_page) {
      pgntn_per_page = pgntn_total_page;
    } //end if

    init_ctr = pgntn_per_page - pgntn_per_pages + 1;

    if (param.page == 0 || param.page == 1) {
      init_ctr = 1;
    } //end if
    //alert(init_ctr);

    $("." + param.pagination + "").empty();

    //previous button
    if (pgntn_current_page > 1) {
      var html = "";
      html =
        '<li class="page-item" aria-page="prev" aria-total_page="' +
        pgntn_total_page +
        '" aria-current_page="' +
        pgntn_current_page +
        '"><a class="page-link">Prev</a></li>';
      $("." + param.pagination + "").append(html);
    } //end if
    //end previous button

    for (var i = init_ctr; i <= pgntn_per_page; i++) {
      var html = "";

      html +=
        '<li class="page-item" aria-page="' +
        i +
        '" aria-total_page="' +
        pgntn_total_page +
        '"><a class="page-link">' +
        i +
        "</a></li>";
      $("." + param.pagination + "").append(html);
    } //end if

    //next button
    if (pgntn_per_page !== pgntn_total_page) {
      var html = "";
      html =
        '<li class="page-item" aria-page="next" aria-total_page="' +
        pgntn_total_page +
        '" aria-current_page="' +
        pgntn_current_page +
        '"><a class="page-link">Next</a></li>';
      $("." + param.pagination + "").append(html);
    } //end if
    //end test
    //end next button
  } //end function

  //event
  //=====================================================================================================================
  //pagination button

  //approve
  $(document.body).on("click", "button.btn_submit", function (e) {
    var view_url = homeurl + "/view/";

    var id = $(this).attr("aria-id");
    var btn = $(this);
    var btn_text = "";
    var id = $(this).attr("aria-id");
    var type = $(this).attr("aria-type");
    var type_text = "";

    var url = homeurl;
    url = homeurl + "/submit_data";
    var url_view = homeurl + "/view";

    var frm_id = "";

    btn_text = "Save";

    if (confirm("Are you sure you want to submit this record?")) {
      $.ajax({
        url: url,
        type: "POST",
        data: $("#frm_data_entry").serialize(),
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
            console.log(JSON.stringify(data.messages));
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

            view_url += data.data.id;
            setTimeout(function () {
              window.location.replace(view_url);
              btn.text(btn_text);
              btn.removeAttr("disabled");
            }, 2000);

            //load_record(0,type,type+'_container',type+'_pagination',type+'_loader');
            //$(frm_id+' input[name=header\\[id\\]').val('');
            //$(frm_id+' input[name=header\\[name\\]').val('');

            //load_record(0,'signup','main_container','main_pagination','main_loader');
          } else {
            console.log(JSON.stringify(data.messages));
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
  //end approve

  //change email
  $(document.body).on("click", "#change_email", function () {
    const confirm_var = confirm(
      "This will send a verification code to reset your email address!"
    );
    var btn = $(this);
    // var btn_default_html = '<img width="30%" src="../../assets/img/main/change_email.svg">';
    var btn_default_html =
      '<i class="fa fa-pencil-square" aria-hidden="true" style="font-size: 20px;"></i>';
    var btn_loading_html =
      '<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>';
    var url = homeurl + "/change_email";
    var change_email_url = baseurl + "/change_email";

    if (confirm_var) {
      $.ajax({
        url: url,
        type: "POST",
        data: $("#frm_data_entry").serialize(),
        dataType: "JSON",
        beforeSend: function () {
          $(".outside_button *").css("pointer-events", "none");
          btn.html(btn_loading_html);
          btn.attr("disabled", "disabled");
        },
      })
        .done(function (data) {
          //alert(Object.keys(data.messages).length);
          if (data.success === true) {
            console.log(JSON.stringify(data.messages));
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

            btn.html(btn_default_html);
            btn.removeAttr("disabled");

            setTimeout(function () {
              window.location.replace(change_email_url);
            }, 2000);
          } else {
            console.log(JSON.stringify(data.messages));
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

            btn.html(btn_default_html);
            btn.removeAttr("disabled");
            $(".outside_button *").css("pointer-events", "auto");
          }
        })
        .fail(function (e) {
          alert(e.responseText);

          btn.html(btn_default_html);
          btn.removeAttr("disabled");
          $(".outside_button *").css("pointer-events", "auto");
        })
        .always(function (e) {});
    } //end if
  });
  //end change email

  //load industry autocomplete
  $(document.body).on(
    "focus",
    "input[id=row_industry\\[industry_text\\]\\[\\]]",
    function () {
      if (!$(this).hasClass("wauto")) {
        var input = $(this).parent().parent();
        load_industry_autocomplete(
          $(this),
          input.parent().find("input[name=row_industry\\[industry\\]\\[\\]]")
        );
        $(this).addClass("wauto");
      } //End if
    }
  ); //focus
  $(document.body).on(
    "blur",
    "input[id=row_industry\\[industry_text\\]\\[\\]]",
    function () {
      var input = $(this).parent().parent();
      if ($(this).val() == "") {
        input
          .parent()
          .find("input[name=row_industry\\[industry\\]\\[\\]]")
          .val("");
      } //end if

      if (
        input
          .parent()
          .find("input[name=row_industry\\[industry\\]\\[\\]]")
          .val() == ""
      ) {
        $(this).val("");
      } //end if
    }
  ); //blur

  //load education autocomplete
  $(document.body).on(
    "focus",
    "input[id=row_education\\[education_text\\]\\[\\]]",
    function () {
      if (!$(this).hasClass("wauto")) {
        var input = $(this).parent().parent();
        load_education_autocomplete(
          $(this),
          input.parent().find("input[name=row_education\\[education\\]\\[\\]]")
        );

        //load_education_autocomplete($(this),$('input[name=row_education\\[education\\]\\[\\]]'));
        $(this).addClass("wauto");
      } //End if
    }
  ); //focus
  $(document.body).on(
    "blur",
    "input[id=row_education\\[education_text\\]\\[\\]]",
    function () {
      var input = $(this).parent().parent();
      if ($(this).val() == "") {
        input.find("input[name=row_education\\[education\\]\\[\\]]").val("");
      } //end if

      if (
        input.find("input[name=row_education\\[education\\]\\[\\]]").val() == ""
      ) {
        $(this).val("");
      } //end if
    }
  ); //blur

  //load job level autocomplete
  $(document.body).on(
    "focus",
    "input[id=row_job_level\\[job_level_text\\]\\[\\]]",
    function () {
      if (!$(this).hasClass("wauto")) {
        var input = $(this).parent().parent();
        load_job_level_autocomplete(
          $(this),
          input.parent().find("input[name=row_job_level\\[job_level\\]\\[\\]]")
        );
        $(this).addClass("wauto");
      } //End if
    }
  ); //focus
  $(document.body).on(
    "blur",
    "input[id=row_job_level\\[job_level_text\\]\\[\\]]",
    function () {
      var input = $(this).parent().parent();
      if ($(this).val() == "") {
        input
          .parent()
          .find("input[name=row_job_level\\[job_level\\]\\[\\]]")
          .val("");
      } //end if

      if (
        input
          .parent()
          .find("input[name=row_job_level\\[job_level\\]\\[\\]]")
          .val() == ""
      ) {
        $(this).val("");
      } //end if
    }
  ); //blur

  //load job type autocomplete
  $(document.body).on(
    "focus",
    "input[id=row_job_type\\[job_type_text\\]\\[\\]]",
    function () {
      if (!$(this).hasClass("wauto")) {
        var input = $(this).parent().parent();
        load_job_type_autocomplete(
          $(this),
          input.parent().find("input[name=row_job_type\\[job_type\\]\\[\\]]")
        );
        $(this).addClass("wauto");
      } //End if
    }
  ); //focus
  $(document.body).on(
    "blur",
    "input[id=row_job_type\\[job_type_text\\]\\[\\]]",
    function () {
      var input = $(this).parent().parent();
      if ($(this).val() == "") {
        input
          .parent()
          .find("input[name=row_job_type\\[job_type\\]\\[\\]]")
          .val("");
      } //end if

      if (
        input
          .parent()
          .find("input[name=row_job_type\\[job_type\\]\\[\\]]")
          .val() == ""
      ) {
        $(this).val("");
      } //end if
    }
  ); //blur

  //load job type autocomplete
  $(document.body).on(
    "focus",
    "input[id=row_department\\[department_text\\]\\[\\]]",
    function () {
      if (!$(this).hasClass("wauto")) {
        var input = $(this).parent().parent();
        load_department_autocomplete(
          $(this),
          input
            .parent()
            .find("input[name=row_department\\[department\\]\\[\\]]")
        );
        $(this).addClass("wauto");
      } //End if
    }
  ); //focus
  $(document.body).on(
    "blur",
    "input[id=row_department\\[department_text\\]\\[\\]]",
    function () {
      var input = $(this).parent().parent();
      if ($(this).val() == "") {
        input
          .parent()
          .find("input[name=row_department\\[department\\]\\[\\]]")
          .val("");
      } //end if

      if (
        input
          .parent()
          .find("input[name=row_department\\[department\\]\\[\\]]")
          .val() == ""
      ) {
        $(this).val("");
      } //end if
    }
  ); //blur

  /*
    //row education
    $(document.body).on('change','input[id=row_education\\[if_current\\]\\[\\]]',function(){
        var input       = $(this).parent().parent();
        var container      = $(this).parent().parent();

        $('input[name=row_education\\[end_date\\]\\[\\]]').parent().parent().removeClass('d-none');
        $('input[name=row_education\\[end_date\\]\\[\\]]').parent().parent().prev('label').removeClass('d-none');
        
        if($(this).is(":checked")){
        
            var div = container.parent().find('input[name=row_education\\[end_date\\]\\[\\]]');
            var div2 = div.parent().parent();
                div2.addClass('d-none');

                div2.prev('label').addClass('d-none');
        }else{
            var div = container.parent().find('input[name=row_education\\[end_date\\]\\[\\]]');
            var div2 = div.parent().parent();
                div2.removeClass('d-none');
                div2.prev('label').removeClass('d-none');
        }
    })//change

    //row experience
    $(document.body).on('change','input[id=row_experience\\[if_current\\]\\[\\]]',function(){
        var input       = $(this).parent().parent();
        var container      = $(this).parent().parent();

        $('input[name=row_experience\\[end_date\\]\\[\\]]').parent().parent().removeClass('d-none');
        $('input[name=row_experience\\[end_date\\]\\[\\]]').parent().parent().prev('label').removeClass('d-none');
        
        if($(this).is(":checked")){
        
            var div = container.parent().find('input[name=row_experience\\[end_date\\]\\[\\]]');
            var div2 = div.parent().parent();
                div2.addClass('d-none');

                div2.prev('label').addClass('d-none');
        }else{
            var div = container.parent().find('input[name=row_experience\\[end_date\\]\\[\\]]');
            var div2 = div.parent().parent();
                div2.removeClass('d-none');
                div2.prev('label').removeClass('d-none');
        }
    })//change
    */

  //upload trigger
  $(document.body).on("click", "button[name=btn_upload]", function (e) {
    upload_image();
  });
  //end upload trigger

  //upload trigger multiple
  $(document.body).on(
    "click",
    "button[name=btn_upload_multiple]",
    function (e) {
      upload_image_multiple();
    }
  );
  //end upload trigger multiple

  //validate file
  $(document.body).on(
    "change",
    "input[name=header\\[company_file\\]\\[\\]]",
    function () {
      var fileInput = $(this);
      var totalSize = 0;
      fileInput.each(function () {
        for (var i = 0; i < this.files.length; i++) {
          totalSize += this.files[i].size / 1024 / 1024;
        } //end for
      });

      if (totalSize > 40) {
        var msg_html = "Max file size of 40MB exceeded!";
        $.notify(msg_html, {
          position: "top center",
          className: "error",
          arrowShow: true,
        });
      } //end if
    }
  );
  //validate file

  //remove trigger
  $(document.body).on("click", "button[name=btn_remove]", function (e) {
    $("img[id=header\\[company_logo\\]]").attr("src", urlimgdef);
    $("input[name=file\\[doc_content\\]]").val("");
    $("input[name=header\\[doc_image\\]]").val("");
    //$('input[name=header\\[doc_image\\]]').val('');
  });
  //end remove trigger

  //remove trigger
  $(document.body).on("click", ".remove", function (e) {
    var line = $(this).attr("aria-line");

    $(this).parent().remove();
    $(".remove-" + line).remove();
  });
  //end remove trigger

  $(document.body).on(
    "change",
    "input[name=header\\[userfile\\]\\[\\]]",
    function (e) {
      // alert($(this).val());
      // alert('sfsad');
      $("button[name=btn_upload]").trigger("click");
      //var file_path = URL.createObjectURL(event.target.files[0]);
      //alert(file_path)
      //$('img[id=header\\[company_logo\\]]').attr('src',file_path);
    }
  );

  $(document.body).on("click", ".custom-file-upload2", function (e) {
    $("button[name=btn_remove]").trigger("click");
  });
  //end remove trigger

  $(document.body).on(
    "change",
    "input[name=header\\[company_file\\]\\[\\]]",
    function (e) {
      // alert($(this).val());
      // alert('sfsad');
      $("button[name=btn_upload_multiple]").trigger("click");
      //var file_path = URL.createObjectURL(event.target.files[0]);
      //alert(file_path)
      //$('img[id=header\\[company_logo\\]]').attr('src',file_path);
    }
  );

  //remove trigger
  $(document.body).on("click", ".btn_remove_multiple", function (e) {
    //$('img[id=header\\[company_logo\\]]').attr('src',(urlimgdef));
    $("#image_cont").empty();
    $("input[name=file\\[resume_content\\]]").val("");
    $("input[name=header\\[resume\\]]").val("");
  });
  //end remove trigger

  var exp_lineVal =
    catchIsNaN($("input[name=row_experience\\[line\\]\\[\\]]:last").val()) + 1;

  //add experience
  $(document.body).on("click", "button[name=btn_add_experience]", function (e) {
    var param = {};
    var line =
      catchIsNaN($("input[name=row_experience\\[line\\]\\[\\]]:last").val()) +
      1;

    var table_html = load_experience_form(param);
    $("#experience_content").append(table_html);

    $("input[name=row_experience\\[line\\]\\[\\]]:last").val(line);

    exp_lineVal = line;

    //Initialize date time picker
    $("input[name=row_experience\\[start_date\\]\\[\\]]").datetimepicker({
      format: "M/YYYY",
    });

    $("input[name=row_experience\\[end_date\\]\\[\\]]").datetimepicker({
      format: "M/YYYY",
    });

    $("input[name=row_experience\\[designation\\]\\[\\]]:last").focus();
  });
  //end add experience

  //add skills
  $(document.body).on("click", "button[name=btn_add_skills]", function (e) {
    var param = {};
    var line =
      catchIsNaN($("input[name=row_skills\\[line\\]\\[\\]]:last").val()) + 1;
    var table_html = load_skills_form(param);
    $("#skills_content").append(table_html);
    $("input[name=row_skills\\[line\\]\\[\\]]:last").val(line);
    $("input[name=row_skills\\[skills\\]\\[\\]]:last").focus();
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
    load_dropdowns(dropdown);

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

  //add certification and licenses
  $(document.body).on(
    "click",
    "button[name=btn_add_certification]",
    function (e) {
      var param = {};
      var line =
        catchIsNaN(
          $("input[name=row_certification\\[line\\]\\[\\]]:last").val()
        ) + 1;
      var table_html = load_certification_form(param);
      $("#certification_content").append(table_html);
      $("input[name=row_certification\\[line\\]\\[\\]]:last").val(line);
      $("input[name=row_certification\\[certification\\]\\[\\]]:last").focus();

      //Initialize date time picker
      $("input[name=row_certification\\[issued_date\\]\\[\\]]").datetimepicker({
        format: "M/YYYY",
      });

      $(
        "input[name=row_certification\\[expiration_date\\]\\[\\]]"
      ).datetimepicker({
        format: "M/YYYY",
      });
    }
  );
  //end add certification and licenses

  //add projects
  $(document.body).on("click", "button[name=btn_add_projects]", function (e) {
    var param = {};
    var line =
      catchIsNaN($("input[name=row_projects\\[line\\]\\[\\]]:last").val()) + 1;
    var table_html = load_projects_form(param);
    $("#projects_content").append(table_html);

    $("input[name=row_projects\\[line\\]\\[\\]]:last").val(line);
    $("input[name=row_projects\\[projects\\]\\[\\]]:last").focus();
  });
  //end add projects

  //add seminar and training
  $(document.body).on(
    "click",
    "button[name=btn_add_seminar_training]",
    function (e) {
      var param = {};
      var line =
        catchIsNaN(
          $("input[name=row_seminar_training\\[line\\]\\[\\]]:last").val()
        ) + 1;
      var table_html = load_seminar_training_form(param);
      $("#seminar_training_content").append(table_html);

      $("input[name=row_seminar_training\\[line\\]\\[\\]]:last").val(line);
      $(
        "input[name=row_seminar_training\\[seminar_training\\]\\[\\]]:last"
      ).focus();
    }
  );
  //end add seminar and training

  //add awards and achievement
  $(document.body).on(
    "click",
    "button[name=btn_add_awards_achievements]",
    function (e) {
      var param = {};
      var line =
        catchIsNaN(
          $("input[name=row_award_achievement\\[line\\]\\[\\]]:last").val()
        ) + 1;
      var table_html = load_awards_achievements_form(param);
      $("#awards_achievements_content").append(table_html);

      $("input[name=row_award_achievement\\[line\\]\\[\\]]:last").val(line);
      $(
        "input[name=row_award_achievement\\[award_achievement\\]\\[\\]]:last"
      ).focus();
    }
  );
  //end add awards and achievement

  //add affiliations
  $(document.body).on(
    "click",
    "button[name=btn_add_affiliations]",
    function (e) {
      var param = {};
      var line =
        catchIsNaN(
          $("input[name=row_affiliation\\[line\\]\\[\\]]:last").val()
        ) + 1;
      var table_html = load_affiliations_form(param);
      $("#affiliations_content").append(table_html);

      $("input[name=row_affiliation\\[line\\]\\[\\]]:last").val(line);
      $("input[name=row_affiliation\\[affiliation\\]\\[\\]]:last").focus();
    }
  );
  //end add affiliations

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
    load_dropdowns(dropdown);

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
    load_dropdowns(dropdown);

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
    load_dropdowns(dropdown);

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
    load_dropdowns(dropdown);

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

    /*var input   = $(this).parent().parent();
            input   = input.parent().parent();
            input   = input.parent().find('input[name*=if_current]');
            input.val(0);
            */

    /*var checkboxes = $(this).parent().parent();
            checkboxes  = checkboxes.parent().parent();
            checkboxes  = checkboxes.parent().find('input[id*=if_current]:checked');
            checkboxes.prop('checked',false);
            */

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

    //$(this).prop('checked',is_checked);
  });

  $(document.body).on("change", "input[name*=no_expiration]", function (e) {
    var is_checked = $(this).is(":checked");
    if (is_checked) {
      is_checked = 1;
    } else {
      is_checked = 0;
    } //end if

    var current_input = $(this).parent().parent();
    current_input = current_input.parent().find("input[name*=no_expiration]");
    $(this).prop("checked", is_checked);
    current_input.val(is_checked);

    var container = $(this).parent().parent();
    container
      .find("input[name=row_certification\\[expiration_date\\]\\[\\]]")
      .parent()
      .parent()
      .removeClass("d-none");
    container
      .find("input[name=row_certification\\[expiration_date\\]\\[\\]]")
      .parent()
      .parent()
      .prev("label")
      .removeClass("d-none");

    if (is_checked) {
      var div = container
        .parent()
        .find("input[name=row_certification\\[expiration_date\\]\\[\\]]");
      var div2 = div.parent().parent();
      div2.addClass("d-none");

      div2.prev("label").addClass("d-none");
      div.val("");
    } else {
      var div = container
        .parent()
        .find("input[name=row_certification\\[expiration_date\\]\\[\\]]");
      var div2 = div.parent().parent();
      div2.removeClass("d-none");
      div2.prev("label").removeClass("d-none");
    } //end if
  });
  //=====================================================================================================================
  //end events

  //sourcing
  //=======================================================================================================================
  //load data
  function load_data(param) {
    var url = homeurl + "/load_data/" + param.id;
    var btn = $(".btn_submit");
    var btn_text = "Save";
    $.ajax({
      url: url,
      type: "POST",
      dataType: "JSON",
      beforeSend: function () {
        $(".outside_button *").css("pointer-events", "none");
        //$('#'+loader+'').html('<div class="col-12 text-center"><div class="spinner-grow text-muted"></div></div>');
        btn.html('<div class="spinner-grow"></div>');
      },
    })
      .done(function (response) {
        if (response.data !== null && response.data !== undefined) {
          if (dropdown_loaded == 0) {
            load_filter_dropdowns();
          } //end if

          var data = response.data[0];

          if (param.mode == "edit" || param.mode == "view") {
            if (param.mode == "edit") {
              load_dropdowns($("select[name=header\\[dial_code\\]]"));
            }

            //view and edit mode
            //----------------------------------------------------------------------------------------------------
            //side profile
            //$('h6[id=header\\[company_name\\]]').html(data.name);
            $("small[id=header\\[userid\\]]").html("ID: " + data.id);

            $("#frm_data_entry input[name=header\\[doc_image\\]]").val(
              data.doc_image
            );
            $("#frm_data_entry input[name=file\\[old_doc_image\\]]").val(
              data.doc_image
            );
            $("p[id=header\\[date_created\\]]").html(
              '<small class="text-muted">Joined ' +
                data.joined_date +
                "</small>"
            );

            var img_src = "";
            if (data.doc_image === null || data.doc_image == "") {
              img_src = urlimgdef;
            } else {
              img_src = upload_path + data.doc_image;
            } //end if

            if (!image.imageExists(img_src)) {
              img_src = urlimgnotfound;
            } //end if

            $("img[id=header\\[company_logo\\]]").attr("src", img_src);

            //resume file
            $("#frm_data_entry input[name=header\\[resume\\]]").val(
              data.resume
            );
            $("#frm_data_entry input[name=file\\[old_resume\\]]").val(
              data.resume
            );

            var html = "";
            /*html += '<div class="col mb-3">';
                            html += '<h1 class="text-center"><i class="fa fa-file-word"></i></h1>';
                            html += '<p class="text-center"><a href="'+upload_path+data.resume+'">'+data.resume+'</a></p>';
                        html += '</div><!--./col-->';*/

            if ($(window).width() <= 1024) {
              html +=
                '<div class="form-group row" style="margin-left: auto; margin-right: auto;">';
              html +=
                '<div class="col-8 col-sm-8 col-md-8 col-lg-7 col-xl-7 align-self-center">';
              html += data.resume;
              html += "</div><!--./col-10-->";
              html += '<div class="col-4 col-sm-4 col-md-4 col-lg-3 col-xl-3">';
              html +=
                '<a href="' +
                upload_path +
                data.resume +
                '" class="btn btn-md btn-primary" target="_blank">Preview</a>';
              html += "</div><!--./col-10-->";
              html += "</div><!--./form-group-->";
            } else {
              html +=
                '<div class="form-group row" style="margin-left: auto; margin-right: auto;">';
              html += '<div class="col-1">';
              html += "</div><!--./col-1-->";
              html += '<div class="col-8 align-self-center">';
              html += data.resume;
              html += "</div><!--./col-10-->";
              html += '<div class="col-3">';
              html +=
                '<a href="' +
                upload_path +
                data.resume +
                '" class="btn btn-md btn-primary" target="_blank">Preview</a>';
              html += "</div><!--./col-10-->";
              html += "</div><!--./form-group-->";
            }

            if (data.resume !== "") {
              $("#image_cont").html(html);
            } //end if

            //primary info
            $("#frm_data_entry input[name=header\\[first_name\\]]").val(
              data.first_name
            );
            $("#frm_data_entry input[name=header\\[middle_name\\]]").val(
              data.middle_name
            );
            $("#frm_data_entry input[name=header\\[last_name\\]]").val(
              data.last_name
            );
            $("#frm_data_entry input[name=header\\[email_add\\]]").val(
              data.email_add
            );
            //$('#frm_data_entry select[name=header\\[dial_code\\]]').val(data.dial_code);
            if (data.dial_code !== "") {
              $(
                "#frm_data_entry select[name=header\\[dial_code\\]]"
              ).multiselect("select", data.dial_code);
            } else {
              var d_code = map_dial_code(data.location);
              if (d_code !== undefined) {
                $(
                  "#frm_data_entry select[name=header\\[dial_code\\]]"
                ).multiselect("select", d_code.dial_code);
              } //end if
            }

            $("#frm_data_entry input[name=placeholder\\[dial_code\\]]").val(
              data.dial_code
            );
            $("#frm_data_entry input[name=header\\[contact_number\\]]").val(
              data.contact_number
            );
            $("#frm_data_entry textarea[name=header\\[highlights\\]]").val(
              data.highlights
            );
            /* var str = data.highlights;
                        var rows = str.split(/\r\n|\r|\n/).length;
                        rows += 8;
                        $('#frm_data_entry textarea[name=header\\[highlights\\]]').attr('rows',rows); */
            autosize(
              $("#frm_data_entry textarea[name=header\\[highlights\\]]")
            );

            data.internship = parseInt(data.internship);
            $("#frm_data_entry input[name=header\\[internship\\]]").prop(
              "checked",
              data.internship
            );

            if (param.mode == "view") {
              if (data.internship == 0) {
                $(".aivw-internship").remove();
              }
            }
            //end primary info

            //location
            $("#frm_data_entry input[id=search_location]").val(data.location);
            $("p[id=header\\[location\\]]").html(
              '<small class="text-muted">' + data.location + "</small>"
            );
            $("#frm_data_entry select[name=header\\[location\\]]").multiselect(
              "select",
              data.location
            );
            $("#frm_data_entry input[name=placeholder\\[location\\]]").val(
              data.location
            );

            $("#frm_data_entry input[name=header\\[country\\]]").val(
              data.country
            );

            //populate lines
            //experience
            html = "";
            data_lines = response.line_experience;
            for (var key in data_lines) {
              if (data_lines[key]["end_date"] == null) {
                data_lines[key]["end_date"] = "";
              } //end if

              if (data_lines[key]["end_date_placeholder"] == null) {
                data_lines[key]["end_date_placeholder"] = "";
              } //end if

              html += '<div class="card mb-2">';
              html += '<div class="card-body">';
              html +=
                '<button type="button" class="close close-btn" aria-label="Close">';
              html +=
                '<span aria-hidden="true" class="close-span">&times;</span>';
              html += "</button>";
              html += "</div>";
              html += '<div class="card-body">';

              html += '<div class="form-group row d-none">';
              html +=
                '<label class="col-3 col-form-label text-right align-self-center">Line <span class="text-danger fw-bolder">*</span></label>';
              html += '<div class="col-8 align-self-center">';
              html +=
                '<input value="' +
                data_lines[key]["line"] +
                '" readonly class="form-control form-control-sm" type="text" name="row_experience[line][]" maxlength="100"/>';
              html += "</div><!--./col-10-->";
              html += "</div><!--./form-group-->";

              html += '<div class="form-group row">';
              html +=
                '<label class="col-4 col-sm-4 col-md-4 col-lg-3 col-xl-3 col-form-label text-right align-self-center">Job Title <span class="text-danger fw-bolder aivw-asterisk">*</span></label>';
              html +=
                '<div class="col-8 col-sm-8 col-md-6 col-lg-8 col-xl-8 align-self-center">';
              html +=
                '<input value="' +
                data_lines[key]["designation"] +
                '" class="form-control form-control-sm" type="text" name="row_experience[designation][]" maxlength="100"/>';
              html += "</div><!--./col-10-->";
              html += "</div><!--./form-group-->";

              html += '<div class="form-group row">';
              if ($(window).width() <= 1024) {
                html +=
                  '<label class="col-4 col-sm-4 col-md-4 col-lg-3 col-xl-3 col-form-label text-right align-self-center">Company <br/> Name <span class="text-danger fw-bolder aivw-asterisk">*</span></label>';
              } else {
                html +=
                  '<label class="col-4 col-sm-4 col-md-4 col-lg-3 col-xl-3 col-form-label text-right align-self-center">Company Name <span class="text-danger fw-bolder aivw-asterisk">*</span></label>';
              }
              html +=
                '<div class="col-8 col-sm-8 col-md-6 col-lg-8 col-xl-8 align-self-center">';
              html +=
                '<input value="' +
                data_lines[key]["company_name"] +
                '" class="form-control form-control-sm" type="text" name="row_experience[company_name][]" maxlength="100"/>';
              html += "</div><!--./col-10-->";
              html += "</div><!--./form-group-->";

              html += '<div class="form-group row">';
              html +=
                '<label class="col-4 col-sm-4 col-md-4 col-lg-3 col-xl-3 col-form-label text-right">Short description</label>';
              html += '<div class="col-8 col-sm-8 col-md-6 col-lg-8 col-xl-8">';
              html +=
                '<textarea rows="10" class="form-control form-control-sm aivw-textarea" name="row_experience[short_description][]" maxlength="600">' +
                data_lines[key]["short_description"] +
                "</textarea>";
              html += "</div><!--./col-10-->";
              html += "</div><!--./form-group-->";

              if ($(window).width() <= 1024) {
                if (param.mode == "view") {
                  if (data_lines[key]["if_current"] == 0) {
                    html += '<div class="form-group row">';
                    html +=
                      '<label class="col-4 col-sm-4 col-md-4 col-lg-3 col-xl-3 col-form-label text-right align-self-center">Start Date</label>';
                    html +=
                      '<div class="col-8 col-sm-8 col-md-6 col-lg-8 col-xl-8 align-self-center">';
                    html += '<div class="input-group input-group-sm">';
                    html +=
                      '<input value="' +
                      data_lines[key]["start_date_placeholder"] +
                      '" class="form-control-sm d-none" type="text" name="placeholder[start_date][]"/>';
                    html +=
                      '<input placeholder="MM/YYYY" value="' +
                      data_lines[key]["start_date"] +
                      '" class="form-control form-control-sm" type="text" name="row_experience[start_date][]"/>';
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
                      '<input value="' +
                      data_lines[key]["end_date_placeholder"] +
                      '" class="form-control-sm d-none" type="text" name="placeholder[end_date][]"/>';
                    html +=
                      '<input placeholder="MM/YYYY" value="' +
                      data_lines[key]["end_date"] +
                      '" class="form-control form-control-sm" type="text" name="row_experience[end_date][]"/>';
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
                      '<label class="col-4 col-sm-4 col-md-4 col-lg-3 col-xl-3 col-form-label text-right align-self-center">Start Date</label>';
                    html +=
                      '<div class="col-8 col-sm-8 col-md-6 col-lg-8 col-xl-8 align-self-center">';
                    html += '<div class="input-group input-group-sm">';
                    html +=
                      '<input value="' +
                      data_lines[key]["start_date_placeholder"] +
                      '&emsp;-&emsp;Present" class="form-control-sm d-none" type="text" name="placeholder[start_date][]"/>';
                    html +=
                      '<input placeholder="MM/YYYY" value="' +
                      data_lines[key]["start_date"] +
                      '" class="form-control form-control-sm" type="text" name="row_experience[start_date][]"/>';
                    html += '<div class="input-group-append">';
                    html +=
                      '<span class="input-group-text"><i class="fa fa-calendar"></i></span>';
                    html += "</div><!--./input-group-append-->";
                    html += "</div><!--./input-group input-group-sm-->";
                    html += "</div><!--./col-->";
                    html += "</div><!--./form-group-->";
                  }
                } else {
                  html += '<div class="form-group row">';
                  html +=
                    '<label class="col-4 col-sm-4 col-md-4 col-lg-3 col-xl-3 col-form-label text-right align-self-center">Start Date</label>';
                  html +=
                    '<div class="col-8 col-sm-8 col-md-6 col-lg-8 col-xl-8 align-self-center">';
                  html += '<div class="input-group input-group-sm">';
                  html +=
                    '<input value="' +
                    data_lines[key]["start_date_placeholder"] +
                    '" class="form-control-sm d-none" type="text" name="placeholder[start_date][]"/>';
                  html +=
                    '<input placeholder="MM/YYYY" value="' +
                    data_lines[key]["start_date"] +
                    '" class="form-control form-control-sm" type="text" name="row_experience[start_date][]"/>';
                  html += '<div class="input-group-append">';
                  html +=
                    '<span class="input-group-text"><i class="fa fa-calendar"></i></span>';
                  html += "</div><!--./input-group-append-->";
                  html += "</div><!--./input-group input-group-sm-->";
                  html += "</div><!--./col-->";
                  html += "</div><!--./form-group-->";

                  html += '<div class="form-group row">';
                  html +=
                    '<label class="col-4 col-sm-4 col-md-4 col-lg-3 col-xl-3 col-form-label text-right align-self-center" id="mob_edlabel' +
                    key +
                    '">End Date</label>';
                  html +=
                    '<div class="col-8 col-sm-8 col-md-6 col-lg-8 col-xl-8 align-self-center" id="mob_edcol' +
                    key +
                    '">';
                  html += '<div class="input-group input-group-sm date">';
                  html +=
                    '<input value="' +
                    data_lines[key]["end_date_placeholder"] +
                    '" class="form-control-sm d-none" type="text" name="placeholder[end_date][]"/>';
                  html +=
                    '<input placeholder="MM/YYYY" value="' +
                    data_lines[key]["end_date"] +
                    '" class="form-control form-control-sm" type="text" name="row_experience[end_date][]"/>';
                  html += '<div class="input-group-append">';
                  html +=
                    '<span class="input-group-text"><i class="fa fa-calendar"></i></span>';
                  html += "</div><!--./input-group-append-->";
                  html += "</div><!--./input-group input-group-sm-->";
                  html += "</div><!--./col-10-->";
                  html += "</div><!--./form-group-->";
                }
              } else {
                if (param.mode == "view") {
                  if (data_lines[key]["if_current"] == 0) {
                    html += '<div class="form-group row">';
                    html +=
                      '<label class="col-3 col-md-4 col-xl-3 col-lg-3 col-form-label text-right align-self-center">Start Date</label>';
                    html += '<div class="col-3 align-self-center">';
                    html += '<div class="input-group input-group-sm">';
                    html +=
                      '<input value="' +
                      data_lines[key]["start_date_placeholder"] +
                      '" class="form-control-sm d-none" type="text" name="placeholder[start_date][]"/>';
                    html +=
                      '<input placeholder="MM/YYYY" value="' +
                      data_lines[key]["start_date"] +
                      '" class="form-control form-control-sm" type="text" name="row_experience[start_date][]"/>';
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
                      '<input value="' +
                      data_lines[key]["end_date_placeholder"] +
                      '" class="form-control-sm d-none" type="text" name="placeholder[end_date][]"/>';
                    html +=
                      '<input placeholder="MM/YYYY" value="' +
                      data_lines[key]["end_date"] +
                      '" class="form-control form-control-sm" type="text" name="row_experience[end_date][]"/>';
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
                    html +=
                      '<div class="col-2 align-self-center" style="width: 12.66666667%;">';
                    html += '<div class="input-group input-group-sm">';
                    html +=
                      '<input value="' +
                      data_lines[key]["start_date_placeholder"] +
                      '" class="form-control-sm d-none" type="text" name="placeholder[start_date][]"/>';
                    html +=
                      '<input placeholder="MM/YYYY" value="' +
                      data_lines[key]["start_date"] +
                      '" class="form-control form-control-sm" type="text" name="row_experience[start_date][]"/>';
                    html += '<div class="input-group-append">';
                    html +=
                      '<span class="input-group-text"><i class="fa fa-calendar"></i></span>';
                    html += "</div><!--./input-group-append-->";
                    html += "</div><!--./input-group input-group-sm-->";
                    html += "</div><!--./col-->";

                    html +=
                      '<div class="col-1 align-self-center" style="width: 5.33333333%">-';
                    html += "</div><!--./col-->";
                    html +=
                      '<label class="col-2 col-form-label align-self-center">Present</label>';
                    html += "</div><!--./form-group-->";
                  }
                } else {
                  html += '<div class="form-group row">';
                  html +=
                    '<label class="col-3 col-form-label text-right align-self-center">Start Date</label>';
                  html += '<div class="col-3 align-self-center">';
                  html += '<div class="input-group input-group-sm">';
                  html +=
                    '<input value="' +
                    data_lines[key]["start_date_placeholder"] +
                    '" class="form-control-sm d-none" type="text" name="placeholder[start_date][]"/>';
                  html +=
                    '<input placeholder="MM/YYYY" value="' +
                    data_lines[key]["start_date"] +
                    '" class="form-control form-control-sm" type="text" name="row_experience[start_date][]"/>';
                  html += '<div class="input-group-append">';
                  html +=
                    '<span class="input-group-text"><i class="fa fa-calendar"></i></span>';
                  html += "</div><!--./input-group-append-->";
                  html += "</div><!--./input-group input-group-sm-->";
                  html += "</div><!--./col-->";

                  html +=
                    '<label class="col-2 col-form-label text-right align-self-center" id="edlabel' +
                    key +
                    '">End Date</label>';
                  html +=
                    '<div class="col-3 align-self-center" id="edcol' +
                    key +
                    '">';
                  html += '<div class="input-group input-group-sm date">';
                  html +=
                    '<input value="' +
                    data_lines[key]["end_date_placeholder"] +
                    '" class="form-control-sm d-none" type="text" name="placeholder[end_date][]"/>';
                  html +=
                    '<input placeholder="MM/YYYY" value="' +
                    data_lines[key]["end_date"] +
                    '" class="form-control form-control-sm" type="text" name="row_experience[end_date][]"/>';
                  html += '<div class="input-group-append">';
                  html +=
                    '<span class="input-group-text"><i class="fa fa-calendar"></i></span>';
                  html += "</div><!--./input-group-append-->";
                  html += "</div><!--./input-group input-group-sm-->";
                  html += "</div><!--./col-10-->";
                  html += "</div><!--./form-group-->";
                }
              }

              if (param.mode == "view") {
                // if(data_lines[key]['if_current'] == 1){
                //     html += '<div class="form-group row">';
                //     html += '<label class="col-4 col-sm-4 col-md-4 col-lg-3 col-xl-3 col-form-label text-right align-self-center">If Current</label>';
                //     html += '<div class="col-1 align-self-center">';
                //         html += '<input '+(data_lines[key]['if_current'] == 1? 'checked' : '')+' value="false" type="checkbox" class="w-auto aivw-ifcurrexp" id="row_experience[if_current][]"/>';
                //     html += '</div><!--./col-10-->';
                //     html += '</div><!--./form-group-->';
                // }
              } else {
                html += '<div class="form-group row">';
                html +=
                  '<label class="col-4 col-sm-4 col-md-4 col-lg-3 col-xl-3 col-form-label text-right align-self-center">If Current</label>';
                html += '<div class="col-1 align-self-center">';
                //html += '<input '+(data_lines[key]['if_current'] == 1? 'checked' : '')+' value="false" type="checkbox" class="w-auto aivw-ifcurrexp" id="row_experience[if_current]['+key+']"/>'; gian code
                html +=
                  "<input " +
                  (data_lines[key]["if_current"] == 1 ? "checked" : "") +
                  ' value="false" type="checkbox" class="w-auto aivw-ifcurrexp" id="row_experience[if_current][]"/>';
                html += "</div><!--./col-10-->";
                html += "</div><!--./form-group-->";
              }

              html += '<div class="form-group row d-none">';
              html +=
                '<label class="col-4 col-sm-4 col-md-4 col-lg-3 col-xl-3 col-form-label text-right align-self-center">If Current</label>';
              html += '<div class="col-1 align-self-center">';
              html +=
                '<input value="' +
                data_lines[key]["if_current"] +
                '" type="text" name="row_experience[if_current][]" id="row_experience_current' +
                key +
                '"/>';
              html += "</div><!--./col-10-->";
              html += "</div><!--./form-group-->";

              html += "</div>";
              html += "</div>";
            } //end for
            $("#experience_content").html(html);
            //experience

            if ($(window).width() >= 1025) {
              if (param.mode == "edit") {
                if ($("#row_experience_current0").val() == 1) {
                  $("#edlabel0").addClass("d-none");
                  $("#edcol0").addClass("d-none");
                } else {
                  $("#edlabel0").removeClass("d-none");
                  $("#edcol0").removeClass("d-none");
                }

                if ($("#row_experience_current1").val() == 1) {
                  $("#edlabel1").addClass("d-none");
                  $("#edcol1").addClass("d-none");
                } else {
                  $("#edlabel1").removeClass("d-none");
                  $("#edcol1").removeClass("d-none");
                }
              }

              $('input:checkbox[id="row_experience[if_current][0]"]').change(
                function () {
                  if ($("#row_experience_current0").val() == 0) {
                    if (
                      $("#row_experience_current0").val() == 0 &&
                      $("#row_experience_current1").val() == 1
                    ) {
                      $("#edlabel0").addClass("d-none");
                      $("#edcol0").addClass("d-none");
                      $("#edlabel1").removeClass("d-none");
                      $("#edcol1").removeClass("d-none");
                    } else {
                      $("#edlabel0").addClass("d-none");
                      $("#edcol0").addClass("d-none");
                    }
                  } else {
                    $("#edlabel0").removeClass("d-none");
                    $("#edcol0").removeClass("d-none");
                  }
                }
              );

              $('input:checkbox[id="row_experience[if_current][1]"]').change(
                function () {
                  if ($("#row_experience_current1").val() == 0) {
                    if (
                      $("#row_experience_current1").val() == 0 &&
                      $("#row_experience_current0").val() == 1
                    ) {
                      $("#edlabel1").addClass("d-none");
                      $("#edcol1").addClass("d-none");
                      $("#edlabel0").removeClass("d-none");
                      $("#edcol0").removeClass("d-none");
                    } else {
                      $("#edlabel1").addClass("d-none");
                      $("#edcol1").addClass("d-none");
                    }
                  } else {
                    $("#edlabel1").removeClass("d-none");
                    $("#edcol1").removeClass("d-none");
                  }
                }
              );
            } else {
              if (param.mode == "edit") {
                if ($("#row_experience_current0").val() == 1) {
                  $("#mob_edlabel0").addClass("d-none");
                  $("#mob_edcol0").addClass("d-none");
                } else {
                  $("#mob_edlabel0").removeClass("d-none");
                  $("#mob_edcol0").removeClass("d-none");
                }

                if ($("#row_experience_current1").val() == 1) {
                  $("#mob_edlabel1").addClass("d-none");
                  $("#mob_edcol1").addClass("d-none");
                } else {
                  $("#mob_edlabel1").removeClass("d-none");
                  $("#mob_edcol1").removeClass("d-none");
                }
              }

              $('input:checkbox[id="row_experience[if_current][0]"]').change(
                function () {
                  if ($("#row_experience_current0").val() == 0) {
                    if (
                      $("#row_experience_current0").val() == 0 &&
                      $("#row_experience_current1").val() == 1
                    ) {
                      $("#mob_edlabel0").addClass("d-none");
                      $("#mob_edcol0").addClass("d-none");
                      $("#mob_edlabel1").removeClass("d-none");
                      $("#mob_edcol1").removeClass("d-none");
                    } else {
                      $("#mob_edlabel0").addClass("d-none");
                      $("#mob_edcol0").addClass("d-none");
                    }
                  } else {
                    $("#mob_edlabel0").removeClass("d-none");
                    $("#mob_edcol0").removeClass("d-none");
                  }
                }
              );

              $('input:checkbox[id="row_experience[if_current][1]"]').change(
                function () {
                  if ($("#row_experience_current1").val() == 0) {
                    if (
                      $("#row_experience_current1").val() == 0 &&
                      $("#row_experience_current0").val() == 1
                    ) {
                      $("#mob_edlabel1").addClass("d-none");
                      $("#mob_edcol1").addClass("d-none");
                      $("#mob_edlabel0").removeClass("d-none");
                      $("#mob_edcol0").removeClass("d-none");
                    } else {
                      $("#mob_edlabel1").addClass("d-none");
                      $("#mob_edcol1").addClass("d-none");
                    }
                  } else {
                    $("#mob_edlabel1").removeClass("d-none");
                    $("#mob_edcol1").removeClass("d-none");
                  }
                }
              );
            }

            //skills
            html = "";
            data_lines = response.line_skills;
            for (var key in data_lines) {
              html += '<div class="card mb-3">';
              html += '<div class="card-body aivw-skillsbtn">';
              html +=
                '<button type="button" class="close close-btn" aria-label="Close">';
              html +=
                '<span aria-hidden="true" class="close-span">&times;</span>';
              html += "</button>";
              html += "</div>";
              html += '<div class="card-body aivw-skillscardbody">';

              html += '<div class="form-group row d-none">';
              html +=
                '<label class="col-1 col-form-label text-right align-self-center">Line <span class="text-danger fw-bolder">*</span></label>';
              html += '<div class="col-8 align-self-center">';
              html +=
                '<input value="' +
                data_lines[key]["line"] +
                '" readonly class="form-control form-control-sm" type="text" name="row_skills[line][]" maxlength="100"/>';
              html += "</div><!--./col-10-->";
              html += "</div><!--./form-group-->";

              html += '<div class="form-group row aivw-skillsrow">';
              html +=
                '<label class="col-1 col-form-label text-right align-self-center"><span class="text-danger fw-bolder aivw-asterisk">*</span></label>';
              html += '<div class="col-8 align-self-center">';
              html +=
                '<input value="' +
                data_lines[key]["skills"] +
                '" class="form-control form-control-sm" type="text" name="row_skills[skills][]" maxlength="200"/>';
              html += "</div><!--./col-10-->";
              html += "</div><!--./form-group-->";
              html += "</div>";
              html += "</div>";
            } //end for
            $("#skills_content").html(html);
            //end skills

            //education
            html = "";
            data_lines = response.line_education;
            for (var key in data_lines) {
              html += '<div class="card mb-2">';
              html += '<div class="card-body">';
              html +=
                '<button type="button" class="close close-btn" aria-label="Close">';
              html +=
                '<span aria-hidden="true" class="close-span">&times;</span>';
              html += "</button>";
              html += "</div>";
              html += '<div class="card-body">';

              html += '<div class="form-group row d-none">';
              html +=
                '<label class="col-4 col-sm-4 col-md-4 col-lg-3 col-xl-3 col-form-label text-right align-self-center">Line <span class="text-danger fw-bolder">*</span></label>';
              html +=
                '<div class="col-8 col-sm-8 col-md-6 col-lg-8 col-xl-8 align-self-center">';
              html +=
                '<input value="' +
                data_lines[key]["line"] +
                '" readonly class="form-control form-control-sm" type="text" name="row_education[line][]" maxlength="100"/>';
              html += "</div><!--./col-10-->";
              html += "</div><!--./form-group-->";

              if ($(window).width() <= 1024) {
                html += '<div class="form-group row">';
                html +=
                  '<label class="col-4 col-sm-4 col-md-4 col-lg-3 col-xl-3 col-form-label text-right align-self-center">University /<br/>School <span class="text-danger fw-bolder aivw-asterisk">*</span></label>';
                html +=
                  '<div class="col-8 col-sm-8 col-md-6 col-lg-8 col-xl-8 align-self-center">';
                html +=
                  '<input value="' +
                  data_lines[key]["school"] +
                  '" class="form-control form-control-sm" type="text" name="row_education[school][]" maxlength="200"/>';
                html += "</div><!--./col-10-->";
                html += "</div><!--./form-group-->";
              } else {
                html += '<div class="form-group row">';
                html +=
                  '<label class="col-4 col-sm-4 col-md-4 col-lg-3 col-xl-3 col-form-label text-right align-self-center">University/School <span class="text-danger fw-bolder aivw-asterisk">*</span></label>';
                html +=
                  '<div class="col-8 col-sm-8 col-md-6 col-lg-8 col-xl-8 align-self-center">';
                html +=
                  '<input value="' +
                  data_lines[key]["school"] +
                  '" class="form-control form-control-sm" type="text" name="row_education[school][]" maxlength="200"/>';
                html += "</div><!--./col-10-->";
                html += "</div><!--./form-group-->";
              }

              if ($(window).width() <= 1024) {
                html += '<div class="form-group row">';
                html +=
                  '<label class="col-4 col-sm-4 col-md-4 col-lg-3 col-xl-3 col-form-label text-right align-self-center">Degree/Field of Study <span class="text-danger fw-bolder aivw-asterisk">*</span></label>';
                html +=
                  '<div class="col-8 col-sm-8 col-md-6 col-lg-8 col-xl-8 align-self-center">';
                html +=
                  '<input value="' +
                  data_lines[key]["degree"] +
                  '" class="form-control form-control-sm" type="text" name="row_education[degree][]" maxlength="200"/>';
                html += "</div><!--./col-10-->";
                html += "</div><!--./form-group-->";
              } else {
                html += '<div class="form-group row">';
                html +=
                  '<label class="col-4 col-sm-4 col-md-4 col-lg-3 col-xl-3 col-form-label text-right align-self-center">Degree/Field of Study <span class="text-danger fw-bolder aivw-asterisk">*</span></label>';
                html +=
                  '<div class="col-8 col-sm-8 col-md-6 col-lg-8 col-xl-8 align-self-center">';
                html +=
                  '<input value="' +
                  data_lines[key]["degree"] +
                  '" class="form-control form-control-sm" type="text" name="row_education[degree][]" maxlength="200"/>';
                html += "</div><!--./col-10-->";
                html += "</div><!--./form-group-->";
              }

              /*html += '<div class="form-group row">';
                                    html += '<label class="col-4 col-form-label text-link">Education <span class="text-danger fw-bolder">*</span></label>';
                                    html += '<div class="col-2 d-none">';
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
                                */

              html += '<div class="form-group row">';
              html +=
                '<label class="col-4 col-sm-4 col-md-4 col-lg-3 col-xl-3 col-form-label text-right align-self-center">Education <span class="text-danger fw-bolder aivw-asterisk">*</span></label>';
              html +=
                '<div class="col-8 col-sm-8 col-md-6 col-lg-8 col-xl-8 align-self-center">';
              html += '<div class="input-group input-group-sm aivw-withsel">';
              html +=
                '<input value="' +
                data_lines[key]["education_text"] +
                '" class="form-control form-control-sm d-none" type="text" name="placeholder[education][]"/>';
              html += '<select name="row_education[education][]"></select>';
              html += "</div>";
              html += "</div><!--./col-10-->";
              html += "</div><!--./form-group-->";

              if ($(window).width() <= 1024) {
                if (param.mode == "view") {
                  if (data_lines[key]["if_current"] == 0) {
                    html += '<div class="form-group row">';
                    html +=
                      '<label class="col-4 col-sm-4 col-md-4 col-lg-3 col-xl-3 col-form-label text-right align-self-center">Start Date</label>';
                    html +=
                      '<div class="col-8 col-sm-8 col-md-6 col-lg-8 col-xl-8 align-self-center">';
                    html += '<div class="input-group input-group-sm">';
                    html +=
                      '<input value="' +
                      data_lines[key]["start_date_placeholder"] +
                      '" class="form-control-sm d-none" type="text" name="placeholder[start_date][]"/>';
                    html +=
                      '<input placeholder="MM/YYYY" value="' +
                      data_lines[key]["start_date"] +
                      '" class="form-control form-control-sm" type="text" name="row_education[start_date][]"/>';
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
                      '<input value="' +
                      data_lines[key]["end_date_placeholder"] +
                      '" class="form-control-sm d-none" type="text" name="placeholder[end_date][]"/>';
                    html +=
                      '<input placeholder="MM/YYYY" value="' +
                      data_lines[key]["end_date"] +
                      '" class="form-control form-control-sm" type="text" name="row_education[end_date][]"/>';
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
                      '<label class="col-4 col-sm-4 col-md-4 col-lg-3 col-xl-3 col-form-label text-right align-self-center">Start Date</label>';
                    html +=
                      '<div class="col-8 col-sm-8 col-md-6 col-lg-8 col-xl-8 align-self-center">';
                    html += '<div class="input-group input-group-sm">';
                    html +=
                      '<input value="' +
                      data_lines[key]["start_date_placeholder"] +
                      '&emsp;-&emsp;Present" class="form-control-sm d-none" type="text" name="placeholder[start_date][]"/>';
                    html +=
                      '<input placeholder="MM/YYYY" value="' +
                      data_lines[key]["start_date"] +
                      '" class="form-control form-control-sm" type="text" name="row_education[start_date][]"/>';
                    html += '<div class="input-group-append">';
                    html +=
                      '<span class="input-group-text"><i class="fa fa-calendar"></i></span>';
                    html += "</div><!--./input-group-append-->";
                    html += "</div><!--./input-group input-group-sm-->";
                    html += "</div><!--./col-->";
                    html += "</div><!--./form-group-->";
                  }
                } else {
                  html += '<div class="form-group row">';
                  html +=
                    '<label class="col-4 col-sm-4 col-md-4 col-lg-3 col-xl-3 col-form-label text-right align-self-center">Start Date</label>';
                  html +=
                    '<div class="col-8 col-sm-8 col-md-6 col-lg-8 col-xl-8 align-self-center">';
                  html += '<div class="input-group input-group-sm">';
                  html +=
                    '<input value="' +
                    data_lines[key]["start_date_placeholder"] +
                    '" class="form-control-sm d-none" type="text" name="placeholder[start_date][]"/>';
                  html +=
                    '<input placeholder="MM/YYYY" value="' +
                    data_lines[key]["start_date"] +
                    '" class="form-control form-control-sm" type="text" name="row_education[start_date][]"/>';
                  html += '<div class="input-group-append">';
                  html +=
                    '<span class="input-group-text"><i class="fa fa-calendar"></i></span>';
                  html += "</div><!--./input-group-append-->";
                  html += "</div><!--./input-group input-group-sm-->";
                  html += "</div><!--./col-->";
                  html += "</div><!--./form-group-->";

                  html += '<div class="form-group row">';
                  html +=
                    '<label class="col-4 col-sm-4 col-md-4 col-lg-3 col-xl-3 col-form-label text-right align-self-center" id="mob_ed_educationlabel' +
                    key +
                    '">End Date</label>';
                  html +=
                    '<div class="col-8 col-sm-8 col-md-6 col-lg-8 col-xl-8 align-self-center" id="mob_ed_educationcol' +
                    key +
                    '">';
                  html += '<div class="input-group input-group-sm date">';
                  html +=
                    '<input value="' +
                    data_lines[key]["end_date_placeholder"] +
                    '" class="form-control-sm d-none" type="text" name="placeholder[end_date][]"/>';
                  html +=
                    '<input placeholder="MM/YYYY" value="' +
                    data_lines[key]["end_date"] +
                    '" class="form-control form-control-sm" type="text" name="row_education[end_date][]"/>';
                  html += '<div class="input-group-append">';
                  html +=
                    '<span class="input-group-text"><i class="fa fa-calendar"></i></span>';
                  html += "</div><!--./input-group-append-->";
                  html += "</div><!--./input-group input-group-sm-->";
                  html += "</div><!--./col-10-->";
                  html += "</div><!--./form-group-->";
                }
              } else {
                if (param.mode == "view") {
                  if (data_lines[key]["if_current"] == 0) {
                    html += '<div class="form-group row">';
                    html +=
                      '<label class="col-3 col-md-4 col-xl-3 col-lg-3 col-form-label text-right align-self-center">Start Date</label>';
                    html += '<div class="col-3 align-self-center">';
                    html += '<div class="input-group input-group-sm">';
                    html +=
                      '<input value="' +
                      data_lines[key]["start_date_placeholder"] +
                      '" class="form-control-sm d-none" type="text" name="placeholder[start_date][]"/>';
                    html +=
                      '<input placeholder="MM/YYYY" value="' +
                      data_lines[key]["start_date"] +
                      '" class="form-control form-control-sm" type="text" name="row_education[start_date][]"/>';
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
                      '<input value="' +
                      data_lines[key]["end_date_placeholder"] +
                      '" class="form-control-sm d-none" type="text" name="placeholder[end_date][]"/>';
                    html +=
                      '<input placeholder="MM/YYYY" value="' +
                      data_lines[key]["end_date"] +
                      '" class="form-control form-control-sm" type="text" name="row_education[end_date][]"/>';
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
                    html +=
                      '<div class="col-3 align-self-center" style="width: 12.66666667%;">';
                    html += '<div class="input-group input-group-sm">';
                    html +=
                      '<input value="' +
                      data_lines[key]["start_date_placeholder"] +
                      '" class="form-control-sm d-none" type="text" name="placeholder[start_date][]"/>';
                    html +=
                      '<input placeholder="MM/YYYY" value="' +
                      data_lines[key]["start_date"] +
                      '" class="form-control form-control-sm" type="text" name="row_education[start_date][]"/>';
                    html += '<div class="input-group-append">';
                    html +=
                      '<span class="input-group-text"><i class="fa fa-calendar"></i></span>';
                    html += "</div><!--./input-group-append-->";
                    html += "</div><!--./input-group input-group-sm-->";
                    html += "</div><!--./col-->";

                    html +=
                      '<div class="col-1 align-self-center" style="width: 5.33333333%">-';
                    html += "</div><!--./col-->";
                    html +=
                      '<label class="col-2 col-form-label align-self-center">Present</label>';
                    html += "</div><!--./form-group-->";
                  }
                } else {
                  html += '<div class="form-group row">';
                  html +=
                    '<label class="col-3 col-form-label text-right align-self-center">Start Date</label>';
                  html += '<div class="col-3 align-self-center">';
                  html += '<div class="input-group input-group-sm">';
                  html +=
                    '<input value="' +
                    data_lines[key]["start_date_placeholder"] +
                    '" class="form-control-sm d-none" type="text" name="placeholder[start_date][]"/>';
                  html +=
                    '<input placeholder="MM/YYYY" value="' +
                    data_lines[key]["start_date"] +
                    '" class="form-control form-control-sm" type="text" name="row_education[start_date][]"/>';
                  html += '<div class="input-group-append">';
                  html +=
                    '<span class="input-group-text"><i class="fa fa-calendar"></i></span>';
                  html += "</div><!--./input-group-append-->";
                  html += "</div><!--./input-group input-group-sm-->";
                  html += "</div><!--./col-->";

                  html +=
                    '<label class="col-2 col-form-label text-right align-self-center" id="ed_educationlabel' +
                    key +
                    '">End Date</label>';
                  html +=
                    '<div class="col-3 align-self-center" id="ed_educationcol' +
                    key +
                    '">';
                  html += '<div class="input-group input-group-sm date">';
                  html +=
                    '<input value="' +
                    data_lines[key]["end_date_placeholder"] +
                    '" class="form-control-sm d-none" type="text" name="placeholder[end_date][]"/>';
                  html +=
                    '<input placeholder="MM/YYYY" value="' +
                    data_lines[key]["end_date"] +
                    '" class="form-control form-control-sm" type="text" name="row_education[end_date][]"/>';
                  html += '<div class="input-group-append">';
                  html +=
                    '<span class="input-group-text"><i class="fa fa-calendar"></i></span>';
                  html += "</div><!--./input-group-append-->";
                  html += "</div><!--./input-group input-group-sm-->";
                  html += "</div><!--./col-10-->";
                  html += "</div><!--./form-group-->";
                }
              }

              if (param.mode == "view") {
                // if(data_lines[key]['if_current'] == 1){
                //     html += '<div class="form-group row">';
                //         html += '<label class="col-4 col-sm-4 col-md-4 col-lg-3 col-xl-3 col-form-label text-right align-self-center">If Current</label>';
                //         html += '<div class="col-1 align-self-center">';
                //             html += '<input '+(data_lines[key]['if_current'] == 1? 'checked' : '')+' type="checkbox" class="w-auto" id="row_education[if_current][]"/>';
                //         html += '</div><!--./col-10-->';
                //     html += '</div><!--./form-group-->';
                // }
              } else {
                html += '<div class="form-group row">';
                html +=
                  '<label class="col-4 col-sm-4 col-md-4 col-lg-3 col-xl-3 col-form-label text-right align-self-center">If Current</label>';
                html += '<div class="col-1 align-self-center">';
                //html += '<input '+(data_lines[key]['if_current'] == 1? 'checked' : '')+' type="checkbox" class="w-auto" id="row_education[if_current][edu_'+key+']"/>'; gian code
                html +=
                  "<input " +
                  (data_lines[key]["if_current"] == 1 ? "checked" : "") +
                  ' type="checkbox" class="w-auto" id="row_education[if_current][]"/>';
                html += "</div><!--./col-10-->";
                html += "</div><!--./form-group-->";
              }

              html += '<div class="form-group row d-none">';
              html +=
                '<label class="col-4 col-sm-4 col-md-4 col-lg-3 col-xl-3 col-form-label text-right align-self-center">If Current</label>';
              html += '<div class="col-1 align-self-center">';
              //html += '<input value="'+data_lines[key]['if_current']+'" type="text" name="row_education[if_current][]" id="row_education_current'+key+'"/>'; gian code
              html +=
                '<input value="' +
                data_lines[key]["if_current"] +
                '" type="text" name="row_education[if_current][]" id="row_education_current' +
                key +
                '"/>';
              html += "</div><!--./col-10-->";
              html += "</div><!--./form-group-->";

              html += "</div>";
              html += "</div>";
            } //end for
            $("#education_content").html(html);

            if ($(window).width() >= 1025) {
              if (param.mode == "edit") {
                if ($("#row_education_current0").val() == 1) {
                  $("#ed_educationlabel0").addClass("d-none");
                  $("#ed_educationcol0").addClass("d-none");
                } else {
                  $("#ed_educationlabel0").removeClass("d-none");
                  $("#ed_educationcol0").removeClass("d-none");
                }

                if ($("#row_education_current1").val() == 1) {
                  $("#ed_educationlabel1").addClass("d-none");
                  $("#ed_educationcol1").addClass("d-none");
                } else {
                  $("#ed_educationlabel1").removeClass("d-none");
                  $("#ed_educationcol1").removeClass("d-none");
                }
              }

              $('input:checkbox[id="row_education[if_current][edu_0]"]').change(
                function () {
                  if ($("#row_education_current0").val() == 0) {
                    if (
                      $("#row_education_current0").val() == 0 &&
                      $("#row_education_current1").val() == 1
                    ) {
                      $("#ed_educationlabel0").addClass("d-none");
                      $("#ed_educationcol0").addClass("d-none");
                      $("#ed_educationlabel1").removeClass("d-none");
                      $("#ed_educationcol1").removeClass("d-none");
                    } else {
                      $("#ed_educationlabel0").addClass("d-none");
                      $("#ed_educationcol0").addClass("d-none");
                    }
                  } else {
                    $("#ed_educationlabel0").removeClass("d-none");
                    $("#ed_educationcol0").removeClass("d-none");
                  }
                }
              );

              $('input:checkbox[id="row_education[if_current][edu_1]"]').change(
                function () {
                  if ($("#row_education_current1").val() == 0) {
                    if (
                      $("#row_education_current1").val() == 0 &&
                      $("#row_education_current0").val() == 1
                    ) {
                      $("#ed_educationlabel1").addClass("d-none");
                      $("#ed_educationcol1").addClass("d-none");
                      $("#ed_educationlabel0").removeClass("d-none");
                      $("#ed_educationcol0").removeClass("d-none");
                    } else {
                      $("#ed_educationlabel1").addClass("d-none");
                      $("#ed_educationcol1").addClass("d-none");
                    }
                  } else {
                    $("#ed_educationlabel1").removeClass("d-none");
                    $("#ed_educationcol1").removeClass("d-none");
                  }
                }
              );
            } else {
              if (param.mode == "edit") {
                if ($("#row_education_current0").val() == 1) {
                  $("#mob_ed_educationlabel0").addClass("d-none");
                  $("#mob_ed_educationcol0").addClass("d-none");
                } else {
                  $("#mob_ed_educationlabel0").removeClass("d-none");
                  $("#mob_ed_educationcol0").removeClass("d-none");
                }

                if ($("#row_education_current1").val() == 1) {
                  $("#mob_ed_educationlabel1").addClass("d-none");
                  $("#mob_ed_educationcol1").addClass("d-none");
                } else {
                  $("#mob_ed_educationlabel1").removeClass("d-none");
                  $("#mob_ed_educationcol1").removeClass("d-none");
                }
              }

              $('input:checkbox[id="row_education[if_current][edu_0]"]').change(
                function () {
                  if ($("#row_education_current0").val() == 0) {
                    if (
                      $("#row_education_current0").val() == 0 &&
                      $("#row_education_current1").val() == 1
                    ) {
                      $("#mob_ed_educationlabel0").addClass("d-none");
                      $("#mob_ed_educationcol0").addClass("d-none");
                      $("#mob_ed_educationlabel1").removeClass("d-none");
                      $("#mob_ed_educationcol1").removeClass("d-none");
                    } else {
                      $("#mob_ed_educationlabel0").addClass("d-none");
                      $("#mob_ed_educationcol0").addClass("d-none");
                    }
                  } else {
                    $("#mob_ed_educationlabel0").removeClass("d-none");
                    $("#mob_ed_educationcol0").removeClass("d-none");
                  }
                }
              );

              $('input:checkbox[id="row_education[if_current][edu_1]"]').change(
                function () {
                  if ($("#row_education_current1").val() == 0) {
                    if (
                      $("#row_education_current1").val() == 0 &&
                      $("#row_education_current0").val() == 1
                    ) {
                      $("#mob_ed_educationlabel1").addClass("d-none");
                      $("#mob_ed_educationcol1").addClass("d-none");
                      $("#mob_ed_educationlabel0").removeClass("d-none");
                      $("#mob_ed_educationcol0").removeClass("d-none");
                    } else {
                      $("#mob_ed_educationlabel1").addClass("d-none");
                      $("#mob_ed_educationcol1").addClass("d-none");
                    }
                  } else {
                    $("#mob_ed_educationlabel1").removeClass("d-none");
                    $("#mob_ed_educationcol1").removeClass("d-none");
                  }
                }
              );
            }

            var url = baseurl + "/get/job_post/oeducation";
            var dropdown = $("select[name=row_education\\[education\\]\\[\\]]");
            load_dropdown(url, dropdown);
            load_dropdowns(dropdown);

            for (var key in data_lines) {
              $("select[name=row_education\\[education\\]\\[\\]]")
                .eq(key)
                .multiselect("select", data_lines[key]["education"]);
            } //end if
            //end education

            //language
            html = "";
            data_lines = response.line_language;
            for (var key in data_lines) {
              html += '<div class="card mb-3">';
              html += '<div class="card-body aivw-skillsbtn">';
              html +=
                '<button type="button" class="close close-btn" aria-label="Close">';
              html +=
                '<span aria-hidden="true" class="close-span">&times;</span>';
              html += "</button>";
              html += "</div>";
              html += '<div class="card-body aivw-skillscardbody">';
              html += '<div class="form-group row d-none">';
              html +=
                '<label class="col-1 col-form-label text-right align-self-center">Line <span class="text-danger fw-bolder">*</span></label>';
              html += '<div class="col-8 align-self-center">';
              html +=
                '<input value="' +
                data_lines[key]["line"] +
                '" readonly class="form-control form-control-sm" type="text" name="row_language[line][]" maxlength="100"/>';
              html += "</div><!--./col-10-->";
              html += "</div><!--./form-group-->";

              html += '<div class="form-group row aivw-skillsrow">';
              html +=
                '<label class="col-1 col-form-label text-right align-self-center"><span class="text-danger fw-bolder aivw-asterisk">*</span></label>';
              html += '<div class="col-8 align-self-center">';
              html +=
                '<input value="' +
                data_lines[key]["language"] +
                '" class="form-control form-control-sm" type="text" name="row_language[language][]" maxlength="200"/>';
              html += "</div><!--./col-10-->";
              html += "</div><!--./form-group-->";
              html += "</div>";
              html += "</div>";
            } //end for
            $("#language_content").html(html);
            //end language

            //certifications and licenses
            html = "";
            data_lines = response.line_certification;
            for (var key in data_lines) {
              html += '<div class="card mb-3">';
              html += '<div class="card-body aivw-skillsbtn">';
              html +=
                '<button type="button" class="close close-btn" aria-label="Close">';
              html +=
                '<span aria-hidden="true" class="close-span">&times;</span>';
              html += "</button>";
              html += "</div>";
              html += '<div class="card-body aivw-skillscardbody">';
              html += '<div class="form-group row d-none">';
              html +=
                '<label class="col-1 col-form-label text-right align-self-center">Line <span class="text-danger fw-bolder">*</span></label>';
              html += '<div class="col-8 align-self-center">';
              html +=
                '<input value="' +
                data_lines[key]["line"] +
                '" readonly class="form-control form-control-sm" type="text" name="row_certification[line][]" maxlength="100"/>';
              html += "</div><!--./col-10-->";
              html += "</div><!--./form-group-->";

              html += '<div class="form-group row">';
              html +=
                '<label class="col-lg-3 col-xl-3 col-auto col-form-label text-right align-self-center">Certification & License<span class="text-danger fw-bolder">*</span></label>';
              html +=
                '<div class="col-lg-8 col-xl-8 col-auto align-self-center">';
              html +=
                '<input value="' +
                data_lines[key]["certification"] +
                '" class="form-control form-control-sm" type="text" name="row_certification[certification][]" maxlength="200"/>';
              html += "</div><!--./col-10-->";
              html += "</div><!--./form-group-->";

              var is_check = "";
              var show_end_date = "";
              if (parseInt(data_lines[key]["no_expiration"])) {
                is_check = "checked";
                show_end_date = "d-none";
              } //end if

              html += '<div class="form-group row">';
              html +=
                '<label class="col-lg-3 col-xl-3 col-auto col-form-label text-right align-self-center">Issued Date <span class="text-danger fw-bolder">*</span></label>';
              html +=
                '<div class="col-lg-3 col-xl-3 col-auto align-self-center">';
              html += '<div class="input-group input-group-sm">';
              html +=
                '<input value="' +
                data_lines[key]["issued_date"] +
                '" placeholder="M/YYYY" class="form-control form-control-sm" type="text" name="row_certification[issued_date][]"/>';
              html += '<div class="input-group-append">';
              html +=
                '<span class="input-group-text"><i class="fa fa-calendar"></i></span>';
              html += "</div><!--./input-group-append-->";
              html += "</div><!--./input-group input-group-sm-->";
              html += "</div><!--./col-->";

              html +=
                '<label class="' +
                show_end_date +
                ' col-lg-2 col-xl-2 col-auto col-form-label text-right align-self-center">Exp. Date</label>';
              html +=
                '<div class="' +
                show_end_date +
                ' col-lg-3 col-xl-3 col-auto align-self-center">';
              html += '<div class="input-group input-group-sm date">';
              html +=
                '<input value="' +
                data_lines[key]["expiration_date"] +
                '" placeholder="M/YYYY" class="form-control form-control-sm" type="text" name="row_certification[expiration_date][]"/>';
              html += '<div class="input-group-append">';
              html +=
                '<span class="input-group-text"><i class="fa fa-calendar"></i></span>';
              html += "</div><!--./input-group-append-->";
              html += "</div><!--./input-group input-group-sm-->";
              html += "</div><!--./col-10-->";
              html += "</div><!--./form-group-->";

              html += '<div class="form-group row">';
              html +=
                '<label class="col-lg-3 col-xl-3 col-auto col-form-label text-right align-self-center">No Expiration</label>';
              html +=
                '<div class="col-lg-3 col-xl-3 col-auto align-self-center">';
              html +=
                '<input type="checkbox" ' +
                is_check +
                ' name="row_certification[no_expiration][]"/>';
              html += "</div><!--./col-10-->";
              html += "</div><!--./form-group-->";

              html += "</div>";
              html += "</div>";
            } //end for
            $("#certification_content").html(html);
            //end certifications and licenses

            //projects
            html = "";
            data_lines = response.line_projects;
            for (var key in data_lines) {
              html += '<div class="card mb-3">';
              html += '<div class="card-body aivw-skillsbtn">';
              html +=
                '<button type="button" class="close close-btn" aria-label="Close">';
              html +=
                '<span aria-hidden="true" class="close-span">&times;</span>';
              html += "</button>";
              html += "</div>";
              html += '<div class="card-body aivw-skillscardbody">';
              html += '<div class="form-group row d-none">';
              html +=
                '<label class="col-1 col-form-label text-right align-self-center">Line <span class="text-danger fw-bolder">*</span></label>';
              html += '<div class="col-8 align-self-center">';
              html +=
                '<input value="' +
                data_lines[key]["line"] +
                '" readonly class="form-control form-control-sm" type="text" name="row_projects[line][]" maxlength="100"/>';
              html += "</div><!--./col-10-->";
              html += "</div><!--./form-group-->";

              html += '<div class="form-group row aivw-skillsrow">';
              html +=
                '<label class="col-1 col-form-label text-right align-self-center"><span class="text-danger fw-bolder aivw-asterisk">*</span></label>';
              html += '<div class="col-8 align-self-center">';
              html +=
                '<input value="' +
                data_lines[key]["projects"] +
                '" class="form-control form-control-sm" type="text" name="row_projects[projects][]" maxlength="200"/>';
              html += "</div><!--./col-10-->";
              html += "</div><!--./form-group-->";
              html += "</div>";
              html += "</div>";
            } //end for
            $("#projects_content").html(html);
            //end projects

            //seminar and trainings
            html = "";
            data_lines = response.line_seminars_trainings;
            for (var key in data_lines) {
              html += '<div class="card mb-3">';
              html += '<div class="card-body aivw-skillsbtn">';
              html +=
                '<button type="button" class="close close-btn" aria-label="Close">';
              html +=
                '<span aria-hidden="true" class="close-span">&times;</span>';
              html += "</button>";
              html += "</div>";
              html += '<div class="card-body aivw-skillscardbody">';
              html += '<div class="form-group row d-none">';
              html +=
                '<label class="col-1 col-form-label text-right align-self-center">Line <span class="text-danger fw-bolder">*</span></label>';
              html += '<div class="col-8 align-self-center">';
              html +=
                '<input value="' +
                data_lines[key]["line"] +
                '" readonly class="form-control form-control-sm" type="text" name="row_seminar_training[line][]" maxlength="100"/>';
              html += "</div><!--./col-10-->";
              html += "</div><!--./form-group-->";

              html += '<div class="form-group row aivw-skillsrow">';
              html +=
                '<label class="col-1 col-form-label text-right align-self-center"><span class="text-danger fw-bolder aivw-asterisk">*</span></label>';
              html += '<div class="col-8 align-self-center">';
              html +=
                '<input value="' +
                data_lines[key]["seminar_training"] +
                '" class="form-control form-control-sm" type="text" name="row_seminar_training[seminar_training][]" maxlength="200"/>';
              html += "</div><!--./col-10-->";
              html += "</div><!--./form-group-->";
              html += "</div>";
              html += "</div>";
            } //end for
            $("#seminar_training_content").html(html);
            //end seminar and trainings

            //awards and achievements
            html = "";
            data_lines = response.line_awards_achievements;
            for (var key in data_lines) {
              html += '<div class="card mb-3">';
              html += '<div class="card-body aivw-skillsbtn">';
              html +=
                '<button type="button" class="close close-btn" aria-label="Close">';
              html +=
                '<span aria-hidden="true" class="close-span">&times;</span>';
              html += "</button>";
              html += "</div>";
              html += '<div class="card-body aivw-skillscardbody">';
              html += '<div class="form-group row d-none">';
              html +=
                '<label class="col-1 col-form-label text-right align-self-center">Line <span class="text-danger fw-bolder">*</span></label>';
              html += '<div class="col-8 align-self-center">';
              html +=
                '<input value="' +
                data_lines[key]["line"] +
                '" readonly class="form-control form-control-sm" type="text" name="row_award_achievement[line][]" maxlength="100"/>';
              html += "</div><!--./col-10-->";
              html += "</div><!--./form-group-->";

              html += '<div class="form-group row aivw-skillsrow">';
              html +=
                '<label class="col-1 col-form-label text-right align-self-center"><span class="text-danger fw-bolder aivw-asterisk">*</span></label>';
              html += '<div class="col-8 align-self-center">';
              html +=
                '<input value="' +
                data_lines[key]["award_achievement"] +
                '" class="form-control form-control-sm" type="text" name="row_award_achievement[award_achievement][]" maxlength="200"/>';
              html += "</div><!--./col-10-->";
              html += "</div><!--./form-group-->";
              html += "</div>";
              html += "</div>";
            } //end for
            $("#awards_achievements_content").html(html);
            //end awards and achievements

            //affiliations
            html = "";
            data_lines = response.line_affiliations;
            for (var key in data_lines) {
              html += '<div class="card mb-3">';
              html += '<div class="card-body aivw-skillsbtn">';
              html +=
                '<button type="button" class="close close-btn" aria-label="Close">';
              html +=
                '<span aria-hidden="true" class="close-span">&times;</span>';
              html += "</button>";
              html += "</div>";
              html += '<div class="card-body aivw-skillscardbody">';
              html += '<div class="form-group row d-none">';
              html +=
                '<label class="col-1 col-form-label text-right align-self-center">Line <span class="text-danger fw-bolder">*</span></label>';
              html += '<div class="col-8 align-self-center">';
              html +=
                '<input value="' +
                data_lines[key]["line"] +
                '" readonly class="form-control form-control-sm" type="text" name="row_affiliation[line][]" maxlength="100"/>';
              html += "</div><!--./col-10-->";
              html += "</div><!--./form-group-->";

              html += '<div class="form-group row aivw-skillsrow">';
              html +=
                '<label class="col-1 col-form-label text-right align-self-center"><span class="text-danger fw-bolder aivw-asterisk">*</span></label>';
              html += '<div class="col-8 align-self-center">';
              html +=
                '<input value="' +
                data_lines[key]["affiliation"] +
                '" class="form-control form-control-sm" type="text" name="row_affiliation[affiliation][]" maxlength="200"/>';
              html += "</div><!--./col-10-->";
              html += "</div><!--./form-group-->";
              html += "</div>";
              html += "</div>";
            } //end for
            $("#affiliations_content").html(html);
            //end affiliations

            //industry
            html = "";
            data_lines = response.line_industry;
            for (var key in data_lines) {
              html += "<div>";
              html += "<div>";
              html +=
                '<button type="button" class="close close-btn" aria-label="Close">';
              html +=
                '<span aria-hidden="true" class="close-span">&times;</span>';
              html += "</button>";
              html += "</div>";
              html += "<div>";
              html += '<div class="form-group row d-none">';
              html +=
                '<label class="col-3 col-form-label text-right align-self-center">Line <span class="text-danger fw-bolder">*</span></label>';
              html += '<div class="col-8 align-self-center">';
              html +=
                '<input value="' +
                data_lines[key]["line"] +
                '" readonly class="form-control form-control-sm" type="text" name="row_industry[line][]" maxlength="100"/>';
              html += "</div><!--./col-10-->";
              html += "</div><!--./form-group-->";

              html += '<div class="form-group row">';
              html +=
                '<label class="col-4 col-sm-4 col-md-4 col-lg-1 col-xl-1 col-form-label text-right align-self-center"></label>';
              html +=
                '<div class="col-8 col-sm-8 col-md-6 col-lg-8 col-xl-8 align-self-center">';
              html += '<div class="input-group input-group-sm aivw-withsel">';
              html +=
                '<input value="' +
                data_lines[key]["industry_text"] +
                '" class="form-control form-control-sm d-none" type="text" name="placeholder[industry][]"/>';
              html += '<select name="row_industry[industry][]"></select>';
              html += "</div>";
              html += "</div><!--./col-10-->";
              html += "</div><!--./form-group-->";
              html += "</div>";
              html += "</div>";
            } //end for
            $("#industry_content").html(html);

            var url = baseurl + "/get/signup/industry/0";
            var dropdown = $("select[name=row_industry\\[industry\\]\\[\\]]");
            load_dropdown(url, dropdown);
            load_dropdowns(dropdown);

            for (var key in data_lines) {
              $("select[name=row_industry\\[industry\\]\\[\\]]")
                .eq(key)
                .multiselect("select", data_lines[key]["industry"]);
            } //end if
            //end industry

            //job level
            html = "";
            data_lines = response.line_job_level;
            for (var key in data_lines) {
              html += "<div>";
              html += "<div>";
              html +=
                '<button type="button" class="close close-btn" aria-label="Close">';
              html +=
                '<span aria-hidden="true" class="close-span">&times;</span>';
              html += "</button>";
              html += "</div>";
              html += "<div>";
              html += '<div class="form-group row d-none">';
              html +=
                '<label class="col-3 col-form-label text-right align-self-center">Line <span class="text-danger fw-bolder">*</span></label>';
              html += '<div class="col-8 align-self-center">';
              html +=
                '<input value="' +
                data_lines[key]["line"] +
                '" readonly class="form-control form-control-sm" type="text" name="row_job_level[line][]" maxlength="100"/>';
              html += "</div><!--./col-10-->";
              html += "</div><!--./form-group-->";

              html += '<div class="form-group row">';
              html +=
                '<label class="col-4 col-sm-4 col-md-4 col-lg-1 col-xl-1 col-form-label text-right align-self-center"></label>';
              html +=
                '<div class="col-8 col-sm-8 col-md-6 col-lg-8 col-xl-8 align-self-center">';
              html += '<div class="input-group input-group-sm aivw-withsel">';
              html +=
                '<input value="' +
                data_lines[key]["job_level_text"] +
                '" class="form-control form-control-sm d-none" type="text" name="placeholder[job_level][]"/>';
              html += '<select name="row_job_level[job_level][]"></select>';
              html += "</div>";
              html += "</div><!--./col-10-->";
              html += "</div><!--./form-group-->";
              html += "</div>";
              html += "</div>";
            } //end for
            $("#job_level_content").html(html);

            var url = baseurl + "/get/job_post/ojob_level";
            var dropdown = $("select[name=row_job_level\\[job_level\\]\\[\\]]");
            load_dropdown(url, dropdown);
            load_dropdowns(dropdown);

            for (var key in data_lines) {
              $("select[name=row_job_level\\[job_level\\]\\[\\]]")
                .eq(key)
                .multiselect("select", data_lines[key]["job_level"]);
            } //end if
            //end job level

            //job type
            html = "";
            data_lines = response.line_job_type;
            for (var key in data_lines) {
              html += "<div>";
              html += "<div>";
              html +=
                '<button type="button" class="close close-btn" aria-label="Close">';
              html +=
                '<span aria-hidden="true" class="close-span">&times;</span>';
              html += "</button>";
              html += "</div>";
              html += "<div>";
              html += '<div class="form-group row d-none">';
              html +=
                '<label class="col-3 col-form-label text-right align-self-center">Line <span class="text-danger fw-bolder">*</span></label>';
              html += '<div class="col-8 align-self-center">';
              html +=
                '<input value="' +
                data_lines[key]["line"] +
                '" readonly class="form-control form-control-sm" type="text" name="row_job_type[line][]" maxlength="100"/>';
              html += "</div><!--./col-10-->";
              html += "</div><!--./form-group-->";

              html += '<div class="form-group row">';
              html +=
                '<label class="col-4 col-sm-4 col-md-4 col-lg-1 col-xl-1 col-form-label text-right align-self-center"></label>';
              html +=
                '<div class="col-8 col-sm-8 col-md-6 col-lg-8 col-xl-8 align-self-center">';
              html += '<div class="input-group input-group-sm aivw-withsel">';
              html +=
                '<input value="' +
                data_lines[key]["job_type_text"] +
                '" class="form-control form-control-sm d-none" type="text" name="placeholder[job_type][]"/>';
              html += '<select name="row_job_type[job_type][]"></select>';
              html += "</div>";
              html += "</div><!--./col-10-->";
              html += "</div><!--./form-group-->";
              html += "</div>";
              html += "</div>";
            } //end for
            $("#job_type_content").html(html);

            var url = baseurl + "/get/job_post/ojob_type";
            var dropdown = $("select[name=row_job_type\\[job_type\\]\\[\\]]");
            load_dropdown(url, dropdown);
            load_dropdowns(dropdown);

            for (var key in data_lines) {
              $("select[name=row_job_type\\[job_type\\]\\[\\]]")
                .eq(key)
                .multiselect("select", data_lines[key]["job_type"]);
            } //end if
            //end job type

            //department
            html = "";
            data_lines = response.line_department;
            for (var key in data_lines) {
              html += "<div>";
              html += "<div>";
              html +=
                '<button type="button" class="close close-btn" aria-label="Close">';
              html +=
                '<span aria-hidden="true" class="close-span">&times;</span>';
              html += "</button>";
              html += "</div>";
              html += "<div>";
              html += '<div class="form-group row d-none">';
              html +=
                '<label class="col-3 col-form-label text-right align-self-center">Line <span class="text-danger fw-bolder">*</span></label>';
              html += '<div class="col-8 align-self-center">';
              html +=
                '<input value="' +
                data_lines[key]["line"] +
                '" readonly class="form-control form-control-sm" type="text" name="row_department[line][]" maxlength="100"/>';
              html += "</div><!--./col-10-->";
              html += "</div><!--./form-group-->";

              html += '<div class="form-group row">';
              html +=
                '<label class="col-4 col-sm-4 col-md-4 col-lg-1 col-xl-1 col-form-label text-right align-self-center"></label>';
              html +=
                '<div class="col-8 col-sm-8 col-md-7 col-lg-8 col-xl-8 align-self-center">';
              html += '<div class="input-group input-group-sm aivw-withsel">';
              html +=
                '<input value="' +
                data_lines[key]["department_text"] +
                '" class="form-control form-control-sm d-none w-100" type="text" name="placeholder[department][]"/>';
              html += '<select name="row_department[department][]"></select>';
              html += "</div>";
              html += "</div><!--./col-10-->";
              html += "</div><!--./form-group-->";
              html += "</div>";
              html += "</div>";
            } //end for
            $("#department_content").html(html);

            autosize($(".aivw-textarea"));

            if (type == "view") {
              $(".aivw-withsel").contents(":not(input)").remove();
            }

            if ($(window).width() <= 1024) {
              $(".col-form-label").css("font-size", "12px");
            }

            /* if(type == "edit") {
                        $('.aivw-cboxjs input').css({'margin-left': '0', 'margin-top': '0.4rem'});
                        $('#aivw-checkbox').css('margin-top', '0.5rem');
                    } */

            //reload date time picker
            $(
              "input[name=row_experience\\[start_date\\]\\[\\]]"
            ).datetimepicker({
              format: "M/YYYY",
            });
            $("input[name=row_experience\\[end_date\\]\\[\\]]").datetimepicker({
              format: "M/YYYY",
            });

            $("input[name=row_education\\[start_date\\]\\[\\]]").datetimepicker(
              {
                format: "M/YYYY",
              }
            );
            $("input[name=row_education\\[end_date\\]\\[\\]]").datetimepicker({
              format: "M/YYYY",
            });

            $(
              "input[name=row_certification\\[issued_date\\]\\[\\]]"
            ).datetimepicker({
              format: "M/YYYY",
            });
            $(
              "input[name=row_certification\\[expiration_date\\]\\[\\]]"
            ).datetimepicker({
              format: "M/YYYY",
            });
            //end reload date time picker

            var url = baseurl + "/get/job_post/odepartment";
            var dropdown = $(
              "select[name=row_department\\[department\\]\\[\\]]"
            );
            load_dropdown(url, dropdown);
            load_dropdowns(dropdown);

            for (var key in data_lines) {
              $("select[name=row_department\\[department\\]\\[\\]]")
                .eq(key)
                .multiselect("select", data_lines[key]["department"]);
            } //end if
            //end department

            //$('input[name=file\\[total_uploaded_file\\]]').val(total_size.toFixed(2));
            //$('input[name=file\\[total_files\\]]').val(total_files);

            //$('#image_cont').append(html);
            //$('#image_cont_form').append(html_form);
            //end populate lines
            //----------------------------------------------------------------------------------------------------
            //end view and edit mode
          } else {
            //add mode
            //----------------------------------------------------------------------------------------------------
            $("img[id=header\\[company_logo\\]]").attr("src", urlimgdef);
            //----------------------------------------------------------------------------------------------------
            //end add mode
          } //end if

          if (param.mode == "view") {
            $(
              "#frm_data_entry input:not([readonly]),textarea:not([readonly]),select,button"
            ).addClass(param.mode);
            //$('#frm_data_entry input:not([readonly]),textarea:not([readonly]),select').addClass('form-control-plaintext');

            $(".to_hide").addClass("d-none");
            //$('#frm_data_entry .tooltip_icon').addClass('d-none');

            $("#frm_data_entry .input-group-append").addClass("d-none");

            $("#frm_data_entry select." + param.mode + "").removeClass(
              "custom-select"
            );

            $(
              "#frm_data_entry button." +
                param.mode +
                ", input." +
                param.mode +
                ",textarea." +
                param.mode +
                ",select." +
                param.mode +
                ""
            ).removeClass("form-control");
            $(
              "#frm_data_entry button." +
                param.mode +
                ", input." +
                param.mode +
                ",textarea." +
                param.mode +
                ",select." +
                param.mode +
                ""
            ).addClass("form-control-plaintext");

            $(
              "#frm_data_entry button." +
                param.mode +
                ", input." +
                param.mode +
                ",textarea." +
                param.mode +
                ",select." +
                param.mode +
                ""
            ).prop("disabled", true);
            $("#frm_data_entry input[name^=placeholder]").removeClass("d-none");

            $(
              "#frm_data_entry input[name^=row_experience\\[start_date\\]\\[\\]]"
            ).addClass("d-none");
            $(
              "#frm_data_entry input[name^=row_experience\\[end_date\\]\\[\\]]"
            ).addClass("d-none");
            $(
              "#frm_data_entry input[name^=row_education\\[start_date\\]\\[\\]]"
            ).addClass("d-none");
            $(
              "#frm_data_entry input[name^=row_education\\[end_date\\]\\[\\]]"
            ).addClass("d-none");

            $("#frm_data_entry button").addClass("d-none");

            $(".btn_submit").addClass("d-none");

            $(".aivw-asterisk").addClass("d-none");
            $(".aivw-skillsbtn").addClass("d-none");
            $(".aivw-skillsrow").css({ "margin-bottom": "0" });
            $(".aivw-skillscardbody").css({ padding: "0.5rem 1rem" });
            $(".aivw-addBtn").addClass("d-none");
          } //end if

          if (param.mode == "edit") {
            $("#frm_data_entry .show_on_view").addClass("d-none");

            $(".aivw-skillsbtn").css({ "margin-bottom": "-3.6rem" });
            $(".aivw-skillsrow").css({ "margin-bottom": "0" });
            $(".aivw-skillscardbody").css({ padding: "0.5rem 1rem" });
          }

          btn.html(btn_text);
          $(".outside_button *").css("pointer-events", "auto");
        } else {
          //add mode
          //----------------------------------------------------------------------------------------------------
          $("img[id=header\\[company_logo\\]]").attr("src", urlimgdef);
          btn.html(btn_text);
          $(".outside_button *").css("pointer-events", "auto");
          //----------------------------------------------------------------------------------------------------
          //end add mode
        } //end if

        if (dropdown_loaded == 0) {
          load_filter_dropdowns();
        } //end if

        $("#loading").hide();
      })
      .fail(function (e) {
        alert(e.responseText);
        btn.html(btn_text);
        $(".outside_button *").css("pointer-events", "auto");
        $("#loading").hide();
      })
      .always(function (e) {});
  } //end load_record
  //=======================================================================================================================
  //end load data

  //autocomplete
  //===============================================================================================================================
  function load_dropdowns(dropdown) {
    dropdown.multiselect({
      enableFiltering: true,
      //selectAllValue: 'multiselect-all',
      //selectAllText: 'Select All',
      //includeSelectAllOption : true,

      maxHeight: 300,
      enableCaseInsensitiveFiltering: true,
    });
  } //end function

  function load_dropdowns2(type) {
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

  function load_filter_dropdowns() {
    var url = baseurl + "/get/job_post/olocation_user";
    var dropdown = $("select[name=header\\[location\\]]");
    load_dropdown(url, dropdown, "location");
    load_dropdowns2("location");

    dropdown_loaded = 1;
  } //end function

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
  //===============================================================================================================================
  //end autocomplete

  //Upload image
  //===============================================================================================================================
  //upload image
  function upload_image() {
    var url = homeurl + "/do_upload";
    var btn = $("button[name=btn_upload]");
    var formData = new FormData($("#frm_data_entry")[0]);

    //formData.append('action', action);
    $.ajax({
      url: url, // Controller URL
      type: "POST",
      data: formData,
      async: false,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "JSON",
      beforeSend: function (data) {
        $(".outside_button *").css("pointer-events", "none");
        btn.html(
          '<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Processing...'
        );
        btn.attr("disabled", "disabled");
        $("img[id=header\\[company_logo\\]]").attr(
          "src",
          "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
        );
      },
    })
      .done(function (data) {
        if (data.success === true) {
          var file = data.data.file[0];

          setTimeout(function () {
            btn.html("Upload Image");
            btn.removeAttr("disabled");
            $(".outside_button *").css("pointer-events", "auto");
            $("input[name=file\\[doc_content\\]]").val(file.file);
            $("img[id=header\\[company_logo\\]]").attr(
              "src",
              "data:image/jpeg;base64, " + file.file
            );
            $("input[name=header\\[doc_image\\]]").val(file.file_attr.name);
            //$(form+' img#patientimg').attr('src',"data:image/jpeg;base64, "+data.header.file);
          }, 2000);
        } else {
          setTimeout(function () {
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
            btn.html("Upload Image");
            btn.removeAttr("disabled");
            $(".outside_button *").css("pointer-events", "auto");
          }, 2000);
        }
      })
      .fail(function (data) {
        alert(JSON.stringify(data));
        //setTimeout(function(){

        //$('#uploadErrorCont').html(data.responseText)
        btn.html("Upload Image");
        btn.removeAttr("disabled");
        $(".outside_button *").css("pointer-events", "auto");
        //},2000)
      })
      .always(function (e) {});
  }
  //End upload image

  //upload image multiple
  function upload_image_multiple() {
    var url = homeurl + "/do_upload_multiple";
    var btn = $("#company_file_placeholder");
    var formData = new FormData($("#frm_data_entry")[0]);

    //formData.append('action', action);
    $.ajax({
      url: url, // Controller URL
      type: "POST",
      data: formData,
      async: false,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "JSON",
      beforeSend: function (data) {
        $(".outside_button *").css("pointer-events", "none");
        btn.html(
          '<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>'
        );
        btn.css("pointer-events", "none");
      },
    })
      .done(function (data) {
        if (data.success === true) {
          var files = data.data.file;
          var urlimg200x150 =
            "https://dummyimage.com/200x150/dee2e6/6c757d.jpg";
          var html = "";
          var html_form = "";

          setTimeout(function () {
            btn.html(
              '<a class="btn btn-pill-sm-primary text-primary btn-sm upload-resumebtn" style="font-size: 1rem; padding: 1px 1px; width: 1.5in; border: 2px solid rgba(var(--bs-primary-rgb));">Upload Resume</a>'
            );
            btn.css("pointer-events", "auto");
            $(".outside_button *").css("pointer-events", "auto");

            var ctr =
              $("input[name=row\\[line\\]\\[\\]]:last").val() === undefined
                ? 1
                : parseInt($("input[name=row\\[line\\]\\[\\]]:last").val()) + 1;
            for (var key in files) {
              var file = files[key];
              $("input[name=file\\[resume_content\\]]").val(file.file);
              $("input[name=header\\[resume\\]]").val(file.file_attr.name);

              if ($(window).width() <= 1024) {
                html += '<div class="form-group row">';
                html += '<div class="col-1">';
                html += "</div><!--./col-1-->";
                html +=
                  '<div class="col-8 col-sm-8 col-md-8 col-lg-7 col-xl-7 align-self-center">';
                html += file.file_attr.name;
                html += "</div><!--./col-10-->";
                html += "</div><!--./form-group-->";
              } else {
                html += '<div class="form-group row">';
                html += '<div class="col-1">';
                html += "</div><!--./col-1-->";
                html += '<div class="col-8 align-self-center">';
                html += file.file_attr.name;
                html += "</div><!--./col-10-->";
                html += "</div><!--./form-group-->";
              }

              ctr += 1;
              //console.log(file['file_attr'].name) + '<br/>';
            } //end for

            $("#image_cont").html(html);
            //$('#image_cont_form').html(html_form);
          }, 2000);
        } else {
          setTimeout(function () {
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
            btn.html('<i class="fa fa-upload"></i>');
            btn.css("pointer-events", "auto");
            $(".outside_button *").css("pointer-events", "auto");
          }, 2000);
        }
      })
      .fail(function (data) {
        alert(JSON.stringify(data));
        //setTimeout(function(){

        //$('#uploadErrorCont').html(data.responseText)
        btn.html('<i class="fa fa-upload"></i>');
        btn.css("pointer-events", "auto");
        $(".outside_button *").css("pointer-events", "auto");
        //},2000)
      })
      .always(function (e) {});
  }
  //End upload image

  //===============================================================================================================================
  //End upload image

  var date = new Date();
  var monthStart = date.getMonth() + 1;
  var monthEnd = date.getMonth() + 2;
  var yearStart = date.getFullYear();
  var yearEnd = date.getFullYear() + 1;

  if (monthStart < 10) {
    monthStart = "0" + monthStart;
  }

  if (monthEnd < 10) {
    monthEnd = "0" + monthEnd;
  }

  var todayStart = monthStart + "/" + yearStart;
  var todayEnd = monthEnd + "/" + yearEnd;

  //form template
  //===============================================================================================================================
  function load_experience_form(param) {
    console.log(exp_lineVal);
    var i_expline = exp_lineVal;
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
      '<input readonly class="form-control form-control-sm" type="text" name="row_experience[line][]" id="exp_line[' +
      i_expline +
      ']" maxlength="100"/>';
    html += "</div><!--./col-10-->";
    html += "</div><!--./form-group-->";

    html += '<div class="form-group row">';
    html +=
      '<label class="col-3 col-form-label text-right align-self-center">Job Title <span class="text-danger fw-bolder">*</span></label>';
    html += '<div class="col-8 align-self-center">';
    html +=
      '<input class="form-control form-control-sm" type="text" name="row_experience[designation][]" maxlength="100"/>';
    html += "</div><!--./col-10-->";
    html += "</div><!--./form-group-->";

    html += '<div class="form-group row">';
    if ($(window).width() <= 1024) {
      html +=
        '<label class="col-4 col-sm-4 col-md-4 col-lg-3 col-xl-3 col-form-label text-right align-self-center">Company <br/> Name <span class="text-danger fw-bolder">*</span></label>';
    } else {
      html +=
        '<label class="col-4 col-sm-4 col-md-4 col-lg-3 col-xl-3 col-form-label text-right align-self-center">Company Name <span class="text-danger fw-bolder">*</span></label>';
    }
    html += '<div class="col-8 align-self-center">';
    html +=
      '<input class="form-control form-control-sm" type="text" name="row_experience[company_name][]" maxlength="100"/>';
    html += "</div><!--./col-10-->";
    html += "</div><!--./form-group-->";

    html += '<div class="form-group row">';
    html +=
      '<label class="col-3 col-form-label text-right align-self-start">Short description</label>';
    html += '<div class="col-8 align-self-center">';
    html +=
      '<textarea rows="10" class="form-control form-control-sm aivw-textarea" name="row_experience[short_description][]" maxlength="600"></textarea>';
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
        '<input placeholder="MM/YYYY" class="form-control form-control-sm" type="text" value="' +
        todayStart +
        '" name="row_experience[start_date][]"/>';
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
        '<input placeholder="MM/YYYY" class="form-control form-control-sm" type="text" value="' +
        todayEnd +
        '" name="row_experience[end_date][]"/>';
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
        '<input placeholder="MM/YYYY" class="form-control form-control-sm" type="text" value="' +
        todayStart +
        '" name="row_experience[start_date][]"/>';
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
        '<input placeholder="MM/YYYY" class="form-control form-control-sm" type="text" value="' +
        todayEnd +
        '" name="row_experience[end_date][]"/>';
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
      '<input type="checkbox" class="w-auto" value="false" id="row_experience[if_current][]"/>';
    html += "</div><!--./col-10-->";
    html += "</div><!--./form-group-->";

    html += '<div class="form-group row d-none">';
    html +=
      '<label class="col-3 col-form-label text-right align-self-center">If Current</label>';
    html += '<div class="col-1 align-self-center">';
    html +=
      '<input value="0" type="text" name="row_experience[if_current][]"/>';
    html += "</div><!--./col-10-->";
    html += "</div><!--./form-group-->";

    html += "</div>";
    html += "</div>";

    if ($(window).width() >= 1025) {
      if (param.mode == "edit") {
        if ($("#row_experience_current0").val() == 1) {
          $("#edlabel0").addClass("d-none");
          $("#edcol0").addClass("d-none");
        } else {
          $("#edlabel0").removeClass("d-none");
          $("#edcol0").removeClass("d-none");
        }

        if ($("#row_experience_current1").val() == 1) {
          $("#edlabel1").addClass("d-none");
          $("#edcol1").addClass("d-none");
        } else {
          $("#edlabel1").removeClass("d-none");
          $("#edcol1").removeClass("d-none");
        }
      }

      $('input:checkbox[id="row_experience[if_current][0]"]').change(
        function () {
          if ($("#row_experience_current0").val() == 0) {
            if (
              $("#row_experience_current0").val() == 0 &&
              $("#row_experience_current1").val() == 1
            ) {
              $("#edlabel0").addClass("d-none");
              $("#edcol0").addClass("d-none");
              $("#edlabel1").removeClass("d-none");
              $("#edcol1").removeClass("d-none");
            } else {
              $("#edlabel0").addClass("d-none");
              $("#edcol0").addClass("d-none");
            }
          } else {
            $("#edlabel0").removeClass("d-none");
            $("#edcol0").removeClass("d-none");
          }
        }
      );

      $('input:checkbox[id="row_experience[if_current][1]"]').change(
        function () {
          if ($("#row_experience_current1").val() == 0) {
            if (
              $("#row_experience_current1").val() == 0 &&
              $("#row_experience_current0").val() == 1
            ) {
              $("#edlabel1").addClass("d-none");
              $("#edcol1").addClass("d-none");
              $("#edlabel0").removeClass("d-none");
              $("#edcol0").removeClass("d-none");
            } else {
              $("#edlabel1").addClass("d-none");
              $("#edcol1").addClass("d-none");
            }
          } else {
            $("#edlabel1").removeClass("d-none");
            $("#edcol1").removeClass("d-none");
          }
        }
      );
    } else {
      if (param.mode == "edit") {
        if ($("#row_experience_current0").val() == 1) {
          $("#mob_edlabel0").addClass("d-none");
          $("#mob_edcol0").addClass("d-none");
        } else {
          $("#mob_edlabel0").removeClass("d-none");
          $("#mob_edcol0").removeClass("d-none");
        }

        if ($("#row_experience_current1").val() == 1) {
          $("#mob_edlabel1").addClass("d-none");
          $("#mob_edcol1").addClass("d-none");
        } else {
          $("#mob_edlabel1").removeClass("d-none");
          $("#mob_edcol1").removeClass("d-none");
        }
      }

      $('input:checkbox[id="row_experience[if_current][0]"]').change(
        function () {
          if ($("#row_experience_current0").val() == 0) {
            if (
              $("#row_experience_current0").val() == 0 &&
              $("#row_experience_current1").val() == 1
            ) {
              $("#mob_edlabel0").addClass("d-none");
              $("#mob_edcol0").addClass("d-none");
              $("#mob_edlabel1").removeClass("d-none");
              $("#mob_edcol1").removeClass("d-none");
            } else {
              $("#mob_edlabel0").addClass("d-none");
              $("#mob_edcol0").addClass("d-none");
            }
          } else {
            $("#mob_edlabel0").removeClass("d-none");
            $("#mob_edcol0").removeClass("d-none");
          }
        }
      );

      $('input:checkbox[id="row_experience[if_current][1]"]').change(
        function () {
          if ($("#row_experience_current1").val() == 0) {
            if (
              $("#row_experience_current1").val() == 0 &&
              $("#row_experience_current0").val() == 1
            ) {
              $("#mob_edlabel1").addClass("d-none");
              $("#mob_edcol1").addClass("d-none");
              $("#mob_edlabel0").removeClass("d-none");
              $("#mob_edcol0").removeClass("d-none");
            } else {
              $("#mob_edlabel1").addClass("d-none");
              $("#mob_edcol1").addClass("d-none");
            }
          } else {
            $("#mob_edlabel1").removeClass("d-none");
            $("#mob_edcol1").removeClass("d-none");
          }
        }
      );
    }

    return html;
  } //end

  function load_skills_form(param) {
    var html = "";

    html += '<div class="card mb-2">';
    html += '<div class="card-body aivw-skillsbtn">';
    html += '<button type="button" class="close close-btn" aria-label="Close">';
    html += '<span aria-hidden="true" class="close-span">&times;</span>';
    html += "</button>";
    html += "</div>";
    html += '<div class="card-body aivw-skillscardbody">';

    html += '<div class="form-group row d-none">';
    html +=
      '<label class="col-1 col-form-label text-right align-self-center">Line <span class="text-danger fw-bolder">*</span></label>';
    html += '<div class="col-8 align-self-center">';
    html +=
      '<input readonly class="form-control form-control-sm" type="text" name="row_skills[line][]" maxlength="100"/>';
    html += "</div><!--./col-10-->";
    html += "</div><!--./form-group-->";

    html += '<div class="form-group row aivw-skillsrow">';
    html +=
      '<label class="col-1 col-form-label text-right align-self-center"><span class="text-danger fw-bolder">*</span></label>';
    html += '<div class="col-8 align-self-center">';
    html +=
      '<input class="form-control form-control-sm" type="text" name="row_skills[skills][]" maxlength="200"/>';
    html += "</div><!--./col-10-->";
    html += "</div><!--./form-group-->";
    html += "</div>";
    html += "</div>";
    return html;
  } //end

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
        '<input placeholder="MM/YYYY" class="form-control form-control-sm" type="text" value="' +
        todayStart +
        '" name="row_education[start_date][]"/>';
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
        '<input placeholder="MM/YYYY" class="form-control form-control-sm" type="text" value="' +
        todayEnd +
        '" name="row_education[end_date][]"/>';
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
        '<input placeholder="MM/YYYY" class="form-control form-control-sm" type="text" value="' +
        todayStart +
        '" name="row_education[start_date][]"/>';
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
        '<input placeholder="MM/YYYY" class="form-control form-control-sm" type="text" value="' +
        todayEnd +
        '" name="row_education[end_date][]"/>';
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
    html += '<div class="card-body aivw-skillsbtn">';
    html += '<button type="button" class="close close-btn" aria-label="Close">';
    html += '<span aria-hidden="true" class="close-span">&times;</span>';
    html += "</button>";
    html += "</div>";
    html += '<div class="card-body aivw-skillscardbody">';
    html += '<div class="form-group row d-none">';
    html +=
      '<label class="col-3 col-form-label text-right align-self-center">Line <span class="text-danger fw-bolder">*</span></label>';
    html += '<div class="col-8 align-self-center">';
    html +=
      '<input readonly class="form-control form-control-sm" type="text" name="row_language[line][]" maxlength="100"/>';
    html += "</div><!--./col-10-->";
    html += "</div><!--./form-group-->";

    html += '<div class="form-group row aivw-skillsrow">';
    html +=
      '<label class="col-1 col-form-label text-right align-self-center"><span class="text-danger fw-bolder">*</span></label>';
    html += '<div class="col-8 align-self-center">';
    html +=
      '<input class="form-control form-control-sm" type="text" name="row_language[language][]" maxlength="200"/>';
    html += "</div><!--./col-10-->";
    html += "</div><!--./form-group-->";

    html += "</div>";
    html += "</div>";
    return html;
  } //end

  function load_certification_form(param) {
    var html = "";

    html += '<div class="card mb-2">';
    html += '<div class="card-body aivw-skillsbtn">';
    html += '<button type="button" class="close close-btn" aria-label="Close">';
    html += '<span aria-hidden="true" class="close-span">&times;</span>';
    html += "</button>";
    html += "</div>";
    html += '<div class="card-body aivw-skillscardbody">';
    html += '<div class="form-group row d-none">';
    html +=
      '<label class="col-3 col-form-label text-right align-self-center">Line <span class="text-danger fw-bolder">*</span></label>';
    html += '<div class="col-8 align-self-center">';
    html +=
      '<input readonly class="form-control form-control-sm" type="text" name="row_certification[line][]" maxlength="100"/>';
    html += "</div><!--./col-10-->";
    html += "</div><!--./form-group-->";

    html += '<div class="form-group row">';
    html +=
      '<label class="col-lg-3 col-xl-3 col-auto col-form-label text-right align-self-center">Certification & License<span class="text-danger fw-bolder">*</span></label>';
    html += '<div class="col-lg-8 col-xl-8 col-auto align-self-center">';
    html +=
      '<input class="form-control form-control-sm" type="text" name="row_certification[certification][]" maxlength="200"/>';
    html += "</div><!--./col-10-->";
    html += "</div><!--./form-group-->";

    html += '<div class="form-group row">';
    html +=
      '<label class="col-lg-3 col-xl-3 col-auto col-form-label text-right align-self-center">Issued Date <span class="text-danger fw-bolder">*</span></label>';
    html += '<div class="col-lg-3 col-xl-3 col-auto align-self-center">';
    html += '<div class="input-group input-group-sm">';
    html +=
      '<input placeholder="M/YYYY" class="form-control form-control-sm" type="text" name="row_certification[issued_date][]"/>';
    html += '<div class="input-group-append">';
    html +=
      '<span class="input-group-text"><i class="fa fa-calendar"></i></span>';
    html += "</div><!--./input-group-append-->";
    html += "</div><!--./input-group input-group-sm-->";
    html += "</div><!--./col-->";

    html +=
      '<label class="col-lg-2 col-xl-2 col-auto col-form-label text-right align-self-center">Exp. Date</label>';
    html += '<div class="col-lg-3 col-xl-3 col-auto align-self-center">';
    html += '<div class="input-group input-group-sm date">';
    html +=
      '<input placeholder="M/YYYY" class="form-control form-control-sm" type="text" name="row_certification[expiration_date][]"/>';
    html += '<div class="input-group-append">';
    html +=
      '<span class="input-group-text"><i class="fa fa-calendar"></i></span>';
    html += "</div><!--./input-group-append-->";
    html += "</div><!--./input-group input-group-sm-->";
    html += "</div><!--./col-10-->";
    html += "</div><!--./form-group-->";

    html += '<div class="form-group row">';
    html +=
      '<label class="col-lg-3 col-xl-3 col-auto col-form-label text-right align-self-center">No Expiration</label>';
    html += '<div class="col-lg-3 col-xl-3 col-auto align-self-center">';
    html +=
      '<input type="checkbox" name="row_certification[no_expiration][]"/>';
    html += "</div><!--./col-10-->";
    html += "</div><!--./form-group-->";

    html += "</div>";
    html += "</div>";
    return html;
  } //end

  function load_projects_form(param) {
    var html = "";

    html += '<div class="card mb-2">';
    html += '<div class="card-body aivw-skillsbtn">';
    html += '<button type="button" class="close close-btn" aria-label="Close">';
    html += '<span aria-hidden="true" class="close-span">&times;</span>';
    html += "</button>";
    html += "</div>";
    html += '<div class="card-body aivw-skillscardbody">';
    html += '<div class="form-group row d-none">';
    html +=
      '<label class="col-3 col-form-label text-right align-self-center">Line <span class="text-danger fw-bolder">*</span></label>';
    html += '<div class="col-8 align-self-center">';
    html +=
      '<input readonly class="form-control form-control-sm" type="text" name="row_projects[line][]" maxlength="100"/>';
    html += "</div><!--./col-10-->";
    html += "</div><!--./form-group-->";

    html += '<div class="form-group row aivw-skillsrow">';
    html +=
      '<label class="col-1 col-form-label text-right align-self-center"><span class="text-danger fw-bolder">*</span></label>';
    html += '<div class="col-8 align-self-center">';
    html +=
      '<input class="form-control form-control-sm" type="text" name="row_projects[projects][]" maxlength="200"/>';
    html += "</div><!--./col-10-->";
    html += "</div><!--./form-group-->";
    html += "</div>";
    html += "</div>";
    return html;
  } //end

  function load_seminar_training_form(param) {
    var html = "";

    html += '<div class="card mb-2">';
    html += '<div class="card-body aivw-skillsbtn">';
    html += '<button type="button" class="close close-btn" aria-label="Close">';
    html += '<span aria-hidden="true" class="close-span">&times;</span>';
    html += "</button>";
    html += "</div>";
    html += '<div class="card-body aivw-skillscardbody">';
    html += '<div class="form-group row d-none">';
    html +=
      '<label class="col-3 col-form-label text-right align-self-center">Line <span class="text-danger fw-bolder">*</span></label>';
    html += '<div class="col-8 align-self-center">';
    html +=
      '<input readonly class="form-control form-control-sm" type="text" name="row_seminar_training[line][]" maxlength="100"/>';
    html += "</div><!--./col-10-->";
    html += "</div><!--./form-group-->";

    html += '<div class="form-group row aivw-skillsrow">';
    html +=
      '<label class="col-1 col-form-label text-right align-self-center"><span class="text-danger fw-bolder">*</span></label>';
    html += '<div class="col-8 align-self-center">';
    html +=
      '<input class="form-control form-control-sm" type="text" name="row_seminar_training[seminar_training][]" maxlength="200"/>';
    html += "</div><!--./col-10-->";
    html += "</div><!--./form-group-->";
    html += "</div>";
    html += "</div>";
    return html;
  } //end

  function load_awards_achievements_form(param) {
    var html = "";

    html += '<div class="card mb-2">';
    html += '<div class="card-body aivw-skillsbtn">';
    html += '<button type="button" class="close close-btn" aria-label="Close">';
    html += '<span aria-hidden="true" class="close-span">&times;</span>';
    html += "</button>";
    html += "</div>";
    html += '<div class="card-body aivw-skillscardbody">';
    html += '<div class="form-group row d-none">';
    html +=
      '<label class="col-3 col-form-label text-right align-self-center">Line <span class="text-danger fw-bolder">*</span></label>';
    html += '<div class="col-8 align-self-center">';
    html +=
      '<input readonly class="form-control form-control-sm" type="text" name="row_award_achievement[line][]" maxlength="100"/>';
    html += "</div><!--./col-10-->";
    html += "</div><!--./form-group-->";

    html += '<div class="form-group row aivw-skillsrow">';
    html +=
      '<label class="col-1 col-form-label text-right align-self-center"><span class="text-danger fw-bolder">*</span></label>';
    html += '<div class="col-8 align-self-center">';
    html +=
      '<input class="form-control form-control-sm" type="text" name="row_award_achievement[award_achievement][]" maxlength="200"/>';
    html += "</div><!--./col-10-->";
    html += "</div><!--./form-group-->";
    html += "</div>";
    html += "</div>";
    return html;
  } //end

  function load_affiliations_form(param) {
    var html = "";

    html += '<div class="card mb-2">';
    html += '<div class="card-body aivw-skillsbtn">';
    html += '<button type="button" class="close close-btn" aria-label="Close">';
    html += '<span aria-hidden="true" class="close-span">&times;</span>';
    html += "</button>";
    html += "</div>";
    html += '<div class="card-body aivw-skillscardbody">';
    html += '<div class="form-group row d-none">';
    html +=
      '<label class="col-3 col-form-label text-right align-self-center">Line <span class="text-danger fw-bolder">*</span></label>';
    html += '<div class="col-8 align-self-center">';
    html +=
      '<input readonly class="form-control form-control-sm" type="text" name="row_affiliation[line][]" maxlength="100"/>';
    html += "</div><!--./col-10-->";
    html += "</div><!--./form-group-->";

    html += '<div class="form-group row aivw-skillsrow">';
    html +=
      '<label class="col-1 col-form-label text-right align-self-center"><span class="text-danger fw-bolder">*</span></label>';
    html += '<div class="col-8 align-self-center">';
    html +=
      '<input class="form-control form-control-sm" type="text" name="row_affiliation[affiliation][]" maxlength="200"/>';
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
      '<label class="col-1 col-form-label text-right align-self-center"></label>';
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
      '<label class="col-1 col-form-label text-right align-self-center"></label>';
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
      '<label class="col-1 col-form-label text-right align-self-center"></label>';
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
      '<label class="col-1 col-form-label text-right align-self-center"></label>';
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
  //===============================================================================================================================
  //end form template
}); //End document.ready
