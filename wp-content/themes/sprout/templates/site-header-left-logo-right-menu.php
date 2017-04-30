<!-- Site Header : Left Logo, Right Menu -->
<header class="vw-site-header vw-site-header-style-left-logo-right-menu" <?php vw_itemtype('WPHeader'); ?>>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="vw-site-header-inner clearfix">
					<?php get_template_part( 'templates/logo' ); ?>

					<?php get_template_part( 'templates/menu-main' ); ?>

					<div class="vw-mobile-nav-button-wrapper">
						<span class="vw-mobile-nav-button">
							<span class="vw-hamburger-icon"><span></span></span>
						</span>
					</div>
				
				</div>
			</div>
		</div>
	</div>
	
	<?php get_template_part( 'templates/menu-mobile' ); ?>
</header>
<!-- End Site Header : Left Logo -->