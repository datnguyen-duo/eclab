<?php
/**
 * ALT HEADER
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package eclab
 */
$google_analytics_script = get_field('google_analytics_script', 'option');
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <?php if ($google_analytics_script) : ?>
        <?php echo $google_analytics_script; ?>
    <?php endif; ?>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="stylesheet" href="https://use.typekit.net/qyl4nbu.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js" defer="defer"></script>
    <?php 
        if (is_page_template("template-landing.php")) {
            ?>
            <!-- Facebook Pixel Code -->
            <script>
            !function(f,b,e,v,n,t,s)
            {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window, document,'script',
            'https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', '512592649968663');
            fbq('track', 'PageView');
            </script>
            <noscript><img height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id=512592649968663&ev=PageView&noscript=1"
            /></noscript>
            <!-- End Facebook Pixel Code -->
            <meta name="facebook-domain-verification" content="q75n5csfmo1jrmimt29bbg4w811f6i" />
            <?php
        }
    ?>
    <?php wp_head(); ?>
    <style type="text/css">
        .single_news_popup .single_news_popup_content .news_content .right .tags {
            text-align: right;
            font-family: "neusa-next-std";
            font-display: auto;
            font-style: normal;
            font-weight: 400;
            color: #d5714f;
            font-size: 24px;
            cursor: pointer;
        }
        .signup_popup {
            position: fixed;
            display: none;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            overflow: auto;
            background-color: rgba(0,0,0,0.7);
            z-index: 1000;
        }
        .signup_popup .signup_popup_content {
            height: 100vh;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
        }
        .signup_popup .signup_popup_content .signup_popup_content_wrap {
            max-width: 1440px;
            /*width: 90%;*/
            min-height: 320px;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            position: relative;
        }
        .signup_popup .signup_popup_content .signup_popup_content_wrap .close_signup_popup {
            position: absolute;
            right: 30px;
            top: 30px;
            z-index: 5;
            cursor: pointer;
        }
        .signup_popup .signup_popup_content .signup_popup_content_wrap .left {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            background-color: #fcf3dc;
            padding-block: 30px;
            margin: 10px 20px;
        }
        .signup_popup .signup_popup_content .signup_popup_content_wrap .left .message {
            font-family: "korolev";
            font-display: auto;
            font-style: normal;
            font-weight: 900;
            color: #d5714f;
            font-size: 57px;
            text-align: center;
            text-transform: uppercase;
            max-width: 350px;
            margin: 15px 25px;
        }
        @media only screen and (max-width: 1020px) {
            .signup_popup .signup_popup_content .signup_popup_content_wrap {
                width: 100%;
            }
            .signup_popup .signup_popup_content .signup_popup_content_wrap .left {
                width: 100%;
                margin-bottom: 30px;
                padding-right: 0;
            }
        }
    </style>
</head>

<body <?php body_class(); ?>>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KHWSF9T"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<?php wp_body_open(); ?>
<div id="page" class="site loading">
    
    <header>
        <div class="header_content">
            <?php
            $logo = get_field('logo_1', 'option');
            if ($logo) : ?>
                <a class="logo_holder">
                    <img src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>">
                </a>
            <?php endif; ?>

            

         
            
        </div>
    </header>
<?php
if (isset($_POST['popup_submit']) && (isset($_POST['popup_fname'])&& !empty($_POST['popup_fname'])) &&
    (isset($_POST['popup_lname'])&& !empty($_POST['popup_lname'])) &&
    (isset($_POST['popup_email'])&& !empty($_POST['popup_email'])) &&
    (isset($_POST['popup_zipcode']) &&!empty($_POST['popup_zipcode']))) {
    $first_name = $_POST['popup_fname'];
    $last_name = $_POST['popup_lname'];
    $email = $_POST['popup_email'];
    $zipcode = $_POST['popup_zipcode'];
    $api_key = "78e7e43ff662bc958e6b869a9ea44307";
    $api_request_url = "https://actionnetwork.org/api/v2/forms/ffba81ee-03e0-4c17-abf6-1dae7786c3fa/submissions/";
    $headers = array(
           "Content-Type: application/json",
           'OSDI-API-Token: '.$api_key
        );
    $string = '{
	  "person" : {
	    "family_name" : "'.$first_name.'",
	    "given_name" : "'.$last_name.'",
	    "postal_addresses" : [ { "postal_code" : "'.$zipcode.'" }],
	    "email_addresses" : [ { "address" : "'.$email.'" }]
	   },
	  "add_tags": [
	    "volunteer",
	    "member"
	  ]
	}';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 100);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_URL, $api_request_url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $string);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $server_output = curl_exec($ch);
    curl_close($ch);
}

?>

