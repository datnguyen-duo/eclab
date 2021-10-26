(function ($) {
  $(document).ready(function () {
    // console.log('test');
    var root = location.protocol + '//' + location.host;
    var admin_ajax = root + ajaxurl;
    // console.log(root+ajaxurl);
    $(document).on('change','select.story-status',function(e){
      let value = $(this).val(),id = $(this).attr('data-id');
      // console.log(value+"+"+id);
      $.ajax({
          url: admin_ajax,
          type: 'post',
          data: {
           action: 'rtc_change_story_status',
           story_id:id,
           value:value,
          },
          dataType: "json",
          success: function (response) {
              console.log(response.data);
          },
          error: function () {
           console.log('error');
          }
      });
      // console.log("change");
    });
  });
})(jQuery);
