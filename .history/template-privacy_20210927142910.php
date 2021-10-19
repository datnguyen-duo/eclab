<?php
/* Template Name: Privacy */
get_header(); ?>

<div class="privacy_wrap">
	<?php 
	$desc_1 = get_field('description_1');
	$desc_2 = get_field('description_2');

	if( $desc_1 ): ?>
		<div class="single_box">
			<div class="content_holder">
				<div class="header">
					<h2>Privacy Policy</h2>
					<img src="<?php echo get_template_directory_uri(); ?>/images/dropdown_arrow.svg" alt="">
				</div>

				<div class="description">
					<p><?php echo $desc_1; ?></p>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<?php if( $desc_2 ): ?>
		<div class="single_box">
			<div class="content_holder">
				<div class="header">
					<h2>Terms of Services</h2>
					<img src="<?php echo get_template_directory_uri(); ?>/images/dropdown_arrow.svg" alt="">
				</div>
				<div class="description">
					<p><?php echo $desc_2; ?></p>
				</div>
			</div>
		</div>
	<?php endif; ?>
</div>

<?php
get_footer(); ?>