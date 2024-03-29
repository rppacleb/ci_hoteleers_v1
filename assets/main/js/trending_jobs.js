$(document).ready(function () {
  //if(type === 'public'){
  $("#side_menu").addClass("d-none");
  //}else{
  //$('#side_menu').addClass('d-none');
  //}

  $("#right-menu").removeClass("col-xl-9 col-lg-9");
  $("#right-menu").addClass("col-xl-11 col-lg-11");

  if ($(window).width() <= 480) {
    $("#main_container").css({
      "max-width": "400px",
      "margin-right": "auto",
      "margin-left": "auto",
    });
  }

  if ($(window).width() >= 1441) {
    $("#right-menu").css({
      "max-width": "1440px",
      "margin-right": "auto",
      "margin-left": "auto",
    });
    $(".desktop-tjspacer").css("width", "20%");
    $(".desktop-tjspacer2").css("width", "3.333333%");
  }

  var homeurl = baseurl + "/trending_jobs";
  var homeurl_txt = "trending_jobs";
  var urlimgdef = baseurl + "/files/images/default/image.png";
  var upload_path = baseurl + "/files/uploads/";

  load_record(
    0,
    "employer",
    "main_container",
    "main_pagination",
    "main_loader"
  );

  //load record
  function load_record(page, type, container, pagination, loader) {
    var edit_url = homeurl + "/private/edit/";
    var view_url = baseurl + "/job_search/private/view/";
    var user_url = baseurl + "/user";
    var not_loggedin = baseurl + "/login?type=job_search&rdr_id=";
    var logo_url = baseurl + "/company_info_public/view/";
    var data = {};
    data.page = page;
    data.sort = $("select[name=header\\[sort\\]]").val();
    data.keyword = $("input[name=header\\[keyword\\]]").val();
    data.user_id = user_id;

    //get_location
    data.locality = [];
    data.administrative_area_level_1 = [];
    data.country = [];
    $(".edit_link_locality").each(function () {
      data.locality.push($(this).text());
    });
    $(".edit_link_administrative_area_level_1").each(function () {
      data.administrative_area_level_1.push($(this).text());
    });
    $(".edit_link_country").each(function () {
      data.country.push($(this).text());
    });
    //end get location

    //get job level
    data.job_level = [];
    $("div#job_level_cont .edit_link").each(function () {
      data.job_level.push($(this).text());
    });
    //end get job level

    //get job type
    data.job_type = [];
    $("div#job_type_cont .edit_link").each(function () {
      data.job_type.push($(this).text());
    });
    //end get job type

    //get education
    data.education = [];
    $("div#education_cont .edit_link").each(function () {
      data.education.push($(this).text());
    });
    //end get education

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

            html +=
              '<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-xs-12" style="float:left;min-width:2.5in;" >';
            html += '<div class="card mb-3" style="min-height:4.2in;">';
            if ($(window).width() >= 1441) {
              html +=
                "<img onClick=\"window.open('" +
                logo_url +
                value.employer +
                '\')" style="height:285px;padding: 0.75rem;" class="card-img-top"';
              html +=
                'src="' +
                img_src +
                '" alt="' +
                value.company_name +
                '" title="' +
                value.company_name +
                '">';
              html += '<div class="card-body">';
            } else if ($(window).width() >= 1281 && $(window).width() <= 1440) {
              html +=
                "<img onClick=\"window.open('" +
                logo_url +
                value.employer +
                '\')" style="height:265px;padding: 0.75rem;" class="card-img-top"';
              html +=
                'src="' +
                img_src +
                '" alt="' +
                value.company_name +
                '" title="' +
                value.company_name +
                '">';
              html += '<div class="card-body">';
            } else if ($(window).width() <= 480 && $(window).width() >= 376) {
              html +=
                "<img onClick=\"window.open('" +
                logo_url +
                value.employer +
                '\')" style="height:330px;padding: 0.75rem;" class="card-img-top"';
              html +=
                'src="' +
                img_src +
                '" alt="' +
                value.company_name +
                '" title="' +
                value.company_name +
                '">';
              html += '<div class="card-body">';
            } else if ($(window).width() <= 375) {
              html +=
                "<img onClick=\"window.open('" +
                logo_url +
                value.employer +
                '\')" style="height:290px;padding: 0.75rem;" class="card-img-top"';
              html +=
                'src="' +
                img_src +
                '" alt="' +
                value.company_name +
                '" title="' +
                value.company_name +
                '">';
              html += '<div class="card-body">';
            } else {
              html +=
                "<img onClick=\"window.open('" +
                logo_url +
                value.employer +
                '\')" style="height:250px;padding: 0.75rem;" class="card-img-top"';
              html +=
                'src="' +
                img_src +
                '" alt="' +
                value.company_name +
                '" title="' +
                value.company_name +
                '">';
              html += '<div class="card-body">';
            }

            if ($(window).width() <= 1280 && $(window).width() >= 1024) {
              var job_title_placeholder = value.job_title.substring(0, 25);
              var job_title_placeholder_length = value.job_title.length;

              if (job_title_placeholder_length > 25) {
                job_title_placeholder = job_title_placeholder + "...";
                html +=
                  '<a href="' +
                  view_url +
                  value.id +
                  '" style="text-decoration:none;"><h6 class="card-title text-link" data-tj-title="' +
                  value.job_title +
                  '">' +
                  job_title_placeholder +
                  "</h6></a>";
              } else {
                html +=
                  '<a href="' +
                  view_url +
                  value.id +
                  '" style="text-decoration:none;"><h6 class="card-title text-link">' +
                  job_title_placeholder +
                  "</h6></a>";
              }

              var company_placeholder = value.company_name.substring(0, 20);
              var company_placeholder_length = value.company_name.length;

              html += '<div class="mb-0">';
              if (company_placeholder_length > 20) {
                company_placeholder = company_placeholder + "...";
                html +=
                  '<small class="text-muted" style="font-size:9pt !important"><b data-tj-companyname="' +
                  value.company_name +
                  '">' +
                  company_placeholder +
                  "</b></small>";
              } else {
                html +=
                  '<small class="text-muted" style="font-size:9pt !important"><b>' +
                  company_placeholder +
                  "</b></small>";
              }
            } else if ($(window).width() <= 1440 && $(window).width() >= 1281) {
              var job_title_placeholder = value.job_title.substring(0, 28);
              var job_title_placeholder_length = value.job_title.length;

              if (job_title_placeholder_length > 28) {
                job_title_placeholder = job_title_placeholder + "...";
                html +=
                  '<a href="' +
                  view_url +
                  value.id +
                  '" style="text-decoration:none;"><h6 class="card-title text-link" data-tj-title="' +
                  value.job_title +
                  '">' +
                  job_title_placeholder +
                  "</h6></a>";
              } else {
                html +=
                  '<a href="' +
                  view_url +
                  value.id +
                  '" style="text-decoration:none;"><h6 class="card-title text-link">' +
                  job_title_placeholder +
                  "</h6></a>";
              }

              var company_placeholder = value.company_name.substring(0, 28);
              var company_placeholder_length = value.company_name.length;

              html += '<div class="mb-0">';
              if (company_placeholder_length > 28) {
                company_placeholder = company_placeholder + "...";
                html +=
                  '<small class="text-muted" style="font-size:9pt !important"><b data-tj-companyname="' +
                  value.company_name +
                  '">' +
                  company_placeholder +
                  "</b></small>";
              } else {
                html +=
                  '<small class="text-muted" style="font-size:9pt !important"><b>' +
                  company_placeholder +
                  "</b></small>";
              }
            } else {
              var job_title_placeholder = value.job_title.substring(0, 45);
              var job_title_placeholder_length = value.job_title.length;

              if (job_title_placeholder_length > 45) {
                job_title_placeholder = job_title_placeholder + "...";
                html +=
                  '<a href="' +
                  view_url +
                  value.id +
                  '" style="text-decoration:none;"><h6 class="card-title text-link" data-tj-title="' +
                  value.job_title +
                  '">' +
                  job_title_placeholder +
                  "</h6></a>";
              } else {
                html +=
                  '<a href="' +
                  view_url +
                  value.id +
                  '" style="text-decoration:none;"><h6 class="card-title text-link">' +
                  job_title_placeholder +
                  "</h6></a>";
              }

              var company_placeholder = value.company_name.substring(0, 45);
              var company_placeholder_length = value.company_name.length;

              html += '<div class="mb-0">';
              if (company_placeholder_length > 45) {
                company_placeholder = company_placeholder + "...";
                html +=
                  '<small class="text-muted" style="font-size:9pt !important"><b data-tj-companyname="' +
                  value.company_name +
                  '"><a href="' +
                  logo_url +
                  value.employer +
                  '" style="text-decoration:none;color:rgb(0, 41, 170) !important;">' +
                  company_placeholder +
                  "</a></b></small>";
              } else {
                html +=
                  '<small class="text-muted" style="font-size:9pt !important"><b><a href="' +
                  logo_url +
                  value.employer +
                  '" style="text-decoration:none;color:rgb(0, 41, 170) !important;">' +
                  company_placeholder +
                  "</a></b></small>";
              }
            }

            html += "</div>";
            html += '<div class="mb-0">';
            html +=
              '<small class="text-muted" style="font-size:9pt !important"><b>' +
              value.location_placeholder +
              "</b></small>";
            html += "</div>";

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
              //html += '<button class="mr-3 btn '+btn_attr+' btn_add_fav" aria-saved="'+parseInt(value.saved)+'" aria-id="'+value.id+'">'+logo+'</button>';

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

            /*html += '<div class="col">';
                            html += '<div class="card" style="width: 18rem;">';
                                html += '<img class="rounded" style="height:100%;width:100%;" src="'+img_src+'" alt="Card image cap">';
                                html += '<div class="card-body" style="min-height:3.5in;">';
                                    html += '<h5 class="card-title text-muted">'+value.company_name+'</h5>';
                                    html += '<h5 class="card-title text-link">'+value.job_title+'</h5>';
                                    html += '<div class="row mb-2">';

                                        html += '<div class="col">';
                                            html += '<small class="text-muted"><b>'+value.location+'</b></small>';
                                        html += '</div>';
                                        
                                    html += '</div>';

                                    html += '<div class="row mb-2">';
                                        html += '<div class="col">';
                                            html += '<div>';
                                                html += '<small class="text-muted text-right">Apply Before</small>';
                                            html += '</div>';
                                            html += '<div>';
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
                                                    var btn_attr = "";
                                                    if(parseInt(value.saved)){
                                                        btn_attr = "disabled";
                                                    }
                                                    html += '<button '+btn_attr+' class="btn btn-pill-sm btn-pill-outline-link text-link btn_add_fav" aria-id="'+value.id+'"><i class="fa fa-heart"></i></button>';
                                                    html += '<a href="'+view_url+value.id+'" class="btn btn-pill-sm btn-pill-outline-link text-link btn_view">View</a>';
                                                html += '</div>';
                                            html += '</div>';
                                        html += '</div>';
                                    html += '</div>';                    
                                html += '</div>';
                            html += '</div>';
                        html += '</div>';
                        */

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
                                                        var btn_attr = "";
                                                        if(parseInt(value.saved)){
                                                            btn_attr = "disabled";
                                                        }
                                                        html += '<button '+btn_attr+' class="btn btn-pill-sm btn-pill-outline-link text-link btn_add_fav" aria-id="'+value.id+'"><i class="fa fa-heart"></i></button>';
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

  //add favorites
  $(document.body).on("click", "button.btn_add_fav", function (e) {
    var view_url = homeurl;

    var id = $(this).attr("aria-id");
    var saved = $(this).attr("aria-saved");
    var btn = $(this);
    var btn_text = "";

    var type_text = "";

    var url = baseurl + "/job_search";
    url += "/add_fav/list";

    var frm_id = "";

    var data = {};
    data.header = {};
    data.header.id = id;

    var basic_btn = "btn-pill-hover-link btn-pill-lg text-link";
    var saved_btn = "btn-pill-hover-primary btn-pill-lg text-primary";

    var basic_logo = '<i class="fa fa-heart-o"></i>';
    var saved_logo = '<i class="fa fa-heart"></i>';

    btn_text = '<i class="fa fa-heart"></i>';

    var msg_txt = "save";
    if (parseInt(saved)) {
      msg_txt = "unsave";
    } //end if

    if (confirm("Are you sure you want to " + msg_txt + " this job?")) {
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
    } //end if
  }); //end if
  //end add favorites

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

  //remove appended data
  $(document.body).on("click", ".remove_append", function (e) {
    $(this).parent().remove();
    $(".btn_find").trigger("click");
  });
  //remove appended data

  //clear filter
  $(document.body).on("click", "a[name=btn_clear_filter]", function (e) {
    //$(this).parent().remove();
    $("input[name=header\\[keyword\\]]").val("");
    $("#location_cont").empty();
    $("#job_level_cont").empty();
    $("#job_type_cont").empty();
    $("#education_cont").empty();
    $("#industry_cont").empty();
    $("#department_cont").empty();
    $(".btn_find").trigger("click");
  });
  //clear filter
  //=====================================================================================================================
  //end events

  //autocomplete
  //===============================================================================================================================
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
