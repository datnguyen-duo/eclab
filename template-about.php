<?php
/* Template Name: About */
get_header(); ?>

<div class="about_wrap page_container">
    
    <?php
    $desc_section = get_field('description_section');
    $main_title = get_field('main_title');
    if ($desc_section['title'] || $desc_section['description']) : ?>
        <div class="first_section" id="story">
            <div class="content_holder">
                <div class="second_section_content">
                    <?php if($main_title): ?>
                        <h1><?php echo $main_title; ?></h1>
                    <?php endif; ?>
                    <h2><?php echo $desc_section['title']; ?></h2>
                    <?php echo $desc_section['description']; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php
    $desc_section = get_field('description_2_section');
    if ($desc_section['title'] || $desc_section['description']) : ?>
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
    if ($form_section) : ?>
    <div class="third_section">
        <div class="content_holder">
            <div class="third_section_content">
                <div class="left">
                    <div class="left_content">
                        <?php if ($form_section['title']) : ?>
                            <h2><?php echo $form_section['title']; ?></h2>
                        <?php endif; ?>

                        <?php if ($form_section['description']) : ?>
                            <p><?php echo $form_section['description']; ?></p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="right">
                    <div class="form_holder" id="coalition-wrap">
                        <?php $about_form_fields = get_field('footer_form_fields', get_pll_option_page()); ?>
                        <div class="thank_you_message">
                            <p>
                            <?php echo $about_form_fields['thank_you_message']; ?>
                            </p>
                        </div>
                        
                        <form id="coalition-form">
                            <input type="text" id="coalition-fname" placeholder="<?php echo $about_form_fields['first_name']; ?>">
                            <input type="text" name="lastname" id="coalition-lname" placeholder="<?php echo $about_form_fields['last_name']; ?>">
                            <input type="email" name="Email" id="coalition-email" placeholder="<?php echo $about_form_fields['email_address']; ?>">
                            <input type="text" name="zip"   id="coalition-zipcode" placeholder="<?php echo $about_form_fields['zip_code']; ?>">
                            <button class="button dark" id="add-your-name" type="button">
                                <?php echo $about_form_fields['form_button']; ?>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- <?php
    $resources_section = get_field('resources_section');
    if ($resources_section['title'] || $resources_section['description']) : ?>
    <div class="fourth_section" id="resources">
        <div class="content_holder">
            <h2>Resources</h2>
            <?php if ($resources_section['description']) : ?>
                <p><?php echo $resources_section['description']; ?></p>
            <?php endif; ?>
        </div>
    </div>
    <?php endif;

    if ($resources_section['resources']) : ?>
        <div class="fifth_section">
            <div class="content_holder">
                <div class="fifth_section_content">
                    <?php foreach ($resources_section['resources'] as $resoruce) : ?>
                        <a href="<?php echo $resoruce['url']; ?>" target="_blank" class="single_box">
                            <h3 class="static"><span><?php echo $resoruce['text']; ?></span></h3>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    <?php endif; ?> -->

    <?php
        $event_section = get_field('event_section');
        $event_section_headline = get_field('event_section_headline');
        $event_section_description = get_field('event_section_description');
    ?>

    <?php if ($event_section) : ?>
    <div class="event_section" id="events">
        <div class="content_holder">
            <?php if ($event_section_headline) : ?>
                <h2><?php echo $event_section_headline; ?></h2>
            <?php endif; ?>

            <?php if ($event_section_description) : ?>
                <p>
                    <?php echo $event_section_description; ?>
                </p>
            <?php endif; ?>

            <?php if ($event_section) : ?>
                <div class="event_section_holder">
                    <?php foreach ($event_section as $singleEvent) : ?>
                        <a <?php if ($singleEvent['event_link']) :
                            ?>href="<?php echo $singleEvent['event_link']['url']; ?>" target="<?php echo $singleEvent['event_link']['target']; ?>"<?php
                           endif; ?> class="single_event">
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
    <?php else: $event_banner = get_field('event_banner'); ?>
        <div class="event_section banner" id="events">
            <div class="event_banner">
                <img src="<?php echo $event_banner['event_banner_image']['url']; ?>" class="event_banner_background">
                <div class="event_banner_content content_holder">
                    <h2><?php echo $event_banner['event_banner_headline']; ?></h2>
                    <p><?php echo $event_banner['event_banner_description']; ?></p>
                    <a href="<?php echo $event_banner['event_banner_button']['url']; ?>" target="<?php echo $event_banner['event_banner_button']['target']; ?>" class="button light"><?php echo $event_banner['event_banner_button']['title']; ?></a>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php
    $press_section = get_field('press_section');
    if ($press_section['title'] || $press_section['links']) : ?>
        <div class="sixth_section" id="news">
            <div class="content_holder">
                <div class="sixth_section_content">
                    <?php if ($press_section['title']) : ?>
                        <h2><?php echo $press_section['title']; ?></h2>
                    <?php endif; ?>

                    <?php if ($press_section['links']) : ?>
                        <ul>
                            <?php foreach ($press_section['links'] as $item) : ?>
                                <?php
                                $link = $item['link'];
                                $publisher = $item['publisher'];
                                $itemImage = $item['image']['url'];
                                if ($link) :
                                    $link_url = $link['url'];
                                    $link_title = $link['title'];
                                    $link_target = $link['target'] ? $link['target'] : '_self';
                                    ?>
                                    <li>
                                        <div class="image_holder">
                                          <img src="<?php echo $itemImage; ?>" alt="">  
                                        </div>
                                        <div class="info">
                                        <svg width="27px" height="28px" viewBox="0 0 27 28" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                            
                                            <g id="Desktop" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="square">
                                                <g id="Coalition" transform="translate(-123.000000, -2345.000000)" stroke="#fcf3dc" stroke-width="2.8">
                                                    <g id="In-The-News" transform="translate(0.000000, 2189.000000)">
                                                        <g id="Group-43" transform="translate(124.500000, 147.000000)">
                                                            <g id="Group-39" transform="translate(0.000000, 11.000000)">
                                                                <g id="Group-6" transform="translate(17.000000, 12.000000) rotate(-90.000000) translate(-17.000000, -12.000000) translate(5.000000, 5.500000)">
                                                                    <line x1="0.352941176" y1="0.361111111" x2="12.3529412" y2="12.6388889" id="Line"></line>
                                                                    <line x1="13.0196078" y1="12.6388889" x2="23.6862745" y2="0.361111111" id="Line-2"></line>
                                                                </g>
                                                                <line x1="23" y1="11.5" x2="0" y2="11.5" id="Line-12"></line>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                            <a href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
                                                <?php echo esc_html($link_title); ?>
                                                <span><?php echo $publisher; ?></span>
                                            </a>
                                        </div>
                                        
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
    if ($desc_section['title'] || $desc_section['description'] || $desc_section['list']) : ?>
        <div class="seventh_section" id="who_we_are">
            <div class="content_holder">
                <div class="seventh_section_content">
                    <?php if ($desc_section['title']) : ?>
                        <h2><?php echo $desc_section['title']; ?></h2>
                    <?php endif; ?>

                    <?php if ($desc_section['description'] || $desc_section['list_description']) : ?>
                        <p>
                            <?php echo $desc_section['description']; ?>
                            
                            <?php if ($desc_section['list_description']) : ?>
                                <span><?php echo $desc_section['list_description']; ?></span>
                            <?php endif; ?>
                        </p>
                    <?php endif; ?>
                                
                    <?php if ($desc_section['list']) : ?>
                        <div class="list_holder_opener">
                            <p>Organizations and Individuals</p>
                            <img src="<?php echo get_template_directory_uri(); ?>/images/dropdown.svg" alt="">
                        </div>
                        <div class="list_holder">
                            <ul>
                                <?php foreach ($desc_section['list'] as $item) : ?>
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