<?php
    $popup_section = get_field('popup_section');
    $popup_form_fields = get_field('popup_form_fields', get_pll_option_page());
?>
    <div class="signup_popup" id="signup_popup">
        <div class="signup_popup_content">
            <div class="signup_popup_content_wrap">
                <div class="close_signup_popup">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/close.svg" alt="close-icon" class="desktop">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/white_close.svg" alt="close-icon" class="mobile">
                </div>
                <div class="left">
                    <div class="message">Thank you for joining us!</div>
                </div>
            </div>
        </div>
    </div>
    <div class="email_popup" id="email_popup">
        <div class="email_popup_content">
            <div class="email_popup_content_wrap">
                <div class="close_email_popup">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/close.svg" alt="close-icon" class="desktop">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/white_close.svg" alt="close-icon" class="mobile">
                </div>
                <div class="left">
                    <?php echo $popup_section['description'] ?>
                </div>
                <div class="right">
                    <div class="form_holder">
                        <div class="thank_you_message">
                            <p>
                            <?php echo $popup_form_fields['thank_you_message']; ?>
                            </p>
                        </div>
                        <form >
                            <input type="text" name="popup_fname" placeholder="<?php echo $popup_form_fields['first_name']; ?>" required>
                            <input type="text" name="popup_lname" placeholder="<?php echo $popup_form_fields['last_name']; ?>" required>
                            <input type="email" name="popup_email" placeholder="<?php echo $popup_form_fields['email_address']; ?>" required>
                            <input type="text" name="popup_zipcode" placeholder="<?php echo $popup_form_fields['zip_code']; ?>" required>
                            <div class="bottom_wrap">
                                <label class="container"><?php echo $popup_form_fields['checkbox_message']; ?>
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                                <button class="button dark" type="button" name="popup_submit" id="popup_submit">
                                    <?php echo $popup_form_fields['form_button']; ?>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                
            </div>
        </div>
    </div>  

    <div class="single_news_popup" counter="0">
        <div class="content_holder">
            <div class="close_icon">
                <img src="<?php echo get_template_directory_uri(); ?>/images/close.svg" alt="close-icon">
            </div>
            <div class="single_news_popup_content">
                <div class="news_header">
                    <div class="left">
                        <div class="small_headline_holder">
                            <div class="small_headline">
                            Our Community
                            </div>
                        </div>
                        
                        <h2>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h2>
                        <div class="author">
                            By Jane Doe
                        </div>
                        <div class="social_wrap">
                            <p>Social</p>
                            <a href="" class="facebook" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"
                  target="_blank"
                  title="Share on Facebook">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/facebook.svg" alt="facebook-icon">
                            </a>
                            <a href="" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"
                  target="_blank"
                  title="Share on Twitter"
                  class="twitter">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/twitter.svg" alt="twitter-icon">
                            </a>
                            <a href="" class="email" target="_blank">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/mail.svg" alt="mail-icon">
                            </a>

                        </div>
                    </div>
                    <div class="right">
                        <div class="image_holder">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/single_story.jpg" alt="">
                        </div>
                    </div>
                </div>

                <div class="news_content">
                    <div class="left">
                        <p>
                            Our children may be returning back to school, but we're not going back to normal. This year in Illinois, families and educators are teaming up to collect our #RightToCare. We demand early childhood care families can afford, access and trust and fair pay to educators that dedicate their lives to our children. Our children may be returning back to school, but we're not going back to normal. This year in Illinois, families and educators are teaming up to collect our #RightToCare. We demand early childhood care families can afford, access and trust and fair pay to educators that dedicate their lives to our children. Our children may be returning back to school, but we're not going back to normal. This year in Illinois, families and educators are teaming up to collect our #RightToCare. We demand early childhood care families can afford, access and trust and fair pay to educators that dedicate their lives to our children. Our children may be returning back to school, but we're not going back to normal. This year in Illinois, families and educators are teaming up to collect our #RightToCare. We demand early childhood care families can afford, access and trust and fair pay.
                        </p>
                    </div>
                    <div class="right">
                        <p>Story from</p>
                        <div class="category">
                            Families
                        </div>
                        <p style="margin-top: 10px;">Tags:</p>
                        <div class="tags">
                            #RightToCare
                        </div>
                    </div>
                </div>

                <div class="news_navigation">
                    <div class="left plus-slides" step="-1">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/left_arrow.svg" alt="arrow-icon">
                        PREVIOUS
                    </div>
                    <div class="right plus-slides" step="+1">
                        NEXT
                        <img src="<?php echo get_template_directory_uri(); ?>/images/right_arrow.svg" alt="arrow-icon">
                    </div>
                </div>
            </div>
        </div>
    </div>
