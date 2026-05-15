<?php
/**
 * The template part for displaying single integrante
 *
 * @package WordPress
 * @subpackage ObservaDados
 * @since ObservaDados 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<div class="container">
			<div class="entry-header-text">
				<?php the_title('<h1 class="entry-title">', '</h1>'); ?>
				<?php if (get_field('papel')): ?>
					<h2 class="entry-subtitle">
						<?php echo esc_html(get_field('papel')); ?>
					</h2>
				<?php endif; ?>
			</div>
		</div>
	</header><!-- .entry-header -->

	<div class="container px-0">
		<div class="entry-content-boxed full-width px-0">
			<div class="page-row">
				<aside class="integrante-sidebar">
					<?php if (has_post_thumbnail()): ?>
						<div class="post-thumbnail">
							<?php the_post_thumbnail('medium'); ?>
						</div>
					<?php endif; ?>

					<?php
					$lattes = get_field('lattes');
					$github = get_field('github');
					$x = get_field('x');
					$instagram = get_field('instagram');
					$linkedin = get_field('linkedin');

					if ($lattes || $github || $x || $instagram || $linkedin):
						?>
						<ul class="grid-item-social center">
							<?php if ($lattes):
								$lattes_svg_path = get_template_directory() . '/img/lattes.svg';
								$lattes_icon = file_exists($lattes_svg_path) ? file_get_contents($lattes_svg_path) : 'Lattes';
								?>
								<li><a href="<?php echo esc_url($lattes); ?>" target="_blank" title="Lattes"
										style="color: #1B263B; font-size: 1.25rem; display: block; line-height: 1; box-shadow: none;">
										<div
											style="width: 1.25rem; height: 1.25rem; display: flex; align-items: center; justify-content: center; fill: currentColor;">
											<?php echo $lattes_icon; ?>
										</div>
									</a></li>
							<?php endif; ?>
							<?php if ($github): ?>
								<li><a href="<?php echo esc_url($github); ?>" target="_blank" title="GitHub"
										style="color: #1B263B; font-size: 1.25rem; display: block; box-shadow: none;"><i
											class="fab fa-github"></i></a></li>
							<?php endif; ?>
							<?php if ($x): ?>
								<li><a href="<?php echo esc_url($x); ?>" target="_blank" title="X"
										style="color: #1B263B; font-size: 1.25rem; display: block; box-shadow: none;">
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
											style="width: 1em; height: 1em; fill: currentColor;">
											<path
												d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z" />
										</svg>
									</a></li>
							<?php endif; ?>
							<?php if ($instagram): ?>
								<li><a href="<?php echo esc_url($instagram); ?>" target="_blank" title="Instagram"
										style="color: #1B263B; font-size: 1.25rem; display: block; box-shadow: none;"><i
											class="fab fa-instagram"></i></a></li>
							<?php endif; ?>
							<?php if ($linkedin): ?>
								<li><a href="<?php echo esc_url($linkedin); ?>" target="_blank" title="LinkedIn"
										style="color: #1B263B; font-size: 1.25rem; display: block; box-shadow: none;"><i
											class="fab fa-linkedin-in"></i></a></li>
							<?php endif; ?>
						</ul>
					<?php endif; ?>
				</aside>

				<main class="integrante-main-content">

					<div class="entry-content entry-content-box full-width">
						<?php the_content(); ?>
					</div>

					<div class="text-center mt-4">
						<a href="/equipe" class="btn btn-outline">Conheça toda a equipe</a>
					</div>
				</main>
			</div>
		</div>
	</div>

</article><!-- #post-## -->