<?php
/**
 * Plugin Name: Plug Carso
 * Description: Cambia el estilo del contenedor del título en función de la categoría seleccionada en entradas/posts.
 * Version: 1.0
 * Author: Harold
 */

// Registro del bloque personalizado
function plug_carso_register_block() {
    register_block_type('plug-carso/custom-block', array(
        'render_callback' => 'plug_carso_render_block',
    ));
}
add_action('init', 'plug_carso_register_block');

// Cargar archivo CSS personalizado
function plug_carso_enqueue_scripts() {
    wp_enqueue_style('plug-carso-style', plugin_dir_url(__FILE__) . 'style.css');
}
add_action('wp_enqueue_scripts', 'plug_carso_enqueue_scripts');


// Función para renderizar el bloque personalizado
function plug_carso_render_block($attributes) {
    // Verificar si estamos en una página de entrada/post
    if (is_single()) {
        // Obtener la categoría actual de la entrada/post
        $categories = get_the_category();
        if (!empty($categories)) {
            $category_class = 'category-' . esc_attr($categories[0]->slug);
        }
    }

    // Obtener el tipo de contenido actual
    $post_type = get_post_type();

    // Verificar si estamos en una página y no en una entrada/post
    if (is_page() || empty($category_class)) {
        // En páginas, no cambiamos el estilo, simplemente retornamos el contenido sin modificar
        return '<div class="plug-carso-block">' .
            '<h2 class="plug-carso-title">' . esc_html($attributes['title']) . '</h2>' .
            '<p class="plug-carso-description">' . esc_html($attributes['description']) . '</p>' .
            '</div>';
    } else {
        // En entradas/posts, agregamos la clase correspondiente al contenedor del título
        return '<div class="plug-carso-block ' . $category_class . '">' .
            '<h2 class="plug-carso-title">' . esc_html($attributes['title']) . '</h2>' .
            '<p class="plug-carso-description">' . esc_html($attributes['description']) . '</p>' .
            '</div>';
    }
}
