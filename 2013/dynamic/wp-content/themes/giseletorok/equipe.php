<?php 
/*
Template name: Equipe
*/
?>
<?php get_header(); ?>
	<article id="body" class="hentry">
<?php 	while( have_posts() ) : the_post(); ?>
		<div class="page-header"></div>
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<div class="entry-content cf">
			<div class="box">
				<?php the_content(); ?>
				<ul class="tag-list">
<?php 				while( has_sub_field( 'especialidades' ) ) : ?>
					<li class="tag-item"><span></span><?php the_sub_field( 'nome' ); ?></li>
<?php 				endwhile; ?>
				</ul>
			</div>
			<ul class="team-list cf">
<?php 			while( has_sub_field( 'equipe' ) ) : ?>
				<li class="team-item">
					<?php 
					$image = get_sub_field( 'imagem' );
					echo wp_get_attachment_image( $image, 'equipe', false, array( 'class' => 'team-image' ) );
					?>

					<div class="flipper">
						<div class="wrapper">
							<div class="cell">
								<dl class="team-info">
									<dt class="team-name"><?php the_sub_field( 'nome' ); ?></dt>
									<dd class="team-role"><?php the_sub_field( 'funcao' ); ?></dd>
									<dd class="team-crm"><?php the_sub_field( 'crm' ); ?></dd>
								</dl>
							</div>
						</div>
					</div>
				</li>
<?php 			endwhile; ?>
			</ul>
		</div>
<?php 	endwhile; ?>
	</article>
<?php get_footer(); ?>