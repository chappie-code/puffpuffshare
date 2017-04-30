<?php get_header(); ?>

<?php get_template_part( '/templates/page-title' ); ?>

<div class="vw-page-wrapper clearfix <?php vw_the_sidebar_position_class(); ?>">
	<div class="container">
		<div class="row">

			<div class="vw-page-content" role="main">

				<?php if ( have_posts() ) : ?>

					<?php do_action( 'vw_action_before_single_post' ); ?>

					<?php while ( have_posts() ) : the_post(); ?>
						<article <?php post_class( 'vw-main-post clearfix' ); ?> <?php vw_itemtype( 'Article' ); ?>>

							<span class="author vcard hidden"><span class="fn"><?php echo esc_attr( get_the_author() ); ?></span></span>
							<span class="vw-post-author hidden" <?php vw_itemprop('author');  vw_itemtype('Person'); ?>>
								<a class="author-name" href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>" title="<?php _e('View all posts by', 'envirra'); ?> <?php the_author(); ?>" rel="author" <?php vw_itemprop('name'); ?>><?php the_author(); ?></a>
							</span>
							<span class="updated hidden"><?php echo esc_attr( get_the_date( 'Y-m-d' ) ); ?></span>
							<?php vw_post_publisher(); ?>
							<?php vw_itemprop_meta( 'headline', get_the_title() ); ?>
							<?php vw_itemprop_meta( 'datePublished', get_the_time('c') ); ?>
							<?php vw_itemprop_meta( 'image', vw_get_featured_image_url( 'full' ) ); ?>
						
							<?php if ( ! has_post_format( 'gallery' ) ) vw_the_embeded_media(); ?>

							<div class="vw-post-content clearfix" <?php vw_itemprop('articleBody'); ?>><?php the_content(); ?></div>

							<?php wp_link_pages( array(
								'before'      => '<div class="vw-page-links"><span class="vw-page-links-title">' . __( 'Pages:', 'envirra' ) . '</span>',
								'after'       => '</div>',
								'link_before' => '<span class="vw-page-link">',
								'link_after'  => '</span>',
							) ); ?>

							<?php the_tags( '<div class="vw-tag-links"><span class="vw-tag-links-title">'.__( 'Tags:', 'envirra' ).'</span>', '', '</div>' ); ?>

						</article><!-- #post-## -->

					<?php endwhile; ?>

					<?php do_action( 'vw_action_after_single_post' ); ?>

					<?php vw_the_post_footer_sections(); ?>

				<?php endif; ?>

			</div>

			<?php get_sidebar(); ?>
		
		</div>
	</div>

</div>

<?php get_footer(); ?>