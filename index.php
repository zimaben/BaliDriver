<?php
use rbt\FRStarter as Theme;
use \rbt\Config as Config;
/**
 * The main template file - if it ain't broke...
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 *
 * @package TPT
 * @subpackage FRStarter
 */

global $post;

if ( have_posts() ) {

        if( is_singular() ){
            /* If we have a static header, use it. It saves us dozens of queries. */
            if(Theme::StaticHeaderExists( $post->ID )){
                Theme::TemplatePart('static/header-' . $post->ID);
            } else {
                get_header();

                Theme::TemplatePart('page-header');
            }
            // Load posts loop.
            while ( have_posts() ) {
                the_post();
                get_post_type() == 'page' ? Theme::TemplatePart('page') : Theme::TemplatePart('single'); 
            }
        } else {

            if( Theme::TemplatePartExists( 'archive-' . $post->post_name)){
                get_header();
                Theme::TemplatePart( 'archive-' . $post->post_name);
            } else if( Theme::TemplatePartExists(' /pages/' . $post->post_name)){
                get_header();
                Theme::TemplatePart('/pages/' . $post->post_name);
            } else {
                get_header();
                Theme::TemplatePart('archive-header');
                Theme::TemplatePart('archive');
            }
                
        }
		
	} else {
    get_header();
	// If no content, include the "No posts found" template.
	Theme::TemplatePart( '404' );

}

get_footer();
