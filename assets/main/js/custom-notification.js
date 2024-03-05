$(document).ready(function () {
  load_notification(function (res) {
    if (res.num_rows > 0) {
      $(".notification-counter").removeClass("d-none");
    } //end if
    $(".notification-counter").text(res.num_rows);

    let html = "";

    for (const k in res.data) {
      const data = res.data[k];

      var new_badge = "";

      if (!parseInt(data.viewed)) {
        new_badge = '<span class="badge badge-secondary">new</span>';
      } //end if

      var url = "";
      if (data.record_type == "job_post") {
        url =
          baseurl +
          "/job_search/private/view/" +
          data.record_id +
          "?notification_id=" +
          data.id;
        html +=
          '<a notif-id="' +
          data.id +
          '" data-schedule_status="' +
          data.schedule_status +
          '" target="_blank" class="dropdown-item notif-item" href="' +
          url +
          '">' +
          new_badge +
          " " +
          data.short_message +
          "</a>";
      } else {
        //html += '<a href="#" notif-id="'+data.id+'" target="_blank" class="dropdown-item notif-item" data-toggle="modal" data-target="#notification_modal" data-id="'+data.id+'" data-message="'+data.message+'" >'+new_badge+' '+data.short_message+'</a>';
        html +=
          '<a notif-id="' +
          data.id +
          '" data-schedule_status="' +
          data.schedule_status +
          '" target="_blank" class="dropdown-item notif-item" data-toggle="modal" data-target="#notification_modal" data-id="' +
          data.id +
          '" data-message="' +
          btoa(data.message) +
          '" data-employer="' +
          btoa(data.employer) +
          '" data-type="' +
          data.record_type +
          '" data-status="' +
          data.status +
          '">' +
          new_badge +
          " " +
          data.short_message +
          "</a>";
      } //end if

      if (parseInt(k) == res.data.length - 1) {
        continue;
      } //end if
      html += '<div class="dropdown-divider"></div>';
    } //end for

    $("#dropdown_notification").html(html);
  });

  //auto purge data
  auto_purge_data(function (res) {});
  //end auto purge data

  //get notification

  setInterval(function () {
    load_notification(function (res) {
      if (res.num_rows > 0) {
        $(".notification-counter").removeClass("d-none");
      } //end if
      $(".notification-counter").text(res.num_rows);

      let html = "";

      for (const k in res.data) {
        const data = res.data[k];

        var new_badge = "";

        if (!parseInt(data.viewed)) {
          new_badge = '<span class="badge badge-secondary">new</span>';
        } //end if

        var url = "";
        if (data.record_type == "job_post") {
          url =
            baseurl +
            "/job_search/private/view/" +
            data.record_id +
            "?notification_id=" +
            data.id;
          html +=
            '<a notif-id="' +
            data.id +
            '" target="_blank" class="dropdown-item notif-item" href="' +
            url +
            '">' +
            new_badge +
            " " +
            data.short_message +
            "</a>";
        } else {
          //html += '<a href="#" notif-id="'+data.id+'" target="_blank" class="dropdown-item notif-item" data-toggle="modal" data-target="#notification_modal" data-id="'+data.id+'" data-message="'+data.message+'" >'+new_badge+' '+data.short_message+'</a>';
          html +=
            '<a notif-id="' +
            data.id +
            '" target="_blank" class="dropdown-item notif-item" data-toggle="modal" data-target="#notification_modal" data-id="' +
            data.id +
            '" data-message="' +
            btoa(data.message) +
            '" data-employer="' +
            btoa(data.employer) +
            '" data-type="' +
            data.record_type +
            '" data-status="' +
            data.status +
            '">' +
            new_badge +
            " " +
            data.short_message +
            "</a>";
        } //end if

        if (parseInt(k) == res.data.length - 1) {
          continue;
        } //end if
        html += '<div class="dropdown-divider"></div>';
      } //end for

      console.log(html);

      $("#dropdown_notification").html(html);
    });
  }, 10000);

  /*load_notification(function(res){
        if(res.num_rows > 0){
            $('.notification-counter').removeClass('d-none');
        }
        $('.notification-counter').text(res.num_rows);

       
        
      
        let html = '';

        
  

        for(const k in res.data){
            const data = res.data[k];
            
            var new_badge = '';

            if(!parseInt(data.viewed)){
                new_badge = '<span class="badge badge-secondary">new</span>';
            }//end if

            var url = '';
            if(data.record_type == 'job_post'){
                url = baseurl+'/job_search/private/view/'+data.record_id+'?notification_id='+data.id;
                html += '<a notif-id="'+data.id+'" target="_blank" class="dropdown-item notif-item" href="'+url+'">'+new_badge+' '+data.short_message+'</a>';
            }else{
                html += '<a notif-id="'+data.id+'" target="_blank" class="dropdown-item notif-item" data-toggle="modal" data-target="#notification_modal" data-id="'+data.id+'" data-message="'+data.message+'" data-type="'+data.record_type+'" data-status="'+data.status+'">'+new_badge+' '+data.short_message+'</a>';
            }//end if
            

            if(parseInt(k) == res.data.length - 1){
                continue;
            }//end if
            html += '<div class="dropdown-divider"></div>';
        }//end for

        $('#dropdown_notification').html(html);
    });
    */
  //end get notification

  load_record(0, "notification", "notification", function () {});

  $("#notification_modal").on("shown.bs.modal", function (e) {
    var id = $(e.relatedTarget).data("id");
    var type = $(e.relatedTarget).data("type");
    var status = $(e.relatedTarget).data("status");
    var employer = atob($(e.relatedTarget).data("employer"));
    var schedule_status = $(e.relatedTarget).data("schedule_status");

    $(".modal-title").text(employer);

    card_class = "";

    if (status == "pending") {
      card_class = "text-warning";
    } else if (status == "accepted") {
      card_class = "text-success";
    } else {
      card_class = "text-danger";
    } //end if

    if (schedule_status == "cancelled") {
      status = schedule_status;
      card_class = "text-danger";
    } //end if

    var message = atob($(e.relatedTarget).data("message"));

    var final_html = "";
    final_html += '<div class="card">';

    final_html += '<div class="card-body">';
    final_html +=
      '<h5 class="modal-title ' +
      card_class +
      '">' +
      toPascalCase(status) +
      "</h5>";
    final_html += message;
    final_html += "</div>";
    final_html += "</div>";

    //message     = message.replace(/\n/g,'<br/>');
    //update viewed notification
    const param = {
      id: id,
    };
    seen_notification(param, function (data) {
      if (data["success"]) {
        $(".modal-body").html(final_html);
      } //end if
    });
    //end update viewed notification

    if (type == "job_post_for_interview") {
      $(".btn_accept_dec").removeClass("d-none");
      $(".btn_decide").removeClass("d-none");
    }

    $(".btn_accept_dec").attr("aria-id", id);
    $(".btn_accept_dec").attr("aria-type", type);

    if (status !== "pending") {
      $(".btn_accept_dec").attr("disabled", true);
    } else {
      $(".btn_accept_dec").attr("disabled", false);
    } //end if
  });

  $("#notification_modal").on("hide.bs.modal", function (e) {
    $(".modal-body").html("");
  });

  function seen_notification(param, callback) {
    var url = baseurl + "/account_management/update_viewed";
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
        callback();
      })
      .always(function (e) {});
  } //end function

  function process_invitation(param, callback) {
    var url = baseurl + "/account_management/process_invitation";
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

  //load record
  function load_record(page, type, loader, callback) {
    var url = baseurl + "/account_management/get_counter";

    $.ajax({
      url: url,
      type: "POST",
      dataType: "JSON",
      beforeSend: function () {
        $("." + loader + "").html(
          '<div class="spinner-grow text-muted"></div>'
        );
      },
    })
      .done(function (data) {
        if (data.data !== null) {
          for (var i in data.data) {
            if (data.data[i].type == "prospect") {
              $(".badge_prospect").html(data.data[i].counter);
            } //end if

            if (data.data[i].type == "active") {
              $(".badge_active").html(data.data[i].counter);
            } //end if

            if (data.data[i].type == "inactive") {
              $(".badge_inactive").html(data.data[i].counter);
            } //end if

            if (data.data[i].type == "paused") {
              $(".badge_paused").html(data.data[i].counter);
            } //end if
          } //end for
        } else {
          $("#" + container + "").empty();
          $("#" + loader + "").empty();
          $("." + pagination + "").empty();
          //$('.pagination_result').empty();

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

        //$('#loading').hide();

        callback();
      })
      .fail(function (e) {
        //$('#loading').hide();
        callback();
      })
      .always(function (e) {});
  } //end load_record

  //get notification
  function load_notification(callback) {
    var url = baseurl + "/account_management/get_notification";
    $.ajax({
      url: url,
      type: "POST",
      dataType: "JSON",
      beforeSend: function () {
        //$('.'+loader+'').html('<div class="spinner-grow text-muted"></div>');
      },
    })
      .done(function (data) {
        callback(data);
      })
      .fail(function (e) {
        //$('#loading').hide();
        callback(e);
      })
      .always(function (e) {});
  } //end load_record

  //purge data
  function auto_purge_data(callback) {
    var url = baseurl + "/account_management/auto_purge_data";

    $.ajax({
      url: url,
      type: "POST",
      dataType: "JSON",
      beforeSend: function () {
        //$('.'+loader+'').html('<div class="spinner-grow text-muted"></div>');
      },
    })
      .done(function (data) {
        callback(data);
      })
      .fail(function (e) {
        callback(e);
      })
      .always(function (e) {});
  } //end
  //end purge data

  $(document.body).on("click", ".btn_accept_dec", function (e) {
    const id = $(this).attr("aria-id");
    const type = $(this).attr("aria-type");
    const status = $(this).attr("aria-status");
    const msg_html = "Successfully completed";

    var param = {};
    param.header = {};
    param.header = {
      id: id,
      record_type: type,
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

          $(".btn_accept_dec").attr("disabled", true);
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

  $(document.body).on("click", "a[id=collapse_link] i", function (e) {
    if ($(this).hasClass("fa-chevron-down")) {
      $(this).removeClass("fa-chevron-down");
      $(this).addClass("fa-chevron-up");
    } else {
      $(this).removeClass("fa-chevron-up");
      $(this).addClass("fa-chevron-down");
    } //end if
  });
}); //document .ready
