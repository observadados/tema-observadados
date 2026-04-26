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

	<?php if (get_the_content()): ?>
		<div class="entry-content-boxed full-width">

			<?php if (get_field('paginas_relacionadas')): ?>
				<div class="page-row">
					<div class="entry-content entry-content-box">
						<?php
						the_content();
						?>
					</div><!-- .entry-content -->
					<nav class="page-menu">
						<ul>
							<?php
							foreach (get_field('paginas_relacionadas') as $p) {
								$current_class = ($p->ID == get_the_ID()) ? ' class="current"' : '';
								echo '<li' . $current_class . '><a href="' . get_permalink($p->ID) . '">' . str_replace('|', '', $p->post_title) . '</a></li>';
							}
							?>
						</ul>
					</nav>
				</div>
			<?php else: ?>
				<div class="entry-content entry-content-box">
					<?php the_content(); ?>
				</div><!-- .entry-content -->
			<?php endif; ?>
		</div><!-- .entry-content-boxed -->
	<?php endif; ?>

</article><!-- #post-## -->