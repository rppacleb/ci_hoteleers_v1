$(document).ready(function () {
  if ($(window).width() >= 1441) {
    $(".container-fluid").css({ "max-width": "1440px" });
  } else if ($(window).width() >= 1360 && $(window).width() <= 1440) {
    $(".container-fluid").css({ "max-width": "1350px" });
  } else if ($(window).width() >= 1200 && $(window).width() <= 1359) {
    $(".container-fluid").css({ "max-width": "1200px" });
  }

  autosize($(".ca-textarea"));

  if (status !== "") {
    $("select[name=header\\[status\\]]").val(status).prop("disabled", true);
    $("select[name=header\\[status\\]]").css({ background: "#e9ecef" });
  } //end if

  if (job_post !== "") {
    $("input[name=header\\[job_post\\]]").val(job_post);
    $("input[id=header\\[job_post_text\\]]")
      .val(job_post)
      .prop("disabled", true);
  } //end if

  if (applicant_id !== "") {
    $("input[name=header\\[applicant1\\]]").val(applicant_id);
  } //end if

  var frm_1 = ".frm_data_entry";
  var frm_2 = ".frm_data_entry2";
  //load record
  $(document.body).on(
    "blur",
    frm_1 + " input[name=header\\[id\\]]",
    function (e) {
      var id = $(this).val();
      var param = {};
      param["id"] = id;
      param["mode"] = "view";
      load_data(frm_1, param);
    }
  );
  //end load record

  //load record
  $(document.body).on(
    "blur",
    frm_2 + " input[name=header\\[id\\]]",
    function (e) {
      var id = $(this).val();
      var param = {};
      param["id"] = id;
      param["mode"] = "view";
      load_data(frm_2, param);
    }
  );
  //end load record

  $(document.body).on("blur", "input[name=header\\[job_post\\]]", function (e) {
    var field = $("input[id=header\\[job_post_text\\]]");
    source_data(field);
  });

  //$('input[name=header\\[id\\]]').trigger('blur');

  var homeurl = baseurl + "/compare_applicant";
  var homeurl_txt = "compare_applicant";
  var urlimgdef = baseurl + "/files/images/default/user.png";
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
    var edit_url = baseurl + "/schedule/edit/";
    var view_url = baseurl + "/schedule/view/";
    var user_url = baseurl + "/user";

    var job_post_edit_url = baseurl + "/job_post_copy/edit/";
    var job_post_copy_url = baseurl + "/job_post_copy/copy/";
    var applicant_url = baseurl + "/applicant_search/view/applied/";

    var data = {};
    data.page = page;
    data.keyword = $("input[name=header\\[keyword\\]]").val();
    data.user_id = user_id;
    data.employer_id = employer_id;
    data.date_filter = $("input[name=header\\[date_filter\\]]").val();

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

            html += '<div class="row mb-2">';
            html += '<div class="col">';
            html += '<div class="card">';
            html += '<div class="card-body">';
            html += '<div class="row">';

            //html += '<div class="col-3">';
            //html += '<img class="rounded-circle" style="height:0.5in;width:0.5in;" src="'+img_src+'" alt="Card image cap"><br/>'+value.name;
            //html += '</div><!--./col-->';
            html += '<div class="col">';
            html +=
              '<a href="' +
              applicant_url +
              value.user_id +
              "?job_post=" +
              value.job_post_id +
              '" class="text-link">' +
              value.name +
              "</a>";
            html += "</div><!--./col-->";
            html += '<div class="col text-center">';
            html += value.interview_date_txt;
            html += "</div><!--./col-->";
            html += '<div class="col text-center">';
            html += value.interview_start_time;
            html += "</div><!--./col-->";
            html += '<div class="col text-center">';
            html += value.job_title;
            html += "</div><!--./col-->";
            html += '<div class="col-2">';

            var w = window.innerWidth / 2 + 160;
            var l = w / 2 / 2;
            var h = window.innerHeight / 2 + 160;
            var t = h / 2 / 2;

            //html += '<a target="_blank" title="edit" aria-id="'+value.id+'" onclick="window.open('+"'"+edit_url+value.user_id+'?job_post='+value.job_post_id+"'"+',\'newwindow\',\'width='+w+',height='+h+',status=0,left='+l+',top='+t+'\'); return false;" class="mr-1 btn btn-pill-sm btn-pill-sm-outline-light text-muted btn_save"><i class="fa fa-pencil-alt"></i></a>';
            if (value.status !== "cancelled" && value.status !== "completed") {
              html +=
                '<button title="remove" aria-id="' +
                value.id +
                '" class="mr-1 btn btn-pill-sm btn-pill-sm-outline-light text-danger btn_remove"><i class="fa fa-times"></i></button>';
            } //end if

            html +=
              '<a href="' +
              edit_url +
              value.id +
              "?user_id=" +
              value.user_id +
              "&job_post=" +
              value.job_post_id +
              "" +
              '" class="mr-1 btn btn-pill-sm btn-pill-sm-outline-light text-muted btn_save"><i class="fa fa-pencil-alt"></i></a>';
            html +=
              '<a href="' +
              view_url +
              value.id +
              "?user_id=" +
              value.user_id +
              "&job_post=" +
              value.job_post_id +
              "" +
              '" class="btn btn-pill-sm btn-pill-outline-link text-link btn_view">View</a>';
            //html += '<div class="btn-group btn-group-toggle">';
            //var btn_class= "btn-outline-dark disabled";
            //html += '<button title="remove" aria-id="'+value.id+'" class="mr-1 btn btn-pill-sm btn-pill-sm-outline-light text-danger btn_remove"><i class="fa fa-times"></i></button>';

            //if(parseInt(value.applicant_count) <= 0){

            // html += '<a target="_blank" title="edit" aria-id="'+value.id+'" onclick="window.open('+"'"+job_post_edit_url+value.id+"'"+',\'newwindow\',\'width='+w+',height='+h+',status=0,left='+l+',top='+t+'\'); return false;" class="mr-1 btn btn-pill-sm btn-pill-sm-outline-light text-muted btn_save"><i class="fa fa-pencil-alt"></i></a>';

            //}//end if

            //html += '<button type="button" onclick="window.open('+"'"+job_post_copy_url+value.id+"'"+',\'newwindow\',\'width='+w+',height='+h+',status=0,left='+l+',top='+t+'\'); return false;" data-id="'+value.id+'" class="btn btn-pill-sm btn-pill-sm-outline-light text-muted btn_save"><i class="fa fa-copy"></i></button>';

            //html += '<a href="#" class="btn btn-pill-sm btn-pill-outline-link text-link btn_save">Save</a>';
            //html += '<a href="'+view_url+value.id+'" class="btn btn-pill-sm btn-pill-outline-link text-link btn_view">View</a>';
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

            autosize($(".ca-textarea"));
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
      })
      .fail(function (e) {
        alert(e.responseText);
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

  //filter by
  $(document.body).on(
    "blur",
    "input[name=header\\[date_filter\\]]",
    function (e) {
      $(".btn_find").trigger("click");
    }
  ); //end if
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
    url = homeurl + "/cancel_schedule/list";

    var frm_id = "";

    var data = {};
    data.header = {};
    data.header.id = id;

    btn_text = '<i class="fa fa-times"></i>';

    if (confirm("This will cancel your schedule!")) {
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

  //load job_post autocomplete
  $(document.body).on(
    "focus",
    "input[id=header\\[job_post_text\\]]",
    function () {
      if (!$(this).hasClass("wauto")) {
        load_job_title_autocomplete(
          $(this),
          $("input[name=header\\[job_post\\]]")
        );
        $(this).addClass("wauto");
      } //End if
    }
  ); //focus
  $(document.body).on(
    "blur",
    "input[id=header\\[job_post_text\\]]",
    function () {
      if ($(this).val() == "") {
        $("input[name=header\\[job_post\\]]").val("");
      } //end if

      if ($("input[name=header\\[job_post\\]]").val() == "") {
        $(this).val("");
      } //end if
    }
  ); //blur

  //load applicant autocomplete
  $(document.body).on(
    "focus",
    "input[name=header\\[applicant1_text\\]]",
    function () {
      //if(!$(this).hasClass('wauto')){

      load_applicant_autocomplete(
        $(this),
        $("input[name=header\\[applicant1\\]]")
      );
      $(this).addClass("wauto");
      //}//End if
    }
  ); //focus
  $(document.body).on(
    "blur",
    "input[name=header\\[applicant1_text\\]]",
    function () {
      if ($(this).val() == "") {
        $("input[name=header\\[applicant1\\]]").val("");
      } //end if

      if ($("input[name=header\\[applicant1\\]]").val() == "") {
        $(this).val("");
      } //end if
    }
  ); //blur

  //load applicant autocomplete
  $(document.body).on(
    "focus",
    "input[name=header\\[applicant2_text\\]]",
    function () {
      //if(!$(this).hasClass('wauto')){

      load_applicant_autocomplete(
        $(this),
        $("input[name=header\\[applicant2\\]]")
      );
      $(this).addClass("wauto");
      //}//End if
    }
  ); //focus
  $(document.body).on(
    "blur",
    "input[name=header\\[applicant2_text\\]]",
    function () {
      if ($(this).val() == "") {
        $("input[name=header\\[applicant2\\]]").val("");
      } //end if

      if ($("input[name=header\\[applicant2\\]]").val() == "") {
        $(this).val("");
      } //end if
    }
  ); //blur

  //find 1
  $(document.body).on("click", "button.btn_find1", function () {
    var id = $("input[name=header\\[applicant1\\]]").val();
    $(frm_1 + " input[name=header\\[id\\]]")
      .val(id)
      .trigger("blur");
    $("input[name=header\\[applicant1_text\\]]").val("");
    $("input[name=header\\[applicant1\\]]").val("");
    $(".ca-textarea").trigger("autosize.resize");
  });
  //end find 1

  if (applicant_id !== "") {
    $("input[name=header\\[job_post\\]]").trigger("blur");
    $(".btn_find1").trigger("click");
  } //end if

  //find 2
  $(document.body).on("click", "button.btn_find2", function () {
    var id = $("input[name=header\\[applicant2\\]]").val();
    $(frm_2 + " input[name=header\\[id\\]]")
      .val(id)
      .trigger("blur");
    $("input[name=header\\[applicant2_text\\]]").val("");
    $("input[name=header\\[applicant2\\]]").val("");
    $(".ca-textarea").trigger("autosize.resize");
  });
  //end find 2

  //=====================================================================================================================
  //end events

  //autocomplete
  //===============================================================================================================================

  //job title autocomplete
  function load_job_title_autocomplete(html, html_id) {
    var url = baseurl + "/compare_applicant/get_job_post_list";
    var data = {};
    data.created_by = user_id;
    data.employer_id = employer_id;

    html
      .autocomplete({
        serviceUrl: url,
        type: "POST",
        dataType: "json",
        params: data,
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
  } //end job title autocomplete

  //applicant autocomplete
  function load_applicant_autocomplete(html, html_id) {
    var url = baseurl + "/compare_applicant/get_applicant_list";
    var data = {};
    data.created_by = user_id;
    data.employer_id = employer_id;
    data.job_post_id = $("input[name=header\\[job_post\\]]").val();
    data.status = $("select[name=header\\[status\\]]").val();

    html
      .autocomplete({
        serviceUrl: url,
        type: "POST",
        dataType: "json",
        params: data,
        showNoSuggestionNotice: true,
        noSuggestionNotice: "Sorry, no matching results",
        autoSelectFirst: true,
        triggerSelectOnValidInput: true,
        orientation: "auto",
        tabDisabled: true,
        minChars: 0, // Set to 0 so that it will start suggesting on the first click on the search bar.
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
  } //end applicant autocomplete

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
  $("#job_post_modal").on("shown.bs.modal", function (e) {
    //$('#job_post_modal_body').load('http://localhost:81/hoteleers/job_post/edit/12');
  });

  $("#job_post_modal").on("hide.bs.modal", function (e) {
    //$('#job_post_modal_title').empty();
    //$('#job_post_modal_body').empty();
  });
  //End Lookup Modal
  //=======================================================================================================================
  //end modal

  //sourcing
  //=======================================================================================================================
  //load data
  function load_data(frm1, param) {
    var url = baseurl + "/applicant_info/load_data/" + param.id;
    var btn = $(frm1 + " #loader");
    var btn_text = "";

    $.ajax({
      url: url,
      type: "POST",
      dataType: "JSON",
      beforeSend: function () {
        $(".outside_button *").css("pointer-events", "none");
        //$('#'+loader+'').html('<div class="col-12 text-center"><div class="spinner-grow text-muted"></div></div>');
        btn.html(
          '<div class="spinner-grow" role="status"> <span class="sr-only">Loading...</span> </div>'
        );
      },
    })
      .done(function (response) {
        if (response.data !== null && response.data !== undefined) {
          var data = response.data[0];

          if (param.mode == "edit" || param.mode == "view") {
            //view and edit mode
            //----------------------------------------------------------------------------------------------------
            //side profile
            $(frm1 + " input[name=header\\[doc_image\\]]").val(data.doc_image);
            $(frm1 + " input[name=file\\[old_doc_image\\]]").val(
              data.doc_image
            );

            var full_name = data.first_name + " " + data.last_name;
            $(frm1 + " h6[id=header\\[company_name\\]]").html(full_name);
            $(frm1 + " p[id=header\\[date_created\\]]").html(
              '<small class="text-muted">Joined ' +
                data.joined_date +
                "</small>"
            );
            if (data.doc_image === null || data.doc_image == "") {
              $(frm1 + " img[id=header\\[company_logo\\]]").attr(
                "src",
                urlimgdef
              );
            } else {
              $(frm1 + " img[id=header\\[company_logo\\]]").attr(
                "src",
                upload_path + data.doc_image
              );
            } //end if

            //resume file
            $(frm1 + " input[name=header\\[resume\\]]").val(data.resume);
            $(frm1 + " input[name=file\\[old_resume\\]]").val(data.resume);

            var html = "";
            html += '<div class="col mb-3">';
            html +=
              '<h1 class="text-center"><i class="fa fa-file-word"></i></h1>';
            html +=
              '<p class="text-center"><a href="' +
              upload_path +
              data.resume +
              '" target="_blank">' +
              data.resume +
              "</a></p>";
            html += "</div><!--./col-->";
            if (data.resume !== "") {
              $(frm1 + " #image_cont").html(html);
            } //end if

            //primary info
            $(frm1 + " input[name=header\\[first_name\\]]").val(
              data.first_name
            );
            $(frm1 + " input[name=header\\[middle_name\\]]").val(
              data.middle_name
            );
            $(frm1 + " input[name=header\\[last_name\\]]").val(data.last_name);
            $(frm1 + " input[name=header\\[email_add\\]]").val(data.email_add);
            $(frm1 + " select[name=header\\[dial_code\\]]").val(data.dial_code);
            $(frm1 + " input[name=header\\[contact_number\\]]").val(
              data.contact_number
            );
            $(frm1 + " textarea[name=header\\[highlights\\]]").val(
              data.highlights
            );
            data.internship = parseInt(data.internship);
            $(frm1 + " input[name=header\\[internship\\]]").prop(
              "checked",
              data.internship
            );
            //end primary info

            if (
              !$(frm1 + " input[name=header\\[internship\\]]").prop("checked")
            ) {
              if (
                !$(frm1 + " input[name=header\\[internship\\]]").prop(
                  "checked"
                ) &&
                $(".frm_data_entry2 input[name=header\\[internship\\]]").prop(
                  "checked"
                )
              ) {
                $(".ca-internship").addClass("d-none");
                $(".ca-internship2").removeClass("d-none");
              } else {
                $(".ca-internship").addClass("d-none");
                $(".ca-internship2").addClass("d-none");
              }
            } else {
              $(".ca-internship").removeClass("d-none");
            }

            if (
              !$(".frm_data_entry2 input[name=header\\[internship\\]]").prop(
                "checked"
              )
            ) {
              if (
                $(frm1 + " input[name=header\\[internship\\]]").prop(
                  "checked"
                ) &&
                !$(".frm_data_entry2 input[name=header\\[internship\\]]").prop(
                  "checked"
                )
              ) {
                $(".ca-internship2").addClass("d-none");
                $(".ca-internship").removeClass("d-none");
              } else {
                $(".ca-internship2").addClass("d-none");
                $(".ca-internship").addClass("d-none");
              }
            } else {
              $(".ca-internship2").removeClass("d-none");
            }

            //location
            $(frm1 + " p[id=header\\[location\\]]").html(
              '<small class="text-muted">' + data.locality + "</small>"
            );

            if (frm1 == ".frm_data_entry2") {
              $(frm1 + " textarea[name=header\\[location2\\]]").val(
                data.location
              );
            } else {
              $(frm1 + " textarea[name=header\\[location\\]]").val(
                data.location
              );
            } //end if

            //populate lines
            //experience
            html = "";
            data_lines = response.line_experience;
            for (var key in data_lines) {
              html += '<div class="row mb-2">';

              html += '<div class="col">';

              html += '<div class="form-group row d-none">';
              html +=
                '<label class="col-5 col-form-label text-link">Line</label>';
              html += '<div class="col">';
              html +=
                '<input value="' +
                data_lines[key]["line"] +
                '" readonly class="form-control form-control-sm" type="text" name="row_experience[line][]" maxlength="100"/>';
              html += "</div><!--./col-10-->";
              html += "</div><!--./form-group-->";

              html += '<div class="form-group row">';
              html +=
                '<label class="col-4 col-form-label text-right align-self-center">Position </label>';
              html += '<div class="col align-self-center">';
              html +=
                '<input value="' +
                data_lines[key]["designation"] +
                '" class="form-control form-control-sm" type="text" name="row_experience[designation][]" maxlength="100"/>';
              html += "</div><!--./col-10-->";
              html += "</div><!--./form-group-->";

              html += '<div class="form-group row">';
              html +=
                '<label class="col-4 col-form-label text-right align-self-center">Company Name </label>';
              html += '<div class="col align-self-center">';
              html +=
                '<input value="' +
                data_lines[key]["company_name"] +
                '" class="form-control form-control-sm" type="text" name="row_experience[company_name][]" maxlength="100"/>';
              html += "</div><!--./col-10-->";
              html += "</div><!--./form-group-->";

              html += '<div class="form-group row">';
              html +=
                '<label class="col-4 col-form-label text-right">Short description</label>';
              html += '<div class="col">';
              html +=
                '<textarea class="form-control form-control-sm ca-textarea" name="row_experience[short_description][]" maxlength="600">' +
                data_lines[key]["short_description"] +
                "</textarea>";
              html += "</div><!--./col-10-->";
              html += "</div><!--./form-group-->";

              if (data_lines[key]["if_current"] == 0) {
                html += '<div class="form-group row">';
                html +=
                  '<label class="col-4 col-form-label text-right align-self-center">Start Date</label>';
                html += '<div class="col align-self-center">';
                html += '<div class="input-group input-group-sm">';
                html +=
                  '<input value="' +
                  data_lines[key]["start_date_placeholder"] +
                  '" class="form-control-sm d-none" type="text" name="placeholder[start_date][]"/>';
                html +=
                  '<input value="' +
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
                  '<label class="col-4 col-form-label text-right align-self-center">End Date</label>';
                html += '<div class="col align-self-center">';
                html += '<div class="input-group input-group-sm date">';
                html +=
                  '<input value="' +
                  data_lines[key]["end_date_placeholder"] +
                  '" class="form-control-sm d-none" type="text" name="placeholder[end_date][]"/>';
                html +=
                  '<input value="' +
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
                  '<label class="col-4 col-form-label text-right align-self-center">Start Date</label>';
                html += '<div class="col-3 align-self-center">';
                html += '<div class="input-group input-group-sm">';
                html +=
                  '<input value="' +
                  data_lines[key]["start_date_placeholder"] +
                  '" class="form-control-sm d-none" type="text" name="placeholder[start_date][]"/>';
                html +=
                  '<input value="' +
                  data_lines[key]["start_date"] +
                  '" class="form-control form-control-sm" type="text" name="row_experience[start_date][]"/>';
                html += '<div class="input-group-append">';
                html +=
                  '<span class="input-group-text"><i class="fa fa-calendar"></i></span>';
                html += "</div><!--./input-group-append-->";
                html += "</div><!--./input-group input-group-sm-->";
                html += "</div><!--./col-->";

                html += '<div class="col-2 align-self-center">-';
                html += "</div><!--./col-->";
                html +=
                  '<label class="col-2 col-form-label align-self-center">Present</label>';
                html += "</div><!--./form-group-->";
              }

              if (data_lines[key]["if_current"] == 1) {
                // html += '<div class="form-group row">';
                //     html += '<label class="col-4 col-form-label text-right align-self-center">If Current</label>';
                //     html += '<div class="col-1 w-auto align-self-center">';
                //         html += '<input '+(data_lines[key]['if_current'] == 1? 'checked' : '')+' value="false" type="checkbox" id="row_experience[if_current][]"/>';
                //     html += '</div><!--./col-10-->';
                // html += '</div><!--./form-group-->';
              }

              html += '<div class="form-group row d-none">';
              html +=
                '<label class="col-5 col-form-label text-link">If Current</label>';
              html += '<div class="col">';
              html +=
                '<input value="' +
                data_lines[key]["if_current"] +
                '" type="text" name="row_experience[if_current][]"/>';
              html += "</div><!--./col-10-->";
              html += "</div><!--./form-group-->";
              html += "</div>";
              html += "</div><hr/>";
            } //end for
            $(frm1 + " #experience_content").html(html);
            //experience

            autosize($(".ca-textarea"));

            //skills
            html = "";
            data_lines = response.line_skills;
            for (var key in data_lines) {
              html += '<div class="row mb-2">';
              html += '<div class="col">';
              html += '<div class="form-group row d-none">';

              html += '<div class="col">';
              html +=
                '<input value="' +
                data_lines[key]["line"] +
                '" readonly class="form-control form-control-sm" type="text" name="row_skills[line][]" maxlength="100"/>';
              html += "</div><!--./col-10-->";
              html += "</div><!--./form-group-->";

              html += '<div class="form-group row">';

              html += '<div class="col">';
              html +=
                '<input value="' +
                data_lines[key]["skills"] +
                '" class="form-control form-control-sm" type="text" name="row_skills[skills][]" maxlength="200"/>';
              html += "</div><!--./col-10-->";
              html += "</div><!--./form-group-->";
              html += "</div>";
              html += "</div><hr/>";
            } //end for
            $(frm1 + " #skills_content").html(html);
            //end skills

            //education
            html = "";
            data_lines = response.line_education;
            for (var key in data_lines) {
              html += '<div class="row mb-2">';
              html += '<div class="col">';

              html += '<div class="form-group row d-none">';
              html +=
                '<label class="col-5 col-form-label text-link">Line </label>';
              html += '<div class="col">';
              html +=
                '<input value="' +
                data_lines[key]["line"] +
                '" readonly class="form-control form-control-sm" type="text" name="row_education[line][]" maxlength="100"/>';
              html += "</div><!--./col-10-->";
              html += "</div><!--./form-group-->";

              html += '<div class="form-group row">';
              html +=
                '<label class="col-4 col-form-label text-right align-self-centerk">University/School </label>';
              html += '<div class="col align-self-center">';
              html +=
                '<input value="' +
                data_lines[key]["school"] +
                '" class="form-control form-control-sm" type="text" name="row_education[school][]" maxlength="200"/>';
              html += "</div><!--./col-10-->";
              html += "</div><!--./form-group-->";

              html += '<div class="form-group row">';
              html +=
                '<label class="col-4 col-form-label text-right align-self-center">Degree/Field of Study </label>';
              html += '<div class="col align-self-center">';
              html +=
                '<input value="' +
                data_lines[key]["degree"] +
                '" class="form-control form-control-sm" type="text" name="row_education[degree][]" maxlength="200"/>';
              html += "</div><!--./col-10-->";
              html += "</div><!--./form-group-->";

              html += '<div class="form-group row">';
              html +=
                '<label class="col-4 col-form-label text-right align-self-center">Education </label>';
              html += '<div class="col-2 d-none">';
              html +=
                '<input value="' +
                data_lines[key]["education"] +
                '" readonly class="form-control form-control-sm" type="text" name="row_education[education][]"/>';
              html += "</div>";
              html += '<div class="col align-self-center">';
              html += '<div class="input-group input-group-sm">';
              html +=
                '<input value="' +
                data_lines[key]["education_text"] +
                '" class="form-control form-control-sm" type="text" id="row_education[education_text][]"/>';
              html += '<div class="input-group-append">';
              html +=
                '<span class="input-group-text"><i class="fa fa-list"></i></span>';
              html += "</div><!--./input-group-append-->";
              html += "</div><!--./input-group input-group-sm-->";
              html += "</div><!--./col-10-->";
              html += "</div><!--./form-group-->";

              if (data_lines[key]["if_current"] == 0) {
                html += '<div class="form-group row">';
                html +=
                  '<label class="col-4 col-form-label text-right align-self-center">Start Date</label>';
                html += '<div class="col align-self-center">';
                html += '<div class="input-group input-group-sm">';
                html +=
                  '<input value="' +
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
                  '<label class="col-4 col-form-label text-right align-self-center">End Date</label>';
                html += '<div class="col align-self-center">';
                html += '<div class="input-group input-group-sm date">';
                html +=
                  '<input value="' +
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
                  '<label class="col-4 col-form-label text-right align-self-center">Start Date</label>';
                html += '<div class="col-3 align-self-center">';
                html += '<div class="input-group input-group-sm">';
                html +=
                  '<input value="' +
                  data_lines[key]["start_date"] +
                  '" class="form-control form-control-sm" type="text" name="row_education[start_date][]"/>';
                html += '<div class="input-group-append">';
                html +=
                  '<span class="input-group-text"><i class="fa fa-calendar"></i></span>';
                html += "</div><!--./input-group-append-->";
                html += "</div><!--./input-group input-group-sm-->";
                html += "</div><!--./col-->";

                html += '<div class="col-2 align-self-center">-';
                html += "</div><!--./col-->";
                html +=
                  '<label class="col-2 col-form-label align-self-center">Present</label>';
                html += "</div><!--./form-group-->";
              }

              if (data_lines[key]["if_current"] == 1) {
                // html += '<div class="form-group row">';
                //     html += '<label class="col-4 col-form-label text-right align-self-center">If Current</label>';
                //     html += '<div class="col-1 w-auto align-self-center">';
                //         html += '<input '+(data_lines[key]['if_current'] == 1? 'checked' : '')+' type="checkbox" id="row_education[if_current][]"/>';
                //     html += '</div><!--./col-10-->';
                // html += '</div><!--./form-group-->';
              }

              html += '<div class="form-group row d-none">';
              html +=
                '<label class="col-5 col-form-label text-link">If Current</label>';
              html += '<div class="col">';
              html +=
                '<input value="' +
                data_lines[key]["if_current"] +
                '" type="text" name="row_education[if_current][]"/>';
              html += "</div><!--./col-10-->";
              html += "</div><!--./form-group-->";

              html += "</div>";
              html += "</div><hr/>";
            } //end for
            $(frm1 + " #education_content").html(html);
            //end education

            //language
            html = "";
            data_lines = response.line_language;
            for (var key in data_lines) {
              html += '<div class="row mb-2">';
              html += '<div class="col">';
              html += '<div class="form-group row d-none">';
              html +=
                '<label class="col-4 col-form-label text-link">Line </label>';
              html += '<div class="col">';
              html +=
                '<input value="' +
                data_lines[key]["line"] +
                '" readonly class="form-control form-control-sm" type="text" name="row_language[line][]" maxlength="100"/>';
              html += "</div><!--./col-10-->";
              html += "</div><!--./form-group-->";

              html += '<div class="form-group row">';
              html += '<div class="col">';
              html +=
                '<input value="' +
                data_lines[key]["language"] +
                '" class="form-control form-control-sm" type="text" name="row_language[language][]" maxlength="200"/>';
              html += "</div><!--./col-10-->";
              html += "</div><!--./form-group-->";

              html += "</div>";
              html += "</div><hr/>";
            } //end for
            $(frm1 + " #language_content").html(html);
            //end language

            //certifications and licenses
            html = "";
            data_lines = response.line_certification;
            for (var key in data_lines) {
              html += '<div class="row mb-2">';
              html += '<div class="col">';
              html += '<div class="form-group row d-none">';
              html +=
                '<label class="col-4 col-form-label text-link">Line </label>';
              html += '<div class="col">';
              html +=
                '<input value="' +
                data_lines[key]["line"] +
                '" readonly class="form-control form-control-sm" type="text" name="row_certification[line][]" maxlength="100"/>';
              html += "</div><!--./col-10-->";
              html += "</div><!--./form-group-->";

              html += '<div class="form-group row">';

              html += '<div class="col">';
              html +=
                '<input value="' +
                data_lines[key]["certification"] +
                '" class="form-control form-control-sm" type="text" name="row_certification[certification][]" maxlength="200"/>';
              html += "</div><!--./col-10-->";
              html += "</div><!--./form-group-->";
              html += "</div>";
              html += "</div><hr/>";
            } //end for
            $(frm1 + " #certification_content").html(html);
            //end certifications and licenses

            //projects
            html = "";
            data_lines = response.line_projects;
            for (var key in data_lines) {
              html += '<div class="row mb-2">';
              html += '<div class="col">';

              html += '<div class="form-group row d-none">';
              html +=
                '<label class="col-4 col-form-label text-link">Line </label>';
              html += '<div class="col">';
              html +=
                '<input value="' +
                data_lines[key]["line"] +
                '" readonly class="form-control form-control-sm" type="text" name="row_projects[line][]" maxlength="100"/>';
              html += "</div><!--./col-10-->";
              html += "</div><!--./form-group-->";

              html += '<div class="form-group row">';

              html += '<div class="col">';
              html +=
                '<input value="' +
                data_lines[key]["projects"] +
                '" class="form-control form-control-sm" type="text" name="row_projects[projects][]" maxlength="200"/>';
              html += "</div><!--./col-10-->";
              html += "</div><!--./form-group-->";
              html += "</div>";
              html += "</div><hr/>";
            } //end for
            $(frm1 + " #projects_content").html(html);
            //end projects

            //seminar and trainings
            html = "";
            data_lines = response.line_seminars_trainings;
            for (var key in data_lines) {
              html += '<div class="row mb-2">';
              html += '<div class="col">';
              html += '<div class="form-group row d-none">';
              html +=
                '<label class="col-4 col-form-label text-link">Line </label>';
              html += '<div class="col">';
              html +=
                '<input value="' +
                data_lines[key]["line"] +
                '" readonly class="form-control form-control-sm" type="text" name="row_seminar_training[line][]" maxlength="100"/>';
              html += "</div><!--./col-10-->";
              html += "</div><!--./form-group-->";

              html += '<div class="form-group row">';
              html += '<div class="col">';
              html +=
                '<input value="' +
                data_lines[key]["seminar_training"] +
                '" class="form-control form-control-sm" type="text" name="row_seminar_training[seminar_training][]" maxlength="200"/>';
              html += "</div><!--./col-10-->";
              html += "</div><!--./form-group-->";
              html += "</div>";
              html += "</div><hr/>";
            } //end for
            $(frm1 + " #seminar_training_content").html(html);
            //end seminar and trainings

            //awards and achievements
            html = "";
            data_lines = response.line_awards_achievements;
            for (var key in data_lines) {
              html += '<div class="row mb-2">';
              html += '<div class="col">';
              html += '<div class="form-group row d-none">';
              html +=
                '<label class="col-4 col-form-label text-link">Line </label>';
              html += '<div class="col">';
              html +=
                '<input value="' +
                data_lines[key]["line"] +
                '" readonly class="form-control form-control-sm" type="text" name="row_award_achievement[line][]" maxlength="100"/>';
              html += "</div><!--./col-10-->";
              html += "</div><!--./form-group-->";

              html += '<div class="form-group row">';
              html += '<div class="col">';
              html +=
                '<input value="' +
                data_lines[key]["award_achievement"] +
                '" class="form-control form-control-sm" type="text" name="row_award_achievement[award_achievement][]" maxlength="200"/>';
              html += "</div><!--./col-10-->";
              html += "</div><!--./form-group-->";
              html += "</div>";
              html += "</div><hr/>";
            } //end for
            $(frm1 + " #awards_achievements_content").html(html);
            //end awards and achievements

            //affiliations
            html = "";
            data_lines = response.line_affiliations;
            for (var key in data_lines) {
              html += '<div class="row mb-2">';
              html += '<div class="col">';
              html += '<div class="form-group row d-none">';
              html +=
                '<label class="col-4 col-form-label text-link">Line </label>';
              html += '<div class="col">';
              html +=
                '<input value="' +
                data_lines[key]["line"] +
                '" readonly class="form-control form-control-sm" type="text" name="row_affiliation[line][]" maxlength="100"/>';
              html += "</div><!--./col-10-->";
              html += "</div><!--./form-group-->";

              html += '<div class="form-group row">';
              html += '<div class="col">';
              html +=
                '<input value="' +
                data_lines[key]["affiliation"] +
                '" class="form-control form-control-sm" type="text" name="row_affiliation[affiliation][]" maxlength="200"/>';
              html += "</div><!--./col-10-->";
              html += "</div><!--./form-group-->";
              html += "</div>";
              html += "</div><hr/>";
            } //end for
            $(frm1 + " #affiliations_content").html(html);
            //end affiliations

            //industry
            html = "";
            data_lines = response.line_industry;

            for (var key in data_lines) {
              if (key == 0) {
                html +=
                  '<label class="col-form-label text-link">Industry </label>';
              } //end if
              html += '<div class="row mb-2">';
              html += '<div class="col">';
              html += '<div class="form-group row d-none">';
              html +=
                '<label class="col-4 col-form-label text-link">Line </label>';
              html += '<div class="col">';
              html +=
                '<input value="' +
                data_lines[key]["line"] +
                '" readonly class="form-control form-control-sm" type="text" name="row_industry[line][]" maxlength="100"/>';
              html += "</div><!--./col-10-->";
              html += "</div><!--./form-group-->";

              html += '<div class="form-group row">';
              html += '<label class="col-2 col-form-label text-link"></label>';
              html += '<div class="col-2 d-none">';
              html +=
                '<input value="' +
                data_lines[key]["industry"] +
                '" readonly class="form-control form-control-sm" type="text" name="row_industry[industry][]"/>';
              html += "</div>";
              html += '<div class="col">';
              html += '<div class="input-group input-group-sm">';
              html +=
                '<input value="' +
                data_lines[key]["industry_text"] +
                '" class="form-control form-control-sm" type="text" id="row_industry[industry_text][]"/>';
              html += '<div class="input-group-append">';
              html +=
                '<span class="input-group-text"><i class="fa fa-list"></i></span>';
              html += "</div><!--./input-group-append-->";
              html += "</div><!--./input-group input-group-sm-->";
              html += "</div><!--./col-10-->";
              html += "</div><!--./form-group-->";
              html += "</div>";
              html += "</div>";
            } //end for
            $(frm1 + " #industry_content").html(html);
            //end industry

            //job level
            html = "";
            data_lines = response.line_job_level;

            for (var key in data_lines) {
              if (key == 0) {
                html +=
                  '<label class="col-form-label text-link">Job Level</label>';
              } //end if
              html += '<div class="row mb-2">';
              html += '<div class="col">';

              html += '<div class="form-group row d-none">';
              html +=
                '<label class="col-4 col-form-label text-link">Line </label>';
              html += '<div class="col">';
              html +=
                '<input value="' +
                data_lines[key]["line"] +
                '" readonly class="form-control form-control-sm" type="text" name="row_job_level[line][]" maxlength="100"/>';
              html += "</div><!--./col-10-->";
              html += "</div><!--./form-group-->";

              html += '<div class="form-group row">';
              html += '<label class="col-2 col-form-label text-link"></label>';
              html += '<div class="col-2 d-none">';
              html +=
                '<input value="' +
                data_lines[key]["job_level"] +
                '" readonly class="form-control form-control-sm" type="text" name="row_job_level[job_level][]"/>';
              html += "</div>";
              html += '<div class="col">';
              html += '<div class="input-group input-group-sm">';
              html +=
                '<input value="' +
                data_lines[key]["job_level_text"] +
                '" class="form-control form-control-sm" type="text" id="row_job_level[job_level_text][]"/>';
              html += '<div class="input-group-append">';
              html +=
                '<span class="input-group-text"><i class="fa fa-list"></i></span>';
              html += "</div><!--./input-group-append-->";
              html += "</div><!--./input-group input-group-sm-->";
              html += "</div><!--./col-10-->";
              html += "</div><!--./form-group-->";
              html += "</div>";
              html += "</div>";
            } //end for
            $(frm1 + " #job_level_content").html(html);
            //end job level

            //job type
            html = "";
            data_lines = response.line_job_type;
            for (var key in data_lines) {
              if (key == 0) {
                html +=
                  '<label class="col-form-label text-link">Job Type</label>';
              } //end if

              html += '<div class="row mb-2">';
              html += '<div class="col">';
              html += '<div class="form-group row d-none">';
              html +=
                '<label class="col-4 col-form-label text-link">Line </label>';
              html += '<div class="col">';
              html +=
                '<input value="' +
                data_lines[key]["line"] +
                '" readonly class="form-control form-control-sm" type="text" name="row_job_type[line][]" maxlength="100"/>';
              html += "</div><!--./col-10-->";
              html += "</div><!--./form-group-->";

              html += '<div class="form-group row">';
              html += '<label class="col-2 col-form-label text-link"></label>';
              html += '<div class="col-2 d-none">';
              html +=
                '<input value="' +
                data_lines[key]["job_type"] +
                '" readonly class="form-control form-control-sm" type="text" name="row_job_type[job_type][]"/>';
              html += "</div>";
              html += '<div class="col">';
              html += '<div class="input-group input-group-sm">';
              html +=
                '<input value="' +
                data_lines[key]["job_type_text"] +
                '" class="form-control form-control-sm" type="text" id="row_job_type[job_type_text][]"/>';
              html += '<div class="input-group-append">';
              html +=
                '<span class="input-group-text"><i class="fa fa-list"></i></span>';
              html += "</div><!--./input-group-append-->";
              html += "</div><!--./input-group input-group-sm-->";
              html += "</div><!--./col-10-->";
              html += "</div><!--./form-group-->";
              html += "</div>";
              html += "</div>";
            } //end for
            $(frm1 + " #job_type_content").html(html);
            //end job type

            //department
            html = "";
            data_lines = response.line_department;
            for (var key in data_lines) {
              if (key == 0) {
                html +=
                  '<label class="col-form-label text-link">Department</label>';
              } //end if
              html += '<div class="row mb-2">';
              html += '<div class="col">';
              html += '<div class="form-group row d-none">';
              html +=
                '<label class="col-4 col-form-label text-link">Line </label>';
              html += '<div class="col">';
              html +=
                '<input value="' +
                data_lines[key]["line"] +
                '" readonly class="form-control form-control-sm" type="text" name="row_department[line][]" maxlength="100"/>';
              html += "</div><!--./col-10-->";
              html += "</div><!--./form-group-->";

              html += '<div class="form-group row">';
              html += '<label class="col-2 col-form-label text-link"></label>';
              html += '<div class="col-2 d-none">';
              html +=
                '<input value="' +
                data_lines[key]["department"] +
                '" readonly class="form-control form-control-sm" type="text" name="row_department[department][]"/>';
              html += "</div>";
              html += '<div class="col">';
              html += '<div class="input-group input-group-sm">';
              html +=
                '<input value="' +
                data_lines[key]["department_text"] +
                '" class="form-control form-control-sm" type="text" id="row_department[department_text][]"/>';
              html += '<div class="input-group-append">';
              html +=
                '<span class="input-group-text"><i class="fa fa-list"></i></span>';
              html += "</div><!--./input-group-append-->";
              html += "</div><!--./input-group input-group-sm-->";
              html += "</div><!--./col-10-->";
              html += "</div><!--./form-group-->";
              html += "</div>";
              html += "</div>";
            } //end for
            $(frm1 + " #department_content").html(html);
            //end department

            autosize($(".ca-textarea"));

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

          autosize($(".ca-textarea"));

          if (param.mode == "view") {
            $(
              frm1 +
                " input:not([readonly])," +
                frm1 +
                " textarea:not([readonly])," +
                frm1 +
                " select,button"
            ).addClass(param.mode);
            //$(frm1 +' input:not([readonly]),textarea:not([readonly]),select').addClass('form-control-plaintext');

            $(".to_hide").addClass("d-none");
            //$(frm1 +' .tooltip_icon').addClass('d-none');

            $(frm1 + " .input-group-append").addClass("d-none");

            $(frm1 + " select." + param.mode + "").removeClass("custom-select");

            $(
              frm1 +
                " button." +
                param.mode +
                "," +
                frm1 +
                " input." +
                param.mode +
                "," +
                frm1 +
                " textarea." +
                param.mode +
                "," +
                frm1 +
                " select." +
                param.mode +
                ""
            ).removeClass("form-control");
            $(
              frm1 +
                " button." +
                param.mode +
                "," +
                frm1 +
                " input." +
                param.mode +
                "," +
                frm1 +
                " textarea." +
                param.mode +
                "," +
                frm1 +
                " select." +
                param.mode +
                ""
            ).addClass("form-control-plaintext");

            $(
              frm1 +
                " button." +
                param.mode +
                ", input." +
                param.mode +
                ",textarea." +
                param.mode +
                "," +
                frm1 +
                " select." +
                param.mode +
                ""
            ).prop("disabled", true);
            $(frm1 + " button").addClass("d-none");

            //$('.btn_submit').addClass('d-none');

            autosize($(".ca-textarea"));

            //custom can be omitted
            if (frm1 == ".frm_data_entry2") {
              $(frm1 + " input#search_location2")
                .parent()
                .parent()
                .addClass("d-none");
              $(frm1 + " textarea[name=header\\[location2\\]]")
                .parent()
                .parent()
                .removeClass("d-none");
              $(frm1 + " textarea[name=header\\[location2\\]]").addClass(
                "form-control-plaintext"
              );
              $(frm1 + " textarea[name=header\\[location2\\]]").removeClass(
                "form-control"
              );
              autosize($(".ca-textarea"));
            } else {
              $(frm1 + " input#search_location")
                .parent()
                .parent()
                .addClass("d-none");
              $(frm1 + " textarea[name=header\\[location\\]]")
                .parent()
                .parent()
                .removeClass("d-none");
              $(frm1 + " textarea[name=header\\[location\\]]").addClass(
                "form-control-plaintext"
              );
              $(frm1 + " textarea[name=header\\[location\\]]").removeClass(
                "form-control"
              );
              autosize($(".ca-textarea"));
            } //end if

            autosize($(".ca-textarea"));
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
        //alert(e.responseText);
        btn.html(btn_text);
        $(".outside_button *").css("pointer-events", "auto");
        $("#loading").hide();
      })
      .always(function (e) {});
  } //end load_record

  //source data
  function source_data(input_html) {
    var url = homeurl + "/get_master_data";

    var btn = $(frm_1 + " #loader");
    var btn_text = "";

    data = {};
    data.id = job_post;

    $.ajax({
      url: url,
      type: "POST",
      async: false,
      data: data,
      dataType: "JSON",
      beforeSend: function () {},
    })
      .done(function (response) {
        if (response.data !== null && response.data !== undefined) {
          var resp_data = response.data[0];
          input_html.val(resp_data.job_title);
        } else {
        } //end if
      })
      .fail(function (e) {
        //alert(e.responseText);
        btn.html(btn_text);
        $(".outside_button *").css("pointer-events", "auto");
      })
      .always(function (e) {});
  } //end soruce data
  //=======================================================================================================================
  //end load data
}); //End document.ready
