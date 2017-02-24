<?php
/**
 * The header template file
 *
 * @package WordPress
 * @subpackage The Architect
 * @since The Architect 1.0
 */
?>
<!DOCTYPE html>
<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!-->
<html <?php language_attributes(); ?>><!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no"/>
	<!--[if lt IE 9]>
	    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
	<?php wp_head(); ?>
</head>

	<body <?php body_class(); ?>>
                <div id="fb-root"></div>
                <script>(function(d, s, id) {
                  var js, fjs = d.getElementsByTagName(s)[0];
                  if (d.getElementById(id)) return;
                  js = d.createElement(s); js.id = id;
                  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8&appId=584245598253249";
                  fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));</script>
		<header class="header" role="banner">

			<div class="wrap cf">

				<div class="m-2of3 t-1of3 d-1of3">

					<div class="brand" style="padding-top: <?php echo ot_get_option('wpl_logo_top_margin'); ?>px;">

						<h1 id="site-title">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo('description'); ?>" rel="home">
								<?php if ( ot_get_option('wpl_logo_image') != ''){ ?>
                                                                    <img src="<?php echo ot_get_option('wpl_logo_image'); ?>" width="75px">
								<?php } else {
									bloginfo('name');
								} ?>
							</a>
						</h1>
						<h2 id="site-description"><?php bloginfo('description'); ?></h2>
						
					</div>

				</div>

				<div class="m-1of3 t-2of3 d-2of3 last-col">

					<nav role="social">
						<?php wp_nav_menu(array(
							'container' => false,                           // remove nav container
							'container_class' => 'menu cf',                 // class of container (should you choose to use it)
							'menu' => __( 'Secondary Navigation', 'thearchitect-wpl' ), // nav name
							'menu_class' => 'nav secondary cf',               // adding custom nav class
							'theme_location' => 'secondary',                  // where it's located in the theme
							'before' => '',                                 // before the menu
		    				'after' => '',                                  // after the menu
		    				'link_before' => '',                            // before each link
		    				'link_after' => '',                             // after each link
		    				'depth' => 0,                                   // limit the depth of the nav
							'fallback_cb' => ''                             // fallback function (if there is one)
						)); ?>
					</nav>

					<nav role="navigation">
						<?php wp_nav_menu(array(
							'container' => false,                           // remove nav container
							'container_class' => 'menu cf',                 // class of container (should you choose to use it)
							'menu' => __( 'Primary Navigation', 'thearchitect-wpl' ),   // nav name
							'menu_class' => 'nav primary cf',               // adding custom nav class
							'theme_location' => 'primary',                 // where it's located in the theme
							'before' => '',                                 // before the menu
		    				'after' => '',                                  // after the menu
		    				'link_before' => '',                            // before each link
		    				'link_after' => '',                             // after each link
		    				'depth' => 0,                                   // limit the depth of the nav
							'fallback_cb' => ''                             // fallback function (if there is one)
						)); ?>
					</nav>

					<div class="mobile_menu_button"><span><i class="fa fa-lg fa-bars"></i></span></div>

				</div>

				<nav class="mobile_menu">
					<?php wp_nav_menu(array(
						'container'  => false,
						'container_class' => 'menu cf',
						'menu_class' => 'mobile',
						'theme_location' => 'primary' ,
						'before' => '',                                 // before the menu
	    				'after' => '',                                  // after the menu
	    				'link_before' => '',                            // before each link
	    				'link_after' => '',                             // after each link
	    				'depth' => 2,                                   // limit the depth of the nav
						'fallback_cb' => ''                             // fallback function (if there is one)
					)); ?>
				</nav>

			</div>

		</header>

	<div id="container">
