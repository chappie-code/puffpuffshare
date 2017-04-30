<!-- Logo -->
<?php
$logo = vw_get_theme_option( 'logo' );
$logo_2x = vw_get_theme_option( 'logo_2x' );

$logo_wrapper_classes = '';
if ( ! empty( $logo[ 'url' ] ) ) {
	$logo_wrapper_classes .= 'vw-has-logo';
} else {
	$logo_wrapper_classes .= 'vw-has-no-logo';
}
?>
<div class="vw-logo-wrapper <?php echo esc_attr( $logo_wrapper_classes ); ?>">
	
	<a class="vw-logo-link" href="<?php echo home_url(); ?>" <?php vw_itemprop('url'); ?>>
		
		<!-- Site Logo -->
		<?php if ( ! empty( $logo[ 'url' ] ) ): ?>

			<!-- Retina Site Logo -->
			<?php if ( ! empty( $logo_2x[ 'url' ] ) ): ?>
				<img class="vw-logo-2x" src="<?php echo esc_url( set_url_scheme( $logo_2x[ 'url' ] ) ); ?>" width="<?php echo esc_attr( $logo[ 'width' ] ) ?>" height="<?php echo esc_attr( $logo[ 'height' ] ) ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" <?php vw_itemprop('image'); ?>>
			<?php endif; ?>

			<img class="vw-logo" src="<?php echo esc_url( set_url_scheme( $logo[ 'url' ] ) ); ?>" width="<?php echo esc_attr( $logo[ 'width' ] ) ?>" height="<?php echo esc_attr( $logo[ 'height' ] ) ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" <?php vw_itemprop('image'); ?>>

		<?php else: ?>

			<h1 class="vw-site-title" <?php vw_itemprop('name'); ?>><?php bloginfo( 'name' ); ?></h1>

			<?php if ( get_bloginfo( 'description' ) ): ?>
				<h2 class="vw-site-tagline" <?php vw_itemprop('description'); ?>><?php bloginfo( 'description' ) ?></h2>
			<?php endif; ?>
			
		<?php endif; ?>
	</a>

</div>
<!-- End Logo -->