<div class="vw-post-box vw-post-style-block vw-post-style-block-no-excerpt <?php vw_the_post_format_class(); ?>" <?php vw_itemtype('Article'); ?>>
	<?php vw_itemprop_meta( 'datePublished', get_the_time('c') ); ?>
	<?php vw_post_publisher(); ?>

	<span class="vw-post-author" <?php vw_itemprop('author');  vw_itemtype('Person'); ?>>
		<a class="author-name" href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>" title="<?php _e('View all posts by', 'envirra'); ?> <?php the_author(); ?>" rel="author" <?php vw_itemprop('name'); ?>><?php the_author(); ?></a>
	</span>
	
	<?php if ( has_post_thumbnail() ) : ?>
	<a class="vw-post-box-thumbnail" href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
		<?php the_post_thumbnail( VW_CONST_THUMBNAIL_SIZE_POST_BLOCK ); ?>
		<?php vw_the_post_format_icon(); ?>
		<?php vw_the_review_summary_bar(); ?>
	</a>
	<?php endif; ?>

	<div class="vw-post-box-inner">
		
		<?php vw_the_category(); ?>

		<h3 class="vw-post-box-title" <?php vw_itemprop('headline'); ?>>
			<a href="<?php the_permalink(); ?>" class="" <?php vw_itemprop('url'); ?>>
				<?php the_title(); ?>
			</a>
		</h3>
	</div>
	
</div>