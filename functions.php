<?php
/**
 * ObservaDados functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage ObservaDados
 * @since ObservaDados 1.0
 */

/**
 * ObservaDados only works in WordPress 4.4 or later.
 */
if (version_compare($GLOBALS['wp_version'], '4.4-alpha', '<')) {
	require get_template_directory() . '/inc/back-compat.php';
}

if (!function_exists('observadados_setup')):
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * Create your own observadados_setup() function to override in a child theme.
	 *
	 * @since ObservaDados 1.0
	 */
	function observadados_setup()
	{
		/*
		 * Make theme available for translation.
		 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/observadados
		 * If you're building a theme based on ObservaDados, use a find and replace
		 * to change 'observadados' to the name of your theme in all the template files
		 */
		load_theme_textdomain('observadados');

		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support('title-tag');

		/*
		 * Enable support for custom logo.
		 *
		 *  @since ObservaDados 1.2
		 */
		add_theme_support('custom-logo', array(
			'height' => 400,
			'width' => 400,
			'flex-height' => true,
		));

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		 */
		add_theme_support('post-thumbnails');
		set_post_thumbnail_size(1200, 9999);

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(array(
			'primary' => __('Primary Menu', 'observadados'),
			'social' => __('Social Links Menu', 'observadados'),
			'footer' => __('Rodapé', 'observadados'),
			'featured' => __('Destaque', 'observadados')
		));

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support('html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		));

		/*
		 * Enable support for Post Formats.
		 *
		 * See: https://codex.wordpress.org/Post_Formats
		 */
		add_theme_support('post-formats', array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
			'gallery',
			'status',
			'audio',
			'chat',
		));

		/*
		 * This theme styles the visual editor to resemble the theme style,
		 * specifically font, colors, icons, and column width.
		 */
		add_editor_style(array('css/editor-style.css', observadados_fonts_url()));

		// Indicate widget sidebars can use selective refresh in the Customizer.
		add_theme_support('customize-selective-refresh-widgets');
	}
endif; // observadados_setup
add_action('after_setup_theme', 'observadados_setup');

/**
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 *
 * @since ObservaDados 1.0
 */
function observadados_content_width()
{
	$GLOBALS['content_width'] = apply_filters('observadados_content_width', 840);
}
add_action('after_setup_theme', 'observadados_content_width', 0);

/**
 * Registers a widget area.
 *
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 *
 * @since ObservaDados 1.0
 */
function observadados_widgets_init()
{

	/*
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'observadados' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'observadados' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );


	register_sidebar( array(
		'name'          => __( 'Content Bottom 1', 'observadados' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'observadados' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Content Bottom 2', 'observadados' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'observadados' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	*/

	/*
	register_sidebar( array(
		'name'          => __( 'E-mails', 'observadados' ),
		'id'            => 'emails',
		'description'   => __( 'Lista de e-mails da página Fale conosco.', 'observadados' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	) );
	*/

}
add_action('widgets_init', 'observadados_widgets_init');

if (!function_exists('observadados_fonts_url')):
	/**
	 * Register Google fonts for ObservaDados.
	 *
	 * Create your own observadados_fonts_url() function to override in a child theme.
	 *
	 * @since ObservaDados 1.0
	 *
	 * @return string Google fonts URL for the theme.
	 */
	function observadados_fonts_url()
	{
		$fonts_url = '';
		$fonts = array();
		$subsets = 'latin,latin-ext';

		/* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language. */
		if ('off' !== _x('on', 'Merriweather font: on or off', 'observadados')) {
			$fonts[] = 'Merriweather:400,700,900,400italic,700italic,900italic';
		}

		/* translators: If there are characters in your language that are not supported by Montserrat, translate this to 'off'. Do not translate into your own language. */
		if ('off' !== _x('on', 'Montserrat font: on or off', 'observadados')) {
			$fonts[] = 'Montserrat:400,700';
		}

		/* translators: If there are characters in your language that are not supported by Inconsolata, translate this to 'off'. Do not translate into your own language. */
		if ('off' !== _x('on', 'Inconsolata font: on or off', 'observadados')) {
			$fonts[] = 'Inconsolata:400';
		}

		if ($fonts) {
			$fonts_url = add_query_arg(array(
				'family' => urlencode(implode('|', $fonts)),
				'subset' => urlencode($subsets),
			), 'https://fonts.googleapis.com/css');
		}

		return $fonts_url;
	}
endif;

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since ObservaDados 1.0
 */
