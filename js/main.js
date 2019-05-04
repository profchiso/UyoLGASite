jQuery(document).ready(function( $ ) {

      // Back to top button
      $(window).scroll(function () {
            if ($(this).scrollTop() > 100) {
                  $('.back-to-top').fadeIn('slow');
            } else {
                  $('.back-to-top').fadeOut('slow');
            }
      });
      $('.back-to-top').click(function () {
            $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
            return false;
      });

      // Initiate the wowjs animation library
      new WOW().init();

      // Initiate superfish on nav menu
      $('.nav-menu').superfish({
            animation: {
                  opacity: 'show'
            },
            speed: 400
      });

      // Mobile Navigation
      if ($('#nav-menu-container').length) {
            var $mobile_nav = $('#nav-menu-container').clone().prop({
                  id: 'mobile-nav'
            });
            $mobile_nav.find('> ul').attr({
                  'class': '',
                  'id': ''
            });
            $('body').append($mobile_nav);
            $('body').prepend('<button type="button" id="mobile-nav-toggle"><i class="fa fa-bars"></i></button>');
            $('body').append('<div id="mobile-body-overly"></div>');
            $('#mobile-nav').find('.menu-has-children').prepend('<i class="fa fa-chevron-down"></i>');

            $(document).on('click', '.menu-has-children i', function (e) {
                  $(this).next().toggleClass('menu-item-active');
                  $(this).nextAll('ul').eq(0).slideToggle();
                  $(this).toggleClass("fa-chevron-up fa-chevron-down");
            });

            $(document).on('click', '#mobile-nav-toggle', function (e) {
                  $('body').toggleClass('mobile-nav-active');
                  $('#mobile-nav-toggle i').toggleClass('fa-times fa-bars');
                  $('#mobile-body-overly').toggle();
            });

            $(document).click(function (e) {
                  var container = $("#mobile-nav, #mobile-nav-toggle");
                  if (!container.is(e.target) && container.has(e.target).length === 0) {
                        if ($('body').hasClass('mobile-nav-active')) {
                              $('body').removeClass('mobile-nav-active');
                              $('#mobile-nav-toggle i').toggleClass('fa-times fa-bars');
                              $('#mobile-body-overly').fadeOut();
                        }
                  }
            });
      } else if ($("#mobile-nav, #mobile-nav-toggle").length) {
            $("#mobile-nav, #mobile-nav-toggle").hide();
      }

      // Smooth scroll for the menu and links with .scrollto classes
      $('.nav-menu a, #mobile-nav a, .scrollto').on('click', function () {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
                  var target = $(this.hash);
                  if (target.length) {
                        var top_space = 0;

                        if ($('#header').length) {
                              top_space = $('#header').outerHeight();

                              if (!$('#header').hasClass('header-fixed')) {
                                    top_space = top_space - 20;
                              }
                        }

                        $('html, body').animate({
                              scrollTop: target.offset().top - top_space
                        }, 1500, 'easeInOutExpo');

                        if ($(this).parents('.nav-menu').length) {
                              $('.nav-menu .menu-active').removeClass('menu-active');
                              $(this).closest('li').addClass('menu-active');
                        }

                        if ($('body').hasClass('mobile-nav-active')) {
                              $('body').removeClass('mobile-nav-active');
                              $('#mobile-nav-toggle i').toggleClass('fa-times fa-bars');
                              $('#mobile-body-overly').fadeOut();
                        }
                        return false;
                  }
            }
      });

      // Header scroll class
      $(window).scroll(function () {
            if ($(this).scrollTop() > 100) {
                  $('#header').addClass('header-scrolled');
            } else {
                  $('#header').removeClass('header-scrolled');
            }
      });

      // Intro carousel
      var introCarousel = $(".carousel");
      var introCarouselIndicators = $(".carousel-indicators");
      introCarousel.find(".carousel-inner").children(".carousel-item").each(function (index) {
            (index === 0) ?
                  introCarouselIndicators.append("<li data-target='#introCarousel' data-slide-to='" + index + "' class='active'></li>") :
                  introCarouselIndicators.append("<li data-target='#introCarousel' data-slide-to='" + index + "'></li>");

            $(this).css("background-image", "url('" + $(this).children('.carousel-background').children('img').attr('src') + "')");
            $(this).children('.carousel-background').remove();
      });

      $(".carousel").swipe({
            swipe: function (event, direction, distance, duration, fingerCount, fingerData) {
                  if (direction == 'left') $(this).carousel('next');
                  if (direction == 'right') $(this).carousel('prev');
            },
            allowPageScroll: "vertical"
      });

      // Skills section
      $('#skills').waypoint(function () {
            $('.progress .progress-bar').each(function () {
                  $(this).css("width", $(this).attr("aria-valuenow") + '%');
            });
      }, {offset: '80%'});

      // jQuery counterUp (used in Facts section)
      $('[data-toggle="counter-up"]').counterUp({
            delay: 10,
            time: 1000
      });

      // Porfolio isotope and filter
      var portfolioIsotope = $('.portfolio-container').isotope({
            itemSelector: '.portfolio-item',
            layoutMode: 'fitRows'
      });

      $('#portfolio-flters li').on('click', function () {
            $("#portfolio-flters li").removeClass('filter-active');
            $(this).addClass('filter-active');

            portfolioIsotope.isotope({filter: $(this).data('filter')});
      });

      // Clients carousel (uses the Owl Carousel library)
      $(".clients-carousel").owlCarousel({
            autoplay: true,
            dots: true,
            loop: true,
            responsive: {
                  0: {items: 2}, 768: {items: 4}, 900: {items: 6}
            }
      });

      // Testimonials carousel (uses the Owl Carousel library)
      $(".testimonials-carousel").owlCarousel({
            autoplay: true,
            dots: true,
            loop: true,
            items: 1
      });


      /***
       *
       * @ code segment for  Passport photo upload using JCropit
       *
       ***/
      var add_image_src = "";
      var photo_image_first_time = true;
      if ($('[name="member_image_uploaded"]')[0] && $('[name="member_image_uploaded"]').val() != "") {
            add_image_src = $('[name="member_image_uploaded"]').val();
      }
      var member_file_change = false;
      if($('#member_image_editor')[0]) {
            $('#member_image_editor').cropit({
                  imageState: {
                        src: add_image_src
                  },
                  minZoom: 'fit',
                  maxZoom: 3,
                  smallImage: "allow",
                  height: 240,
                  width: 230,

                  onFileChange: function () {
                        $('#member_image_editor.image-editor').find(".cropit-image-zoom-input").show();
                        $('#member_image_editor.image-editor').find(".cropit-preview").show();
                        $('#member_image_editor.image-editor').find(".image-size-label").show();
                        $('#member_image_editor.image-editor').find(".controls-wrapper").show();
                        member_file_change = true;
                  },
                  onImageLoaded: function () {
                        photo_image_first_time = false;
                        var byteLength = parseInt((  $('#member_image_editor.image-editor').find(".cropit-preview-image").attr("src")).replace(/=/g, "").length * 0.75);
                        if (byteLength > 4000000) {
                              bootbox.alert('Your image is too big, please select an image that is 4mb or less');
                              $('#member_image_editor.image-editor').find(".cropit-preview").removeClass("cropit-image-loaded");
                              $("input[name='member_image_uploaded']").val("");
                              $('#member_image_editor.image-editor').find(".cropit-image-zoom-input").show();
                              $('#member_image_editor.image-editor').find(".cropit-preview").hide();
                              $('#member_image_editor.image-editor').find(".image-size-label").hide();
                              $('#member_image_editor.image-editor').find(".controls-wrapper").hide();
                        } else {
                              $('#member_image_editor.image-editor').find(".cropit-image-zoom-input").show();
                              $('#member_image_editor.image-editor').find(".cropit-preview").show();
                              $('#member_image_editor.image-editor').find(".image-size-label").show();
                              $('#member_image_editor.image-editor').find(".controls-wrapper").show();
                              $('#member_image_editor.image-editor').find(".cropit-preview").addClass("cropit-image-loaded");
                        }
                  },
                  onImageError: function () {
                        if (photo_image_first_time) {
                              bootbox.alert('An error occurred loading your image\n\nYour image may have been deleted or is invalid\n\nTo avoid seeing this message please upload a valid image!');
                              photo_image_first_time = false;
                        } else {
                              bootbox.alert('An error occurred loading your image\n\nplease select a jpg, png or gif image that is not smaller/larger than 230 X 240');
                        }
                        member_file_change = false;
                        $("input[name='member_image_uploaded']").val("");
                        $('#member_image_editor.image-editor').find(".cropit-image-zoom-input").show();
                        $('#member_image_editor.image-editor').find(".cropit-preview").hide();
                        $('#member_image_editor.image-editor').find(".image-size-label").hide();
                        $('#member_image_editor.image-editor').find(".controls-wrapper").hide();
                  },
                  onFileReaderError: function () {
                        member_file_change = false;
                        bootbox.alert('An error occurred loading your image\n\nplease select a jpg, png or gif image');
                        $("input[name='member_image_uploaded']").val("");
                        $('#member_image_editor.image-editor').find(".cropit-image-zoom-input").show();
                        $('#member_image_editor.image-editor').find(".cropit-preview").hide();
                        $('#member_image_editor.image-editor').find(".image-size-label").hide();
                        $('#member_image_editor.image-editor').find(".controls-wrapper").hide();
                  }
            });
            $("#upload_member_photo").off('click').on('click', function (e) {
                  e.preventDefault();
                  $("#member_upload_modal").modal('show');
            });

            $("#member_continue_upload").off('click').on('click', function (e) {
                  e.preventDefault();
                  if ($("#member_image_editor .cropit-preview").hasClass("cropit-image-loaded")) {
                        var imageData = $('#member_image_editor.image-editor').cropit('export', {
                              type: 'image/jpg',
                              quality: 1.0
                        });
                  }
                  $("#member_thumbnail img").attr("src", imageData);
            });
            if ($("input[name='member_image_uploaded']").val() != "") {
                  member_file_change = true;
                  $("#member_thumbnail img").attr("src", $("input[name='member_image_uploaded']").val());
            } else if ($("input[name='member_image_http']").val() != "") {
                  member_file_change = true;
                  $("#member_thumbnail img").attr("src", $("input[name='member_image_http']").val());
            }

            $("#lga_cert_request_form").on("submit", function () {
                  if ($("#member_image_editor .cropit-preview").hasClass("cropit-image-loaded") && member_file_change) {
                        var imageData = $('#member_image_editor.image-editor').cropit('export', {
                              type: 'image/jpg',
                              quality: 1.0,
                              originalSize: true
                        });
                        $("#member_image_uploaded").val(imageData);
                  }
            });
      }
      /*** End  ****/

      /***
       *
       * @ code segment for  Passport photo upload using JCropit
       *
       ***/
      var add_image_src = "";
      var photo_image_first_time = true;
      if ($('[name="member_image_uploaded"]')[0] && $('[name="member_image_uploaded"]').val() != "") {
            add_image_src = $('[name="member_image_uploaded"]').val();
      }
      var member_file_change = false;
      if($('#payment_teller_image_editor')[0]) {
            $('#payment_teller_image_editor').cropit({
                  imageState: {
                        src: add_image_src
                  },
                  minZoom: 'fit',
                  maxZoom: 3,
                  smallImage: "allow",
                  height: 230,
                  width: 300,
                  allowDragNDrop:true,
                  onFileChange: function () {
                        $('#payment_teller_image_editor.image-editor').find(".cropit-image-zoom-input").show();
                        $('#payment_teller_image_editor.image-editor').find(".cropit-preview").show();
                        $('#payment_teller_image_editor.image-editor').find(".image-size-label").show();
                        $('#payment_teller_image_editor.image-editor').find(".controls-wrapper").show();
                        member_file_change = true;
                  },
                  onImageLoaded: function () {
                        photo_image_first_time = false;


                        $('#payment_teller_image_editor.image-editor').find(".cropit-image-zoom-input").show();
                        photo_image_first_time = false;
                        var image_dim=$('#payment_teller_image_editor.image-editor').cropit('imageSize');
                        console.log(image_dim);
                        $('#payment_teller_image_editor').cropit('previewSize', { width: image_dim.width, height: image_dim.height});
                        $('#payment_teller_upload_modal .modal-dialog').css({'width':(image_dim.width+100)+'px','max-width':+(image_dim.width+100)+'px'});

                        var byteLength = parseInt((  $('#payment_teller_image_editor.image-editor').find(".cropit-preview-image").attr("src")).replace(/=/g, "").length * 0.75);
                        if (byteLength > 7000000) {
                              bootbox.alert('Your image is too big, please select an image that is 7mb or less');
                              $('#payment_teller_image_editor.image-editor').find(".cropit-preview").removeClass("cropit-image-loaded");
                              $("input[name='payment_teller_image_uploaded']").val("");
                              $('#payment_teller_image_editor.image-editor').find(".cropit-image-zoom-input").show();
                              $('#payment_teller_image_editor.image-editor').find(".cropit-preview").hide();
                              $('#payment_teller_image_editor.image-editor').find(".image-size-label").hide();
                              $('#payment_teller_image_editor.image-editor').find(".controls-wrapper").hide();
                        } else {
                              $('#payment_teller_image_editor.image-editor').find(".cropit-image-zoom-input").show();
                              $('#payment_teller_image_editor.image-editor').find(".cropit-preview").show();
                              $('#payment_teller_image_editor.image-editor').find(".image-size-label").show();
                              $('#payment_teller_image_editor.image-editor').find(".controls-wrapper").show();
                              $('#payment_teller_image_editor.image-editor').find(".cropit-preview").addClass("cropit-image-loaded");
                        }
                  },
                  onImageError: function () {
                        if (photo_image_first_time) {
                              bootbox.alert('An error occurred loading your image\n\nYour image may have been deleted or is invalid\n\nTo avoid seeing this message please upload a valid image!');
                              photo_image_first_time = false;
                        } else {
                              bootbox.alert('An error occurred loading your image\n\nplease select a jpg, png or gif image that is not smaller/larger than 230 X 240');
                        }
                        member_file_change = false;
                        $("input[name='payment_teller_image_uploaded']").val("");
                        $('#payment_teller_image_editor.image-editor').find(".cropit-image-zoom-input").show();
                        $('#payment_teller_image_editor.image-editor').find(".cropit-preview").hide();
                        $('#payment_teller_image_editor.image-editor').find(".image-size-label").hide();
                        $('#payment_teller_image_editor.image-editor').find(".controls-wrapper").hide();
                  },
                  onFileReaderError: function () {
                        member_file_change = false;
                        bootbox.alert('An error occurred loading your image\n\nplease select a jpg, png or gif image');
                        $("input[name='payment_teller_image_uploaded']").val("");
                        $('#payment_teller_image_editor.image-editor').find(".cropit-image-zoom-input").show();
                        $('#payment_teller_image_editor.image-editor').find(".cropit-preview").hide();
                        $('#payment_teller_image_editor.image-editor').find(".image-size-label").hide();
                        $('#payment_teller_image_editor.image-editor').find(".controls-wrapper").hide();
                  }
            });
            $("#upload_payment_teller").off('click').on('click', function (e) {
                  e.preventDefault();
                  $("#payment_teller_upload_modal").modal('show');
            });

            // Handle rotation
            $('.rotate-cw-btn').click(function() {
                  $('#payment_teller_image_editor.image-editor').cropit('rotateCW');
            });
            $('.rotate-ccw-btn').click(function() {
                  $('#payment_teller_image_editor.image-editor').cropit('rotateCCW');
            });

            $("#payment_teller_continue_upload").off('click').on('click', function (e) {
                  e.preventDefault();
                  if ($("#payment_teller_image_editor .cropit-preview").hasClass("cropit-image-loaded")) {
                        var imageData = $('#payment_teller_image_editor.image-editor').cropit('export', {
                              type: 'image/jpg',
                              quality: 1.0
                        });
                  }
                  $("#payment_teller_thumbnail img").attr("src", imageData);
            });
            if ($("input[name='payment_teller_image_uploaded']").val() != "") {
                  member_file_change = true;
                  $("#payment_teller_thumbnail img").attr("src", $("input[name='payment_teller_image_uploaded']").val());
            }

            $("#payment_teller_upload_form").on("submit", function () {
                  if ($("#payment_teller_image_editor .cropit-preview").hasClass("cropit-image-loaded") && member_file_change) {
                        var imageData = $('#payment_teller_image_editor.image-editor').cropit('export', {
                              type: 'image/jpg',
                              quality: 1.0,
                              originalSize: true
                        });
                        $("#payment_teller_image_uploaded").val(imageData);
                  }
            });
      }
      /*** End  ****/

      /**** Process Online Pyment Option  ****/
      $('#pay_online').on('click', function () {
            $('.checkout_page').addClass('normal_width_modal');
            $('.payment_form').submit(false);
            var form_data = $('.payment_form').serializeArray();
            var data = {}
            if (typeof form_data === "object" && typeof form_data !== "undefined") {
                  $.each(form_data, function (key, value) {
                        data[value.name] = value.value;
                  });
            }

            if (!isEmpty(data)) {
                  $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "payment/process_online_payment.php",
                        data: data,
                        beforeSend: function () {
                              $('.payment_option .loader_container').show();
                        },
                        success: function (response) {
                              setTimeout(function () {
                                    $('.payment_option .loader_container').hide();
                                    if (typeof response === "object") {
                                          var error_text = "";
                                          if (response.success && (typeof response.data !== "undefined" && typeof response.data === "object")) {
                                                if (typeof response.data.authorized_url !== "undefined" && response.data.authorized_url !== '') {
                                                      window.location.href = response.data.authorized_url;
                                                } else {
                                                      error_text = "Something went wrong while processing your payment. Please refresh page and try again.";
                                                }
                                          } else {
                                                error_text = "Something went wrong while processing your payment. Please refresh page and try again.";
                                          }
                                          if (error_text !== "") {
                                                var message = '<div class="alert alert-danger text-left"><p><strong>Error(s) occurred while processing your request:</strong></p><p>' + error_text + '</p></div>';
                                                bootbox.alert(message)
                                          }
                                    }

                              }, 1000);
                        },
                        error: function () {
                              setTimeout(function () {
                                    $('.payment_option .loader_container').hide();
                                    var message = '<br/><br/><div class="alert alert-danger text-center"><strong>Something went wrong while processing your payment. <br/>Please refresh page and try again.</strong></div>';
                                    bootbox.alert(message);
                              }, 500);
                        }
                  });
            }
      });

      $('.download_certificate').on('click', function () {
            $(this).parents('.print_cert_page').find('.response_message .alert-danger').slideUp(300);
            var that=this;
            // $(this).parents('.body_row').find('.download_form').submit(false);
            var user_id = $(this).data('user_id');
            console.log(user_id);
            $(this).html("<img src='img/process_loader.gif' /> <strong><i>&nbsp; Processing...</i></strong>");
            setTimeout(function () {
                  $(that).parents('.card-body').find('.download_cert_form').submit();
                  $(that).html('<strong><span class="glyphicon glyphicon-save"></span> &nbsp;Download Certificate</span></strong>');
            }, 3000);
      });

      $('.print_btn').off('click').on('click', function () {
            window.print();
            setTimeout("window.close()", 100)
      });
      function isEmpty(obj) {
            for (var key in obj) {
                  if (obj.hasOwnProperty(key))
                        return false;
            }
            return true;
      }
});
