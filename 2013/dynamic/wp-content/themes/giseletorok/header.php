<!doctype html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title><?php wp_title(); ?></title>
	<link rel="stylesheet" href="/min/g=giselecss" media="all">
	<!--[if lte IE 9]><link rel="stylesheet" href="<?php t_url(); ?>/ie.css" media="all">
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	<!-- WP/ --><?php wp_head(); ?><!-- /WP -->
</head>
<body <?php body_class( 'page-' . $post->post_name ); ?>>
	<header id="head" class="cf">
<?php 	if ( is_front_page() ) : ?>
		<h1 id="logo"><img src="<?php t_url(); ?>/img/logo.png" alt="<?php echo get_option( 'blogname' ); ?>" class="logo" width="210" height="160"></h1>
<?php 	else : ?>
		<div id="logo"><a href="<?php echo home_url( '/' ); ?>"><img src="<?php t_url(); ?>/img/logo.png" alt="<?php echo get_option( 'blogname' ); ?>" class="logo" width="210" height="160"></a></div>
<?php 	endif; ?>
		<?php 
		wp_nav_menu( array(
			'theme_location'  => 'primary',
			'container'       => 'nav', 
			'container_id'    => 'nav',
			'container_class' => 'cf',
			'menu_id'         => 'menu',
			'fallback_cb'     => false,
			'depth'           => 2 
		) ); 
		?>

	</header>
