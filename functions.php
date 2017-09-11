<?php

// REMOVE MENUS DO WORDPRES - ADMIN
add_action('wp_before_admin_bar_render', 'wps_admin_bar');
function wps_admin_bar()
{
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('wp-logo');
    $wp_admin_bar->remove_menu('about');
    $wp_admin_bar->remove_menu('wporg');
    $wp_admin_bar->remove_menu('documentation');
    $wp_admin_bar->remove_menu('support-forums');
    $wp_admin_bar->remove_menu('feedback');
    $wp_admin_bar->remove_menu('view-site');
}


// ADICIONA UM MENU NO WORDPRESS - ADMIN
add_action('wp_before_admin_bar_render', 'wp_admin_bar_new_item');
function wp_admin_bar_new_item()
{
    global $wp_admin_bar;
    $wp_admin_bar->add_menu(array(
        'id' => 'wp-admin-bar-new-item',
        'title' => __('meu link'),
        'href' => 'http://www.MEULINK.com.br/'
    ));
}


// REMOVE MENUS PADRÃO DO WORDPRESS - ADMIN
add_action('admin_menu', 'remove_links_menu');
function remove_links_menu()
{
    remove_menu_page('index.php'); // Dashboard
    remove_menu_page('edit.php'); // Posts
    remove_menu_page('upload.php'); // Media
    remove_menu_page('link-manager.php'); // Links
    remove_menu_page('edit.php?post_type=page'); // Pages
    remove_menu_page('edit-comments.php'); // Comments
    remove_menu_page('themes.php'); // Appearance
    remove_menu_page('plugins.php'); // Plugins
    remove_menu_page('users.php'); // Users
    remove_menu_page('tools.php'); // Tools
    remove_menu_page('options-general.php'); // Settings
}

// REMOVE NOME DO WORDPRESS
add_action('_admin_menu', 'remove_editor_menu', 1);
function remove_editor_menu()
{
    remove_action('admin_menu', '_add_themes_utility_last', 101);
}


// REMOVE VERSÃO DO WORDPRESS
add_filter('update_footer', 'change_footer_version', 9999);
function change_footer_version()
{
    return 'Version 1.0.0';
}

// ADICIONA UM NOME NO WORDPRESS
add_filter('admin_footer_text', 'remove_footer_admin');
function remove_footer_admin()
{
    echo 'Minha Empresa';
}


// PADROES DE TAMANHOS DE IMAGENS
if (function_exists('add_theme_support')) {
// Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    add_image_size('large', 700, '', true);
    add_image_size('medium', 250, '', true);
    add_image_size('small', 120, '', true);
    add_image_size('news', 185, 185, true);
    add_image_size('post', 616, 160, true);
    add_image_size('slider', 970, 360, true);
    add_image_size('fotos', 300, 200, true);
}


// Register Navigation
register_nav_menus(array(
    'principal' => __('Principal'),
    'footer' => __('Footer'),
    'sidebar' => __('Sidebar')
));

// Remove Query Strings – Optional Step
// Another thing we recommend is to remove query strings from your static resources.
// Resources with a “?” in the URL are not cached by some proxy caching servers or CDNS,
// which could result in a large missed opportunity for increased speeds. 
// One way to do this would be to add the following to your functions.php file.

function _remove_script_version( $src ){
$parts = explode( '?ver', $src );
return $parts[0];
}
add_filter( 'script_loader_src', '_remove_script_version', 15, 1 );
add_filter( 'style_loader_src', '_remove_script_version', 15, 1 );
