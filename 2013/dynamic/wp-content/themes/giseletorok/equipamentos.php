<?php 
/*
Template name: Equipamentos
*/
?>
<?php get_header(); ?>
	<article id="body" class="hentry">
		<div class="page-header"></div>
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<div class="entry-content">
<?php 		while( has_sub_field( 'equipamentos' ) ) : ?>
			<h2 class="toggle-head"><?php the_sub_field( 'nome' ); ?></h2>
			<p class="toggle-body"><?php the_sub_field( 'descricao' ); ?></p>
<?php 		endwhile; ?>
		</div>
	</article>
<?php get_footer(); ?>