<?php

namespace Bunyad\Blocks;

use Bunyad;
use Bunyad\Blocks\Base\Block;

/**
 * Breadcrumbs block.
 */
class Breadcrumbs extends Block
{
	public $id = 'breadcrumbs';

	/**
	 * @inheritdoc
	 */
	public static function get_default_props() 
	{
		$props = [
			'classes'       => '',
			'inner_classes' => '',
			'style'         => 'b',
			'width'         => 'full',
			'disable_at'    => [],
			'enabled'       => true,

			// Add You Are At: label.
			'add_label'     => false,
			'label_text'    => '',
		];

		// Setup from global options.
        if (Bunyad::options()) {

			// Set if enabled.
			$props = array_replace($props, [
				'enabled'    => Bunyad::options()->breadcrumbs_enable,
				'add_label'  => Bunyad::options()->breadcrumbs_add_label,
				'label_text' => Bunyad::options()->get_or(
					'breadcrumbs_label_text',
					esc_html_x('You are at:', 'breadcrumbs', 'bunyad')
				),
				'style'      => Bunyad::options()->breadcrumbs_style,
			]);

			// Only valid for style b.
			if ($props['style'] === 'b') {
				$props['width'] = Bunyad::options()->breadcrumbs_width;
			}

			// Find disabled locations from theme settings.
			// Note: Homepage is disabled by default by the Sphere breadcrumbs.
			$location_keys = [
				'single', 
				'page', 
				'search', 
				'archive'
			];

			$disable_at = [];
			foreach ($location_keys as $key) {
				if (!Bunyad::options()->get('breadcrumbs_' . $key)) {
					$disable_at[] = $key;
				}
			}

			$props['disable_at'] = $disable_at;
        }

		return $props;
	}

	/**
	 * Render the breadcrumbs.
	 * 
	 * @return void
	 */
	public function render()
	{
		// Check if Yoast SEO's Breadcrumbs are enabled.
		$is_yoast = $this->is_yoast();

		// Neither theme nor Yoast's Breadcrumbs enabled.
		if (!$is_yoast && !$this->props['enabled']) { 
			return;
		}

		// Sphere Core Class is required.
		if (!class_exists('\Sphere\Core\Plugin', false)) {
			return;
		}

		$wrap_classes = array_filter(array_merge(
			[
				'breadcrumbs',
				$this->props['width'] !== 'full' ? 'ts-contain' : 'is-full-width',
				'breadcrumbs-' . $this->props['style'],
			],
			(array) $this->props['classes']
		));

		$inner_classes = array_merge(['inner ts-contain'], (array) $this->props['inner_classes']);

		$before = sprintf(
			'<nav class="%1$s" id="breadcrumb"><div class="%2$s">',
			esc_attr(join(' ', $wrap_classes)),
			esc_attr(join(' ', $inner_classes))
		);

        if ($this->props['add_label']) {
            $before .= '<span class="label">' . esc_html($this->props['label_text']) .'</span>';
		}
		
		$after   = '</div></nav>';

		// Output Yoast Breadcrumbs.
		if ($is_yoast) {
			return \yoast_breadcrumb($before, $after);
		}

		/** @var \Sphere\Core\Breadcrumbs\Module $breadcrumbs */
		$breadcrumbs = \Sphere\Core\Plugin::get('breadcrumbs');
		if (!$breadcrumbs) {
			return;
		}

		$breadcrumbs->render([
			'primary_cat_callback' => [Bunyad::blocks(), 'get_primary_cat'],
			
			// Spaces added left and right to be same as Yoast.
			'delimiter'     => '<span class="delim">&raquo;</span>',

			'before'        => $before,
			'after'         => $after,
			'disable_at'    => $this->props['disable_at'],
			'labels'        => [
				'home'     => esc_html_x('Home', 'breadcrumbs', 'bunyad'),
				'category' => esc_html_x('Category: "%s"', 'breadcrumbs', 'bunyad'),
				'tax'      => esc_html_x('Archive for "%s"', 'breadcrumbs', 'bunyad'),
				'search'   => esc_html_x('Search Results for "%s"', 'breadcrumbs', 'bunyad'),
				'tag'      => esc_html_x('Posts Tagged "%s"', 'breadcrumbs', 'bunyad'),
				'404'      => esc_html_x('Error 404', 'breadcrumbs', 'bunyad'),
				'author'   => esc_html_x('Author: %s', 'breadcrumbs', 'bunyad'),
				'paged'    => esc_html_x(' (Page %d)', 'breadcrumbs', 'bunyad')
			]
		]);
	}

	/**
	 * Check if Yoast Breadcrumb enabled.
	 * 
	 * @return boolean
	 */
	public function is_yoast()
	{
		$is_yoast = false;
		if (class_exists('\WPSEO_Options') && function_exists('yoast_breadcrumb')) {
			if (is_callable(['WPSEO_Options', 'get']) && \WPSEO_Options::get('breadcrumbs-enable', false)) {
				$is_yoast = true;
			}
		}

		return $is_yoast;
	}
}