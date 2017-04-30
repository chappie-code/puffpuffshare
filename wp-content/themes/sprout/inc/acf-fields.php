<?php
if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_category-options',
		'title' => 'Category Options',
		'fields' => array (
			array (
				'key' => 'field_53c4bac98ea93',
				'label' => 'Category Blog Layout',
				'name' => 'category_blog_layout',
				'type' => 'select',
				'choices' => array (
					'site-default' => 'Site Default',
					'classic' => 'Classic',
					'block-grid-2-col' => 'Block Grid (2 Columns)',
					'block-grid-3-col' => 'Block Grid (3 Columns)',
					'masonry-grid-2-col' => 'Masonry Grid (2 Columns)',
					'masonry-grid-3-col' => 'Masonry Grid (3 Columns)',
				),
				'default_value' => 'site_default',
				'allow_null' => 0,
				'multiple' => 0,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'ef_taxonomy',
					'operator' => '==',
					'value' => 'category',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_page-options',
		'title' => 'Page Options',
		'fields' => array (
			array (
				'key' => 'field_5423cf2356264',
				'label' => 'Show Page Title',
				'name' => 'vw_show_page_title',
				'type' => 'true_false',
				'message' => '',
				'default_value' => 1,
			),
			array (
				'key' => 'field_53b914ba12f10',
				'label' => 'Page Subtitle',
				'name' => 'vw_page_subtitle',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_post-options',
		'title' => 'Post Options',
		'fields' => array (
			array (
				'key' => 'field_540004d5673c6',
				'label' => 'Featured Post',
				'name' => 'vw_post_featured',
				'type' => 'true_false',
				'instructions' => 'Mark this post as featured',
				'message' => '',
				'default_value' => 0,
			),
			array (
				'key' => 'field_53ccc0137ec6d',
				'label' => 'Post Layout',
				'name' => 'vw_post_layout',
				'type' => 'select',
				'choices' => array (
					'default' => 'Default',
					'classic' => 'Classic',
					'classic-no-featured-image' => 'Classic (No featured image)',
					'full-width' => 'Full width',
					'custom-1' => 'Custom 1',
					'custom-2' => 'Custom 2',
				),
				'default_value' => 'default',
				'allow_null' => 0,
				'multiple' => 0,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_sidebar',
		'title' => 'Sidebar',
		'fields' => array (
			array (
				'key' => 'field_53cd3c57ef64e',
				'label' => 'Sidebar Position',
				'name' => 'vw_sidebar_position',
				'type' => 'select',
				'choices' => array (
					'default' => 'Default',
					'none' => 'None',
					'right' => 'Right',
					'left' => 'Left',
					'mini-content-right' => 'Left (mini) / Content / Right',
					'left-content-mini' => 'Left / Content / Right (mini)',
					'content-mini-right' => 'Content / Left (mini) / Right',
				),
				'default_value' => 'default',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_53cd3f17ef64f',
				'label' => 'Left Sidebar',
				'name' => 'vw_left_sidebar',
				'type' => 'sidebar_selector',
				'instructions' => 'Do not select to use the blog\'s default left sidebar',
				'allow_null' => 1,
				'default_value' => '',
			),
			array (
				'key' => 'field_53cd3f26ef650',
				'label' => 'Right Sidebar',
				'name' => 'vw_right_sidebar',
				'type' => 'sidebar_selector',
				'instructions' => 'Do not select to use the blog\'s default right sidebar',
				'allow_null' => 1,
				'default_value' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
					'order_no' => 0,
					'group_no' => 1,
				),
			),
			array (
				array (
					'param' => 'ef_taxonomy',
					'operator' => '==',
					'value' => 'category',
					'order_no' => 0,
					'group_no' => 2,
				),
			),
		),
		'options' => array (
			'position' => 'side',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_woocommerce-category-options',
		'title' => 'Woocommerce Category Options',
		'fields' => array (
			array (
				'key' => 'field_547ae2023af27',
				'label' => 'Background Image',
				'name' => 'category_background_image',
				'type' => 'image',
				'save_format' => 'object',
				'preview_size' => 'thumbnail',
				'library' => 'all',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'ef_taxonomy',
					'operator' => '==',
					'value' => 'product_cat',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}
