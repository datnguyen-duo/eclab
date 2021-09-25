<?php
/* Template Name: Community */
get_header(); ?>
<?php 
error_reporting(1);
$api_key = "78e7e43ff662bc958e6b869a9ea44307";
$form_id = "fe289885-c119-4ee7-a543-d3e92a0ce691";

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
<div class="community_wrap">

    <?php 
    $popup_section = get_field('popup_section');
    if( $popup_section['title'] || $popup_section['description'] || $popup_section['link'] ): ?>
        <div class="tell_story_popup">
            <div class="tell_story_popup_content">
                <div class="tell_story_popup_content_wrap">
                    <div class="close_tell_story_popup">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/close.svg" alt="close-icon">
                    </div>
                    <div class="left">
                        <div class="left_content">
                            <?php if( $popup_section['title'] ): ?>
                                <h3><?php echo $popup_section['title']; ?></h3>
                            <?php endif; ?>
                            
                            <?php if( $popup_section['description'] ): ?>
                                <p><?php echo $popup_section['description']; ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="right">
                        <?php 
                        $link = $popup_section['button'];
                        if( $link ): 
                            $link_url = $link['url'];
                            $link_title = $link['title'];
                            $link_target = $link['target'] ? $link['target'] : '_self';
                            ?>
                            <div class="button_holder">
                                <a class="button dark" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
                                    <?php echo esc_html( $link_title ); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="community_content">
        <div class="content_holder">
            <?php
            $press_section_title = get_field('press_section_title');
            if( $press_section_title ): ?>
                <h2><?php echo $press_section_title; ?></h2>
            <?php endif; ?>
            
            <div class="filter_wrap">
                <p>
                    Stories from
                </p>
                <span></span>
                <ul>
                    <li  rel="families">Families
                    </li>
                    <li rel="educators">Early Educators
                    </li>
                    <li rel="providers">Providers
                    </li>
                    <li rel="supporters">Other Supporters
                    </li>
                    <li rel="" class="active">
                        All
                    </li>
                </ul>
            </div>
            <div class="stories_wrap">
                <?php 
                $count_family = 0;
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
                    switch ($custom_fields->radio) {
                        case 'I’m a family member and/or caregiver':
                            $category = 'families'; $count_family++;
                            if ($count_family <=4 ) {
                                $show_attr = 'show4';
                            } else {
                                $show_attr = '';
                            }
                            break;
                        case 'I’m an early childhood educator':
                            $category = 'educators';
                            $count_edu++;
                            if ($count_edu <=4 ) {
                                $show_attr = 'show4';
                            } else {
                                $show_attr = '';
                            }
                            break;
                        case 'I’m a provider':
                            $category = 'providers'; $count_pro++;
                            if ($count_pro <=4 ) {
                                $show_attr = 'show4';
                            } else {
                                $show_attr = '';
                            }
                            break;
                        case 'I’m a supporter':
                            $category = 'supporters'; $count_sup++;
                            if ($count_sup <=4 ) {
                                $show_attr = 'show4';
                            } else {
                                $show_attr = '';
                            }
                            break;
                    }
                    echo '<a class="single_story_holder '.$category.'" rel="'.$category.'" data-show="'.$show_attr.'">
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
                                    </div>
                                </div>
                            </div>
                        </a>';
                    curl_close($ch);
                    
                }

                 ?>
            </div>
            
        </div>
    </div>
</div>

<?php
get_footer(); ?>