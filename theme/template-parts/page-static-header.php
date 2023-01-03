<?php
use rbt\FRStarter as Theme;
use rbt\Config as Config;
global $post;

#BG-PAGE-FULL is the full size of the hero image in the designs, #FULL is the full size of the image in the media library
$bgimg_id = \get_post_thumbnail_id( $post->ID );
$bgimg_1 = \wp_get_attachment_image_src( $bgimg_id, 'ph-page-one', false )[0];
$bgimg_1w = \wp_get_attachment_image_src( $bgimg_id, 'ph-page-one', false )[1];
$bgimg_2 = \wp_get_attachment_image_src( $bgimg_id, 'ph-page-two', false )[0];
$bgimg_2w = \wp_get_attachment_image_src( $bgimg_id, 'ph-page-two', false )[1];
$bgimg_3 = \wp_get_attachment_image_src( $bgimg_id, 'ph-page-three', false )[0];
$bgimg_3w = \wp_get_attachment_image_src( $bgimg_id, 'ph-page-three', false )[1];
$bgimg_4 = \wp_get_attachment_image_src( $bgimg_id, 'ph-page-full', false )[0];
$bgimg_4w = \wp_get_attachment_image_src( $bgimg_id, 'ph-page-full', false )[1];
$full = \wp_get_attachment_image_src( $bgimg_id, 'full', false )[0];
$fullw = \wp_get_attachment_image_src( $bgimg_id, 'full', false )[0];

// const BREAKPOINTS = array(
//     'phone' => 576,
//     'tablet' => 768,
//     'laptop' => 992,
//     'desktop' => 1200,
// );

if( is_array(Config::BREAKPOINTS)){
    $maxwidth_tablet = Config::BREAKPOINTS['phone'] . 'px';
    $maxwidth_laptop = Config::BREAKPOINTS['tablet'] . 'px';
    $maxwidth_desktop = Config::BREAKPOINTS['laptop'] . 'px';
} else {
    /* bootstrap values */
    $maxwidth_tablet = '576px';
    $maxwidth_laptop = '768px';
    $maxwidth_desktop = '992px';
}




# We don't use background-image due to limitation of srcset support
?>
<div class="hero-holder">
    <picture class="page-header-img">
        <source media="(max-width: <?php echo $maxwidth_tablet ?>)" srcset="<?php echo $bgimg_1 . ' ' . $bgimg_1w . 'w, ' . $bgimg_2 . ' ' . $bgimg_2w . 'w 2x' ?>">
        <source media="(max-width: <?php echo $maxwidth_laptop ?>)" srcset="<?php echo $bgimg_2 . ' ' . $bgimg_2w .'w, ' . $bgimg_3 . ' ' . $bgimg_3w . 'w 2x' ?>">
        <source media="(max-width: <?php echo $maxwidth_desktop ?>)" srcset="<?php echo $bgimg_3 . ' ' . $bgimg_3w . 'w, ' . $bgimg_4 . ' '. $bgimg_4w . 'w, ' . $full . ' ' . $fullw . 'w 2x' ?>">
    <img width="100%" height="100%" src="<?php echo $full ?>" srcset="<?php 
        echo $bgimg_1 . ' ' . $bgimg_1w . 'w, ' . $bgimg_2 . ' ' .$bgimg_2w. 'w, ' . $bgimg_3 . ' ' . $bgimg_3w . 'w, ' . $bgimg_4 . ' ' . $bgimg_4w . 'w, ' . $full . ' ' . $fullw . 'w 2x';
    ?>" alt="<?php the_title() ?> banner">
    </picture>
    
<h1><?php the_title(); ?></h1>
</div><!-- end hero -->