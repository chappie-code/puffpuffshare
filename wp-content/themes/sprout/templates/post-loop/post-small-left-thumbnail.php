<div class="vw-post-box vw-post-style-small-left-thumbnail clearfix <?php vw_the_post_format_class(); ?>" <?php vw_itemtype('Article'); ?>>
	<?php vw_itemprop_meta( 'datePublished', get_the_time('c') ); ?>
	<?php vw_post_publisher(); ?>
	
	<a class="vw-post-box-thumbnail" href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
		<?php the_post_thumbnail( VW_CONST_THUMBNAIL_SIZE_POST_SMALL_LEFT_THUMBNAIL ); ?>
	</a>
	
	<div class="vw-post-box-inner">
		
		<h5 class="vw-post-box-title" <?php vw_itemprop('headline'); ?>>
			<a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php printf( esc_attr__('Permalink to %s', 'envirra'), the_title_attribute('echo=0') ); ?>" rel="bookmark" <?php vw_itemprop('url'); ?>><?php the_title(); ?></a>
		</h5>

		<div class="vw-post-box-meta vw-header-font">
			<?php if ( vw_post_views_enabled() ) vw_the_post_views_text(); ?>

			<span class="vw-post-author" <?php vw_itemprop('author'); vw_itemtype('Person'); ?>>
				<a class="author-name" href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>" title="<?php _e('Posts by', 'envirra'); ?> <?php the_author(); ?>" rel="author" <?php vw_itemprop('name'); ?>><?php printf( __( 'By %s', 'envirra' ), get_the_author() ); ?></a>
			</span>
		</div>

	</div>
</div>