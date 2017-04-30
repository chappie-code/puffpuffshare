<div class="vw-post-meta vw-post-meta-large">
	<div class="vw-post-meta-inner">

		<span class="vw-post-author" <?php vw_itemprop('author'); vw_itemtype('Person'); ?>>

			<?php vw_the_author_avatar( null, VW_CONST_AVATAR_SIZE_SMALL ); ?>

			<?php if ( ! vw_has_coauthors() ) : ?>

				<a class="author-name" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title="<?php printf( __( 'View all posts by %s', 'envirra' ), get_the_author() ); ?>" rel="author" <?php vw_itemprop('name'); ?>><?php the_author(); ?></a>

			<?php else : ?>

				<?php $coauthors = new CoAuthorsIterator(); ?>
				<?php while( $coauthors->iterate() ) : ?>

					<?php if ( ! $coauthors->is_first() ) :  ?>
					<span class="vw-coauthors-separater">,</span>
					<?php endif; ?>

					<a class="author-name" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title="<?php printf( __( 'View all posts by %s', 'envirra' ), get_the_author() ); ?>" rel="author" <?php vw_itemprop('name'); ?>><?php the_author(); ?></a>

				<?php endwhile; ?>

			<?php endif; ?>

		</span>

		<span class="vw-post-meta-separator">&middot;</span>

		<?php vw_the_post_date(); ?>

	</div>

	<div class="vw-post-meta-icons">

		<?php vw_the_comment_link(); ?>

		<?php vw_the_likes(); ?>

		<?php if ( vw_post_views_enabled() ) vw_the_post_views(); ?>

		<?php vw_the_post_shares( 'vw-post-meta-icon' ); ?>

	</div>
</div>