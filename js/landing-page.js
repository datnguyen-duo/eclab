(function ($) {
  $(document).ready(function () {
    $("#signup_btn").on("click", function (e) {
      e.preventDefault();
      if (
        $(
          ".first_section_landing_content .form_holder form label.container input"
        ).is(":checked")
      ) {
        let fname = $("#community_signup #first_name").val(),
          lname = $("#community_signup #last_name").val(),
          email = $("#community_signup #email").val(),
          zipcode = $("#community_signup #zipcode").val();
        if (email !== "" && zipcode !== "") {
          $.ajax({
            url: ajaxURL,
            type: "post",
            data: {
              action: "optinform",
              email: email,
              fname: fname,
              lname: lname,
              zipcode: zipcode,
            },
            dataType: "json",
            success: function (response) {
              // $("#coalition-wrap")
              //   .find(".thank_you_message")
              //   .css("display", "flex");
              // $("#signup_popup").fadeIn();
              // $("body").addClass("no_scroll");
              // $("#coalition-form").css("display", "none");
              // $("input#first_name").val("");
              // $("input#last_name").val("");
              // $("input#email").val("");
              // $("input#zipcode").val("");
              // console.log(response.data);
            },
            error: function () {
              console.log("obj");
            },
          });
        } else {
          // alert("Please enter email and zipcode!");
        }
      } else {
        // do nothing
      }
    });
  });
})(jQuery);
