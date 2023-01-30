<?php 
use <!PLUGINPATH->\<!PLUGINNAME-> as Theme;
use <!PLUGINPATH->\Config as Config;


// print_r( $template );

?>
<header id="site-header" class="site-header container">
	<?php if ( has_nav_menu( 'mobile' ) ) : ?>

	<div class="mobile-menu-button" data-menu-target="site-mobile-menu-container" onclick="mobileExpand(event)">

	</div>
	<div class="mobile-menu-container" id="site-mobile-menu-container">
		<div class="mobile-animation-wrap">
		<span class="mobile-menu-close" data-menu-target="site-mobile-menu-container" onclick="mobileExpand(event)">
		</span>
			<?php
			
				wp_nav_menu(
					array(
						'theme_location'  => 'mobile',
						'menu_class'      => 'menu-wrapper',
						'container_class' => 'mobile-menu',
						'items_wrap'      => '<ul id="mobile-menu-list" class="%2$s">%3$s</ul>',
						'fallback_cb'     => false,
					)
				);
			
			?>
		</div>
	</div>

	<?php endif; ?>

	<div class="top menu-logo">
		<div class="site-branding">
			<?php
			if ( has_custom_logo() ) {
				?><a href="/" class="site-logo"><?php the_custom_logo(); ?></a><?php
			} else {
				?>
				<h1 class="brand-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo Config::NICENAME; ?></a></h1>
				<?php
			}
			?>
		</div>
	</div>
	<div class="top menu-container">
		<?php if ( has_nav_menu( 'primary' ) ) : ?>

		<div class="desktop-menu">	
			<nav id="site-navigation" class="primary-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary menu', Config::TEXTDOMAIN ); ?>">
				<?php
				wp_nav_menu(
					array(
						'theme_location'  => 'primary',
						'menu_class'      => 'menu-wrapper',
						'container_class' => 'primary-menu-container',
						'items_wrap'      => '<ul id="primary-menu-list" class="%2$s">%3$s</ul>',
						'fallback_cb'     => false,
					)
				);
				?>
			</nav><!-- #site-navigation -->
		<?php endif; ?>
	</div>
	<?php #check HEADER for top right
	if(isset(Config::HEADER['right']) && Config::HEADER['right'] !== false) : ?>
		<div class="top menu-right">
			<?php if(isset(Config::HEADER['right']['login']) && Config::HEADER['right']['login'] !== false) : ?>
				<div class="header-login wp-block-button">
					<?php if( is_user_logged_in() ){
						echo '<a class="wp-block-button__link" href="'. wp_logout_url( site_url() ) .'">Log Out</a>';
					} else {
						echo '<a class="wp-block-button__link" href="'. wp_login_url( ) .'">Log In</a>';
					} ?>
				</div>
			<?php endif; ?>
			<?php if(\get_theme_mod('header_telephone')) : ?>
				<div class="header-telephone">
					<a href="tel:<?php echo \get_theme_mod('header_telephone'); ?>"><?php echo \get_theme_mod('header_telephone'); ?>
						<span class="telephone-icon">
							<img src="<?php echo \get_template_directory_uri()?>/theme/assets/icons/phone-grid.svg" alt="">
						</span>
					</a>
				</div>
			<?php endif; ?>
			<?php if(isset(Config::HEADER['right']['cta']) && Config::HEADER['right']['cta'] !== false) : ?>
				<div class="header-cta wp-block-button">
					<?php 
						$cta_text = \get_theme_mod('top_cta_text');
						$cta_url = \get_theme_mod('top_cta_url');
						if($cta_text && $cta_url){ ?>
						
							<a class="wp-block-button__link" href="<?php echo $cta_url ?>"><?php echo $cta_text ?></a>
						
					<?php } ?>
				</div>
			<?php endif; ?>
		</div>
	<?php endif;?>
</header>