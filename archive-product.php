<?php 
/**  
 * Template Name: WooCommerce Shop Page 
 * Template Post Type: post, page, product
*/

use rbtddb\DDBali as Theme;
use rbtddb\Config as Config;

global $post;


get_header();

Theme::TemplatePart('page-header');
            
$html = woocommerce_content();

get_footer();