<div class="vw-post-box vw-post-style-box <?php vw_the_post_format_class(); ?>" <?php vw_itemtype('Article'); ?>>
	<?php vw_itemprop_meta( 'datePublished', get_the_time('c') ); ?>
	<?php vw_post_publisher(); ?>

	<a class="vw-post-box-thumbnail" href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark" <?php vw_itemprop('url'); ?>>
		<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail( VW_CONST_THUMBNAIL_SIZE_POST_BLOCK ); ?>
		<?php endif; ?>

		<?php vw_the_review_summary_bar(); /*don't move below the post box title */ ?>

		<h3 class="vw-post-box-title" <?php vw_itemprop('headline'); ?>>
			<?php the_title(); ?>
		</h3>
	</a>

	<div class="vw-post-box-inner">

		<div class="vw-post-box-footer vw-header-font">

			<?php if ( vw_post_views_enabled() ) vw_the_post_views(); ?>

			<?php vw_the_likes(); ?>
			
			<?php vw_the_comment_link(); ?>
			
		</div>
	</div>
	
</div>