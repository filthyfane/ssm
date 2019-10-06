 <?php
/**
 * Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<title><?php
			// Print the <title> tag based on what is being viewed.
			global $page, $paged;

			wp_title( '|', true, 'right' );
			bloginfo( 'name' ); // Add the blog name.

			// Add the blog description for the home/front page.
			$site_description = get_bloginfo( 'description', 'display' );
			if ($site_description && ( is_home() || is_front_page())){
				echo " | $site_description";
			}

			// Add a page number if necessary:
			if(($paged >= 2 || $page >= 2 ) && ! is_404()){
				echo ' | ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );
			}?>
		</title>
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<?php
			/*
			 * We add some JavaScript to pages with the comment form
			 * to support sites with threaded comments (when in use).
			 */
			if ( is_singular() && get_option( 'thread_comments' ) )
				wp_enqueue_script( 'comment-reply' );

			/*
			 * Always have wp_head() just before the closing </head>
			 * tag of your theme, or you will break many plugins, which
			 * generally use this hook to add elements to <head> such
			 * as styles, scripts, and meta tags.
			 */
			wp_head();
		?>
	</head>

<body <?php body_class(); ?> post-id="<?php echo get_the_ID(); ?>">
<div class="hfeed">
	<div id="main">