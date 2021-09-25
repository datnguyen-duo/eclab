<?php
/* Template Name: About */
get_header(); ?>

<div class="about_wrap">
	<?php 
	$desc_section = get_field('description_section'); 
	if( $desc_section['title'] || $desc_section['description'] ): ?>
		<div class="first_section" id="story">
			<div class="content_holder">
				<div class="second_section_content">
					<h2><?php echo $desc_section['title']; ?></h2>
					<?php echo $desc_section['description']; ?>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<?php 
	$desc_section = get_field('description_2_section'); 
	if( $desc_section['title'] || $desc_section['description'] ): ?>
		<div class="second_section" id="mission">
			<div class="content_holder">
				<div class="second_section_content">
					<h2><?php echo $desc_section['title']; ?></h2>
					<?php echo $desc_section['description']; ?>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<?php 
	$form_section = get_field('form_section'); 
	if( $form_section ): ?>
	<div class="third_section">
		<div class="content_holder">
			<div class="third_section_content">
				<div class="left">
					<div class="left_content">
						<?php if( $form_section['title'] ): ?>
							<h2><?php echo $form_section['title']; ?></h2>
						<?php endif; ?>

						<?php if( $form_section['description'] ): ?>
							<p><?php echo $form_section['description']; ?></p>
						<?php endif; ?>
					</div>
				</div>
				<div class="right">
					<div class="form_holder">
						<?php $about_form_fields = get_field('footer_form_fields',get_pll_option_page()); ?>
						<div class="thank_you_message">
							<p>
							<?php echo $about_form_fields['thank_you_message']; ?>
							</p>
						</div>
						
						<form>
							<input type="text" name="" placeholder="<?php echo $about_form_fields['first_name']; ?>">
							<input type="text" name="Last Name" placeholder="<?php echo $about_form_fields['last_name']; ?>">
							<input type="email" name="Email" placeholder="<?php echo $about_form_fields['email_address']; ?>">
							<input type="text" name="zip" placeholder="<?php echo $about_form_fields['zip_code']; ?>">
							<button class="button dark">
								<?php echo $about_form_fields['form_button']; ?>
							</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php endif; ?>

	<?php 
	$resources_section = get_field('resources_section');
	if( $resources_section['title'] || $resources_section['description'] ): ?>
	<div class="fourth_section" id="resources">
		<div class="content_holder">
			<h2>Resources</h2>
			<?php if( $resources_section['description'] ): ?>
				<p><?php echo $resources_section['description']; ?></p>
			<?php endif; ?>
		</div>
	</div>
	<?php endif;

	if( $resources_section['resources'] ): ?>
		<div class="fifth_section">
			<div class="content_holder">
				<div class="fifth_section_content">
					<?php foreach( $resources_section['resources'] as $resoruce ): ?>
						<a href="<?php echo $resoruce['url']; ?>" target="_blank" class="single_box">
							<h3><span><?php echo $resoruce['text']; ?></span></h3>
						</a>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<?php 
		$event_section = get_field('event_section');
		$event_section_headline = get_field('event_section_headline');
		$event_section_description = get_field('event_section_description');
	?>

	<?php if($event_section || $event_section_headline || $event_section_description): ?>
	<div class="event_section" id="events">
		<div class="content_holder">
			<?php if($event_section_headline): ?>
				<h2><?php echo $event_section_headline; ?></h2>
			<?php endif; ?>

			<?php if($event_section_description): ?>
				<p>
					<?php echo $event_section_description; ?>
				</p>
			<?php endif; ?>

			<?php if($event_section): ?>

				<div class="event_section_holder">
					<?php foreach( $event_section as $singleEvent ): ?>
						<a <?php if($singleEvent['event_link']): ?>href="<?php echo $singleEvent['event_link']['url']; ?>" target="<?php echo $singleEvent['event_link']['target']; ?>"<?php endif; ?> class="single_event">
							<div class="single_event_content">
								<div class="left">
									<div class="image_holder_wrap">
										<div class="image_holder">
											<img src="<?php echo $singleEvent['event_image']['url']; ?>" alt="<?php echo $singleEvent['event_image']['alt']; ?>">
										</div>
									</div>
									<div class="title_holder">
										<h3><?php echo $singleEvent['event_title']; ?></h3>
									</div>
								</div>
								<div class="right">
									<div class="date"><?php echo $singleEvent['event_date']; ?></div>
									<div class="time"><?php echo $singleEvent['event_time']; ?></div>
									<p>
										<?php echo $singleEvent['event_description']; ?>
									</p>
								</div>
							</div>
					</a>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
	<?php endif; ?>
	<?php
	$press_section = get_field('press_section');
	if( $press_section['title'] || $press_section['links'] ): ?>
		<div class="sixth_section" id="news">
			<div class="content_holder">
				<div class="sixth_section_content">
					<?php if( $press_section['title'] ): ?>
						<h2><?php echo $press_section['title']; ?></h2>
					<?php endif; ?>

					<?php if( $press_section['links'] ): ?>
						<ul>
							<?php foreach( $press_section['links'] as $item ): ?>
								<?php 
								$link = $item['link'];
								if( $link ): 
									$link_url = $link['url'];
									$link_title = $link['title'];
									$link_target = $link['target'] ? $link['target'] : '_self';
									?>
									<li>
										<a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
											<img src="<?php echo get_template_directory_uri(); ?>/images/arrow_right.svg" alt="">
											<?php echo esc_html( $link_title ); ?>
										</a>
									</li>
								<?php endif; ?>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<?php
	$desc_section = get_field('description_3_section');
	if( $desc_section['title'] || $desc_section['description'] || $desc_section['list'] ): ?>
		<div class="seventh_section" id="who_we_are">
			<div class="content_holder">
				<div class="seventh_section_content">
					<?php if( $desc_section['title'] ): ?>
						<h2><?php echo $desc_section['title']; ?></h2>
					<?php endif; ?>

					<?php if( $desc_section['description'] || $desc_section['list_description'] ): ?>
						<p>
							<?php echo $desc_section['description']; ?>
							
							<?php if( $desc_section['list_description'] ): ?>
								<span><?php echo $desc_section['list_description']; ?></span>
							<?php endif; ?>
						</p>
					<?php endif; ?>
								
					<?php if( $desc_section['list'] ): ?>
						<div class="list_holder_opener">
							<p>Organizations and Individuals</p>
							<img src="<?php echo get_template_directory_uri(); ?>/images/dropdown.svg" alt="">
						</div>
						<div class="list_holder">
							<ul>
								<?php foreach( $desc_section['list'] as $item ): ?>
									<li><?php echo $item['text']; ?></li>
								<?php endforeach; ?>
							</ul>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	<?php endif; ?>
</div>

<?php
get_footer(); ?>