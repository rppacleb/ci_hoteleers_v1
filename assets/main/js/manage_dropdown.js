$(document).ready(function () {
  //highlight
  $("#side_manage_dropdown").removeClass("text-muted");
  $("#side_manage_dropdown").addClass("active");
  $("#side_manage_dropdown").css({
    opacity: 0.8,
    "background-color": "rgb(0, 41, 170)",
  });
  //end highlight

  if ($(window).width() >= 1441) {
    $(".container-fluid").css({ "max-width": "1440px" });
    $("#side_menu").css("width", "18%");
  } else if ($(window).width() >= 1360 && $(window).width() <= 1440) {
    $(".container-fluid").css({ "max-width": "1350px" });
    $("#side_menu").css("width", "20%");
  } else if ($(window).width() >= 1200 && $(window).width() <= 1359) {
    $(".container-fluid").css({ "max-width": "1200px" });
    $("#side_menu").css("width", "23%");
  }

  load_record(
    0,
    "education",
    "education_container",
    "education_pagination",
    "education_loader"
  );
  load_record(
    0,
    "job_type",
    "job_type_container",
    "job_type_pagination",
    "job_type_loader"
  );
  load_record(
    0,
    "industry",
    "industry_container",
    "industry_pagination",
    "industry_loader"
  );
  load_record(
    0,
    "department",
    "department_container",
    "department_pagination",
    "department_loader"
  );
  load_record(
    0,
    "job_level",
    "job_level_container",
    "job_level_pagination",
    "job_level_loader"
  );
  load_record(
    0,
    "location",
    "location_container",
    "location_pagination",
    "location_loader"
  );
  load_record(
    0,
    "perks_and_benefits",
    "perks_and_benefits_container",
    "perks_and_benefits_pagination",
    "perks_and_benefits_loader"
  );
  load_record(
    0,
    "employer_position",
    "employer_position_container",
    "employer_position_pagination",
    "employer_position_loader"
  );
  //load record
  function load_record(page, type, container, pagination, loader) {
    var url = baseurl + "/get/manage_dropdown/" + type + "/?page=" + page;
    $.ajax({
      url: url,
      type: "GET",
      dataType: "JSON",
      beforeSend: function () {
        $("#" + loader + "").html(
          '<div class="col-12 text-center"><div class="spinner-grow text-muted"></div></div>'
        );
      },
    })
      .done(function (data) {
        if (data.data !== null) {
          $("#" + container + "").empty();
          $("#" + loader + "").empty();

          $.each(data.data, function (key, value) {
            var html = "";
            html += '<div class="col ">';
            //html += '<a href="#" class="card-link">'+value.name+'</a>';
            var txt_color = "text-muted";
            value.inactive = parseInt(value.inactive);
            if (value.inactive) {
              txt_color = "text-danger";
            }
            //html += '<div class="alert bg-transparent alert-dismissible fade show shadow" role="alert">';
            html +=
              '<small><a style="text-decoration:none;" href="#/" data-toggle="modal" data-target="#edit_modal" data-title="' +
              type +
              '" data-type="' +
              type +
              '" data-id="' +
              value.id +
              '" class="' +
              txt_color +
              ' edit_link" aria-type="' +
              type +
              '" aria-id="' +
              value.id +
              '" aria-inactive="' +
              value.inactive +
              '">' +
              value.name +
              "</a></small>";
            html +=
              '<button title="Remove" class="text-danger close remove" aria-type="' +
              type +
              '" aria-id="' +
              value.id +
              '">&times;</button>';

            //html += '</div>';
            html += "</div>";
            $("#" + container + "").append(html);
          });

          //pagination

          if (page == 0) {
            //$('.'+pagination+'').empty();
            /*
                        for(var i = Math.max(1, page - 5); i <= Math.min(page + 5, data.total_page); i++){
                            var html = '';
                                html += '<li class="page-item" aria-page="'+i+'"><a class="page-link">'+i+'</a></li>';
                            $('.'+pagination+'').append(html);
                        }//end for
                        $('.'+pagination+' > li.page-item:first').addClass('active');
                       */
            /*for (var i = 1; i <= data.total_page; i++) {
                            var html = '';
                            html += '<li class="page-item" aria-page="'+i+'"><a class="page-link">'+i+'</a></li>';
                            $('.'+pagination+'').append(html);
                        }//end if
                        */

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

          var html = "";
          html += '<div class="col-12">';
          html += '<div class="text-center">';
          html += "<small>No Result</small>";
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

  function load_pagination(param) {
    //test
    var pgntn_current_page = parseInt(param.page === 0 ? 1 : param.page);
    var pgntn_total_page = param.total_page;
    var pgntn_per_pages = 10;
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
  }

  $(document.body).on("click", "button[name=btn_login]", function (e) {
    var homeurl = baseurl + "/home";
    var url = baseurl + "/login/login";

    $.ajax({
      url: url,
      data: $("#frm_login").serialize(),
      type: "POST",
      dataType: "JSON",
      async: true,
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
  //end load record

  //events
  //=======================================================================================================================
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

  //append data
  $(document.body).on("click", ".btn_add_append", function (e) {
    var type = $(this).attr("aria-type");
    type_txt = type.replace(/_/g, " ");
    var name = $("input[name=header\\[" + type + "_name\\]]")
      .val()
      .trim();
    var html = "";

    var dup = 0;
    $("#frm_" + type)
      .find("input")
      .each(function () {
        var value = $(this).val();
        if (value.toLowerCase() === name.toLowerCase()) {
          dup = 1;
          return false;
        } //end if
      });

    if (name == "") {
      var msg_html = "Please enter " + type_txt + " name!";
      $.notify(msg_html, {
        position: "top center",
        className: "error",
        arrowShow: true,
      });
      $("input[name=header\\[" + type + "_name\\]]").focus();
    } else {
      if (dup == 0) {
        html += '<div class="col">';
        html += '<small class="text-muted">' + name + "</small>";
        html +=
          '<button title="Remove" class="text-danger close remove_append" aria-type="' +
          type +
          '">&times;</button>';

        html +=
          '<input name="row[name][]" maxlength="200" class="d-none form-control form-control-sm mb-2" type="text" value="' +
          name +
          '">';
        html += "</div>";

        $("#frm_" + type)
          .find(".row")
          .append(html);
      } else {
        var msg_html = "Duplicate entry of " + type_txt + " name!";
        $.notify(msg_html, {
          position: "top center",
          className: "error",
          arrowShow: true,
        });
      } //end

      $("input[name=header\\[" + type + "_name\\]]")
        .val("")
        .focus();
    } //end if
  });
  //end append data

  //remove appended data
  $(document.body).on("click", ".remove_append", function (e) {
    $(this).parent().remove();
  });
  //remove appended data

  //load record
  $(document.body).on("blur", "input[name=header\\[id\\]]", function (e) {
    var id = $(this).val();
    var type = $(this).attr("aria-type");
    var param = {};
    param["type"] = type;
    param["id"] = id;
    load_data(param);
  });
  //end load record

  //add
  $(document.body).on("click", ".btn_add", function (e) {
    var btn = $(this);
    var btn_text = "";
    var type = $(this).attr("aria-type");

    var homeurl = baseurl + "/manage_dropdown";
    var url = baseurl;
    var frm;
    var frm_id = "";

    url += "/manage_dropdown/save_data/" + type;
    frm = $("#frm_" + type).serialize();
    frm_id = "#frm_" + type;

    btn_text = "Save";

    var to_save = false;

    if (
      $.trim(
        $("#frm_" + type)
          .find(".row")
          .html()
      ).length == 0
    ) {
      to_save = true;
    } else {
      to_save = confirm("Are you sure you want to save all item(s)?");
    } //end if

    if (to_save) {
      $.ajax({
        url: url,
        data: frm,
        type: "POST",
        dataType: "JSON",
        beforeSend: function (data) {
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

            load_record(
              0,
              type,
              type + "_container",
              type + "_pagination",
              type + "_loader"
            );
            $(frm_id + " input[name=header\\[id\\]").val("");
            $(frm_id + " input[name=header\\[name\\]").val("");
            $(frm_id + "")
              .find(".row")
              .empty();

            btn.text(btn_text);
            btn.removeAttr("disabled");

            /*
                    setTimeout(function(){
                        window.location.replace(homeurl);
                    },2000)
                    */
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
  }); //end btn_add
  //end add

  //update
  $(document.body).on("click", ".btn_update", function (e) {
    var btn = $(this);
    var btn_text = "";
    var type = $(this).attr("aria-type");

    var homeurl = baseurl + "/manage_dropdown";
    var url = baseurl;
    var frm;
    var frm_id = "";

    url += "/manage_dropdown/update_data/" + type;
    frm = $("#frm_" + type + "_edit").serialize();
    frm_id = "#frm_" + type + "_edit";

    btn_text = "Update";

    $.ajax({
      url: url,
      data: frm,
      type: "POST",
      dataType: "JSON",
      beforeSend: function (data) {
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

          load_record(
            0,
            type,
            type + "_container",
            type + "_pagination",
            type + "_loader"
          );

          btn.text(btn_text);
          btn.removeAttr("disabled");

          /*
                setTimeout(function(){
                    window.location.replace(homeurl);
                },2000)
                */
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
  }); //end btn_add
  //end update

  //delete
  $(document.body).on("click", ".remove", function (e) {
    var btn = $(this);
    var btn_text = "";
    var id = $(this).attr("aria-id");
    var type = $(this).attr("aria-type");

    var homeurl = baseurl + "/manage_dropdown";
    var url = baseurl;
    url += "/manage_dropdown/delete_data/?type=" + type + "&id=" + id;
    var frm;
    var frm_id = "";
    frm = $("#frm_" + type).serialize();
    frm_id = "#frm_" + type;

    if (type == "education") {
      btn_text = "Add Education";
    } //end if

    if (confirm("Are you sure you want to delete this item?")) {
      $.ajax({
        url: url,
        type: "GET",
        dataType: "JSON",
        beforeSend: function (data) {
          //btn.text('Processing...');
          //btn.attr('disabled','disabled');
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
              type,
              type + "_container",
              type + "_pagination",
              type + "_loader"
            );
            $(frm_id + " input[name=header\\[id\\]").val("");
            $(frm_id + " input[name=header\\[name\\]").val("");

            //btn.text(btn_text);
            //btn.removeAttr('disabled');
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

          //btn.text(btn_text);
          //btn.removeAttr('disabled');
        })
        .always(function (e) {});
    } //end if
  }); //end btn_add
  //end delete
  //=======================================================================================================================
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
    $("#frm_" + type + "_edit input[name=header\\[id\\]]")
      .val(id)
      .trigger("blur");
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
    html += '<label class="col-2 col-form-label">Id</label>';
    html += '<div class="col-10">';
    html +=
      '<input readonly class="form-control form-control-md mb-2" type="text" aria-type="' +
      param.type +
      '" name="header[id]"/>';
    html += "</div>";
    html += "</div>";

    html += '<div class="form-group row">';
    html += '<label class="col-2 col-form-label">Name</label>';
    html += '<div class="col-10">';
    html +=
      '<input maxlength="200" class="form-control form-control-md mb-2" type="text" name="header[name]"/>';
    html += "</div>";
    html += "</div>";

    html += '<div class="form-group row">';
    html += '<label class="col-2 col-form-label">Inactive</label>';
    html += '<div class="col-10">';
    html += '<input class="mb-2" type="checkbox" name="header[inactive]"/>';
    html += "</div>";
    html += "</div>";

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
    var url = baseurl + "/load_data/" + param.type + "/" + param.id;

    $.ajax({
      url: url,
      type: "POST",
      dataType: "JSON",
      beforeSend: function () {
        //$('#'+loader+'').html('<div class="col-12 text-center"><div class="spinner-grow text-muted"></div></div>');
        $(".btn_update").html('<div class="spinner-grow"></div>');
      },
    })
      .done(function (data) {
        if (data.data !== null) {
          $("#frm_" + param.type + "_edit input[name=header\\[name\\]]").val(
            data.data.name
          );
          data.data.inactive = parseInt(data.data.inactive);
          $(
            "#frm_" + param.type + "_edit input[name=header\\[inactive\\]]"
          ).prop("checked", data.data.inactive);

          $(".btn_update").html("Update");
        } else {
          $(".btn_update").html("Update");
        } //end if
      })
      .fail(function (e) {
        alert(e.responseText);
        $(".btn_update").html("Update");
      })
      .always(function (e) {});
  } //end load_record
  //=======================================================================================================================
  //end load data
}); //End document.ready
