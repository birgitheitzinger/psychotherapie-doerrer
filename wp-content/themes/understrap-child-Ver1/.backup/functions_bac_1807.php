<?php
function understrap_remove_scripts() {
    wp_dequeue_style( 'understrap-styles' );
    wp_deregister_style( 'understrap-styles' );

    wp_dequeue_script( 'understrap-scripts' );
    wp_deregister_script( 'understrap-scripts' );

    // Removes the parent themes stylesheet and scripts from inc/enqueue.php
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {

	// Get the theme data
	$the_theme = wp_get_theme();

    wp_enqueue_style( 'child-understrap-styles', get_stylesheet_directory_uri() . '/css/child-theme.css', array(), $the_theme->get( 'Version' ) );
    wp_enqueue_style( 'child-understrap-styles-main', get_stylesheet_directory_uri() . '/style.css', array(), '1.0.3d');//$the_theme->get( 'Version' ) );
    wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . '/js/child-theme.min.js', array(), $the_theme->get( 'Version' ), true );
}
// http://justintadlock.com/archives/2013/09/13/register-post-type-cheat-sheet
register_post_type( 'termin', array(
  'labels' => array(
    'name' => 'Termine',
    'singular_name' => 'Termin',
    'add_new'       => 'Erstellen',
    'add_new_item' => 'Neuen Termin erstellen'
   ),
   'menu_icon' => 'dashicons-images-alt2',
  'description' => 'Termine ',
  'public' => true,
  'menu_position' => 20,
  'has_archive' => true,
  'rewrite' => array('with_front' => false), //do not use post-base ("blog")
  'taxonomies' => array('category'),
    'supports' => array(
    'title',
    'editor',
    'custom-fields',
    'thumbnail'
  )
));

//Allow printf with array
function printf_array_snippet($format, $arr)
{
    return call_user_func_array('printf', array_merge((array)$format, $arr));
}

if( function_exists('acf_add_options_page') ) {

    acf_add_options_page(array(
        'page_title'     => 'Blog Optionen',
        'menu_title'    => 'Blog Optionen',
        'menu_slug'     => 'blog-optionen',
        'capability'    => 'edit_posts',
        'redirect'        => false,
         'position' => 4
    ));

}
//internal shortcode to get content from php template,
//used to create output repeating posts in Snippets plugin
function persp_output_content_in_php_templates($atts, $content = null) {
    extract(shortcode_atts(array( 'amount' => null, 'file' => null, 'content'=>null), $atts));
    $snippetfile=$file;
    $fil="snippets/".$snippetfile.".php";
    if($amount)$pamount=$amount; //used in some templates to create loop
    // echo "amount:".$pamount;
    $cont= unserialize($content);
    ob_start(); require_once $fil;  $res=ob_get_clean();
    ob_start();  $res=str_replace("%content","%s",$res); printf_array_snippet($res,$cont); $res=ob_get_clean();

    return $res;
}
add_shortcode('persp_get_template', 'persp_output_content_in_php_templates');
