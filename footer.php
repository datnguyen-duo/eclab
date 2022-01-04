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
                <div class="top_section">
                    <?php
                    $logo = get_field('logo_2', 'option');
                    if ($logo) : ?>
                        <a href="<?php echo get_pll_home_url(); ?>" class="logo_holder">
                            <img src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>">
                        </a>
                    <?php endif; ?>
                        
                    <?php $description = get_field('form_description', get_pll_option_page()); ?>
                    <div class="form_holder">
                        <div class="form_description">
                            <?php if ($description) : ?>
                                <p><?php echo $description; ?></p>
                            <?php endif; ?>
                        </div>
                        <form id="footer_signup" >
                        <?php $footer_form_fields = get_field('footer_form_fields', get_pll_option_page()); ?>
                            <div class="thank_you_message">
                                <p>
                                <?php echo $footer_form_fields['thank_you_message']; ?>
                                </p>
                            </div>
                            
                            <input type="text" name="fname" id="firstname" placeholder="<?php echo $footer_form_fields['first_name']; ?>" required>
                            <input type="text" name="lname" id="lastname" placeholder="<?php echo $footer_form_fields['last_name']; ?>" required>
                            <input type="email" name="email" id="emailf" placeholder="<?php echo $footer_form_fields['email_address']; ?>" required>
                            <input type="text" name="zipcode" id="zipcodef" placeholder="<?php echo $footer_form_fields['zip_code']; ?>" required>
                            <div class="bottom_wrap">
                                <label class="container">Sign me up to join the We, the Village Coalition too!
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                                <button class="button light" id="signup_btnf" type="button" name="signup_btn">
                                    <?php echo $footer_form_fields['form_button']; ?>
                                </button>
                            </div>
                        </form>
                    </div>

                    <?php
                    $facebook = get_field('facebook', get_pll_option_page());
                    $instagram = get_field('instagram', get_pll_option_page());
                    $twitter = get_field('twitter', get_pll_option_page());
                    if ($facebook || $instagram || $twitter) : ?>
                        <div class="social_icons">
                            <?php if ($facebook) : ?>
                                <a href="<?php echo $facebook; ?>" target="_blank">
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/facebook_light.svg" alt="">
                                </a>
                            <?php endif; ?>
                            <?php if ($instagram) : ?>
                                <a href="<?php echo $instagram; ?>" target="_blank">
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/instagram_light.svg" alt="">
                                </a>
                            <?php endif; ?>
                            <?php if ($twitter) : ?>
                                <a href="<?php echo $twitter; ?>" target="_blank">
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/twitter_light.svg" alt="">
                                </a>
                            <?php endif; ?>
                            <?php if ($tiktok) : ?>
                                <a href="<?php echo $tiktok; ?>" target="_blank">
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/tik_tok_light.svg" alt="">
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="bottom_secton">
                    <?php
                    $copyright = get_field('copyright', get_pll_option_page());
                    if ($copyright) : ?>
                        <div class="copyright">
                            <?php echo $copyright;?>
                        </div>
                    <?php endif; ?>

                    <?php if (has_nav_menu('menu-2')) : ?>
                        <nav>
                            <?php wp_nav_menu(
                                array(
                                    'theme_location' => 'menu-2',
                                    'container' => false,
                                )
                            ); ?>
                        </nav>
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
                        $("#community_signup").find(".thank_you_message").css("display","flex");
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
        
    });
})(jQuery);
</script>
</body>
</html>
