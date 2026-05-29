<?php
get_header();

// Arquivo do dataset
$files = get_field('arquivos') ? get_field('arquivos') : array();

$tamanho_total_bytes = 0;
$formatos_links = array();
$formatos_contagem = array();

if ($files) {
	foreach ($files as $row) {
		// 2) Soma do tamanho total (em bytes)
		if (isset($row['arquivo']['filesize'])) {
			$tamanho_total_bytes += $row['arquivo']['filesize'];
		}

		// Coleta de formatos
		if (isset($row['formato']) && is_a($row['formato'], 'WP_Term')) {
			$term = $row['formato'];

			// 1) Vetor de links únicos para o formato
			if (!isset($formatos_links[$term->slug])) {
				$link = home_url('/conjuntos-de-dados/?formato=' . $term->slug);
				$formatos_links[$term->slug] = '<a href="' . esc_url($link) . '" class="formato-link">' . esc_html($term->name) . '</a>';
			}

			// 3) Contagem de arquivos por formato
			if (!isset($formatos_contagem[$term->name])) {
				$formatos_contagem[$term->name] = 0;
			}
			$formatos_contagem[$term->name]++;
		}
	}
}

// Opcional: formata o tamanho em bytes para algo legível, como "14 MB"
$tamanho_formatado = size_format($tamanho_total_bytes, 2);

?>

<div id="primary" class="content-area-full-width">

	<main id="main" class="site-main" role="main">

		<header class="entry-header">
			<div class="container">
				<div class="entry-header-text">
					<?php // Categorias ?>
					<ul class="general-tags dataset-categories">
						<?php
						$categorias = get_the_terms(get_the_ID(), 'categoria_dataset');
						if ($categorias && !is_wp_error($categorias)) {
							foreach ($categorias as $categoria) {
								// Altere o parâmetro '?categoria_dataset=' conforme a necessidade do seu plugin de filtro (ex: '?_categoria_dataset=' para WP Grid Builder ou '?fwp_categoria=' para FacetWP)
								$link_filtro = home_url('/conjuntos-de-dados/?categoria=' . $categoria->slug);
								echo '<li><a href="' . esc_url($link_filtro) . '" class="category">' . esc_html($categoria->name) . '</a></li>';
							}
						}
						?>
					</ul>

					<?php the_title('<h1 class="entry-title"><span>', '</span></h1>'); ?>

					<?php // Metadados do cabeçalho ?>
					<ul class="dataset-header-metadata">
						<li><i class="fa-regular fa-calendar"></i> <?php echo get_the_date('d/m/Y') ?></li>
						<li>Formato: <?php echo implode(', ', $formatos_links); ?></li>
						<li><i class="fa-regular fa-file-zipper"></i> Tamanho: <?php echo $tamanho_formatado ?></li>
						<li><i class="fa-solid fa-download"></i>
							<?php echo observadados_get_dataset_downloads(get_the_ID()); ?> downloads</li>
					</ul>

					<?php // Resumo ?>
					<?php if (get_the_excerpt()): ?>
						<p class="dataset-excerpt"><?php echo get_the_excerpt(); ?></p>
					<?php endif; ?>
				</div>
			</div>
		</header>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<div class="entry-content-boxed full-width">
				<div class="page-row">
					<?php if (get_the_content() && get_the_content() != get_the_excerpt()): ?>
						<div class="entry-content entry-content-box">
							<?php the_content(); ?>
						</div>
					<?php endif; ?>
					<aside class="dataset-metadata">
						<a href="<?php echo esc_url(home_url('?download_dataset=' . get_the_ID() . '&file_index=all')); ?>"
							class="btn btn-download mb-2"><i class="fa-solid fa-download"></i> Download</a>

						<?php
						// Tags
						$tags = get_the_terms(get_the_ID(), 'post_tag');
						if ($tags && !is_wp_error($tags)):
							?>
								<ul class="general-tags sm dataset-tags">
									<?php foreach ($tags as $tag):
										$link_filtro = home_url('/conjuntos-de-dados/?tag=' . $tag->slug);
										?>
											<li><a href="<?php echo esc_url($link_filtro); ?>" class="category"><i
													class="fa-solid fa-tag"></i> <?php echo esc_html($tag->name); ?></a></li>
									<?php endforeach; ?>
								</ul>
						<?php endif; ?>

						<div class="dataset-metada-content">
							<?php // Origem ?>
							<h4>Origem</h4>
							<?php if (get_field('instituicao') || get_field('origem')): ?>
									<p><?php
									if (get_field('instituicao')) {
										$instituicoes = get_field('instituicao');
										$nomes = array();

										foreach ($instituicoes as $inst) {
											// Pega o título e o link dependendo se for Post Object (CPT) ou Taxonomia
											if (is_a($inst, 'WP_Post')) {
												$titulo = get_the_title($inst->ID);
												$link = get_field('link', $inst->ID);
											} elseif (is_a($inst, 'WP_Term')) {
												$titulo = $inst->name;
												$link = get_field('link', 'term_' . $inst->term_id);
											} else {
												// Fallback (caso seja retornado apenas string ou ID)
												$titulo = is_array($inst) ? (isset($inst['post_title']) ? $inst['post_title'] : $inst['name']) : (is_string($inst) ? $inst : '');
												$link = '';
											}

											// Monta o HTML
											if ($link) {
												$nomes[] = '<a href="' . esc_url($link) . '" target="_blank" rel="noopener">' . esc_html($titulo) . '</a>';
											} else {
												$nomes[] = esc_html($titulo);
											}
										}

										echo implode(', ', $nomes);
									} else {
										echo get_field('origem');
									}
									?>
									</p>
							<?php endif; ?>

							<?php // Link original ?>
							<h4>Link original</h4>
						<p><a href="<?php echo get_field('link') ?>"><?php echo get_field('link') ?></a>
						</p>

							<?php // Frequência de atualização ?>
							<h4>Frequência de atualização</h4>
							<p><?php echo get_field('frequencia') ?></p>

							<?php // Última varredura ?>
							<?php if (get_field('data_ultima_varredura')): ?>
									<h4>Última varredura</h4>
									<p><?php echo get_field('data_ultima_varredura') ?></p>
							<?php endif; ?>

							<?php // Downloads ?>
							<h4>Downloads</h4>
							<p><?php echo observadados_get_dataset_downloads(get_the_ID()); ?></p>

							<?php // Tratamento ?>
							<h4>Tratamento</h4>
							<p><?php echo (get_field('tratamento') == 'Dados tratados') ? '<span class="badge badge-lg text-bg-success">Dados tratados</span>' : '<span class="badge badge-lg text-bg-warning">Dados originais</span>' ?>
							</p>
						</div>
					</aside>
				</div>

				<?php
				// Passa as variáveis para o template part
				set_query_var('dataset_files', $files);
				set_query_var('dataset_formatos_contagem', $formatos_contagem);
				set_query_var('dataset_tamanho_formatado', $tamanho_formatado);
				set_query_var('dataset_id', get_the_ID());
				get_template_part('template-parts/dataset', 'visualization');
				?>

				<!-- Bibliotecas para ler CSV e XLSX via Javascript -->
				<script src="https://cdnjs.cloudflare.com/ajax/libs/PapaParse/5.4.1/papaparse.min.js"></script>
				<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

				<!-- Script modularizado com a lógica de visualização -->
				<script src="<?php echo get_template_directory_uri(); ?>/js/dataset-preview.js"></script>

		</article><!-- #post-## -->

	</main><!-- .site-main -->

</div><!-- .content-area -->

<?php get_footer(); ?>