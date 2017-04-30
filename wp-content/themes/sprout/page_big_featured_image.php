<?php 
/**
 * Template Name: Big Featured Image
 */
get_header(); ?>

<?php get_template_part( '/templates/page-title' ); ?>

<div class="vw-page-wrapper clearfix <?php vw_the_sidebar_position_class(); ?>">
	<div class="container">
		<div class="row">

			<div class="vw-page-content" role="main">

				<?php if ( have_posts() ) : ?>

					<?php while ( have_posts() ) : the_post(); ?>
						<article <?php post_class(); ?> <?php vw_itemtype( 'Article' ); ?>>

							<h1 class="entry-title hidden" <?php vw_itemprop('headline'); ?>><?php the_title(); ?></h1>
							<span class="updated hidden" <?php vw_itemprop('datePublished'); ?>><?php echo esc_attr( get_the_date( 'Y-m-d' ) ); ?></span>

							<span class="vw-post-author hidden" <?php vw_itemprop('author'); vw_itemtype('Person'); ?>>
								<a class="author-name" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title="<?php printf( __( 'View all posts by %s', 'envirra' ), get_the_author() ); ?>" rel="author" <?php vw_itemprop('name'); ?>><?php the_author(); ?></a>
							</span>
							
							<div class="clearfix" <?php vw_itemprop('articleBody'); ?>><?php the_content(); ?></div>

							<?php wp_link_pages( array(
								'before'      => '<div class="vw-page-links"><span class="vw-page-links-title">' . __( 'Pages:', 'envirra' ) . '</span>',
								'after'       => '</div>',
								'link_before' => '<span class="vw-page-link">',
								'link_after'  => '</span>',
							) ); ?>

						</article><!-- #post-## -->

					<?php endwhile; ?>

					<?php if ( ! vw_get_theme_option( 'page_force_disable_comments' ) && ( comments_open() || get_comments_number() ) ) comments_template(); ?>

				<?php endif; ?>

			</div>

			<?php get_sidebar(); ?>
		
		</div>
	</div>

</div>

<?php get_footer(); ?>