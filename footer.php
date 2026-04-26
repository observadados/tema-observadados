<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WordPress
 * @subpackage ObservaDados
 * @since ObservaDados 1.0
 */
?>
		</div><!-- .site-content -->


	<a class="btn-top page-scroll" href="#page"><i class="fas fa-angle-up"></i> <span>Topo</span></a>

	<footer class="footer" role="contentinfo">

		<div class="footer-upper">			
			<div class="container">
				<div class="row">
					<div class="col logo-container">
						<div>
						<?php
						$logo_rodape = get_field( 'logo_rodape', 'option' );
						$conteudo_rodape = get_field( 'conteudo_rodape', 'option' );
						if ($logo_rodape)
							echo '<a href="' . home_url() . '"><figure class="logo-footer"><img src="' . $logo_rodape['url'] . '"></figure></a>';
						if ($conteudo_rodape) echo '<div>' . nl2br($conteudo_rodape) . '</div>';
						?>

						</div>
					</div>
					<div class="col">
						<?php if ( has_nav_menu( 'footer' ) ) : ?>
							<h4>Navegação rápida</h4>
							<?php
								wp_nav_menu( array(
									'theme_location' => 'footer',
									'menu_class'     => 'footer-menu',
								) );
							?>
						<?php endif; ?>
					</div>
					<div class="col">
						<h4><a hrf="/contato">Contato</a></h4>
						<?php
						$email_contato = get_field( 'email', 'option' );
						if ( $email_contato)
							echo '<a href="mailto:' . $email_contato . '"><i class="fa-regular fa-envelope"></i> ' . $email_contato . '</a>';
						?>
						<?php echo do_shortcode('[redes]') ?>
					</div>
				</div>
			</div>
		</div>

		<div class="container">

			<?php if (get_field( 'copyright', 'option' )) : ?>
			<div class="site-info">
				<?php echo nl2br(get_field( 'copyright', 'option' )) ?>
			</div>
			<?php endif; ?>
		</div>
	</footer><!-- .site-footer -->
</div><!-- .site -->

<?php wp_footer(); ?>
</body>
</html>
