<div class="vw-post-loop vw-post-loop-slider vw-post-loop-slider-large vw-bxslider vw-bxslider-loading">
	<ul class="vw-bxslider-slides">
	<?php while( have_posts() ) : ?>
		<li>
			<div class="vw-box-3-wrapper clearfix">
				<?php if ( vw_have_more_post() ) : the_post(); ?>
				<div class="vw-box-3 vw-box-3-left">
					<?php get_template_part( 'templates/post-loop/post-slide-box-large', get_post_format() ); ?>
				</div>
				<?php endif; ?>

				<?php if ( vw_have_more_post() ) : the_post(); ?>
				<div class="vw-box-3 vw-box-3-right-top">
					<?php get_template_part( 'templates/post-loop/post-slide-box', get_post_format() ); ?>
				</div>
				<?php endif; ?>

				<?php if ( vw_have_more_post() ) : the_post(); ?>
				<div class="vw-box-3 vw-box-3-right-bottom">
					<?php get_template_part( 'templates/post-loop/post-slide-box', get_post_format() ); ?>
				</div>
				<?php endif; ?>
			</div>
		</li>
	<?php endwhile; ?>
	</ul>
</div>