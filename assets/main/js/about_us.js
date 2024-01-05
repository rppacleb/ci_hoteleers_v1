$(document).ready(function () {
  var homeurl = baseurl + "/about_us";
  var homeurl_txt = "about_us";
  var urlimgdef = "https://dummyimage.com/76x76/dee2e6/6c757d.jpg";
  var upload_path = baseurl + "/files/uploads/";

  //load_record(0,'employer','main_container','main_pagination','main_loader');

  if ($(window).width() <= 480) {
    $(".au-spacer").removeClass("col-3");
    $(".au-spacer").addClass("col-1");
  }

  $("#loading").hide();

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
            } //end if

            var img_src = "";
            if (value.doc_image === null || value.doc_image == "") {
              img_src = "https://dummyimage.com/450x300/dee2e6/6c757d.jpg";
            } else {
              img_src = upload_path + value.doc_image;
            } //end if

            var active = "";
            if (key == 0) {
              active = "active";
            } //end if

            //html += '<div class="carousel-item '+active+'">';

            html += '<div class="col-3" style="float:left;">';
            html += '<div class="card mb-2" style="min-height:4.2in;">';
            html += '<img style="height:1.5in;" class="card-img-top"';
            html += 'src="' + img_src + '" alt="Card image cap">';
            html += '<div class="card-body">';
            html +=
              '<a href="' +
              view_url +
              value.id +
              '" style="text-decoration:none;"><h5 class="text-link">' +
              value.job_title +
              "</h5></a>";

            html += '<div class="mb-0">';
            html +=
              '<small class="text-muted" style="font-size:9pt !important"><b>' +
              value.company_name +
              "</b></small>";
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
            html += '<div class="col ">';
            var btn_attr = "btn-pill-outline-link text-link";
            if (parseInt(value.saved)) {
              btn_attr = "btn-primary";
            } //end if

            if (user_id !== 0) {
              html +=
                '<button class="mr-3 btn btn-pill-sm ' +
                btn_attr +
                ' btn_add_fav" aria-saved="' +
                parseInt(value.saved) +
                '" aria-id="' +
                value.id +
                '"><i class="fa fa-heart"></i></button>';
              //html += '<button '+btn_attr+' class="btn btn-pill-sm btn-pill-outline-link text-link btn_add_fav" aria-id="'+value.id+'"><i class="fa fa-heart"></i></button>';
            } else {
              html +=
                '<a href="' +
                not_loggedin +
                value.id +
                '" class="mr-3 btn btn-pill-sm ' +
                btn_attr +
                '" aria-saved="' +
                parseInt(value.saved) +
                '" aria-id="' +
                value.id +
                '"><i class="fa fa-heart"></i></a>';
            } //end if

            html += "</div>";

            html += '<div class="col">';
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

            if (ctr % 4 == 0) {
              html += "</div>";
              if (ctr !== data.data.length) {
                html += '<div class="carousel-item">';
              } //end if
            } //end if

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
