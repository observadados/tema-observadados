<?php
/**
 * The template part for displaying results in search pages
 *
 * @package WordPress
 * @subpackage ObservaDados
 * @since ObservaDados 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('article-search'); ?>>

	<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

	<?php //observadados_post_thumbnail(); ?>

	<?php observadados_excerpt(); ?>

	<?php /* <a href="<?php the_permalink(); ?>" class="btn btn-sm">Saiba mais</a> */ ?>

</article><!-- #post-## -->

