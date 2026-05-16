<?php
/*
Template Name: Home
*/

get_header(); ?>

<?php
get_template_part('template-parts/content', 'home');
?>

<!-- Indicadores -->
<section class="home-section py-0" id="indicadores">
	<div class="container">
		<?php echo do_shortcode('[indicadores]') ?>
	</div>
</section>

<!-- Conjuntos de destaques -->
<section class="home-section" id="conjuntos-de-dados">
	<div class="container">
		<h3 class="home-section-title">Conjuntos de Dados em Destaque</h3>
		<?php echo do_shortcode('[dados_destaque]') ?>
		<div class="btn-container mt-4"><a href="<?php echo get_permalink(get_page_by_path('conjuntos-de-dados')) ?>"
				class="btn btn-outline">Todos
				conjuntos de dados</a></div>
	</div>
</section>

<!-- Contribua para transparência -->
<section class="home-section" id="contribua">
	<div class="container">
		<h3 class="home-section-title">Contribua com a Transparência</h3>
		<p>Trabalha com dados sobre segurança pública? Compartilhe com a comunidade e ajude a construir um Brasil mais
			transparente e seguro.</p>
		<div class="btn-container">
			<a href="<?php echo get_permalink(get_page_by_path('cadastrar-dados')) ?>"
				class="btn btn-lg btn-white">Cadastrar
				dados</a>
			<a href="<?php echo get_permalink(get_page_by_path('colabore')) ?>"
				class="btn btn-lg btn-outline-white">Saiba
				como
				colaborar</a>
		</div>
	</div>
</section>

<!-- Últimas do blog -->
<section class="home-section" id="blog">
	<div class="container">
		<h3 class="home-section-title">Últimas do blog</h3>
		<?php echo do_shortcode('[blog home="true"]') ?>
		<div class="btn-container mt-4"><a href="<?php echo get_permalink(get_page_by_path('blog')) ?>"
				class="btn btn-outline">Mais posts</a></div>
	</div>
</section>

<?php get_footer(); ?>