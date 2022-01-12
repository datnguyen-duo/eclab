<?php
/* Template Name: Thank You */
get_header();

$headline = get_field("headline")
?>

<section id="thank-you">
    <?php if ($headline) : ?>
        <h1><?php echo $headline; ?></h1>
    <?php endif; ?>
</section>

<?php get_footer(); ?>