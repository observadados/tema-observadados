<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage ObservaDados
 * @since ObservaDados 1.0
 */

get_header(); ?>

<div id="primary" class="content-area-full-width">

	<main id="main" class="site-main" role="main">
		<?php
		/**
		 * The template used for displaying page content
		 *
		 * @package WordPress
		 * @subpackage ObservaDados
		 * @since ObservaDados 1.0
		 */
		?>

		<header class="entry-header">
			<div class="container">
				<div class="entry-header-text">
					<?php the_title('<h1 class="entry-title"><span>', '</span></h1>'); ?>
					<?php if (get_field('subtitulo')): ?>
						<h2 class="entry-subtitle"><span><?php echo get_field('subtitulo') ?></h2>
					<?php endif; ?>
				</div>
			</div>
		</header>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="entry-content-boxed full-width">
				<?php the_content(); ?>
				<?php echo do_shortcode('[links]'); ?>
			</div>

		</article><!-- #post-## -->

	</main><!-- .site-main -->

</div><!-- .content-area -->
<?php get_footer(); ?>