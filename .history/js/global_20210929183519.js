(function ($) {
  $(document).ready(function () {
    
    var vh = window.innerHeight * 0.01; // Then we set the value in the --vh custom property to the root of the document

    document.documentElement.style.setProperty('--vh', "".concat(vh, "px"));
    window.addEventListener('resize', function () {
      // We execute the same script as before
      var vh = window.innerHeight * 0.01;
      document.documentElement.style.setProperty('--vh', "".concat(vh, "px"));
    });

    $(".slider").slick({
      dots: true,
      infinite: true,
      speed: 300,
      slidesToShow: 1,
      adaptiveHeight: true,

      // autoplaySpeed: 2000,
      // autoplay: true,
    });

    $("#story").on('keyup', function() {
      var words = 0;
  
      if ((this.value.match(/\S+/g)) != null) {
        words = this.value.match(/\S+/g).length;
      }
  
      if (words > 200) {
        // Split the string on first 200 words and rejoin on spaces
        var trimmed = $(this).val().split(/\s+/, 200).join(" ");
        // Add a space at the end to make sure more typing creates new words
        $(this).val(trimmed + " ");
      }
      else {
        $('#display_story_count').text(words);
        // $('#word_story_left').text(200-words);
      }
    });

    $("#storytile").on('keyup', function() {
      var words = 0;
  
      if ((this.value.match(/\S+/g)) != null) {
        words = this.value.match(/\S+/g).length;
      }
  
      if (words > 10) {
        // Split the string on first 200 words and rejoin on spaces
        var trimmed = $(this).val().split(/\s+/, 10).join(" ");
        // Add a space at the end to make sure more typing creates new words
        $(this).val(trimmed + " ");
      }
      else {
        $('#display_storytile_count').text(words);
        // $('#word_storytile_left').text(10-words);
      }
    });

    $("#tn-form input").on("change", function () {
      if ($("input[name=radios]:checked", "#tn-form").val() == "challenges") {
        $(".select_input").addClass("visible");
      } else {
        $(".select_input").removeClass("visible");
      }
    });

    $(".form_swiper").slick({
      dots: true,
      speed: 300,
      infinite: false,
      draggable: false,
      slidesToShow: 1,
      adaptiveHeight: true,
      accessibility: false,
      focusOnSelect: false,
      prevArrow:
        "<div class='left'><img src='https://www.righttocareil.com/wp-content/themes/eclab/images/left_arrow.svg'>PREVIOUS</div>",
      nextArrow:
        "<div class='right'>NEXT<img src='https://www.righttocareil.com/wp-content/themes/eclab/images/right_arrow.svg'></div>",
    });

    //   window.addEventListener("keydown", function(e) {
    //     // space and arrow keys
    //     if([32, 37, 38, 39, 40].indexOf(e.keyCode) > -1) {
    //         e.preventDefault();
    //     }
    // }, false);

    if ($(window).width() < 750) {
      $(".stories_wrap").slick({
        infinite: false,
        arrows: false,
        speed: 300,
        slidesToShow: 1.2,
      });

      $(".graphics_holder").slick({
        infinite: false,
        arrows: false,
        speed: 300,
        slidesToShow: 1.2,
      });

      $(".document_holder").slick({
        infinite: false,
        arrows: false,
        speed: 300,
        slidesToShow: 1.2,
      });
    }

    $("header ul li").hover(
      function () {
        if ($(this).find(".sub-menu")) {
          $(this).find(".sub-menu").fadeIn();
        }
      },
      function () {
        $(this).find(".sub-menu").fadeOut();
      }
    );

    $('.banner').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        // autoplay: true,
        autoplaySpeed: 0,
        speed: 10000,
        cssEase: 'linear',

        variableWidth: true,
         centerMode: true,

        // responsive: [{
        //         breakpoint: 1300,
        //         settings: { slidesToShow: 1, slidesToScroll: 1 },
        //     }, {
        //         breakpoint: 1026,
        //         settings: { slidesToShow: 1, slidesToScroll: 1 },
        //     },
        //     {
        //         breakpoint: 600,
        //         settings: { slidesToShow: 1, slidesToScroll: 1 },
        //     }
        // ]
    });

    $(".single_box .header").on("click", function (event) {
      $(this).toggleClass("active");
      $(this).parent().find(".description").slideToggle();
    });

    $(".next_slide").on("click", function (event) {
      $(".form_swiper").slick("slickNext");
      clearTimeout(timeoutId);
    });

    // $(".submit_button").on("click", function (event) {
    //   event.preventDefault();
    //   $(".form_swiper").slick("slickNext");
    // });

    $(".form_swiper").on("afterChange", function (event, slick, currentSlide) {
      if (currentSlide == 0 || currentSlide == 7) {
        $(".slick-arrow").removeClass("active");
      } else {
        $(".slick-arrow").addClass("active");
      }

      if (currentSlide == 6) {
        $(".slick-arrow.right").addClass("last");
      } else {
        $(".slick-arrow.right").removeClass("last");
      }

      if (currentSlide == 6) {
        $(".slick-arrow.right").addClass("last");
      } else {
        $(".slick-arrow.right").removeClass("last");
      }
    });

    $(".filter_wrap ul li").on("click", function (event) {
      $(".filter_wrap ul li").removeClass("active");
      $(this).addClass("active");
    });

    $(".list_holder_opener").on("click", function (event) {
      $(".list_holder").slideToggle();
    });

    $(".menu_opener").on("click", function (event) {
      $(".main_nav").addClass("active");
    });

    $(".close_header").on("click", function (event) {
      $(".main_nav").removeClass("active");
    });

    $(".main_nav ul .menu-item-has-children").each(function () {
      $(this)
        .find(" > a")
        .append(
          '<div class="arrow_holder"><img src=' +
            site_data.theme_url +
            "/images/dropdown.svg" +
            "></div>"
        );
    });

    $(".main_nav ul .arrow_holder").on("click", function (event) {
      event.preventDefault();
      $(this).toggleClass("active").next().slideToggle();
    });

    $(".close_icon").on("click", function (event) {
      $(".single_news_popup").fadeOut();
      $("body").removeClass("no_scroll");
    });

    if ($("body").hasClass("page-template-template-home")) {
      var timeoutId = setTimeout(function () {
        if (
          $.cookie("email_popup") == undefined ||
          $.cookie("email_popup") == null
        ) {
          $(".email_popup").fadeIn();
        }
      }, 5000);
    }

    if ($("body").hasClass("page-template-template-community")) {
      setTimeout(function () {
        if (
          $.cookie("tell_story") == undefined ||
          $.cookie("tell_story") == null
        ) {
          $(".tell_story_popup").fadeIn();
        }
      }, 5000);
    }

    $(".join_us").on("click", function (event) {
      $(".email_popup").fadeIn();
      $("body").addClass("no_scroll");
    });

    $(".close_email_popup").on("click", function (event) {
      $(".email_popup").fadeOut();
      $("body").removeClass("no_scroll");
      $.cookie("email_popup", "true", { expires: 1, path: "/" });
    });

    $(".close_tell_story_popup").on("click", function (event) {
      $(".tell_story_popup").fadeOut();
      $.cookie("tell_story", "true", { expires: 1, path: "/" });
      $("body").removeClass("no_scroll");
    });

    $("a[href^='#']").click(function (e) {
      e.preventDefault();
      $("html, body").animate(
        {
          scrollTop: $($(this).attr("href")).offset().top,
        },
        1500
      );
    });

    // $('input:radio[name="radios"]').change(function () {
    //   if ($(this).is(":checked") && $(this).val() == "challenges") {
    //     $(".third_section .single_question.last").show();
    //   } else {
    //     $(".third_section .single_question.last").hide();
    //   }
    // });
  });

  var lastScrollTop = 0;
  $(window).on("scroll", function (event) {
    if ($(document).scrollTop() > 200) {
      $("header").addClass("fixed");

      var st = $(this).scrollTop();
      if (st > lastScrollTop) {
        // downscroll code
        $("header").removeClass("show");
      } else {
        // upscroll code
        $("header").addClass("show");
      }
      lastScrollTop = st;
    } else {
      if ($("header").hasClass("fixed")) {
        $("header").removeClass("show");

        setTimeout(function () {
          $("header").removeClass("fixed");
        }, 50);
      } else {
        $("header").removeClass("fixed");
      }
    }
  });

  $(window).on("load", function () {
    var marquee = $(".home_wrap .eclab_banner .banner");
    var w = marquee.width();
    var x = Math.round($(window).width() / w) + 1;

    for (var i = 0; i < x; i++) {
      $(".home_wrap .eclab_banner .banner .slides:first-of-type")
        .clone()
        .appendTo(marquee);
    }

    gsap.to(marquee, {
      duration: 10,
      ease: "none",
      x: "-=" + w,
      modifiers: {
        x: gsap.utils.unitize((x) => parseFloat(x) % w),
      },
      repeat: -1,
    });

    marquee.addClass("init");
  });
  $(window).on("scroll", function (event) {});
})(jQuery);
