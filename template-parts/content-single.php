<?php
/**
 * The template part for displaying single posts
 *
 * @package WordPress
 * @subpackage ObservaDados
 * @since ObservaDados 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


	<?php if (get_field('super_titulo')): ?>
	<header class="entry-header column>" >
	<h1 class="entry-title bordered"><?php echo get_field('super_titulo'); ?></h1>
	<?php if (get_field('subtitulo')): ?>
	<h2 class="entry-subtitle"><?php echo get_field('subtitulo'); ?></h2>
	<?php endif; ?>
	<?php else: ?>
	<header class="entry-header">
	<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	<?php endif ?>
	<?php if (get_post_type() == 'producao' || get_post_type() == 'conteudo-audiovisual') : ?>
	<span class="entry-category"><?php echo get_field_object('categoria')['choices'][get_field('categoria')] ?></span>
	<?php endif ?>

	</header><!-- .entry-header -->

	<?php if(has_post_thumbnail()) : ?>

		<div class="container">
			<div class="row">
				<div class="col-4">
					<div class="post-thumbnail">
						<?php the_post_thumbnail( $post->ID, 'medium' ); ?>
					</div>
				</div>
				<div class="col-8">
					<div class="entry-content-boxed">
						<div class="entry-content">
							<?php
								the_content();
							?>
							<?php if(get_field('url')) : ?>
							<p class="text-right"><a href="<?php echo get_field('url') ?>" target="_blank" class="btn">Saiba mais</a></p>
							<?php endif; ?>
						</div><!-- .entry-content -->
					</div><!-- .entry-content-boxed -->
				</div>
			</div>
		</div>

	<?php else : ?>

	<div class="entry-content-boxed">

		<div class="entry-content">
			<?php if (get_post_type() == 'pesquisador') : ?>
			<ul class="reseacher-menu">
		        <li><?php echo ucfirst(get_field('categoria')); ?></li>
		        <li><a href="<?php echo get_field('lattes'); ?>" target="_blank"><img src="<?php echo get_template_directory_uri() ?>/img/lattes.svg" alt="Currículo Lattes" width="20"> <span>Currículo</span></a></li>
		        <li><a href="<?php echo get_field('orcid'); ?>" target="_blank"><i class="fab fa-orcid"></i> <span>ORCID</span></a></li>
		    </ul>
		    <?php
		   	endif;

			the_content();

			?>

			<?php if(get_field('url')) : ?>
			<p class="text-right"><a href="<?php echo get_field('url') ?>" target="_blank" class="btn">Saiba mais</a></p>
			<?php endif; ?>
		</div><!-- .entry-content -->

	</div><!-- .entry-content-boxed -->

	<?php endif; ?>

	<?php if (get_post_type() == 'producao' || get_post_type() == 'projeto' ) : ?>
	<div class="learn-more-container">
		<a href="/<?php echo get_post_type() ?>" class="btn btn-sm btn-gray">Mais sobre <?php echo (get_post_type() == 'projeto') ? strtoupper(get_post_type()).'S' : str_replace('PRODUCAO', 'PRODUÇÃO', strtoupper(get_post_type())) ?></a>
	</div>
	<?php endif; ?>

	<?php if (get_post_type() == 'pesquisador') : ?>
	<div class="learn-more-container">
		<a href="/<?php echo get_post_type() ?>" class="btn btn-sm btn-gray">Mais <?php echo strtoupper(get_post_type()).'ES' ?></a>
	</div>
	<?php endif; ?>

	<?php if (get_post_type() == 'conteudo-audiovisual') : ?>
	<div class="learn-more-container">
		<a href="/<?php echo str_replace('conteudo-', '', get_post_type()) ?>" class="btn btn-sm btn-gray">Mais sobre AUDIOVISUAL</a>
	</div>
	<?php endif; ?>

</article><!-- #post-## -->
