$(document).ready(function () {
  //highlight
  $("#side_insight").removeClass("text-muted");
  $("#side_insight").addClass("active");
  $("#side_insight").css({
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

  var homeurl = baseurl + "/insight_all";
  var homeurl_txt = "insight_all";
  var urlimgdef = baseurl + "/files/images/default/image.png";
  var upload_path = baseurl + "/files/uploads/";

  load_record(
    0,
    view_type,
    "active_container",
    "active_pagination",
    "active_loader",
    function () {
      /*load_record(0,'hired','hired_container','hired_pagination','hired_loader',function(){
            load_record(0,'deactivated','deactivated_container','deactivated_pagination','deactivated_loader',function(){
                
            });
        });*/
      $("#loading").hide();
    }
  );

  //load record
  function load_record(page, type, container, pagination, loader, callback) {
    var edit_url = baseurl + "/applicant_info/view/";
    var view_url = "";
    var user_url = baseurl + "/user";

    var job_post_edit_url = baseurl + "/job_post_copy/edit/";
    var job_post_copy_url = baseurl + "/job_post_copy/copy/";

    var data = {};
    data.page = page;
    data.keyword = $("input[name=header\\[keyword_" + type + "\\]]").val();
    data.user_id = user_id;
    data.employer_id = employer_id;

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
            view_url = baseurl + "/active_jobs_applicant?job_post=";
            var html = "";

            var img_src = "";
            if (value.doc_image === null || value.doc_image == "") {
              img_src = urlimgdef;
            } else {
              img_src = upload_path + value.doc_image;
            } //end if

            if ($(window).width() <= 1440 && $(window).width() >= 1380) {
              var job_title_placeholder = value.job_title.substring(0, 20);
              var job_title_placeholder_length = value.job_title.length;

              if (job_title_placeholder_length > 20) {
                job_title_placeholder = job_title_placeholder + "...";
              } //end if
            } else if ($(window).width() <= 1379 && $(window).width() >= 1281) {
              var job_title_placeholder = value.job_title.substring(0, 20);
              var job_title_placeholder_length = value.job_title.length;

              if (job_title_placeholder_length > 20) {
                job_title_placeholder = job_title_placeholder + "...";
              } //end if
            } else if ($(window).width() <= 1280 && $(window).width() >= 1024) {
              var job_title_placeholder = value.job_title.substring(0, 24);
              var job_title_placeholder_length = value.job_title.length;

              if (job_title_placeholder_length > 24) {
                job_title_placeholder = job_title_placeholder + "...";
              } //end if
            } else {
              var job_title_placeholder = value.job_title.substring(0, 22);
              var job_title_placeholder_length = value.job_title.length;

              if (job_title_placeholder_length > 22) {
                job_title_placeholder = job_title_placeholder + "...";
              } //end if
            }

            if (value.hiring_speed == null) {
              value.hiring_speed = 0;
            }

            view_url += value.id;
            if (type == "hired") {
              view_url += "&status=closed";
              view_url += "&mod_type=side_hired_jobs";
            } else if (type == "deactivated") {
              view_url += "&status=deactivated";
              view_url += "&mod_type=side_deactivated";
            } else {
              view_url += "&mod_type=side_insight";
            } //end if

            html += '<div class="row mb-3">';
            html += '<div class="col">';
            html += '<div class="card">';
            html += '<div class="card-body">';
            html += '<div class="row">';

            //html += '<div class="col-3">';
            //html += '<img class="rounded-circle" style="height:0.5in;width:0.5in;" src="'+img_src+'" alt="Card image cap"><br/>'+value.name;
            //html += '</div><!--./col-->';
            html +=
              '<div class="col-1 align-self-center text-muted text-center" style="max-width: 7.3%;">';
            html += value.id;
            html += "</div><!--./col-->";
            html +=
              '<div class="col align-self-center text-break" style="min-width:1in;">';
            html +=
              '<a style="text-decoration:none;" href="' +
              view_url +
              '" class="text-link">' +
              job_title_placeholder +
              "</a>";
            html += "</div><!--./col-->";
            html += '<div class="col align-self-center text-muted text-left">';
            html += value.job_expiration_date;
            html += "</div><!--./col-->";
            html += '<div class="col align-self-center text-muted text-left">';
            html += value.hired_applicant + "/" + value.vacancies_placeholder;
            html += "</div><!--./col-->";

            html += '<div class="col align-self-center text-muted text-left">';
            html += value.hiring_speed;
            html += "</div><!--./col-->";

            html += '<div class="col align-self-center text-muted text-left">';
            html += value.job_post_views;
            html += "</div><!--./col-->";

            html +=
              '<div class="col-xl-1 col-lg-1 align-self-center text-center d-none" style="min-width:1.5in;">';

            var w = window.innerWidth / 2 + 160;
            var l = w / 2 / 2;
            var h = window.innerHeight / 2 + 160;
            var t = h / 2 / 2;
            //html += '<div class="btn-group btn-group-toggle">';
            html +=
              '<button data-toggle="modal" data-target="#pie_chart_modal" type="button" data-id="' +
              value.id +
              '" class="btn btn-pill-sm btn-pill-sm-outline-light text-muted mr-1 btn_save"><i class="fa fa-pie-chart"></i></button>';

            //html += '<button type="button" onclick="window.open('+"'"+job_post_copy_url+value.id+"'"+',\'newwindow\',\'width='+w+',height='+h+',status=0,left='+l+',top='+t+'\'); return false;" data-id="'+value.id+'" class="btn btn-pill-sm btn-pill-sm-outline-light text-muted btn_save"><i class="fa fa-copy"></i></button>';

            //html += '<a href="#" class="btn btn-pill-sm btn-pill-outline-link text-link btn_save">Save</a>';
            //html += '<a href="'+view_url+value.id+'&status=closed" class="btn btn-pill-sm btn-pill-outline-link text-link btn_view">View</a>';
            //html += '<button aria-id="'+value.id+'" class="btn btn-pill-sm btn-pill-outline-primary text-primary btn_delete">Delete</button>';
            //html += '</div>';
            html += "</div><!--./col-->";
            html += "</div><!--./row-->";
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

        callback();
      })
      .fail(function (e) {
        alert(e.responseText);
        callback();
      })
      .always(function (e) {});
  } //end load_record

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

  //find
  $(document.body).on("click", "button.btn_find", function (e) {
    var type = $(this).attr("aria-type");
    $("input[name=header\\[keyword_" + type + "\\]]").trigger("blur");
  }); //end if
  //end find

  //find
  $(document.body).on(
    "blur",
    "input[name=header\\[keyword_hired\\]]",
    function (e) {
      var type = $(this).attr("aria-type");
      load_record(
        0,
        type,
        type + "_container",
        type + "_pagination",
        type + "_loader"
      );
    }
  ); //end if
  //end find

  //find
  $(document.body).on(
    "blur",
    "input[name=header\\[keyword_active\\]]",
    function (e) {
      var type = $(this).attr("aria-type");
      load_record(
        0,
        type,
        type + "_container",
        type + "_pagination",
        type + "_loader"
      );
    }
  ); //end if
  //end find

  //find
  $(document.body).on(
    "blur",
    "input[name=header\\[keyword_deactivated\\]]",
    function (e) {
      var type = $(this).attr("aria-type");
      load_record(
        0,
        type,
        type + "_container",
        type + "_pagination",
        type + "_loader"
      );
    }
  ); //end if
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

  //remove active job post
  $(document.body).on("click", "button.btn_remove", function (e) {
    var view_url = window.location.href;

    var id = $(this).attr("aria-id");
    var btn = $(this);
    var btn_text = "";

    var type_text = "";

    var url = homeurl;
    url = homeurl + "/remove_job_post/list";

    var frm_id = "";

    var data = {};
    data.header = {};
    data.header.id = id;

    btn_text = '<i class="fa fa-times"></i>';

    if (confirm("This will automatically remove the job withn 30 days!")) {
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
        load_job_title_autocomplete(
          $(this),
          $("input[name=header\\[job_title\\]]")
        );
        $(this).addClass("wauto");
      } //End if
    }
  ); //focus
  $(document.body).on("blur", "input[name=header\\[job_title\\]]", function () {
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
        $(".btn_find").trigger("click");
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
        $(".btn_find").trigger("click");
      } //end if
    } //end if
  }); //blur

  //load skills autocomplete
  $(document.body).on("focus", "input[name=header\\[skills\\]]", function () {
    if (!$(this).hasClass("wauto")) {
      load_skills_autocomplete($(this), $("input[name=header\\[skills\\]]"));
      $(this).addClass("wauto");
    } //End if
  }); //focus
  $(document.body).on("blur", "input[name=header\\[skills\\]]", function () {
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
        $(".btn_find").trigger("click");
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
        $(".btn_find").trigger("click");
      } //end if
    } //end if
  }); //blur

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
    $("#job_title_cont").empty();
    $("#years_cont").empty();
    $("#education_cont").empty();
    $("#language_cont").empty();
    $("#skills_cont").empty();
    $("#location_cont").empty();
    $(".btn_find").trigger("click");
  });
  //clear filter
  //=====================================================================================================================
  //end events

  //autocomplete
  //===============================================================================================================================

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

  //modal
  //=======================================================================================================================
  //Lookup Modal
  $("#pie_chart_modal").on("shown.bs.modal", function (e) {
    var id = $(e.relatedTarget).data("id");

    /*var xArray = ["Italy", "France", "Spain", "USA", "Argentina"];
        var yArray = [55, 49, 44, 24, 15];
        var layout = {title:"World Wide Wine Production"};
        var data = [{labels:xArray, values:yArray, type:"pie"}];

        Plotly.newPlot("myPlot", data, layout);
        */

    //get data
    var param = {};
    param.id = id;
    load_pie_chart(param);
    //end get data
  });

  $("#pie_chart_modal").on("hide.bs.modal", function (e) {
    //$('#job_post_modal_title').empty();
    $("#myPlot").empty();
    $("#legend_container").empty();
  });
  //End Lookup Modal
  //=======================================================================================================================
  //end modal

  //load data
  //=======================================================================================================================
  function load_pie_chart(param) {
    var url = homeurl + "/get_pie_chart_data";
    var div = $("#myPlot");
    var div2 = $("#legend_container");
    $.ajax({
      url: url,
      type: "POST",
      data: param,
      dataType: "JSON",
      beforeSend: function () {
        div.html('<div class="spinner-grow"></div>');
        div2.html('<div class="spinner-grow"></div>');
      },
    }).done(function (response) {
      div.empty();
      var config = {
        showLink: false,
        showEditInChartStudio: false,
        displaylogo: false,
        displayModeBar: false,
        responsive: true,
        plotlyServerURL: "https://chart-studio.plotly.com",
      };
      var xArray = new Array();
      var yArray = new Array();
      var colors = new Array(
        "#1f77b4", // muted blue
        "#ff7f0e", // safety orange
        "#2ca02c", // cooked asparagus green
        "#d62728", // brick red
        "#9467bd", // muted purple
        "#8c564b", // chestnut brown
        "#e377c2", // raspberry yogurt pink
        "#7f7f7f", // middle gray
        "#bcbd22", // curry yellow-green
        "#17becf" // blue-teal
      );

      var param = {};
      param.data = new Array();

      if (response.data !== null && response.data !== undefined) {
        var html = "";

        var data = new google.visualization.DataTable();
        data.addColumn("string", "Location");
        data.addColumn("number", "%");
        data.addColumn("number", "Count");

        data.addRows(response.data.length);

        var divisor = 0;
        for (var key in response.data) {
          divisor += parseInt(response.data[key].count);
        } //end if

        for (var key in response.data) {
          var percentage = (parseInt(response.data[key].count) / divisor) * 100;
          percentage = catchIsNaN(percentage);

          data.setCell(parseInt(key), 0, response.data[key].country);
          data.setCell(parseInt(key), 1, percentage);
          data.setCell(parseInt(key), 2, parseInt(response.data[key].count));

          html += '<div class="row mb-2">';
          html += '<div class="col">';
          html += '<div class="card">';
          html += '<div class="card-body">';
          html += '<div class="row">';
          html += '<div class="col-1 align-self-center text-center">';
          html +=
            '<span class="dot" style="background-color:' +
            colors[key] +
            '"></span> ';
          html += "</div><!--./col-->";

          html +=
            '<div class="col align-self-center fw-bolder text-left text-muted">';
          if (response.data[key].country == "") {
            html += "Unknown";
          } else {
            html += response.data[key].country;
          }
          html += "</div><!--./col-->";
          html +=
            '<div class="col-3 align-self-center fw-bolder text-muted text-center">';
          html += percentage;
          html += "</div><!--./col-->";
          html +=
            '<div class="col-3 align-self-center fw-bolder text-muted text-center">';
          html += response.data[key].count;
          html += "</div><!--./col-->";

          html += "</div><!--./row-->";
          html += "</div><!--./card-body-->";
          html += "</div><!--./card-->";
          html += "</div><!--./col-->";
          html += "</div><!--./row-->";

          xArray.push("<b>" + response.data[key].country + "</b>");

          yArray.push(response.data[key].count);

          if (key == 0) {
            param.data[param.data.length] = new Array("Contry", "Mhl");
          }
          param.data[param.data.length] = new Array(
            response.data[key].country,
            parseInt(response.data[key].count)
          );
        } //end fory
        //var layout  = {showlegend: false};
        //var data    = [{labels:xArray, values:yArray, type:"pie"}];
        //var chart = Plotly.newPlot("myPlot", data, layout, config);

        div2.html(html);
        // alert(JSON.stringify(param.data))

        google.charts.setOnLoadCallback(drawSort(data));
      } else {
        div.html("<h2>No Data</h2>");
        div2.html("");
      } //end function
      //div.html('<div class="spinner-grow"></div>');
    });
  } //end function

  function drawChart(param) {
    var data = google.visualization.arrayToDataTable(param.data);

    var options = {
      title: "World Wide Wine Production",
    };

    var chart = new google.visualization.PieChart(
      document.getElementById("myPlot")
    );
    chart.draw(data, options);
  }

  function drawSort(data) {
    var colors = new Array(
      "#1f77b4", // muted blue
      "#ff7f0e", // safety orange
      "#2ca02c", // cooked asparagus green
      "#d62728", // brick red
      "#9467bd", // muted purple
      "#8c564b", // chestnut brown
      "#e377c2", // raspberry yogurt pink
      "#7f7f7f", // middle gray
      "#bcbd22", // curry yellow-green
      "#17becf" // blue-teal
    );
    var options = {
      colors: colors,
      displayAnnotations: true,
      legend: "none",
    };

    var view = new google.visualization.DataView(data);
    view.setColumns([0, 2]);

    var table = new google.visualization.Table(
      document.getElementById("table_sort_div")
    );
    //table.draw(data, {width: '100%', height: '100%'});

    var chart = new google.visualization.PieChart(
      document.getElementById("myPlot")
    );
    chart.draw(view, options);

    /*google.visualization.events.addListener(table, 'sort',
          function(event) {
            data.sort([{column: event.column, desc: !event.ascending}]);
            chart.draw(view,options);
          });*/
  }
  //=======================================================================================================================
  //end load data
}); //End document.ready
