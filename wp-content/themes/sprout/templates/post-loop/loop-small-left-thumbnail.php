<div class="vw-post-loop vw-post-loop-small-left-thumbnail">	
	<div class="row">
		<div class="col-sm-12 vw-post-loop-inner">
			
			<?php while( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'templates/post-loop/post-small-left-thumbnail', get_post_format() ); ?>
			<?php endwhile; ?>

		</div>
	</div>
</div>