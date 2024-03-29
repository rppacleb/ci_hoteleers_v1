$(document).ready(function () {
  $("#side_menu").addClass("d-none");

  var homeurl = baseurl + "/job_search";
  var homeurl_txt = "job_search";
  var urlimgdef = baseurl + "/files/images/default/image.png";
  var urlimgnotfound = baseurl + "/assets/img/main/image-not-found.svg";
  var upload_path = baseurl + "/files/uploads/";
  // load_record(0,'signup','main_container','main_pagination','main_loader');

  //alert(moment('4/30/2016', 'MM/DD/YYYY').add(1, 'day'));
  $("#right-menu").removeClass("col-xl-9 col-lg-9");
  $("#right-menu").addClass("col-xl-11 col-lg-11");

  //Initialize date time picker
  $("input[name=header\\[start_date\\]]").datetimepicker({
    format: "M/D/YYYY",
    defaultDate: new Date(),
  });

  $("input[name=header\\[start_time\\]]").datetimepicker({
    format: "LT",
    defaultDate: new Date(),
  });

  $("input[name=header\\[end_date\\]]").datetimepicker({
    format: "M/D/YYYY",
    defaultDate: new Date(),
  });

  $("input[name=header\\[end_time\\]]").datetimepicker({
    format: "LT",
    defaultDate: new Date(),
  });

  //rich text editor
  var job_description = $(
    "#frm_data_entry textarea[name=header\\[job_description\\]]"
  ).jqte({
    // b: false,
    br: false,
    //center: false,
    color: false,
    fsize: false,
    format: false,
    // i: false,
    // indent: false,
    link: false,
    // left: false,
    // outdent: false,
    //remove: false,
    //right: false,
    rule: false,
    sub: false,
    sup: false,
    strike: false,
    // u: false,
    unlink: false,
    source: false,
  });

  var qualification = $(
    "#frm_data_entry textarea.texteditor[name=header\\[qualification\\]]"
  ).jqte({
    // b: false,
    br: false,
    //center: false,
    color: false,
    fsize: false,
    format: false,
    // i: false,
    // indent: false,
    link: false,
    // left: false,
    // outdent: false,
    //remove: false,
    //right: false,
    rule: false,
    sub: false,
    sup: false,
    strike: false,
    // u: false,
    unlink: false,
    source: false,
  });

  //end rich text editor

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

  if (notification_id !== "") {
    const param = {
      id: notification_id,
    }; //end

    seen_notification(param, function (data) {});
  } //end if

  function seen_notification(param, callback) {
    var url = baseurl + "/account_management/update_viewed";
    $.ajax({
      url: url,
      type: "POST",
      dataType: "JSON",
      data: param,
      beforeSend: function () {},
    })
      .done(function (data) {
        callback(data);
      })
      .fail(function (e) {
        //$('#loading').hide();
        callback();
      })
      .always(function (e) {});
  } //end function

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

  //report job post
  $(document.body).on("click", "button[name=btn_report]", function (e) {
    var view_url = homeurl + "/private/view/";

    var id = $(this).attr("aria-id");
    var btn = $(this);
    var btn_text = "";

    var type_text = "";

    var url = homeurl;
    url = homeurl + "/report_job_post";
    var url_view = homeurl + "/view";

    var frm_id = "";

    var data = {};
    data.header = {};
    data.header.id = id;

    btn_text = "Submit";

    if (confirm("Are you sure you want to report this job post?")) {
      $.ajax({
        url: url,
        type: "POST",
        data: $("#frm_report").serialize(),
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
  //end report job post

  //add favorites
  $(document.body).on("click", "button.btn_add_fav", function (e) {
    var view_url = homeurl + "/private/view/";

    var id = $(this).attr("aria-id");
    var saved = favorites;
    var btn = $(this);
    var btn_text = "";

    var type_text = "";

    var url = homeurl;
    url = homeurl + "/add_fav";
    var url_view = homeurl + "/view";

    var frm_id = "";

    var data = {};
    data.header = {};
    data.header.id = id;

    btn_text = '<i class="fa fa-heart"></i>';

    // Partial Notification message for saving/unsaving a Job Post.
    var msg_txt = "Added to ";

    if (parseInt(saved)) {
      msg_txt = "Removed from ";
    } //end if

    //if(confirm("Are you sure you want to "+msg_txt+" this job?")){

    $.ajax({
      url: url,
      type: "POST",
      data: $("#frm_data_entry").serialize(),
      dataType: "JSON",
      beforeSend: function () {
        $(".outside_button *").css("pointer-events", "none");
        //btn.text('Processing...');
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

          msg_html = msg_txt + msg_html;

          $.notify(msg_html, {
            position: "top center",
            className: "success",
            arrowShow: true,
          });

          view_url += data.data.id;
          setTimeout(function () {
            window.location.replace(view_url);
            //btn.text(btn_text);
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
              msg_html += data.messages[i][element] + "\n";
            } //end for
          } //End for

          $.notify(msg_html, {
            position: "top center",
            className: "error",
            arrowShow: true,
          });

          //btn.text(btn_text);
          btn.removeAttr("disabled");
          $(".outside_button *").css("pointer-events", "auto");
        }
      })
      .fail(function (e) {
        alert(e.responseText);

        //btn.text(btn_text);
        btn.removeAttr("disabled");
        $(".outside_button *").css("pointer-events", "auto");
      })
      .always(function (e) {});
    //}//end if
  }); //end if
  //end add favorites

  //approve
  $(document.body).on("click", "button.btn_submit", function (e) {
    var view_url = homeurl + "/private/view/";
    var redirect_url =
      baseurl + "/applicant_info/edit/" + profile_id + "?info=1";
    //var redirect_url = baseurl + '/home';

    var id = $(this).attr("aria-id");
    var btn = $(this);
    var btn_text = "";

    var type_text = "";

    var url = homeurl;
    url = homeurl + "/submit_data";
    var url_view = homeurl + "/view";

    var frm_id = "";

    var data = {};
    data.header = {};
    data.header.id = id;

    btn_text = "Applied";
    btn_text_error = "Apply";

    //if(confirm("Are you sure you want to apply?")){
    var req_param = $("#frm_data_entry").serialize();

    if (notification_id !== null && notification_id !== "") {
      req_param += "&notification_id=" + notification_id;
    } //end if

    $.ajax({
      url: url,
      type: "POST",
      data: req_param,
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

          /*$.notify(msg_html,{ 
                            position:"top center",
                            className:"success",
                            arrowShow : true
                        });*/

          btn.text(btn_text);
          btn.removeAttr("disabled");

          $("#application_modal").modal("show");
        } else {
          if (data.redirect !== undefined) {
            window.location.replace(data.redirect_url);
          } //end if

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

          btn.text(btn_text_error);
          btn.removeAttr("disabled");
          $(".outside_button *").css("pointer-events", "auto");
        }
      })
      .fail(function (e) {
        alert(e.responseText);

        btn.text(btn_text_error);
        btn.removeAttr("disabled");
        $(".outside_button *").css("pointer-events", "auto");
      })
      .always(function (e) {});
    //}//end if
  }); //end if
  //end approve

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

  //=====================================================================================================================
  //end events

  //sourcing
  //=======================================================================================================================
  //load data
  function load_data(param) {
    var url = homeurl + "/load_data/" + param.id;
    var btn = $(".btn_submit");
    var btn_text = "Apply";

    if (applied) {
      btn_text = "Applied";
    } //end if

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
        if (response.data !== null) {
          var data = response.data[0];

          if (param.mode == "edit" || param.mode == "view") {
            //view and edit mode
            //----------------------------------------------------------------------------------------------------
            //side
            $("h6[id=header\\[job_title\\]]").html(data.job_title);
            $("p[id=header\\[company_name\\]]").html(
              '<a href="' +
                baseurl +
                "/company_info_public/view/" +
                data.id +
                '" class="text-link text-decoration-none">' +
                data.company_name +
                "</a>"
            );
            $("p[id=header\\[recruiter\\]]").html(
              '<small class="text-muted">Recruiter was active ' +
                data.recruiter +
                "</small>"
            );

            $("input[name=placeholder\\[report_modal_job_title\\]]").val(
              data.job_title
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

            //end side

            //primary info
            $("#frm_data_entry input[name=header\\[date_created\\]]").val(
              data.date_created
            );
            $(
              "#frm_data_entry input[name=header\\[job_expiration_date\\]]"
            ).val(data.job_expiration_date);
            //end primary

            //secondary
            $("#frm_data_entry input[name=header\\[job_title\\]]").val(
              data.job_title
            );
            $("#frm_data_entry input[id=header\\[job_level_text\\]]").val(
              data.job_level_text
            );
            $("#frm_data_entry input[id=header\\[job_type_text\\]]").val(
              data.job_type_text
            );
            //$('#frm_data_entry textarea[name=header\\[job_description\\]]').val(data.job_description);

            //$('#frm_data_entry textarea[name=placeholder\\[job_description\\]]').val(data.job_description);

            //job_description.jqteVal(data.job_description);
            $(
              "#frm_data_entry div[name=placeholder\\[job_description\\]]"
            ).html(data.job_description);
            $("#frm_data_entry div[name=placeholder\\[qualification\\]]").html(
              data.qualification
            );

            //alert(data.job_description)

            //alert(data.job_description);

            // var str = data.job_description;
            // var rows = str.split(/\r\n|\r|\n/).length;
            //     rows *= 3.5;

            // $('#frm_data_entry textarea[name=header\\[job_description\\]]').attr('rows',rows);

            //$('#frm_data_entry textarea[name=header\\[qualification\\]]').val(data.qualification);

            //qualification.jqteVal(data.qualification);

            if (param.mode == "view") {
              //$('.texteditor').jqte();

              $(".jqte").css({
                margin: "0",
                border: "none",
                overflow: "auto",
              });
              $(".jqte_editor").css("resize", "none");

              $(".jqte_toolbar").remove();
              $(".jqte_editor").attr("contenteditable", false);
            } //END IF

            // var str = data.qualification;
            // var rows = str.split(/\r\n|\r|\n/).length;
            //     rows *= 3.5;
            // $('#frm_data_entry textarea[name=header\\[qualification\\]]').attr('rows',rows);

            data.salary_from = toCurrency(data.salary_from);
            data.salary_to = toCurrency(data.salary_to);

            if (data.salary_from <= 0 && data.salary_to <= 0) {
              $("#frm_data_entry input[name=header\\[salary_type\\]]").val("");

              $("#frm_data_entry input[name=header\\[salary\\]]").val("");
            } else {
              console.log(data.salary_type);
              $("#frm_data_entry input[name=header\\[salary_type\\]]").val(
                data.salary_type === "monthly"
                  ? "Per Month"
                  : `${data.salary_type
                      .charAt(0)
                      .toUpperCase()} ${data.salary_type.slice(1)}`
              );
              $("#frm_data_entry input[name=header\\[salary\\]]").val(
                data.salary_currency +
                  " " +
                  data.salary_from +
                  " - " +
                  data.salary_currency +
                  " " +
                  data.salary_to
              );
            }

            $("#frm_data_entry input[name=header\\[location\\]]").val(
              data.location
            );

            $("#frm_data_entry input[name=header\\[country\\]]").val(
              data.country
            );

            var p_b_html = "";
            var perks_and_benefits2 = JSON.parse(data.perks_and_benefits);
            for (var key in perks_and_benefits2) {
              for (var key2 in perks_and_benefits) {
                //alert($(this).val());
                if (perks_and_benefits2[key] == perks_and_benefits[key2].id) {
                  //$(this).prop('checked',true);
                  p_b_html +=
                    '<div class="col mb-2" style="font-size: 0.875rem;">';
                  p_b_html += perks_and_benefits[key2].name;
                  p_b_html += "</div>";
                  break;
                } //end if
              } //end for
            } //end for
            //end secondary

            //last
            $("#frm_data_entry input[id=header\\[industry_text\\]]").val(
              data.industry_text
            );
            $("#frm_data_entry input[id=header\\[department_text\\]]").val(
              data.department_text
            );
            $("#frm_data_entry input[id=header\\[education_text\\]]").val(
              data.education_text
            );
            $("#frm_data_entry input[name=header\\[vacancies\\]]").val(
              data.vacancies
            );
            $("#frm_data_entry input[name=header\\[about\\]]").val(data.about);
            // var str = data.about;
            // var rows = str.split(/\r\n|\r|\n/).length;
            // rows += 8;
            // $('#frm_data_entry textarea[name=header\\[about\\]]').attr('rows',rows);

            $("#frm_data_entry input[name=header\\[website\\]]").val(
              data.website
            );
            $("#frm_data_entry input[name=header\\[website\\]]").addClass(
              "d-none"
            );
            $("#frm_data_entry a[name=placeholder\\[website\\]]").removeClass(
              "d-none"
            );
            $("#frm_data_entry a[name=placeholder\\[website\\]]").text(
              data.website
            );

            data.website = data.website.replace(/https:\/\//g, "");
            data.website = data.website.replace(/http:\/\//g, "");
            $("a[name=placeholder\\[website\\]]").attr(
              "href",
              "https://" + data.website
            );
            //end last

            $("#p_b_content_desktop").html(p_b_html);
            $("#p_b_content_mobile").html(p_b_html);

            $("#frm_data_entry input[name=header\\[doc_image\\]]").val(
              data.doc_image
            );
            $("#frm_data_entry input[name=file\\[old_doc_image\\]]").val(
              data.doc_image
            );
            $("#frm_data_entry input[name=header\\[company_name\\]]").val(
              data.company_name
            );

            $("#frm_data_entry textarea[name=header\\[about\\]]").val(
              data.about
            );
            $("#frm_data_entry input[name=header\\[website\\]]").val(
              data.website
            );
            $("#frm_data_entry select[name=header\\[dial_code\\]]").val(
              data.dial_code
            );
            $("#frm_data_entry input[name=header\\[contact_number\\]]").val(
              data.contact_number
            );

            $("#frm_data_entry input[name=header\\[start_date\\]]").val(
              data.start_date
            );
            $("#frm_data_entry input[name=header\\[start_time\\]]").val(
              data.start_time
            );
            $("#frm_data_entry input[name=header\\[end_date\\]]").val(
              data.end_date
            );
            $("#frm_data_entry input[name=header\\[end_time\\]]").val(
              data.end_time
            );
            $("#frm_data_entry textarea[name=header\\[other_notes\\]]").val(
              data.other_notes
            );

            $("#frm_data_entry input[name=header\\[industry\\]]").val(
              data.industry
            );

            //populate lines
            var html = "";
            var data_lines = response.data;
            for (var key in data_lines) {
              var src = "";
              if (
                data_lines[key].line_doc_image === null ||
                data_lines[key].line_doc_image == ""
              ) {
                continue;
                src = urlimgdef;
              } else {
                src = upload_path + data_lines[key].line_doc_image;
              } //end if

              if (!image.imageExists(src)) {
                src = urlimgnotfound;
              } //end if

              html += '<div class="col mb-3">';

              if ($(window).width() <= 480) {
                html +=
                  '<img src="' +
                  src +
                  '" class="img-fluid rounded" style="width: 310px; height: 240px;">';
              } else {
                html +=
                  '<img src="' +
                  src +
                  '" class="img-fluid rounded" style="width:200px;height:150px;">';
              }

              html += "</div><!--./col-->";
            } //end for

            $("#image_cont_desktop").html(html);
            $("#image_cont_mobile").html(html);
            autosize($(".jsvw-textarea"));

            if (window.location.href.indexOf("view") >= 0) {
              if (
                $("#image_cont_mobile").html() === "" &&
                $("#image_cont_desktop").html() === ""
              ) {
                $(".jsvw-companyimglabel").addClass("d-none");
              }

              if ($(window).width() <= 480) {
                $(".desktop-jsvwjobdescrow").addClass("d-none");
                $(".mobile-jsvwjobdescrow").removeClass("d-none");
              } else {
                $(".desktop-jsvwjobdescrow").removeClass("d-none");
                $(".mobile-jsvwjobdescrow").addClass("d-none");
              }
            }

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
              "#frm_data_entry input:not([readonly]),#frm_data_entry textarea:not([readonly]),select,button"
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
            //$('#frm_data_entry button.'+param.mode+', input.'+param.mode+',textarea.'+param.mode+',select.'+param.mode+'').addClass('form-control-plaintext');
            $(
              "#frm_data_entry button." +
                param.mode +
                ", input." +
                param.mode +
                ":not([type=checkbox]),textarea." +
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
            $("#frm_data_entry button").addClass("d-none");

            //$('.btn_submit').addClass('d-none');
          } //end if

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

        $("#loading").hide();
      })
      .fail(function (e) {
        alert(e.responseText);
        btn.html(btn_text);

        $("#loading").hide();
      })
      .always(function (e) {});
  } //end load_record
  //=======================================================================================================================
  //end load data

  //autocomplete
  //===============================================================================================================================
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

  //copy link trigger
  $(document.body).on("click", "button[name=btn_copy_link]", function (e) {
    navigator.clipboard.writeText(window.location.href);
    $.notify("Link copied!", {
      position: "top center",
      className: "success",
      arrowShow: true,
    });
  });
  //end copy link trigger

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
        btn.html(
          '<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Processing...'
        );
        btn.attr("disabled", "disabled");
      },
    })
      .done(function (data) {
        if (data.success === true) {
          var file = data.data.file[0];

          setTimeout(function () {
            btn.html("Upload Image");
            btn.removeAttr("disabled");
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
          }, 2000);
        }
      })
      .fail(function (data) {
        alert(JSON.stringify(data));
        //setTimeout(function(){

        //$('#uploadErrorCont').html(data.responseText)
        btn.html("Upload Image");
        btn.removeAttr("disabled");
        //},2000)
      })
      .always(function (e) {});
  }
  //End upload image

  //upload image multiple
  function upload_image_multiple() {
    var url = homeurl + "/do_upload_multiple";
    var btn = $("button[name=btn_upload_multiple]");
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
        btn.html(
          '<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Processing...'
        );
        btn.attr("disabled", "disabled");
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
            btn.html("Upload Image");
            btn.removeAttr("disabled");
            var total_files = catchIsNaN(
              $("input[name=file\\[total_files\\]]").val()
            );
            var total_size = catchIsNaN(
              $("input[name=file\\[total_uploaded_file\\]]").val()
            );

            var ctr =
              $("input[name=row\\[line\\]\\[\\]]:last").val() === undefined
                ? 1
                : parseInt($("input[name=row\\[line\\]\\[\\]]:last").val()) + 1;
            for (var key in files) {
              var file = files[key];
              html += '<div class="col mb-3">';
              html +=
                '<button aria-line="' +
                ctr +
                '" type="button" class="close remove" aria-label="Close">';
              html +=
                '<span aria-hidden="true" class="text-danger">&times;</span>';
              html += "</button>";
              html +=
                '<img src="data:image/jpeg;base64,' +
                file.file +
                '" class="img-fluid rounded" style="width:200px;height:150px;">';

              html += "</div><!--./col-->";

              html_form += '<div class="col mb-3 remove-' + ctr + ' d-none">';

              html_form +=
                '<input readonly name="row[line][]" value="' +
                ctr +
                '" class="form-control form-control-sm" />';
              html_form +=
                '<input readonly name="row[doc_image][]" value="' +
                file.file_attr.name +
                '" class="form-control form-control-sm" />';
              html_form +=
                '<input readonly name="row[file_size][]" value="' +
                file.file_attr.file_size +
                '" class="form-control form-control-sm" />';
              html_form +=
                '<input readonly name="row[doc_content][]" value="' +
                file.file +
                '" class="form-control form-control-sm" />';

              html_form += "</div><!--./col-->";

              total_size += parseFloat(file.file_attr.file_size);

              total_files += 1;
              ctr += 1;
              //console.log(file['file_attr'].name) + '<br/>';
            } //end for

            $("#image_cont").append(html);
            $("#image_cont_form").append(html_form);

            total_size = 0;
            $("input[name=row\\[file_size\\]\\[\\]]").each(function () {
              total_size += catchIsNaN($(this).val());
            });

            $("input[name=file\\[total_uploaded_file\\]]").val(
              total_size.toFixed(2)
            );

            $("input[name=file\\[total_files\\]]").val(
              $("input[name=row\\[line\\]\\[\\]]").length
            );
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
          }, 2000);
        }
      })
      .fail(function (data) {
        alert(JSON.stringify(data));
        //setTimeout(function(){

        //$('#uploadErrorCont').html(data.responseText)
        btn.html("Upload Image");
        btn.removeAttr("disabled");
        //},2000)
      })
      .always(function (e) {});
  }
  //End upload image

  //===============================================================================================================================
  //End upload image
}); //End document.ready
