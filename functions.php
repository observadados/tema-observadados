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
						$formatos[$row['formato']->slug] = '<a href="' . esc_url($link_filtro) . '" style="text-decoration:none; color:inherit;">' . strtoupper($row['formato']->name) . '</a>';
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
					$cats_html .= '<a href="' . esc_url($link_filtro) . '" class="badge badge-light" style="text-decoration:none;">' . esc_html($c->name) . '</a> ';
				}
			}

			// Tags
			$tags = get_the_terms(get_the_ID(), 'post_tag');
			$tags_html = '';
			if ($tags && !is_wp_error($tags)) {
				foreach ($tags as $t) {
					$link_filtro = home_url('/conjuntos-de-dados/?tag=' . $t->slug);
					$tags_html .= '<a href="' . esc_url($link_filtro) . '" class="badge badge-light" style="text-decoration:none;"><i class="fa-solid fa-tag"></i> ' . esc_html($t->name) . '</a> ';
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
