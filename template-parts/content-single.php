<?php
/**
 * The template part for displaying single posts
 *
 * @package WordPress
 * @subpackage ObservaDados
 * @since ObservaDados 1.0
 */
?>

<header class="entry-header narrow">
	<?php
	$cats = get_the_category();
	if (!empty($cats)) {
		foreach ($cats as $cat) {
			echo '<a href="' . esc_url(home_url('/blog/?categoria=' . $cat->slug)) . '" class="badge badge-light">' . esc_html($cat->name) . '</a>';
		}
	}
	?>
	<div class="container">
		<div class="entry-header-text">
			<?php the_title('<h1 class="entry-title"><span>', '</span></h1>'); ?>
		</div>
	</div>
</header>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-content-boxed">
		<div class="entry-content entry-content-box no-background">

			<ul class="post-meta px-0">
				<li><i class="fa-regular fa-user"></i> <?php echo esc_html(get_the_author()); ?></li>
				<li><i class="fa-regular fa-calendar"></i> <?php echo esc_html(get_the_date()); ?></li>
			</ul>

			<?php if (has_post_thumbnail()): ?>
				<?php the_post_thumbnail('full'); ?>
			<?php endif; ?>

			<?php the_content(); ?>

			<hr>

			<?php $tags = get_the_tags();
			if ($tags) {
				echo '<h4 class="mb-0">Palavras-chave:</h4>';
				foreach ($tags as $tag) {
					echo '<a href="' . esc_url(home_url('/blog/?tag=' . $tag->slug)) . '" class="badge badge-light"><i class="fa-solid fa-tag"></i> ' . esc_html($tag->name) . '</a>';
				}
			} ?>

			<div class="button-wrapper text-center">
				<a href="/blog" class="btn btn-outline">Voltar para o blog</a>
			</div>
		</div><!-- .entry-content -->
	</div><!-- .entry-content-boxed -->

</article><!-- #post-## -->