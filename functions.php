<?php

/**
 * add child styles.
 *
 * @author CMSSuperHeroes
 * @since 1.1.1
 */
function wp_recruitment_enqueue_styles()
{
    $parent_style = 'wp-recruitment-style';
    wp_enqueue_style($parent_style, get_template_directory_uri() . '/style.css');
    wp_enqueue_style('child-style', get_stylesheet_directory_uri() . '/style.css', array(
        $parent_style
    ));
}

add_action('wp_enqueue_scripts', 'wp_recruitment_enqueue_styles', 99);

/**
 * Load vc template dir.
 *
 * @author CMSSuperHeroes
 * @since 1.1.1
 */
if (function_exists('vc_set_shortcodes_templates_dir') && is_dir(get_stylesheet_directory() . '/vc_templates/')) {
    vc_set_shortcodes_templates_dir(get_stylesheet_directory() . '/vc_templates/');
}

add_action('after_switch_theme', 'wp_recruitment_child_redirect_to_welcome_page');
function wp_recruitment_child_redirect_to_welcome_page()
{
	if (is_child_theme()) {
		$parent_theme = wp_get_theme()->parent();
		if (class_exists('CMS_PORTAL')) {
			wp_safe_redirect(admin_url("themes.php?page={$parent_theme->get('TextDomain')}"));
		} else {
			wp_safe_redirect(admin_url("themes.php?page={$parent_theme->get('TextDomain')}-welcome"));
		}
	}
}