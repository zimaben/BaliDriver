<?php
/**
 * Home Page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package tpt
 * @subpackage Gardens Care
 */
global $post;
use <!PLUGINPATH->\<!PLUGINNAME-> as Theme;
use <!PLUGINPATH->\Config as Config;
/* If we have a static header, use it. It saves us dozens of queries. */
if(Theme::StaticHeaderExists( $post->ID )){
	Theme::TemplatePart('static/header-' . $post->ID);
} else {
	get_header();
#	Theme::TemplatePart('page-header');
}

?>


<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( ! is_front_page() ) : ?>
		<header class="entry-header alignwide">
			<?php get_template_part( 'template-parts/header/entry-header' ); ?>
			<?php twenty_twenty_one_post_thumbnail(); ?>
		</header>
	<?php elseif ( has_post_thumbnail() ) : ?>
		<header class="entry-header alignwide">
			<?php twenty_twenty_one_post_thumbnail(); ?>
		</header>
	<?php endif; ?>

	<div class="entry-content">
		<?php
		the_content();

		?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
<?php
get_footer();