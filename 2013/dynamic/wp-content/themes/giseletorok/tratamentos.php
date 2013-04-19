<?php 
/*
Template name: Tratamentos
*/
?>
<?php get_header(); ?>
	<article id="body" class="hentry">
<?php 	while( have_posts() ) : the_post(); ?>
		<div class="page-header"></div>
		<hgroup class="hgroup">
			<h1 class="parent-title">Tratamentos</h1>
			<h2 class="entry-title"><?php the_title(); ?></h2>
		</hgroup>
		<div class="entry-content">
			<?php the_content(); ?>
<?php 		while( has_sub_field( 'tratamentos' ) ) : ?>
			<h3 class="toggle-head"><?php the_sub_field( 'nome' ); ?></h3>
			<div class="toggle-body">
				<p><?php the_sub_field( 'texto' ); ?></p>
				<p><?php 
				$images = get_sub_field( 'galeria' );
				if ( $images ) foreach( $images as $img ) {
					$src = $img['sizes']['galeria'];
					$width = $img['sizes']['galeria-width'];
					$height = $img['sizes']['galeria-height'];
					echo "<img src='{$src}' alt='' class='alignleft' width='{$width}' height='{$height}'>";
				} ?></p>
			</div>
<?php 		endwhile; ?>
		</div>
<?php 	endwhile; ?>
	</article>
<?php get_footer(); ?>