<div class="vw-post-loop vw-post-loop-slider vw-post-loop-slider-large-single vw-bxslider vw-bxslider-loading">
	<ul class="vw-bxslider-slides">
	<?php while( have_posts() ) : the_post(); ?>
		<li>
			<?php get_template_part( 'templates/post-loop/post-slide-large', get_post_format() ); ?>
		</li>
	<?php endwhile; ?>
	</ul>
</div>