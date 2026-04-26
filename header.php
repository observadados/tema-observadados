<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage EnAJUS
 * @since EnAJUS 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
</head>


<body <?php body_class(); ?>>
<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'enajus' ); ?></a>

		<header id="masthead">

			<button class="nav-toggle" data-toggle="offcanvas">
				<span class="nav-toggle__text">Menu</span>
			</button>

			<div class="site-header-main">

				<div class="site-branding">
					<?php if ( is_front_page()) : ?>
						<h1 class="site-title"><?php observadados_the_custom_logo(); ?>
						<?php
							$logo_rodape = get_field( 'logo_do_rodape', 'option' );
							if ( $logo_rodape)
								echo '<img src="' . $logo_rodape['url'] . '" class="logo-home" alt="' . get_the_title() . '">';
						?></h1>
					<?php else : ?>
						<p class="site-title"><?php observadados_the_custom_logo(); ?></p>
					<?php endif; ?>
				</div>

				<div id="site-header-menus">

					<?php if ( has_nav_menu( 'primary' ) ) : ?>
						<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'enajus' ); ?>">
							<?php
								wp_nav_menu( array(
									'theme_location' => 'primary',
									'menu_class'     => 'primary-menu',
									) );
							?>
						</nav>
					<?php endif; ?>
					<?php if ( has_nav_menu( 'featured' ) ) : ?>
						<nav class="featured-navigation">
							<?php
								wp_nav_menu( array(
									'theme_location' => 'featured',
									'menu_class'     => 'featured-menu',
									) );
							?>
						</nav>
					<?php endif; ?>
				</div>

			</div>

		</header>

		<div id="content" class="site-content-full-width">