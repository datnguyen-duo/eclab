<?php
/* Template Name: Home */
get_header(); 

error_reporting(1);
$api_key = "78e7e43ff662bc958e6b869a9ea44307";
$form_id = "0256972e-f4ad-4a1f-985a-e8944d2f85ae";

$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 100);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('OSDI-API-Token: '.$api_key));

$api_request_url = "https://actionnetwork.org/api/v2/forms/{$form_id}/submissions/";
//$api_request_url .= "?".http_build_query($api_request_parameters);
curl_setopt($ch, CURLOPT_URL, $api_request_url);
$submissions = json_decode(curl_exec($ch));
$person_link = array();
foreach ($submissions->_embedded->{"osdi:submissions"} as $key => $value) {
    $single_link = $value->_links->{"osdi:person"}->href;
    if( !in_array($single_link, $person_link) ){
        array_push($person_link, $value->_links->{"osdi:person"}->href);
    }
}
$person_link = array_reverse($person_link);
?>
<div class="home_wrap">

    <?php $hero_section = get_field('hero_section'); ?>
    <div class="home_hero">
        <div class="home_hero_content">
            <div class="hero_description">
                <div class="hero_description_content">
                    <?php if( $hero_section['title'] ): ?>
                        <h1><? echo $hero_section['title']; ?></h1>
                    <?php endif; ?>

                    <?php if( $hero_section['description'] ): ?>
                        <p><? echo $hero_section['description']; ?></p>
                    <?php endif; ?>

                    <?php 
                    $link = $hero_section['button'];
                    if( $link ): 
                        $link_url = $link['url'];
                        $link_title = $link['title'];
                        $link_target = $link['target'] ? $link['target'] : '_self';
                        ?>
                        <a class="button light join_us" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
                            <?php echo esc_html( $link_title ); ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="image_holder">
                <?php if( $hero_section['image_text'] ): ?>
                    <div class="circle">
                        <p><?php echo $hero_section['image_text']; ?></p>
                    </div>
                <?php endif; ?>
                
                <?php if( $hero_section['image'] ): ?>
                    <img src="<?php echo $hero_section['image']['url']; ?>" alt="<?php echo $hero_section['image']['alt']; ?>">
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php 
    $banner_slides = get_field('banner_slides'); 
    if( $banner_slides ): ?>
        <div class="eclab_banner">
            <div class="banner">
                <div class="slides">
                    <?php foreach( $banner_slides as $slide ): ?>
                        <div class="slide">
                            <p><?php echo $slide['text']; ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php 
    $slider_section = get_field('slider_section'); 
    if( $slider_section['title'] || $slider_section['button'] || $slider_section['slider'] ): ?>
        <div class="first_section">
            <div class="content_holder">
                <div class="first_section_content">
                    <div class="left">
                        <div class="left_content">
                        <?php if( $slider_section['slider'] ): ?>
                            <div class="slider">
                                <?php foreach( $slider_section['slider'] as $slide ): ?>
                                    <div class="single_slide">
                                        <?php if( $slide['title'] ): ?>
                                            <h2><?php echo $slide['title']; ?></h2>
                                        <?php endif; ?>

                                        <?php if( $slide['description'] ): ?>
                                            <p><?php echo $slide['description']; ?></p>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        </div>
                        
                    </div>
                    <div class="right">
                        <div class="right_content">
                            <?php if( $slider_section['title'] ): ?>
                                <h3><?php echo $slider_section['title']; ?></h3>
                            <?php endif; ?>

                            <?php 
                            $link = $slider_section['button'];
                            if( $link ): 
                                $link_url = $link['url'];
                                $link_title = $link['title'];
                                $link_target = $link['target'] ? $link['target'] : '_self';
                                ?>
                                <div class="button_holder">
                                    <a class="button light join_us" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
                                        <?php echo esc_html( $link_title ); ?>
                                    </a>
                                </div>
                                
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    
    <?php $press_section_title = get_field('press_section_title'); $press_button = get_field('press_button'); ?>
    <div class="second_section">
        <div class="content_holder">
            <div class="second_section_content">
                <?php if( $press_section_title ): ?>
                    <h2><?php echo $press_section_title; ?></h2>
                <?php endif; ?>
                
                <div class="filter_wrap">
                    <p>
                        Stories from
                    </p>
                    <span></span>
                    <ul>
                        <li class="active" rel="families">
                            Families
                        </li>
                        <li rel="educators">
                            Early Educators
                        </li>
                        <li rel="providers">
                            Providers
                        </li>
                        <li rel="supporters">
                            Other Supporters
                        </li>
                    </ul>
                </div>
                <div class="stories_wrap">
                    <?php 
                    $count_family=0;
                    $count_edu=0;
                    $count_pro=0;
                    $count_sup=0;

                    foreach ($person_link as $key => $l) {
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($ch, CURLOPT_TIMEOUT, 100);
                        curl_setopt($ch, CURLOPT_HTTPHEADER, array('OSDI-API-Token: '.$api_key));
                        $api_request_url = $l;
                        //$api_request_url .= "?".http_build_query($api_request_parameters);
                        curl_setopt($ch, CURLOPT_URL, $api_request_url);
                        $response = curl_exec($ch);
                        $person_data = json_decode($response);
                        $custom_fields = $person_data->custom_fields;

                        $sotryUrl = str_replace(' ', '_', $custom_fields->storytile);
                        
                        $tags = $custom_fields->tag;
                        $tags_name ="";
                        if($tags){
                            $tags = explode(",", $tags);
                            foreach ($tags as $key => $value) {
                                $tags_name .="<span class='filter-tag' filter='".$value."'>".$value."</span><br>";
                            }
                        }

                        switch ($custom_fields->radio) {
                            case 'I’m a family member and/or caregiver':
                                $category = 'families';
                                $count_family++;
                                $display = 'block';
                                break;
                            case 'I’m an early childhood educator':
                                $category = 'educators';
                                $count_edu++;
                                $display = 'none';
                                break;
                            case 'I’m a provider':
                                $category = 'providers';
                                $count_pro++;
                                $display = 'none';
                                break;
                            case 'I’m a supporter':
                                $category = 'supporters';
                                $count_sup++;
                                $display = 'none';
                                break;
                        }
                        
                        if ( ($category == 'families' && $count_family <= 4) || ($category == 'educators' && $count_edu <= 4) ||
                        ($category == 'providers' && $count_pro <= 4) || ($category == 'supporters' && $count_sup <= 4) ) { 
                        echo '<a class="single_story_holder '.$category.'" rel="'.$category.'" tag="'.$custom_fields->tag.'" style="display: '.$display.';" data-url="'. $sotryUrl .'">
                                <div class="single_story_wrap ">
                                    <div class="single_story">
                                        <div class="image_holder">
                                            <img class="story_image" src="'.($custom_fields->base64_img? $custom_fields->base64_img: get_template_directory_uri()."/images/single_story.jpg").'" alt="">
                                        </div>
                                        <div class="post_info">
                                            <h3 class="story_title">
                                                '.$custom_fields->storytile.'
                                            </h3>
                                            <p class="story_author">
                                                By '.$custom_fields->fname.' '.$custom_fields->lname.' 
                                            </p>
                                            <div class="separator"></div>
                                            <div class="category">
                                                '.ucfirst($category).'
                                            </div>
                                            <div class="story_content" hidden>'.$custom_fields->story.'</div>
                                            <div class="story_tags" hidden>'.$tags_name.'</div>
                                        </div>
                                    </div>
                                </div>
                            </a>';
                        curl_close($ch);
                        }
                    }
                    ?>
                </div>
                <?php if( $press_button ): ?>
                    <div class="button_holder">
                        <a href="<?php echo $press_button['url']; ?>" target="<?php echo $press_button['target']; ?>" class="button light">
                            <?php echo $press_button['title']; ?>
                        </a>
                    </div>    
                <?php endif; ?>
                
            </div>
        </div>
    </div>

    <?php 
    $img_with_desc_section = get_field('image_with_description_section'); 
    if( $img_with_desc_section['title'] || $img_with_desc_section['description'] || $img_with_desc_section['button'] || $img_with_desc_section['image'] ): ?>
        <div class="third_section" id="tell_story">
            <div class="content_holder">
                <?php if( $img_with_desc_section['title'] ): ?>
                    <h2><?php echo $img_with_desc_section['title']; ?></h2>
                <?php endif; ?>
                <form id="tn-form" class="form_swiper">
                    <div class="third_section_content sinlge_box">
                    
                        <div class="left">
                            <?php if( $img_with_desc_section['description'] ): ?>
                                <p><?php echo $img_with_desc_section['description']; ?></p>
                            <?php endif; ?>

                            <?php 
                            $link = $img_with_desc_section['button'];
                            if( $link ): 
                                $link_url = $link['url'];
                                $link_title = $link['title'];
                                $link_target = $link['target'] ? $link['target'] : '_self';
                                ?>
                                <a class="button dark next_slide desktop" target="<?php echo esc_attr( $link_target ); ?>">
                                    <?php echo esc_html( $link_title ); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                        <div class="right">
                            <?php if( $img_with_desc_section['image'] ): ?>
                                <div class="image_holder">
                                    <img src="<?php echo $img_with_desc_section['image']['url']; ?>" alt="<?php echo $img_with_desc_section['image']['alt']; ?>">
                                </div>
                            <?php endif; ?>
                            
                            <?php if( $img_with_desc_section['image_text'] ): ?>
                                <div class="sticker"><?php echo $img_with_desc_section['image_text']; ?></div>
                            <?php endif; ?>

                            <?php 
                            $link = $img_with_desc_section['button'];
                            if( $link ): 
                                $link_url = $link['url'];
                                $link_title = $link['title'];
                                $link_target = $link['target'] ? $link['target'] : '_self';
                                ?>
                                <div class="button_holder">
                                <a class="button dark next_slide mobile" target="<?php echo esc_attr( $link_target ); ?>">
                                    <?php echo esc_html( $link_title ); ?>
                                </a>
                                </div>
                                
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="third_section_content sinlge_box">
                        <div class="single_question">
                            <p class="question">What perspective do you bring to the issue?</p>
                            <div class="checkbox_wrap">
                                <div class="single_checkbox">
                                    <input type="radio" id="check_1" name="radio" value="I’m a family member and/or caregiver">
                                    <label for="check_1">
                                    I’m a family member and/or caregiver
                                    </label>
                                </div>
                                <div class="single_checkbox">
                                    <input type="radio" id="check_2" name="radio" value="I’m an early childhood educator">
                                    <label for="check_2">
                                    I’m an early childhood educator
                                    </label>
                                </div>
                                <div class="single_checkbox">
                                    <input type="radio" id="check_3" name="radio" value="I’m a provider">
                                    <label for="check_3">
                                    I’m a provider
                                    </label>
                                </div>
                                <div class="single_checkbox">
                                    <input type="radio" id="check_4" name="radio" value="I’m a supporter">
                                    <label for="check_4">
                                    I’m a supporter
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="single_question last">
                            <p class="question">What’s your Illinois Zipcode?</p>
                            <div class="input_wrap">
                                <input type="text" placeholder="Enter your Zipcode" name="zipcode">
                            </div>
                        </div>
                    </div>
                    <div class="third_section_content sinlge_box">
                        <div class="single_question">
                            <p class="question">Tell us about your experience with early childhood education in Illinois. What would you like to share?</p>
                            <div class="checkbox_wrap">
                                <div class="single_checkbox">
                                    <input type="radio" id="check1" name="radios" value="challenges">
                                    <label for="check1">
                                    Challenges I’ve faced
                                    </label>
                                </div>
                                <div class="single_checkbox">
                                    <input type="radio" id="check2" name="radios" value="successes">
                                    <label for="check2">
                                    My child and/or family’s successes
                                    </label>
                                </div>
                                <div class="single_checkbox">
                                    <input type="radio" id="check3" name="radios" value="thank">
                                    <label for="check3">
                                    Thank an early educator
                                    </label>
                                </div>
                                <div class="single_checkbox">
                                    <input type="radio" id="check4" name="radios" value="share">
                                    <label for="check4">
                                    Share my dreams and hope for this moment
                                    </label>
                                </div>
                                <div class="single_checkbox">
                                    <input type="radio" id="check5" name="radios" value="other">
                                    <label for="check5">
                                    Other
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="single_question last select_input">
                            <p class="question">Please specify.</p>
                            <div class="input_wrap select-wrapper">
                                <select name="" class="specify_select">
                                    <option value="Affordability">Affordability</option>
                                    <option value="Access">Access</option>
                                    <option value="Quality">Quality</option>
                                    <option value="Equity">Equity</option>
                                    <option value="Consistency">Consistency</option>
                                    <option value="Other">Other</option>
                                </select>
                                <!-- <input type="text" placeholder="Choose your topic" name="topic"> -->
                            </div>
                        </div>
                    </div>
                    <div class="third_section_content sinlge_box">
                        <div class="two_question_wrap">
                            <div class="single_question">
                                <p class="question">Share as much as you are comfortable</p>
                                <textarea name="story" id="story" cols="30" rows="10" placeholder="Tell your story…"></textarea>
                                <span>0 / 200 words</span>

                            </div>
                            <div class="single_question last">
                                <p class="question">Title your story</p>
                                <textarea name="storytile" id="storytile" cols="30" rows="6" placeholder="Name your story…"></textarea>
                                <span>0 / 10 words</span>
                            </div>
                        </div>
                        
                    </div>
                    <div class="third_section_content sinlge_box">
                        <div class="two_columns">
                            <div class="single_column">
                                <p class="question">Have a photo to pair with your story? You may upload it now.</p>
                                <div class="image-upload-wrap">
                                    <input class="file-upload-input" name="photo" id="photo" type='file' accept="image/*" />
                                    <input type="hidden" id="base64_img" name="base64_img" value="">
                                    <div class="drag-text">
                                    <h3>Click here to add a photo (supported file types: JPG, PNG)</h3>
                                    </div>
                                </div>
                                <div class="file-upload-content">
                                    <img class="file-upload-image" src="#" alt="your image" />
                                    <div class="image-title-wrap">
                                    <button type="button" class="remove-image">Remove <span class="image-title">Uploaded Image</span></button>
                                    </div>
                                </div>
                            </div>
                            <div class="single_column">
                                <!-- <div class="single_question">
                                <p class="question">Tag your story</p>
                                <input type="text" id="tags" name="tags">
                                </div> -->
                                
                            </div>
                        </div>
                        
                    </div>

                    <div class="third_section_content sinlge_box">
                        <p class="question">Please enter your name, email, and zip code. This information allows us to contact you if we have questions about your story.</p>
                        <div class="single_question last">
                            <div class="form_holder">
                                <input name="fname" type="text" placeholder="First name" class="half">
                                <input name="lname" type="text" placeholder="Last name" class="half">
                                <input name="email" type="email" placeholder="Email Address">
                                <input name="phonenumber" type="text" placeholder="Phone" class="half">
                                <input name="zipcode" type="text" placeholder="Zip Code" class="half">
                            </div>
                        </div>
                    </div>
                    <div class="third_section_content sinlge_box">
                        <p class="question">By submitting your story and/or photo you acknowledge that you’ve read our privacy policy and are ok with being contacted further from our coalition partners. Thank you!</p>
                        <div class="single_question last">
                            <div class="privacy_box">
                                <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                </p>
                            </div>
                            <div class="bottom_section">
                                <div class="custom_checkobxes">
                                    <div class="single_box_wrap">
                                        <label class="container">
                                            <input type="checkbox" name="checkbox1" value="disclaimer">
                                            <span class="checkmark"></span>
                                            I have read the disclaimer in its entirety.
                                        </label>
                                    </div>
                                    <div class="single_box_wrap">
                                        <label class="container">
                                            <input type="checkbox" name="checkbox" value="agree">
                                            <span class="checkmark"></span>
                                            I agree to receive email updates from Right to Care, a We the Village campaign. I understand I may unsubscribe at any time.
                                        </label>
                                    </div>
                                </div>
                                <button class="button dark submit_button" id="home_submit_button">
                                    SUBMIT
                                </button>
                            </div>
                            
                        </div>
                    </div>
                    <div class="third_section_content thankyou_message">
                    
                        <div class="left">
                            <p>All Done!</p>
                            <div class="message">
                                Thank you for sharing your story
                            </div>
                        </div>
                        <div class="right">
                            <?php if( $img_with_desc_section['image'] ): ?>
                                <div class="image_holder">
                                    <img src="<?php echo $img_with_desc_section['image']['url']; ?>" alt="<?php echo $img_with_desc_section['image']['alt']; ?>">
                                </div>
                            <?php endif; ?>
                            
                            <?php if( $img_with_desc_section['image_text'] ): ?>
                                <div class="sticker"><?php echo $img_with_desc_section['image_text']; ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </form>
                    
            </div>
        </div>
    <?php endif; ?>

    <?php 
    $files_section = get_field('files_section'); 
    if( $files_section['title'] || $files_section['description'] || $files_section['graphics_title'] || $files_section['graphics'] || $files_section['documents_title'] || $files_section['documents'] ): ?>
        <div class="fourth_section" id="fourth_section">
            <div class="content_holder" id="get-involved">
                <div class="fourth_section_content">
                    <?php if( $files_section['title'] ):?>
                        <h2><?php echo $files_section['title']; ?></h2>
                    <?php endif; ?>

                    <?php if( $files_section['description'] ):?>
                        <p><?php echo $files_section['description']; ?></p>
                    <?php endif; ?>

                    <?php if( $files_section['graphics_title'] ):?>
                        <h3><?php echo $files_section['graphics_title']; ?></h3>
                    <?php endif; ?>
                        
                    <?php if( $files_section['graphics'] ): ?>
                        <div class="graphics_holder">
                            <?php foreach( $files_section['graphics'] as $graphic ): ?>
                                <a href="<?php echo $graphic['image']['url']; ?>" target="_blank" class="single_graphic">
                                    <div class="image_holder">
                                        <img src="<?php echo $graphic['image']['url']; ?>" alt="<?php echo $graphic['image']['alt']; ?>">
                                    </div>
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/download_arrow.svg" alt="" class="download_icon">
                                </a>
                                
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <?php if( $files_section['documents_title'] ):?>
                        <h3><?php echo $files_section['documents_title']; ?></h3>
                    <?php endif; ?>

                    <?php if( $files_section['documents'] ): ?>
                        <div class="document_holder">
                            <?php foreach( $files_section['documents'] as $documents ): ?>
                                <a href="<?php echo $documents['file']['url']; ?>" download class="single_document_wrap">
                                    <div class="single_document">
                                        <?php if( $documents['title'] ): ?>
                                            <h4><?php echo $documents['title']; ?></h4>
                                        <?php endif; ?>
                                    </div>
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/download_arrow.svg" alt="">
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php 
    $banner_section = get_field('banner_section'); 
    if( $banner_section['title'] || $banner_section['button'] ): ?>
        <div class="call_to_action">
            <img src="<?php echo get_template_directory_uri(); ?>/images/triangle_shape.svg" alt="" class="shape desktop">
            <img src="<?php echo get_template_directory_uri(); ?>/images/triangle_shape.svg" alt="" class="shape second desktop">

            <img src="<?php echo get_template_directory_uri(); ?>/images/triangle_mobile_left.svg" alt="" class="shape mobile">
            <img src="<?php echo get_template_directory_uri(); ?>/images/triangle_mobile_right.svg" alt="" class="shape second mobile">
            <div class="call_to_action_content">
                <?php if( $banner_section['title'] ): ?>
                    <h2><?php echo $banner_section['title']; ?></h2>
                <?php endif;?>

                <?php 
                $link = $banner_section['button'];
                if( $link ): 
                    $link_url = $link['url'];
                    $link_title = $link['title'];
                    $link_target = $link['target'] ? $link['target'] : '_self';
                    ?>
                    <a class="button light join_us" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
                        <?php echo esc_html( $link_title ); ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
    <?php 
        $social_secton_headline = get_field('social_secton_headline');
        $social_secton_shortcode = get_field('social_secton_shortcode');
    ?>

    <?php if( $social_secton_headline || $social_secton_shortcode ): ?>
        <div class="social_section">
            <div class="content_holder">
                <div class="social_secton_content">
                <?php if( $social_secton_headline ): ?>
                    <h2><?php echo $social_secton_headline; ?></h2>
                <?php endif;?>
                <?php if( $social_secton_shortcode ): ?>
                    <?php echo $social_secton_shortcode; ?>
                <?php endif;?>
                    <!-- <div class="embedsocial-hashtag" data-ref="446a0090d8f1d6fbd3a40d3c1461d057d2d76a16" ></div><script>(function(d, s, id){var js; if (d.getElementById(id)) {return;} js = d.createElement(s); js.id = id; js.src = "https://embedsocial.com/cdn/ht.js"; d.getElementsByTagName("head")[0].appendChild(js);}(document, "script", "EmbedSocialHashtagScript"));</script> -->
                </div>
            </div>
        </div>
    <?php endif; ?>
    
    
