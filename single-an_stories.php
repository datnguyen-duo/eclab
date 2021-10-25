<?php
get_header();
?>
<?php
$post_id = get_the_ID();
$approved = get_post_meta($post_id, 'approve', true);
$an_link = get_post_meta($post_id, 'person_link');
$an_link = $an_link[0];
$is_admin = current_user_can('manage_options');
// print_r($an_link);// $api_key = get_option("an_apikey");
$api_key = "78e7e43ff662bc958e6b869a9ea44307";
?>
<main id="primary" class="site-main">
<?php if ($is_admin) : ?>
    <?php
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 100);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('OSDI-API-Token: '.$api_key));
    $api_request_url = $an_link;
    //$api_request_url .= "?".http_build_query($api_request_parameters);
    curl_setopt($ch, CURLOPT_URL, $api_request_url);
    $response = curl_exec($ch);
    $person_data = json_decode($response);
    $custom_fields = $person_data->custom_fields;
    $tags = $custom_fields->tag;
    $tags_name ="";
    if ($tags) {
        $tags = explode(",", $tags);
        foreach ($tags as $key => $value) {
            $tags_name .="<span filter='".$value."'>".$value."</span><br>";
        }
    }
    switch ($custom_fields->radio) {
        case 'I’m a family member and/or caregiver':
            $category = 'families';
            $count_family++;
            break;
        case 'I’m an early childhood educator':
            $category = 'educators';
            break;
        case 'I’m a provider':
            $category = 'providers';
            break;
        case 'I’m a supporter':
            $category = 'supporters';
            break;
    }
    ?>
     <div class="single_news_popup" style="display: block!important;">
         <div class="content_holder">
             <div class="single_news_popup_content">
                 <div class="news_header">
                     <div class="left">
                         <div class="small_headline_holder">
                             <div class="small_headline">
                             Our Community
                             </div>
                         </div>
                         
                         <h2><?=$custom_fields->storytile?></h2>
                         <div class="author">
                             By <?=$custom_fields->fname?> <?=$custom_fields->lname?>
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
                             <img src="<?=($custom_fields->base64_img? $custom_fields->base64_img: get_template_directory_uri()."/images/single_story.jpg") ?>" alt="">
                         </div>
                     </div>
                 </div>

                 <div class="news_content">
                     <div class="left">
                         <p> <?=str_replace("\'", "'", preg_replace("/(\\\\\\\\)+'/", "'", $custom_fields->story))?></p>
                     </div>
                     <div class="right">
                         <p>Story from</p>
                         <div class="category">
                             <?=ucfirst($category)?>
                         </div>
                         <p style="margin-top: 10px;">Tags:</p>
                         <div class="tags">
                             <?=$tags_name?>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
<?php else : ?>
    <?php if ($approved=="approved") : ?>
        <?php
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 100);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('OSDI-API-Token: '.$api_key));
        $api_request_url = $an_link;
        //$api_request_url .= "?".http_build_query($api_request_parameters);
        curl_setopt($ch, CURLOPT_URL, $api_request_url);
        $response = curl_exec($ch);
        $person_data = json_decode($response);
        $custom_fields = $person_data->custom_fields;
        $tags = $custom_fields->tag;
        $tags_name ="";
        if ($tags) {
            $tags = explode(",", $tags);
            foreach ($tags as $key => $value) {
                $tags_name .="<span filter='".$value."'>".$value."</span><br>";
            }
        }
        switch ($custom_fields->radio) {
            case 'I’m a family member and/or caregiver':
                $category = 'families';
                $count_family++;
                break;
            case 'I’m an early childhood educator':
                $category = 'educators';
                break;
            case 'I’m a provider':
                $category = 'providers';
                break;
            case 'I’m a supporter':
                $category = 'supporters';
                break;
        }
        ?>
         <div class="single_news_popup" style="display: block!important;">
             <div class="content_holder">
                 <div class="single_news_popup_content">
                     <div class="news_header">
                         <div class="left">
                             <div class="small_headline_holder">
                                 <div class="small_headline">
                                 Our Community
                                 </div>
                             </div>
                             
                             <h2><?=$custom_fields->storytile?></h2>
                             <div class="author">
                                 By <?=$custom_fields->fname?> <?=$custom_fields->lname?>
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
                                 <img src="<?=($custom_fields->base64_img? $custom_fields->base64_img: get_template_directory_uri()."/images/single_story.jpg") ?>" alt="">
                             </div>
                         </div>
                     </div>

                     <div class="news_content">
                         <div class="left">
                             <p> <?=str_replace("\'", "'", preg_replace("/(\\\\\\\\)+'/", "'", $custom_fields->story))?></p>
                         </div>
                         <div class="right">
                             <p>Story from</p>
                             <div class="category">
                                 <?=ucfirst($category)?>
                             </div>
                             <p style="margin-top: 10px;">Tags:</p>
                             <div class="tags">
                                 <?=$tags_name?>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
    <?php else : ?>
        <div style="min-height: 70vh;display: flex;align-content: center; justify-content: center; align-items: center;"> 
            <h1 style="font-size: 3rem; text-transform: uppercase; font-family: 'korolev';">This story is not approved!</h1> </div>
        
    <?php endif; ?>
<?php endif ?>


</main><!-- #main -->
<?php
get_footer();
