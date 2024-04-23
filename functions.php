<?php
/*  Theme setup
/* ------------------------------------ */
if (!function_exists('my_child_theme_setup')) {

    function my_child_theme_setup()
    {

        add_theme_support( 'custom-header' );

        // Rimuovi gli stili CSS del customizer definiti nel tema padre
        remove_action('wp_head', 'nextawards_customize_css');
    }

    function nextawards_parent_enqueue_styles()
    {
        // load only the parent theme's stylesheet
        wp_enqueue_style(
            'nextawards-parent-style',
            get_parent_theme_file_uri('style.css')
        );

        //  load only the active theme’s stylesheet 
        wp_enqueue_style('nextawards', get_stylesheet_uri());
    }
    add_action('wp_enqueue_scripts', 'nextawards_parent_enqueue_styles');

    /* Customizer CSS Front-end */
    /* ------------------------------------ */
    function nextawards_child_customize_css()
    {
        $nextawards_bg_color = get_background_color();
        echo '<style type="text/css">';
        echo ':root { --site-bg: #' . $nextawards_bg_color . '; --link-color: ' . esc_attr(get_theme_mod('nextawards_link_color', '#048ea0')) . '; --link-color-hover: ' . esc_attr(get_theme_mod('nextawards_link_color_hover', '#105862')) . '; }';
        echo 'body{font-family: ' . esc_attr(get_theme_mod('nextawards_google_font_body', 'Barlow')) . '}';
        echo 'h1,h2,h3,h4,h5,h6{font-family: ' . esc_attr(get_theme_mod('nextawards_google_font', 'Barlow')) . '}';
        echo '.wp-block-button__link{background-color: ' . esc_attr(get_theme_mod('nextawards_link_color', '#048ea0')) . '}';
        echo '.wp-block-button__link:hover{background-color: ' . esc_attr(get_theme_mod('nextawards_link_color_hover', '#105862')) . '}';

        // Verifica se la setting esiste prima di applicare lo stile
        if (get_theme_mod('nextawards_header_color')) {
            echo '.header {background-color: ' . esc_attr(get_theme_mod('nextawards_header_color')) . '}';
        }

        echo '.header__content, .header__menu li {border-color: ' . esc_attr(get_theme_mod('nextawards_border_color', '#222222')) . '}';
        if (esc_attr(get_theme_mod('nextawards_center_logo', 'no')) == "Yes") {
            echo '@media (min-width: 768px) {.header__logo{position: absolute; left: 50%; transform: translate(-50%,50%);}.header__logo img{margin-top:-10px}}';
        }
        if (esc_attr(get_theme_mod('nextawards_menu_left', 'no')) == "Yes") {
            echo '@media (min-width: 998px) { .header__content{position: relative; justify-content: flex-start;} .header__quick{position: absolute; right:70px;top: 27px}}';
        }
        if (class_exists('WooCommerce')) {
            echo '.woocommerce .button{background-color: ' . esc_attr(get_theme_mod('nextawards_link_color', '#048ea0')) . '!important}';
            echo '.woocommerce .button:hover{background-color: ' . esc_attr(get_theme_mod('nextawards_link_color_hover', '#105862')) . '!important}';
        }

        echo '.has-light-gray-background-color {background-color: #f5f5f5 }';
        echo '.has-light-gray-color  {color: #f5f5f5 }';

        echo '.has-medium-gray-background-color {background-color: #999 }';
        echo '.has-medium-gray-color  {color: #999 }';

        echo '.has-dark-gray-background-color {background-color: #333 }';
        echo '.has-dark-gray-color {color: #333 }';

        echo '.has-link-color-background-color {background-color: ' . esc_attr(get_theme_mod('nextawards_link_color', '#048ea0')) . ';}';
        echo '.has-link-color-color {color: ' . esc_attr(get_theme_mod('nextawards_link_color', '#048ea0')) . ';}';

        echo '.has-link-color-hover-background-color {background-color: ' . esc_attr(get_theme_mod('nextawards_link_color_hover', '#048ea0')) . ';}';
        echo '.has-link-color-hover-color {color: ' . esc_attr(get_theme_mod('nextawards_link_color_hover', '#048ea0')) . ';}';

        echo '</style>';
    }
    // add_action('wp_head', 'nextawards_child_customize_css');
}
add_action('after_setup_theme', 'my_child_theme_setup');
