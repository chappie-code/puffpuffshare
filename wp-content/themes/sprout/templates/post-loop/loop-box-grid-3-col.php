<div class="vw-post-loop vw-post-loop-box-grid-3-col">	
	<div class="row">
		<div class="col-sm-12">
			<div class="vw-post-loop-inner vw-block-grid vw-block-grid-xs-1 vw-block-grid-sm-3">

			<?php while( have_posts() ) : the_post(); ?>
				<div class="vw-block-grid-item">
					<?php get_template_part( 'templates/post-loop/post-box', get_post_format() ); ?>
				</div>
			<?php endwhile; ?>

			</div>
		</div>
	</div>
</div>