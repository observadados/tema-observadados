<?php
/**
 * The template part for displaying single posts
 *
 * @package WordPress
 * @subpackage ObservaDados
 * @since ObservaDados 1.0
 */
?>

<header class="entry-header">
	<div class="container">
		<?php
		$categorias_field = get_field('categoria');
		if ($categorias_field) {
			if (!is_array($categorias_field)) {
				$categorias_field = array($categorias_field);
			}
			foreach ($categorias_field as $c_id) {
				$c_post = is_object($c_id) ? $c_id : get_post($c_id);
				if ($c_post) {
					echo '<a href="' . esc_url(home_url('/publicacoes/?categoria=' . $c_post->post_name)) . '" class="badge badge-light">' . esc_html(get_the_title($c_post->ID)) . '</a> ';
				}
			}
		}
		?>
	</div>
	<div class="container">
		<div class="entry-header-text">
			<?php the_title('<h1 class="entry-title" style="margin-bottom: 0.5rem;"><span>', '</span></h1>'); ?>

			<?php
			$autoria_field = get_field('autoria') ? get_field('autoria') : get_field('autor');
			if ($autoria_field) {
				if (!is_array($autoria_field)) {
					$autoria_field = array($autoria_field);
				}
				$nomes_autores = array();
				foreach ($autoria_field as $a_id) {
					$a_post = is_object($a_id) ? $a_id : get_post($a_id);
					if ($a_post) {
						$nomes_autores[] = '<a href="' . esc_url(home_url('/publicacoes/?autor=' . $a_post->post_name)) . '" style="text-decoration: underline; color: #555;">' . esc_html(get_the_title($a_post->ID)) . '</a>';
					}
				}
				if (!empty($nomes_autores)) {
					echo '<div class="publicacao-autores">' . implode(', ', $nomes_autores) . '</div>';
				}
			}
			?>
		</div>
	</div>
</header>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-content-boxed full-width">
		<div class="entry-content entry-content-box no-background">

			<?php the_content(); ?>

			<?php
			$tags = get_the_terms(get_the_ID(), 'post_tag');
			if ($tags && !is_wp_error($tags)) {
				echo '<h4 class="mb-0">Palavras-chave</h4>';
				echo '<div class="dataset-item-tags mb-4" style="margin-bottom: 1.5rem;">';
				foreach ($tags as $tag) {
					echo '<a href="' . esc_url(home_url('/publicacoes/?tag=' . $tag->slug)) . '" class="badge badge-light" style="margin-bottom: 0;"><i class="fa-solid fa-tag"></i> ' . esc_html($tag->name) . '</a> ';
				}
				echo '</div>';
			}
			?>

			<div class="dataset-item-actions"
				style="display: flex; gap: 0.75rem; flex-wrap: wrap; margin-bottom: 2rem;">
				<?php
				$arquivo = get_field('arquivo');
				if ($arquivo) {
					$url_arquivo = is_array($arquivo) ? $arquivo['url'] : $arquivo;
					echo '<a href="' . esc_url($url_arquivo) . '" class="btn btn-primary" target="_blank" style="margin-bottom:0;"><i class="fa-solid fa-arrow-up-right-from-square"></i> Download</a>';
				}

				$link_original = get_field('link');
				if ($link_original) {
					echo '<a href="' . esc_url($link_original) . '" class="btn btn-primary" target="_blank" style="margin-bottom:0;"><i class="fa-solid fa-arrow-up-right-from-square"></i> Publicação original</a>';
				}

				$citacao = get_field('citacao');
				if ($citacao) {
					$modal_id = 'modal-citacao-' . get_the_ID();
					echo '<button type="button" class="btn btn-outline" onclick="document.getElementById(\'' . $modal_id . '\').showModal()" style="margin-bottom:0;"><i class="fa-solid fa-quote-left"></i> Como citar</button>';

					echo '<dialog id="' . $modal_id . '" class="modal-citacao">';
					echo '  <h3 class="mb-2">Como citar:</h3>';
					echo '  <div>' . wp_kses_post($citacao) . '</div>';
					echo '  <div><button type="button" class="btn btn-outline" onclick="document.getElementById(\'' . $modal_id . '\').close()">Fechar</button></div>';
					echo '</dialog>';

					echo '<script>
						const dialog_' . str_replace('-', '_', $modal_id) . ' = document.getElementById("' . $modal_id . '");
						dialog_' . str_replace('-', '_', $modal_id) . '.addEventListener("click", function(event) {
							const rect = this.getBoundingClientRect();
							const isInDialog = (rect.top <= event.clientY && event.clientY <= rect.top + rect.height && rect.left <= event.clientX && event.clientX <= rect.left + rect.width);
							if (!isInDialog) {
								this.close();
							}
						});
					</script>';
				}
				?>
			</div>

			<div class="button-wrapper text-center">
				<a href="/publicacoes" class="btn btn-outline">Todas as publicações</a>
			</div>
		</div><!-- .entry-content -->
	</div><!-- .entry-content-boxed -->

</article><!-- #post-## -->