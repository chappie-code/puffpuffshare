<div class="vw-post-box vw-post-style-classic <?php vw_the_post_format_class(); ?>" <?php vw_itemtype('Article'); ?>>
	<?php vw_itemprop_meta( 'datePublished', get_the_time('c') ); ?>
	<?php vw_post_publisher(); ?>
	
	<?php if ( has_post_thumbnail() ) : ?>
		<a class="vw-post-box-thumbnail" href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
			<?php the_post_thumbnail( VW_CONST_THUMBNAIL_SIZE_CLASSIC ); ?>
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

		<div class="vw-post-box-meta">
			<span class="vw-post-author" <?php vw_itemprop('author');  vw_itemtype('Person'); ?>>
				<?php echo vw_get_avatar( get_the_author_meta('user_email'), VW_CONST_AVATAR_SIZE_SMALL ); ?>

				<a class="author-name" href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>" title="<?php _e('View all posts by', 'envirra'); ?> <?php the_author(); ?>" rel="author" <?php vw_itemprop('name'); ?>><?php the_author(); ?></a>
			</span>

			<?php vw_the_post_date(); ?>

			<div class="vw-post-box-meta-right">
				<?php vw_the_comment_link(); ?>
				<?php vw_the_post_views(); ?>
				<?php vw_the_likes(); ?>
			</div>
		</div>

		<div class="vw-post-box-excerpt">
			<?php the_excerpt(); ?>
		</div>

	</div>

	<div class="vw-post-box-footer vw-header-font">

		<a href="<?php the_permalink(); ?>" class="vw-post-box-read-more"><span><?php _e( 'Read More', 'envirra' ); ?></span> <i class="vw-icon icon-iconic-right-circle"></i></a>
		
		<?php vw_the_post_share_icons(); ?>

	</div>
	
</div>