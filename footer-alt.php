<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package eclab
 */

?>

    <footer>
        <div class="content_holder">
            <div class="footer_content">
               

                <div class="bottom_secton">
                    <?php
                    $copyright = get_field('copyright', get_pll_option_page());
                    if ($copyright) : ?>
                        <div class="copyright">
                            <?php echo $copyright;?>
                        </div>
                    <?php endif; ?>

                   
                </div>
            </div>
        </div>
    </footer>
</div>

<?php wp_footer(); ?>
<script type="text/javascript">
    let ajaxURL = '<?=admin_url('admin-ajax.php')?>';
(function($){
    $(document).ready(function(){
        $(".close_signup_popup").on("click", function (event) {
          $("#signup_popup").fadeOut();
          $("body").removeClass("no_scroll");
          $.cookie("signup_popup", "true", { expires: 1, path: "/" });
        });
        $("#popup_submit").click(function (e) {
            e.preventDefault();
            let fname = $("input[name='popup_fname']").val(), 
            lname = $("input[name='popup_lname']").val(), 
            email = $("input[name='popup_email']").val(), 
            zipcode = $("input[name='popup_zipcode']").val();
            if( fname!=='' && lname!=='' && email!=='' &&zipcode!=='' ){
                $.ajax({
                    url: ajaxURL,
                    type: 'post',
                    data: {
                     action: 'signup_email_an',
                     email: email,
                     fname: fname,
                     lname:lname,
                     zipcode: zipcode,
                    },
                    dataType: "json",
                    success: function (response) {
                        
                        $("#email_popup").fadeOut();
                        $("#signup_popup").fadeIn();
                        $("input[name='popup_fname']").val('');
                        $("input[name='popup_lname']").val('');
                        $("input[name='popup_email']").val('');
                        $("input[name='popup_zipcode']").val('');
                        // $("body").addClass("no_scroll");
                         // console.log(response.data);
                     // location.reload();
                    },
                    error: function () {
                     console.log('obj');
                    }
                });
            }else{
                alert('Please complete all fields!');
            }
            
        });
        $("#footer_signup").on('click', "#signup_btnf", function (e) {
            e.preventDefault();
            let fname = $("input#firstname").val(), 
            lname = $("input#lastname").val(), 
            email = $("input#emailf").val(), 
            zipcode = $("input#zipcodef").val();
            if( fname!=='' && lname!=='' && email!=='' &&zipcode!=='' ){
                $.ajax({
                    url: ajaxURL,
                    type: 'post',
                    data: {
                     action: 'signup_email_an',
                     email: email,
                     fname: fname,
                     lname:lname,
                     zipcode: zipcode,
                    },
                    dataType: "json",
                    success: function (response) {
                        $("#footer_signup").find(".thank_you_message").css("display","flex");
                        // $("#signup_popup").fadeIn();
                        // $("body").addClass("no_scroll");
                        $("input#first_name").val('');
                        $("input#last_name").val(''); 
                        $("input#email").val(''); 
                        $("input#zipcode").val('');
                        // console.log(response.data);
                     // console.log(response.data);
                     // location.reload();
                    },
                    error: function () {
                     console.log('obj');
                    }
                });
            }else{
                alert('Please complete all fields!');
            }
        });

        $("#community_signup").on('click', "#signup_btn", function (e) {
            e.preventDefault();
            let fname = $("input#first_name").val(), 
            lname = $("input#last_name").val(), 
            email = $("input#email").val(), 
            zipcode = $("input#zipcode").val();
            if( fname!=='' && lname!=='' && email!=='' &&zipcode!=='' ){
                $.ajax({
                    url: ajaxURL,
                    type: 'post',
                    data: {
                     action: 'signup_email_an',
                     email: email,
                     fname: fname,
                     lname:lname,
                     zipcode: zipcode,
                    },
                    dataType: "json",
                    success: function (response) {
                        // $("#community_signup").find(".thank_you_message").css("display","flex");
                        // $("#signup_popup").fadeIn();
                        // $("body").addClass("no_scroll");
                        $("input#first_name").val('');
                        $("input#last_name").val(''); 
                        $("input#email").val(''); 
                        $("input#zipcode").val('');
                        // console.log(response.data);
                     // console.log(response.data);
                     // location.reload();
                     window.location.href = '/thank-you/'
                    },
                    error: function () {
                     console.log('obj');
                    }
                });
            }else{
                alert('Please complete all fields!');
            }
        });
        
    });
})(jQuery);
</script>
</body>
</html>
