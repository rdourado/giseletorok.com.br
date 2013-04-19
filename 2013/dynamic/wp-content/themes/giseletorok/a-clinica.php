<?php 
/*
Template name: A Clínica
*/
?>
<?php get_header(); ?>
	<article id="body" class="hentry">
<?php 	while( have_posts() ) : the_post(); ?>
		<div class="page-header"></div>
		<hgroup class="hgroup">
			<h1 class="parent-title">A Clínica</h1>
			<h2 class="entry-title"><?php the_title(); ?></h2>
		</hgroup>
		<div class="entry-content cf">
			<?php the_content(); ?>
		</div>
<?php 	endwhile; ?>
	</article>
<?php get_footer(); ?>