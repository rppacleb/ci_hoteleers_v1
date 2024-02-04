$(document).ready(function () {
  if ($(window).width() >= 1441) {
    // $('.desktop-homespacer').remove();
    $(".desktop-homespacer1").css("width", "5%");
    $(".desktop-homespacer").css("width", "3.8%");
    $(".desktop-homebtn").addClass("pr-0");
    $(".home-row2div").removeClass("px-4 px-lg-5 ml-5 pl-5");
    $(".home-row2div").addClass("pl-4");
  }

  if ($(window).width() <= 1280 && $(window).width() >= 1025) {
    $(".home-jobsdivrow").removeClass("mb-4");
    $(".home-row3").removeClass("py-5");
  }

  if ($(window).width() >= 750 && $(window).width() <= 1024) {
    $(".footer-icons-class").removeClass("mr-2");
    $(".footer-icons-class").addClass("mr-3");
    $(".home-row2div").addClass("text-white");
    $(".home-row2div h5").removeClass("text-link");
  }

  if ($(window).width() <= 480) {
    $(".home-row3").removeClass("py-5");
    $(".mobile-rowmid").removeClass("py-5");
    $(".home-row2div").addClass("text-white");
    $(".home-row2div h5").removeClass("text-link");
  }

  if ($(window).width() <= 480 && $(window).width() >= 376) {
    $(".home-rowmid").css({ "background-size": "160% 100%" });
  }

  if ($(window).width() <= 375) {
    $(".home-rowmid").css({ "background-size": "190% 100%" });
  }

  var homeurl = baseurl + "/main";
  var homeurl_txt = "main";
  var urlimgdef = baseurl + "/files/images/default/image.png";
  var upload_path = baseurl + "/files/uploads/";

  load_record(
    0,
    "employer",
    "main_container",
    "main_pagination",
    "main_loader"
  );

  //event
  //http://localhost:81/hoteleers/job_search/private
  $(document.body).on(
    "click",
    "button[name=header\\[btn_find_job\\]]",
    function () {
      var search_str = $("input[name=header\\[find_job_search\\]]").val();
      var search_url =
        baseurl + "/job_search/private?search_str=" + encodeURI(search_str);
      window.location = search_url;
    }
  );

  // Search job on Enter key press
  $(document.body).on(
    "keypress",
    "input[name=header\\[find_job_search\\]]",
    function (e) {
      if (e.which == 13) {
        // Trigger the "Find Jobs" button click event.
        $("button[name=header\\[btn_find_job\\]]").click();
        return false;
      }
    }
  );

  //add favorites
  $(document.body).on("click", "button.btn_add_fav", function (e) {
    // Do nothing when the usertype is employer.
    if (usertype === "employer") {
      return;
    }

    var view_url = window.location.href;

    var id = $(this).attr("aria-id");
    var saved = $(this).attr("aria-saved");
    var btn = $(this);
    var btn_text = "";

    var type_text = "";

    var url = baseurl;
    url += "/job_search/add_fav/list";

    var frm_id = "";

    var data = {};
    data.header = {};
    data.header.id = id;

    var basic_btn = "btn-pill-hover-link btn-pill-lg text-link";
    var saved_btn = "btn-pill-hover-primary btn-pill-lg text-primary";

    var basic_logo = '<i class="fa fa-heart-o"></i>';
    var saved_logo = '<i class="fa fa-heart"></i>';

    btn_text = '<i class="fa fa-heart"></i>';

    // Partial Notification message for saving/unsaving a Job Post.
    var msg_txt = "Added to ";

    if (parseInt(saved)) {
      msg_txt = "Removed from ";
    } //end if

    // if(confirm("Are you sure you want to "+msg_txt+" this job?")){

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

          msg_html = msg_txt + msg_html;

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
    // }//end if
  }); //end if
  //end add favorites
  //end event

  //load record
  function load_record(page, type, container, pagination, loader) {
    var edit_url = homeurl + "/private/edit/";
    var view_url = baseurl + "/job_search/private/view/";
    var user_url = baseurl + "/user";
    var not_loggedin = baseurl + "/login?type=job_search&rdr_id=";

    var data = {};
    data.user_id = user_id;

    var url = baseurl + "/get/" + homeurl_txt + "/" + type;
    $.ajax({
      url: url,
      data: data,
      type: "POST",
      dataType: "JSON",
      beforeSend: function () {
        $("#trending_jobs_container").html(
          '<div class="col-2"></div><div class="col text-center"><div class="spinner-grow text-muted"></div><div class="col-2"></div></div>'
        );
        //$('#'+loader+'').html('<div class="col-2"></div><div class="col text-center"><div class="spinner-grow text-muted"></div><div class="col-2"></div></div>');
      },
    })
      .done(function (data) {
        if (data.data !== null) {
          var html = "";
          var nix = 0;
          var ctr = 1;

          $.each(data.data, function (key, value) {
            if (ctr == 1) {
              html += '<div class="carousel-item active">';
              if ($(window).width() >= 1025) {
                html +=
                  '<div class="col-xl-3 col-lg-3 col-md-6 padding-0" style="float:left;width:1.5in;"> </div>';
              }
            } //end if

            var img_src = "";
            if (value.doc_image === null || value.doc_image == "") {
              img_src = "files/images/default/image.png";
            } else {
              img_src = upload_path + value.doc_image;
            } //end if

            var active = "";
            if (key == 0) {
              active = "active";
            } //end if

            //html += '<div class="carousel-item '+active+'">';

            html +=
              '<div class="col-xl-3 col-lg-3 col-md-6 padding-0" style="float:left;min-width:2.5in;">';
            html +=
              '<div class="card mb-2 mx-1 home-trendingcard" style="min-height:4.2in;">';
            if ($(window).width() >= 1900) {
              html +=
                '<img style="height:275px; padding: 0.75rem;" class="card-img-top"';
            } else if ($(window).width() >= 1500 && $(window).width() <= 1899) {
              html +=
                '<img style="height:250px; padding: 0.75rem;" class="card-img-top"';
            } else if ($(window).width() >= 1281 && $(window).width() <= 1499) {
              html +=
                '<img style="height:250px; padding: 0.75rem;" class="card-img-top"';
            } else if ($(window).width() <= 1024) {
              html +=
                '<img style="height:300px; padding: 0.75rem;" class="card-img-top"';
            } else {
              html +=
                '<img style="height:230px; padding: 0.75rem;" class="card-img-top"';
            }
            html +=
              'src="' +
              img_src +
              '" title="' +
              value.company_name +
              '" alt="' +
              value.company_name +
              '">';
            html += '<div class="card-body">';
            if ($(window).width() <= 1280 && $(window).width() >= 1024) {
              var job_title_placeholder = value.job_title.substring(0, 17);
              var job_title_placeholder_length = value.job_title.length;

              if (job_title_placeholder_length > 17) {
                job_title_placeholder = job_title_placeholder + "...";
                html +=
                  '<a href="' +
                  view_url +
                  value.id +
                  '" style="text-decoration:none;"><h5 class="text-link" data-maintitle="' +
                  value.job_title +
                  '">' +
                  job_title_placeholder +
                  "</h5></a>";
              } else {
                html +=
                  '<a href="' +
                  view_url +
                  value.id +
                  '" style="text-decoration:none;"><h5 class="text-link">' +
                  job_title_placeholder +
                  "</h5></a>";
              }

              var company_placeholder = value.company_name.substring(0, 17);
              var company_placeholder_length = value.company_name.length;

              html += '<div class="mb-0">';
              if (company_placeholder_length > 17) {
                company_placeholder = company_placeholder + "...";
                html +=
                  '<small class="text-muted" style="font-size:9pt !important"><b data-companyname="' +
                  value.company_name +
                  '" style="font-size:15px !important">' +
                  company_placeholder +
                  "</b></small>";
              } else {
                html +=
                  '<small class="text-muted" style="font-size:9pt !important"><b>' +
                  company_placeholder +
                  "</b></small>";
              }
            } else if ($(window).width() <= 1440 && $(window).width() >= 1281) {
              var job_title_placeholder = value.job_title.substring(0, 19);
              var job_title_placeholder_length = value.job_title.length;

              if (job_title_placeholder_length > 19) {
                job_title_placeholder = job_title_placeholder + "...";
                html +=
                  '<a href="' +
                  view_url +
                  value.id +
                  '" style="text-decoration:none;"><h5 class="text-link" data-maintitle="' +
                  value.job_title +
                  '">' +
                  job_title_placeholder +
                  "</h5></a>";
              } else {
                html +=
                  '<a href="' +
                  view_url +
                  value.id +
                  '" style="text-decoration:none;"><h5 class="text-link">' +
                  job_title_placeholder +
                  "</h5></a>";
              }

              var company_placeholder = value.company_name.substring(0, 19);
              var company_placeholder_length = value.company_name.length;

              html += '<div class="mb-0">';
              if (company_placeholder_length > 19) {
                company_placeholder = company_placeholder + "...";
                html +=
                  '<small class="text-muted" style="font-size:9pt !important"><b data-companyname="' +
                  value.company_name +
                  '" style="font-size:15px !important">' +
                  company_placeholder +
                  "</b></small>";
              } else {
                html +=
                  '<small class="text-muted" style="font-size:9pt !important"><b>' +
                  company_placeholder +
                  "</b></small>";
              }
            } else if ($(window).width() <= 480) {
              var job_title_placeholder = value.job_title.substring(0, 30);
              var job_title_placeholder_length = value.job_title.length;

              if (job_title_placeholder_length > 30) {
                job_title_placeholder = job_title_placeholder + "...";
                html +=
                  '<a href="' +
                  view_url +
                  value.id +
                  '" style="text-decoration:none;"><h5 class="text-link" data-maintitle="' +
                  value.job_title +
                  '">' +
                  job_title_placeholder +
                  "</h5></a>";
              } else {
                html +=
                  '<a href="' +
                  view_url +
                  value.id +
                  '" style="text-decoration:none;"><h5 class="text-link">' +
                  job_title_placeholder +
                  "</h5></a>";
              }

              var company_placeholder = value.company_name.substring(0, 30);
              var company_placeholder_length = value.company_name.length;

              html += '<div class="mb-0">';
              if (company_placeholder_length > 30) {
                company_placeholder = company_placeholder + "...";
                html +=
                  '<small class="text-muted" style="font-size:9pt !important"><b data-companyname="' +
                  value.company_name +
                  '" style="font-size:15px !important">' +
                  company_placeholder +
                  "</b></small>";
              } else {
                html +=
                  '<small class="text-muted" style="font-size:9pt !important"><b>' +
                  company_placeholder +
                  "</b></small>";
              }
            } else {
              var job_title_placeholder = value.job_title.substring(0, 20);
              var job_title_placeholder_length = value.job_title.length;

              if (job_title_placeholder_length > 20) {
                job_title_placeholder = job_title_placeholder + "...";
                html +=
                  '<a href="' +
                  view_url +
                  value.id +
                  '" style="text-decoration:none;"><h5 class="text-link" data-maintitle="' +
                  value.job_title +
                  '">' +
                  job_title_placeholder +
                  "</h5></a>";
              } else {
                html +=
                  '<a href="' +
                  view_url +
                  value.id +
                  '" style="text-decoration:none;"><h5 class="text-link">' +
                  job_title_placeholder +
                  "</h5></a>";
              }

              var company_placeholder = value.company_name.substring(0, 20);
              var company_placeholder_length = value.company_name.length;

              html += '<div class="mb-0">';
              if (company_placeholder_length > 20) {
                company_placeholder = company_placeholder + "...";
                html +=
                  '<small class="text-muted" style="font-size:9pt !important"><b data-companyname="' +
                  value.company_name +
                  '" style="font-size:15px !important">' +
                  company_placeholder +
                  "</b></small>";
              } else {
                html +=
                  '<small class="text-muted" style="font-size:9pt !important"><b>' +
                  company_placeholder +
                  "</b></small>";
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
              //html += '<button '+btn_attr+' class="btn btn-pill-sm btn-pill-outline-link text-link btn_add_fav" aria-id="'+value.id+'"><i class="fa fa-heart"></i></button>';
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

            /*
                        html += ' <div class="row">';
                            html += '<div class="col-md-4 mb-3">';
                                html += '<div class="card card-body">';
                                    html += '<img class="card-img-top" src="'+img_src+'">';

                                    html += '<div class="row">';
                                        html += '<div class="col">';
                                            html += '<h6 class="text-link">'+value.job_title+'</h6>';

                                            html += '<div class="row mb-2>';
                                                html += '<div class="col">';
                                                    html += '<small class="text-muted" style="font-size:7pt !important"><b>'+value.company_name+'</b></small>';
                                                html += '</div>';
                                            html += '</div>';

                                            html += '<div class="row mb-1>';
                                                html += '<div class="col">';
                                                    html += '<small class="text-muted" style="font-size:7pt !important"><b>'+value.location_placeholder+'</b></small>';
                                                html += '</div>';
                                            html += '</div>';

                                            html += '<div class="row mb-1">';
                                                
                                                html += '<div class="col">';
                                                    html += '<div>';
                                                        html += '<small class="text-muted text-left" style="font-size:7pt !important">Apply Before</small>';
                                                    html += '</div>';
                                                    html += '<div>';
                                                        html += '<small class="text-muted text-left" style="font-size:7pt !important"><b>'+value.job_expiration_date+'</b></small>';
                                                    html += '</div>';
                                                html += '</div>';
                                            html += '</div>';

                                            html += '<div class="row mb-1">';
                                                html += '<div class="col">';
                                                    html += '<div>';
                                                        html += '<small class="text-muted text-left" style="font-size:7pt !important"><b>'+value.job_type_text+'</b></small>';
                                                    html += '</div>';
                                                html += '</div>';
                                            html += '</div>';

                                            html += '<div class="row mb-2">';
                                                html += '<div class="col">';
                                                    if((user_id) !== 0){
                                                        var btn_attr = "";

                                                        if(parseInt(value.saved)){
                                                            btn_attr = "disabled";
                                                        }//end if

                                                        html += '<button '+btn_attr+' class="btn btn-pill-sm btn-pill-outline-link text-link btn_add_fav" aria-id="'+value.id+'"><i class="fa fa-heart"></i></button>';
                                                    }//end if
                                                html += '</div>';

                                                html += '<div class="col">';
                                                    html += '<div class="text-right">';

                                                        //alert(user_id)
                                                            
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
            //html += '</div>';

            if ($(window).width() <= 480) {
              if (ctr % 1 == 0) {
                html += "</div>";
                if (ctr !== data.data.length) {
                  html += '<div class="carousel-item">';
                } //end if
              } //end if
            } else if ($(window).width() >= 481 && $(window).width() <= 1024) {
              if (ctr % 2 == 0) {
                html += "</div>";
                if (ctr !== data.data.length) {
                  html += '<div class="carousel-item">';
                } //end if
              } //end if
            } else {
              if (ctr % 3 == 0) {
                html += "</div>";
                if (ctr !== data.data.length) {
                  html += '<div class="carousel-item">';
                  if ($(window).width() >= 1025) {
                    html +=
                      '<div class="col-xl-3 col-lg-3 col-md-6 padding-0" style="float:left;width:1.5in;"> </div>';
                  }
                } //end if
              } //end if
            }

            if (ctr == data.data.length) {
              //html += '</div>';
            } //end if

            ctr += 1;
          });

          //html += '</div>';

          $("#trending_jobs_container").html(html);

          //reload carousel
          /*
                $('.carousel').carousel();
                $('#recipeCarousel').carousel({
                  interval: 10000
                })

                $('.carousel .carousel-item').each(function(){
                    var minPerSlide = 3;
                    var next = $(this).next();
                    if (!next.length) {
                    next = $(this).siblings(':first');
                    }
                    next.children(':first-child').clone().appendTo($(this));
                    
                    for (var i=0;i<minPerSlide;i++) {
                        next=next.next();
                        if (!next.length) {
                            next = $(this).siblings(':first');
                        }
                        
                        next.children(':first-child').clone().appendTo($(this));
                      }
                });
                */
          //end reload carousel
        } else {
          $("#trending_jobs_container").empty();
        } //end if

        $("#loading").hide();
      })
      .fail(function (e) {
        alert(e.responseText);
        $("#loading").hide();
      })
      .always(function (e) {});
  } //end load_record
}); //End document.ready
