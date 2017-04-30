<?php

add_action('admin_head', 'vw_shortcode_editor_settings');
function vw_shortcode_editor_settings(){
	?>
	<script type="text/javascript">
		var vw_theme_shortcodes = [
			{
				title: 'Accordion',
				shortcode: '[accordion]',
			},
			{
				title: 'Blog Posts',
				shortcode: '[posts]',
			},
			{
				title: 'Button',
				shortcode: '[button]',
			},
			{
				title: 'Columns',
				submenu: [
					{
						title: '[1/2] + [1/2]',
						instant_shortcode: "<p>[row]</p><p>[column size='1/2']Your Content Here[/column]</p><p>[column size='1/2']Your Content Here[/column]</p><p>[/row]</p>",
					},
					{
						title: '[1/3] + [1/3] + [1/3]',
						instant_shortcode: "<p>[row]</p><p>[column size='1/3']Your Content Here[/column]</p><p>[column size='1/3']Your Content Here[/column]</p><p>[column size='1/3']Your Content Here[/column]</p><p>[/row]</p>",
					},
					{
						title: '[2/3] + [1/3]',
						instant_shortcode: "<p>[row]</p><p>[column size='2/3']Your Content Here[/column]</p><p>[column size='1/3']Your Content Here[/column]</p><p>[/row]</p>",
					},
					{
						title: '[1/4] + [1/4] + [1/4] + [1/4]',
						instant_shortcode: "<p>[row]</p><p>[column size='1/4']Your Content Here[/column]</p><p>[column size='1/4']Your Content Here[/column]</p><p>[column size='1/4']Your Content Here[/column]</p><p>[column size='1/4']Your Content Here[/column]</p><p>[/row]</p>",
					},
					{
						title: '[3/4] + [1/4]',
						instant_shortcode: "<p>[row]</p><p>[column size='3/4']Your Content Here[/column]</p><p>[column size='1/4']Your Content Here[/column]</p><p>[/row]</p>",
					},
				],
			},
			{
				title: 'Info Box',
				shortcode: '[infobox]',
			},
			{
				title: 'List',
				instant_shortcode: '<p>[list]</p>'
									+'<p>[list_item icon="iconic-info"]CONTENT HERE[/list_item]</p>'
									+'<p>[/list]</p>'
			},
			{
				title: 'Logo',
				instant_shortcode: '[logo]',
			},
			{
				title: 'Map',
				instant_shortcode: '<p>[flexiblemap address="Bangkok, Thailand" title="Label Here"]</p>'
			},
			{
				title: 'Tabs',
				instant_shortcode: '<p>[tabs]</p>'
									+ '<p>[tab title="Responsive" icon="iconic-info"]CONTENT HERE[/tab]</p>'
									+ '<p>[/tabs]</p>'
			},
			{
				title: 'Typography',
				submenu: [
					{
						title: 'Custom Font 1',
						instant_shortcode: '[customfont1]Text Here[/customfont1]',
					},
					{
						title: 'Custom Font 2',
						instant_shortcode: '[customfont2]Text Here[/customfont2]',
					},
					{
						title: 'Dropcap',
						shortcode: '[dropcap]',
					},
					{
						title: 'Emphasize',
						instant_shortcode: '[em]Text Here[/em]',
					},
					{
						title: 'Headline',
						instant_shortcode: '[headline]Text Here[/headline]',
					},
					{
						title: 'Mark',
						shortcode: '[mark]',
					},
					{
						title: 'Quote',
						shortcode: '[quote]',
					},
					{
						title: 'Title',
						shortcode: '[title]',
					},
					{
						title: '404',
						instant_shortcode: '[404]',
					},
				]
			},
		];
	</script>
	<?php
}

add_action('admin_head', 'vw_init_shortcode_editor');
function vw_init_shortcode_editor() {
	add_filter('mce_external_plugins', 'vw_add_shortcode_editor_plugins');
	add_filter('mce_buttons', 'vw_add_shortcode_editor_buttons');
}

function vw_add_shortcode_editor_plugins($plugin_array) {
	$plugin_array['vw_shortcodes'] = get_template_directory_uri().'/components/shortcode-editor/tinymce/plugins.js?'.VW_THEME_VERSION;

	return $plugin_array;
}
 
function vw_add_shortcode_editor_buttons($buttons) {
	array_push($buttons, 'vw_shortcodes');
	return $buttons;
}