document.addEventListener("DOMContentLoaded", function () {
  gsap.registerPlugin(ScrollTrigger);
});

(function ($) {
  $(document).ready(function () {
    var vh = window.innerHeight * 0.01; // Then we set the value in the --vh custom property to the root of the document

    document.documentElement.style.setProperty("--vh", "".concat(vh, "px"));
    window.addEventListener("resize", function () {
      // We execute the same script as before
      var vh = window.innerHeight * 0.01;
      document.documentElement.style.setProperty("--vh", "".concat(vh, "px"));
    });

    $(".slider").slick({
      dots: true,
      infinite: true,
      speed: 700,
      slidesToShow: 1,
      autoplaySpeed: 4000,
      autoplay: true,
    });

    $("#story").on("keyup", function () {
      var words = 0;

      if (this.value.match(/\S+/g) != null) {
        words = this.value.match(/\S+/g).length;
      }

      if (words > 200) {
        // Split the string on first 200 words and rejoin on spaces
        var trimmed = $(this).val().split(/\s+/, 200).join(" ");
        // Add a space at the end to make sure more typing creates new words
        $(this).val(trimmed + " ");
      } else {
        $("#display_story_count").text(words);
        // $('#word_story_left').text(200-words);
      }
    });

    $("#storytile").on("keyup", function () {
      var words = 0;

      if (this.value.match(/\S+/g) != null) {
        words = this.value.match(/\S+/g).length;
      }

      if (words > 10) {
        // Split the string on first 200 words and rejoin on spaces
        var trimmed = $(this).val().split(/\s+/, 10).join(" ");
        // Add a space at the end to make sure more typing creates new words
        $(this).val(trimmed + " ");
      } else {
        $("#display_storytile_count").text(words);
        // $('#word_storytile_left').text(10-words);
      }
    });

    //tags start
    $("#tn-form input").on("change", function () {
      if ($("input[name=radios]:checked", "#tn-form").val() == "challenges") {
        $(".select_input").addClass("visible");
      } else {
        $(".select_input").removeClass("visible");
      }
    });

    $("#tags").tagThis({
      interactive: true,
      noDuplicates: true,
      removeWithBackspace: false,
      maxTags: 10,
      defaultText: "Type to tag",
    });

    $("#tags--tag").on("change keyup paste", function () {
      if ($("#tag-this--tags .tag").length > 9) {
        $(".tag_error").fadeIn();
        // $(this).attr("disabled", true);
      } else {
        $(".tag_error").fadeOut();
        // $(this).removeAttr("disabled");
      }
    });

    $("#tn-form input, #tn-form").on("keypress", function (e) {
      return e.which !== 13;
    });

    $(".add-button").on("click", function () {
      // console.log("clicked");
      //Tag-This lets you pass your own ID and/or text to be attached to a tag you want to create!
      //Your code may look slightly different than this, but here's away to construct an object with an ID that Tag-This will accept.
      var tagData = {
        text: $(this).data("id"),
        id: $(this).data("id"),
      };

      //We have our object- let's pass it to Tag-This's 'addTag' method
      $("#tags").addTag($(this).data("id"));
      // $(this).remove()
    });

    //tags end

    $(".form_swiper").slick({
      dots: true,
      swipe: false,
      touchMove: false,
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

      $(".fourth_section_additional_content").slick({
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

      $(".all_stories_wrap").slick({
        infinite: false,
        speed: 300,
        slidesToShow: 1.2,
        arrows: true,
        prevArrow: $(".prev_arrow"),
        nextArrow: $(".next_arrow"),
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

    // $('.banner').slick({
    //     slidesToShow: 1,
    //     slidesToScroll: 1,
    //     autoplay: true,
    //     autoplaySpeed: 0,
    //     speed: 10000,
    //     cssEase: 'linear',

    //     variableWidth: true,
    //      centerMode: true,

    //     // responsive: [{
    //     //         breakpoint: 1300,
    //     //         settings: { slidesToShow: 1, slidesToScroll: 1 },
    //     //     }, {
    //     //         breakpoint: 1026,
    //     //         settings: { slidesToShow: 1, slidesToScroll: 1 },
    //     //     },
    //     //     {
    //     //         breakpoint: 600,
    //     //         settings: { slidesToShow: 1, slidesToScroll: 1 },
    //     //     }
    //     // ]
    // });

    $(".landing_page_wrap .all_stories_wrap .image_holder_wrap").on(
      "click",
      function (event) {
        $(
          ".landing_page_wrap .all_stories_wrap .image_holder_wrap"
        ).removeClass("active");
        $(this).addClass("active");
        var headline = $(this).data("headline");
        var description = $(this).data("description");
        var quote = $(this).data("quote");
        var author = $(this).data("author");
        var image = $(this).data("image");

        $(".second_section_landing .second_section_inner .right h2").text(
          headline
        );
        $(".second_section_landing .second_section_inner .right p").text(
          description
        );
        $(
          ".second_section_landing .second_section_inner .right blockquote"
        ).text(quote);
        $(".second_section_landing .second_section_inner .right .author").text(
          author
        );
        $(".second_section_landing .second_section_inner .left img").attr(
          "src",
          image
        );
      }
    );

    $(".all_stories_wrap").on(
      "afterChange",
      function (event, slick, currentSlide) {
        var headline = $(".slick-active").data("headline");
        var description = $(".slick-active").data("description");
        var quote = $(".slick-active").data("quote");
        var author = $(".slick-active").data("author");
        var image = $(".slick-active").data("image");

        $(".second_section_landing .second_section_inner .right h2").text(
          headline
        );
        $(".second_section_landing .second_section_inner .right p").text(
          description
        );
        $(
          ".second_section_landing .second_section_inner .right blockquote"
        ).text(quote);
        $(".second_section_landing .second_section_inner .right .author").text(
          author
        );
        $(".second_section_landing .second_section_inner .left img").attr(
          "src",
          image
        );
      }
    );

    $(".single_box .header").on("click", function (event) {
      $(this).toggleClass("active");
      $(this).parent().find(".description").slideToggle();
    });

    $(".checkbox_with_question").on("click", function (event) {
      var currentQuestion = $(this).data("questions");
      $(".checkbox_questions").html(currentQuestion);
    });

    $(".next_slide").on("click", function (event) {
      $(".form_swiper").slick("slickNext");
      clearTimeout(timeoutId);
    });

    $(".form_swiper").on("afterChange", function (event, slick, currentSlide) {
      if (currentSlide == 0) {
        $(".slick-arrow").removeClass("active");
      } else {
        $(".slick-arrow").addClass("active");
      }

      if (currentSlide == 5) {
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
      $("body").addClass("no_scroll");
    });

    $(".close_header").on("click", function (event) {
      $(".main_nav").removeClass("active");
      $("body").removeClass("no_scroll");
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

    if (
      $("body").hasClass("page-template-template-home") ||
      $("body").hasClass("page-template-template-about")
    ) {
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

    // $("a[href^='#']").click(function (e) {
    //   e.preventDefault();

    //   $("html, body").animate(
    //     {
    //       scrollTop: $($(this).attr("href")).offset().top,
    //     },
    //     700
    //   );
    // });

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

window.addEventListener("load", function () {
  document.getElementById("page").classList.remove("loading");

  gsap.from(".home_wrap .home_hero .image_holder", {
    y: 40,
    opacity: 0,
    ease: Quint.easeOut,
  });

  const trigger = document.querySelectorAll(
    ".home .single_story_holder.families"
  );

  gsap.from(trigger, 1.5, {
    opacity: 0,
    stagger: 0.1,
    ease: Quint.easeOut,
    scrollTrigger: {
      trigger: ".second_section",
      start: "top 70%",
    },
  });

  const mocTrigger = document.querySelectorAll(
    ".page-template-template-community .single_story_holder"
  );

  gsap.from(mocTrigger, 1.5, {
    opacity: 0,
    stagger: 0.1,
    ease: Quint.easeOut,
    scrollTrigger: {
      trigger: ".second_section",
      start: "top 70%",
    },
  });

  const textTriggers = gsap.utils.toArray(
    ".page_container h1, .page_container h2, .page_container h3:not(.static), .page_container h4, .page_container h5, .page_container p:not(.static), .page_container ul"
  );
  textTriggers.forEach((text) => {
    gsap.from(text, {
      y: 20,
      opacity: 0,
      scrollTrigger: {
        trigger: text,
        start: "top 85%",
      },
    });
  });

  const graphicTriggers = gsap.utils.toArray(".st__img");
  graphicTriggers.forEach((img) => {
    gsap.from(img, {
      y: 20,
      opacity: 0,
      scrollTrigger: {
        trigger: img,
        start: "top 80%",
      },
    });
  });
});
