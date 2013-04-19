<?php get_header(); ?>
	<article id="body" class="hentry">
<?php 	while( have_posts() ) : the_post(); ?>
		<div class="page-header"></div>
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<div class="entry-content cf">
			<?php the_content(); ?>
		</div>
<?php 	endwhile; ?>
	</article>
<?php get_footer(); ?>