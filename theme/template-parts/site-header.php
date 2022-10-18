<?php 
use <!PLUGINPATH->\<!PLUGINNAME-> as Theme;
use <!PLUGINPATH->\Config as Config;


// print_r( $template );

?>
<header id="site-header" class="site-header container at-top">
	<div class="row">
		<div class="mobile-menu-button" onclick="mobileExpand(event)">

		</div>
		<div class="top menu-logo">
			<div class="site-branding">
				<?php
				if ( has_custom_logo() ) {
					?><a href="/" class="site-logo"><?php the_custom_logo(); ?></a><?php
				} else {
					?>
					<h1 class="brand-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php
				}
				?>
			</div>
		</div>
		<div class="top menu-container has-hamburger">
			<div class="mobile-menu">
			<div class="mobile-menu-header">
				<div class="mobile-menu-button expanded" onclick="mobileExpand(event)"></div>
				<?php if ( has_custom_logo() ){ echo wp_get_attachment_image( get_theme_mod( 'custom_logo' ), 'full' ); } ?>
			</div>
			<?php
			if ( has_nav_menu( 'primary' ) ) : 

			$menutype = get_theme_mod('main_menu_style');
			$isbootstrap = get_theme_mod('menu_bootstrap_markup');
			switch( $menutype ) {
				case "hamburger" : 
					?>
					<div data-target="site-navigation-mobile" class="hamburger-menu">
						<span class="hamburger-menu-icon"></span>
						<span class="hamburger-menu-close"></span>
					</div>
					<?php
					break;
				default :
					?>
					<div data-target="site-navigation-mobile" class="hamburger-menu mobile-only">
						<span class="hamburger-menu-icon"></span>
						<span class="hamburger-menu-close"></span>
					</div>
					<?php
					break;
			}
			?>
			<?php # if mobile hamburger menu ?>
			<nav id="site-navigation-mobile" class="primary-navigation" role="navigation">
				<?php 
				if($menutype === 'hamburger' || $menutype === 'top'){ $addclass = ' horizonal';}
				else { $addclass = ' vertical';}
				
				if( $isbootstrap ) {
					wp_nav_menu( array(
						'items_wrap' 	  => '<ul id="%1$s" class="%2$s">%3$s</ul>',
						'theme_location'  => 'primary',
						'depth'           => 1, // 1 = no dropdowns, 2 = with dropdowns.
						'container'       => 'div',
						'container_class' => 'navbar navbar-expand-lg navbar-light',
						'container_id'    => 'topmenu',
						'menu_class'      => 'navbar-nav' . $addclass,
						'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
						'walker'          => new WP_Bootstrap_Navwalker(),
					) );
				} else {
					wp_nav_menu(
						array(
							'theme_location'  => 'primary',
							'menu_class'      => 'menu-wrapper' . $addclass,
							'container_class' => 'primary-menu-container',
							'items_wrap'      => '<ul id="primary-menu-list" class="%2$s">%3$s</ul>',
							'fallback_cb'     => false,
						)
					);
				}
		?>
			</nav>
		</div>
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
		<div class="top menu-right">
			<?php if(\get_theme_mod('header_telephone')): ?>
				<div class="header-telephone">
					<a href="tel:<?php echo \get_theme_mod('header_telephone'); ?>"><?php echo \get_theme_mod('header_telephone'); ?></a>
				<span class="telephone-icon">
					<img src="<?php echo \get_template_directory_uri()?>/theme/assets/icons/phone.svg" alt="">
				</span>
				</div>
			<?php endif; ?>
			<?php if(Config::HAS_DESKTOP_MENU_BUTTON === true) : ?>
				<div class="wp-block-button"><a class="wp-block-button__link" style="background-color:#E6623F;" href="/contact-us">Get Started</a></div>

			<?php endif; ?>
		</div>
	</div>
</header><!-- #site-header -->