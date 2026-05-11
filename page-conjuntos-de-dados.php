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

							<button type="submit" class="btn-search"><i
									class="fa-solid fa-magnifying-glass"></i></button>
							<button type="button" class="btn btn-outline-gray"
								onclick="document.querySelector('.dataset-advanced-filters').style.display = document.querySelector('.dataset-advanced-filters').style.display === 'none' ? 'block' : 'none';"><i
									class="fa-solid fa-filter"></i> Filtros</button>
						</div>

						<div class="dataset-advanced-filters"
							style="display: <?php echo (!empty($_GET['categoria']) || !empty($_GET['formato'])) ? 'block' : 'none'; ?>;">
							<!-- Categoria -->
							<div class="filter-group">
								<h4>Categoria</h4>
								<div class="filter-options">
									<?php
									$base_url = get_permalink();
									$current_args = $_GET;
									unset($current_args['paged']); // Remove paged se estiver na string
									
									$cat_atual = isset($_GET['categoria']) ? $_GET['categoria'] : '';

									$args_sem_cat = $current_args;
									unset($args_sem_cat['categoria']);
									$url_sem_cat = empty($args_sem_cat) ? $base_url : add_query_arg($args_sem_cat, $base_url);

									$class_active = empty($cat_atual) ? 'active' : '';
									echo '<a href="' . esc_url($url_sem_cat) . '" class="filter-badge ' . $class_active . '">Todas</a>';

									$categorias = get_terms(array('taxonomy' => 'categoria_dataset', 'hide_empty' => true));
									if (!is_wp_error($categorias) && !empty($categorias)) {
										foreach ($categorias as $cat) {
											$class_active = ($cat_atual === $cat->slug) ? 'active' : '';
											$args_cat = $current_args;
											$args_cat['categoria'] = $cat->slug;
											$url_cat = add_query_arg($args_cat, $base_url);
											echo '<a href="' . esc_url($url_cat) . '" class="filter-badge ' . $class_active . '">' . esc_html($cat->name) . '</a>';
										}
									}
									?>
								</div>
							</div>

							<!-- Formato -->
							<div class="filter-group">
								<h4>Formato</h4>
								<div class="filter-options">
									<?php
									$formato_atual = isset($_GET['formato']) ? $_GET['formato'] : '';

									$args_sem_fmt = $current_args;
									unset($args_sem_fmt['formato']);
									$url_sem_formato = empty($args_sem_fmt) ? $base_url : add_query_arg($args_sem_fmt, $base_url);

									$class_active = empty($formato_atual) ? 'active' : '';
									echo '<a href="' . esc_url($url_sem_formato) . '" class="filter-badge ' . $class_active . '">Todos</a>';

									$formatos = get_terms(array('taxonomy' => 'formato', 'hide_empty' => true));
									if (!is_wp_error($formatos) && !empty($formatos)) {
										foreach ($formatos as $fmt) {
											$class_active = ($formato_atual === $fmt->slug) ? 'active' : '';
											$args_fmt = $current_args;
											$args_fmt['formato'] = $fmt->slug;
											$url_fmt = add_query_arg($args_fmt, $base_url);
											echo '<a href="' . esc_url($url_fmt) . '" class="filter-badge ' . $class_active . '">' . esc_html(strtoupper($fmt->name)) . '</a>';
										}
									}
									?>
								</div>
							</div>

							<?php
							// Keep search state
							if (!empty($_GET['busca'])) {
								echo '<input type="hidden" name="busca" value="' . esc_attr($_GET['busca']) . '">';
							}
							?>

							<?php if (isset($_GET['busca']) || isset($_GET['categoria']) || isset($_GET['formato'])): ?>
								<div class="filter-actions">
									<a href="<?php echo esc_url(get_permalink()); ?>" class="btn btn-outline-gray"><i
											class="fa-solid fa-trash-can"></i> Limpar filtros</a>
								</div>
							<?php endif; ?>
						</div>
					</form>
				</div>
				<?php the_content(); ?>
				<?php echo do_shortcode('[dados]'); ?>
			</div>

		</article><!-- #post-## -->

	</main><!-- .site-main -->

</div><!-- .content-area -->
<?php get_footer(); ?>