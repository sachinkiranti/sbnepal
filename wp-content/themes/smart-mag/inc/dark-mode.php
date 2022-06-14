<?php
/**
 * Extra functions related to dark mode.
 */
class Bunyad_Theme_DarkMode
{
	public function __construct()
	{
		add_action('bunyad_theme_init', [$this, 'init']);	
	}
	
	public function init()
	{
		add_action('wp_head', [$this, 'add_js']);

		// Add the root class.
		add_filter('bunyad_html_root_class', [$this, 'add_root_class']);
	}

	/**
	 * This CANNOT be an enqueue as it's required inline early as possible. Otherwise
	 * the dark mode will have a flash of light mode.
	 */
	public function add_js()
	{
		$scheme_key = esc_js(
			apply_filters('bunyad_scheme_store_key', 'bunyad-scheme')
		);

		echo "
		<script>
		var BunyadSchemeKey = '{$scheme_key}';
		(() => {
			const d = document.documentElement;
			const c = d.classList;
			const scheme = localStorage.getItem(BunyadSchemeKey);
			if (scheme) {
				d.dataset.origClass = c;
				scheme === 'dark' ? c.remove('s-light', 'site-s-light') : c.remove('s-dark', 'site-s-dark');
				c.add('site-s-' + scheme, 's-' + scheme);
			}
		})();
		</script>
		";
	}

	/**
	 * Filter callback: Add scheme classes for the HTML root element.
	 *
	 * @param string $classes
	 * @return string
	 */
	public function add_root_class($classes) {

		$scheme_class = 's-light site-s-light';
		if (Bunyad::options()->color_scheme === 'dark') {
			$scheme_class = 's-dark site-s-dark';
		}

		if ($scheme_class) {
			$classes .= $classes ? ' ' : '';
			$classes .= $scheme_class;
		}

		return $classes;
	}
}

// init and make available in Bunyad::get('dark_mode')
Bunyad::register('dark_mode', [
	'class' => 'Bunyad_Theme_DarkMode',
	'init'  => true
]);