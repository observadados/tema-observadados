<?php
/**
 * The template part for displaying content
 *
 * @package WordPress
 * @subpackage ObservaDados
 * @since ObservaDados 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php //observadados_post_thumbnail(); ?>

	<?php if ( has_post_thumbnail() ) : ?>
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
		<?php observadados_post_thumbnail(); ?>
		</a>
	<?php endif; ?>

	<div class="entry-wrapper">

		<?php

		$categories = get_the_category();
		if ( ! empty( $categories ) ) {
		    echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '" class="post-category">' . esc_html( $categories[0]->name ) . '</a>';
		}

		?>

		<p class="entry-date"><?php echo get_the_date(); ?></p>

		<header class="entry-header">
			<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
				<span class="sticky-post"><?php _e( 'Featured', 'observadados' ); ?></span>
			<?php endif; ?>

			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		</header><!-- .entry-header -->

		<?php observadados_excerpt(); ?>

		<div class="btn-container text-right">
			<a href="<?php echo get_permalink(); ?>" class="btn">Leia mais</a>
		</div>

	</div>


	<?php /*

	<div class="entry-content">
		<?php
			/* translators: %s: Name of current post *
			the_content( sprintf(
				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'observadados' ),
				get_the_title()
			) );

			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'observadados' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'observadados' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );
		?>
	</div><!-- .entry-content -->



	<footer class="entry-footer">
		<?php observadados_entry_meta(); ?>
		<?php
			edit_post_link(
				sprintf(
					/* translators: %s: Name of current post *
					__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'observadados' ),
					get_the_title()
				),
				'<span class="edit-link">',
				'</span>'
			);
		?>
	</footer><!-- .entry-footer -->

	*/ ?>
</article><!-- #post-## -->
