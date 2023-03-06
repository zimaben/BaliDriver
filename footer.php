<?php
use rbtddb\DDBali as Theme;
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Daily Driver Bali
 * @subpackage RBT
 */

?>		
				
				</main><!-- #main -->
		</section><!-- #primary -->
	</div><!-- #content -->
</div><!-- #page -->
    <?php 
	  Theme::TemplatePart('site-footer.php') 
	# Theme::TemplatePart('site-footer-simplified.php');
	?>



<?php wp_footer(); ?>

</body>
</html>