</div>
<script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script>
    (function ($) {
        function readURL(input) {
            if (input.files && input.files[0]) {
            
                var reader = new FileReader();
            
                reader.onload = function(e) {
                $('.image-upload-wrap').hide();
            
                $('.file-upload-image').attr('src', e.target.result);
                $('.file-upload-content').show();
            
                $('.image-title').html(input.files[0].name);
                };
            
                reader.readAsDataURL(input.files[0]);
            
            } else {
                removeUpload();
            }
        }
        
        function removeUpload() {
            $('.file-upload-input').replaceWith($('.file-upload-input').clone());
            $('.file-upload-content').hide();
            $('.image-upload-wrap').show();
        }

        $('.image-upload-wrap').bind('dragover', function () {
            $('.image-upload-wrap').addClass('image-dropping');
        });

        $('.image-upload-wrap').bind('dragleave', function () {
            $('.image-upload-wrap').removeClass('image-dropping');
        });

        $(".file-upload-input").change(function() {
            readURL(this);
        });

        $(".remove-image").click(function() {
            removeUpload();
        });
    })(jQuery);
</script>

<script>
(function ($) {
    $(document).ready(function () {
        let stories = $('.single_story_holder');
        stories = stories.filter('[rel="families"]');
        $(document).on('click', '.filter_wrap li', function(e){
         stories = $('.single_story_holder');
          if($(this).attr('rel')) {
              stories.hide().filter('[rel="' + $(this).attr('rel') + '"]').show();
              stories = stories.filter('[rel="' + $(this).attr('rel') + '"]')
          } else {
              stories.show();
          }
          
          return false;
        });

        var clicked = false;
        var newUrl;

        var url_string = window.location.href; //window.location.href
        var url = new URL(url_string);
        var paramValue = url.searchParams.get("story");
        console.log(paramValue);
        if (paramValue) {
            $(".single_story_holder").each(function(index) {
                if ($(this).data('url') == paramValue) {
                    $(this).trigger('click');
                }
            });
        }

        $(".single_story_holder").on("click", function (event) {
            let story_content = $(this).find(".story_content").text();
            let story_title = $(this).find(".story_title").text();
            let story_img = $(this).find('.story_image').attr("src");
            let story_author = $(this).find('.story_author').text();
            let category = $(this).find(".category").text();
            let popup = $(".single_news_popup");
            let tags = $(this).find(".story_tags").html();
            popup.find('h2').text(story_title);
            popup.find('.author').text(story_author);
            popup.find('.image_holder img').attr('src',story_img);
            popup.find('.news_content .left p').text(story_content);
            popup.find('.category').text(category);
            popup.find(".tags").html(tags);

            var currentUrl = $(this).data('url');
            newUrl = '?story=' + currentUrl + '';
            window.history.pushState("", "", newUrl);

            var shareFacebookUrl = 'https://www.facebook.com/sharer/sharer.php?u=' + window.location.href + '&t=' + story_title
            var shareTwitterUrl = 'https://twitter.com/share?url=' + window.location.href + '&text=' + story_title
            var shareLinkedinUrl = 'http://www.linkedin.com/shareArticle?mini=true&url=' + window.location.href

            popup.find('.facebook').attr('href', shareFacebookUrl);
            popup.find('.twitter').attr('href', shareTwitterUrl);
            // popup.find('.linkedin').attr('href', shareLinkedinUrl);
    
            $(".single_news_popup").fadeIn();
            $("body").addClass("no_scroll");
        });

        var counter;

    

        stories.on("click", function (event) {

          let story_content = $(this).find(".story_content").text();

          let story_title = $(this).find(".story_title").text();

          let story_img = $(this).find(".story_image").attr("src");

          let story_author = $(this).find(".story_author").text();

          let category = $(this).find(".category").text();
          let tags = $(this).find(".story_tags").html();

          let popup = $(".single_news_popup");



          counter = $(this).index();


          popup.find("h2").text(story_title);

          popup.find(".author").text(story_author);

          popup.find(".image_holder img").attr("src", story_img);

          popup.find(".news_content .left p").text(story_content);

          popup.find(".category").text(category);
          popup.find(".tags").html(tags);

          $(".single_news_popup").fadeIn();

          $("body").addClass("no_scroll");

        });

        

        $('.plus-slides').click(function(e){

          let step = parseInt($(this).attr('step'));

          console.log(counter);

          counter = parseInt(counter)+step;

          // console.log(stories.length);

          if( counter > (stories.length -1) ){

            console.log(counter);

            counter = stories.length - counter;

            console.log(counter);

          }

          if( counter < 0 ){

            counter = stories.length + counter;

          }

         

          let plusSlide = stories[counter];

          // console.log(plusSlide);

          let story_content = $(plusSlide).find(".story_content").text();

          let story_title = $(plusSlide).find(".story_title").text();

          let story_img = $(plusSlide).find(".story_image").attr("src");

          let story_author = $(plusSlide).find(".story_author").text();

          let category = $(plusSlide).find(".category").text();
          let tags = $(plusSlide).find(".story_tags").html();

          let popup = $(".single_news_popup");

          popup.find("h2").text(story_title);

          popup.find(".author").text(story_author);

          popup.find(".image_holder img").attr("src", story_img);

          popup.find(".news_content .left p").text(story_content);

          popup.find(".category").text(category);
          popup.find(".tags").html(tags);

        });
    })
})(jQuery);
var admin_ajax_url = '<?php echo admin_url('admin-ajax.php'); ?>';
</script>
<script type="text/javascript">
function readFile() {
  var ele = this;
  if (ele.files && ele.files[0]) {
    var _URL = window.URL || window.webkitURL;
    var FR= new FileReader();
    var file = ele.files[0];
    var img = new Image();
    var objectUrl = _URL.createObjectURL(file);

    FR.addEventListener("load", function(e) {
      img.addEventListener("load", function () {
          // if (this.width > 500 || this.height > 500) {
          //   alert("Width and Height must not exceed 300px");
          //   ele.value = "";
          // } else {
            document.getElementById("base64_img").value = e.target.result;
          // }
      });
      img.src = objectUrl;
    }); 
    FR.readAsDataURL(file);
    
  }
} 
document.getElementById("photo").addEventListener("change", readFile);
</script>
<?php
get_footer(); ?>