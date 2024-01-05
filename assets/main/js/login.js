$(document).ready(function () {
  $("#loading").hide();

  $(document.body).on("click", "button[name=btn_login]", function (e) {
    //jquery
    //$('#list').append('<li>Water</li>');

    //
    //javascript
    //const node = document.createElement("li");
    //const textnode = document.createTextNode("Water");
    //node.appendChild(textnode);

    //document.getElementById('list').appendChild(node);

    //const node = document.createElement("li");
    //const textnode = document.createTextNode("Water");
    //node.appendChild(textnode);
    //document.getElementById('list').appendChild(node);

    //alert(document.getElementById('username').value);

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

          if (data.user_type == "employer") {
            //homeurl = baseurl + '/active_jobs';
          } else if (data.user_type == "admin") {
            homeurl = baseurl + "/account_management";
          } else {
            if (redirect_type !== "") {
              homeurl =
                baseurl + "/" + redirect_type + "/private/view/" + redirect_id;
            } //end if
          } //end if//end if

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
        $("button[name=btn_login]").text("Login");
        $("button[name=btn_login]").removeAttr("disabled");
        $.notify(e.responseText, {
          position: "top bottom",
          className: "error",
          arrowShow: true,
        });
      })
      .always(function (e) {});
  });

  //events
  $(document.body).on("click", "#frm_login #btn_show_pass", function (e) {
    var x = $("#frm_login input[name=header\\[password\\]]");
    if (x.attr("type") === "password") {
      x.prop("type", "text");
      $(this).find(".input-group-text").html('<i class="fa fa-eye-slash"></i>');
    } else {
      x.prop("type", "password");
      $(this).find(".input-group-text").html('<i class="fa fa-eye"></i>');
    }
  });

  // Login on Enter key press.
  $(document.body).on(
    "keypress",
    "input[name=header\\[username\\]], input[name=header\\[password\\]]",
    function (e) {
      if (e.which == 13) {
        $("button[name=btn_login]").click();
        return false;
      }
    }
  );

  //end events
}); //End document.ready
