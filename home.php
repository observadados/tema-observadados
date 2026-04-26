<?php
/*
Template Name: Home
*/

get_header(); ?>

	<?php
		get_template_part( 'template-parts/content', 'home' );
	?>

	<?php
		$args = array(
			'post_type' => 'secao'
		);

		$loop = new WP_Query( $args );

	    if($loop->have_posts()){
	        while( $loop->have_posts()){
	            $loop->the_post();

				if (get_field('cor_de_texto') != '#333333' || get_field('cor_de_fundo') != '#ffffff') {
					echo '<style>';
					if (get_field('cor_de_texto') != '#333333') {
						echo '#' . $post->post_name . ' *:not(.wp-block-button__link) {';
						echo 'color: '. get_field('cor_de_texto') . ' !important';
						echo '}';
					}
					if (get_field('cor_de_fundo') != '#ffffff') {
						echo '#' . $post->post_name . ' {';
						echo 'background: '. get_field('cor_de_fundo') . ' !important';
						echo '}';
					}
					echo '</style>';
				}
	            ?>

	            <section class="section section-home" id="<?php echo $post->post_name; ?>">

					<?php if (get_field('exibir_titulo')) : ?>
		            	<h1 class="section-header"><?php the_title() ?></h1>
					<?php endif; ?>

					<div class="section-container">

					<?php if (get_the_post_thumbnail($post->ID)) : ?>
	            	<div class="section-thumbnail">
						<?php the_post_thumbnail( $post->ID, 'medium' ); ?>
					</div>

					<div class="section-text">
						<?php the_content(); ?>
	            	</div>

					<?php else : ?>

					<div class="section-text full-width">
						<?php the_content(); ?>
	            	</div>

					<?php endif; ?>
					</div>

	            </section>

	            <?php
	        }
	    }

		wp_reset_query();
	?>

<?php get_footer(); ?>
