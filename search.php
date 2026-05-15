<?php
/**
 * The template for displaying search results pages
 *
 * @package WordPress
 * @subpackage ObservaDados
 * @since ObservaDados 1.0
 */

get_header(); ?>

<div id="primary" class="content-area-full-width">
	<main id="main" class="site-main" role="main">
		<div class="container">

			<h1 class="page-title margin-top">
				<?php printf(__('Resultados para: %s', 'observadados'), '<span>' . esc_html(get_search_query()) . '</span>'); ?>
			</h1>

			<?php
			$current_pt = isset($_GET['post_type']) ? sanitize_text_field($_GET['post_type']) : '';
			$base_search_url = home_url('/?s=' . urlencode(get_search_query()));
			?>
			<div class="search-filters my-2">
				<div class="filter-options" style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
					<a href="<?php echo esc_url($base_search_url); ?>"
						class="filter-badge <?php echo empty($current_pt) ? 'active' : ''; ?>">Todos</a>
					<a href="<?php echo esc_url(add_query_arg('post_type', 'publicacao', $base_search_url)); ?>"
						class="filter-badge <?php echo ($current_pt === 'publicacao') ? 'active' : ''; ?>">Publicações</a>
					<a href="<?php echo esc_url(add_query_arg('post_type', 'dataset', $base_search_url)); ?>"
						class="filter-badge <?php echo ($current_pt === 'dataset') ? 'active' : ''; ?>">Conjuntos de
						Dados</a>
					<a href="<?php echo esc_url(add_query_arg('post_type', 'post', $base_search_url)); ?>"
						class="filter-badge <?php echo ($current_pt === 'post') ? 'active' : ''; ?>">Blog</a>
				</div>
			</div>

			<?php if (have_posts()): ?>

				<?php
				// Start the loop.
				while (have_posts()):
					the_post();

					/**
					 * Run the loop for the search to output the results.
					 * If you want to overload this in a child theme then include a file
					 * called content-search.php and that will be used instead.
					 */
					get_template_part('template-parts/content', 'search');

					// End the loop.
				endwhile;

				// Pagination
				global $wp_query;
				$big = 999999999;
				$pagination = paginate_links(array(
					'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
					'format' => '?paged=%#%',
					'current' => max(1, get_query_var('paged')),
					'total' => $wp_query->max_num_pages,
					'prev_text' => '&laquo; Anterior',
					'next_text' => 'Próxima &raquo;',
				));
				if ($pagination) {
					echo '<div class="dataset-pagination mb-4">' . $pagination . '</div>';
				}
				?>

				<?php
			else:
				get_template_part('template-parts/content', 'none');

			endif;
			?>
		</div>

	</main><!-- .site-main -->
	</section><!-- .content-area -->

	<?php get_footer(); ?>