<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage Amaral
 * @since Amaral 1.0
 */
?>
<header id="main-banner">
	<div class="container">
		<?php
		// Slides
		$args = [
			'post_type'	=> 'slide'
		];

		$loop = new WP_Query( $args );

		if($loop->have_posts()) {
			echo '<div class="owl-carousel slider">';
			while( $loop->have_posts()){
				$loop->the_post();
				//print_r(get_field('imagem'));

				$titulo = get_the_title();
				$subtitulo = get_field('subtitulo');
				$texto_de_destaque = get_field('texto_de_destaque');
				$link = get_field('link');

				if ($link)
					echo '<a class="slide-item" href="' . $link . '">';
				else
					echo '<div class="slide-item">';

				echo '<div class="slide-item-text">';
				if ($texto_de_destaque) echo '<span>' . $texto_de_destaque . '</span>';
				if ($titulo) echo '<h2>' . $titulo . '</h2>';
				if ($subtitulo) echo '<p>' . $subtitulo . '</p>';
				echo '</div>';

				if (has_post_thumbnail()) {
					echo '<div class="slide-item-image"><figure>';
					the_post_thumbnail( $post->ID, 'full' );
					echo '</figure></div>';
				}

				if ($link)
					echo '</a>';
				else
				echo '</div>';

			}
			echo '</div>';
		}
		?>
	</div>
</header>