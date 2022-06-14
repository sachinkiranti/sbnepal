<?php
/**
 * Global Posts Options
 */

$fields_meta = [

	[
		'name'    => '_n_post_meta',
		'type'    => 'message',
		'label'   => '',
		'text'    => '
			<p>These are global meta settings and may be overridden in many blocks and areas.</p>
			<p>Note: Some of the settings below will not apply to Single Posts.</p>
			For single post page, items, author image etc. should be set from 
			<a href="#" class="focus-link is-with-nav" data-section="bunyad-posts-single-general">Single Posts Page > General & Post Style</a>.
		',
		'style'   => 'message-info',
	],

	[
		'name'    => 'post_meta_above',
		'label'   => esc_html__('Items Above Title', 'bunyad-admin'),
		'desc'    => '',
		'value'   => [],
		'type'    => 'checkboxes',
		'options' => $_common['meta_options'],
		// Not a global style, specific to checkboxes.
		'style'   => 'sortable',
	],

	[
		'name'    => 'post_meta_below',
		'label'   => esc_html__('Items Below Title', 'bunyad-admin'),
		'desc'    => '',
		'value'   => ['author', 'date', 'comments'],
		'type'    => 'checkboxes',
		'options' => $_common['meta_options'],
		// Not a global style, specific to checkboxes.
		'style'   => 'sortable',
	],

	// Alignment should be per block. Globally applied, it will get too messy.
	// [
	// 	'name'    => 'post_meta_align',
	// 	'label'   => esc_html__('Default Alignment', 'bunyad-admin'),
	// 	'desc'    => 'Will not affect some special cases where left alignment is forced.',
	// 	'value'   => 'center',
	// 	'type'    => 'select',
	// 	'style'   => 'inline-sm',
	// 	'classes' => 'sep-top',
	// 	'options' => [
	// 		'center' => esc_html__('Center', 'bunyad-admin'),
	// 		'left'   => esc_html__('Left', 'bunyad-admin'),
	// 	],
	// ],

	[

		'name'    => 'post_meta_all_cats',
		'label'   => esc_html__('Show All Categories', 'bunyad-admin'),
		'desc'    => 'Whether to show all or just one primary category. Single Article has its own <a href="#" class="focus-link is-with-nav" data-section="bunyad-posts-single-general">separate setting</a>.',
		'value'   => 0,
		'type'    => 'toggle',
		'style'   => 'inline-sm',
	],
	[
		'name'    => 'post_meta_labels_enable',
		'label'   => esc_html__('Extra Text Labels', 'bunyad-admin'),
		'desc'    => 'Show "By" text etc.',
		'value'   => 1,
		'type'    => 'toggle',
		'style'   => 'inline-sm',
	],
	[
		'name'    => 'post_meta_labels',
		'label'   => esc_html__('Text Labels', 'bunyad-admin'),
		'desc'    => '',
		'value'   => ['by'],
		'type'    => 'checkboxes',
		'options' => [
			// 'in' => '"In" before category',
			'by' => '"By" before author',
		],
		'context' => [['key' => 'post_meta_labels_enable', 'value' => 1]]
	],

	[
		'name'    => 'post_meta_modified_date',
		'label'   => esc_html__('Use Modified Date', 'bunyad-admin'),
		'desc'    => 'Force show modified date instead of posted date.',
		'value'   => 0,
		'type'    => 'toggle',
		'style'   => 'inline-sm',
	],

	[
		'name'  => 'post_meta_author_img',
		'label' => esc_html__('Show Author Image', 'bunyad-admin'),
		'desc'  => '',
		'value' => 0,
		'type'  => 'toggle',
		'style' => 'inline-sm',
	],

	[
		'name'    => 'post_meta_disabled',
		'label'   => esc_html__('Force Disable Items', 'bunyad-admin'),
		'desc'    => 'Items can be set per block/listing etc. Using this setting will force disable these items in all places.',
		'value'   => '',
		'type'    => 'checkboxes',
		'style'   => 'cols-2',
		'classes' => 'sep-bottom',
		'options' => $_common['meta_options'],
	],

	// [
	// 	'name'  => 'css_post_meta',
	// 	'value' => '',
	// 	'label' => esc_html__('Meta Items Color', 'bunyad-admin'),
	// 	'desc'  => '',
	// 	'type'  => 'color',
	// 	'css'   => [
	// 		'.post-meta, 
	// 		.post-meta .meta-item,
	// 		.post-meta .comments,
	// 		.post-meta time' => ['props' => ['color' => '%s']]
	// 	],
	// 	'group' => '_g_colors_global',
	// ],


];

