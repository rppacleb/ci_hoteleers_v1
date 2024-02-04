$(document).ready(function () {
  //highlight
  $("#side_homepage_banner").removeClass("text-muted");
  $("#side_homepage_banner").addClass("active");
  $("#side_homepage_banner").css({
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

  var homeurl = baseurl + "/homepage_banner";
  var homeurl_txt = "homepage_banner";
  var urlimgdef = baseurl + "/files/images/default/banner_image.png";
  var upload_path = baseurl + "/files/uploads/";
  //load_record(0,'homepage_banner','main_container','main_pagination','main_loader');

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
  $("input[name=header\\[id\\]]").trigger("blur");
  //end load record

  $(document.body).on("click", "a.btn_edit", function (e) {
    $("input[name=header\\[id\\]]").attr("aria-type", "edit");
    $("input[name=header\\[id\\]]").trigger("blur");
  });

  //event
  //=====================================================================================================================
  //submit
  $(document.body).on("click", "button.btn_submit", function (e) {
    var view_url = homeurl;

    var id = $(this).attr("aria-id");
    var btn = $(this);
    var btn_text = "";
    var type_text = "";

    var url = homeurl;
    url = homeurl + "/submit_data";
    var url_view = homeurl + "/view";

    var frm_id = "";

    btn_text = "Save";

    if (confirm("Are you sure you want to save this data?")) {
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

            //view_url += data.data.id;
            //view_url += '?employer=' + data.data.employer;
            setTimeout(function () {
              window.location.replace(view_url);
              btn.text(btn_text);
              btn.removeAttr("disabled");
              $(".outside_button *").css("pointer-events", "auto");
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

  //upload trigger
  $(document.body).on("click", "button[name=btn_upload_a]", function (e) {
    upload_image_a();
  });
  //end upload trigger

  //upload trigger
  $(document.body).on("click", "button[name=btn_upload_b]", function (e) {
    upload_image_b();
  });
  //end upload trigger

  //upload trigger
  $(document.body).on("click", "button[name=btn_upload_c]", function (e) {
    upload_image_c();
  });
  //end upload trigger

  //upload trigger
  $(document.body).on("click", "button[name=btn_upload_d]", function (e) {
    upload_image_d();
  });
  //end upload trigger

  //remove trigger
  $(document.body).on("click", "button[name=btn_remove_a]", function (e) {
    $("img[id=header\\[banner_a\\]]").attr("src", urlimgdef);
    $("input[name=file\\[doc_content_a\\]]").val("");
    $("input[name=header\\[doc_image_a\\]]").val("");
    //$('input[name=header\\[doc_image\\]]').val('');
  });
  //end remove trigger

  //remove trigger
  $(document.body).on("click", "button[name=btn_remove_b]", function (e) {
    $("img[id=header\\[banner_b\\]]").attr("src", urlimgdef);
    $("input[name=file\\[doc_content_b\\]]").val("");
    $("input[name=header\\[doc_image_b\\]]").val("");
    //$('input[name=header\\[doc_image\\]]').val('');
  });
  //end remove trigger

  //remove trigger
  $(document.body).on("click", "button[name=btn_remove_c]", function (e) {
    $("img[id=header\\[banner_c\\]]").attr("src", urlimgdef);
    $("input[name=file\\[doc_content_c\\]]").val("");
    $("input[name=header\\[doc_image_c\\]]").val("");
    //$('input[name=header\\[doc_image\\]]').val('');
  });
  //end remove trigger

  //remove trigger
  $(document.body).on("click", "button[name=btn_remove_d]", function (e) {
    $("img[id=header\\[banner_d\\]]").attr("src", urlimgdef);
    $("input[name=file\\[doc_content_d\\]]").val("");
    $("input[name=header\\[doc_image_d\\]]").val("");
    //$('input[name=header\\[doc_image\\]]').val('');
  });
  //end remove trigger

  //=====================================================================================================================
  //end events

  //Upload image
  //===============================================================================================================================
  //upload image
  function upload_image_a() {
    var url = homeurl + "/do_upload_a";
    var btn = $("button[name=btn_upload_a]");
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
            btn.html("Upload");
            btn.removeAttr("disabled");
            $(".outside_button *").css("pointer-events", "auto");
            $("input[name=file\\[doc_content_a\\]]").val(file.file);
            $("img[id=header\\[banner_a\\]]").attr(
              "src",
              "data:image/jpeg;base64, " + file.file
            );
            $("input[name=header\\[doc_image_a\\]]").val(file.file_attr.name);
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
            btn.html("Upload");
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
        //},2000)
      })
      .always(function (e) {});
  }
  //End upload image

  function upload_image_b() {
    var url = homeurl + "/do_upload_b";
    var btn = $("button[name=btn_upload_b]");
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
            btn.html("Upload");
            btn.removeAttr("disabled");
            $(".outside_button *").css("pointer-events", "auto");
            $("input[name=file\\[doc_content_b\\]]").val(file.file);
            $("img[id=header\\[banner_b\\]]").attr(
              "src",
              "data:image/jpeg;base64, " + file.file
            );
            $("input[name=header\\[doc_image_b\\]]").val(file.file_attr.name);
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
            $(".outside_button *").css("pointer-events", "auto");
            btn.html("Upload");
            btn.removeAttr("disabled");
          }, 2000);
        }
      })
      .fail(function (data) {
        alert(JSON.stringify(data));
        //setTimeout(function(){

        //$('#uploadErrorCont').html(data.responseText)
        $(".outside_button *").css("pointer-events", "auto");
        btn.html("Upload Image");
        btn.removeAttr("disabled");
        //},2000)
      })
      .always(function (e) {});
  }
  //End upload image

  //upload image
  function upload_image_c() {
    var url = homeurl + "/do_upload_c";
    var btn = $("button[name=btn_upload_c]");
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
            btn.html("Upload");
            btn.removeAttr("disabled");
            $(".outside_button *").css("pointer-events", "auto");
            $("input[name=file\\[doc_content_c\\]]").val(file.file);
            $("img[id=header\\[banner_c\\]]").attr(
              "src",
              "data:image/jpeg;base64, " + file.file
            );
            $("input[name=header\\[doc_image_c\\]]").val(file.file_attr.name);
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
            btn.html("Upload");
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
        //},2000)
      })
      .always(function (e) {});
  }
  //End upload image

  //upload image
  function upload_image_d() {
    var url = homeurl + "/do_upload_d";
    var btn = $("button[name=btn_upload_d]");
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
            btn.html("Upload");
            btn.removeAttr("disabled");
            $(".outside_button *").css("pointer-events", "auto");
            $("input[name=file\\[doc_content_d\\]]").val(file.file);
            $("img[id=header\\[banner_d\\]]").attr(
              "src",
              "data:image/jpeg;base64, " + file.file
            );
            $("input[name=header\\[doc_image_d\\]]").val(file.file_attr.name);
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
            btn.html("Upload");
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
        //},2000)
      })
      .always(function (e) {});
  }
  //End upload image

  //===============================================================================================================================
  //End upload image

  //functions
  function load_text_editor(input, is_editable) {
    //load text editor
    const txt_editor = input.jqte({
      // b: false,
      br: true,
      center: true,
      color: false,
      fsize: true,
      fsizes: ["10", "12", "16", "18", "20", "24", "28", "32", "36", "40"],
      funit: "pt",
      format: false,
      // i: false,
      // indent: false,
      link: false,
      left: true,
      // outdent: false,
      remove: false,
      right: true,
      rule: false,
      sub: false,
      sup: false,
      strike: false,
      // u: false,
      unlink: false,
      source: false,
    });
    $(".jqte_editor").css("resize", "none");

    if (!is_editable) {
      $(".jqte").css({
        margin: "0",
        border: "none",
      });
      $(".jqte_toolbar").remove();
      $(".jqte_editor").attr("contenteditable", false);
    } //end if

    return txt_editor;

    //end load text editor
  } //end function
  //end functions

  //sourcing
  //=======================================================================================================================
  //load data
  function load_data(param) {
    var url = homeurl + "/load_data/" + param.id;
    var btn = $(".btn_submit");
    var btn_text = "Save";
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
            $("#frm_data_entry input[name=header\\[doc_image_a\\]]").val(
              data.doc_image_a
            );
            $("#frm_data_entry input[name=file\\[old_doc_image_a\\]]").val(
              data.doc_image_a
            );

            $("#frm_data_entry input[name=header\\[doc_image_b\\]]").val(
              data.doc_image_b
            );
            $("#frm_data_entry input[name=file\\[old_doc_image_b\\]]").val(
              data.doc_image_b
            );

            $("#frm_data_entry input[name=header\\[doc_image_c\\]]").val(
              data.doc_image_c
            );
            $("#frm_data_entry input[name=file\\[old_doc_image_c\\]]").val(
              data.doc_image_c
            );

            $("#frm_data_entry input[name=header\\[doc_image_d\\]]").val(
              data.doc_image_d
            );
            $("#frm_data_entry input[name=file\\[old_doc_image_d\\]]").val(
              data.doc_image_d
            );

            $("#frm_data_entry input[name=header\\[title_a\\]]").val(
              data.title_a
            );
            $("#frm_data_entry textarea[name=header\\[description_a\\]]").val(
              data.description_a
            );

            $("#frm_data_entry input[name=header\\[title_b\\]]").val(
              data.title_b
            );
            $("#frm_data_entry textarea[name=header\\[description_b\\]]").val(
              data.description_b
            );

            $("#frm_data_entry input[name=header\\[title_c\\]]").val(
              data.title_c
            );
            $("#frm_data_entry textarea[name=header\\[description_c\\]]").val(
              data.description_c
            );

            $("#frm_data_entry input[name=header\\[title_d\\]]").val(
              data.title_d
            );
            $("#frm_data_entry textarea[name=header\\[description_d\\]]").val(
              data.description_d
            );

            if (param.mode == "view") {
              const about_us_desc = load_text_editor(
                $("#frm_data_entry textarea[name=header\\[about_us_desc\\]]"),
                false
              );
              const contact_us_content_1 = load_text_editor(
                $(
                  "#frm_data_entry textarea[name=header\\[contact_us_content_1\\]]"
                ),
                false
              );
              const contact_us_content_2 = load_text_editor(
                $(
                  "#frm_data_entry textarea[name=header\\[contact_us_content_2\\]]"
                ),
                false
              );
              const contact_us_content_3 = load_text_editor(
                $(
                  "#frm_data_entry textarea[name=header\\[contact_us_content_3\\]]"
                ),
                false
              );
              const contact_us_content_4 = load_text_editor(
                $(
                  "#frm_data_entry textarea[name=header\\[contact_us_content_4\\]]"
                ),
                false
              );
              const contact_us_content_5 = load_text_editor(
                $(
                  "#frm_data_entry textarea[name=header\\[contact_us_content_5\\]]"
                ),
                false
              );
              const terms_of_use = load_text_editor(
                $("#frm_data_entry textarea[name=header\\[terms_of_use\\]]"),
                false
              );
              const privacy_policy = load_text_editor(
                $("#frm_data_entry textarea[name=header\\[privacy_policy\\]]"),
                false
              );

              about_us_desc.jqteVal(data.about_us_desc);
              contact_us_content_1.jqteVal(data.contact_us_content_1);
              contact_us_content_2.jqteVal(data.contact_us_content_2);
              contact_us_content_3.jqteVal(data.contact_us_content_3);
              contact_us_content_4.jqteVal(data.contact_us_content_4);
              contact_us_content_5.jqteVal(data.contact_us_content_5);
              terms_of_use.jqteVal(data.terms_of_use);
              privacy_policy.jqteVal(data.privacy_policy);
            } else {
              const about_us_desc = load_text_editor(
                $("#frm_data_entry textarea[name=header\\[about_us_desc\\]]"),
                true
              );
              const contact_us_content_1 = load_text_editor(
                $(
                  "#frm_data_entry textarea[name=header\\[contact_us_content_1\\]]"
                ),
                true
              );
              const contact_us_content_2 = load_text_editor(
                $(
                  "#frm_data_entry textarea[name=header\\[contact_us_content_2\\]]"
                ),
                true
              );
              const contact_us_content_3 = load_text_editor(
                $(
                  "#frm_data_entry textarea[name=header\\[contact_us_content_3\\]]"
                ),
                true
              );
              const contact_us_content_4 = load_text_editor(
                $(
                  "#frm_data_entry textarea[name=header\\[contact_us_content_4\\]]"
                ),
                true
              );
              const contact_us_content_5 = load_text_editor(
                $(
                  "#frm_data_entry textarea[name=header\\[contact_us_content_5\\]]"
                ),
                true
              );
              const terms_of_use = load_text_editor(
                $("#frm_data_entry textarea[name=header\\[terms_of_use\\]]"),
                true
              );
              const privacy_policy = load_text_editor(
                $("#frm_data_entry textarea[name=header\\[privacy_policy\\]]"),
                true
              );

              about_us_desc.jqteVal(data.about_us_desc);
              contact_us_content_1.jqteVal(data.contact_us_content_1);
              contact_us_content_2.jqteVal(data.contact_us_content_2);
              contact_us_content_3.jqteVal(data.contact_us_content_3);
              contact_us_content_4.jqteVal(data.contact_us_content_4);
              contact_us_content_5.jqteVal(data.contact_us_content_5);
              terms_of_use.jqteVal(data.terms_of_use);
              privacy_policy.jqteVal(data.privacy_policy);
            } //end if

            //job_description.jqteVal(data.job_description);

            if (data.doc_image_a === null || data.doc_image_a == "") {
              $("img[id=header\\[banner_a\\]]").attr("src", urlimgdef);
            } else {
              $("img[id=header\\[banner_a\\]]").attr(
                "src",
                upload_path + data.doc_image_a
              );
            } //end if

            if (data.doc_image_b === null || data.doc_image_b == "") {
              $("img[id=header\\[banner_b\\]]").attr("src", urlimgdef);
            } else {
              $("img[id=header\\[banner_b\\]]").attr(
                "src",
                upload_path + data.doc_image_b
              );
            } //end if

            if (data.doc_image_c === null || data.doc_image_c == "") {
              $("img[id=header\\[banner_c\\]]").attr("src", urlimgdef);
            } else {
              $("img[id=header\\[banner_c\\]]").attr(
                "src",
                upload_path + data.doc_image_c
              );
            } //end if

            if (data.doc_image_d === null || data.doc_image_d == "") {
              $("img[id=header\\[banner_d\\]]").attr("src", urlimgdef);
            } else {
              $("img[id=header\\[banner_d\\]]").attr(
                "src",
                upload_path + data.doc_image_d
              );
            } //end if

            //----------------------------------------------------------------------------------------------------
            //end view and edit mode
          } else {
            //add mode
            //----------------------------------------------------------------------------------------------------
            //----------------------------------------------------------------------------------------------------
            //end add mode
          } //end if

          if (param.mode == "view") {
            $(
              "#frm_data_entry input,textarea:not([readonly]),select,button"
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
            $("#frm_data_entry button").addClass("d-none");

            $(".btn_submit").addClass("d-none");

            //load_text_editor(false);
          } else {
            //load_text_editor(true);
          } //end if

          btn.html(btn_text);
          $(".outside_button *").css("pointer-events", "auto");
        } else {
          //add mode
          //----------------------------------------------------------------------------------------------------
          btn.html(btn_text);
          $(".outside_button *").css("pointer-events", "auto");
          $("img[id=header\\[banner_a\\]]").attr("src", urlimgdef);
          $("img[id=header\\[banner_b\\]]").attr("src", urlimgdef);

          //----------------------------------------------------------------------------------------------------
          //end add mode
        } //end if

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
  //end load data
}); //End document.ready
