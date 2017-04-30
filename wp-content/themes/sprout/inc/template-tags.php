<?php
/* -----------------------------------------------------------------------------
 * The Pagination
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_the_pagination' ) ) {
	function vw_the_pagination( $pagination_style = 'show' ) {
		// Don't print empty markup if there's only one page.
		if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
			return;
		}

		$paged        = vw_get_paged();
		$pagenum_link = html_entity_decode( get_pagenum_link() );
		$query_args   = array();
		$url_parts    = explode( '?', $pagenum_link );

		if ( isset( $url_parts[1] ) ) {
			wp_parse_str( $url_parts[1], $query_args );
		}

		$pagenum_link = esc_url_raw( remove_query_arg( array_keys( $query_args ), $pagenum_link ) );
		$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

		$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
		$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';
		
		// Support offset
		if ( ! empty( $GLOBALS['wp_query']->query['offset'] ) ) {
			$total_page = ceil( ( $GLOBALS['wp_query']->found_posts - $GLOBALS['wp_query']->query['offset'] ) / $GLOBALS['wp_query']->query['posts_per_page'] );
		} else {
			$total_page = max( 1, $GLOBALS['wp_query']->max_num_pages );
		}

		// Set up paginated links.
		$links = '';
		$paginate_args = array(
			// 'base'     => $pagenum_link,
			// 'format'   => $format,
			'total'    => $total_page,
			'current'  => $paged,
			'end_size' => VW_CONST_PAGINATE_LINKS_END_SIZE,
			'mid_size' => VW_CONST_PAGINATE_LINKS_MID_SIZE,
			'add_args' => array_map( 'urlencode', $query_args ),
			'prev_text' => '<i class="icon-iconic-left"></i>',
			'next_text' => '<i class="icon-iconic-right"></i>',
		);

		if ( 'infinite' == $pagination_style || 'infinite-load-more' == $pagination_style ) {
			$paginate_args['type'] = 'array';
			$paginate_links = paginate_links( $paginate_args );

			$classes = 'vw-pagination-load-more vw-pagination-infinite';
			if ( 'infinite' == $pagination_style ) {
				$classes .= ' vw-pagination-infinite-auto';
			}

			if ( ! empty( $paginate_links ) ) {
				$next_link = array_pop( $paginate_links );

				if ( stripos( $next_link, 'next page-numbers' ) ) {
					if ( preg_match( '|http[^"]+|i', $next_link, $matches ) ) {
						$links = '<a class="'.esc_attr( $classes ).'" href="'.esc_url( $matches[0] ).'">'.__( 'Load More', 'envirra' ).'</a>';
					}
				}
				
			}

		} else {
			$links = paginate_links( $paginate_args );
		}

		if ( $links ) :
		?>
		<nav class="vw-page-navigation clearfix">
			<span class="vw-page-navigation-title"><?php _e( 'Page : ', 'envirra' ); ?></span>
			
			<div class="vw-page-navigation-pagination">
				<?php echo $links; ?>
			</div><!-- .pagination -->

			<div class="vw-page-navigation-divider"></div>
		</nav><!-- .navigation -->
		<?php
		endif;
	}
}

/* -----------------------------------------------------------------------------
 * Render Site Social Icons
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_the_site_social_profiles' ) ) {
	function vw_the_site_social_profiles() {
		echo '<span class="vw-site-social-profile">';

		 $url = vw_get_theme_option( 'social_delicious' );
		if ( ! empty( $url ) ) printf( '<a class="vw-site-social-profile-icon vw-site-social-delicious" href="%s" target="_blank" title="Delicious"><i class="vw-icon icon-social-delicious"></i></a>', $url );

		$url = vw_get_theme_option( 'social_digg' );
		if ( ! empty( $url ) ) printf( '<a class="vw-site-social-profile-icon vw-site-social-digg" href="%s" target="_blank" title="Digg"><i class="vw-icon icon-social-digg"></i></a>', $url );

		$url = vw_get_theme_option( 'social_dribbble' );
		if ( ! empty( $url ) ) printf( '<a class="vw-site-social-profile-icon vw-site-social-dribbble" href="%s" target="_blank" title="Dribbble"><i class="vw-icon icon-social-dribbble"></i></a>', $url );

		$url = vw_get_theme_option( 'social_facebook' );
		if ( ! empty( $url ) ) printf( '<a class="vw-site-social-profile-icon vw-site-social-facebook" href="%s" target="_blank" title="Facebook"><i class="vw-icon icon-social-facebook"></i></a>', $url );

		$url = vw_get_theme_option( 'social_flickr' );
		if ( ! empty( $url ) ) printf( '<a class="vw-site-social-profile-icon vw-site-social-flickr" href="%s" target="_blank" title="Flickr"><i class="vw-icon icon-social-flickr"></i></a>', $url );

		$url = vw_get_theme_option( 'social_forrst' );
		if ( ! empty( $url ) ) printf( '<a class="vw-site-social-profile-icon vw-site-social-forrst" href="%s" target="_blank" title="Forrst"><i class="vw-icon icon-social-forrst"></i></a>', $url );

		$url = vw_get_theme_option( 'social_github' );
		if ( ! empty( $url ) ) printf( '<a class="vw-site-social-profile-icon vw-site-social-github" href="%s" target="_blank" title="GitHub"><i class="vw-icon icon-social-github"></i></a>', $url );

		$url = vw_get_theme_option( 'social_googleplus' );
		if ( ! empty( $url ) ) printf( '<a class="vw-site-social-profile-icon vw-site-social-gplus" href="%s" target="_blank" title="Google+"><i class="vw-icon icon-social-gplus"></i></a>', $url );

		$url = vw_get_theme_option( 'social_instagram' );
		if ( ! empty( $url ) ) printf( '<a class="vw-site-social-profile-icon vw-site-social-instagram" href="%s" target="_blank" title="Instagram"><i class="vw-icon icon-social-instagram"></i></a>', $url );

		$url = vw_get_theme_option( 'social_linkedin' );
		if ( ! empty( $url ) ) printf( '<a class="vw-site-social-profile-icon vw-site-social-linkedin" href="%s" target="_blank" title="LinkedIn"><i class="vw-icon icon-social-linkedin"></i></a>', $url );

		$url = vw_get_theme_option( 'social_lastfm' );
		if ( ! empty( $url ) ) printf( '<a class="vw-site-social-profile-icon vw-site-social-lastfm" href="%s" target="_blank" title="Last.fm"><i class="vw-icon icon-social-lastfm"></i></a>', $url );

		$url = vw_get_theme_option( 'social_pinterest' );
		if ( ! empty( $url ) ) printf( '<a class="vw-site-social-profile-icon vw-site-social-pinterest" href="%s" target="_blank" title="Pinterest"><i class="vw-icon icon-social-pinterest"></i></a>', $url );

		$url = vw_get_theme_option( 'social_rss' );
		if ( ! empty( $url ) ) printf( '<a class="vw-site-social-profile-icon vw-site-social-rss" href="%s" target="_blank" title="RSS"><i class="vw-icon icon-social-rss"></i></a>', $url );

		$url = vw_get_theme_option( 'social_skype' );
		if ( ! empty( $url ) ) printf( '<a class="vw-site-social-profile-icon vw-site-social-skype" href="%s" target="_blank" title="Skype"><i class="vw-icon icon-social-skype"></i></a>', $url );

		$url = vw_get_theme_option( 'social_tumblr' );
		if ( ! empty( $url ) ) printf( '<a class="vw-site-social-profile-icon vw-site-social-tumblr" href="%s" target="_blank" title="Tumblr"><i class="vw-icon icon-social-tumblr"></i></a>', $url );

		$url = vw_get_theme_option( 'social_twitter' );
		if ( ! empty( $url ) ) printf( '<a class="vw-site-social-profile-icon vw-site-social-twitter" href="%s" target="_blank" title="Twitter"><i class="vw-icon icon-social-twitter"></i></a>', $url );

		$url = vw_get_theme_option( 'social_vimeo' );
		if ( ! empty( $url ) ) printf( '<a class="vw-site-social-profile-icon vw-site-social-vimeo" href="%s" target="_blank" title="Vimeo"><i class="vw-icon icon-social-vimeo"></i></a>', $url );

		$url = vw_get_theme_option( 'social_yahoo' );
		if ( ! empty( $url ) ) printf( '<a class="vw-site-social-profile-icon vw-site-social-yahoo" href="%s" target="_blank" title="Yahoo"><i class="vw-icon icon-social-yahoo"></i></a>', $url );

		$url = vw_get_theme_option( 'social_youtube' );
		if ( ! empty( $url ) ) printf( '<a class="vw-site-social-profile-icon vw-site-social-youtube" href="%s" target="_blank" title="Youtube"><i class="vw-icon icon-social-youtube"></i></a>', $url );

		echo '</span>';
	}
}

/* -----------------------------------------------------------------------------
 * The category class
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_get_the_category_class' ) ) {
	function vw_get_the_category_class( $cat_ID = '' ) {
		if ( empty( $cat_ID ) ) {
			$cat_ID = vw_get_single_cat_id();
		}

		return esc_attr( sprintf( 'vw-cat-id-%s', $cat_ID ) );
	}
}

if ( ! function_exists( 'vw_the_category_class' ) ) {
	function vw_the_category_class( $cat_ID = '' ) {
		echo vw_get_the_category_class( $cat_ID );
	}
}

/* -----------------------------------------------------------------------------
 * The Categoy Thumbnail
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_get_the_category_thumbnail' ) ) {
	function vw_get_the_category_thumbnail( $size = VW_CONST_THUMBNAIL_SIZE_CATEGORY ) {
		global $wp_query;
		$image_id = false;

		if ( in_the_loop() ) {
			$post_categories = wp_get_post_categories( get_the_id() );
			if ( empty( $post_categories ) ) return;

			// $cat_obj = get_category( $post_categories[ 0 ] );
			foreach ( $post_categories as $cat_ID ) {
				$image_id = vw_get_category_option( $cat_ID, 'category_thumbnail' );
				if ( ! empty( $image_id ) ) break;
			}
		} else {
			$cat_obj = $wp_query->get_queried_object();
			$image_id = vw_get_category_option( $cat_obj->term_id, 'category_thumbnail' );
		}

		if ( ! $image_id ) return;

		$image = wp_get_attachment_image_src( $image_id, $size );

		if ( ! $image ) return;

		if ( ! defined( 'VW_CONST_DISABLE_RETINA_CATEGORY_THUMBNAIL' ) ) {
			$image[1] = $image[1] / 2; // 0.5x width
			$image[2] = $image[2] / 2; // 0.5x height
		}

		$image_sizes = '';
		if ( ! empty( $image[1] ) && ! empty( $image[2] ) ) {
			$image_sizes = sprintf( 'width="%s" height="%s"', esc_attr( $image[1] ), esc_attr( $image[2] ) );
		}

		return sprintf( '<img class="vw-category-thumbnail" src="%s" %s>', esc_url( $image[0] ), $image_sizes );
	}
}

/* -----------------------------------------------------------------------------
 * Get Category Option Proxy
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_get_archive_category' ) ) {
	function vw_get_archive_category() {
		return get_category( get_query_var('cat') );
	}
}

if ( ! function_exists( 'vw_get_archive_category_id' ) ) {
	function vw_get_archive_category_id() {
		$category = vw_get_archive_category();

		if ( ! empty( $category ) ) {
			return $category->cat_ID;
		} else {
			return '';
		}
	}
}

if ( ! function_exists( 'vw_get_single_cat_id' ) ) {
	function vw_get_single_cat_id() {
		$category = get_the_category();
		if ( ! $category ) return false;

		return $category[0]->term_id;
	}
}

if ( ! function_exists( 'vw_get_category_option' ) ) {
	function vw_get_category_option( $cat_ID, $option_name, $default = null ) {
		$option_name = sprintf( 'category_%s_%s', $cat_ID, $option_name );
		return get_option( $option_name, $default );
	}
}

if ( ! function_exists( 'vw_get_product_category_option' ) ) {
	function vw_get_product_category_option( $cat_ID, $option_name, $default = null ) {
		$option_name = sprintf( 'product_cat_%s_%s', $cat_ID, $option_name );
		return get_option( $option_name, $default );
	}
}

/* -----------------------------------------------------------------------------
 * The category links
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_the_category' ) ) {
	function vw_the_category( $classes='' ) {
		$categories = get_the_category();

		if( $categories ){
			echo '<div class="vw-post-categories">';

			if ( is_sticky() ) {
				echo '<a class="vw-sticky-link">'.__( 'Sticky', 'envirra' ).'</a>';
			}

			foreach( $categories as $category ) {
				$classes .= ' vw-category-link ' . vw_get_the_category_class( $category->term_id );
				echo '<a class="'.esc_attr( $classes ).'" href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s", 'envirra' ), $category->name ) ) . '" rel="category">'.$category->cat_name.'</a>';
			}
			echo '</div>';
		}
	}
}

/* -----------------------------------------------------------------------------
 * The Post Thumbnail (to support the featured image 2)
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_get_featured_image_id' ) ) {
	function vw_get_featured_image_id( $post_id = '' ) {
		global $post;
		if ( empty( $post_id ) ) {
			$post_id = $post->ID;
		}

		return get_post_thumbnail_id( $post_id );
	}
}

if ( ! function_exists( 'vw_the_post_thumbnail' ) ) {
	function vw_the_post_thumbnail( $size = VW_CONST_THUMBNAIL_SIZE_SINGLE_POST_CLASSIC, $attr = '' ) {
		
	}
}

add_filter( 'wp_get_attachment_image_attributes', 'vw_add_image_attr' );
if ( ! function_exists( 'vw_add_image_attr' ) ) {
	function vw_add_image_attr( $attr ) {
		$attr['itemprop'] = 'image';
		return $attr;
	}
}

/* -----------------------------------------------------------------------------
 * The Copyright Text
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_the_copyright' ) ) {
	function vw_the_copyright() {
		$copyright_text = vw_get_theme_option( 'copyright_text' );
		if ( function_exists( 'icl_t' ) ) {
			$copyright_text = icl_t( VW_THEME_NAME.' Copyright', strtolower(VW_THEME_NAME.'_copyright'), $copyright_text );
		}
		
		echo '<div class="vw-copyright">';
		echo do_shortcode( $copyright_text );
		echo '</div>';
	}
}

/* -----------------------------------------------------------------------------
 * The Post Embeded Media
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_the_embeded_media' ) ) {
	function vw_the_embeded_media( $thumbnail_size = VW_CONST_THUMBNAIL_SIZE_SINGLE_POST_CLASSIC ) {
		  vw_the_embeded_gallery( $thumbnail_size );
		  vw_the_embeded_video();
		  vw_the_embeded_audio();
	}
}

if ( ! function_exists( 'vw_get_featured_image_url' ) ) {
	function vw_get_featured_image_url( $size, $post_id = '' ) {
		if ( empty( $post_id ) ) {
			$post_id = get_the_id();
		}

		$featured_image_id = vw_get_featured_image_id( $post_id );

		$image_src = wp_get_attachment_image_src( $featured_image_id, $size );

		if ( ! empty( $image_src ) ) {
			return $image_src[0];
		} else {
			return '';
		}
	}
}

if ( ! function_exists( 'vw_the_featured_image' ) ) {
	function vw_the_featured_image( $thumbnail_size = VW_CONST_THUMBNAIL_SIZE_SINGLE_POST_CLASSIC ) {
		if ( has_post_thumbnail() ) {
			$featured_image_id = vw_get_featured_image_id();
			$attachment = get_post( $featured_image_id );
			if ( empty( $featured_image_id ) || empty( $attachment ) ) return;

			$full_image_url = wp_get_attachment_image_src( $featured_image_id, 'full' );
			$image_caption = $attachment->post_excerpt;
			$has_caption = ! empty( $image_caption );

			if ( $has_caption ) {
				$figure_classes = 'wp-caption';

			} else {
				$figure_classes = '';
				$image_caption = get_the_title();
			}

			?>
			<figure class="vw-featured-image <?php echo esc_attr( $figure_classes ); ?>" <?php vw_itemprop( 'image' ); vw_itemtype( 'ImageObject' ); ?>>

				<a class="" href="<?php echo esc_url( $full_image_url[0] ); ?>" title="<?php echo esc_attr( $image_caption ); ?>" rel="bookmark" <?php vw_itemprop( 'image' ); ?>>
					<?php echo wp_get_attachment_image( $featured_image_id, $thumbnail_size, false, array( 'class' => "attachment-{$thumbnail_size} wp-post-image", 'itemprop'=>'thumbnail' ) ); ?>
				</a>

				<meta itemprop='url' content='<?php echo esc_url( $full_image_url[0] ); ?>'/>
				<meta itemprop='width' content='<?php echo esc_url( $full_image_url[1] ); ?>'/>
				<meta itemprop='height' content='<?php echo esc_url( $full_image_url[2] ); ?>'/>

				<?php if ( $has_caption ) : ?>
					<figcaption class="vw-featured-image-caption wp-caption-text">
						<span <?php vw_itemprop( 'caption' ); ?>>
							<?php echo $image_caption; ?>
						</span>
					</figcaption>
				<?php endif; ?>

			</figure>
			<?php
		}
	}
}

if ( ! function_exists( 'vw_the_embeded_gallery' ) ) {
	function vw_the_embeded_gallery( $thumbnail_size = VW_CONST_THUMBNAIL_SIZE_SINGLE_POST_CLASSIC ) {
		if ( has_post_format( 'gallery' ) ) {
			$attachments = get_post_meta( get_the_ID(), 'vw_post_format_gallery_images' );

			if ( ! empty( $attachments ) ) : ?>

				<div class="vw-embeded-media vw-embeded-gallery vw-bxslider vw-bxslider-loading">
					<ul class="vw-bxslider-slides">
						<?php foreach( $attachments as $attachment_ID ) :
							$full_image_url = wp_get_attachment_image_src( $attachment_ID, 'full' );
						?>
							<li>
								<a class="" href="<?php echo esc_url( $full_image_url[0] ); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark" <?php vw_itemprop( 'image' ); vw_itemtype( 'ImageObject' ); ?>>
									<?php echo wp_get_attachment_image( $attachment_ID, $thumbnail_size ); ?>
									<?php 
										$image_caption = get_post( $attachment_ID )->post_excerpt;
										if ( ! empty( $image_caption ) ) {
											printf( '<div class="vw-embeded-image-caption"><i class="vw-icon icon-iconic-camera"></i> %s</div>', $image_caption );
										}
									 ?>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>

			<?php endif;
		}
	}
}

if ( ! function_exists( 'vw_the_embeded_video' ) ) {
	function vw_the_embeded_video() {
		if ( has_post_format( 'video' ) ) {
			$video_oembed_url = get_post_meta( get_the_ID(), 'vw_post_format_video_oembed_url', true );
			$video_oembed_code = get_post_meta( get_the_ID(), 'vw_post_format_video_oembed_code', true );

			if ( ! empty( $video_oembed_url ) ) {
				echo '<div class="vw-embeded-media vw-embeded-video vw-embeded-video-url">';
				echo wp_oembed_get( $video_oembed_url );
				echo '</div>';

			} else if ( ! empty( $video_oembed_code ) ) {
				echo '<div class="vw-embeded-media vw-embeded-video vw-embeded-video-code">';
				echo $video_oembed_code;
				echo '</div>';

			}

		}
	}
}

if ( ! function_exists( 'vw_the_embeded_audio' ) ) {
	function vw_the_embeded_audio() {
		if ( has_post_format( 'audio' ) ) {
			$audio_oembed_url = get_post_meta( get_the_ID(), 'vw_post_format_audio_oembed_url', true );
			$audio_oembed_code = get_post_meta( get_the_ID(), 'vw_post_format_audio_oembed_code', true );
			
			if ( ! empty( $audio_oembed_url ) ) {
				echo '<div class="vw-embeded-media vw-embeded-audio vw-embeded-audio-url">';
				echo wp_oembed_get( $audio_oembed_url );
				echo '</div>';

			} else if ( ! empty( $audio_oembed_code ) ) {
				echo '<div class="vw-embeded-media vw-embeded-audio vw-embeded-audio-code">';
				echo $audio_oembed_code;
				echo '</div>';

			}

		}
	}
}

/* -----------------------------------------------------------------------------
 * Render Post Footer Sections
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_the_post_footer_sections' ) ) {
	function vw_the_post_footer_sections() {
		$sections = vw_get_theme_option( 'post_footer_sections' );
		if ( empty( $sections ) || empty( $sections['enabled'] ) ) return;

		foreach ( $sections['enabled'] as $slug => $label ) {
			if ( 'post-navigation' == $slug ) {
				get_template_part( 'templates/post-navigation' );

			} elseif ( 'about-author' == $slug ) {
				get_template_part( 'templates/about-author' );

			} elseif ( 'related-posts' == $slug ) {
				$the_query = vw_get_related_posts( vw_get_theme_option( 'related_post_count' ) );
				if ( ! empty( $the_query ) && $the_query->have_posts() ) {
					$GLOBALS['wp_query'] = $the_query;
					get_template_part( 'templates/related-posts' );
					wp_reset_query();
				}


			} elseif ( 'comments' == $slug ) {
				comments_template();

			} else {
				// For 'custom-1', 'custom-2' or else
				get_template_part( 'templates/post-footer-section-'.$slug );

			}
		}
	}
}

/* -----------------------------------------------------------------------------
 * The Author Avatar
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_the_author_avatar' ) ) {
	function vw_the_author_avatar( $author = null, $size = VW_CONST_AVATAR_SIZE_LARGE ) {
		if ( ! $author ) {
			$author = vw_get_current_author();
		}

		$author_avatar = vw_get_avatar( get_the_author_meta( 'user_email', $author->ID ), $size, '', get_the_author_meta( 'display_name', $author->ID ) );

		echo '<a class="vw-author-avatar" href="' . get_author_posts_url( $author->ID ).'" title="' . sprintf( esc_attr__('Posts by %s', 'envirra'), get_the_author_meta( 'display_name', $author->ID ) ) . '">';
		echo $author_avatar;
		echo '</a>';
	}
}

/* -----------------------------------------------------------------------------
 * The Post Date
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_the_post_date' ) ) {
	function vw_the_post_date() {
		?><a href="<?php the_permalink(); ?>" class="vw-post-date updated" title="<?php printf( esc_attr__('Permalink to %s', 'envirra'), the_title_attribute('echo=0') ); ?>" rel="bookmark"><i class="icon-entypo-clock"></i><time <?php vw_itemprop('datePublished'); ?> datetime="<?php echo get_the_time('c'); ?>"><?php echo get_the_time( get_option('date_format') ); ?></time></a><?php
	}
}

/* -----------------------------------------------------------------------------
 * The Comment Link
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_the_comment_link' ) ) {
	function vw_the_comment_link() {
		if ( comments_open() ) : 
		?>
		<a class="vw-post-meta-icon vw-post-comment-count" href="<?php comments_link(); ?>" title="<?php echo esc_attr__( 'Comments', 'envirra' ); ?>">
			<i class="vw-icon icon-iconic-comment-alt2"></i> <?php vw_number_prefixes( comments_number( '0', '1', '%' ) ) ?>
		</a>
		<?php
		endif;
	}
}

/* -----------------------------------------------------------------------------
 * The post format class
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_the_post_format_class' ) ) {
	function vw_the_post_format_class() {
		$format = get_post_format();
		if ( empty( $format ) ) $format = 'standard';
		
		echo esc_attr( sprintf( 'vw-post-format-%s', $format ) );
	}
}

/* -----------------------------------------------------------------------------
 * The post format icon
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_the_post_format_icon' ) ) {
	function vw_the_post_format_icon() {
		$icon_class = '';
		$format_class = '';

		if ( has_post_format( 'audio' ) ) {
			$icon_class = 'icon-iconic-headphones';
			$format_class = 'vw-audio-icon';

		} elseif ( has_post_format( 'video' ) ) {
			$icon_class = 'icon-iconic-play';
			$format_class = 'vw-video-icon';

		} elseif ( has_post_format( 'gallery' ) ) {
			$icon_class = 'icon-iconic-camera';
			$format_class = 'vw-gallery-icon';

		}

		if ( ! empty( $icon_class ) ) {
			echo '<span class="vw-post-format-icon '.esc_attr( $format_class ).'"><i class="'.esc_attr( $icon_class ).'"></i></span>';
		}
	}
}

/* -----------------------------------------------------------------------------
 * The date box
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_the_date_box' ) ) {
	function vw_the_date_box( $classes='' ) {
		?>
		<span class="vw-date-box <?php echo $classes ?>">
			<span class="vw-date-box-date"><?php echo get_the_date('d'); ?></span>
			<span class="vw-date-box-month">
				<span><?php echo get_the_date('M'); ?></span>
				<span><?php echo get_the_date('Y'); ?></span>
			</span>
		</span>
		<?php
	}
}

/* -----------------------------------------------------------------------------
 * The post meta large
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_the_post_meta_large' ) ) {
	function vw_the_post_meta_large() {
		get_template_part( 'templates/post-meta', 'large' );
	}
}

/* -----------------------------------------------------------------------------
 * The Post Slider
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_the_post_slider' ) ) {
	function vw_the_post_slider( $args=array() ) {
		$default = array(
			'template' => 'large',
			'cat' => null,
			'category__not_in' => null,
			'posts_order' => 'latest_posts', // latest_posts, latest_featured, latest_reviews, most_review_scores
			'number_of_post' => 5,
			'before' => '',
			'after' => '',
		);

		$args = wp_parse_args( $args, $default );
	
		$query_args = array(
			'post_type' => 'post',
			'orderby' => 'post_date',
			'order' => 'DESC',
			'ignore_sticky_posts' => true,
			'posts_per_page' => $args['number_of_post'],
			'meta_query' => array(),
		);

		if ( $args['cat'] ) {
			$query_args['cat'] = $args['cat'];
		}

		if ( ! empty( $args['category__not_in'] ) ) {
			$query_args['category__not_in'] = explode( ',', $args['category__not_in'] );
		}

		if ( $args['posts_order'] == 'latest_posts' ) {
			// do nothing, it's a default ordering

		} elseif ( $args['posts_order'] == 'latest_featured' ) {
			$query_args['meta_query'][] = array(
				'key' => 'vw_post_featured',
				'value' => '1',
				'compare' => '=',
			);

		} elseif ( $args['posts_order'] == 'latest_reviews' ) {
			$query_args['meta_query'][] = array(
				'key' => 'vw_enable_review',
				'value' => '1',
				'compare' => '=',
			);

		} elseif ( $args['posts_order'] == 'most_review_scores' ) {
			$query_args['orderby'] = 'meta_value_num';
			$query_args['meta_key'] = 'vw_review_average_score';
			$query_args['meta_query'][] = array(
				'key' => 'vw_enable_review',
				'value' => '1',
				'compare' => '=',
			);

		}

		if ( ! defined( 'VW_ALLOW_NO_FEATURED_IMAGE_POSTS' ) ) {
			$query_args['meta_query'][] = array(
				'key' => '_thumbnail_id',
				'compare' => 'EXISTS'
			);
		}

		// ==== Begin temp query =====================================
		// $query_args['p'] = 1292;
		// $query_args['post__in'] = array( 1292, 1304 );
		

		// ==== End temp query =====================================

		query_posts( apply_filters( 'vw_filter_the_post_slider_query', $query_args ) );
		global $wp_query;
		
		if ( have_posts() ) {
			echo $args['before'];
			// get_template_part( 'templates/post-slider', $args['template'] );
			get_template_part( 'templates/post-loop/loop-slider', $args['template'] );
			echo $args['after'];
		}

		wp_reset_query();
	}
}

/* -----------------------------------------------------------------------------
 * Site top bar
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_the_site_top_bar' ) ) {
	function vw_the_site_top_bar() {
		$site_top_bar = vw_get_theme_option( 'site_top_bar' );
		if ( 'none' != $site_top_bar ) {
			get_template_part( 'templates/top-bar', $site_top_bar );
		}
	}
}

/* -----------------------------------------------------------------------------
 * Site bottom bar
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_the_site_bottom_bar' ) ) {
	function vw_the_site_bottom_bar() {
		$site_bottom_bar = vw_get_theme_option( 'site_bottom_bar' );
		if ( 'none' != $site_bottom_bar ) {
			get_template_part( 'templates/bottom-bar', $site_bottom_bar );
		}
	}
}