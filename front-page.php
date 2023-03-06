<?php
/**
 * Home Page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Daily Driver Bali
 * @subpackage TPT
 */

 use rbtddb\DDBali as Theme;
use rbtddb\Config as Config;


global $post;

/* If we have a static header, use it. It saves us dozens of queries. */
if(Theme::StaticHeaderExists( $post->ID )){
	Theme::TemplatePart('static/header-' . $post->ID);
} else {
	get_header();
	Theme::TemplatePart('page-header');
}

?>


<section id="post-<?php the_ID(); ?>" <?php post_class('home'); ?>>
	<?php 
	if( !is_singular() ) :
		if( Theme::TemplatePartExists( 'archive-' . $post->post_type)){
			get_header();
			Theme::TemplatePart( 'archive-' . $post->post_type);
		} else {
			get_header();
			Theme::TemplatePart('archive-header');
			Theme::TemplatePart('archive');
		}
	else : ?>

			<?php the_content(); ?>
			<!-- .entry-content -->
	<?php 
	endif; ?>
	
</section><!-- #post-<?php the_ID(); ?> -->
<?php
get_footer();