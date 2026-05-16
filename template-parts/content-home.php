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
		<div class="banner-grid">
			<div class="banner-content">
				<h1>Observatório de Dados Abertos sobre Segurança Pública</h1>
				<p>Acesse, explore e contribua com dados sobre segurança pública no Brasil. Transparência e informação para uma sociedade mais segura.</p>
				
				<form role="search" method="get" class="banner-search-form" action="<?php echo esc_url(home_url('/conjuntos-de-dados/')); ?>">
					<input type="search" class="search-field" placeholder="Buscar conjuntos de dados" value="" name="busca" />
					<button type="submit" class="search-submit" aria-label="Buscar"><i class="fa-solid fa-magnifying-glass"></i></button>
				</form>
			</div>
			<div class="banner-image">
				<img src="<?php echo esc_url(home_url('/wp-content/uploads/2026/04/banner-inicial.png')); ?>" alt="Ilustração de dados e segurança pública">
			</div>
		</div>
	</div>
</header>