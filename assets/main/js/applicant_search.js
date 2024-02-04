$(document).ready(function () {
  //highlight
  $("#side_talent_database").removeClass("text-muted");
  $("#side_talent_database").addClass("active");
  $("#side_talent_database").css({
    opacity: 0.8,
    "background-color": "rgb(0, 41, 170)",
  });
  //end highlight

  $("#right-menu").removeClass("col-xl-9 col-lg-9");
  $("#right-menu").addClass("col-xl-10 col-lg-10");

  if ($(window).width() >= 1441) {
    $(".container-fluid").css({ "max-width": "1440px" });
  } else if ($(window).width() >= 1360 && $(window).width() <= 1440) {
    $(".container-fluid").css({ "max-width": "1350px" });
  } else if ($(window).width() >= 1200 && $(window).width() <= 1359) {
    $(".container-fluid").css({ "max-width": "1200px" });
  }

  var homeurl = baseurl + "/applicant_search";
  var homeurl_txt = "applicant_search";
  var urlimgdef = baseurl + "/files/images/default/user.png";
  var urlimgnotfound = baseurl + "/assets/img/main/image-not-found.svg";
  var upload_path = baseurl + "/files/uploads/";
  var dropdown_loaded = 0;

  load_record(
    0,
    "employer",
    "main_container",
    "main_pagination",
    "main_loader"
  );

  //load record
  function load_record(page, type, container, pagination, loader) {
    var edit_url = baseurl + "/applicant_info/view/";
    var view_url = baseurl + "/talent_database/view/";
    var user_url = baseurl + "/user";

    var data = {};
    data.page = page;
    data.keyword = $("input[name=header\\[keyword\\]]").val();
    data.user_id = user_id;

    //get filter_intern
    data.filter_intern = $("#filter_intern").is(":checked");
    data.filter_invited = $("#filter_invited").is(":checked");

    //get_location

    data.location = [];

    $("div#location_cont .edit_link").each(function () {
      if ($(this).text() !== "") {
        data.location.push($(this).text());
      } //end if
    });
    //end get location

    //job title
    data.job_title = [];
    $("div#job_title_cont .edit_link").each(function () {
      data.job_title.push($(this).text());
    });
    //end job title

    //alert(JSON.stringify(data.job_title));

    //get years
    data.years = [];
    var range = [];
    $("div#years_cont .edit_link").each(function () {
      range = $(this).text().split("-");

      data.years.push(range);
    });
    //end years

    //get education
    data.education = [];
    $("div#education_cont .edit_link").each(function () {
      data.education.push($(this).text());
    });
    //end get education

    //get language
    data.language = [];
    $("div#language_cont .edit_link").each(function () {
      data.language.push($(this).text());
    });
    //end get language

    //alert(JSON.stringify(data.language));

    //get skills
    data.skills = [];
    $("div#skills_cont .edit_link").each(function () {
      data.skills.push($(this).text());
    });
    //end get job level

    //get job type
    data.job_type = [];
    $("div#job_type_cont .edit_link").each(function () {
      data.job_type.push($(this).text());
    });
    //end get job type

    //get industry
    data.industry = [];
    $("div#industry_cont .edit_link").each(function () {
      data.industry.push($(this).text());
    });
    //end get industry

    //get department
    data.department = [];
    $("div#department_cont .edit_link").each(function () {
      data.department.push($(this).text());
    });
    //end get department

    var url = baseurl + "/get/" + homeurl_txt + "/" + type;
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
            var html = "";

            var img_src = "";
            if (value.doc_image === null || value.doc_image == "") {
              img_src = urlimgdef;
            } else {
              img_src = upload_path + value.doc_image;
            } //end if

            if (!image.imageExists(img_src)) {
              img_src = urlimgnotfound;
            } //end if

            html += '<div class="row mb-3">';
            html += '<div class="col">';
            html += '<div class="card">';
            html += '<div class="card-body">';
            html += '<div class="row">';

            html += '<div class="col-1" style="min-width:1in;">';
            html +=
              '<img class="rounded-circle" style="height:0.7in;width:0.7in;" src="' +
              img_src +
              '" alt="Card image cap">';

            html += "</div><!--./col-->";
            html +=
              '<div class="col-1 align-self-center text-break as-namespacer">';
            html += value.name;

            html += "</div><!--./col-->";
            html += '<div class="col align-self-center text-muted">';
            html += value.location_placeholder;
            html += "</div><!--./col-->";

            if ($(window).width() <= 1440 && $(window).width() >= 1380) {
              var job_title_placeholder = value.current_job.substring(0, 20);
              var job_title_placeholder_length = value.current_job.length;

              if (job_title_placeholder_length > 20) {
                job_title_placeholder = job_title_placeholder + "...";
                html +=
                  '<div class="col align-self-center"><h5 style="font-size: 15px; font-weight: 400; font-family: Be Vietnam Pro, sans-serif; margin-top: auto; margin-bottom: auto;" class="text-break" data-ajacurrjob="' +
                  value.current_job +
                  '">';
                html += job_title_placeholder;
                html += "</h5></div><!--./col-->";
              } else {
                html += '<div class="col align-self-center">';
                html += value.current_job;
                html += "</div><!--./col-->";
              }

              var company_placeholder = value.company_name.substring(0, 20);
              var company_placeholder_length = value.company_name.length;

              if (company_placeholder_length > 20) {
                company_placeholder = company_placeholder + "...";
                html += '<div class="col align-self-center">';
                html += company_placeholder;
                html += "</div><!--./col-->";
              } else {
                html += '<div class="col align-self-center">';
                html += value.company_name;
                html += "</div><!--./col-->";
              } //end if
            } else if ($(window).width() <= 1379 && $(window).width() >= 1281) {
              var job_title_placeholder = value.current_job.substring(0, 20);
              var job_title_placeholder_length = value.current_job.length;

              if (job_title_placeholder_length > 20) {
                job_title_placeholder = job_title_placeholder + "...";
                html += '<div class="col align-self-center">';
                html += job_title_placeholder;
                html += "</div><!--./col-->";
              } else {
                html += '<div class="col align-self-center">';
                html += value.current_job;
                html += "</div><!--./col-->";
              }

              var company_placeholder = value.company_name.substring(0, 20);
              var company_placeholder_length = value.company_name.length;

              if (company_placeholder_length > 20) {
                company_placeholder = company_placeholder + "...";
                html += '<div class="col align-self-center">';
                html += company_placeholder;
                html += "</div><!--./col-->";
              } else {
                html += '<div class="col align-self-center">';
                html += value.company_name;
                html += "</div><!--./col-->";
              }
            } else if ($(window).width() <= 1280 && $(window).width() >= 1024) {
              var job_title_placeholder = value.current_job.substring(0, 24);
              var job_title_placeholder_length = value.current_job.length;

              if (job_title_placeholder_length > 24) {
                job_title_placeholder = job_title_placeholder + "...";
                html += '<div class="col align-self-center">';
                html += job_title_placeholder;
                html += "</div><!--./col-->";
              } else {
                html += '<div class="col align-self-center">';
                html += value.current_job;
                html += "</div><!--./col-->";
              }

              var company_placeholder = value.company_name.substring(0, 24);
              var company_placeholder_length = value.company_name.length;

              if (company_placeholder_length > 24) {
                company_placeholder = company_placeholder + "...";
                html += '<div class="col align-self-center">';
                html += company_placeholder;
                html += "</div><!--./col-->";
              } else {
                html += '<div class="col align-self-center">';
                html += value.company_name;
                html += "</div><!--./col-->";
              }
            } else {
              var job_title_placeholder = value.current_job.substring(0, 22);
              var job_title_placeholder_length = value.current_job.length;

              if (job_title_placeholder_length > 22) {
                job_title_placeholder = job_title_placeholder + "...";
                html += '<div class="col align-self-center">';
                html += job_title_placeholder;
                html += "</div><!--./col-->";
              } else {
                html += '<div class="col align-self-center">';
                html += value.current_job;
                html += "</div><!--./col-->";
              }

              var company_placeholder = value.company_name.substring(0, 22);
              var company_placeholder_length = value.company_name.length;

              if (company_placeholder_length > 22) {
                company_placeholder = company_placeholder + "...";
                html += '<div class="col align-self-center">';
                html += company_placeholder;
                html += "</div><!--./col-->";
              } else {
                html += '<div class="col align-self-center">';
                html += value.company_name;
                html += "</div><!--./col-->";
              }
            }

            html +=
              '<div class="text-center col-xl-2 col-lg-2 align-self-center" style="min-width:1.6in;">';
            //html += '<div class="btn-group btn-group-toggle">';
            var btn_class = "btn-pill-hover-link btn-pill-lg text-link";
            var logo = '<i class="fa fa-heart-o"></i>';
            if (value.profile_saved !== "") {
              btn_class = "btn-pill-hover-primary btn-pill-lg text-primary";
              logo = '<i class="fa fa-heart"></i>';
            } //end if
            html +=
              '<button aria-saved="' +
              value.profile_saved +
              '" aria-id="' +
              value.id +
              '" class="mr-2 btn ' +
              btn_class +
              ' btn_save_profile">' +
              logo +
              "</button>";
            //html += '<button '+btn_class+' aria-id="'+value.id+'" class="mr-2 btn btn-pill-sm btn-pill-outline-link text-link btn_save_profile">Save</button>';
            html +=
              '<a href="' +
              view_url +
              value.id +
              '?mod_type=side_talent_database" class="btn btn-pill-sm btn-pill-outline-link text-link btn_view">View</a>';
            //html += '<button aria-id="'+value.id+'" class="btn btn-pill-sm btn-pill-outline-primary text-primary btn_delete">Delete</button>';
            //html += '</div>';
            html += "</div><!--./col-->";
            html += "</div><!--./row-->";

            if (data["data_notification"] !== undefined) {
              if (data["data_notification"][value.id] !== undefined) {
                /*html += '<br/><div class="row justify-content-start">';
                                                    html += '<div class="col-auto">';
                                                        html += '<a data-toggle="collapse" style="text-decoration:none !important;" class="text-link" href="#'+value.id+'">';
                                                            html += '<img title="Invites" style="width:20px;" src="'+baseurl + '/assets/img/main/request_sent.svg'+'">'
                                                        html += '</a>';
                                                    html += '</div>';
                                                html += '</div>';*/

                html += '<div class="row justify-content-start mt-3">';
                html +=
                  '<div id="' + value.id + '" class="d-flex flex-wrap gap-2">';

                //notification
                if (data["data_notification"] !== undefined) {
                  if (data["data_notification"][value.id] !== undefined) {
                    var notification_record = data.data_notification[value.id];
                    for (const k in notification_record) {
                      const m_data = notification_record[k];
                      console.log(m_data);
                      var class_status = "";
                      if (m_data["status"] == "pending") {
                        class_status = "bg-warning text-muted";
                      } else if (m_data["status"] == "accepted") {
                        class_status = "bg-success text-white";
                      } else {
                        class_status = "bg-warning text-muted";
                      }

                      html += `<div class="${class_status} px-3 py-1 rounded-pill">Invite${
                        m_data["status"] == "accepted" ? " accepted" : "d "
                      } to ${m_data["job_title"].toLowerCase()}</div>`;
                    } //end for
                  } //end if
                } //end if
                //end notification

                html += "</div>";
                html += "</div>";
              } //end if
            } //end if

            html += "</div><!--./card-body-->";
            html += "</div><!--./card-->";
            html += "</div><!--./col-->";
            html += "</div><!--./row-->";

            /*

                        html += '<div class="row mb-2">';
                            html += '<div class="col-4">';
                                html += '<img class="rounded" style="height:100%;width:100%;" src="'+img_src+'" alt="Card image cap">';
                                
                            html += '</div>';
                            html += '<div class="col">';
                                html += '<div class="card">';
                                     html += '<div class="card-body">';
                                        html += '<h5 class="card-title text-muted">'+value.company_name+'</h5>';
                                        html += '<h5 class="card-title text-link">'+value.job_title+'</h5>';
                                        html += '<div class="row mb-2">';
                                            html += '<div class="col-9">';
                                                html += '<small class="text-muted"><b>'+value.location+'</b></small>';
                                            html += '</div>';
                                            html += '<div class="col">';
                                                html += '<div class="text-right">';
                                                    html += '<small class="text-muted text-right">Apply Before</small>';
                                                html += '</div>';
                                                html += '<div class="text-right">';
                                                    html += '<small class="text-primary text-right"><b>'+value.job_expiration_date+'</b></small>';
                                                html += '</div>';
                                            html += '</div>';
                                        html += '</div>';

                                        html += '<div class="row mb-2">';
                                            html += '<div class="col">';
                                                html += '<div class="text-left">';
                                                    html += '<small class="text-muted">Date Posted</small>';
                                                html += '</div>';
                                                html += '<div class="text-left">';
                                                    html += '<small class="text-muted"><b>'+value.date_created+'</b></small>';
                                                html += '</div>';
                                            html += '</div>';

                                            html += '<div class="col">';
                                                html += '<div class="text-right">';
                                                    html += '<small class="text-muted">Job Type</small>';
                                                html += '</div>';
                                                html += '<div class="text-right">';
                                                    html += '<small class="text-muted"><b>'+value.job_type_text+'</b></small>';
                                                html += '</div>';
                                            html += '</div>';
                                        html += '</div>';

                                        html += '<div class="row mb-2">';
                                            html += '<div class="col">';
                                                html += '<div class="text-right">';
                                                    html += '<div class="btn-group">';
                                                        if(user_id !== 0){
                                                            var btn_attr = "";

                                                            if(parseInt(value.saved)){
                                                                btn_attr = "disabled";
                                                            }
                                                            html += '<button '+btn_attr+' class="btn btn-pill-sm btn-pill-outline-link text-link btn_add_fav" aria-id="'+value.id+'"><i class="fa fa-heart"></i></button>';
                                                        }//end if
                                                        html += '<a href="'+view_url+value.id+'" class="btn btn-pill-sm btn-pill-outline-link text-link btn_view">View</a>';
                                                    html += '</div>';
                                                html += '</div>';
                                            html += '</div>';
                                        html += '</div>';
                                        
                                    html += '</div>';
                                html += '</div>';
                            html += '</div>';
                        html += '</div>';
                        */

            $("#" + container + "").append(html);
            $('[data-toggle="tooltip"]').tooltip();
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

        if (dropdown_loaded == 0) {
          load_filter_dropdowns();
        } //end if

        $("#loading").hide();
      })
      .fail(function (e) {
        alert(JSON.stringify(e));
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

  // Search applicant on Enter key press
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
      "employer",
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
      "employer",
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
      "employer",
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

  //approve
  $(document.body).on("click", "button.btn_submit", function (e) {
    var id = $(this).attr("aria-id");
    var btn = $(this);
    var btn_text = "";
    var id = $(this).attr("aria-id");
    var type = $(this).attr("aria-type");
    var type_text = "";

    var url = homeurl;
    url += "/partner_application/submit_data";

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

  //add favorites
  $(document.body).on("click", "button.btn_add_fav", function (e) {
    var view_url = homeurl + "/private";

    var id = $(this).attr("aria-id");
    var btn = $(this);
    var btn_text = "";

    var type_text = "";

    var url = homeurl;
    url = homeurl + "/add_fav/list";

    var frm_id = "";

    var data = {};
    data.header = {};
    data.header.id = id;

    btn_text = '<i class="fa fa-heart"></i>';

    if (confirm("Are you sure you want to save this job?")) {
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
    } //end if
  }); //end if
  //end add favorites

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

  //load location autocomplete
  $(document.body).on(
    "focus",
    "input[id=header\\[location_text\\]]",
    function () {
      if (!$(this).hasClass("wauto")) {
        load_location_autocomplete(
          $(this),
          $("input[name=header\\[location\\]]")
        );
        $(this).addClass("wauto");
      } //End if
    }
  ); //focus
  $(document.body).on(
    "blur",
    "input[id=header\\[location_text\\]]",
    function () {
      if ($(this).val() == "") {
        $("input[name=header\\[location\\]]").val("");
      } //end if

      if ($("input[name=header\\[location\\]]").val() == "") {
        $(this).val("");
      } //end if
    }
  ); //blur

  //load job title autocomplete
  $(document.body).on(
    "focus",
    "input[name=header\\[job_title\\]]",
    function () {
      if (!$(this).hasClass("wauto")) {
        //load_job_title_autocomplete($(this),$('input[name=header\\[job_title\\]]'));
        //$(this).addClass('wauto');
      } //End if
    }
  ); //focus

  $(document.body).on("blur", "input[name=header\\[job_title\\]]", function () {
    var html = $(this);
    if ($(this).val() !== "" && $(this).val().length >= 3) {
      var name = $(this).attr("name");
      name = name.substring(name.indexOf("[") + 1);
      name = name.substring(0, name.lastIndexOf("]"));
      var dup = 0;
      $("#" + name + "_cont")
        .find(".edit_link")
        .each(function () {
          var value = $(this).text();

          if (value.toLowerCase() === html.val().toLowerCase()) {
            dup = 1;
            return false;
          } //end if
        });

      if (dup == 0) {
        var html_txt = "";
        html_txt += '<div class="col ">';
        html_txt +=
          '<small class="d-none"><a style="text-decoration:none;" class="edit_link">' +
          html.val() +
          "</a></small>";
        html_txt +=
          '<small><a style="text-decoration:none;">' +
          html.val() +
          "</a></small>";
        html_txt +=
          '<button type="button" title="Remove" class="text-danger close remove_append" aria-id="' +
          html.val() +
          '">&times;</button>';
        html_txt += "</div>";
        $("#" + name + "_cont").append(html_txt);
        $(this).val("");
        $(this).focus();
        //$('.btn_find').trigger('click');
      } //end if
    } //end if
  }); //blur

  //load job title autocomplete
  $(document.body).on("focus", "input[name=header\\[language\\]]", function () {
    if (!$(this).hasClass("wauto")) {
      load_language_autocomplete(
        $(this),
        $("input[name=header\\[language\\]]")
      );
      $(this).addClass("wauto");
    } //End if
  }); //focus
  $(document.body).on("blur", "input[name=header\\[language\\]]", function () {
    var html = $(this);
    if ($(this).val() !== "") {
      var name = $(this).attr("name");
      name = name.substring(name.indexOf("[") + 1);
      name = name.substring(0, name.lastIndexOf("]"));
      var dup = 0;
      $("#" + name + "_cont")
        .find(".edit_link")
        .each(function () {
          var value = $(this).text();

          if (value.toLowerCase() === html.val().toLowerCase()) {
            dup = 1;
            return false;
          } //end if
        });

      if (dup == 0) {
        var html_txt = "";
        html_txt += '<div class="col ">';
        html_txt +=
          '<small class="d-none"><a style="text-decoration:none;" class="edit_link">' +
          html.val() +
          "</a></small>";
        html_txt +=
          '<small><a style="text-decoration:none;">' +
          html.val() +
          "</a></small>";
        html_txt +=
          '<button type="button" title="Remove" class="text-danger close remove_append" aria-id="' +
          html.val() +
          '">&times;</button>';
        html_txt += "</div>";
        $("#" + name + "_cont").append(html_txt);
        $(this).val("");
        $(this).focus();
        //$('.btn_find').trigger('click');
      } //end if
    } //end if
  }); //blur

  //load skills autocomplete
  $(document.body).on("focus", "input[name=header\\[skills\\]]", function () {
    //if(!$(this).hasClass('wauto')){
    //load_skills_autocomplete($(this),$('input[name=header\\[skills\\]]'));
    //$(this).addClass('wauto');
    //}//End if
  }); //focus
  $(document.body).on("blur", "input[name=header\\[skills\\]]", function () {
    var html = $(this);
    if ($(this).val() !== "" && $(this).val().length >= 3) {
      var name = $(this).attr("name");
      name = name.substring(name.indexOf("[") + 1);
      name = name.substring(0, name.lastIndexOf("]"));
      var dup = 0;
      $("#" + name + "_cont")
        .find(".edit_link")
        .each(function () {
          var value = $(this).text();

          if (value.toLowerCase() === html.val().toLowerCase()) {
            dup = 1;
            return false;
          } //end if
        });

      if (dup == 0) {
        var html_txt = "";
        html_txt += '<div class="col ">';
        html_txt +=
          '<small class="d-none"><a style="text-decoration:none;" class="edit_link">' +
          html.val() +
          "</a></small>";
        html_txt +=
          '<small><a style="text-decoration:none;">' +
          html.val() +
          "</a></small>";
        html_txt +=
          '<button type="button" title="Remove" class="text-danger close remove_append" aria-id="' +
          html.val() +
          '">&times;</button>';
        html_txt += "</div>";
        $("#" + name + "_cont").append(html_txt);
        $(this).val("");
        $(this).focus();
        //$('.btn_find').trigger('click');
      } //end if
    } //end if
  }); //blur

  $(document.body).on("blur", "input[name=header\\[years\\]]", function () {
    var html = $(this);
    if ($(this).val() !== "") {
      var name = $(this).attr("name");
      name = name.substring(name.indexOf("[") + 1);
      name = name.substring(0, name.lastIndexOf("]"));
      var dup = 0;
      $("#" + name + "_cont")
        .find(".edit_link")
        .each(function () {
          var value = $(this).text();

          if (value.toLowerCase() === html.val().toLowerCase()) {
            dup = 1;
            return false;
          } //end if
        });

      if (catchIsNaN($(this).val()) == 0) {
        dup = 1;
      }

      if (dup == 0) {
        var html_txt = "";
        html_txt += '<div class="col ">';
        html_txt +=
          '<small class="d-none"><a style="text-decoration:none;" class="edit_link">' +
          html.val() +
          "</a></small>";
        html_txt +=
          '<small><a style="text-decoration:none;">' +
          html.val() +
          "</a></small>";
        html_txt +=
          '<button type="button" title="Remove" class="text-danger close remove_append" aria-id="' +
          html.val() +
          '">&times;</button>';
        html_txt += "</div>";
        $("#" + name + "_cont").append(html_txt);
        $(this).val("");
        $(this).focus();
        //$('.btn_find').trigger('click');
      } //end if
    } //end if
  }); //blur

  //remove appended data
  $(document.body).on("click", ".remove_append", function (e) {
    $(this).parent().remove();
    //$('.btn_find').trigger('click');
  });
  //remove appended data

  //clear filter
  $(document.body).on("click", "a[name=btn_clear_filter]", function (e) {
    //$(this).parent().remove();
    $("input[name=header\\[keyword\\]]").val("");
    $("#job_title_cont").empty();
    $("#years_cont").empty();
    $("#education_cont").empty();
    $("#language_cont").empty();
    $("#skills_cont").empty();
    $("#location_cont").empty();
    $("#filter_intern").prop("checked", false);
    $("#filter_invited").prop("checked", false);

    var el = $("#header\\[years\\]");
    $("option:selected", el).each(function (element) {
      el.multiselect("deselect", $(this).val());
    });
    var el = $("#header\\[education\\]");
    $("option:selected", el).each(function (element) {
      el.multiselect("deselect", $(this).val());
    });
    var el = $("#header\\[language\\]");
    $("option:selected", el).each(function (element) {
      el.multiselect("deselect", $(this).val());
    });

    var el = $("#header\\[skills\\]");
    $("option:selected", el).each(function (element) {
      el.multiselect("deselect", $(this).val());
    });

    var el = $("#header\\[location\\]");
    $("option:selected", el).each(function (element) {
      el.multiselect("deselect", $(this).val());
    });

    $(".btn_find").trigger("click");
  });
  //clear filter

  //filter
  $(document.body).on("click", "button[name=btn_filter]", function (e) {
    $(".btn_find").trigger("click");
  });
  //end filter

  //add favorites
  $(document.body).on("click", "button.btn_save_profile", function (e) {
    var view_url = window.location.href;

    var id = $(this).attr("aria-id");
    var saved = $(this).attr("aria-saved");
    var btn = $(this);
    var btn_text = "";

    var type_text = "";

    var url = homeurl;
    url = baseurl + "/active_jobs_applicant/save_profile/list";

    var frm_id = "";

    var data = {};
    data.header = {};
    data.header.id = id;

    var basic_btn = "btn-pill-hover-link btn-pill-lg text-link";
    var saved_btn = "btn-pill-hover-primary btn-pill-lg text-primary";

    var basic_logo = '<i class="fa fa-heart-o"></i>';
    var saved_logo = '<i class="fa fa-heart"></i>';

    btn_text = '<i class="fa fa-heart"></i>';
    var msg_txt = "Added to Saved Profiles";
    if (parseInt(saved)) {
      msg_txt = "Removed from Saved Profiles";
    } //end if

    //if(confirm("Are you sure you want to "+msg_txt+" this applicant?")){

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

          msg_html = msg_txt;

          $.notify(msg_html, {
            position: "top center",
            className: "success",
            arrowShow: true,
          });

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
  //=====================================================================================================================
  //end events

  //autocomplete
  //===============================================================================================================================
  function load_dropdowns(type) {
    var nonSelectedTextPlaceholder = "select " + type;
    if (type === "years") {
      nonSelectedTextPlaceholder = "select years of experience";
    }

    $("#header\\[" + type + "\\]").multiselect({
      enableFiltering: true,
      //selectAllValue: 'multiselect-all',
      //selectAllText: 'Select All',
      //includeSelectAllOption : true,
      nonSelectedText: nonSelectedTextPlaceholder,
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
            html +=
              '<small class="d-none"><a style="text-decoration:none;" class="edit_link">' +
              $(this).val() +
              "</a></small>";
            html +=
              '<small><a style="text-decoration:none;">' +
              $(this).val() +
              "</a></small>";
            html +=
              '<button type="button" title="Remove" class="text-danger close remove_append" aria-id="' +
              $(this).val() +
              '">&times;</button>';
            html += "</div>";
          });

          $("#" + type + "_cont").html(html);
          //$('.btn_find').trigger('click');
        } else {
          var html = "";
          //alert(element.val());
          $("#" + type + "_cont")
            .find(".edit_link")
            .each(function () {
              var edit_l = $(this).parent().parent();
              var value = $(this).text();
              $("option:selected", $("#header\\[" + type + "\\]")).each(
                function (element2) {
                  if (value.toLowerCase() === $(this).val().toLowerCase()) {
                    html += '<div class="col d-none">';
                    html +=
                      '<small class="d-none"><a style="text-decoration:none;" class="edit_link">' +
                      $(this).val() +
                      "</a></small>";
                    html +=
                      '<small><a style="text-decoration:none;">' +
                      $(this).val() +
                      "</a></small>";
                    html +=
                      '<button type="button" title="Remove" class="text-danger close remove_append" aria-id="' +
                      $(this).val() +
                      '">&times;</button>';
                    html += "</div>";
                  } else {
                    edit_l.remove();
                  } //end if
                }
              );
            });

          $("#" + type + "_cont").html(html);

          //$('.btn_find').trigger('click');
        } //end if
      },
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
        var html = "";

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
            if (type == "years") {
              html +=
                '<option value="' +
                response.data[key].from_range +
                "-" +
                response.data[key].to_range +
                '">' +
                response.data[key].name +
                "</option>";
            } else if (type == "location") {
              html +=
                '<option value="' +
                response.data[key].name +
                '">' +
                response.data[key].name +
                "</option>";
            } else if (type == "language") {
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
            }
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
    url = baseurl + "/get/job_post/oeducation";
    var dropdown = $("#header\\[education\\]");
    load_dropdown(url, dropdown, "education");
    load_dropdowns("education");

    url = baseurl + "/get/job_post/olanguage";
    var dropdown = $("#header\\[language\\]");
    load_dropdown(url, dropdown, "language");
    load_dropdowns("language");

    url = baseurl + "/get/job_post/olocation";
    var dropdown = $("#header\\[location\\]");
    load_dropdown(url, dropdown, "location");
    load_dropdowns("location");

    url = baseurl + "/get/job_post/oyear";
    var dropdown = $("#header\\[years\\]");
    load_dropdown(url, dropdown, "years");
    load_dropdowns("years");

    dropdown_loaded = 1;
  } //end if

  //job title autocomplete
  function load_job_title_autocomplete(html, html_id) {
    var url = baseurl + "/get/job_post/ojob_post";
    html.autocomplete({
      serviceUrl: url,
      type: "GET",
      dataType: "json",
      showNoSuggestionNotice: true,
      noSuggestionNotice: "Sorry, no matching results",
      autoSelectFirst: true,
      triggerSelectOnValidInput: true,
      orientation: "auto",
      tabDisabled: true,
      transformResult: function (response) {
        return {
          suggestions: $.map(response.data, function (dataItem) {
            if (
              dataItem.job_title
                .toLowerCase()
                .indexOf(html.val().toLowerCase()) > -1
            ) {
              return { value: dataItem.job_title, data: dataItem.id };
            } //end if
          }),
        };
      },
      onSelect: function (suggestion) {
        //html_id.val(suggestion.data);

        var name = html_id.attr("name");
        name = name.substring(name.indexOf("[") + 1);
        name = name.substring(0, name.lastIndexOf("]"));
        var dup = 0;
        $("#" + name + "_cont")
          .find(".edit_link")
          .each(function () {
            var value = $(this).text();
            if (value.toLowerCase() === suggestion.value.toLowerCase()) {
              dup = 1;
              return false;
            } //end if
          });

        if (dup == 0) {
          var html_txt = "";
          html_txt += '<div class="col ">';
          html_txt +=
            '<small class="d-none"><a style="text-decoration:none;" class="edit_link">' +
            suggestion.value +
            "</a></small>";
          html_txt +=
            '<small><a style="text-decoration:none;">' +
            suggestion.value +
            "</a></small>";
          html_txt +=
            '<button type="button" title="Remove" class="text-danger close remove_append" aria-id="' +
            suggestion.value +
            '">&times;</button>';
          html_txt += "</div>";
          $("#" + name + "_cont").append(html_txt);
          html.val("");
          html.focus();
          $(".btn_find").trigger("click");
        } //end if
      },

      onSearchComplete: function (query, suggestions) {},
    });
  }

  //language autocomplete
  function load_language_autocomplete(html, html_id) {
    var url = baseurl + "/get/job_post_no_inactive/profile_language";
    html.autocomplete({
      serviceUrl: url,
      type: "GET",
      dataType: "json",
      showNoSuggestionNotice: true,
      noSuggestionNotice: "Sorry, no matching results",
      autoSelectFirst: true,
      triggerSelectOnValidInput: true,
      orientation: "auto",
      tabDisabled: true,
      transformResult: function (response) {
        return {
          suggestions: $.map(response.data, function (dataItem) {
            if (
              dataItem.language
                .toLowerCase()
                .indexOf(html.val().toLowerCase()) > -1
            ) {
              return { value: dataItem.language, data: dataItem.id };
            } //end if
          }),
        };
      },
      onSelect: function (suggestion) {
        //html_id.val(suggestion.data);

        var name = html_id.attr("name");
        name = name.substring(name.indexOf("[") + 1);
        name = name.substring(0, name.lastIndexOf("]"));
        var dup = 0;
        $("#" + name + "_cont")
          .find(".edit_link")
          .each(function () {
            var value = $(this).text();
            if (value.toLowerCase() === suggestion.value.toLowerCase()) {
              dup = 1;
              return false;
            } //end if
          });

        if (dup == 0) {
          var html_txt = "";
          html_txt += '<div class="col ">';
          html_txt +=
            '<small class="d-none"><a style="text-decoration:none;" class="edit_link">' +
            suggestion.value +
            "</a></small>";
          html_txt +=
            '<small><a style="text-decoration:none;">' +
            suggestion.value +
            "</a></small>";
          html_txt +=
            '<button type="button" title="Remove" class="text-danger close remove_append" aria-id="' +
            suggestion.value +
            '">&times;</button>';
          html_txt += "</div>";
          $("#" + name + "_cont").append(html_txt);
          html.val("");
          html.focus();
          $(".btn_find").trigger("click");
        } //end if
      },

      onSearchComplete: function (query, suggestions) {},
    });
  }

  //skills autocomplete
  function load_skills_autocomplete(html, html_id) {
    var url = baseurl + "/get/job_post_no_inactive/profile_skills";
    html.autocomplete({
      serviceUrl: url,
      type: "GET",
      dataType: "json",
      showNoSuggestionNotice: true,
      noSuggestionNotice: "Sorry, no matching results",
      autoSelectFirst: true,
      triggerSelectOnValidInput: true,
      orientation: "auto",
      tabDisabled: true,
      transformResult: function (response) {
        return {
          suggestions: $.map(response.data, function (dataItem) {
            if (
              dataItem.skills.toLowerCase().indexOf(html.val().toLowerCase()) >
              -1
            ) {
              return { value: dataItem.skills, data: dataItem.id };
            } //end if
          }),
        };
      },
      onSelect: function (suggestion) {
        //html_id.val(suggestion.data);

        var name = html_id.attr("name");
        name = name.substring(name.indexOf("[") + 1);
        name = name.substring(0, name.lastIndexOf("]"));
        var dup = 0;
        $("#" + name + "_cont")
          .find(".edit_link")
          .each(function () {
            var value = $(this).text();
            if (value.toLowerCase() === suggestion.value.toLowerCase()) {
              dup = 1;
              return false;
            } //end if
          });

        if (dup == 0) {
          var html_txt = "";
          html_txt += '<div class="col ">';
          html_txt +=
            '<small class="d-none"><a style="text-decoration:none;" class="edit_link">' +
            suggestion.value +
            "</a></small>";
          html_txt +=
            '<small><a style="text-decoration:none;">' +
            suggestion.value +
            "</a></small>";
          html_txt +=
            '<button type="button" title="Remove" class="text-danger close remove_append" aria-id="' +
            suggestion.value +
            '">&times;</button>';
          html_txt += "</div>";
          $("#" + name + "_cont").append(html_txt);
          html.val("");
          html.focus();
          $(".btn_find").trigger("click");
        } //end if
      },

      onSearchComplete: function (query, suggestions) {},
    });
  }

  function load_location_autocomplete(html, html_id) {
    var url = baseurl + "/get/job_post/olocation";
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
        tabDisabled: true,

        beforeRender: function (container, suggestions) {
          //container.find('.autocomplete-suggestion').each(function(i, suggestion){
          //suggestion.append('<input type="checkbox"/>')
          // suggestion.append(); suggestion.preppend(); suggestion.whatever()
          //});
        },
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
          html_id.val(suggestion.data + ",");

          var name = html_id.attr("name");
          name = name.substring(name.indexOf("[") + 1);
          name = name.substring(0, name.lastIndexOf("]"));
          var dup = 0;
          $("#" + name + "_cont")
            .find(".edit_link")
            .each(function () {
              var value = $(this).text();
              if (value.toLowerCase() === suggestion.data.toLowerCase()) {
                dup = 1;
                return false;
              } //end if
            });

          if (dup == 0) {
            var html_txt = "";
            html_txt += '<div class="col ">';
            html_txt +=
              '<small class="d-none"><a style="text-decoration:none;" class="edit_link">' +
              suggestion.data +
              "</a></small>";
            html_txt +=
              '<small><a style="text-decoration:none;">' +
              suggestion.value +
              "</a></small>";
            html_txt +=
              '<button type="button" title="Remove" class="text-danger close remove_append" aria-id="' +
              suggestion.data +
              '">&times;</button>';
            html_txt += "</div>";
            $("#" + name + "_cont").append(html_txt);
            html.val("");
            html.focus();
            $(".btn_find").trigger("click");
          } //end if
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
        tabDisabled: true,
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

          var name = html_id.attr("name");
          name = name.substring(name.indexOf("[") + 1);
          name = name.substring(0, name.lastIndexOf("]"));
          var dup = 0;
          $("#" + name + "_cont")
            .find(".edit_link")
            .each(function () {
              var value = $(this).text();
              if (value.toLowerCase() === suggestion.data.toLowerCase()) {
                dup = 1;
                return false;
              } //end if
            });

          if (dup == 0) {
            var html_txt = "";
            html_txt += '<div class="col ">';
            html_txt +=
              '<small class="d-none"><a style="text-decoration:none;" class="edit_link">' +
              suggestion.data +
              "</a></small>";
            html_txt +=
              '<small><a style="text-decoration:none;">' +
              suggestion.value +
              "</a></small>";
            html_txt +=
              '<button type="button" title="Remove" class="text-danger close remove_append" aria-id="' +
              suggestion.data +
              '">&times;</button>';
            html_txt += "</div>";
            $("#" + name + "_cont").append(html_txt);
            html.val("");
            html.focus();
            $(".btn_find").trigger("click");
          } //end if
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
        tabDisabled: true,
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

          var name = html_id.attr("name");
          name = name.substring(name.indexOf("[") + 1);
          name = name.substring(0, name.lastIndexOf("]"));
          var dup = 0;
          $("#" + name + "_cont")
            .find(".edit_link")
            .each(function () {
              var value = $(this).text();
              if (value.toLowerCase() === suggestion.data.toLowerCase()) {
                dup = 1;
                return false;
              } //end if
            });

          if (dup == 0) {
            var html_txt = "";
            html_txt += '<div class="col ">';
            html_txt +=
              '<small class="d-none"><a style="text-decoration:none;" class="edit_link">' +
              suggestion.data +
              "</a></small>";
            html_txt +=
              '<small><a style="text-decoration:none;">' +
              suggestion.value +
              "</a></small>";
            html_txt +=
              '<button type="button" title="Remove" class="text-danger close remove_append" aria-id="' +
              suggestion.data +
              '">&times;</button>';
            html_txt += "</div>";
            $("#" + name + "_cont").append(html_txt);
            html.val("");
            html.focus();
            $(".btn_find").trigger("click");
          } //end if
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
        tabDisabled: true,
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

          var name = html_id.attr("name");
          name = name.substring(name.indexOf("[") + 1);
          name = name.substring(0, name.lastIndexOf("]"));
          var dup = 0;
          $("#" + name + "_cont")
            .find(".edit_link")
            .each(function () {
              var value = $(this).text();
              if (value.toLowerCase() === suggestion.data.toLowerCase()) {
                dup = 1;
                return false;
              } //end if
            });

          if (dup == 0) {
            var html_txt = "";
            html_txt += '<div class="col ">';
            html_txt +=
              '<small class="d-none"><a style="text-decoration:none;" class="edit_link">' +
              suggestion.data +
              "</a></small>";
            html_txt +=
              '<small><a style="text-decoration:none;">' +
              suggestion.value +
              "</a></small>";
            html_txt +=
              '<button type="button" title="Remove" class="text-danger close remove_append" aria-id="' +
              suggestion.data +
              '">&times;</button>';
            html_txt += "</div>";
            $("#" + name + "_cont").append(html_txt);
            html.val("");
            html.focus();
            $(".btn_find").trigger("click");
          } //end if
        },

        onSearchComplete: function (query, suggestions) {
          if (suggestions.length == 0) {
            html_id.val("");
          } else {
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
        tabDisabled: true,
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

          var name = html_id.attr("name");
          name = name.substring(name.indexOf("[") + 1);
          name = name.substring(0, name.lastIndexOf("]"));
          var dup = 0;
          $("#" + name + "_cont")
            .find(".edit_link")
            .each(function () {
              var value = $(this).text();
              if (value.toLowerCase() === suggestion.data.toLowerCase()) {
                dup = 1;
                return false;
              } //end if
            });

          if (dup == 0) {
            var html_txt = "";
            html_txt += '<div class="col ">';
            html_txt +=
              '<small class="d-none"><a style="text-decoration:none;" class="edit_link">' +
              suggestion.data +
              "</a></small>";
            html_txt +=
              '<small><a style="text-decoration:none;">' +
              suggestion.value +
              "</a></small>";
            html_txt +=
              '<button type="button" title="Remove" class="text-danger close remove_append" aria-id="' +
              suggestion.data +
              '">&times;</button>';
            html_txt += "</div>";
            $("#" + name + "_cont").append(html_txt);
            html.val("");
            html.focus();
            $(".btn_find").trigger("click");
          } //end if
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
