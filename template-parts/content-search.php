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

	<?php
	$tipo = get_post_type_object($post->post_type);
	
	// Print a nicer badge for the post type
	if ($tipo) {
		echo '<span class="badge badge-light mb-2 d-inline-block">' . esc_html($tipo->labels->singular_name) . '</span>';
	}
	
	$custom_link = get_permalink();
	if ($post->post_type === 'categoria') {
		$custom_link = home_url('/publicacoes/?categoria=' . $post->post_name);
	} elseif ($post->post_type === 'autor') {
		$custom_link = home_url('/publicacoes/?autor=' . $post->post_name);
	}
	?>

	<?php the_title(sprintf('<h2 class="entry-title mb-1"><a href="%s" rel="bookmark">', esc_url($custom_link)), '</a></h2>'); ?>

	<?php // observadados_post_thumbnail(); ?>

	<?php if (get_the_excerpt()): ?>
		<?php echo '<p class="mb-1">' . get_the_excerpt() . '</p>'; ?>
	<?php endif; ?>

	<a href="<?php echo esc_url($custom_link); ?>" class="btn btn-outline">Saiba mais</a>

</article><!-- #post-## -->