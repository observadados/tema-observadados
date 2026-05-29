<?php
/**
 * Template part for displaying dataset files and visualization
 */

// Recupera variáveis globais ou do template onde este part foi incluído
$files = get_query_var('dataset_files', array());
$formatos_contagem = get_query_var('dataset_formatos_contagem', array());
$tamanho_formatado = get_query_var('dataset_tamanho_formatado', '');
?>
<div class="entry-content-boxed mt-5 full-width">
	<div class="page-row">
		<div class="dataset-visualization">

			<!-- Container para a tabela de pré-visualização -->
			<div id="dataset-preview-container"></div>

			<h3>Arquivos disponíveis</h3>
			<div class="dataset-file-list">
				<?php if ($files): ?>
					<?php foreach ($files as $index => $file):
						$arquivo = isset($file['arquivo']) ? $file['arquivo'] : array();
						$formato = isset($file['formato']) ? $file['formato'] : null;

						$filename = isset($arquivo['filename']) ? $arquivo['filename'] : (isset($arquivo['title']) ? $arquivo['title'] : 'Arquivo');
						$size = isset($arquivo['filesize']) ? size_format($arquivo['filesize'], 2) : '';
						$url = isset($arquivo['url']) ? $arquivo['url'] : '#';
						$desc = isset($file['descricao']) ? $file['descricao'] : '';
						$data = isset($file['data']) ? $file['data'] : '';
						$formato_nome = is_a($formato, 'WP_Term') ? $formato->name : '';
						$is_previewable = strtolower($formato_nome) === 'csv' || strpos(strtolower($filename), '.csv') !== false || strtolower($formato_nome) === 'xlsx' || strpos(strtolower($filename), '.xlsx') !== false;

						// TODO: Pré-visualização dos dados
						// Removendo temporariamente pois a funcionalidade não está implementada
						$is_previewable = false;

						// Link de download com o ID do Dataset e Indice
						$dataset_id = get_query_var('dataset_id', get_the_ID());
						$download_url = home_url('?download_dataset=' . $dataset_id . '&file_index=' . $index);
						?>
						<div class="dataset-file-item">
							<div class="dataset-file-item-header">
								<div class="file-info">
									<h5>
										<i class="fa-regular fa-file-lines"></i>
										<a href="<?php echo esc_url($download_url); ?>"><?php echo esc_html($filename); ?></a>
										<span class="file-size">(<?php echo $size; ?>)</span>
									</h5>
									<p class="file-meta">
										<?php if ($data): ?>Atualizado em
											<?php echo esc_html($data); ?> &bull;
										<?php endif; ?>
										<?php if ($formato_nome): ?><strong>
												<?php echo esc_html($formato_nome); ?>
											</strong>
										<?php endif; ?>
									</p>
								</div>
								<div class="file-action">
									<?php if ($is_previewable): ?>
										<button class="btn btn-outline btn-preview" data-url="<?php echo esc_url($url); ?>"><i
												class="fa-solid fa-eye"></i> Visualizar</button>
									<?php endif; ?>
									<a href="<?php echo esc_url($download_url); ?>" class="btn"><i
											class="fa-solid fa-download"></i>
										Download</a>
								</div>
							</div>
							<?php if ($desc): ?>
								<div class="file-desc">
									<?php echo $desc; ?>
								</div>
							<?php endif; ?>
						</div>
					<?php endforeach; ?>
				<?php else: ?>
					<p>Nenhum arquivo disponível no momento.</p>
				<?php endif; ?>
			</div>
		</div><!-- .dataset-visualization -->

		<?php // TODO: Visualização dos metadados ?>
		<?php /*
<aside class="dataset-files">
<h4>Resumo dos Dados</h4>
<ul class="dataset-summary-list">
<li><i class="fa-regular fa-folder-open"></i> <strong><?php echo count($files); ?> arquivos</strong>
</li>
<?php if (!empty($formatos_contagem)): ?>
<li>
<ul class="dataset-summary-formats">
<?php foreach ($formatos_contagem as $nome => $qtd): ?>
<li><?php echo esc_html($nome); ?>: <?php echo esc_html($qtd); ?></li>
<?php endforeach; ?>
</ul>
</li>
<?php endif; ?>
<li><i class="fa-solid fa-database"></i> <strong>Tamanho Total:</strong>
<?php echo esc_html($tamanho_formatado); ?></li>

<!-- Container dinâmico para o resumo das colunas -->
<div id="dataset-column-summary"></div>
</ul>
</aside>
*/ ?>
	</div>
</div>

<script>
	document.addEventListener('DOMContentLoaded', function () {
		document.querySelectorAll('.dataset-file-metadata').forEach(function (container) {
			const table = container.querySelector('.metadata-table');
			const note = container.querySelector('p');
			if (!table) return;

			// 1. Create collapsible container wrapper
			const wrapper = document.createElement('div');
			wrapper.className = 'metadata-collapse';

			// 2. Move table and note paragraph inside the wrapper
			table.parentNode.insertBefore(wrapper, table);
			wrapper.appendChild(table);
			if (note) {
				wrapper.appendChild(note);
			}

			// 3. Create toggle button
			const btn = document.createElement('button');
			btn.className = 'btn btn-outline btn-sm mb-0 btn-toggle-metadata';
			btn.innerHTML = '<i class="fa-solid fa-chevron-down"></i> Exibir metadados';
			btn.type = 'button';

			// 4. Insert toggle button immediately before the wrapper
			wrapper.parentNode.insertBefore(btn, wrapper);

			// 5. Add click event to toggle collapse with CSS transitions
			btn.addEventListener('click', function () {
				const isShown = wrapper.classList.contains('show');
				if (isShown) {
					wrapper.classList.remove('show');
					btn.innerHTML = '<i class="fa-solid fa-chevron-down"></i> Exibir metadados';
					btn.classList.remove('btn-primary');
					btn.classList.add('btn-outline');
				} else {
					wrapper.classList.add('show');
					btn.innerHTML = '<i class="fa-solid fa-chevron-up"></i> Esconder metadados';
					btn.classList.remove('btn-outline');
					btn.classList.add('btn-primary');
				}
			});
		});
	});
</script>