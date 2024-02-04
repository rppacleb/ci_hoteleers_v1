//google map section
//--------------------------------------------------------------------------------------------------------------------------
var purple_icon = "http://maps.google.com/mapfiles/ms/icons/purple-dot.png";
var red_icon = "http://maps.google.com/mapfiles/ms/icons/red-dot.png";

//View
var infowindow2;
var infowindowContent2;
var map2;
var marker2;

//Add and Edit
var infowindow;
var infowindowContent;
var map;
var marker;

function initMap() {
  var frm = "#frm_partner_application_edit";
  //view mode
  //-----------------------------------------------------------------------------------
  /*
      //Infowindow
      infowindow2 = new google.maps.InfoWindow();
      infowindowContent2 = document.getElementById("infowindow2-content");
      infowindow2.setContent(infowindowContent2);


      map2 = new google.maps.Map(document.getElementById("map2"), {
        //center: { lat: 40.749933, lng: -73.98633 },
        //center: { lat: 14.5995124, lng: 120.9842195 },
        zoom: 13,
        mapTypeControl: false,
      });

      marker2 = new google.maps.Marker({
        //position: new google.maps.LatLng(14.554729, 121.024445),
        map: map2,
        animation: google.maps.Animation.DROP,
        //icon : red_icon     
      });
      */
  //-----------------------------------------------------------------------------------
  //end view mode

  //map.fitBounds(place.geometry.viewport);

  //marker2.setVisible(false);

  //marker2.setVisible(true);

  map = new google.maps.Map(document.getElementById("map"), {
    //center: { lat: 40.749933, lng: -73.98633 },
    center: { lat: 14.5995124, lng: 120.9842195 },
    zoom: 13,
    mapTypeControl: false,
  });

  const input = document.getElementById("search_location");
  const options = {
    fields: ["address_components", "formatted_address", "geometry", "name"],

    strictBounds: false,
  };
  const autocomplete = new google.maps.places.Autocomplete(input, options);
  autocomplete.bindTo("bounds", map);

  //Infowindow
  infowindow = new google.maps.InfoWindow();
  infowindowContent = document.getElementById("infowindow-content");
  infowindow.setContent(infowindowContent);

  marker = new google.maps.Marker({
    map,
    animation: google.maps.Animation.DROP,
    anchorPoint: new google.maps.Point(0, -29),
  });

  //add click event listener to map

  google.maps.event.addListener(map, "click", function (e) {
    var lat = e.latLng.lat(); // lat of clicked point
    var lng = e.latLng.lng(); // lng of clicked point

    //geocoder - convert lat and lng to address
    var geocoder = new google.maps.Geocoder();
    geocoder
      .geocode({
        location: e.latLng,
      })
      .then((response) => {
        if (response.results[0]) {
          marker.setPosition(e.latLng);

          var locality = "";
          var administrative_area_level_1 = "";
          var country = "";

          for (var key in response.results[0].address_components) {
            var place_bd = response.results[0].address_components[key];

            //for(var key2 in place_bd){
            var place_bd_types = place_bd.types;
            for (var key3 in place_bd_types) {
              if (place_bd_types[key3] == "locality") {
                locality = place_bd.long_name;
                break;
              } //end if

              if (place_bd_types[key3] == "administrative_area_level_1") {
                administrative_area_level_1 = place_bd.long_name;
                break;
              } //end if

              if (place_bd_types[key3] == "country") {
                country = place_bd.long_name;
                break;
              } //end if
            } //end for
            //}//end for
          } //end for

          //set value of field
          //$('#editForm input[name=latitude]').val(lat);
          //$('#editForm input[name=longitude]').val(lng);
          //$('#editForm textarea[name=event_address]').val(response.results[0].formatted_address);
          $(frm + " textarea[name=header\\[location\\]]").val(
            response.results[0].formatted_address
          );
          $(frm + " input[name=header\\[locality\\]]").val(locality);
          $(frm + " input[name=header\\[administrative_area_level_1\\]]").val(
            administrative_area_level_1
          );
          $(frm + " input[name=header\\[country\\]]").val(country);
          //end set value of field

          infowindowContent.children["place-address"].textContent =
            response.results[0].formatted_address;
          infowindow.open(map, marker);
        } else {
          window.alert("No results found");
        } //end if
      })
      .catch((e) => window.alert("Geocoder failed due to: " + e));
    //end geocoder - convert lat and lng to address
  });

  //end add click event listener to map

  //end add place_changed event listener to map
  autocomplete.addListener("place_changed", () => {
    infowindow.close();
    marker.setVisible(false);

    const place = autocomplete.getPlace();

    console.log(JSON.stringify(place));
    if (!place.geometry || !place.geometry.location) {
      // User entered the name of a Place that was not suggested and
      // pressed the Enter key, or the Place Details request failed.
      window.alert("No details available for input: '" + place.name + "'");
      return;
    }

    //If the place has a geometry, then present it on a map.
    if (place.geometry.viewport) {
      map.fitBounds(place.geometry.viewport);
    } else {
      map.setCenter(place.geometry.location);
      map.setZoom(17);
    }

    marker.setPosition(place.geometry.location);
    marker.setVisible(true);

    var locality = "";
    var administrative_area_level_1 = "";
    var country = "";

    for (var key in place.address_components) {
      var place_bd = place.address_components[key];

      //for(var key2 in place_bd){
      var place_bd_types = place_bd.types;
      for (var key3 in place_bd_types) {
        if (place_bd_types[key3] == "locality") {
          locality = place_bd.long_name;
          break;
        } //end if

        if (place_bd_types[key3] == "administrative_area_level_1") {
          administrative_area_level_1 = place_bd.long_name;
          break;
        } //end if

        if (place_bd_types[key3] == "country") {
          country = place_bd.long_name;
          break;
        } //end if
      } //end for
      //}//end for
    } //end for

    //set value of field
    //$('#editForm input[name=latitude]').val(place.geometry['location'].lat());
    //$('#editForm input[name=longitude]').val(place.geometry['location'].lng());
    $(frm + " textarea[name=header\\[location\\]]").val(
      place.formatted_address
    );
    $(frm + " input[name=header\\[locality\\]]").val(locality);
    $(frm + " input[name=header\\[administrative_area_level_1\\]]").val(
      administrative_area_level_1
    );
    $(frm + " input[name=header\\[country\\]]").val(country);
    //end set value of field

    infowindowContent.children["place-name"].textContent = place.name;
    infowindowContent.children["place-address"].textContent =
      place.formatted_address;
    infowindow.open(map, marker);
  });
  //end add place_changed event listener to map
} //end init map
//--------------------------------------------------------------------------------------------------------------------------
//end google map section