function observadados_javascript_detection()
{
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action('wp_head', 'observadados_javascript_detection', 0);

/**
 * Enqueues scripts and styles.
 *
 * @since ObservaDados 1.0
 */
function observadados_scripts()
{
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style('observadados-fonts', observadados_fonts_url(), array(), null);

	// Add Genericons, used in the main stylesheet.
	wp_enqueue_style('genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.4.1');

	// Add Font Awesome
	wp_enqueue_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css');

	// Theme stylesheet.
	wp_enqueue_style('observadados-style', get_stylesheet_uri());

	wp_enqueue_script('observadados-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20250309', true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}

	if (is_singular() && wp_attachment_is_image()) {
		wp_enqueue_script('observadados-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array('jquery'), '20250309');
	}

	wp_enqueue_script('observadados-script', get_template_directory_uri() . '/js/functions.js', array('jquery'), '20250309', true);

	wp_enqueue_style('owl.carousel', get_template_directory_uri() . '/js/plugins/owl.carousel/dist/assets/owl.carousel.min.css');
	wp_enqueue_style('owl.carousel', get_template_directory_uri() . '/js/plugins/owl.carousel/dist/assets/owl.theme.default.min.css');
	wp_enqueue_style('theme-css', get_template_directory_uri() . '/css/theme.css');

	wp_enqueue_script('meiomask', get_template_directory_uri() . '/js/plugins/jquery-meiomask/dist/meiomask.min.js', array('jquery'), '20250309', true);
	//wp_enqueue_script( 'validate', get_template_directory_uri() . '/js/plugins/jquery-validation/dist/jquery.validate.min.js', array( 'jquery' ), '20250309', true );
	//wp_enqueue_script( 'validate-localization', get_template_directory_uri() . '/js/plugins/jquery-validation/src/localization/messages_pt_BR.js' );
	wp_enqueue_script('owl.carousel', get_template_directory_uri() . '/js/plugins/owl.carousel/dist/owl.carousel.min.js', array('jquery'), '20250309', true);
	wp_enqueue_script('theme-js', get_template_directory_uri() . '/js/theme.js', array('jquery'), '20250309', true);

	wp_localize_script('observadados-script', 'screenReaderText', array(
		'expand' => __('expand child menu', 'observadados'),
		'collapse' => __('collapse child menu', 'observadados'),
	));
}
add_action('wp_enqueue_scripts', 'observadados_scripts');

/**
 * Adds custom classes to the array of body classes.
 *
 * @since ObservaDados 1.0
 *
 * @param array $classes Classes for the body element.
 * @return array (Maybe) filtered body classes.
 */
function observadados_body_classes($classes)
{
	// Adds a class of custom-background-image to sites with a custom background image.
	if (get_background_image()) {
		$classes[] = 'custom-background-image';
	}

	// Adds a class of group-blog to sites with more than 1 published author.
	if (is_multi_author()) {
		$classes[] = 'group-blog';
	}

	// Adds a class of no-sidebar to sites without active sidebar.
	if (!is_active_sidebar('sidebar-1')) {
		$classes[] = 'no-sidebar';
	}

	// Adds a class of hfeed to non-singular pages.
	if (!is_singular()) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter('body_class', 'observadados_body_classes');

/**
 * Converts a HEX value to RGB.
 *
 * @since ObservaDados 1.0
 *
 * @param string $color The original color, in 3- or 6-digit hexadecimal form.
 * @return array Array containing RGB (red, green, and blue) values for the given
 *               HEX code, empty array otherwise.
 */
function observadados_hex2rgb($color)
{
	$color = trim($color, '#');

	if (strlen($color) === 3) {
		$r = hexdec(substr($color, 0, 1) . substr($color, 0, 1));
		$g = hexdec(substr($color, 1, 1) . substr($color, 1, 1));
		$b = hexdec(substr($color, 2, 1) . substr($color, 2, 1));
	} else if (strlen($color) === 6) {
		$r = hexdec(substr($color, 0, 2));
		$g = hexdec(substr($color, 2, 2));
		$b = hexdec(substr($color, 4, 2));
	} else {
		return array();
	}

	return array('red' => $r, 'green' => $g, 'blue' => $b);
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
// require get_template_directory() . '/inc/customizer.php';

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images
 *
 * @since ObservaDados 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function observadados_content_image_sizes_attr($sizes, $size)
{
	$width = $size[0];

	if (840 <= $width) {
		$sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 62vw, 840px';
	}

	if ('page' === get_post_type()) {
		if (840 > $width) {
			$sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
		}
	} else {
		if (840 > $width && 600 <= $width) {
			$sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 61vw, (max-width: 1362px) 45vw, 600px';
		} elseif (600 > $width) {
			$sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
		}
	}

	return $sizes;
}
add_filter('wp_calculate_image_sizes', 'observadados_content_image_sizes_attr', 10, 2);

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails
 *
 * @since ObservaDados 1.0
 *
 * @param array $attr Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size Registered image size or flat array of height and width dimensions.
 * @return array The filtered attributes for the image markup.
 */
function observadados_post_thumbnail_sizes_attr($attr, $attachment, $size)
{
	if ('post-thumbnail' === $size) {
		if (is_active_sidebar('sidebar-1')) {
			$attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 60vw, (max-width: 1362px) 62vw, 840px';
		} else {
			$attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 88vw, 1200px';
		}
	}
	return $attr;
}
add_filter('wp_get_attachment_image_attributes', 'observadados_post_thumbnail_sizes_attr', 10, 3);

/**
 * Modifies tag cloud widget arguments to display all tags in the same font size
 * and use list format for better accessibility.
 *
 * @since ObservaDados 1.1
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array The filtered arguments for tag cloud widget.
 */
function observadados_widget_tag_cloud_args($args)
{
	$args['largest'] = 1;
	$args['smallest'] = 1;
	$args['unit'] = 'em';
	$args['format'] = 'list';

	return $args;
}
add_filter('widget_tag_cloud_args', 'observadados_widget_tag_cloud_args');


function logo_size_change()
{
	remove_theme_support('custom-logo');
	add_theme_support('custom-logo', array(
		'height' => 100,
		'width' => 400,
		'flex-height' => true,
		'flex-width' => true,
	));
}
add_action('after_setup_theme', 'logo_size_change', 11);

// [redes]
function redes_func($atts)
{

	$a = shortcode_atts(array(
		'destaque' => false
	), $atts);

	$args = [
		'post_type' => 'rede-social',
		'posts_per_page' => -1
	];
	$loop = new WP_Query($args);

	$count = $loop->post_count;

	$content = '<ul class="social-menu">';
	if ($loop->have_posts()) {
		while ($loop->have_posts()) {
			$loop->the_post();
			if (!((bool) $a['destaque']) || get_field('destaque'))
				$content .= "<li><a href='" . get_field('url') . "' title={the_title()} target='" . get_field('alvo') . "'>" . get_field('icone') . "</a></li>";
		}
	}
	$content .= '</ul>';

	wp_reset_query();

	return $content;
}
add_shortcode('redes', 'redes_func');


// [equipe]
function equipe_func($atts)
{

	$a = shortcode_atts(array(
		'destaque' => false
	), $atts);

	$args = [
		'post_type' => 'integrante',
		'posts_per_page' => -1
	];
	$loop = new WP_Query($args);

	$content = '<ul class="grid-container">';
	if ($loop->have_posts()) {
		while ($loop->have_posts()) {
			$loop->the_post();

			$nome = get_the_title();
			$link = get_permalink();
			$papel = get_field('papel');
			$resumo = get_the_excerpt();

			$foto = get_the_post_thumbnail(get_the_ID(), 'medium', ['class' => 'img-fluid']);
			if (!$foto) {
				$foto = '<div class="image-placeholder"></div>';
			}

			$lattes = get_field('lattes');
			$github = get_field('github');
			$x = get_field('x');
			$instagram = get_field('instagram');
			$linkedin = get_field('linkedin');

			$social_html = '<ul class="grid-item-social">';
			if ($lattes) {
				$lattes_svg_path = get_template_directory() . '/img/lattes.svg';
				$lattes_icon = file_exists($lattes_svg_path) ? file_get_contents($lattes_svg_path) : 'Lattes';
				$social_html .= '<li><a href="' . esc_url($lattes) . '" target="_blank" title="Lattes">' . $lattes_icon . '</a></li>';
			}
			if ($github) {
				$social_html .= '<li><a href="' . esc_url($github) . '" target="_blank" title="GitHub"><i class="fab fa-github"></i></a></li>';
			}
			if ($x) {
				$social_html .= '<li><a href="' . esc_url($x) . '" target="_blank" title="X"><i class="fab fa-x-twitter"></i></a></li>';
			}
			if ($instagram) {
				$social_html .= '<li><a href="' . esc_url($instagram) . '" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a></li>';
			}
			if ($linkedin) {
				$social_html .= '<li><a href="' . esc_url($linkedin) . '" target="_blank" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a></li>';
			}
			$social_html .= '</ul>';

			$content .= '<li class="grid-item">';
			$content .= '<div class="grid-item-photo"><a href="' . esc_url($link) . '">' . $foto . '</a></div>';
			$content .= '<div class="grid-item-info">';

			$content .= '<h3 class="grid-item-title"><a href="' . esc_url($link) . '">' . esc_html($nome) . '</a></h3>';
			if ($papel) {
				$content .= '<span class="grid-item-role">' . esc_html($papel) . '</span>';
			}
			if ($resumo) {
				$content .= '<div class="grid-item-desc">' . $resumo . '</div>';
			}

			$content .= $social_html;
			$content .= '<a href="' . esc_url($link) . '" class="grid-item-link">Ler mais &rarr;</a>';

			$content .= '</div>'; // .grid-item-info
			$content .= '</li>'; // .grid-item
		}
	}
	$content .= '</ul>';

	wp_reset_query();

	return $content;
}
add_shortcode('equipe', 'equipe_func');


// [links]
function links_func()
{
	$terms = get_terms(array(
		'taxonomy' => 'categoria_link',
		'hide_empty' => true,
		'orderby' => 'term_order',
		'order' => 'ASC',
	));

	$content = '<div class="links-grouped-container">';

	if (!is_wp_error($terms) && !empty($terms)) {
		foreach ($terms as $term) {
			// ACF recupera dados de taxonomia usando o padrão 'taxonomy_termId'
			$icone = get_field('icone', 'categoria_link_' . $term->term_id);

			if (!$icone)
				$icone = '<i class="fa-solid fa-link"></i>'; // Ícone padrão caso esteja vazio

			$content .= '<div class="links-group">';

			// Header da categoria com Ícone e Título
			$content .= '<div class="links-group-header">';
			$content .= '<div class="links-group-icon">' . $icone . '</div>';
			$content .= '<h3 class="links-group-title">' . esc_html($term->name) . '</h3>';
			$content .= '</div>';

			// Query dos links específicos desta categoria
			$args = [
				'post_type' => 'link_util',
				'posts_per_page' => -1,
				'tax_query' => array(
					array(
						'taxonomy' => 'categoria_link',
						'field' => 'term_id',
						'terms' => $term->term_id,
					)
				)
			];
			$loop = new WP_Query($args);

			if ($loop->have_posts()) {
				$content .= '<div class="links-grid">';
				while ($loop->have_posts()) {
					$loop->the_post();
					$link = get_field('link');
					$title = get_the_title();
					$resumo = get_the_excerpt();

					$content .= '<a href="' . esc_url($link) . '" target="_blank" class="link-card">';
					$content .= '<h4 class="link-card-title">' . esc_html($title) . '<i class="fa-solid fa-arrow-up-right-from-square link-card-icon"></i></h4>';
					if ($resumo) {
						$content .= '<div class="link-card-desc">' . wp_kses_post($resumo) . '</div>';
					}
					$content .= '</a>';
				}
				$content .= '</div>';
			}
			wp_reset_postdata();

			$content .= '</div>'; // .links-group
		}
	} else {
		$content .= '<p>Nenhum link encontrado.</p>';
	}

	$content .= '</div>'; // .links-grouped-container

	return $content;
}
add_shortcode('links', 'links_func');

// [dados]
function dados_func($atts)
{

	$a = shortcode_atts(array(
		'destaque' => false,
		'posts_per_page' => get_option('posts_per_page')
	), $atts);

	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

	$args = [
		'post_type' => 'dataset',
		'posts_per_page' => $a['posts_per_page'],
		'paged' => $paged,
		'tax_query' => array('relation' => 'AND'),
	];

	// Search
	if (!empty($_GET['busca'])) {
		$args['s'] = sanitize_text_field($_GET['busca']);
	}

	// Filter Category
	if (!empty($_GET['categoria'])) {
		$args['tax_query'][] = array(
			'taxonomy' => 'categoria_dataset',
			'field' => 'slug',
			'terms' => sanitize_text_field($_GET['categoria'])
		);
	}

	// Filter Format
	if (!empty($_GET['formato'])) {
		$args['tax_query'][] = array(
			'taxonomy' => 'formato',
			'field' => 'slug',
			'terms' => sanitize_text_field($_GET['formato'])
		);
	}

	// Filter Tag
	if (!empty($_GET['tag'])) {
		$args['tax_query'][] = array(
			'taxonomy' => 'post_tag',
			'field' => 'slug',
			'terms' => sanitize_text_field($_GET['tag'])
		);
	}

	// Remove empty tax_query
	if (count($args['tax_query']) === 1) {
		unset($args['tax_query']);
	}

	$loop = new WP_Query($args);

	$content = '<div class="dataset-list-container">';

	$content .= '<p class="dataset-count"><strong>' . $loop->found_posts . '</strong> conjuntos de dados encontrados</p>';

	if ($loop->have_posts()) {
		$content .= '<div class="dataset-list">';
		while ($loop->have_posts()) {
			$loop->the_post();

			// Calcular tamanho e formatos
			$files = get_field('arquivos') ? get_field('arquivos') : array();
			$tamanho_total_bytes = 0;
			$formatos = array();
			if ($files) {
				foreach ($files as $row) {
					if (isset($row['arquivo']['filesize'])) {
						$tamanho_total_bytes += $row['arquivo']['filesize'];
					}
					if (isset($row['formato']) && is_a($row['formato'], 'WP_Term')) {
						$link_filtro = home_url('/conjuntos-de-dados/?formato=' . $row['formato']->slug);
						$formatos[$row['formato']->slug] = '<a href="' . esc_url($link_filtro) . '">' . strtoupper($row['formato']->name) . '</a>';
					}
				}
			}
			$tamanho_formatado = size_format($tamanho_total_bytes, 2);
			$formatos_str = !empty($formatos) ? implode(', ', $formatos) : '-';
			$downloads = get_field('downloads') ? get_field('downloads') : 0;
			$origem = get_field('origem');

			// Categorias
			$cats = get_the_terms(get_the_ID(), 'categoria_dataset');
			$cats_html = '';
			if ($cats && !is_wp_error($cats)) {
				foreach ($cats as $c) {
					$link_filtro = home_url('/conjuntos-de-dados/?categoria=' . $c->slug);
					$cats_html .= '<a href="' . esc_url($link_filtro) . '" class="badge badge-light">' . esc_html($c->name) . '</a> ';
				}
			}

			// Tags
			$tags = get_the_terms(get_the_ID(), 'post_tag');
			$tags_html = '';
			if ($tags && !is_wp_error($tags)) {
				foreach ($tags as $t) {
					$link_filtro = home_url('/conjuntos-de-dados/?tag=' . $t->slug);
					$tags_html .= '<a href="' . esc_url($link_filtro) . '" class="badge badge-light"><i class="fa-solid fa-tag"></i> ' . esc_html($t->name) . '</a> ';
				}
			}

			$content .= '<div class="dataset-list-item">';
			$content .= '  <div class="dataset-item-main">';
			if ($cats_html) {
				$content .= '    <div class="dataset-item-cats">' . $cats_html . '</div>';
			}
			$content .= '    <h3 class="dataset-item-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h3>';
			$content .= '    <p class="dataset-item-desc">' . get_the_excerpt() . '</p>';

			$content .= '    <ul class="dataset-item-meta">';
			$content .= '      <li><i class="fa-regular fa-calendar"></i> ' . get_the_date('d/m/Y') . '</li>';
			$content .= '      <li>Formato: ' . $formatos_str . '</li>';
			$content .= '      <li><i class="fa-regular fa-file-zipper"></i> Tamanho: ' . $tamanho_formatado . '</li>';
			$content .= '      <li><i class="fa-solid fa-download"></i> ' . $downloads . ' downloads</li>';
			$content .= '    </ul>';

			if ($tags_html) {
				$content .= '    <div class="dataset-item-tags">' . $tags_html . '</div>';
			}

			if ($origem) {
				$content .= '    <p class="dataset-item-origin">Origem: ' . esc_html($origem) . '</p>';
			} else {
				$instituicoes = get_field('instituicao');
				if ($instituicoes) {
					$nomes_inst = array();
					foreach ($instituicoes as $inst) {
						$nomes_inst[] = is_a($inst, 'WP_Term') ? $inst->name : $inst->post_title;
					}
					$content .= '    <p class="dataset-item-origin">Origem: ' . esc_html(implode(', ', $nomes_inst)) . '</p>';
				}
			}

			$content .= '  </div>'; // .dataset-item-main

			$content .= '  <div class="dataset-item-actions">';
			$content .= '    <a href="' . get_permalink() . '#dataset-visualization" class="btn btn-primary"><i class="fa-solid fa-download"></i> Download</a>';
			$content .= '    <a href="' . get_permalink() . '" class="btn btn-outline">Ver detalhes</a>';
			$content .= '  </div>';

			$content .= '</div>'; // .dataset-list-item
		}
		$content .= '</div>'; // .dataset-list

		// Pagination
		$big = 999999999;
		$pagination = paginate_links(array(
			'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
			'format' => '?paged=%#%',
			'current' => max(1, get_query_var('paged')),
			'total' => $loop->max_num_pages,
			'prev_text' => '&laquo; Anterior',
			'next_text' => 'Próxima &raquo;',
		));
		if ($pagination) {
			$content .= '<div class="dataset-pagination">' . $pagination . '</div>';
		}

	} else {
		$content .= '<p>Nenhum conjunto de dados encontrado para os filtros selecionados.</p>';
	}
	$content .= '</div>'; // .dataset-list-container

	wp_reset_query();

	return $content;
}
add_shortcode('dados', 'dados_func');


// [publicacoes]
function publicacoes_func($atts)
{

	$a = shortcode_atts(array(
		'destaque' => false,
		'posts_per_page' => get_option('posts_per_page')
	), $atts);

	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

	$args = [
		'post_type' => 'publicacao',
		'posts_per_page' => $a['posts_per_page'],
		'paged' => $paged,
		'tax_query' => array('relation' => 'AND'),
		'meta_query' => array('relation' => 'AND'),
	];

	// Search Textual Inteligente (Título + Conteúdo + Autores + Tags)
	if (!empty($_GET['busca'])) {
		$busca = sanitize_text_field($_GET['busca']);

		// 1. Busca Padrão (Título e Conteúdo)
		$search_posts = get_posts(array(
			'post_type' => 'publicacao',
			'posts_per_page' => -1,
			's' => $busca,
			'fields' => 'ids'
		));

		// 2. Busca por Autores
		$autores_matches = get_posts(array(
			'post_type' => 'autor',
			'posts_per_page' => -1,
			's' => $busca,
			'fields' => 'ids'
		));

		$autores_publicacoes = array();
		if (!empty($autores_matches)) {
			$meta_query_autores = array('relation' => 'OR');
			foreach ($autores_matches as $a_id) {
				$meta_query_autores[] = array('key' => 'autoria', 'value' => $a_id, 'compare' => '=');
				$meta_query_autores[] = array('key' => 'autoria', 'value' => '"' . $a_id . '"', 'compare' => 'LIKE');
				$meta_query_autores[] = array('key' => 'autor', 'value' => $a_id, 'compare' => '=');
				$meta_query_autores[] = array('key' => 'autor', 'value' => '"' . $a_id . '"', 'compare' => 'LIKE');
			}
			$autores_publicacoes = get_posts(array(
				'post_type' => 'publicacao',
				'posts_per_page' => -1,
				'meta_query' => $meta_query_autores,
				'fields' => 'ids'
			));
		}

		// 3. Busca por Tags
		$tags_matches = get_terms(array(
			'taxonomy' => 'post_tag',
			'search' => $busca,
			'fields' => 'ids',
			'hide_empty' => false
		));

		$tags_publicacoes = array();
		if (!empty($tags_matches) && !is_wp_error($tags_matches)) {
			$tags_publicacoes = get_posts(array(
				'post_type' => 'publicacao',
				'posts_per_page' => -1,
				'tax_query' => array(
					array(
						'taxonomy' => 'post_tag',
						'field' => 'term_id',
						'terms' => $tags_matches
					)
				),
				'fields' => 'ids'
			));
		}

		// Junta todos os IDs encontrados
		$matched_ids = array_unique(array_merge($search_posts, $autores_publicacoes, $tags_publicacoes));

		if (!empty($matched_ids)) {
			$args['post__in'] = $matched_ids;
			$args['orderby'] = 'post__in'; // Mantém alguma relevância
		} else {
			$args['post__in'] = array(0); // Força nenhum resultado
		}
	}
	// Filter Autoria (Post Type 'autor') - Usando SLUG
	if (!empty($_GET['autor'])) {
		$autor_slug = sanitize_text_field($_GET['autor']);
		$autor_post = get_page_by_path($autor_slug, OBJECT, 'autor');

		if ($autor_post) {
			$autor_id = $autor_post->ID;
			$args['meta_query'][] = array(
				'relation' => 'OR',
				array(
					'key' => 'autoria', // Assumindo 'autoria' como nome do campo
					'value' => $autor_id,
					'compare' => '='
				),
				array(
					'key' => 'autoria',
					'value' => '"' . $autor_id . '"',
					'compare' => 'LIKE'
				),
				array(
					'key' => 'autor', // Assumindo 'autor' como nome alternativo do campo
					'value' => $autor_id,
					'compare' => '='
				),
				array(
					'key' => 'autor',
					'value' => '"' . $autor_id . '"',
					'compare' => 'LIKE'
				)
			);
		}
	}

	// Filter Categoria (Post Type 'categoria') - Usando SLUG
	if (!empty($_GET['categoria'])) {
		$cat_slug = sanitize_text_field($_GET['categoria']);
		$cat_post = get_page_by_path($cat_slug, OBJECT, 'categoria');

		if ($cat_post) {
			$cat_id = $cat_post->ID;
			$args['meta_query'][] = array(
				'relation' => 'OR',
				array(
					'key' => 'categoria',
					'value' => $cat_id,
					'compare' => '='
				),
				array(
					'key' => 'categoria',
					'value' => '"' . $cat_id . '"',
					'compare' => 'LIKE'
				)
			);
		}
	}

	// Filter Tag
	if (!empty($_GET['tag'])) {
		$args['tax_query'][] = array(
			'taxonomy' => 'post_tag',
			'field' => 'slug',
			'terms' => sanitize_text_field($_GET['tag'])
		);
	}

	// Clean up empty queries
	if (isset($args['tax_query']) && count($args['tax_query']) === 1)
		unset($args['tax_query']);
	if (isset($args['meta_query']) && count($args['meta_query']) === 1)
		unset($args['meta_query']);

	$loop = new WP_Query($args);

	$content = '<div class="dataset-list-container">';

	// Mensagem informativa de filtros ativos (Autoria e Tag)
	$mensagens_filtro = [];
	if (!empty($_GET['autor']) && isset($autor_post) && $autor_post) {
		$mensagens_filtro[] = 'autoria: <strong>' . esc_html($autor_post->post_title) . '</strong>';
	}
	if (!empty($_GET['tag'])) {
		$tag_term = get_term_by('slug', sanitize_text_field($_GET['tag']), 'post_tag');
		if ($tag_term) {
			$mensagens_filtro[] = 'palavra-chave: <strong>' . esc_html($tag_term->name) . '</strong>';
		}
	}
	if (!empty($mensagens_filtro)) {
		$content .= '<div class="filter-info mb-4">Exibindo publicações filtradas por ' . implode(' e ', $mensagens_filtro) . ' <a href="/publicacoes" class="btn btn-outline-gray btn-xs"><i class="fa-solid fa-xmark"></i> Remover</a></div>';
	}

	$content .= '<p class="dataset-count"><strong>' . $loop->found_posts . '</strong> publicações encontradas</p>';

	if ($loop->have_posts()) {
		$content .= '<div class="dataset-list">';
		while ($loop->have_posts()) {
			$loop->the_post();

			// Categorias (Post Object)
			$categorias_field = get_field('categoria');
			$cats_html = '';
			if ($categorias_field) {
				if (!is_array($categorias_field)) {
					$categorias_field = array($categorias_field);
				}
				foreach ($categorias_field as $c_id) {
					$c_post = is_object($c_id) ? $c_id : get_post($c_id);
					if ($c_post) {
						$link_filtro = home_url('/publicacoes/?categoria=' . $c_post->post_name);
						$cats_html .= '<a href="' . esc_url($link_filtro) . '" class="badge badge-light">' . esc_html(get_the_title($c_post->ID)) . '</a> ';
					}
				}
			}

			// Autoria (Post Object)
			$autoria_field = get_field('autoria') ? get_field('autoria') : get_field('autor');
			$autores_str = '-';
			if ($autoria_field) {
				if (!is_array($autoria_field)) {
					$autoria_field = array($autoria_field);
				}
				$nomes_autores = array();
				foreach ($autoria_field as $a_id) {
					$a_post = is_object($a_id) ? $a_id : get_post($a_id);
					if ($a_post) {
						$link_filtro = home_url('/publicacoes/?autor=' . $a_post->post_name);
						$nomes_autores[] = '<a href="' . esc_url($link_filtro) . '">' . esc_html(get_the_title($a_post->ID)) . '</a>';
					}
				}
				if (!empty($nomes_autores)) {
					$autores_str = implode(', ', $nomes_autores);
				}
			}

			// Tags
			$tags = get_the_terms(get_the_ID(), 'post_tag');
			$tags_html = '';
			if ($tags && !is_wp_error($tags)) {
				foreach ($tags as $t) {
					$link_filtro = home_url('/publicacoes/?tag=' . $t->slug);
					$tags_html .= '<a href="' . esc_url($link_filtro) . '" class="badge badge-light"><i class="fa-solid fa-tag"></i> ' . esc_html($t->name) . '</a> ';
				}
			}

			$content .= '<div class="dataset-list-item">';
			$content .= '  <div class="dataset-item-main">';

			if ($cats_html) {
				$content .= '    <div class="dataset-item-cats">' . $cats_html . '</div>';
			}

			$content .= '    <h3 class="dataset-item-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h3>';

			if (get_field('objetivo')) {
				$content .= '    <p class="dataset-item-desc">' . get_field('objetivo') . '</p>';
			}

			$content .= '    <ul class="dataset-item-meta">';
			$content .= '      <li><i class="fa-regular fa-calendar"></i> ' . get_the_date('d/m/Y') . '</li>';
			$content .= '      <li><i class="fa-solid fa-user"></i> Autoria: ' . $autores_str . '</li>';
			$content .= '    </ul>';

			if ($tags_html) {
				$content .= '    <div class="dataset-item-tags mb-0">' . $tags_html . '</div>';
			}

			$content .= '  </div>'; // .dataset-item-main

			$content .= '  <div class="dataset-item-actions">';

			$arquivo = get_field('arquivo');
			if ($arquivo) {
				$url_arquivo = is_array($arquivo) ? $arquivo['url'] : $arquivo;
				$content .= '    <a href="' . esc_url($url_arquivo) . '" class="btn btn-primary" target="_blank"><i class="fa-solid fa-arrow-up-right-from-square"></i> Download</a>';
			}

			$link_original = get_field('link');
			if ($link_original) {
				$content .= '    <a href="' . esc_url($link_original) . '" class="btn btn-primary" target="_blank"><i class="fa-solid fa-arrow-up-right-from-square"></i> Publicação original</a>';
			}

			$content .= '    <a href="' . get_permalink() . '" class="btn btn-outline"><i class="fa-solid fa-eye"></i> Detalhes</a>';

			$citacao = get_field('citacao');
			if ($citacao) {
				$modal_id = 'modal-citacao-' . get_the_ID();
				$content .= '    <button type="button" class="btn btn-outline" onclick="document.getElementById(\'' . $modal_id . '\').showModal()"><i class="fa-solid fa-quote-left"></i> Como citar</button>';

				$content .= '    <dialog id="' . $modal_id . '" class="modal-citacao">';
				$content .= '      <h3 class="mb-2">Como citar:</h3>';
				$content .= '      <div>' . wp_kses_post($citacao) . '</div>';
				$content .= '      <div><button type="button" class="btn btn-outline" onclick="document.getElementById(\'' . $modal_id . '\').close()">Fechar</button></div>';
				$content .= '    </dialog>';

				$content .= '    <script>
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

			$content .= '  </div>'; // .dataset-item-actions

			$content .= '</div>'; // .dataset-list-item
		}
		$content .= '</div>'; // .dataset-list

		// Pagination
		$big = 999999999;
		$pagination = paginate_links(array(
			'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
			'format' => '?paged=%#%',
			'current' => max(1, get_query_var('paged')),
			'total' => $loop->max_num_pages,
			'prev_text' => '&laquo; Anterior',
			'next_text' => 'Próxima &raquo;',
		));
		if ($pagination) {
			$content .= '<div class="dataset-pagination">' . $pagination . '</div>';
		}

	} else {
		$content .= '<p>Nenhuma publicação encontrada para os filtros selecionados.</p>';
	}
	$content .= '</div>'; // .dataset-list-container

	wp_reset_query();

	return $content;
}
add_shortcode('publicacoes', 'publicacoes_func');


function hex_to_rgb($hex, $return_string = true)
{

	// Remove o #
	$hex = str_replace('#', '', $hex);

	// HEX com 3 caracteres (#fff)
	if (strlen($hex) == 3) {

		$r = hexdec(str_repeat(substr($hex, 0, 1), 2));
		$g = hexdec(str_repeat(substr($hex, 1, 1), 2));
		$b = hexdec(str_repeat(substr($hex, 2, 1), 2));

	}
	// HEX com 6 caracteres (#ffffff)
	else {

		$r = hexdec(substr($hex, 0, 2));
		$g = hexdec(substr($hex, 2, 2));
		$b = hexdec(substr($hex, 4, 2));

	}

	if ($return_string) {
		return "rgb($r, $g, $b)";
	}

	return [
		'r' => $r,
		'g' => $g,
		'b' => $b
	];
}
function hex_to_rgba($hex, $alpha = 1)
{
	$rgb = hex_to_rgb($hex, false);
	return "rgba({$rgb['r']}, {$rgb['g']}, {$rgb['b']}, {$alpha})";
}

/**
 * Gerenciador de Downloads dos Datasets
 * Intercepta requisições de download, incrementa contadores e gera ZIP dinâmico
 */
function observadados_handle_downloads()
{
	if (isset($_GET['download_dataset'])) {
		$post_id = intval($_GET['download_dataset']);
		$file_index = isset($_GET['file_index']) ? $_GET['file_index'] : 'all';

		// Verifica se o post existe e é um dataset
		if (get_post_type($post_id) !== 'dataset') {
			wp_die('Conjunto de dados não encontrado.');
		}

		$files = get_field('arquivos', $post_id);
		if (!$files) {
			wp_die('Nenhum arquivo disponível para download neste conjunto de dados.');
		}

		if ($file_index === 'all') {
			// Incrementar o contador geral do dataset
			// Usamos update_post_meta pois é mais direto e rápido que a API do ACF (update_field)
			$downloads = (int) get_post_meta($post_id, 'downloads', true);
			update_post_meta($post_id, 'downloads', $downloads + 1);

			// Geração de ZIP em memória/disco
			$zip = new ZipArchive();

			// Diretório temporário seguro dentro do wp-content/uploads
			$upload_dir = wp_upload_dir();
			$zip_name = 'dataset-' . $post_id . '-' . time() . '.zip';
			$zip_path = $upload_dir['path'] . '/' . $zip_name;

			if ($zip->open($zip_path, ZipArchive::CREATE) === TRUE) {
				$has_files = false;
				foreach ($files as $row) {
					if (isset($row['arquivo']['ID'])) {
						$file_path = get_attached_file($row['arquivo']['ID']);
						if ($file_path && file_exists($file_path)) {
							// Pega o título/nome amigável do arquivo para o ZIP
							$filename = isset($row['arquivo']['filename']) ? $row['arquivo']['filename'] : basename($file_path);
							$zip->addFile($file_path, $filename);
							$has_files = true;
						}
					}
				}
				$zip->close();

				if ($has_files && file_exists($zip_path)) {
					// Forçar download do arquivo ZIP
					$post_slug = get_post_field('post_name', $post_id);
					header('Content-Type: application/zip');
					header('Content-Disposition: attachment; filename="' . $post_slug . '.zip"');
					header('Content-Length: ' . filesize($zip_path));
					header('Cache-Control: no-cache, no-store, must-revalidate');
					header('Pragma: no-cache');
					header('Expires: 0');

					// Limpar buffer antes de enviar
					if (ob_get_level())
						ob_end_clean();

					readfile($zip_path);

					// Remove o arquivo gerado para não lotar o servidor
					unlink($zip_path);
					exit;
				} else {
					wp_die('Não foi possível adicionar os arquivos ao arquivo ZIP.');
				}
			} else {
				wp_die('Erro de permissão ao criar o arquivo ZIP no servidor.');
			}

		} else {
			// Download Individual
			$index = intval($file_index);
			if (isset($files[$index])) {

				// Incrementar contador individual (ex: salva como 'downloads_arquivo_0')
				$meta_key = 'downloads_arquivo_' . $index;
				$file_dl = (int) get_post_meta($post_id, $meta_key, true);
				update_post_meta($post_id, $meta_key, $file_dl + 1);

				$file_url = $files[$index]['arquivo']['url'];
				if ($file_url) {
					wp_redirect($file_url);
					exit;
				}
			}
			wp_die('Arquivo não encontrado.');
		}
	}
}
add_action('template_redirect', 'observadados_handle_downloads');

// [blog]
function blog_func($atts)
{

	$a = shortcode_atts(array(
		'posts_per_page' => get_option('posts_per_page'),
		'home' => 'false'
	), $atts);

	$is_home = ($a['home'] === 'true');

	if ($is_home) {
		$a['posts_per_page'] = 3;
	}

	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

	$args = [
		'post_type' => 'post',
		'posts_per_page' => $a['posts_per_page'],
		'paged' => $paged,
		'tax_query' => array('relation' => 'AND'),
	];

	// Filter Category
	if (!empty($_GET['categoria'])) {
		$args['tax_query'][] = array(
			'taxonomy' => 'category',
			'field' => 'slug',
			'terms' => sanitize_text_field($_GET['categoria'])
		);
	}

	// Filter Tag
	if (!empty($_GET['tag'])) {
		$args['tax_query'][] = array(
			'taxonomy' => 'post_tag',
			'field' => 'slug',
			'terms' => sanitize_text_field($_GET['tag'])
		);
	}

	// Remove empty tax_query
	if (count($args['tax_query']) === 1) {
		unset($args['tax_query']);
	}

	$loop = new WP_Query($args);

	$content = '<div class="blog-list-container">';

	if (!$is_home) {
		// Exibe uma mensagem se houver filtro de tag ativo
		if (!empty($_GET['tag'])) {
			$content .= '<div class="filter-info mb-4">Exibindo posts com a tag: <strong>' . $_GET['tag'] . '</strong> <a href="/blog" class="btn btn-outline-gray btn-xs"><i class="fa-solid fa-xmark"></i> Remover</a></div>';
		}

		// Categories Filter
		$base_url = get_permalink();
		$current_args = $_GET;
		unset($current_args['paged']);

		$cat_atual = isset($_GET['categoria']) ? $_GET['categoria'] : '';

		$content .= '<div class="filter-options mb-4">';

		// "Todas"
		$args_sem_cat = $current_args;
		unset($args_sem_cat['categoria']);
		$url_sem_cat = empty($args_sem_cat) ? $base_url : add_query_arg($args_sem_cat, $base_url);
		$class_active = empty($cat_atual) ? 'active' : '';
		$content .= '<a href="' . esc_url($url_sem_cat) . '" class="filter-badge ' . $class_active . '">Todas as categorias</a>';

		$categorias = get_terms(array('taxonomy' => 'category', 'hide_empty' => true));
		if (!is_wp_error($categorias) && !empty($categorias)) {
			foreach ($categorias as $cat) {
				$class_active = ($cat_atual === $cat->slug) ? 'active' : '';
				$args_cat = $current_args;
				$args_cat['categoria'] = $cat->slug;
				$url_cat = add_query_arg($args_cat, $base_url);
				$content .= '<a href="' . esc_url($url_cat) . '" class="filter-badge ' . $class_active . '">' . esc_html($cat->name) . '</a>';
			}
		}
		$content .= '</div>';
	}

	// Grid
	$content .= '<ul class="grid-container">';
	if ($loop->have_posts()) {
		while ($loop->have_posts()) {
			$loop->the_post();

			$title = get_the_title();
			$link = get_permalink();
			$resumo = get_the_excerpt();
			$foto = get_the_post_thumbnail(get_the_ID(), 'medium_large', ['class' => 'img-fluid']);
			if (!$foto) {
				$foto = '<div class="image-placeholder"></div>';
			}

			// Categories badge
			$cats = get_the_category();
			$cat_name = '';
			if (!empty($cats)) {
				$cat_name = $cats[0]->name;
			}

			$author_name = get_the_author();
			$date = get_the_date('d/m/Y');

			$content .= '<li class="grid-item blog-post">';
			$content .= '<div class="grid-item-photo"><a href="' . esc_url($link) . '">' . $foto . '</a></div>';
			$content .= '<div class="grid-item-info">';

			if ($cat_name) {
				$content .= '<div><span class="badge badge-light">' . esc_html($cat_name) . '</span></div>';
			}

			$content .= '<h3 class="grid-item-title"><a href="' . esc_url($link) . '">' . esc_html($title) . '</a></h3>';

			if ($resumo) {
				$content .= '<div class="grid-item-desc">' . $resumo . '</div>';
			} else {
				$content .= '<div class="grid-item-desc"></div>';
			}

			$content .= '<ul class="post-meta">';
			$content .= '<li><i class="fa-regular fa-user"></i> ' . esc_html($author_name) . '</li>';
			$content .= '<li><i class="fa-regular fa-calendar"></i> ' . esc_html($date) . '</li>';
			$content .= '</ul>';
			$content .= '<a href="' . esc_url($link) . '" class="grid-item-link">Ler mais &rarr;</a>';

			$content .= '</div>'; // .grid-item-info
			$content .= '</li>'; // .grid-item
		}
	} else {
		$content .= '<p>Nenhum post encontrado.</p>';
	}
	$content .= '</ul>';

	// Pagination
	if (!$is_home) {
		$big = 999999999;
		$pagination = paginate_links(array(
			'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
			'format' => '?paged=%#%',
			'current' => max(1, get_query_var('paged')),
			'total' => $loop->max_num_pages,
			'prev_text' => '&laquo; Anterior',
			'next_text' => 'Próxima &raquo;',
		));
		if ($pagination) {
			$content .= '<div class="dataset-pagination">' . $pagination . '</div>';
		}
	}

	$content .= '</div>'; // .blog-list-container

	wp_reset_query();

	return $content;
}
add_shortcode('blog', 'blog_func');

/**
 * Redireciona páginas de categoria padrão do WordPress para a página de Blog com filtro.
 */
function observadados_redirect_category_to_blog()
{
	if (is_category()) {
		$category = get_queried_object();
		if ($category && isset($category->slug)) {
			$redirect_url = home_url('/blog/?categoria=' . $category->slug);

			$paged = get_query_var('paged');
			if ($paged > 1) {
				$redirect_url = add_query_arg('paged', $paged, $redirect_url);
			}

			wp_redirect($redirect_url, 301);
			exit;
		}
	}
}
add_action('template_redirect', 'observadados_redirect_category_to_blog');

function observadados_redirect_cpts_to_publicacoes()
{
	if (is_singular('categoria')) {
		$post = get_queried_object();
		if (!$post)
			$post = get_post();

		if ($post && isset($post->post_name)) {
			wp_redirect(home_url('/publicacoes/?categoria=' . $post->post_name), 301);
			exit;
		}
	}

	if (is_singular('autor')) {
		$post = get_queried_object();
		if (!$post)
			$post = get_post();

		if ($post && isset($post->post_name)) {
			wp_redirect(home_url('/publicacoes/?autor=' . $post->post_name), 301);
			exit;
		}
	}
}
add_action('template_redirect', 'observadados_redirect_cpts_to_publicacoes', 1);

// [indicadores]
function indicadores_shortcode()
{
	$count_dataset = wp_count_posts('dataset');
	$num_dataset = $count_dataset ? $count_dataset->publish : 0;

	$count_publicacao = wp_count_posts('publicacao');
	$num_publicacao = $count_publicacao ? $count_publicacao->publish : 0;

	// Calcula o total de downloads dos datasets
	global $wpdb;
	$total_downloads = (int) $wpdb->get_var("
		SELECT SUM(meta_value) 
		FROM {$wpdb->postmeta} 
		JOIN {$wpdb->posts} ON post_id = ID 
		WHERE post_type = 'dataset' AND post_status = 'publish' AND meta_key = 'downloads'
	");

	if ($total_downloads >= 1000) {
		$num_downloads = round($total_downloads / 1000, 1) . 'k';
	} else {
		$num_downloads = $total_downloads;
	}

	// Valores estáticos conforme o design
	$num_usuarios = '2.4k';
	ob_start();
	?>
	<div class="indicadores-grid">
		<div class="indicador-card">
			<i class="fa-solid fa-database indicador-icon"></i>
			<div class="indicador-number"><?php echo esc_html($num_dataset); ?></div>
			<div class="indicador-label">Conjuntos de dados</div>
		</div>
		<div class="indicador-card">
			<i class="fa-solid fa-book-open indicador-icon"></i>
			<div class="indicador-number"><?php echo esc_html($num_publicacao); ?></div>
			<div class="indicador-label">Publicações</div>
		</div>
		<!--
		<div class="indicador-card">
			<i class="fa-solid fa-users indicador-icon"></i>
			<div class="indicador-number"><?php echo esc_html($num_usuarios); ?></div>
			<div class="indicador-label">Usuários</div>
		</div>
		-->
		<div class="indicador-card">
			<i class="fa-solid fa-chart-line indicador-icon"></i>
			<div class="indicador-number"><?php echo esc_html($num_downloads); ?></div>
			<div class="indicador-label">Downloads</div>
		</div>
	</div>
	<?php
	return ob_get_clean();
}
add_shortcode('indicadores', 'indicadores_shortcode');

// [dados_destaque]
function dados_destaque_shortcode()
{
	$args = [
		'post_type' => 'dataset',
		'posts_per_page' => 3,
		'orderby' => 'rand',
		'meta_query' => [
			[
				'key' => 'destaque',
				'value' => true
			]
		]
	];
	$loop = new WP_Query($args);
	$content = '<div class="blog-list-container"><ul class="grid-container">';
	if ($loop->have_posts()) {
		while ($loop->have_posts()) {
			$loop->the_post();

			$title = get_the_title();
			$link = get_permalink();
			$resumo = get_the_excerpt();

			if (!$resumo) {
				$resumo = wp_trim_words(get_the_content(), 15);
			}

			$foto = get_the_post_thumbnail(get_the_ID(), 'medium_large', ['class' => 'img-fluid']);
			if (!$foto) {
				$foto = '<div class="image-placeholder" style="background-color: #0b3469; background-image: radial-gradient(circle, #e63946 20%, transparent 20%), radial-gradient(circle, #f4a261 20%, transparent 20%); background-size: 50px 50px; background-position: 0 0, 25px 25px; padding-bottom: 50%;"></div>';
			}

			// Tenta pegar tags, categorias ou taxonomia específica
			$terms = wp_get_post_terms(get_the_ID(), array('category', 'post_tag', 'categoria', 'tema'));
			$badges = '';
			if (!is_wp_error($terms) && !empty($terms)) {
				$count = 0;
				foreach ($terms as $term) {
					$badges .= '<span class="badge badge-light" style="margin-right:0.25rem;">' . esc_html($term->name) . '</span>';
					$count++;
					if ($count >= 2)
						break; // Exibe no máximo 2 badges
				}
			}

			$downloads = (int) get_field('downloads');

			$content .= '<li class="grid-item blog-post" style="display:flex; flex-direction:column;">';
			$content .= '<div class="grid-item-photo"><a href="' . esc_url($link) . '">' . $foto . '</a></div>';
			$content .= '<div class="grid-item-info" style="flex:1; display:flex; flex-direction:column;">';

			if ($badges) {
				$content .= '<div class="mb-2">' . $badges . '</div>';
			}

			$content .= '<h3 class="grid-item-title"><a href="' . esc_url($link) . '">' . esc_html($title) . '</a></h3>';
			$content .= '<div class="grid-item-desc mb-3">' . $resumo . '</div>';

			$content .= '<div style="display:flex; justify-content:space-between; align-items:center; margin-top:auto; padding-top:1rem; border-top:1px solid #f1f5f9;">';
			$content .= '<span style="font-size:0.875rem; color:#888;">' . $downloads . ' downloads</span>';
			$content .= '<a href="' . esc_url($link) . '" style="font-size:0.875rem; color:#0b3469; font-weight:600; text-decoration:none;">Ver detalhes &rarr;</a>';
			$content .= '</div>';

			$content .= '</div>'; // .grid-item-info
			$content .= '</li>';
		}
	} else {
		$content .= '<p>Nenhum conjunto de dados em destaque encontrado.</p>';
	}
	$content .= '</ul></div>';
	wp_reset_postdata();

	return $content;
}
add_shortcode('dados_destaque', 'dados_destaque_shortcode');
