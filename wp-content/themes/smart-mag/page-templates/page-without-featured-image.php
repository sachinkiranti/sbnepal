<?php
/**
 * Template Name: Default Page Without Featured Image
 */

get_header();

?>

<div <?php Bunyad::markup()->attribs('main'); ?>>

	<div class="ts-row">
		<div class="col-8 main-content">
			
			<?php if (have_posts()): the_post(); endif; // load the page ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<?php if (Bunyad::posts()->meta('page_title') !== 'no'): ?>
			
				<header class="post-header">
					<h1 class="main-heading">
						<?php the_title(); ?>
					</h1>
				</header><!-- .post-header -->
				
			<?php endif; ?>
		
			<div class="post-content">
				<?php Bunyad::posts()->the_content(); ?>
			</div>
		

			</article>
			
		</div>
		
		<?php Bunyad::core()->theme_sidebar(); ?>
		
	</div> <!-- .row -->
</div> <!-- .main -->

<?php get_footer(); ?>