$(document).ready(function () {
  var homeurl = baseurl + "/applicant_application";
  load_record(0, "signup", "main_container", "main_pagination", "main_loader");

  //load record
  function load_record(page, type, container, pagination, loader) {
    var view_url = homeurl + "/view/";

    var data = {};
    data.page = page;
    data.status = $("select[name=header\\[sort\\]]").val();
    data.keyword = $("input[name=header\\[keyword\\]]").val();

    var url = baseurl + "/get/applicant_application/" + type;
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
        //alert(JSON.stringify(data.request));

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

            html += '<div class="row mb-2">';
            html += '<div class="col">';
            html += '<div class="card">';
            html += '<div class="card-body">';
            html += '<div class="row">';
            html += '<div class="col">';
            html += value.application_date;
            html += "</div><!--./col-->";
            html += '<div class="col">';
            html += value.username;
            html += "</div><!--./col-->";

            html += '<div class="col">';
            html += '<div class="outside_button btn-group btn-group-toggle">';
            var approved = "";
            var declined = "";
            if (value.status.toLowerCase() == "approved") {
              approved = "disabled";
            } //end if
            if (value.status.toLowerCase() == "declined") {
              declined = "disabled";
            } //end if

            html +=
              '<a href="' +
              view_url +
              value.id +
              '" class="btn btn-pill-sm btn-pill-outline-link text-link btn_view">View</a>';
            if (declined == "") {
              html +=
                '<button aria-id="' +
                value.id +
                '" aria-type="2" aria-username="' +
                value.username +
                '" class="' +
                approved +
                ' btn btn-pill-sm btn-pill-outline-link text-link btn_submit">Approve</button>';
            } //end if
            if (approved == "") {
              html +=
                '<button aria-id="' +
                value.id +
                '" aria-type="3" aria-username="' +
                value.username +
                '" class="' +
                declined +
                ' btn btn-pill-sm btn-pill-outline-primary text-primary btn_submit">Decline</button>';
            } //end if
            html += "</div>";
            html += "</div><!--./col-->";
            html += "</div><!--./row-->";
            html += "</div><!--./card-body-->";
            html += "</div><!--./card-->";
            html += "</div><!--./col-->";

            html += "</div><!--./row-->";

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
      })
      .fail(function (e) {
        alert(e.responseText);
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
      "signup",
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
      "signup",
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
      "signup",
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
    url += "/submit_data";

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
            $(".outside_button *").css("pointer-events", "auto");
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
  //=====================================================================================================================
  //end events
}); //End document.ready
