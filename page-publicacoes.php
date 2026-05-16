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

				<!-- Filtro -->
				<div class="dataset-filters-wrapper full-width mt-4">
					<form method="GET" action="<?php echo esc_url(get_permalink()); ?>" class="dataset-filters-form">

						<div class="dataset-search-bar">
							<input type="text" name="busca" placeholder="Buscar por título, descrição ou tags"
								value="<?php echo isset($_GET['busca']) ? esc_attr($_GET['busca']) : ''; ?>">

							<?php if (!empty($_GET['busca'])): ?>
								<a href="<?php echo esc_url(remove_query_arg(array('busca', 'paged'))); ?>"
									class="btn-clear-search" style="padding: 0.5rem; color:#888;" title="Limpar busca"><i
										class="fa-solid fa-xmark"></i></a>
							<?php endif; ?>

							<button type="submit" class="btn-search" aria-label="Buscar"><i
									class="fa-solid fa-magnifying-glass"></i></button>
							<button type="button" class="btn btn-outline-gray"
								onclick="document.querySelector('.dataset-advanced-filters').style.display = document.querySelector('.dataset-advanced-filters').style.display === 'none' ? 'block' : 'none';"
								aria-label="Exibir filtros"><i class="fa-solid fa-filter"></i> Filtros</button>
						</div>

						<div class="dataset-advanced-filters"
							style="display: <?php echo (!empty($_GET['categoria'])) ? 'block' : 'none'; ?>;">

							<!-- Categoria -->
							<div class="filter-group">
								<h4>Categoria</h4>
								<div class="filter-options">
									<?php
									$base_url = get_permalink();
									$current_args = $_GET;
									unset($current_args['paged']);

									$cat_atual = isset($_GET['categoria']) ? $_GET['categoria'] : '';

									$args_sem_cat = $current_args;
									unset($args_sem_cat['categoria']);
									$url_sem_cat = empty($args_sem_cat) ? $base_url : add_query_arg($args_sem_cat, $base_url);

									$class_active = empty($cat_atual) ? 'active' : '';
									echo '<a href="' . esc_url($url_sem_cat) . '" class="filter-badge ' . $class_active . '">Todas</a>';

									$categorias = get_posts(array('post_type' => 'categoria', 'posts_per_page' => -1, 'orderby' => 'title', 'order' => 'ASC'));
									if ($categorias) {
										foreach ($categorias as $cat) {
											$class_active = ($cat_atual == $cat->post_name) ? 'active' : '';
											$args_cat = $current_args;
											$args_cat['categoria'] = $cat->post_name;
											$url_cat = add_query_arg($args_cat, $base_url);
											echo '<a href="' . esc_url($url_cat) . '" class="filter-badge ' . $class_active . '">' . esc_html($cat->post_title) . '</a>';
										}
									}
									?>
								</div>
							</div>

							<?php if (isset($_GET['busca']) || isset($_GET['categoria']) || isset($_GET['autor']) || isset($_GET['tag'])): ?>
								<div class="filter-actions">
									<a href="<?php echo esc_url(get_permalink()); ?>" class="btn btn-outline-gray"><i
											class="fa-solid fa-trash-can"></i> Limpar filtros</a>
								</div>
							<?php endif; ?>
						</div>
					</form>
				</div>
				<?php the_content(); ?>
				<?php echo do_shortcode('[publicacoes]'); ?>
			</div>

		</article><!-- #post-## -->

	</main><!-- .site-main -->

</div><!-- .content-area -->
<?php get_footer(); ?>