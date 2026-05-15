<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage ObservaDados
 * @since ObservaDados 1.0
 */

get_header(); ?>

<div id="primary" class="content-area-full-width">

	<main id="main" class="site-main" role="main">
		<?php
		// Start the loop.
		while (have_posts()):
			the_post();

			// Include the single post content template.
			get_template_part('template-parts/content', 'single-integrante');

			// End of the loop.
		endwhile;
		?>

	</main><!-- .site-main -->

</div><!-- .content-area -->

<?php get_footer(); ?>