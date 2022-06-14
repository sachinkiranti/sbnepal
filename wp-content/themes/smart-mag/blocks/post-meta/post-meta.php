<?php

namespace Bunyad\Blocks;

use Bunyad;
use Bunyad\Blocks\Base\Block;

/**
 * Render and generate post meta for posts in listings, single etc.
 */
class PostMeta extends Block
{
	public $id = 'post-meta';

	public function init()
	{
		// Process props after all's setup.
		$this->props = $this->process_props($this->props);
	}

	/**
	 * @inheritdoc
	 */
	public static function get_default_props() 
	{
		$props = [
			'type'          => '',
			'items_above'   => [], //['cat', 'date'],
			'items_below'   => ['author', 'date', 'comments'],
			'title'         => true,
			
			'show_title'  => true,
			'title_class' => 'post-title',
			'title_tag'   => 'h2',
			'is_single'   => false,
			'after_title' => '',
			
			// Show text labels like "In", "By"
			'text_labels' => ['by'],
			'icons'       => 'some',
			'cat_style'   => '',
			
			// Author image/avatar.
			'author_img'  => false,
			'avatar_size' => 21,

			'all_cats'    => false,
			'style'       => 'a',

			// Alignment defaults to inherit from parents.
			'align'       => '',
			'add_class'   => '',

			'date_link'   => false,
			'cat_labels'  => false,

			// Whether or not review stars are supported. 
			'review'      => false,

			// Whether to show overlay cat labels as inline - useful when can't overlay.
			// 'cat_labels_inline'  => false,

			// Category labels remain legacy.
			// 'cat_labels_overlay' => Bunyad::options()->meta_cat_labels,

			'modified_date'      => false,
			'wrapper'            => null,

			// Not used yet.
			'divider'       => false
		];

		return $props;
	}

	public function map_global_props($props)
	{
		// Add defaults from options.
		$props = array_replace([
			'items_above'   => Bunyad::options()->post_meta_above,
			'items_below'   => Bunyad::options()->post_meta_below,
			// 'style'         => Bunyad::options()->post_meta_style,
			// 'align'         => Bunyad::options()->post_meta_align,
			'text_labels'   => (array) Bunyad::options()->post_meta_labels,
			'all_cats'      => Bunyad::options()->post_meta_all_cats,
			'modified_date' => Bunyad::options()->post_meta_modified_date,
			'author_image'  => Bunyad::options()->post_meta_author_img,
		], $props);


		$prefixes = [
			'single' => 'post_meta_single',
		];

		$type = isset($props['type']) ? $props['type'] : '';

		// A known type and isn't set to use global options.
		if (isset($prefixes[$type]) && !Bunyad::options()->get($prefixes[$type] . '_global')) {
			
			$key = $prefixes[$type];

			$local_opts = [
				'items_above' => Bunyad::options()->get($key . '_above'),
				'items_below' => Bunyad::options()->get($key . '_below'),
				'style'       => Bunyad::options()->get($key . '_style'),
				'all_cats'    => Bunyad::options()->get($key . '_all_cats')
			];

			$props = array_replace($props, $this->filter_defaults($local_opts));
		}
		
		return $props;
	}

	/**
	 * Process props after they're all setup.
	 * 
	 * By this point, default and unrecognized props have been removed.
	 * 
	 * @param array $props
	 * @return array
	 */
	public function process_props($props)
	{
		$props['items_sep'] = '';  // ' <span class="meta-sep"></span> '

		// // If inline cat labels are forced and there are no items above.
		// // This stays consistent with the legacy post-meta-c behavior.
		// if ($props['cat_labels_inline'] && $props['cat_labels_overlay'] && empty($props['items_above'])) {
		// 	$props['items_above'] = ['cat'];
		// 	$props['cat_style']   = 'labels';
		// }

		// Remove forcefully disabled items.
		if (Bunyad::options()->post_meta_disabled) {
			$props['items_above'] = array_diff($props['items_above'], (array) Bunyad::options()->post_meta_disabled);
			$props['items_below'] = array_diff($props['items_below'], (array) Bunyad::options()->post_meta_disabled);
		}

		return $props;
	}

	/**
	 * Remove default and null values from array.
	 */
	protected function filter_defaults($options) 
	{
		// Remove default/null values.
		foreach ($options as $key => $opt) {
			if ($opt === null || $opt === 'default') {
				unset($options[$key]);
			}
		}

		return $options;
	}

