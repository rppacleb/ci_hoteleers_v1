$(document).ready(function () {
  var homeurl = baseurl + "/schedule";
  var homeurl_txt = "schedule";
  var urlimgdef = "https://dummyimage.com/76x76/dee2e6/6c757d.jpg";
  var upload_path = baseurl + "/files/uploads/";
  var dropdown_loaded = 0;
  // load_record(0,'signup','main_container','main_pagination','main_loader');

  //alert(moment('4/30/2016', 'MM/DD/YYYY').add(1, 'day'));

  //highlight
  $("#side_schedule").removeClass("text-muted");
  $("#side_schedule").addClass("active");
  $("#side_schedule").css({
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

  //Initialize date time picker
  $("input[name=header\\[interview_date\\]]").datetimepicker({
    format: "M/D/YYYY",
    // defaultDate : new Date()
    defaultDate: null,
  });

  $("input[name=header\\[interview_start_time\\]]").datetimepicker({
    format: "LT",
    // defaultDate : new Date()
    defaultDate: null,
  });

  $("input[name=header\\[interview_end_time\\]]").datetimepicker({
    format: "LT",
    // defaultDate : new Date()
    defaultDate: null,
  });

  //load_data
  //load record
  $(document.body).on("blur", "input[name=header\\[id\\]]", function (e) {
    var id = $(this).val();
    var type = $(this).attr("aria-type");
    var applicant = $(this).attr("aria-applicant");
    var param = {};
    //param["type"]   = type;
    param["id"] = id;
    param["mode"] = type;
    param["user_id"] = user_id;
    param["job_post_id"] = job_post_id;
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
    //view_url     = view_url.replace(/add/g,'view');
    //view_url     = view_url.replace(/edit/g,'view');

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

    if (confirm("An email to the applicant will be sent with these details.")) {
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

            view_url +=
              data.data.id + "?user_id=" + user_id + "&job_post=" + job_post_id;

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

  $(document.body).on(
    "change",
    "select[name=header\\[interview_type\\]]",
    function () {
      var interview_type = $(this).val();
      $(".face_to_face").addClass("d-none");
      $(".virtual").addClass("d-none");
      $("." + interview_type).removeClass("d-none");
    }
  ); //blur
  $("select[name=header\\[interview_type\\]]").trigger("change");

  //=====================================================================================================================
  //end events

  //sourcing
  //=======================================================================================================================
  //load data
  function load_data(param) {
    var url =
      homeurl +
      "/load_data/" +
      param.id +
      "?user_id=" +
      param.user_id +
      "&job_post=" +
      param.job_post_id;

    var btn = $(".btn_submit");
    var btn_text = "Send";
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

          if (param.mode == "view") {
            $(".btn_accept_dec2").removeClass("d-none");
          } //end if

          if (param.mode == "edit" || param.mode == "view") {
            //view and edit mode
            //----------------------------------------------------------------------------------------------------
            var status_html = "";

            if (data.status == "completed") {
              status_html =
                '<span class="badge rounded-pill bg-success">' +
                data.status.toUpperCase() +
                "</span>";
            } else if (data.status == "cancelled") {
              status_html =
                '<span class="badge rounded-pill bg-danger">' +
                data.status.toUpperCase() +
                "</span>";
            } else {
              status_html =
                '<span class="badge rounded-pill bg-warning ">' +
                data.status.toUpperCase() +
                "</span>";
            } //end if
            $("#status").html(status_html);

            var resp_class = "text-warning";
            if (data.notif_status == "accepted") {
              resp_class = "text-success";
              $(".btn_accept_dec2").attr("disabled", true);
            } else if (data.notif_status == "declined") {
              resp_class = "text-danger";
              $(".btn_accept_dec2").attr("disabled", true);
            } //end if//end if

            if (data.notif_status !== null) {
              $("h4[name=placeholder\\[notif_status\\]]").html(
                toPascalCase(data.notif_status)
              );
              $("h4[name=placeholder\\[notif_status\\]]").addClass(resp_class);
            } //end if

            $("#frm_data_entry input[name=header\\[interview_date\\]]").val(
              data.interview_date
            );

            $(
              "#frm_data_entry input[name=placeholder\\[interview_date\\]]"
            ).val(data.interview_date_placeholder);

            $(
              "#frm_data_entry input[name=header\\[interview_start_time\\]]"
            ).val(data.interview_start_time);
            $("#frm_data_entry input[name=header\\[interview_end_time\\]]").val(
              data.interview_end_time
            );

            if (response.placeholder !== null) {
              var placeholder = response.placeholder[0];
              $(
                "#frm_data_entry input[name=placeholder\\[applicant_name\\]]"
              ).val(placeholder.applicant_name);
              $(
                "#frm_data_entry input[name=placeholder\\[applicant_email\\]]"
              ).val(placeholder.applicant_email);
              $(
                "#frm_data_entry input[name=placeholder\\[company_name\\]]"
              ).val(placeholder.company_name);
              $("#frm_data_entry input[name=placeholder\\[job_title\\]]").val(
                placeholder.job_title
              );
            } //end if

            $("#frm_data_entry input[name=header\\[interview_end_time\\]]").val(
              data.interview_end_time
            );
            $(
              "#frm_data_entry input[name=header\\[interviewer_name_position\\]]"
            ).val(data.interviewer_name_position);
            $("#frm_data_entry select[name=header\\[interview_type\\]]")
              .val(data.interview_type)
              .trigger("change");

            $(
              "#frm_data_entry input[name=header\\[virtual_interview_link\\]]"
            ).val(data.virtual_interview_link);
            $(
              "#frm_data_entry textarea[name=header\\[notes_to_interviewee\\]]"
            ).val(data.notes_to_interviewee);

            //$('#frm_data_entry select[name=header\\[location\\]]').multiselect('select',data.location);
            $("#frm_data_entry input[name=header\\[location\\]]").val(
              data.location
            );
            $("#frm_data_entry input[name=placeholder\\[location\\]]").val(
              data.location
            );

            //----------------------------------------------------------------------------------------------------
            //end view and edit mode
          } else {
            //add mode
            //----------------------------------------------------------------------------------------------------
            if (response.placeholder !== null) {
              var placeholder = response.placeholder[0];
              $(
                "#frm_data_entry input[name=placeholder\\[applicant_name\\]]"
              ).val(placeholder.applicant_name);
              $(
                "#frm_data_entry input[name=placeholder\\[applicant_email\\]]"
              ).val(placeholder.applicant_email);
              $(
                "#frm_data_entry input[name=placeholder\\[company_name\\]]"
              ).val(placeholder.company_name);
              $("#frm_data_entry input[name=placeholder\\[job_title\\]]").val(
                placeholder.job_title
              );
            } //end if
            //----------------------------------------------------------------------------------------------------
            //end add mode
          } //end if

          autosize($(".schedvw-textarea"));

          if (param.mode == "view") {
            $(".schedvw-header").html("Schedule");

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
                ':not(".show_on_view"), input.' +
                param.mode +
                ",textarea." +
                param.mode +
                ",select." +
                param.mode +
                ""
            ).prop("disabled", true);

            //placehoder
            $("#frm_data_entry input[name^=placeholder]").removeClass("d-none");
            $(
              "#frm_data_entry input[name=header\\[interview_date\\]]"
            ).addClass("d-none");
            //end placehoder

            $('#frm_data_entry button:not(".show_on_view")').addClass("d-none");
            $(".btn_submit").addClass("d-none");

            $(".outside_button > a").removeClass("mr-4");
            $(".outside_button > a").html("Back");
            $(".outside_button > a").attr("href", baseurl + "/schedule/");

            //custom can be omitted
            if (
              $(
                "#frm_data_entry select[name=header\\[interview_type\\]]"
              ).val() == "face_to_face"
            ) {
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
          } //end if

          btn.html(btn_text);
          $(".outside_button *").css("pointer-events", "auto");
        } else {
          //add mode
          //----------------------------------------------------------------------------------------------------
          if (param.mode == "add") {
            if (dropdown_loaded == 0) {
              load_filter_dropdowns();
            } //end if
          } //end if

          if (response.placeholder !== null) {
            var placeholder = response.placeholder[0];
            $(
              "#frm_data_entry input[name=placeholder\\[applicant_name\\]]"
            ).val(placeholder.applicant_name);
            $(
              "#frm_data_entry input[name=placeholder\\[applicant_email\\]]"
            ).val(placeholder.applicant_email);
            $("#frm_data_entry input[name=placeholder\\[company_name\\]]").val(
              placeholder.company_name
            );
            $("#frm_data_entry input[name=placeholder\\[job_title\\]]").val(
              placeholder.job_title
            );
          } //end if

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
        $("#loading").hide();
      })
      .always(function (e) {});
  } //end load_record
  //=======================================================================================================================
  //end load data

  //autocomplete
  //===============================================================================================================================

  function load_dropdowns(type) {
    $("select[name=header\\[" + type + "\\]]").multiselect({
      enableFiltering: true,
      //selectAllValue: 'multiselect-all',
      //selectAllText: 'Select All',
      //includeSelectAllOption : true,
      buttonClass: "custom-select custom-select-md",
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

    dropdown_loaded = 1;
  } //end if

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

  $(document.body).on("click", ".btn_accept_dec2", function (e) {
    const status = $(this).attr("aria-status");
    const msg_html = "Successfully completed";

    var param = {};
    param.header = {};
    param.header = {
      id: id,
      status: status,
    };
    const confirm_message = confirm("This will " + status + " the invitation!");
    if (confirm_message) {
      process_invitation(param, function (data) {
        if (data["success"]) {
          $.notify(msg_html, {
            position: "top center",
            className: "success",
            arrowShow: true,
          });

          $(".btn_accept_dec2").attr("disabled", true);
          $(".btn_decide").removeClass("disabled", true);
        } else {
          $.notify(data["message"], {
            position: "top center",
            className: "error",
            arrowShow: true,
          });
        } //end if
      });
    } //end if
  });
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

  function process_invitation(param, callback) {
    var url = baseurl + "/schedule/process_invitation";
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
        callback(data);
      })
      .always(function (e) {});
  } //end function
}); //End document.ready
