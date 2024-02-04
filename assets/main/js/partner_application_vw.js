$(document).ready(function () {
  //highlight
  $("#side_partner_application").removeClass("text-muted");
  $("#side_partner_application").addClass("active");
  $("#side_partner_application").css("opacity", 0.8);
  //end highlight

  var homeurl = baseurl + "/partner_application";
  var urlimgdef = "https://dummyimage.com/76x76/dee2e6/6c757d.jpg";
  // load_record(0,'signup','main_container','main_pagination','main_loader');

  //load_data
  //load record
  $(document.body).on("blur", "input[name=header\\[id\\]]", function (e) {
    var id = $(this).val();
    //var type        = $(this).attr('aria-type');
    var param = {};
    //param["type"]   = type;
    param["id"] = id;
    param["mode"] = "view";
    load_data(param);
  });
  //end load record

  $("input[name=header\\[id\\]]").trigger("blur");

  //load record
  function load_record(page, type, container, pagination, loader) {
    var data = {};
    data.page = page;
    data.status = $("select[name=header\\[sort\\]]").val();
    data.keyword = $("input[name=header\\[keyword\\]]").val();

    var url = baseurl + "/get/partner_application/" + type;
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
        //alert(JSON.stringify(data.request));

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

          $(".pagination_result").empty();
          $(".pagination_result").html(
            start_page +
              " - " +
              end_page +
              " of " +
              toCurrency_precision(data.total_result, 0) +
              " result(s)"
          );

          $.each(data.data, function (key, value) {
            var html = "";

            html += '<div class="row mb-2">';
            html += '<div class="col">';
            html += '<div class="card">';
            html += '<div class="card-body">';
            html += '<div class="row">';
            html += '<div class="col">';
            html += value.application_date;
            html += "</div><!--./col-->";
            html += '<div class="col">';
            html += value.company_name;
            html += "</div><!--./col-->";
            html += '<div class="col">';
            html += value.location;
            html += "</div><!--./col-->";
            html += '<div class="col">';
            html += value.industry;
            html += "</div><!--./col-->";
            html += '<div class="col">';
            html += '<div class="btn-group btn-group-toggle">';
            var approved = "";
            var declined = "";
            if (value.status.toLowerCase() == "approved") {
              approved = "disabled";
            } //end if
            if (value.status.toLowerCase() == "declined") {
              declined = "disabled";
            } //end if
            html +=
              '<button data-id="' +
              value.id +
              '" data-type="partner_application" data-toggle="modal" data-target="#edit_modal" data-title="" class="btn btn-pill-sm btn-pill-outline-link text-link btn_view">View</button>';
            html +=
              '<button aria-id="' +
              value.id +
              '" aria-type="2" aria-username="' +
              value.username +
              '" class="' +
              approved +
              ' btn btn-pill-sm btn-pill-outline-link text-link btn_submit">Approve</button>';
            html +=
              '<button aria-id="' +
              value.id +
              '" aria-type="3" aria-username="' +
              value.username +
              '" class="' +
              declined +
              ' btn btn-pill-sm btn-pill-outline-primary text-primary btn_submit">Decline</button>';
            html += "</div>";
            html += "</div><!--./col-->";
            html += "</div><!--./row-->";
            html += "</div><!--./card-body-->";
            html += "</div><!--./card-->";
            html += "</div><!--./col-->";

            html += "</div><!--./row-->";

            $("#" + container + "").append(html);
          });

          //pagination

          if (page == 0) {
            var param = {};
            param.total_page = data.total_page;
            param.page = 1;
            param.pagination = pagination;
            load_pagination(param);

            $("." + pagination + " > li.page-item:first").addClass("active");
          } //end if
          //end pagination
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
      })
      .fail(function (e) {
        alert(e.responseText);
      })
      .always(function (e) {});
  } //end load_record

  $(document.body).on("click", "button[name=btn_login]", function (e) {
    var homeurl = baseurl + "/home";
    var url = baseurl + "/login/login";

    $.ajax({
      url: url,
      data: $("#frm_login").serialize(),
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
    var id = $(this).attr("aria-id");
    var btn = $(this);
    var btn_text = "";
    var id = $(this).attr("aria-id");
    var type = $(this).attr("aria-type");
    var type_text = "";

    var url = homeurl;
    url = baseurl + "/partner_application/submit_data";

    var frm_id = "";

    var data = {};
    data.header = {};
    data.header.id = id;
    data.header.status = type;
    data.header.username = $(this).attr("aria-username");

    if (type == 2) {
      btn_text = "Approve";
      type_text = "approve";
    } else {
      btn_text = "Decline";
      type_text = "decline";
    }

    if (confirm("Are you sure you want to " + type_text + " this partner?")) {
      $.ajax({
        url: url,
        type: "POST",
        data: data,
        dataType: "JSON",
        beforeSend: function () {
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

            //load_record(0,type,type+'_container',type+'_pagination',type+'_loader');
            //$(frm_id+' input[name=header\\[id\\]').val('');
            //$(frm_id+' input[name=header\\[name\\]').val('');

            load_record(
              0,
              "signup",
              "main_container",
              "main_pagination",
              "main_loader"
            );

            btn.text(btn_text);
            btn.removeAttr("disabled");
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

  $(document.body).on("click", "#frm_data_entry .btn_show_pass", function (e) {
    var type = $(this).attr("aria-type");
    var x;
    if (type == "password") {
      x = $("#frm_data_entry input[name=header\\[password\\]]");
    } else {
      x = $("#frm_data_entry input[name=header\\[confirm_password\\]]");
    } //end if

    if (x.attr("type") === "password") {
      x.prop("type", "text");
      $(this).find(".input-group-text").html('<i class="fa fa-eye-slash"></i>');
    } else {
      x.prop("type", "password");
      $(this).find(".input-group-text").html('<i class="fa fa-eye"></i>');
    }
  });
  //=====================================================================================================================
  //end events

  //modal
  //=======================================================================================================================
  //Lookup Modal
  $("#edit_modal").on("shown.bs.modal", function (e) {
    //Set Title
    var param = {};
    var title = $(e.relatedTarget).data("title");
    title = title.replace(/_/g, " ");
    title = title.toUpperCase();
    var type = $(e.relatedTarget).data("type");
    var id = $(e.relatedTarget).data("id");

    param.id = id;
    param.type = type;
    //alert(id)
    $("#edit_modal_title").html(title);

    //$('#btnOk').html('<span class="spinner-grow spinner-grow-sm"></span></span> Loading...');
    //$('#btnOk').attr('disabled','disabled');

    var html_table = load_edit_form(param);
    $("#edit_modal_body").html(html_table);

    //load google map upon showing of company form
    var script = document.createElement("script");
    script.onload = function () {};
    script.src =
      "https://maps.googleapis.com/maps/api/js?language=en&key=AIzaSyAGyohoEluWcR09ZROWb0cSHKa-QoqZmwM&libraries=places&callback=initMap";
    document.head.appendChild(script);
    //end load google map upon showing of company form
    //$('#frm_'+type+'_edit input[name=header\\[id\\]]').val(id).trigger('blur');
  });

  $("#edit_modal").on("hide.bs.modal", function (e) {
    $("#edit_modal_title").empty();
    $("#edit_modal_body").empty();
  });
  //End Lookup Modal
  //=======================================================================================================================
  //end modal

  //table template
  //=======================================================================================================================
  function load_edit_form(param) {
    var html = "";

    html += '<form id="frm_' + param.type + '_edit">';
    html += '<div class="row">';
    html += '<div class="col">';

    html += "</div>";
    html += "</div>";

    html += '<div class="form-group row">';
    html += '<label class="col-3 col-form-label">Id</label>';
    html += '<div class="col">';
    html +=
      '<input readonly class="form-control form-control-sm mb-2" type="text" aria-type="' +
      param.type +
      '" name="header[id]"/>';
    html += "</div>";
    html += "</div>";

    html += '<div class="form-group row">';
    html += '<label class="col-3 col-form-label">Email</label>';
    html += '<div class="col">';
    html +=
      '<input value="" Placeholder="Email" name="header[username]" type="text" class="form-control form-control-sm" maxlength="100">';
    html += "</div><!--./col-->";
    html += "</div><!--./row-->";

    html += '<div class="form-group row">';
    html += '<label class="col-3 col-form-label">Password</label>';
    html += '<div class="col">';
    html += '<div class="input-group">';
    html +=
      '<input value="" Placeholder="Password" name="header[password]" type="password" class="form-control form-control-sm" maxlength="50">';
    html +=
      '<div class="input-group-append input-group-addon btn_show_pass" aria-type="password" data-toggle="tooltip" data-placement="bottom" title="Minimum 8 characters with upper case, lower case and number">';
    html += '<div class="input-group-text"><i class="fa fa-eye"></i></div>';
    html += "</div>";
    html += "</div>";
    html += "</div><!--./col-->";
    html += "</div><!--./row-->";

    html += '<div class="form-group row">';
    html +=
      '<label class="col-3 col-form-label">Honorifics <span class="text-danger fw-bolder">*</span></label>';
    html += '<div class="col">';
    html +=
      '<select class="custom-select custom-select-sm" name="header[honorifics]">';
    html += '<option value="Mr.">Mr.</option>';
    html += '<option value="Ms.">Ms.</option>';
    html += "</select>";
    html += "</div><!--./col-10-->";
    html += "</div><!--./form-group-->";

    html += '<div class="form-group row">';
    html +=
      '<label class="col-3 col-form-label">First Name <span class="text-danger fw-bolder">*</span></label>';
    html += '<div class="col">';
    html +=
      '<input class="form-control form-control-sm" type="text" name="header[first_name]" maxlength="100"/>';
    html += "</div><!--./col-10-->";
    html += "</div><!--./form-group-->";
    html += '<div class="form-group row">';
    html +=
      '<label class="col-3 col-form-label">Last Name <span class="text-danger fw-bolder">*</span></label>';
    html += '<div class="col">';
    html +=
      '<input class="form-control form-control-sm" type="text" name="header[last_name]" maxlength="100"/>';
    html += "</div><!--./col-10-->";
    html += "</div><!--./form-group-->";
    html += '<div class="form-group row">';
    html +=
      '<label class="col-3 col-form-label">Work Email <span class="text-danger fw-bolder">*</span></label>';
    html += '<div class="col">';
    html +=
      '<input placeholder="email@email.com" class="form-control form-control-sm" type="text" name="header[work_email]" maxlength="100"/>';
    html += "</div><!--./col-10-->";
    html += "</div><!--./form-group-->";
    html += '<div class="form-group row">';
    html +=
      '<label class="col-3 col-form-label">Contact Number <span class="text-danger fw-bolder">*</span></label>';
    html += '<div class="col-3">';
    html +=
      '<select class="custom-select custom-select-sm" name="header[dial_code]">';
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
    html += "</div><!--./col-10-->";
    html += '<div class="col">';
    html +=
      '<input placeholder="917XXXXXXX" class="form-control form-control-sm" type="text" name="header[contact_number]" maxlength="20"/>';
    html += "</div><!--./col-10-->";
    html += "</div><!--./form-group-->";
    html += '<div class="form-group row">';
    html +=
      '<label class="col-3 col-form-label">Company Name <span class="text-danger fw-bolder">*</span></label>';
    html += '<div class="col">';
    html +=
      '<input class="form-control form-control-sm" type="text" name="header[company_name]" maxlength="100"/>';
    html += "</div><!--./col-10-->";
    html += "</div><!--./form-group-->";

    html += '<div class="form-group row">';
    html +=
      '<label class="col-3 col-form-label">Location <span class="text-danger fw-bolder">*</span></label>';
    html += '<div class="col">';
    html +=
      '<input class="form-control form-control-sm" type="text" id="search_location"/>';
    html += "</div><!--./col-10-->";
    html += "</div><!--./form-group-->";

    html += '<div class="form-group row d-none">';
    html +=
      '<label class="col-3 col-form-label">Location <span class="text-danger fw-bolder">*</span></label>';
    html += '<div class="col">';
    html +=
      '<textarea readonly class="form-control form-control-sm" name="header[location]"/></textarea>';
    html += "</div><!--./col-10-->";
    html += "</div><!--./form-group-->";

    html += '<div class="form-group row d-none">';
    html += '<label class="col-3 col-form-label">Locality</label>';
    html += '<div class="col">';
    html +=
      '<input readonly class="form-control form-control-sm" type="text" name="header[locality]"/>';
    html += "</div><!--./col-10-->";
    html += "</div><!--./form-group-->";

    html += '<div class="form-group row d-none">';
    html +=
      '<label class="col-3 col-form-label">Administrative Area Level 1</label>';
    html += '<div class="col">';
    html +=
      '<input readonly class="form-control form-control-sm" type="text" name="header[administrative_area_level_1]"/>';
    html += "</div><!--./col-10-->";
    html += "</div><!--./form-group-->";

    html += '<div class="form-group row d-none">';
    html += '<label class="col-3 col-form-label">Country</label>';
    html += '<div class="col">';
    html +=
      '<input readonly class="form-control form-control-sm" type="text" name="header[country]"/>';
    html += "</div><!--./col-10-->";
    html += "</div><!--./form-group-->";

    html += '<div class="row mb-2">';
    html += '<div class="col">';
    html += '<div id="map" style="width:100%;height:5in;">';
    html += "</div><!--./map-->";
    html += "</div><!--./col-->";
    html += "</div><!--./row-->";
    html += '<div class="row">';
    html += '<div class="col">';
    html += '<div id="infowindow-content">';
    html += '<span id="place-name" class="title"></span><br/>';
    html += '<span id="place-address"></span>';
    html += "</div><!--./infowindow-content-->";
    html += "</div><!--./col-->";
    html += "</div><!--./row-->";

    html += '<div class="form-group row">';
    html +=
      '<label class="col-3 col-form-label">Designation <span class="text-danger fw-bolder">*</span></label>';
    html += '<div class="col">';
    html +=
      '<input class="form-control form-control-sm" type="text" name="header[designation]" maxlength="100"/>';
    html += "</div><!--./col-10-->";
    html += "</div><!--./form-group-->";
    html += '<div class="form-group row">';
    html +=
      '<label class="col-3 col-form-label">Industry <span class="text-danger fw-bolder">*</span></label>';
    html += '<div class="col-2 d-none">';
    html +=
      '<input readonly class="form-control form-control-sm" type="text" name="header[industry]"/>';
    html += "</div>";
    html += '<div class="col">';
    html += '<div class="input-group input-group-sm">';
    html +=
      '<input class="form-control form-control-sm" type="text" id="header[industry_text]"/>';
    html += '<div class="input-group-append">';
    html += '<span class="input-group-text"><i class="fa fa-list"></i></span>';
    html += "</div><!--./input-group-append-->";
    html += "</div><!--./input-group input-group-sm-->";
    html += "</div><!--./col-10-->";
    html += "</div><!--./form-group-->";

    html += "</form>";
    html += '<div class="text-right">';
    html +=
      '<button class="btn btn-primary btn-pill text-white btn-sm btn_update" type="button" aria-type="' +
      param.type +
      '">Update</button>';
    html += "</div>";
    return html;
  } //end if
  //=======================================================================================================================
  //end table template

  //sourcing
  //=======================================================================================================================
  //load data
  function load_data(param) {
    var url = baseurl + "/partner_application/load_data/" + param.id;
    var btn = $(".btn_submit");
    var btn_text = "Submit";
    $.ajax({
      url: url,
      type: "POST",
      dataType: "JSON",
      beforeSend: function () {
        //$('#'+loader+'').html('<div class="col-12 text-center"><div class="spinner-grow text-muted"></div></div>');
        btn.html('<div class="spinner-grow"></div>');
      },
    })
      .done(function (data) {
        if (data.data !== null) {
          $("#frm_data_entry input[name=header\\[username\\]]").val(
            data.data.username
          );
          $("#frm_data_entry input[name=header\\[password\\]]").val(
            data.data.password
          );
          $("#frm_data_entry select[name=header\\[honorifics\\]]").val(
            data.data.honorifics
          );
          $("#frm_data_entry input[name=header\\[first_name\\]]").val(
            data.data.first_name
          );
          $("#frm_data_entry input[name=header\\[last_name\\]]").val(
            data.data.last_name
          );
          $("#frm_data_entry input[name=header\\[work_email\\]]").val(
            data.data.work_email
          );
          $("#frm_data_entry select[name=header\\[dial_code\\]]").val(
            data.data.dial_code
          );
          $("#frm_data_entry input[name=header\\[contact_number\\]]").val(
            data.data.contact_number
          );
          $("#frm_data_entry input[name=header\\[company_name\\]]").val(
            data.data.company_name
          );
          $("h6[id=header\\[company_name\\]]").html(data.data.company_name);

          $("#frm_data_entry input[name=header\\[location\\]]").val(
            data.data.location
          );
          $("p[id=header\\[location\\]]").html(
            '<small class="text-muted">' + data.data.location + "</small>"
          );

          $("#frm_data_entry input[name=header\\[country\\]]").val(
            data.data.country
          );
          $("#frm_data_entry input[name=header\\[designation\\]]").val(
            data.data.designation
          );
          $("#frm_data_entry input[name=header\\[industry\\]]").val(
            data.data.industry
          );
          $("#frm_data_entry input[id=header\\[industry_text\\]]").val(
            data.data.industry_text
          );
          $("p[id=header\\[date_created\\]]").html(
            '<small class="text-muted">Joined ' +
              data.data.joined_date +
              "</small>"
          );

          if (data.data.doc_image === null || data.data.doc_image == "") {
            $("img[id=header\\[company_logo\\]]").attr("src", urlimgdef);
            //html += '<img class="card-img-top" style="height:150px;" src="data:image/jpeg;base64, '+value.doc_image+'" alt="..." />';
          } else {
            var src_txt = "data:image/jpeg;base64, " + value.doc_image + "";
            $("img[id=header\\[company_logo\\]]").attr("src", src_txt);
            //html += '<img class="card-img-top" style="height:150px;" src="'+urlimgdef+'" alt="..." />';
          } //end if

          if (data.data.status == 1) {
            $("p[id=header\\[status\\]]").addClass("text-warning");
          } else if (data.data.status == 3) {
            $("p[id=header\\[status\\]]").addClass("text-danger");
          }

          $("p[id=header\\[status\\]]").html(data.data.status_text);

          if (param.mode == "view") {
            $(
              "#frm_data_entry input:not([readonly]),textarea:not([readonly]),select"
            ).addClass(param.mode);
            //$('#frm_data_entry input.'+param.mode+',textarea.'+param.mode+',select.'+param.mode+'').prop('disabled',true);

            $(".to_hide").addClass("d-none");

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
            $("#frm_data_entry button").addClass("d-none");

            $(".btn_submit").addClass("d-none");

            //custom can be omitted
          }

          btn.html(btn_text);
        } else {
          btn.html(btn_text);
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
}); //End document.ready
