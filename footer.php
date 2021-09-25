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
<?php 
if( isset($_POST['signup_btn']) && (isset($_POST['fname'])&& !empty($_POST['fname'])) &&
	(isset($_POST['lname'])&& !empty($_POST['lname'])) &&
	(isset($_POST['email'])&& !empty($_POST['email'])) &&
	(isset($_POST['zipcode']) &&!empty($_POST['zipcode'])) ){
	$first_name = $_POST['fname'];
	$last_name = $_POST['lname'];
	$email = $_POST['email'];
	$zipcode = $_POST['zipcode'];
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
	<footer>
		<div class="content_holder">
			<div class="footer_content">
				<div class="top_section">
					<?php 
					$logo = get_field('logo_2','option');
					if( $logo ): ?>
						<a href="<?php echo get_pll_home_url(); ?>" class="logo_holder">
							<img src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>">
						</a>
					<?php endif; ?>
						
					<?php $description = get_field('form_description',get_pll_option_page()); ?>
					<div class="form_holder">
						<div class="form_description">
							<?php if( $description ): ?>
								<p><?php echo $description; ?></p>
							<?php endif; ?>
						</div>
						<form id="community_signup" action="" method="post" >
						<?php $footer_form_fields = get_field('footer_form_fields',get_pll_option_page()); ?>
							<div class="thank_you_message">
								<p>
								<?php echo $footer_form_fields['thank_you_message']; ?>
								</p>
							</div>
							
							<input type="text" name="fname" id="first_name" placeholder="<?php echo $footer_form_fields['first_name']; ?>" required>
							<input type="text" name="lname" id="last_name" placeholder="<?php echo $footer_form_fields['last_name']; ?>" required>
							<input type="email" name="email" id="email" placeholder="<?php echo $footer_form_fields['email_address']; ?>" required>
							<input type="text" name="zipcode" id="zipcode" placeholder="<?php echo $footer_form_fields['zip_code']; ?>" required>
							<button class="button light" id="signup_btn" type="submit" name="signup_btn">
								<?php echo $footer_form_fields['form_button']; ?>
							</button>
						</form>
					</div>

					<?php
					$facebook = get_field('facebook',get_pll_option_page());
					$instagram = get_field('instagram',get_pll_option_page());
					$twitter = get_field('twitter',get_pll_option_page());
					if( $facebook || $instagram || $twitter  ): ?>
						<div class="social_icons">
							<?php if( $facebook ): ?>
								<a href="<?php echo $facebook; ?>" target="_blank">
									<img src="<?php echo get_template_directory_uri(); ?>/images/facebook_light.svg" alt="">
								</a>
							<?php endif; ?>
							<?php if( $instagram ): ?>
								<a href="<?php echo $instagram; ?>" target="_blank">
									<img src="<?php echo get_template_directory_uri(); ?>/images/instagram_light.svg" alt="">
								</a>
							<?php endif; ?>
							<?php if( $twitter ): ?>
								<a href="<?php echo $twitter; ?>" target="_blank">
									<img src="<?php echo get_template_directory_uri(); ?>/images/twitter_light.svg" alt="">
								</a>
							<?php endif; ?>
							<?php if( $tiktok ): ?>
								<a href="<?php echo $tiktok; ?>" target="_blank">
									<img src="<?php echo get_template_directory_uri(); ?>/images/tik_tok_light.svg" alt="">
								</a>
							<?php endif; ?>
						</div>
					<?php endif; ?>
				</div>

				<div class="bottom_secton">
					<?php 
					$copyright = get_field('copyright',get_pll_option_page()); 
					if( $copyright ): ?>
						<div class="copyright">
							<?php echo $copyright;?>
						</div>
					<?php endif; ?>

					<?php if( has_nav_menu('menu-2') ): ?>
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

</body>
</html>
