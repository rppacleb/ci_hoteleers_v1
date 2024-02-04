$(document).ready(function () {
  $("#side_menu").addClass("d-none");
  $("#right-menu").removeClass("col-xl-9 col-lg-9");
  $("#right-menu").addClass("col-xl-12 col-lg-12");

  if ($(window).width() >= 1441) {
    $(".container-fluid").css({ "max-width": "1440px" });
  } else if ($(window).width() >= 1360 && $(window).width() <= 1440) {
    $(".container-fluid").css({ "max-width": "1350px" });
  } else if ($(window).width() >= 1200 && $(window).width() <= 1359) {
    $(".container-fluid").css({ "max-width": "1200px" });
  }

  $(".cipvw-withsel").contents(":not(input)").remove();

  var homeurl = baseurl + "/company_info_public";
  var homeurl_txt = "company_info_public";
  var urlimgdef = baseurl + "/files/images/default/image.png";
  var upload_path = baseurl + "/files/uploads/";
  var dropdown_loaded = 0;
  // load_record(0,'signup','main_container','main_pagination','main_loader');

  //alert(moment('4/30/2016', 'MM/DD/YYYY').add(1, 'day'));

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
  $(document.body).on("click", "li.page-item", function (e) {
    var page = $(this).attr("aria-page");
    var type = $(this).parent().attr("aria-type");

    if (page == "next") {
      var total_page = $(this).attr("aria-total_page");
      var current_page = parseInt($(this).attr("aria-current_page")) + 1;
      var param = {};
      param.total_page = total_page;
      param.page = current_page;
      param.pagination = type + "_pagination";
      load_pagination(param);
    } else if (page == "prev") {
      var total_page = $(this).attr("aria-total_page");
      var current_page = parseInt($(this).attr("aria-current_page")) - 1;

      var param = {};
      param.total_page = total_page;
      param.page = current_page;
      param.pagination = type + "_pagination";
      load_pagination(param);
    } else {
      $("." + type + "_pagination > li.page-item").removeClass("active");
      $(this).addClass("active");
      load_active_job_posts(
        page,
        "company_info_public",
        type + "_container",
        type + "_pagination",
        type + "_loader"
      );
    }
  });
  //end pagination button

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

    var data = {};
    data.header = {};
    data.header.id = id;
    data.header.status = type;
    data.header.username = $(this).attr("aria-username");

    btn_text = "Submit";

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

  //add favorites
  $(document.body).on("click", "button.btn_add_fav", function (e) {
    var joburl = baseurl + "/job_search";
    var view_url = homeurl + "/private";

    var id = $(this).attr("aria-id");
    var saved = $(this).attr("aria-saved");
    var btn = $(this);
    var btn_text = "";

    var type_text = "";

    var url = joburl;
    url = joburl + "/add_fav/list";

    var frm_id = "";

    var data = {};
    data.header = {};
    data.placeholder = {};
    data.header.id = id;
    data.placeholder.saved = saved;

    btn_text = '<i class="fa fa-heart"></i>';

    var basic_btn = "btn-pill-hover-link btn-pill-lg text-link";
    var saved_btn = "btn-pill-hover-primary btn-pill-lg text-primary";

    var basic_logo = '<i class="fa fa-heart-o"></i>';
    var saved_logo = '<i class="fa fa-heart"></i>';

    var msg_txt = "save";

    if (parseInt(saved)) {
      msg_txt = "unsave";
    } //end if

    //if(confirm("Are you sure you want to "+msg_txt+" this job?")){

    $.ajax({
      url: url,
      type: "POST",
      data: data,
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

          $.notify(msg_html, {
            position: "top center",
            className: "success",
            arrowShow: true,
          });

          //setTimeout(function(){
          //window.location.replace(view_url);;
          //btn.text(btn_text);

          btn.removeAttr("disabled");
          if (parseInt(saved)) {
            btn.attr("aria-saved", 0);
            btn.removeClass(saved_btn);
            btn.addClass(basic_btn);
            btn.html(basic_logo);
          } else {
            btn.attr("aria-saved", 1);
            btn.removeClass(basic_btn);
            btn.addClass(saved_btn);
            btn.html(saved_logo);
          } //end if

          //},2000)

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
  });
  //end add favorites

  //=====================================================================================================================
  //end events

  //sourcing
  //=======================================================================================================================
  //load data
  function load_data(param) {
    var url = homeurl + "/load_data/" + param.id + "?employer=" + employer_id;
    var btn = $(".btn_submit");
    var btn_text = "Submit";
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
          if (dropdown_loaded == 0) {
            load_filter_dropdowns();
          } //end if

          var data = response.data[0];

          if (param.mode == "edit" || param.mode == "view") {
            //view and edit mode
            //----------------------------------------------------------------------------------------------------
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
            var website = $(
              "#frm_data_entry input[name=header\\[website\\]]"
            ).val();
            $(".cipw-website").html(
              "<a href=" +
                website +
                ' target="_blank" class="cipw-websiteval text-link">' +
                website +
                "</a>"
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

            $("h6[id=header\\[company_name\\]]").html(data.company_name);
            $("#frm_data_entry input[id=search_location]").val(data.location);

            $("p[id=header\\[location\\]]").html(
              '<small class="text-muted">' + data.location + "</small>"
            );

            //$('#frm_data_entry textarea[name=header\\[location\\]]').val(data.location);
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
            $("#frm_data_entry select[name=header\\[industry\\]]").multiselect(
              "select",
              data.industry
            );
            $("#frm_data_entry input[name=placeholder\\[industry\\]]").val(
              data.industry_text
            );
            //$('#frm_data_entry input[name=header\\[industry\\]]').val(data.industry);
            //$('#frm_data_entry input[id=header\\[industry_text\\]]').val(data.industry_text);

            $("p[id=header\\[date_created\\]]").html(
              '<small class="text-muted">Joined ' +
                data.joined_date +
                "</small>"
            );

            if (data.doc_image === null || data.doc_image == "") {
              $("img[id=header\\[company_logo\\]]").attr("src", urlimgdef);
            } else {
              $("img[id=header\\[company_logo\\]]").attr(
                "src",
                upload_path + data.doc_image
              );
            } //end if

            //populate lines
            var html = "";
            var html_form = "";
            var total_size = 0;
            var total_files = 0;
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
              total_files += 1;
              total_size += catchIsNaN(data_lines[key]["line_file_size"]);

              // html += '<div class="col-3 mb-3">';
              html += '<div class="col mb-3">';

              html +=
                '<button aria-line="' +
                data_lines[key]["line"] +
                '" type="button" class="close remove to_hide" aria-label="Close">';
              html +=
                '<span aria-hidden="true" class="text-danger">&times;</span>';
              html += "</button>";

              // html += '<img src="'+src+'" class="img-fluid rounded" style="width:279px;height:209px">';
              html +=
                '<img src="' +
                src +
                '" class="img-fluid rounded" style="width:200px;height:150px">';
              html += "</div><!--./col-->";

              html_form +=
                '<div class="col mb-3 remove-' +
                data_lines[key]["line"] +
                ' d-none">';
              html_form +=
                '<input readonly name="row[line][]" value="' +
                data_lines[key]["line"] +
                '" class="form-control form-control-sm" />';
              html_form +=
                '<input readonly name="row[doc_image][]" value="' +
                data_lines[key]["line_doc_image"] +
                '" class="form-control form-control-sm" />';
              html_form +=
                '<input readonly name="row[file_size][]" value="' +
                data_lines[key]["line_file_size"] +
                '" class="form-control form-control-sm" />';
              html_form +=
                '<input readonly name="row[doc_content][]" value="" class="form-control form-control-sm" />';
              html_form += "</div><!--./col-->";
            } //end for

            $("input[name=file\\[total_uploaded_file\\]]").val(
              total_size.toFixed(2)
            );
            $("input[name=file\\[total_files\\]]").val(total_files);

            $("#image_cont").append(html);
            $("#image_cont_form").append(html_form);

            autosize($(".cipvw-textarea"));

            if (window.location.href.indexOf("view") >= 0) {
              if ($("#image_cont").html() === "") {
                $(".cipw-companyimglabel").addClass("d-none");
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
            $("#frm_data_entry button").addClass("d-none");

            $(".btn_submit").addClass("d-none");

            //custom can be omitted
            $("#frm_data_entry input#search_location")
              .parent()
              .parent()
              .addClass("d-none");
            $("#frm_data_entry textarea[name=header\\[location\\]]")
              .parent()
              .parent()
              .removeClass("d-none");
            $("#frm_data_entry textarea[name=header\\[location\\]]").addClass(
              "form-control-plaintext"
            );
            $(
              "#frm_data_entry textarea[name=header\\[location\\]]"
            ).removeClass("form-control");
          } //end if

          btn.html(btn_text);
          $(".outside_button *").css("pointer-events", "auto");
        } else {
          window.location.replace(baseurl + "/home");
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

        load_active_job_posts(
          0,
          "company_info_public",
          "main_container",
          "main_pagination",
          "main_loader"
        );

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

  // Load Active Job Posts
  function load_active_job_posts(page, type, container, pagination, loader) {
    var joburl = baseurl + "/job_search";
    var edit_url = homeurl + "/private/edit/";
    var view_url = joburl + "/private/view/";
    var user_url = baseurl + "/user";
    var not_loggedin = baseurl + "/login?type=job_search&rdr_id=";
    var logo_url = baseurl + "/company_info_public/view/";

    var data = {};
    data.page = page;
    data.sort = "";
    data.keyword = $(
      "#frm_data_entry input[name=header\\[company_name\\]]"
    ).val();
    data.user_id = user_id;

    var url = baseurl + "/get/job_search/" + type;
    $.ajax({
      url: url,
      type: "POST",
      data: data,
      dataType: "JSON",
      beforeSend: function () {
        $("#" + loader + "").html(
          '<div class="col-2"></div><div class="col text-center"><div class="spinner-grow text-muted"></div><div class="col-2"></div></div>'
        );
      },
    })
      .done(function (data) {
        if (data.data !== null) {
          $("#" + container + "").empty();
          $("#" + loader + "").empty();

          var start_page = 1;
          var end_page = data.per_page;
          if (page > 0) {
            start_page =
              (page - 1) * data.per_page <= 0
                ? 1
                : (page - 1) * data.per_page + 1;
            end_page = page * data.per_page;
          } //end if

          if (end_page > data.total_result) {
            end_page = data.total_result;
          } //end if

          $.each(data.data, function (key, value) {
            var html = "";

            var img_src = "";
            if (value.doc_image === null || value.doc_image == "") {
              img_src = urlimgdef;
            } else {
              img_src = upload_path + value.doc_image;
            } //end if

            if ($(window).width() <= 480) {
              html +=
                '<div class="col-12 mb-4" style="min-width:2.5in; margin-left: auto; margin-right: auto;" >';
              html += '<div class="card mb-3" style="min-height:4.2in;">';
              // if ($(window).width() <= 480 && $(window).width() >= 376) {
              //     html += '<img onClick="window.open(\''+logo_url+value.employer+'\')" style="height:330px; padding: 0.75rem;" class="card-img-top"';
              // } else if ($(window).width() <= 375) {
              //     html += '<img onClick="window.open(\''+logo_url+value.employer+'\')" style="height:290px; padding: 0.75rem;" class="card-img-top"';
              // }

              //     html += 'src="'+img_src+'" alt="'+value.company_name+'" title="'+value.company_name+'">';
              html += '<div class="card-body">';

              var job_title_placeholder = value.job_title.substring(0, 45);
              var job_title_placeholder_length = value.job_title.length;

              if (job_title_placeholder_length > 45) {
                job_title_placeholder = job_title_placeholder + "...";
              }
              html +=
                '<a href="' +
                view_url +
                value.id +
                '" style="text-decoration:none;"><h6 class="card-title text-link">' +
                job_title_placeholder +
                "</h6></a>";

              var company_placeholder = value.company_name.substring(0, 45);
              var company_placeholder_length = value.company_name.length;

              html += '<div class="mb-0">';
              if (company_placeholder_length > 45) {
                company_placeholder = company_placeholder + "...";
              }
              html +=
                '<small class="text-muted" style="font-size:9pt !important"><b>' +
                company_placeholder +
                "</b></small>";

              html += "</div>";
              html += '<div class="mb-0">';
              html +=
                '<small class="text-muted" style="font-size:9pt !important"><b>' +
                value.location_placeholder +
                "</b></small>";
              html += "</div>";

              if (parseInt(value.applied)) {
                html += '<div class="row mb-0">';
                html += "<div>";
                html +=
                  '<small style="background-color:#FFD580;padding:4px;border-radius:4px;font-size:8pt !important;">Applied</small>';
                html += "</div>";
                html += "</div>";
              }

              html += '<div class="row mb-1">';
              html += '<div class="col">';
              html += "<div>";
              html +=
                '<small class="text-muted text-left" style="font-size:8pt !important">Apply Before ' +
                value.job_expiration_date +
                "</small>";
              html += "</div>";
              html += "</div>";
              html += "</div>";

              html += '<div class="row mb-1">';
              html += '<div class="col">';
              html += "<div>";
              html +=
                '<small class="text-muted text-left" style="font-size:8pt !important">' +
                value.job_type_text +
                "</small>";
              html += "</div>";
              html += "</div>";
              html += "</div>";

              html += "</div>";
              html += '<div class="card-footer bg-transparent border-0">';
              html += '<div class="row mb-2">';
              html += '<div class="col align-self-center">';

              var btn_attr = "btn-pill-hover-link btn-pill-lg text-link";
              var logo = '<i class="fa fa-heart-o"></i>';
              if (parseInt(value.saved)) {
                btn_attr = "btn-pill-hover-primary btn-pill-lg text-primary";
                logo = '<i class="fa fa-heart"></i>';
              } //end if
              if (user_id !== 0) {
                html +=
                  '<button class="mr-3 btn ' +
                  btn_attr +
                  ' btn_add_fav" aria-saved="' +
                  parseInt(value.saved) +
                  '" aria-id="' +
                  value.id +
                  '">' +
                  logo +
                  "</button>";
              } else {
                html +=
                  '<a href="' +
                  not_loggedin +
                  value.id +
                  '" class="mr-3 btn ' +
                  btn_attr +
                  '" aria-saved="' +
                  parseInt(value.saved) +
                  '" aria-id="' +
                  value.id +
                  '">' +
                  logo +
                  "</a>";
              } //end if

              html += "</div>";

              html += '<div class="col align-self-center">';
              html += '<div class="text-right">';

              //alert(user_id)

              html +=
                '<a href="' +
                view_url +
                value.id +
                '" class="btn btn-pill-sm btn-pill-outline-link text-link btn_view">View</a>';

              html += "</div>";
              html += "</div>";
              html += "</div>";
              html += "</div>";
              html += "</div>";
              html += "</div>";

              $("#" + container + "").append(html);
            } else {
              // html += '<div class="row mb-2" style="min-width:2.5in; max-width:5.5in; margin-right: auto;">';
              html +=
                '<div class="col-6"style="min-width:2.5in; max-width:5.5in;">';
              html +=
                '<div class="card flex-row mb-2"style="min-height:2.5in;">';
              // html += '<img onClick="window.open(\''+logo_url+value.employer+'\')" src="'+img_src+'" class="card-img-top col-4 js-cardimg " style="height:300px; padding: 0.75rem;" class="card-img-top" />';
              html += '<div class="card-body">';
              //html += '<h6 class="card-title text-muted">'+value.company_name+'</h6>';

              var job_title_placeholder = value.job_title.substring(0, 13);
              var job_title_placeholder_length = value.job_title.length;

              if (job_title_placeholder_length > 13) {
                job_title_placeholder = job_title_placeholder + "...";
              } //end if

              var company_placeholder = value.company_name.substring(0, 26);
              var company_placeholder_length = value.company_name.length;

              if (company_placeholder_length > 26) {
                company_placeholder = company_placeholder + "...";
              } //end if

              if (parseInt(value.applied)) {
                html += '<div class="row">';
                html += '<div class="col-9">';
                html +=
                  '<h6><a class="card-title text-link text-decoration-none card-link" style="font-weight:bold" href="' +
                  view_url +
                  value.id +
                  '">' +
                  value.job_title +
                  "</a></h6>";
                html += "</div>";
                html += '<div class="col-3">';
                html += '<div class="text-right">';
                html +=
                  '<small style="background-color:#FFD580;padding:4px;border-radius:4px;">Applied</small>';
                html += "</div>";
                html += "</div>";
                html += "</div>";
              } else {
                html +=
                  '<h6><a class="card-title text-link card-link" href="' +
                  view_url +
                  value.id +
                  '" style="text-decoration:none;font-weight:bold">' +
                  value.job_title +
                  "</a></h6>";
              }

              html += '<div class="row" style="font-size:10pt;">';
              html += '<div class="col col-md-8 mt-2">';
              html +=
                '<a href="' +
                baseurl +
                "/company_info_public/view/" +
                value.employer +
                '" class="text-link text-decoration-none card-link"><small<b>' +
                value.company_name +
                "</b></small></a>";
              html += "</div>";
              html += '<div class="col">';
              html += '<div class="text-right">';
              html +=
                '<small class="text-muted text-right">Apply Before</small>';
              html += "</div>";
              html += "</div>";
              html += "</div>";

              html += '<div class="row mb-3" style="font-size:10pt;">';
              html += '<div class="col-9 col-md-6">';
              html +=
                '<small class="text-muted"><b>' +
                value.location_placeholder +
                "</b></small>";
              html += "</div>";
              html += '<div class="col">';
              html += '<div class="text-right">';
              html +=
                '<small class="text-primary text-right"><b class="text-muted">' +
                value.job_expiration_date +
                "</b></small>";
              html += "</div>";
              html += "</div>";
              html += "</div>";

              html += '<div class="row mb-4" style="font-size:10pt;">';
              html += '<div class="col">';
              html += '<div class="text-left">';
              html += '<small class="text-muted">Date Posted</small>';
              html += "</div>";
              html += '<div class="text-left">';
              html +=
                '<small class="text-muted"><b>' +
                value.date_created +
                "</b></small>";
              html += "</div>";
              html += "</div>";

              html += '<div class="col">';
              html += '<div class="text-right">';
              html += '<small class="text-muted">Job Type</small>';
              html += "</div>";
              html += '<div class="text-right">';
              html +=
                '<small class="text-muted"><b>' +
                value.job_type_text +
                "</b></small>";
              html += "</div>";
              html += "</div>";
              html += "</div>";

              html += '<div class="row" style="font-size:10pt;">';
              html += '<div class="col">';
              html += '<div class="text-right">';
              //html += '<div class="btn-group">';
              var btn_attr = "btn-pill-hover-link btn-pill-lg text-link";
              var logo = '<i class="fa fa-heart-o"></i>';
              if (parseInt(value.saved)) {
                btn_attr = "btn-pill-hover-primary btn-pill-lg text-primary";
                logo = '<i class="fa fa-heart"></i>';
              } //end if

              //alert(value.applied);

              if (user_id !== 0) {
                if (!parseInt(value.applied)) {
                  html +=
                    '<button class="mr-3 btn ' +
                    btn_attr +
                    ' btn_add_fav" aria-saved="' +
                    parseInt(value.saved) +
                    '" aria-id="' +
                    value.id +
                    '">' +
                    logo +
                    "</button>";
                } //end if
              } else {
                html +=
                  '<a href="' +
                  not_loggedin +
                  value.id +
                  '" class="mr-3 btn ' +
                  btn_attr +
                  '" aria-saved="' +
                  parseInt(value.saved) +
                  '" aria-id="' +
                  value.id +
                  '">' +
                  logo +
                  "</a>";
              } //end if

              html +=
                '<a href="' +
                view_url +
                value.id +
                '" class="btn btn-pill-sm btn-pill-outline-link text-link btn_view">View</a>';
              //html += '</div>';
              html += "</div>";
              html += "</div>";
              html += "</div>";

              html += "</div>";
              html += "</div>";
              html += "</div>";
              html += "</div>";

              $("#" + container + "").append(html);
            }
          });

          //pagination

          if (page == 0) {
            var param = {};
            param.total_page = data.total_page;
            param.page = 1;
            param.pagination = pagination;
            load_pagination(param);

            $("." + pagination + " > li.page-item:first").addClass("active");

            $("#more_job_related").removeClass("d-none");
          } //end if
          //end pagination

          if (dropdown_loaded == 0) {
            load_filter_dropdowns();
            if (search_str !== "") {
              $("input[name=header\\[keyword\\]]").val(search_str);
              $("button.btn_find").trigger("click");
            } //end if
          } //end if
        } else {
          $("#" + container + "").empty();
          $("#" + loader + "").empty();
          $("." + pagination + "").empty();
          $(".pagination_result").empty();

          var html = "";
          html += '<div class="row">';
          html += '<div class="col">';
          html += '<div class="text-center">';
          html += "<b>No Result</b>";
          html += "</div>";
          html += "</div>";
          html += "</div>";
          $("#" + container + "").html(html);
        } //end if

        $("#loading").hide();
      })
      .fail(function (e) {
        alert(e.responseText);
        $("#loading").hide();
      })
      .always(function (e) {});
  }
  //end Load Active Job Posts

  //end load data

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
    var url = baseurl + "/get/job_post/olocation";
    var dropdown = $("select[name=header\\[location\\]]");
    load_dropdown(url, dropdown, "location");
    load_dropdowns("location");

    var url = baseurl + "/get/signup/industry/0";
    var dropdown = $("select[name=header\\[industry\\]]");
    load_dropdown(url, dropdown, "industry");
    load_dropdowns("industry");
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
  //===============================================================================================================================
  //end autocomplete
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

    var total_size = 0;
    $("input[name=row\\[file_size\\]\\[\\]]").each(function () {
      total_size += catchIsNaN($(this).val());
    });
    $("input[name=file\\[total_uploaded_file\\]]").val(total_size.toFixed(2));
    $("input[name=file\\[total_files\\]]").val(
      $("input[name=row\\[line\\]\\[\\]]").length
    );
  });
  //end remove trigger

  //remove trigger
  $(document.body).on(
    "click",
    "button[name=btn_remove_multiple]",
    function (e) {
      $("#image_cont_form").empty();
      $("#image_cont").empty();
      var total_size = 0;
      $("input[name=row\\[file_size\\]\\[\\]]").each(function () {
        total_size += catchIsNaN($(this).val());
      });
      $("input[name=file\\[total_uploaded_file\\]]").val(total_size.toFixed(2));
      $("input[name=file\\[total_files\\]]").val(
        $("input[name=row\\[line\\]\\[\\]]").length
      );
    }
  );
  //end remove trigger
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
        $(".outside_button *").css("pointer-events", "none");
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
            $(".outside_button *").css("pointer-events", "auto");
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

  //===============================================================================================================================
  //End upload image
}); //End document.ready
