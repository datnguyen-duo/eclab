(function($){
    $(document).ready(function () {
        $("#coalition-wrap").on('click','#add-your-name',function (e) {
            console.log('click');
            e.preventDefault();
            let fname = $("input#coalition-fname").val(), 
            lname = $("input#coalition-lname").val(), 
            email = $("input#coalition-email").val(), 
            zipcode = $("input#coalition-zipcode").val();
            if( email!=='' &&zipcode!=='' ){
                $.ajax({
                    url: ajaxURL,
                    type: 'post',
                    data: {
                     action: 'childhoodFundingCoalition',
                     email: email,
                     fname: fname,
                     lname:lname,
                     zipcode: zipcode,
                    },
                    dataType: "json",
                    success: function (response) {
                        $("#coalition-wrap").find(".thank_you_message").css("display","flex");
                        // $("#signup_popup").fadeIn();
                        // $("body").addClass("no_scroll");
                        $("#coalition-form").css("display","none");
                        $("input#first_name").val('');
                        $("input#last_name").val(''); 
                        $("input#email").val(''); 
                        $("input#zipcode").val('');
                        // console.log(response.data);
                    },
                    error: function () {
                     console.log('obj');
                    }
                });
            }else{
                alert('Please enter email and zipcode!');
            }
        });
    });
})(jQuery);