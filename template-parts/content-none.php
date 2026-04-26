<?php
/**
 * The template part for displaying a message that posts cannot be found
 *
 * @package WordPress
 * @subpackage ObservaDados
 * @since ObservaDados 1.0
 */
?>

<div id="primary" class="content-area-full-width">
	<main id="main" class="site-main" role="main">

		<div class="container px-0">
			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php _e( 'Nothing Found', 'observadados' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'observadados' ); ?></p>

					<?php get_search_form(); ?>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</div>

	</main><!-- .site-main -->

	<?php get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->


<?php /*
<div id="primary" class="content-area-full-width">
	<main id="main" class="site-main" role="main">
		<div class="container">
			<section class="no-results not-found">
				<header class="page-header">
					<h1 class="page-title"><?php _e( 'Nothing Found', 'observadados' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

						<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'observadados' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

					<?php elseif ( is_search() ) : ?>

						<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'observadados' ); ?></p>
						<?php get_search_form(); ?>

					<?php else : ?>

						<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'observadados' ); ?></p>
						<?php get_search_form(); ?>

					<?php endif; ?>
				</div><!-- .page-content -->
			</section><!-- .no-results -->
		</div>
	</main>
</div>
*/ ?>
