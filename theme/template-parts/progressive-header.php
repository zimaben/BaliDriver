<?php
use \ktdamd\Config as Config;
use \ktdamd\DoctorAtMyDoor as Theme;
global $post;

/* When adapting this to new themes, if posts have different header width and height 
 * register the image size width height in the functions.php add_theme_images_sizes 
 * function with the naming convention you see there and here. 
 * 
 * The progressive header checks the post type for custom page header images
 * first, then serves the page header progressive images. Hopefully this formula will 
 * accomplish most designs */

#BG-PAGE-FULL is the full size of the hero image in the designs, #FULL is the full size of the image in the media library
$bgimg_id = \get_post_thumbnail_id( $post->ID );

$img_size_check = \has_image_size( 'ph-' . $post->post_type . '-one');

$img_size = $img_size_check ? 'ph-' . $post->post_type . 'one' : 'ph-page';

if(!$bgimg_id) { return;}

$bgimg_1 = \wp_get_attachment_image_src( $bgimg_id, $img_size.'-one', false )[0];
$bgimg_1w = \wp_get_attachment_image_src( $bgimg_id, $img_size.'-one', false )[1];
$bgimg_2 = \wp_get_attachment_image_src( $bgimg_id, $img_size.'-two', false )[0];
$bgimg_2w = \wp_get_attachment_image_src( $bgimg_id, $img_size.'-two', false )[1];
$bgimg_3 = \wp_get_attachment_image_src( $bgimg_id, $img_size.'-three', false )[0];
$bgimg_3w = \wp_get_attachment_image_src( $bgimg_id, $img_size.'-three', false )[1];
$bgimg_4 = \wp_get_attachment_image_src( $bgimg_id, $img_size.'-full', false )[0];
$bgimg_4w = \wp_get_attachment_image_src( $bgimg_id, $img_size.'-full', false )[1];
$full = \wp_get_attachment_image_src( $bgimg_id, 'full', false )[0];
$fullw = \wp_get_attachment_image_src( $bgimg_id, 'full', false )[1];


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
<div class="aspectRatioPlaceholder is-locked hero-holder" alt="<?php the_title() ?> banner" data-process="doProgressiveHeader">
    <div class="aspect-ratio-fill">
        <div class="theme-loader">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <canvas id="pageheader-<?php echo $bgimg_id?>" 
        data-img-src-1="<?php echo $bgimg_1?>" 
        data-img-size-1="<?php echo $bgimg_1w?>" 
        data-img-src-2="<?php echo $bgimg_2?>"
        data-img-size-2="<?php echo $bgimg_2w?>"
        data-img-src-3="<?php echo $bgimg_3?>"
        data-img-size-3="<?php echo $bgimg_3w?>"
        data-img-src-4="<?php echo $bgimg_4?>"
        data-img-size-4="<?php echo $bgimg_4w?>"
        data-img-src-5="<?php echo $full?>"
        data-img-size-5="<?php echo $fullw?>">
    </canvas>
    <h1><?php echo ($post->post_type === "page") ? \get_the_title() : ''; ?></h1>
</div>
<?php
global $template;
if( $post->post_type === "locations" || $template == \get_template_directory_uri()  ){
    Theme::TemplatePart('page-header-bottom');
}