	/**
	 * Render all of the post meta HTML.
	 * 
	 * @return void
	 */
	public function render() 
	{
		$style    = str_replace('style-', '', $this->props['style']);
		$class    = array_merge(
			[
				'post-meta',
				'post-meta-' . $style,
				($this->props['align'] ? 'post-meta-' . $this->props['align'] : null),
				($this->props['divider'] ? 'post-meta-divider' : null)
			],
			(array) $this->props['add_class']
		);

		do_action('bunyad_post_meta_before', $this);

		// Meta above title.
		$output = $this->render_meta('above');
		
		// Post title and tag.
		if ($this->props['show_title']) {
			
			$tag = $this->props['title_tag'];

			if ($this->props['is_single']) {
				$tag   = 'h1';
				$title = get_the_title();
			}
			else {
				$title = sprintf(
					'<a href="%1$s">%2$s</a>',
					esc_url(get_the_permalink()),
					get_the_title()
				);
			}

			$output .= sprintf(
				'<%1$s class="is-title %2$s">%3$s</%1$s>',
				esc_attr($tag),
				esc_attr($this->props['title_class']),
				$title // Safe above.
			);
		}

		// Add after title markup.
		$output .= $this->props['after_title'];
		
		// Meta items below title.
		$items_below = $this->render_meta('below');
		$output     .= $items_below;

		// Add a class to denote items below exist.
		if ($items_below) {
			$class[] = 'has-below';
		}
		
		// Default wrapper.
		$wrapper = $this->props['wrapper'];
		if ($wrapper === null) {
			$wrapper = '<div %1$s>%2$s</div>';
		}

		$output = sprintf(
			$wrapper,
			Bunyad::markup()->attribs(
				'post-meta-wrap', 
				['class' => $class],
				['echo' => false]
			),
			$output
		);

		echo apply_filters(
			'bunyad_post_meta',
			$output, // phpcs:ignore WordPress.Security.EscapeOutput Safe Output from above.
			$this->props
		);

		do_action('bunyad_post_meta_after', $this);
	}

	/**
	 * Render post meta items for specific location.
	 *
	 * @param string $location
	 * @return string
	 */
	public function render_meta($location = 'above')
	{	
		// Configs based on above or below.
		$location = $location === 'above' ? 'above' : 'below';
		$items    = $this->props['items_' . $location];
		$classes  = [
			'post-meta-items', 
			'meta-' . $location
		];

		$args = array_replace([
			'cat_style'     => '',
			'all_cats'      => false,
			'text_labels'   => [],
			'modified_date' => false,
			'author_img'    => false,
		], $this->props);


		if ($args['author_img'] && in_array('author', $items)) {
			$classes[] = 'has-author-img';
		}

		// It doesn't make sense to have two of same items in same line.
		$items = array_unique($items);

		// We'll process the array in reverse to add relevant icon classes.
		$items = array_reverse($items, false);

		$rendered = [];
		foreach ($items as $key => $item) {
			$item_args = $args;

			if ($key !== 0) {
				$prev_item = end($rendered);
				if (strpos($prev_item, 'has-icon') !== false) {
					$item_args['classes'] = ['has-next-icon'];
				}
			}

			$output = $this->get_meta_item($item, $item_args);
			if ($output) {
				$rendered[] = $output;
			}
		}
		
		// Remove empty and restore order.
		$rendered = array_reverse(array_filter($rendered));

		if (empty($rendered)) {
			return '';
		}

		$the_items = join(
			// Spaces for backward compatibility.
			$this->props['items_sep'],
			$rendered
		);

		return sprintf(
			'<div class="%1$s">%2$s</div>',
			esc_attr(join(' ', (array) $classes)),
			$the_items
		);
	}

