<?php
/* Template Name: Landing */
get_header();

?>
<style type="text/css">
    #tn-icon-hagtag {
        position: absolute;
        z-index: 9999;
        font-size: 26px;
        font-weight: bold;
        padding: 11px 0 0 16px;
    }
    .inputTags-field {
        padding-left: 30px!important;
    }
    div.error {
        width: 100%;
        color: red;
        margin-bottom: 5px;
    }
    input.error {
        margin-bottom: 10px!important;
    }
    button#home_submit_button[disabled] {
        opacity: 0.5;
        cursor: no-drop;
    }
</style>
<div class="home_wrap landing_page_wrap page_container">
    <?php $hero_section = get_field('hero_section'); ?>
    <div class="first_section_landing">
        <div class="first_section_landing_content content_holder">
            <div class="left">
                <?php if($hero_section['title']): ?>
                    <div class="title_holder">
                        <h1>
                            <?php echo $hero_section['title']; ?>
                        </h1>

                        <div class="shark_holder">
                            <?php if($hero_section['image']): ?>
                                <img src="<?php echo $hero_section['image']['url']; ?>" class="hero_shark st__img">
                                <!-- <img src="<?php echo get_template_directory_uri(); ?>/images/green_arrow.svg" class="green_arrow st__img"> -->
                            <?php endif; ?>
    
                            <?php if($hero_section['small_text_1']): ?>
                                <span class="first st__img"><?php echo $hero_section['small_text_1']; ?></span>
                            <?php endif; ?>
                            <?php if($hero_section['small_text_2']): ?>
                                <span class="second st__img"><?php echo $hero_section['small_text_2']; ?></span>
                            <?php endif; ?>
                            <?php if($hero_section['small_text_3']): ?>
                                <span class="third st__img"><?php echo $hero_section['small_text_3']; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if($hero_section['description']): ?>
                    <p>
                        <?php echo $hero_section['description']; ?>
                    </p>
                <?php endif; ?>

                <div class="form_holder st__img">
                    
                    <form id="community_signup" >
                    <?php $footer_form_fields = get_field('footer_form_fields', get_pll_option_page()); ?>
                        <div class="thank_you_message">
                            <p>
                            <?php echo $footer_form_fields['thank_you_message']; ?>
                            </p>
                        </div>
                        
                        <input type="text" name="fname" id="first_name" placeholder="<?php echo $footer_form_fields['first_name']; ?>" required>
                        <input type="text" name="lname" id="last_name" placeholder="<?php echo $footer_form_fields['last_name']; ?>" required>
                        <input type="email" name="email" id="email" placeholder="<?php echo $footer_form_fields['email_address']; ?>" required>
                        <input type="text" name="zipcode" id="zipcode" placeholder="<?php echo $footer_form_fields['zip_code']; ?>" required>
                        <div class="bottom_wrap">
                            <label class="container">I’d like someone to contact me about getting more involved in structuring policy, advocacy, and care in IL
                                <input type="checkbox">
                                <span class="checkmark"></span>
                            </label>
                            <button class="button light" id="signup_btn" type="button" name="signup_btn">
                                <!-- <?php echo $footer_form_fields['form_button']; ?> -->
                                SIGN ME UP
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="right">
                <?php if($hero_section['image']): ?>
                    <img src="<?php echo $hero_section['image']['url']; ?>" class="hero_shark st__img">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/green_arrow.svg" class="green_arrow st__img">
                <?php endif; ?>

                <?php if($hero_section['small_text_1']): ?>
                    <span class="first st__img"><?php echo $hero_section['small_text_1']; ?></span>
                <?php endif; ?>
                <?php if($hero_section['small_text_2']): ?>
                    <span class="second st__img"><?php echo $hero_section['small_text_2']; ?></span>
                <?php endif; ?>
                <?php if($hero_section['small_text_3']): ?>
                    <span class="third st__img"><?php echo $hero_section['small_text_3']; ?></span>
                <?php endif; ?>

                <?php if($hero_section['image_text']): ?>
                    <p>
                        <?php echo $hero_section['image_text']; ?>
                    </p>
                <?php endif; ?>
                
            </div>
        </div>
        
    </div>

    <div class="second_section_landing">
        <?php $stories_section = get_field('stories_section'); ?>
        
        <div class="second_section_landing_content content_holder">
            <?php if($stories_section['stories_section_headline']): ?>
                <h2>
                    <?php echo $stories_section['stories_section_headline']; ?>
                </h2>
            <?php endif; ?>

            <?php if($stories_section['stories_section_description']): ?>
                <p>
                    <?php echo $stories_section['stories_section_description']; ?>
                </p>
            <?php endif; ?>

            <div class="second_section_inner">
                <div class="left">
                    <div class="image_holder">
                        <img src="<?php echo $stories_section['stories'][0]['story_image']['url'] ?>">
                    </div>
                </div>

                <div class="right">
                    <h2>
                        <?php echo $stories_section['stories'][0]['story_headline']; ?>
                    </h2>
                    <p>
                        <?php echo $stories_section['stories'][0]['story_description']; ?>
                    </p>

                    <blockquote>
                        <?php echo $stories_section['stories'][0]['story_quote']; ?>
                    </blockquote>

                    <div class="author">
                        <?php echo $stories_section['stories'][0]['story_author']; ?>
                    </div>
                </div>
            </div>
            <div class="divider"></div>
            <div class="all_stories">
                
                <img src="<?php echo get_template_directory_uri(); ?>/images/prev_white_arrow.svg" class="prev_arrow">
                <img src="<?php echo get_template_directory_uri(); ?>/images/next_white_arrow.svg" class="next_arrow">
                <div class="all_stories_wrap">
                    <?php 
                        $i = 0;
                        $len = count($stories_section['stories']);
                    ?>
                    <?php foreach ($stories_section['stories'] as $singleStory): ?>

                        <div class="image_holder_wrap<?php if($i == 0): ?> active<?php endif; ?>" data-headline="<?php echo $singleStory['story_headline'] ?>" data-description="<?php echo $singleStory['story_description'] ?>" data-quote="<?php echo $singleStory['story_quote'] ?>" data-author="<?php echo $singleStory['story_author'] ?>" data-image="<?php echo $singleStory['story_image']['url'] ?>">
                            <h3><?php echo $singleStory['stories_hover_image_label'] ?></h3>
                            <div class="image_holder">
                                <img src="<?php echo $singleStory['story_image_thumbnail']['url'] ?>">
                            </div>
                        </div>
                    <?php $i++; endforeach; ?>
                </div>
                <a href="<?php echo $stories_section['stories_section_button']['url']; ?>" target="<?php echo $stories_section['stories_section_button']['target']; ?>">
                    <?php echo $stories_section['stories_section_button']['title']; ?>
                    
                    <img src="<?php echo get_template_directory_uri(); ?>/images/arrow_right_white.svg">
                    
                </a>
            </div>
        </div>
    </div>

    <?php
    $img_with_desc_section = get_field('image_with_description_section');
    if ($img_with_desc_section['title'] || $img_with_desc_section['description'] || $img_with_desc_section['button'] || $img_with_desc_section['image']) : ?>
        <div class="third_section" id="tell_story">
            <div class="content_holder">
                <div class="arrow_hidden"></div>
                <?php if ($img_with_desc_section['title']) : ?>
                    <h2><?php echo $img_with_desc_section['title']; ?></h2>
                <?php endif; ?>
                <form id="tn-form" class="form_swiper">
                    <div class="third_section_content sinlge_box">
                    
                        <div class="left">
                            <?php if ($img_with_desc_section['description']) : ?>
                                <p><?php echo $img_with_desc_section['description']; ?></p>
                            <?php endif; ?>

                            <?php
                            $link = $img_with_desc_section['button'];
                            if ($link) :
                                $link_url = $link['url'];
                                $link_title = $link['title'];
                                $link_target = $link['target'] ? $link['target'] : '_self';
                                ?>
                                <a class="button dark next_slide desktop" target="<?php echo esc_attr($link_target); ?>">
                                    <?php echo esc_html($link_title); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                        <div class="right">
                            <?php if ($img_with_desc_section['image']) : ?>
                                <div class="image_holder st__img">
                                    <img src="<?php echo $img_with_desc_section['image']['url'] ?>">
                                </div>
                            <?php endif; ?>
                            
                            <?php if ($img_with_desc_section['image_text']) : ?>
                                <div class="sticker"><?php echo $img_with_desc_section['image_text']; ?></div>
                            <?php endif; ?>

                            <?php
                            $link = $img_with_desc_section['button'];
                            if ($link) :
                                $link_url = $link['url'];
                                $link_title = $link['title'];
                                $link_target = $link['target'] ? $link['target'] : '_self';
                                ?>
                                <div class="button_holder">
                                <a class="button dark next_slide mobile" target="<?php echo esc_attr($link_target); ?>">
                                    <?php echo esc_html($link_title); ?>
                                </a>
                                </div>
                                
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- FIRST SLIDE -->
                    <?php $first_slide = get_field('first_slide', get_pll_option_page()) ?>
                    <div class="third_section_content sinlge_box">
                        <div class="single_question">
                            <p class="question"><?php echo $first_slide['headline_2']; ?></p>
                            <div class="input_wrap">
                                <input type="text" placeholder="<?php echo $first_slide['enter_your_zip_code']; ?>" name="zipcode1" <?php echo ($first_slide['required_display_name']) ? 'required' : null; ?>>
                            </div>
                        </div>
                        <div class="single_question last">
                            <p class="question"><?php echo $first_slide['headline_1']; ?></p>
                            <div class="checkbox_wrap">
                                <div class="single_checkbox checkbox_with_question" data-questions="<?php echo $first_slide['perspective_additional_description_1'] ?>">
                                    <input type="radio" id="check_1" name="radio" value="I’m a family member and/or caregiver" <?php echo ($first_slide['perspectives_required']) ? 'required' : null; ?>>
                                    <label for="check_1">
                                    <?php echo $first_slide['perspective_1']; ?>
                                    </label>
                                </div>
                                <div class="single_checkbox checkbox_with_question" data-questions="<?php echo $first_slide['perspective_additional_description_2'] ?>">
                                    <input type="radio" id="check_2" name="radio" value="I’m an early childhood educator" <?php echo ($first_slide['perspectives_required']) ? 'required' : null; ?>>
                                    <label for="check_2">
                                    <?php echo $first_slide['perspective_2']; ?>
                                    </label>
                                </div>
                                <div class="single_checkbox checkbox_with_question" data-questions="<?php echo $first_slide['perspective_additional_description_3'] ?>">
                                    <input type="radio" id="check_3" name="radio" value="I’m a provider" <?php echo ($first_slide['perspectives_required']) ? 'required' : null; ?>>
                                    <label for="check_3">
                                    <?php echo $first_slide['perspective_3']; ?>
                                    </label>
                                </div>
                                <div class="single_checkbox checkbox_with_question" data-questions="<?php echo $first_slide['perspective_additional_description_4'] ?>">
                                    <input type="radio" id="check_4" name="radio" value="I’m a supporter" <?php echo ($first_slide['perspectives_required']) ? 'required' : null; ?>>
                                    <label for="check_4">
                                    <?php echo $first_slide['perspective_4']; ?>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SECOND SLIDE -->
                    <?php $third_slide = get_field('third_slide', get_pll_option_page()) ?>
                    <div class="third_section_content sinlge_box">
                        <p class="question"><?php echo $third_slide['headline_1']; ?></p>
                        <div class="checkbox_questions">
                            What do you need most from early education and care for your child(ren)? <br> What has been your greatest challenge in finding and getting care for your child(ren)?
                        </div>
                        <div class="two_question_wrap">
                            <div class="single_question">
                                <textarea name="story" id="story" cols="30" rows="10" placeholder="<?php echo $third_slide['textarea_1']; ?>" <?php echo ($third_slide['required_textarea_1']) ? 'required' : null; ?>></textarea>
                                <span style="display:none;" class="required_field">required</span>
                                <p class="word_counter"><span id="display_story_count">0</span> / <span id="word_story_left">200 <?php echo $third_slide['word_counter']; ?></span></p>
                            </div>
                            <div class="single_question last">
                                <p class="question"><?php echo $third_slide['headline_2']; ?></p>
                                <textarea name="storytile" id="storytile" cols="30" rows="6" placeholder="<?php echo $third_slide['textarea_2']; ?>" <?php echo ($third_slide['required_textarea_2']) ? 'required' : null; ?>></textarea>
                                <p class="word_counter"><span id="display_storytile_count">0</span> / <span id="word_storytile_left">10 <?php echo $third_slide['word_counter']; ?><span></p>
                            </div>
                        </div>
                        
                    </div>

                    <!-- THIRD SLIDE -->
                    <!-- <?php //$second_slide = get_field('second_slide',get_pll_option_page()) ?>
                    <div class="third_section_content sinlge_box">
                        <div class="single_question">
                            <p class="question"><?php echo $second_slide['headline_1']; ?></p>
                            <div class="checkbox_wrap">
                                <div class="single_checkbox">
                                    <input type="radio" id="check1" name="radios" checked="" value="challenges">
                                    <label for="check1">
                                    <?php //echo $second_slide['experience_1']; ?>
                                    </label>
                                </div>
                                <div class="single_checkbox">
                                    <input type="radio" id="check2" name="radios" value="successes">
                                    <label for="check2">
                                    <?php //echo $second_slide['experience_2']; ?>
                                    </label>
                                </div>
                                <div class="single_checkbox">
                                    <input type="radio" id="check3" name="radios" value="thank">
                                    <label for="check3">
                                    <?php //echo $second_slide['experience_3']; ?>
                                    </label>
                                </div>
                                <div class="single_checkbox">
                                    <input type="radio" id="check4" name="radios" value="share">
                                    <label for="check4">
                                    <?php //echo $second_slide['experience_4']; ?>
                                    </label>
                                </div>
                                <div class="single_checkbox">
                                    <input type="radio" id="check5" name="radios" value="other">
                                    <label for="check5">
                                    <?php //echo $second_slide['experience_5']; ?>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="single_question last select_input visible">
                            <p class="question"><?php //echo $second_slide['headline_2']; ?></p>
                            <div class="input_wrap select-wrapper">
                                <select name="" class="specify_select">
                                    <option value="Affordability"><?php //echo $second_slide['dropdown_item_1']; ?></option>
                                    <option value="Access"><?php //echo $second_slide['dropdown_item_2']; ?></option>
                                    <option value="Quality"><?php //echo $second_slide['dropdown_item_3']; ?></option>
                                    <option value="Equity"><?php //echo $second_slide['dropdown_item_4']; ?></option>
                                    <option value="Consistency"><?php //echo $second_slide['dropdown_item_5']; ?></option>
                                    <option value="Other"><?php //echo $second_slide['dropdown_item_6']; ?></option>
                                </select>
                                <!-- <input type="text" placeholder="Choose your topic" name="topic"> -->
                            <!-- </div>
                        </div>
                    </div> -->
                    
                    <!-- FOURTH SLIDE -->
                    <?php $fourth_slide = get_field('fourth_slide', get_pll_option_page()) ?>
                    <div class="third_section_content sinlge_box">
                        <div class="two_columns">
                            <div class="single_column">
                                <p class="question"><?php echo $fourth_slide['headline_1'] ?></p>
                                <div class="image-upload-wrap">
                                    <input class="file-upload-input" name="photo" id="photo" type='file' accept="image/*"/>
                                    <input type="hidden" id="base64_img" name="base64_img" value="">
                                    <div class="drag-text">
                                    <h3><?php echo $fourth_slide['image_upload_title'] ?></h3>
                                    </div>
                                </div>
                                <div class="file-upload-content">
                                    <img class="file-upload-image" src="#" alt="your image" />
                                    <div class="image-title-wrap">
                                    <button type="button" class="remove-image"><?php echo $fourth_slide['remove_image'] ?><span class="image-title"><?php echo $fourth_slide['image_title'] ?></span></button>
                                    </div>
                                </div>
                            </div>
                            <div class="single_column">
                                <div class="single_question">
                                    <p class="question"><?php echo $fourth_slide['headline_2'] ?></p>
                                    <input type="text" id="tags" name="tags">
                                    <div class="tag_error">You have reached maximum tags</div>
                                    <ul>
                                        <?php foreach ($fourth_slide['predefined_tags'] as $singleTag) : ?>
                                            <li class="add-button" data-id="<?php echo str_replace("#", "", $singleTag['single_tag']); ?>"><?php echo $singleTag['single_tag']; ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                                
                            </div>
                        </div>
                        
                    </div>

                    <?php $fifth_slide = get_field('fifth_slide', get_pll_option_page()) ?>
                    <div class="third_section_content sinlge_box">
                        <p class="question"><?php echo $fifth_slide['headline']; ?></p>
                        <div class="single_question last">
                            <div class="form_holder">
                                <div class="half"><input name="fname" type="text" placeholder="<?php echo $fifth_slide['first_name']; ?>" <?php echo ($fifth_slide['required_first_name']) ? 'required' : null; ?>></div>
                                <div class="half"><input name="lname" type="text" placeholder="<?php echo $fifth_slide['last_name']; ?>" <?php echo ($fifth_slide['required_last_name']) ? 'required' : null; ?>></div>
                                <input name="email" type="email" placeholder="<?php echo $fifth_slide['email_address']; ?>" <?php echo ($fifth_slide['required_email_address']) ? 'required' : null; ?>>
                                <div class="half"><input name="phonenumber" type="text" placeholder="<?php echo $fifth_slide['phone']; ?>" <?php echo ($fifth_slide['required_phone']) ? 'required' : null; ?>></div>
                                <div class="half"><input name="zipcode" type="text" placeholder="<?php echo $fifth_slide['zip_code']; ?>" <?php echo ($fifth_slide['required_zip_code']) ? 'required' : null; ?>></div>
                            </div>
                        </div>
                    </div>
                    <?php $tell_story_form_fields = get_field('tell_story_form_fields', get_pll_option_page()); ?>
                    <div class="third_section_content sinlge_box">
                        <p class="question"><?php echo $tell_story_form_fields['privacy_headline']; ?></p>
                        <div class="single_question last">
                            <div class="privacy_box">
                                <p>
                                <?php echo $tell_story_form_fields['privacy_box']; ?>
                                </p>
                            </div>
                            <div class="bottom_section">
                                <div class="custom_checkobxes">
                                    <div class="single_box_wrap">
                                        <label class="container">
                                            <input type="checkbox" name="checkbox1" value="disclaimer" required>
                                            <span class="checkmark"></span>
                                            <?php echo $tell_story_form_fields['checkbox1']; ?>
                                        </label>
                                        <div class="checkbox_error">This field is required</div>
                                    </div>
                                    <div class="single_box_wrap">
                                        <label class="container">
                                            <input type="checkbox" name="checkbox" value="agree" checked>
                                            <span class="checkmark"></span>
                                            <?php echo $tell_story_form_fields['checkbox2']; ?>
                                        </label>
                                    </div>
                                </div>
                                <button class="button dark submit_button" id="home_submit_button" disabled>
                                    <div class="hidden_button"></div>
                                    <?php echo $tell_story_form_fields['submit_button']; ?>
                                </button>
                            </div>
                            
                        </div>
                    </div>
                    <?php $thank_you_slide = get_field('thank_you_slide', get_pll_option_page()) ?>
                    <div class="third_section_content thankyou_message">
                    
                        <div class="left">
                            <p><?php echo $thank_you_slide['thank_you_headline'] ?></p>
                            <div class="message">
                                <?php echo $thank_you_slide['thank_you_description'] ?>
                            </div>
                        </div>
                        <div class="right">
                            <?php if ($img_with_desc_section['image']) : ?>
                                <div class="image_holder">
                                    <img src="<?php echo $img_with_desc_section['image']['url']; ?>" alt="<?php echo $img_with_desc_section['image']['alt']; ?>">
                                </div>
                            <?php endif; ?>
                            
                            <?php if ($img_with_desc_section['image_text']) : ?>
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
    if ($files_section['title'] || $files_section['description'] || $files_section['graphics_title'] || $files_section['graphics'] || $files_section['documents_title'] || $files_section['documents']) : ?>
        <div class="fourth_section" id="fourth_section">
            <div class="content_holder" id="get-involved">
                <div class="fourth_section_content">
                    <?php if ($files_section['title']) :?>
                        <h2><?php echo $files_section['title']; ?></h2>
                    <?php endif; ?>

                    <?php if ($files_section['description']) :?>
                        <p><?php echo $files_section['description']; ?></p>
                    <?php endif; ?>

                    <?php if ($files_section['graphics_title']) :?>
                        <h3><?php echo $files_section['graphics_title']; ?></h3>
                    <?php endif; ?>
                        
                    <?php if ($files_section['graphics']) : ?>
                        <div class="graphics_holder">
                            <?php foreach ($files_section['graphics'] as $graphic) : ?>
                                <a href="<?php echo $graphic['image']['url']; ?>" target="_blank" class="single_graphic st__img">
                                    <div class="image_holder">
                                        <img src="<?php echo $graphic['image']['url']; ?>" alt="<?php echo $graphic['image']['alt']; ?>">
                                    </div>
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/download_arrow.svg" alt="" class="download_icon">
                                </a>
                                
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($files_section['documents_title']) :?>
                        <h3><?php echo $files_section['documents_title']; ?></h3>
                    <?php endif; ?>

                    <?php if ($files_section['documents']) : ?>
                        <div class="document_holder">
                            <?php foreach ($files_section['documents'] as $documents) : ?>
                                <a href="<?php echo $documents['file']['url']; ?>" download class="single_document_wrap">
                                    <div class="single_document">
                                        <?php if ($documents['title']) : ?>
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
        $social_secton_headline = get_field('social_secton_headline');
        $social_secton_shortcode = get_field('social_secton_shortcode');
    ?>

    <?php if ($social_secton_headline || $social_secton_shortcode) : ?>
        <div class="social_section">
            <div class="content_holder">
                <div class="social_secton_content">
                <?php if ($social_secton_headline) : ?>
                    <h2><?php echo $social_secton_headline; ?></h2>
                <?php endif;?>
                <?php if ($social_secton_shortcode) : ?>
                    <?php echo $social_secton_shortcode; ?>
                <?php endif;?>
                    <!-- <div class="embedsocial-hashtag" data-ref="446a0090d8f1d6fbd3a40d3c1461d057d2d76a16" ></div><script>(function(d, s, id){var js; if (d.getElementById(id)) {return;} js = d.createElement(s); js.id = id; js.src = "https://embedsocial.com/cdn/ht.js"; d.getElementsByTagName("head")[0].appendChild(js);}(document, "script", "EmbedSocialHashtagScript"));</script> -->
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
<script type="text/javascript">
jQuery(document).ready(function ($) {
    $('#home_submit_button').click(function(event) {
        if ($("#tn-form").valid()) {
            var file_data = $('#photo')[0].files[0];
            var checkbox_val = $('input[name="checkbox1"]').val();
            if ($('input[name="checkbox"]').is(':checked')) {
                checkbox_val = $('input[name="checkbox"]').val();
            }
            var form_data = new FormData();
            form_data.append('action', 't311_submissions');           
            form_data.append('file',  $('#photo')[0].files[0]);
            form_data.append('fname', $('input[name="fname"]').val() );
            form_data.append('lname', $('input[name="lname"]').val() );
            form_data.append('email', $('input[name="email"]').val() );
            form_data.append('story', $('textarea[name="story"]').val() );
            form_data.append('storytile', $('textarea[name="storytile"]').val() );
            form_data.append('checkbox', checkbox_val );
            form_data.append('topic', $('input[name="topic"]').val() );
            form_data.append('phonenumber', $('input[name="phonenumber"]').val() );
            form_data.append('radio', $('input[name="radio"]').val() );
            form_data.append('radios', $('input[name="radios"]').val() );
            form_data.append('zipcode', $('input[name="zipcode"]').val() );
            form_data.append('tags', $('input[name="tags"]').val() );
            
            jQuery.ajax({
                type: 'POST',
                url: admin_ajax_url,
                data: form_data, 
                processData: false,
                contentType: false,
                success: function(data, textStatus, XMLHttpRequest) {
                    console.log(data);
                },
                error: function(MLHttpRequest, textStatus, errorThrown) {
                    console.log(errorThrown);
                }

            });

            $(".form_swiper").slick("slickNext");
        } else {
            alert('Please complete the required fields');
        }
    })

    if ($("#tn-form").length > 0) {
        $("#tn-form").validate({
            errorElement: "div",
            rules: {
                email: {
                    required: true,
                    email: true
                },
                <?php if ($fifth_slide['required_first_name']) : ?>
                fname: "required",
                <?php endif; ?>
                <?php if ($fifth_slide['required_last_name']) : ?>
                lname: "required",
                <?php endif; ?>
                <?php if ($third_slide['required_textarea_1']) : ?>
                story: "required",
                <?php endif; ?>
                <?php if ($third_slide['required_textarea_2']) : ?>
                storytile: "required",
                <?php endif; ?>
                checkbox1: "required",
                <?php if ($fifth_slide['required_zip_code']) : ?>
                zipcode: "required",
                <?php endif; ?>
            },
            messages: {
                email: "This field is required",
                fname: "This field is required",
                lname: "This field is required",
                story: "This field is required",
                storytile: "This field is required",
                checkbox1: "This field is required",
                zipcode: "This field is required",
            },
        });
    }

    $(".form_swiper").on("beforeChange", function (event, slick, currentSlide) {
      $('.slick-arrow.right').css('pointer-events', 'all');
      $('.arrow_hidden').removeClass('active');
    });

    $('.arrow_hidden').on('click', function(){
        $("#tn-form").valid();
        $('.error').not('input, textarea').removeClass('visible');
    });

    $(".form_swiper").on("afterChange", function (event, slick, currentSlide) {
        $('.error').not('input, textarea').addClass('visible');

        $(".slick-current [required]:visible").each(function () {
            if($(this).val().trim().length < 1 || $('input[name="radio"]:checked').length == 0){
             $('.slick-arrow.right').css('pointer-events', 'none');
             $('.arrow_hidden').addClass('active');
             $('.error').not('input, textarea').addClass('visible');

            //  $('.slick-current').find('.required_field').fadeIn();
            return false; 
            } else{
                return false;
                $('.slick-arrow.right').css('pointer-events', 'all')
                $('.arrow_hidden').removeClass('active');
                $('.error').not('input, textarea').removeClass('visible');
                // $('.slick-current').find('.required_field').fadeOut();
            }
        }) 

        $(".slick-current [required]:visible").on('change keyup paste', function() {
            $(".slick-current [required]:visible").each(function () {
                if($(this).val().trim().length < 1){
                    $('.slick-arrow.right').css('pointer-events', 'none')
                    $('.arrow_hidden').addClass('active');
                    $(this).find('.error').not('input, textarea').addClass('visible');
                return false; 
                } else{
                    $('.arrow_hidden').removeClass('active');
                    $('.slick-arrow.right').css('pointer-events', 'all')
                    $(this).find('.error').not('input, textarea').removeClass('visible');
                }
            })
        });
    })

    $('.hidden_button').click(function() {
        $(".checkbox_error").fadeIn();
    })

    $('input[name="checkbox1"]').click(function() {
        if ($(this).is(':checked')) {
            $("#home_submit_button").removeAttr("disabled");
            $(".checkbox_error").fadeOut();
            $('.hidden_button').fadeOut();
        } else {
            $("#home_submit_button").attr("disabled", true);
            $(".checkbox_error").fadeIn();
            $('.hidden_button').fadeIn();
        }
    })

    $('.inputTags-list').prepend('<i id="tn-icon-hagtag">#</i>');
    $('.inputTags-autocomplete-item').each(function() {
        $(this).attr('data-val', $(this).text().slice(1));
    })
})
</script>
<?php
get_footer(); ?>