/**
 * Group: Meta Design
 */
$meta_design = [
	[
		'name'    => '_g_meta_design',
		'label'   => esc_html__('Posts Meta Design', 'bunyad-admin'),
		'desc'    => '',
		'type'    => 'group',
		'style'   => 'collapsible'
	],

	[
		'name'       => 'css_post_meta_typo',
		'label'      => esc_html__('Meta Font', 'bunyad-admin'),
		'desc'       => '',
		'value'      => '',
		'type'       => 'group',
		'group_type' => 'typography',
		'style'      => 'edit',
		'controls'   => ['family'],
		'css'        => '.post-meta',
		'group'      => '_g_meta_design',
	],
	[
		'name'       => 'css_meta_typo',
		'label'      => esc_html__('Typography', 'bunyad-admin'),
		'desc'       => '',
		'value'      => '',
		'type'       => 'group',
		'group_type' => 'typography',
		'style'      => 'edit',
		'css'        => '.post-meta .meta-item, .post-meta .text-in',
		'group'      => '_g_meta_design',
	],
	[
		'name'             => 'css_meta_cat_typo',
		'label'            => esc_html__('Category Typography', 'bunyad-admin'),
		'desc'             => 'Note: This is not for overlay labels. This is for category labels inside post meta.',
		'value'            => '',
		'type'             => 'group',
		'group_type'       => 'typography',
		'style'            => 'edit',
		'css'              => '.post-meta .post-cat > a',
		'controls_options' => [

			// Size has to change for .text-in label to match.
			'size' => [
				'css' => [
					'.post-meta .text-in, .post-meta .post-cat > a' => [
						'props' => ['font-size' => '%spx']
					],
				]
			]
		],
		'group'      => '_g_meta_design',
	],

	[
		'name'             => 'css_meta_author_typo',
		'label'            => esc_html__('Author Typography', 'bunyad-admin'),
		'desc'             => '',
		'value'            => '',
		'type'             => 'group',
		'group_type'       => 'typography',
		'style'            => 'edit',
		'css'              => '.post-meta .post-author > a',
		'controls'         => ['weight', 'transform', 'spacing'],
		'group'            => '_g_meta_design',
	],

	[
		'name'  => 'css_meta_color',
		'value' => '',
		'label' => esc_html__('Items Color', 'bunyad-admin'),
		'desc'  => '',
		'type'  => 'color',
		'style' => 'inline-sm',
		'css'   => [
			'vars' => ['props' => ['--c-post-meta' => '%s']],
			// Reset for dark - just for convenience as .s-light .block-wrap.s-dark blocks will still be affected.
			'.s-light .block-wrap.s-dark' => ['props' => ['--c-post-meta' => 'var(--c-contrast-450)']],
		],
		'group'      => '_g_meta_design',
	],
	[
		'name'  => 'css_meta_color_sd',
		'value' => '',
		'label' => esc_html__('Dark: Items Color', 'bunyad-admin'),
		'desc'  => '',
		'type'  => 'color',
		'style' => 'inline-sm',
		'css'   => [
			'.s-dark' => ['props' => ['--c-post-meta' => '%s']]
		],
		'group'      => '_g_meta_design',
	],
	[
		'name'  => 'css_meta_author_color',
		'value' => '',
		'label' => esc_html__('Author Color', 'bunyad-admin'),
		'desc'  => '',
		'type'  => 'color',
		'style' => 'inline-sm',
		'css'   => [
			'.post-meta .post-author > a' => ['props' => ['color' => '%s']],
		],
		'group'      => '_g_meta_design',
	],
	[
		'name'  => 'css_meta_author_color_sd',
		'value' => '',
		'label' => esc_html__('Dark: Author Color', 'bunyad-admin'),
		'desc'  => '',
		'type'  => 'color',
		'style' => 'inline-sm',
		'css'   => [
			'.s-dark .post-meta .post-author > a' => ['props' => ['color' => '%s']],
		],
		'group'      => '_g_meta_design',
	],
	[
		'name'  => 'css_meta_cat_color',
		'value' => '',
		'label' => esc_html__('Category Color', 'bunyad-admin'),
		'desc'  => 'Does not apply to category badges.',
		'type'  => 'color',
		'style' => 'inline-sm',
		'css'   => [
			'.post-meta .post-cat > a' => ['props' => ['color' => '%s']]
		],
		'group'      => '_g_meta_design',
	],
	[
		'name'  => 'css_meta_cat_color_sd',
		'value' => '',
		'label' => esc_html__('Dark: Category Color', 'bunyad-admin'),
		'desc'  => '',
		'type'  => 'color',
		'style' => 'inline-sm',
		'css'   => [
			'.s-dark .post-meta .post-cat > a' => ['props' => ['color' => '%s']]
		],
		'group'      => '_g_meta_design',
	],
	[
		'name'  => 'css_meta_nosep',
		'label' => esc_html__('Disable Separators', 'bunyad-admin'),
		'desc'  => 'Remove separator blip between items.',
		'value' => 0,
		'type'  => 'toggle',
		'style' => 'inline-sm',
		'css'   => [
			// utf-8 en-space to add some spacing.
			'.post-meta' => ['props' => ['--p-meta-sep' => '\00a0']]
		],
		'group'      => '_g_meta_design',
	],
	[
		'name'  => 'css_meta_custom_sep',
		'label' => esc_html__('Custom Separator', 'bunyad-admin'),
		'desc'  => 'Either ascii code with a leading slash such as \2013 or a utf-8 character.',
		'value' => '',
		'type'  => 'text',
		'style' => 'inline-sm',
		'css'   => [
			'.post-meta' => ['props' => ['--p-meta-sep' => '"%s"']]
		],
		'context'    => [['key' => 'css_meta_nosep', 'value' => 0]],
		'group'      => '_g_meta_design',
	],

	[
		'name'  => 'css_meta_sep_space',
		'label' => esc_html__('Separator Spacing', 'bunyad-admin'),
		'desc'  => '',
		'value' => '',
		'type'  => 'number',
		'style' => 'inline-sm',
		'css'   => [
			'.post-meta' => ['props' => ['--p-meta-sep-pad' => '%spx']]
		],
		'group'      => '_g_meta_design',
	],

	[
		'name'  => 'css_meta_sep_scale',
		'label' => esc_html__('Separator Scale', 'bunyad-admin'),
		'desc'  => '',
		'value' => '',
		'type'  => 'number',
		'input_attrs' => ['min' => 0.25, 'max' => 2.5, 'step' => .1],
		'style' => 'inline-sm',
		'css'   => [
			'.post-meta .meta-item:before' => ['props' => ['transform' => 'scale(%s)']]
		],
		'context'    => [['key' => 'css_meta_nosep', 'value' => 0]],
		'group'      => '_g_meta_design',
	],
	
];

$fields = array_merge($fields_meta, $meta_design);

$options['posts-global'] = [
	'sections'    => [[
		'id'     => 'posts-global',
		'title'  => esc_html__('Global Posts Settings', 'bunyad-admin'),
		'fields' => $fields
	]]
];

return $options;