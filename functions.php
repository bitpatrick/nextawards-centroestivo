<?php

function my_child_theme_setup()
{

    // $args = array(
    //     'width'         => 1200, // Imposta la larghezza dell'immagine dell'intestazione.
    //     'height'        => 600,  // Imposta l'altezza dell'immagine dell'intestazione.
    //     'flex-width'    => true, // Permette larghezza flessibile.
    //     'flex-height'   => true, // Permette altezza flessibile.
    //     'header-text'   => false, // Nasconde il testo dell'intestazione se desiderato.
    //     'uploads'       => true, // Permette l'upload di un'immagine personalizzata.
    // );

    // add_theme_support( 'custom-header', $args );

    // Rimuovi gli stili CSS del customizer definiti nel tema padre
    remove_action('wp_head', 'nextawards_customize_css');
}
add_action('after_setup_theme', 'my_child_theme_setup');

function nextawards_parent_enqueue_styles()
{
    // load only the parent theme's stylesheet
    // wp_enqueue_style( 'nextawards-parent-style', get_parent_theme_file_uri('style.css') );

    //  load the active theme’s stylesheet after parent theme's stylesheet
    wp_enqueue_style('nextawards-child', get_stylesheet_uri(), array('nextawards'));

    // js
    wp_enqueue_script('my-custom-script', get_stylesheet_directory_uri() . '/my-custom-script.js', array(), false, true);

    wp_localize_script('my-custom-script', 'siteData', array(
        'pdfUrl' => home_url('wp-content/uploads/2024/04/1.pdf')
    ));
}
add_action('wp_enqueue_scripts', 'nextawards_parent_enqueue_styles');


function nextawards_parent_enqueue_scripts()
{
    wp_enqueue_script('my-custom-script', get_stylesheet_directory_uri() . '/my-custom-script.js', array(), false, true);

    wp_localize_script('my-custom-script', 'siteData', array(
        'pdfUrl' => home_url('wp-content/uploads/2024/04/programma.pdf')
    ));
}
add_action('wp_enqueue_scripts', 'nextawards_parent_enqueue_scripts');

function nextawards_customize_unregister($wp_customize)
{

    // Aggiungi qui altre impostazioni e controlli

    // Rimuovi il controllo del colore dell'intestazione
    $wp_customize->remove_control('nextawards_header_color_control');

    // Rimuovi l'impostazione del colore dell'intestazione
    $wp_customize->remove_setting('nextawards_header_color');

    // Aggiungi qui altre rimozioni se necessario

}
add_action('customize_register', 'nextawards_customize_unregister', 20);

function gb_gutenberg_admin_styles()
{
    echo '
        <style>
            /* Main column width */
            .wp-block {
                max-width: 720px;
            }
 
            /* Width of "wide" blocks */
            .wp-block[data-align="wide"] {
                max-width: 1080px;
            }
 
            /* Width of "full-wide" blocks */
            .wp-block[data-align="full"] {
                max-width: none;
            }	
        </style>
    ';
}
add_action('admin_head', 'gb_gutenberg_admin_styles');
