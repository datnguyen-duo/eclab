(function ($) {
  $(document).ready(function () {
    let stories = $(".single_story_holder");
    let storiesnew = $(".single_story_holder");

    var newUrl;

    var url_string = window.location.href; //window.location.href
    var url = new URL(url_string);
    var paramValue = url.searchParams.get("story");
    
    setTimeout(() => {
        if (paramValue) {
        $(".single_story_holder").each(function() {
            if ($(this).data('url') == paramValue) {
                $(this).click();
            }
        });
    }
    }, 1000);

    $(document).on("click", ".filter_wrap li", function (e) {
      if ($(this).attr("rel")) {
        var rel = $(this).attr("rel");
        stories.hide().removeClass('slide_show');
        var checkcout = 0;
        $('.single_story_holder').each(function() { 
          if ($(this).attr('rel') == rel && $(this).attr('data-show') == 'show4') {
            checkcout++;
            $(this).show().addClass('slide_show').attr('step', checkcout);
            // stories = $(".single_story_holder").filter('[rel="' + rel + '"]');
            storiesnew = $('.slide_show');
          }
        })
      } else {
        stories.show();
        stories = $(".single_story_holder");
        storiesnew = $(".single_story_holder");
      }
      
      // if ($(this).attr("rel")) {
      //   let rel = $(this).attr("rel");
      //   stories
      //     .hide()
      //     .filter('[rel="' + rel + '"] ').filter('[data-show="show4"]')
      //     .show();
      //   // stories = $(".single_story_holder").filter('[rel="' + rel + '"]');
      //   // console.log(test_story);

      // } else {
      //   stories.show();
      //   stories = $(".single_story_holder");
      // }
      // console.log(stories);
      return false;
    });
    
    var counter;
    
    storiesnew.on("click", function (event) {
      let story_content = $(this).find(".story_content").text();
      let story_title = $(this).find(".story_title").text();
      let story_img = $(this).find(".story_image").attr("src");
      let story_author = $(this).find(".story_author").text();
      let category = $(this).find(".category").text();
      let tags = $(this).find(".story_tags").html();
      let popup = $(".single_news_popup");

      counter = $(this).index();
      if ($(this).attr('step')) {
        counter = $(this).attr('step');
      }
      // console.log(counter+'old');
      popup.find("h2").text(story_title);
      popup.find(".author").text(story_author);
      popup.find(".image_holder img").attr("src", story_img);
      popup.find(".news_content .left p").text(story_content);
      popup.find(".category").text(category);
      popup.find(".tags").html(tags);
      // popup.attr("counter",counter);
      // console.log(popup.attr('counter'));

      var currentUrl = $(this).data('url');
      newUrl = '?story=' + currentUrl + '';
      window.history.pushState("", "", newUrl);

      var shareFacebookUrl = 'https://www.facebook.com/sharer/sharer.php?u=' + window.location.href + '&t=' + story_title.trim()
      var shareTwitterUrl = 'https://twitter.com/share?url=' + window.location.href + '&text=' + story_title.trim()
      var shareMailUrl = 'mailto:?subject='+story_title.trim()+'&body='+window.location.href+''

      popup.find('.facebook').attr('href', shareFacebookUrl);
      popup.find('.twitter').attr('href', shareTwitterUrl);
      popup.find('.email').attr('href', shareMailUrl);

      $(".single_news_popup").fadeIn();
      $("body").addClass("no_scroll");
    });
    
    $('.plus-slides').click(function(e){
      // console.log(storiesnew);
      // console.log(counter);
      let step = parseInt($(this).attr('step')); 
      // console.log('step' + step)
      // console.log(counter);
      counter = parseInt(counter)+step;  
      // console.log(stories.length);
      if( counter > (storiesnew.length -1) ){
        // console.log(counter);
        counter = counter - storiesnew.length;
        // console.log(counter);
      }
      if( counter < 0 ){
        counter = storiesnew.length + counter;
      }
      // console.log('counter'+counter)
      let plusSlide = storiesnew[counter];
      // console.log(plusSlide);
      let story_content = $(plusSlide).find(".story_content").text();
      let story_title = $(plusSlide).find(".story_title").text();
      let story_img = $(plusSlide).find(".story_image").attr("src");
      let story_author = $(plusSlide).find(".story_author").text();
      let category = $(plusSlide).find(".category").text();
      let tags = $(plusSlide).find(".story_tags").html();
      let popup = $(".single_news_popup");
      popup.find("h2").text(story_title);
      popup.find(".author").text(story_author);
      popup.find(".image_holder img").attr("src", story_img);
      popup.find(".news_content .left p").text(story_content);
      popup.find(".category").text(category);
      popup.find(".tags").html(tags);

      var currentUrl = $(plusSlide).data('url');
      var newUrl = '?story=' + currentUrl + '';
      window.history.pushState("", "", newUrl);

      var shareFacebookUrl = 'https://www.facebook.com/sharer/sharer.php?u=' + window.location.href + '&t=' + story_title
      var shareTwitterUrl = 'https://twitter.com/share?url=' + window.location.href + '&text=' + story_title
      var shareMailUrl = 'mailto:?subject='+story_title+'&body='+window.location.href+''

      popup.find('.facebook').attr('href', shareFacebookUrl);
      popup.find('.twitter').attr('href', shareTwitterUrl);
      popup.find('.email').attr('href', shareMailUrl);

      popup.find(".category").text(category);
      popup.find(".tags").html(tags);
    });
    $(document).on("click","span.filter-tag",function(e){
      let tag_filter = $(this).attr('filter');
      $(".single_news_popup").fadeOut();
      $("body").removeClass("no_scroll");
      stories.hide().removeClass('slide_show');
      var checkcout = 0;
      $('.single_story_holder').each(function() { 
        if ($(this).attr('tag')!=='' && $(this).attr('tag').includes(tag_filter) && $(this).attr('data-show') == 'show4') {
          checkcout++;
          $(this).show().addClass('slide_show').attr('step', checkcout);
          // stories = $(".single_story_holder").filter('[rel="' + rel + '"]');
          storiesnew = $('.slide_show');
        }
      })
    });
  });
})(jQuery);