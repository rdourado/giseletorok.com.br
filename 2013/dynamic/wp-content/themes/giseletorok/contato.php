<?php 
/*
Template name: Contato
*/
if ( function_exists( 'wpcf7_enqueue_scripts' ) ) wpcf7_enqueue_scripts();
?>
<?php get_header(); ?>
	<article id="body" class="hentry">
<?php 	while( have_posts() ) : the_post(); ?>
		<div class="page-header"></div>
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<div class="entry-content">
			<?php the_content(); ?>
		</div>
<?php 	endwhile; ?>
	</article>
<?php get_footer(); ?>