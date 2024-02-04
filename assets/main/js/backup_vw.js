$(document).ready(function () {
  function backup_db() {
    var homeurl = baseurl + "/backup_vw";
    var url = baseurl + "/backup_vw/backup_db";
    $.ajax({
      url: url,
      type: "GET",
      dataType: "JSON",
      beforeSend: function () {
        $("button[name=btn_backup]").text("Processing...");
        $("button[name=btn_backup]").attr("disabled", "disabled");
      },
    })
      .done(function (data) {
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
            position: "right bottom",
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
            position: "right bottom",
            className: "error",
            arrowShow: true,
          });

          $("button[name=btn_backup]").text("Create Backup");
          $("button[name=btn_backup]").removeAttr("disabled");
        }
      })
      .fail(function (e) {
        $.notify(e.responseText, {
          position: "right bottom",
          style: "happyblue",
          className: "error",
        });
      })
      .always(function (e) {});
  } //End LoadDT();

  function restore_db(name, btn) {
    var homeurl = baseurl + "/backup_vw";
    var url = baseurl + "/backup_vw/restore_db/?name=" + name;
    $.ajax({
      url: url,
      type: "GET",
      dataType: "JSON",
      beforeSend: function () {
        btn.text("Processing...");
        btn.attr("disabled", "disabled");
      },
    })
      .done(function (data) {
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
            position: "right bottom",
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
            position: "right bottom",
            className: "error",
            arrowShow: true,
          });

          btn.text("Restore");
          btn.removeAttr("disabled");
        }
      })
      .fail(function (e) {
        $.notify(e.responseText, {
          position: "right bottom",
          style: "happyblue",
          className: "error",
        });
      })
      .always(function (e) {});
  } //End LoadDT();

  $(document.body).on("click", "button[name=btn_backup]", function () {
    backup_db();
  });

  $(document.body).on("click", ".btn_restore", function () {
    var name = $(this).attr("aria-name");
    //alert(name);
    restore_db(name, $(this));
  });
}); //End document.ready
