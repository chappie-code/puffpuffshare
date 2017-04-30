<?php get_header(); ?>

<?php
if ( is_search() ) {
	get_template_part( '/templates/page-title' );
}
?>

<div class="vw-page-wrapper clearfix <?php vw_the_sidebar_position_class(); ?>">
	<div class="container">
		<div class="row">

			<div id="vw-page-content" class="vw-page-content" role="main">

				<?php if ( is_search() && ( get_search_query() == '' || ! have_posts() ) ) : ?>

					<?php the_widget( 'WP_Widget_Search' ); ?>
					<p><?php _e( 'No search result were found. Please try a different search term.' ) ?></p>

				<?php else: ?>

					<?php if ( have_posts() ) : ?>

						<?php do_action( 'vw_action_before_archive_posts' ); ?>

						<?php get_template_part( 'templates/post-loop/loop', vw_get_archive_blog_layout() ); ?>

						<?php do_action( 'vw_action_after_archive_posts' ); ?>

						<?php vw_the_pagination(); ?>

					<?php endif; ?>
				<?php endif; ?>
				
			</div>

			<?php get_sidebar(); ?>
		
		</div>
	</div>

</div>

<?php get_footer(); ?>