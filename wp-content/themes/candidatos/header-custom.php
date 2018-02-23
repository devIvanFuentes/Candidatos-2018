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
					<li><a href="sass.html">Sass</a></li>
					<li><a href="badges.html">Components</a></li>
					<li><a href="collapsible.html">Javascript</a></li>
					<li><a href="mobile.html">Mobile</a></li>
      			</ul>
    		</div>
  		</nav>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
