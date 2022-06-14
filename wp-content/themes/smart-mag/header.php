<?php
/**
 * The template for displaying theme header
 * 
 * Parts: Top bar, Logo, Navigation
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="<?php 
	echo esc_attr(apply_filters('bunyad_html_root_class', '')); 
?>">

<head>

	<meta charset="<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="ahrefs-site-verification" content="50a940c15348ae2cf751ccc19fa38b2e24d59c61aaa9dfa83c59a01b2ab045ac">
	<?php wp_head(); ?>

<?php //if (Bunyad::options()->image_effects): // Only add effects CSS if JS enabled, hence via script ?>
<!--	<script>-->
<!--	document.querySelector('head').innerHTML += '<style class="bunyad-img-effects-css">.main-wrap .wp-post-image, .post-content img { opacity: 0; }</style>';-->
<!--	</script>-->
<?php //endif; ?>
<!--<script type="text/javascript">-->
<!--  (function (d, u, h, s) {-->
<!--    h = d.getElementsByTagName('head')[0];-->
<!--    s = d.createElement('script');-->
<!--    s.async = 1;-->
<!--    s.src = u + new Date().getTime();-->
<!--    h.appendChild(s);-->
<!--  })(document, 'https://grow.clearbitjs.com/api/pixel.js?v=');-->
<!--</script>-->

</head>

<body <?php body_class(); ?>>

<?php do_action('bunyad_begin_body'); ?>
<?php function_exists('wp_body_open') ? wp_body_open() : do_action('wp_body_open'); ?>

<?php if (Bunyad::options()->layout_type === 'boxed'): ?>
	<div class="ts-bg-cover"></div>
<?php endif; ?>

<div class="main-wrap">

	<?php 
	do_action('bunyad_header_before');

	/**
	 * Get the selected header template
	 * 
	 * Note: Default is partials/header/layout.php
	 */

	$header = Bunyad::options()->header_layout;

	Bunyad::blocks()->load(
		'Header',
		[
			'style' => $header,
		]
	)
	->render();

	// Mobile header.
	Bunyad::blocks()->load(
		'Header',
		[
			'style' => 'a',
			'type'  => 'mobile',
		]
	)
	->render();

	do_action('bunyad_header_after');
	?>

<?php do_action('bunyad_pre_main_content'); ?>