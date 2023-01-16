<?php
/* Template Name: Page Template */
use rbt\FRStarter as Theme;
use rbt\Config as Config;
global $post;

/* If we have a static header, use it. It saves us dozens of queries. */
if(Theme::StaticHeaderExists( $post->ID )){
	Theme::TemplatePart('static/header-' . $post->ID);
} else {
	get_header();
	Theme::TemplatePart('page-header');
}
?>






	<div id="post-<?php the_ID(); ?>" <?php post_class('page-content'); ?>>
		<?php
		the_content();
		?>
	</div><!-- .entry-content -->

    <?php 
if(Theme::StaticFooterExists( $post->ID )){
    Theme::TemplatePart('static/footer-' . $post->ID);
} else {
    get_footer();
}