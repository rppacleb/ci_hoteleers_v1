$(document).ready(function () {
  //highlight
  $("#side_drafts_template").removeClass("text-muted");
  $("#side_drafts_template").addClass("active");
  $("#side_drafts_template").css({
    opacity: 0.8,
    "background-color": "rgb(0, 41, 170)",
  });
  //end highlight

  if ($(window).width() >= 1441) {
    $(".container-fluid").css({ "max-width": "1440px" });
  } else if ($(window).width() >= 1360 && $(window).width() <= 1440) {
    $(".container-fluid").css({ "max-width": "1350px" });
  } else if ($(window).width() >= 1200 && $(window).width() <= 1359) {
    $(".container-fluid").css({ "max-width": "1200px" });
  }

  var homeurl = baseurl + "/job_post";

  // For dimensions of new Job post copy window.
  var w;
  var l;
  var h;
  var t;

  load_record(0, "signup", "main_container", "main_pagination", "main_loader");

  //load record
  function load_record(page, type, container, pagination, loader) {
    var view_url = homeurl + "/view/";
    var edit_url = homeurl + "/edit/";

    var data = {};
    data.page = page;
    data.status = $("select[name=header\\[sort\\]]").val();
    data.filter_field = "t0.employer";
    data.filter_value = employer_id;
    data.keyword = $("input[name=header\\[keyword\\]]").val();

    var url = baseurl + "/get/job_post_pagination/" + type;
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
            // For the dimensions of new copy window.
            w = window.innerWidth / 2 + 160;
            l = w / 2 / 2;
            h = window.innerHeight / 2 + 160;
            t = h / 2 / 2;

            var html = "";

            html += '<div class="row mb-3">';
            html += '<div class="col">';
            var btn_class = "";
            if (!parseInt(value.inactive)) {
              // btn_class= "border border-success";
            } else {
              btn_class = "border border-warning";
            } //end if

            // Logic for adding ellipsis to long job title.
            // if ($(window).width() <= 1600 && $(window).width() >= 1380) {
            //     var job_title_placeholder           = value.job_title.substring(0,17);
            //     var job_title_placeholder_length    = value.job_title.length;

            //     if(job_title_placeholder_length > 17){
            //         job_title_placeholder = job_title_placeholder+'...';
            //     }//end if
            // } else if ($(window).width() <= 1379 && $(window).width() >= 1281) {
            //     var job_title_placeholder           = value.job_title.substring(0,15);
            //     var job_title_placeholder_length    = value.job_title.length;

            //     if(job_title_placeholder_length > 15){
            //         job_title_placeholder = job_title_placeholder+'...';
            //     }//end if
            // } else if ($(window).width() <= 1280 && $(window).width() >= 1024) {
            //     var job_title_placeholder           = value.job_title.substring(0,13);
            //     var job_title_placeholder_length    = value.job_title.length;

            //     if(job_title_placeholder_length > 13){
            //         job_title_placeholder = job_title_placeholder+'...';
            //     }//end if
            // } else {
            //     var job_title_placeholder           = value.job_title.substring(0,30);
            //     var job_title_placeholder_length    = value.job_title.length;

            //     if(job_title_placeholder_length > 30){
            //         job_title_placeholder = job_title_placeholder+'...';
            //     }//end if
            // }

            html += '<div class="card ' + btn_class + '">';
            html += '<div class="card-body">';
            html += '<div class="row">';
            html +=
              '<div class="col align-self-center" style="color: #333333;">';
            // html += job_title_placeholder;
            html += value.job_title;
            // if(!parseInt(value.pinned) && (value.date_posted === null || value.date_posted === '')){
            //     html += '<br/>';
            //     html += '<span class="text-muted font-italic">(Unpinned drafts will expire after 7 days)</span>';
            // }
            html += "</div><!--./col-->";
            html += '<div class="col align-self-center text-muted">';
            html += value.company_name;
            html += "</div><!--./col-->";

            html += '<div class="col align-self-center text-muted">';
            html += value.location;
            html += "</div><!--./col-->";

            // html += '<div class="col align-self-center text-muted">';
            //     html += value.industry_text;
            // html += '</div><!--./col-->';
            html += '<div class="col align-self-center text-muted text-left">';
            html += value.date_created;

            if (
              !parseInt(value.pinned) &&
              (value.date_posted === null || value.date_posted === "")
            ) {
              html += "<br/>";
              html +=
                '<span class="text-muted font-italic">will purge in ' +
                (7 - value.days_past) +
                " day(s)</span>";
            } else {
              if (value.remaining_days <= 30 && value.remaining_days > 0) {
                html += "<br/>";
                html +=
                  '<span class="text-muted font-italic">will expire in ' +
                  value.remaining_days +
                  " day(s)</span>";
              } //end if
            } //end if

            html += "</div><!--./col-->";

            html +=
              '<div class="col-auto align-self-center text-center" style="min-width:2.2in;">';

            var disabled = "";
            if (!parseInt(value.inactive)) {
              //disabled = "disabled";
            } //end if

            var remove_disabled = "";
            /*if(parseInt(value.remove_on)){
                                                    remove_disabled = "disabled";
                                                }//end if*/

            html +=
              "<button " +
              remove_disabled +
              ' title="Remove" aria-daysPosted="' +
              value.date_posted_diff +
              '" aria-id="' +
              value.id +
              '" class="mr-2 btn btn-pill-sm btn-pill-sm-outline-light text-danger remove"><i class="fa fa-times"></i></button>';
            if (!parseInt(value.inactive)) {
              html +=
                '<button type="button" title="Copy" id="' +
                value.id +
                '" class="mr-2 btn btn-pill-sm btn-pill-sm-outline-light text-muted btn_view"><i class="fa fa-copy"></i></button>';
            } else {
              html +=
                '<a href="' +
                edit_url +
                value.id +
                '" title="Edit" class="mr-2 btn btn-pill-sm btn-pill-sm-outline-light text-muted btn_view"><i class="fa fa-pencil"></i></a>';
            }

            html +=
              '<a href="' +
              view_url +
              value.id +
              '?isActive=0" class="mr-2 btn btn-pill-sm btn-pill-outline-link text-link btn_view">View</a>';

            var img_src = "";
            if (parseInt(value.pinned)) {
              img_src = baseurl + "/assets/img/main/pin-push-colored.svg";
            } else {
              img_src = baseurl + "/assets/img/main/pin-push.svg";
            } //end if

            html +=
              '<a href="#" class="btn_pin" aria-id="' +
              value.id +
              '" aria-pinned="' +
              value.pinned +
              '"><img style="width:0.2in;height:0.2in;" class="img-fluid" src="' +
              img_src +
              '" /></a>';

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

        $("#loading").hide();
      })
      .fail(function (e) {
        alert(e.responseText);
        $("#loading").hide();
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

  // Search job on Enter key press
  $(document.body).on(
    "keypress",
    "input[name=header\\[keyword\\]]",
    function (e) {
      if (e.which == 13) {
        $("button.btn_find").click();
        return false;
      }
    }
  );

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
      load_record(
        page,
        type,
        type + "_container",
        type + "_pagination",
        type + "_loader"
      );
    }
  });
  //end pagination button

  //filter by
  $(document.body).on("change", "select[name=header\\[sort\\]]", function (e) {
    load_record(
      0,
      "signup",
      "main_container",
      "main_pagination",
      "main_loader"
    );
  }); //end if
  //end filter by

  //find
  $(document.body).on("click", "button.btn_find", function (e) {
    load_record(
      0,
      "signup",
      "main_container",
      "main_pagination",
      "main_loader"
    );
  }); //end if
  //end find

  //find
  $(document.body).on("blur", "input[name=header\\[keyword\\]]", function (e) {
    load_record(
      0,
      "signup",
      "main_container",
      "main_pagination",
      "main_loader"
    );
  }); //end if
  //end find

  //find; Refreshing the result/s when the search word is removed.
  $(document.body).on("input", "input[name=header\\[keyword\\]]", function (e) {
    if (e.currentTarget.value === "") {
      load_record(
        0,
        "employer",
        "main_container",
        "main_pagination",
        "main_loader"
      );
    }
  });
  //end find

  //delete
  $(document.body).on("click", ".remove", function (e) {
    var btn = $(this);
    var btn_text = "";
    var id = $(this).attr("aria-id");
    var daysPosted = $(this).attr("aria-daysPosted");
    var type = $(this).attr("aria-type");

    var url = homeurl;
    url += "/delete_data/?id=" + id;

    var prompt_message = "";
    if (daysPosted !== null && daysPosted !== undefined && daysPosted > 2) {
      prompt_message =
        "This action will unpublish the job post. You will have 30 days to update before archiving.";
    } else {
      prompt_message = "This post will be deleted permanently.";
    } //end if

    if (confirm(prompt_message)) {
      $.ajax({
        url: url,
        type: "GET",
        dataType: "JSON",
        beforeSend: function (data) {
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

            load_record(
              0,
              "signup",
              "main_container",
              "main_pagination",
              "main_loader"
            );

            //btn.text(btn_text);
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

            //btn.text(btn_text);
            btn.removeAttr("disabled");
          }
        })
        .fail(function (e) {
          alert(e.responseText);

          //btn.text(btn_text);
          btn.removeAttr("disabled");
        })
        .always(function (e) {});
    } //end if
  }); //end
  //end delete

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
            $(".outside_button *").css("pointer-events", "auto");
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

  //pin job post
  $(document.body).on("click", "a.btn_pin", function (e) {
    var id = $(this).attr("aria-id");
    var pinned = $(this).attr("aria-pinned");
    var btn = $(this);
    var btn_text = "";

    var type_text = "";

    var url = homeurl;
    url = homeurl + "/pin_job_post";

    var frm_id = "";

    var img_src = "";
    if (parseInt(pinned)) {
      type_text = "unpin";
      img_src = baseurl + "/assets/img/main/pin-push.svg";
      pinned = 0;
    } else {
      type_text = "pin";
      img_src = baseurl + "/assets/img/main/pin-push-colored.svg";
      pinned = 1;
    } //end if

    var data = {};
    data.header = {};
    data.header.id = id;
    data.header.pinned = pinned;

    btn_text =
      '<img style="width:0.2in;height:0.2in;" class="img-fluid" src="' +
      img_src +
      '" />';

    if (
      confirm(
        "Are you sure you want to " + type_text + " this job as a template?"
      )
    ) {
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

            btn.removeAttr("disabled");
            btn.attr("aria-pinned", pinned);
            btn.html(btn_text);

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
          //btn.text(btn_text);
          btn.removeAttr("disabled");
          $(".outside_button *").css("pointer-events", "auto");
        })
        .always(function (e) {});
    } //end if
  }); //end if
  //end pin job post

  // Open Job post copy window
  $(document.body).on("click", "button[title=Copy]", function (e) {
    var job_post_copy_url = baseurl + "/job_post_copy/copy/";
    var dimensions =
      "width=" + w + ",height=" + h + ",status=0,left=" + l + ",top=" + t;

    var jobPostCopyWindow = window.open(
      job_post_copy_url + e.currentTarget.id + "?isActive=0",
      "newwindow",
      dimensions
    );

    // To refresh the Job post result/s after closing/submitting the Job post copy window.
    var timer = setInterval(function () {
      if (jobPostCopyWindow.closed) {
        clearInterval(timer);
        load_record(
          0,
          "employer",
          "main_container",
          "main_pagination",
          "main_loader"
        );
      }
    }, 500);
  });

  //=====================================================================================================================
  //end events
}); //End document.ready