	/**
	 * Get a post a meta item's HTML.
	 *
	 * @param string $item 
	 * @param array  $args
	 * 
	 * @return string Rendered HTML.
	 */
	public function get_meta_item($item, $args = []) 
	{
		$args = array_replace([
			'cat_style'   => '',
			'author_img'  => false,
			'avatar_size' => 32,
			'all_cats'    => false,
			'text_labels' => [],
			'modified_date' => false,
			'classes'       => [],
		], $args);

		$output = '';

		/**
		 * Determine the item to render and generate output.
		 */
		switch ($item) {

			// Meta item: Category/s
			case 'cat':

				$cat_class = 'post-cat';
				if (!empty($args['cat_style'])) {

					// Map of cat styles and the relevant classes.
					$cat_styles = [
						'text'   => 'post-cat',
						'labels' => 'cat-labels',
					];

					$cat_class = $cat_styles[ $args['cat_style'] ];
				}

				// Add "In" if text labels enabled.
				$text = '';
				if (in_array('in', $args['text_labels'])) {
					$text   = sprintf(
						'<span class="text-in">%s</span>',
						esc_html__('In', 'bunyad')
					);
				}

				$classes = $args['classes'];
				$classes[] = $cat_class;

				$output = sprintf(
					'<span class="meta-item %1$s">
						%2$s
						%3$s
					</span>
					',
					esc_attr(join(' ', $classes)),
					$text,
					$this->get_categories($args['all_cats'])
				);

				break;

			// Meta item: Comments Count & Link
			case 'comments':

				$classes = array_merge($args['classes'], ['meta-item comments']);

				// Icons enabled.
                if ($args['icons']) {
					$labels = in_array('comments', $args['text_labels']);

					// Label text can be forced.
					$numbers = $labels ? get_comments_number_text() : get_comments_number();
                    $output  = sprintf(
						'<span class="%1$s has-icon"><a href="%2$s">%3$s</a></span>',
						esc_attr(join(' ', $classes)),
                        esc_url(get_comments_link()),
						
						// $numbers escaped by WP core functions. Plugins may add markup.
                        '<i class="tsi tsi-comment-o"></i>' . $numbers
                    );
				}
				else {
                    $output = sprintf(
						'<span class="%1$s"><a href="%2$s">%3$s</a></span>',
						esc_attr(join(' ', $classes)),
                        esc_url(get_comments_link()),

						// Need not be escaped and stay consistent with core. Plugins may add markup.
                        get_comments_number_text()
                    );
				}

				break;

			// Meta item: Date
			case 'date':
			case 'updated':
				$modified = ($args['modified_date'] || $item === 'updated');

				// Skip if the modified date is same as the published date.
				if ($item === 'updated' && get_the_modified_date() === get_the_date()) {
					return false;
				}

				$date_w3c = $modified ? get_the_modified_date(DATE_W3C) : get_the_date(DATE_W3C);
				$date     = $modified ? get_the_modified_date() : get_the_date();

				$time = sprintf(
					'<time class="post-date" datetime="%1$s">%2$s</time>',
					esc_attr($date_w3c),
					esc_html($date)
				);

				// Updated will always have label.
				if ($item === 'updated') {
					$time = sprintf(
						'<span class="updated-on">%1$s</span>%2$s',
						esc_html__('Updated:', 'bunyad'),
						$time
					);
				}

				if (!$args['is_single']) {
					$title  = get_the_title();
					$markup = '<span class="date-link">%2$s</span>';
					if (!$title) {
						$markup = '<a href="%1$s" class="date-link">%2$s</a>';
					}

					$time = sprintf(
						$markup,
						esc_url(get_the_permalink()),
						$time
					);
				}

				$classes = $args['classes'];
				array_push($classes, $modified ? 'date-modified' : 'date');

				$output = sprintf(
					'<span class="meta-item %1$s">%2$s</span>',
					esc_attr(join(' ', $classes)),
					$time
				);

				break;				

			// Meta item: Author
			case 'author':

				// Add "By" if labels enabled. 
				$label = '';
				if (in_array('by', $args['text_labels'])) {
					$label = sprintf(
						esc_html_x('%1$sBy%2$s', 'Post Meta', 'bunyad'), 
						'<span class="by">', 
						'</span> '
					);
				}

				$classes = $args['classes'];
				$classes[] = 'meta-item post-author';
				
				// Add author avatar image if enabled.
				$author_img = '';
				if ($args['author_img']) {
					$author_img = get_avatar(get_the_author_meta('ID'), $args['avatar_size'], '', get_the_author_meta('display_name'));
					$classes[] = 'has-img';
				}
			
				$author_link = $author_img . $label . get_the_author_posts_link();

				$output = sprintf(
					'<span class="%1$s">%2$s</span>',
					esc_attr(join(' ', $classes)),
					$author_link
				);

				break;

			// Meta Item: Estimated Read Time
			case 'read_time':

				$minutes = $this->get_read_time();
				$text    = sprintf(
					esc_html(_n('%d Min Read', '%d Mins Read', $minutes, 'bunyad')),
					$minutes
				);

				$icon = $args['icons'] ? '<i class="tsi tsi-clock"></i>' : '';
				$output = sprintf(
					'<span class="meta-item read-time%1$s">%2$s</span>',
					($icon ? ' has-icon' : ''),
					$icon . $text
				);

				break;

			// Review stars if enabled.
			case 'review_stars':
				if (!$this->props['review'] || !Bunyad::reviews() || !Bunyad::posts()->meta('reviews')) {
					return;
				}

				$review_value  = Bunyad::posts()->meta('review_overall');
				$output = sprintf(
					'<span class="meta-item star-rating">
						<span class="main-stars"><span style="width: %1$s;">
							<strong class="rating">%2$s</strong></span>
						</span>
					</span>',
					intval(Bunyad::reviews()->decimal_to_percent($review_value)) . '%',
					$review_value
				);

				break;
		}

		return $output;
	}

	/**
	 * Reading time calculator for a post content.
	 * 
	 * @param  string $content  Post Content
	 * @return integer
	 */
	public function get_read_time($content = '')
	{
		if (!$content) {
			$content = get_post_field('post_content');
		}

		$wpm = apply_filters('bunyad_reading_time_wpm', 200);

		// Strip HTML and count words for reading time. Built-in function not safe when 
		// incorrect locale: str_word_count(wp_strip_all_tags($content))
		// Therefore, using a regex instead to split.
		$content    = wp_strip_all_tags($content);
		$word_count = count(preg_split('/&nbsp;+|\s+/', $content));
		$minutes    = ceil($word_count / $wpm);

		return $minutes;
	}

	/**
	 * Categories for meta.
	 * 
	 * @param boolean|null $all  Display primary/one category or all categories.
	 * @return string Rendered HTML.
	 */
	public function get_categories($all = null, $post_id = false)
	{
		return Bunyad::blocks()->get_categories($all, $post_id);
	}
}