<?php 
/*
Template name: Clipping
*/
?>
<?php get_header(); ?>
	<article id="body" class="hentry">
		<div class="page-header"></div>
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<div class="entry-content">
			<ul class="clip-list cf">
<?php 			$images = get_field( 'clipping' );
				foreach( $images as $img ) : ?>
				<li class="clip-item">
					<a href="<?php echo $img['url']; ?>" class="fancybox">
						<img src="<?php 
						echo $img['sizes']['clipping']; ?>" alt="" class="clip-image" width="<?php 
						echo $img['sizes']['clipping-width']; ?>" height="<?php 
						echo $img['sizes']['clipping-height']; ?>">
						<div class="flipper">
							<div class="wrapper">
								<div class="cell">
									<dl class="clip-info">
										<dt class="clip-name"><?php echo $img['title']; ?></dt>
										<dd class="clip-date"><?php echo $img['caption']; ?></dd>
									</dl>
								</div>
							</div>
						</div>
					</a>
				</li>
<?php 			endforeach; ?>
			</ul>
		</div>
	</article>
<?php get_footer(); ?>