<div class="vw-breaking-news-bar">
	<div class="vw-breaking-news">
		<span class="vw-breaking-news-title vw-header-font"><?php _e( 'BREAKING', 'envirra' ); ?></span>

		<ul class="vw-breaking-news-list">

			<?php $the_query = vw_get_breaking_news_posts(); ?>

			<?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>

				<li><?php the_title( '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a>' ); ?></li>

			<?php endwhile; wp_reset_postdata(); ?>

		</ul>
	</div>
</div>