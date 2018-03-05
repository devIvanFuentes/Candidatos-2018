<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package candidatos
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<header id="masthead" class="site-header">
		<nav>
			<div class="nav-wrapper">
				<a href="#!" class="brand-logo">
					<?php the_custom_logo(  ); ?>
				</a>
				<a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
				
				<ul class="right hide-on-med-and-down social__media__header">
					<li><a class="icon-facebook" href="sass.html"></a></li>
					<li><a class="icon-twitter" href="badges.html"></a></li>
					<li><a class="icon-youtube" href="collapsible.html"></a></li>
					<li><a class="icon-instagram" href="mobile.html"></a></li>
      			</ul>
      
      			<ul class="side-nav" id="mobile-demo">
					<li><a href="<?php echo get_home_url(); ?>">Inicio</a></li>
					<li><a href="#">Encuestas</a></li>
					<div class="subitems">
						<li><a href="<?php echo get_home_url().'/locacion/nacional/'; ?>">Nacional</a></li>
						<li><a href="<?php echo get_home_url().'/locacion/jalisco/'; ?>">Jalisco</a></li>
						<li><a href="<?php echo get_home_url().'/locacion/guanajuato/'; ?>">Guanajuato</a></li>
						<li><a href="<?php echo get_home_url().'/locacion/ciudad-de-mexico/'; ?>">CDMX</a></li>
						<li><a href="<?php echo get_home_url().'/locacion/puebla/'; ?>">Puebla</a></li>
						<li><a href="<?php echo get_home_url().'/locacion/tabasco/'; ?>">Tabasco</a></li>
						<li><a href="<?php echo get_home_url().'/locacion/chiapas/'; ?>">Chiapas</a></li>
						<li><a href="<?php echo get_home_url().'/locacion/yucatan/'; ?>">Yucatan</a></li>
					</div>

					<div class="social__media__menu">
						<a class="icon-facebook" href="sass.html"></a>
						<a class="icon-twitter" href="badges.html"></a>
						<a class="icon-youtube" href="collapsible.html"></a>
						<a class="icon-instagram" href="mobile.html"></a>
					</div>

					<?php get_template_part( 'searchform', 'menu' ); ?>

      			</ul>
    		</div>
  		</nav>
	</header><!-- #masthead -->


	<div id="content" class="site-content">
	<?php get_template_part('template-parts/content', 'breaking' ); ?>
