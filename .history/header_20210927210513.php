<?php
/**
 * The header for our theme
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
	<?php if($google_analytics_script): ?>
		<?php echo $google_analytics_script; ?>
	<?php endif; ?>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="stylesheet" href="https://use.typekit.net/qyl4nbu.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js" defer="defer"></script>

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
	</style>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	
	<header>
		<div class="header_content">
			<?php 
			$logo = get_field('logo_1','option'); 
			if( $logo ): ?>
				<a href="<?php echo get_pll_home_url(); ?>" class="logo_holder">
					<img src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>">
				</a>
			<?php endif; ?>

			<?php if( has_nav_menu('menu-1') ): ?>
					<nav class="main_nav">
						<img src="<?php echo get_template_directory_uri(); ?>/images/close.svg" alt="close-icon" class="close_header">
						<?php wp_nav_menu(
							array(
								'theme_location' => 'menu-1',
								'container' => false,
							)
						); ?>
					</nav>
				
			<?php endif; ?>

			<?php
			$facebook = get_field('facebook', get_pll_option_page());
			$instagram = get_field('instagram', get_pll_option_page());
			$twitter = get_field('twitter',get_pll_option_page());
			$tiktok = get_field('tiktok',get_pll_option_page());
			if( $facebook || $instagram || $twitter || $tiktok ): ?>
				<div class="social_icons">
					<?php if( $facebook ): ?>
						<a href="<?php echo $facebook; ?>" target="_blank">
							<img src="<?php echo get_template_directory_uri(); ?>/images/facebook_dark.svg" alt="">
						</a>
					<?php endif; ?>
					<?php if( $instagram ): ?>
						<a href="<?php echo $instagram; ?>" target="_blank">
							<img src="<?php echo get_template_directory_uri(); ?>/images/instagram_dark.svg" alt="">
						</a>
					<?php endif; ?>
					<?php if( $twitter ): ?>
						<a href="<?php echo $twitter; ?>" target="_blank">
							<img src="<?php echo get_template_directory_uri(); ?>/images/twitter_dark.svg" alt="">
						</a>
					<?php endif; ?>
					<?php if( $tiktok ): ?>
						<a href="<?php echo $tiktok; ?>" target="_blank">
							<img src="<?php echo get_template_directory_uri(); ?>/images/tik_tok_dark.svg" alt="">
						</a>
					<?php endif; ?>
				</div>
			<?php endif; ?>

			<div class="right_content">
				<?php 
				$link = get_field('cta_button',get_pll_option_page());
				if( $link ): 
					$link_url = $link['url'];
					$link_title = $link['title'];
					$link_target = $link['target'] ? $link['target'] : '_self';
					?>
					<a class="button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
						<?php echo esc_html( $link_title ); ?>
					</a>
				<?php endif; ?>
				

				<div class="menu_opener">
					<div class="line_holder">
						<span></span>
						<span></span>
					</div>
					
				</div>
			</div>
			
		</div>
	</header>
<?php 
if( isset($_POST['popup_submit']) && (isset($_POST['popup_fname'])&& !empty($_POST['popup_fname'])) &&
	(isset($_POST['popup_lname'])&& !empty($_POST['popup_lname'])) &&
	(isset($_POST['popup_email'])&& !empty($_POST['popup_email'])) &&
	(isset($_POST['popup_zipcode']) &&!empty($_POST['popup_zipcode'])) ){
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
	curl_setopt($ch, CURLOPT_URL,$api_request_url);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS,$string);

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$server_output = curl_exec($ch);
	curl_close ($ch);
	
}

 ?>

<?php 
	$popup_section = get_field('popup_section');
	$popup_form_fields = get_field('popup_form_fields',get_pll_option_page());
?>
	<div class="email_popup">
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
						<form action="" method="post">
							<input type="text" name="popup_fname" placeholder="<?php echo $popup_form_fields['first_name']; ?>" required>
							<input type="text" name="popup_lname" placeholder="<?php echo $popup_form_fields['last_name']; ?>" required>
							<input type="email" name="popup_email" placeholder="<?php echo $popup_form_fields['email_address']; ?>" required>
							<input type="text" name="popup_zipcode" placeholder="<?php echo $popup_form_fields['zip_code']; ?>" required>
							<button class="button dark" type="submit" name="popup_submit">
								<?php echo $popup_form_fields['form_button']; ?>
							</button>
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
                            <a href="" class="facebook">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/facebook.svg" alt="facebook-icon">
                            </a>
                            <a href="" class="twitter">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/twitter.svg" alt="twitter-icon">
                            </a>
                            <a href="" class="email">
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
