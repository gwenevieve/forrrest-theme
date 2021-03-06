<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package forrrest
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<link href="https://fonts.googleapis.com/css?family=Charm" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400" rel="stylesheet">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'forrrest' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="site-branding">
			<?php
			the_custom_logo();
				?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php
		
			$forrrest_description = get_bloginfo( 'description', 'display' );
			if ( $forrrest_description || is_customize_preview() ) :
				?>
				<p class="site-description"><?php echo $forrrest_description; /* WPCS: xss ok. */ ?></p>
			<?php endif; ?>
			</div><!-- .site-branding -->
			<div class="navigations">
			<nav id="site-primary-navigation" class="main-navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
			<?php esc_html_e( 'Primary Menu', 'forrrest' ); ?></button>
			<?php
			wp_nav_menu( array(
				'theme_location' => 'Primary menu',
				'container_class' => 'primary_menu',
			) );
			?>
		</nav><!-- #site-primary-navigation -->
		<nav id="site-secondary-navigation" class="secondary-navigation">
			<button class="menu-toggle" aria-controls="secondary-menu" aria-expanded="false">
			<?php esc_html_e( 'Secondary Menu', 'forrrest' ); ?></button>
			<?php
			wp_nav_menu( array( 
				'theme_location' => 'Secondary menu',
				'container_class' => 'secondary_menu' ) ); ?>
		</nav><!-- #site-secondary-navigation -->
		</div><!-- .navigations -->
	</header><!-- #masthead -->


	<div class="page-container">
		<?php
			if (is_front_page()) { ?>
			<div class="custom-header-container">
			<?php
			the_header_image_tag();
			?> 
			</div>
			<?php 
			} ?>
		
	<div id="content" class="site-content">
