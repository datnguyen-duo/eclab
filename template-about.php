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
                    <?php if($desc_section['title']): ?>
                        <h2><?php echo $desc_section['title']; ?></h2>
                    <?php endif; ?>
                    <?php if($desc_section['description']): ?>
                        <?php echo $desc_section['description']; ?>
                    <?php endif; ?>
                </div>
                <?php if($desc_section['timeline']): ?>
                    <div class="timeline_holder">
                        <div class="timeline">
                            <?php foreach ($desc_section['timeline'] as $singleYear) : ?>
                                <div class="single_year">
                                    <div class="year">
                                        <span>
                                            <?php echo $singleYear['year']; ?>
                                        </span>
                                        <div class="circle"></div>
                                    </div>

                                    <div class="description">
                                        <p>
                                            <?php echo $singleYear['year_description']; ?>
                                        </p>
                                    </div>

                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
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
    <div class="third_section" id="inquire">
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
                        <?php $about_form_fields = get_field('about_form_fields', get_pll_option_page()); ?>
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
                                <?php echo $about_form_fields['form_button_about']; ?>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>



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
                <!-- <img src="<?php echo $event_banner['event_banner_image']['url']; ?>" class="event_banner_background"> -->
                <img src="<?php echo get_template_directory_uri(); ?>/images/triangle_shape_about.svg" alt="" class="shape desktop">
                <img src="<?php echo get_template_directory_uri(); ?>/images/triangle_shape_about.svg" alt="" class="shape second desktop"> 

                <img src="<?php echo get_template_directory_uri(); ?>/images/triangle_mobile_left_about.svg" alt="" class="shape mobile">
                <img src="<?php echo get_template_directory_uri(); ?>/images/triangle_mobile_right_about.svg" alt="" class="shape second mobile">

                <div class="event_banner_content content_holder">
                    <h2><?php echo $event_banner['event_banner_headline']; ?></h2>
                    <p><?php echo $event_banner['event_banner_description']; ?></p>
                    <a href="<?php echo $event_banner['event_banner_button']['url']; ?>" target="<?php echo $event_banner['event_banner_button']['target']; ?>" class="button light join_us"><?php echo $event_banner['event_banner_button']['title']; ?></a>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php
    $press_section = get_field('press_section');
    if ($press_section['title']) : ?>
        <div class="sixth_section" id="news">
            <div class="content_holder">
                <div class="sixth_section_content">
                    <div class="header_wrapper">
                        <?php if ($press_section['title']) : ?>
                            <h2><?php echo $press_section['title']; ?></h2>
                        <?php endif; ?>

                        <?php if ($press_section['media_repeater']) : ?>
                            <div class="anchor_wrapper">
                                <div class="inner">
                                    <span><?php if ($press_section['anchor_label']) {echo $press_section['anchor_label']; } ?></span>
                                    <?php foreach ($press_section['media_repeater'] as $item) : 
                                        $media_type = $item['media_type'];?>
                                        <a href="#<?php echo str_replace(' ', '-', strtolower($media_type)); ?>"><?php echo $media_type; ?></a>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php if ($press_section['media_repeater']) : ?>
                        <ul>                        
                            <?php foreach ($press_section['media_repeater'] as $item) : ?>
                                <?php
                                // $link = $item['link'];
                                // $publisher = $item['publisher'];
                                // $itemImage = $item['image']['url'];
                                $media_type = $item['media_type'];
                                $links = $item['links'];
                               ?>
                                    <h3 id="<?php echo str_replace(' ', '-', strtolower($media_type)); ?>"><?php echo $media_type; ?></h3>
                                    <?php 

                                        $repeater = $links;
                                        $order = array();

                                        foreach ( $repeater as $i => $row ) {
	
                                            $order[ $i ] = strtotime($row['date']);
                                            
                                        }

                                        array_multisort( $order, SORT_DESC, $repeater );
                                        // var_dump($order);

                                        foreach ($repeater as $i => $row) :
                                        $link = $row['link'];
                                        // $publisher = $item['publisher'];
                                        // $itemImage = $item['image']['url']; 

                                        if ($link) :
                                            $link_url = $link['url'];
                                            $link_title = $link['title'];
                                            $link_target = $link['target'] ? $link['target'] : '_self';
                                        ?>
                                        <?php endif; ?>
                                        
                                        <a href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">

                                        <?php if ($row['image']): ?>
                                            <div class="image_holder">
                                                <img src="<?php echo $row['image']['url']; ?>" alt="<?php echo $row['image']['alt']?>">  
                                            </div>
                                        <?php endif; ?>

                                        <div class="info">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="65.699" height="27.288" viewBox="0 0 65.699 27.288">
                                            <g id="Desktop" transform="translate(39.081 -0.339)">
                                                <g id="Coalition" transform="translate(-123 -2345)">
                                                <g id="In-The-News" transform="translate(0 2189)">
                                                    <g id="Group-43" transform="translate(124.5 147)">
                                                    <g id="Group-39" transform="translate(0 11)">
                                                        <g id="Group-6" transform="translate(10.5 24) rotate(-90)">
                                                        <line id="Line" x2="12" y2="12.278" transform="translate(0.353 0.361)" fill="none" stroke="#fcf3dc" stroke-linecap="square" stroke-width="2.8"/>
                                                        <line id="Line-2" y1="12.278" x2="10.667" transform="translate(13.02 0.361)" fill="none" stroke="#fcf3dc" stroke-linecap="square" stroke-width="2.8"/>
                                                        </g>
                                                        <line id="Line-12" x1="61" transform="translate(-39.181 11.5)" fill="none" stroke="#fcf3dc" stroke-linecap="square" stroke-width="2.8"/>
                                                    </g>
                                                    </g>
                                                </g>
                                                </g>
                                            </g>
                                            </svg>
                                            <div class="inner">
                                                <?php echo esc_html($link_title); ?>
                                                <?php if ($row['publisher']): ?>
                                                    <span><?php echo $row['publisher']; ?></span>
                                                <?php endif; ?>
                                                <?php if ($row['date']): ?>
                                                    <span><?php echo $row['date']; ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        </a>
                                    <?php endforeach; ?>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                    <?php if ($press_section['media_repeater']) : ?>
                        <div class="anchor_wrapper">
                            <div class="inner">
                                <span><?php if ($press_section['anchor_label']) {echo $press_section['anchor_label']; } ?></span>
                                <?php foreach ($press_section['media_repeater'] as $item) : 
                                    $media_type = $item['media_type'];?>
                                    <a href="#<?php echo str_replace(' ', '-', strtolower($media_type)); ?>"><?php echo $media_type; ?></a>
                                <?php endforeach; ?>
                            </div>
                        </div>
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