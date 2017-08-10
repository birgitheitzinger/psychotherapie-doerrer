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
function custom_post_type() {

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
  'menu_position' => 20,
  'show_in_admin_bar'   => true,
  'rewrite' => array('with_front' => false), //do not use post-base ("blog")
  'taxonomies' => array('category'),
  'supports' => array(
    'title',
    'editor',
    'revisions',
    // 'categories',
    'custom-fields',
    'thumbnail'
  ),
  'hierarchical'        => false,
  'public'              => true,
  'show_ui'             => true,
  'show_in_menu'        => true,
  'show_in_nav_menus'   => true,
  'show_in_admin_bar'   => true,
  'menu_position'       => 5,
  'can_export'          => true,
  'has_archive'         => true,
  'exclude_from_search' => false,
  'publicly_queryable'  => true,
  'capability_type'     => 'page',
));
}
//Allow printf with array
function printf_array_snippet($format, $arr)
{
    return call_user_func_array('printf', array_merge((array)$format, $arr));
}

if( function_exists('acf_add_options_page') ) {

    acf_add_options_page(array(
        'page_title'     => 'Optionen',
        'menu_title'    => 'Optionen',
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
    ob_start();  $res=str_replace("%content","%s",$res);
    // echo gettype($cont);
    printf_array_snippet($res,$cont);
    $res=ob_get_clean();

    return $res;
}
add_shortcode('persp_get_template', 'persp_output_content_in_php_templates');

//check for sidebar in page.php
function persp_right_sidebar_check(){
  global $post;
  if(is_front_page()) return false;

  // $novisiblechildrenpags=array(191); //191:videokurs > do not show children-links on pages with these parent-ids
  // if(in_array($post->post_parent,$novisiblechildrenpags)) return false;

  //test if page has children or is a child-page
  $children = get_pages( array( 'child_of' => $post->ID));//225) );

  //sitemap, show all all links in sidebar via shortcode [safer_output_sub_pages_in_sidebar]
  if($post->ID==168) $children=1;

  if( (count( $children ) > 0 ) || (is_page() && $post->post_parent )) { //Only show sidebar on pages with children
    get_sidebar( 'right' ); //use standard sidebar code
  }
}
//allow shortcodes in widgets
add_filter('widget_text','do_shortcode');

//check for parent-page children via shortcode in text widget (left sidebar)
function function_output_sub_pages_in_sidebar(){
  global $post;
  if ( is_page() && $post->post_parent ) {$parentID=$post->post_parent;}
    //get list of children
    $l="";
    //not on alle-termine page
    if($post->ID==98)return false;
    if(!$parentID) return false;
  //test if page has children
  $children = get_pages( array( 'child_of' => $post->ID ) );
   if( count( $children ) > 0 ) {$parentID=$post->ID;  }
  //test if we are on a child-page
  if ( is_page() && $post->post_parent ) {$parentID=$post->post_parent;}
  //get list of children
  $childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $parentID . '&echo=0' );

  if ( $childpages ) {
      $pp=get_post($parentID);
      $pptitle=$pp->post_title;
      $t="<style> .page-child .persp_subpage_children.one_fourth:before{content:'".$pptitle."' !important;}</style>";
      $string = $t.'<ul class="persp_subpage_children one_fourth">' . $childpages . '</ul>';
  }
return $string;

}
add_shortcode('persp_output_sub_pages_in_sidebar', 'function_output_sub_pages_in_sidebar');


//navi in footer-area of page, all child-pages but only prev and next visible
function persp_childpage_navi(){
  global $post;
  //No Navi on alle-termine page
  if($post->ID==98)return false;

  if ( is_page() && $post->post_parent ) {$parentID=$post->post_parent;}
    //get list of children
    $l="";
  if($parentID){
    //&exclude='.$post->ID
    $childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $parentID . '&echo=0&');

    if ( $childpages ) {
      $checkchildpages=explode("page-item-",$childpages);
      $newchildren=array(); //get page-ids from markup
      foreach ($checkchildpages as $child) {
         if(strpos($child,'><a')!==false){
           $child=explode('">',$child);
           $newchildren[]=preg_replace("/[^0-9,.]/", "",$child[0]); //only keep page ids
        }
      }
         $key = array_search($post->ID, $newchildren);
         //decide for previous and next page links in array
         $prev=$newchildren[$key-1];
         if(!empty($prev)){
         $itemprev="page-item-".$prev;
         $childpages=str_replace($itemprev,$itemprev." persp_child_back",$childpages);
        }
      $css="<style>.page .edit-link, .persp_subpage_children.subpage-navi li {display:none}
      .persp_subpage_children.subpage-navi{width:100%; display:block; clear:both; float:left}
      .persp_subpage_children.subpage-navi .persp_child_back,
      .persp_subpage_children.subpage-navi .current_page_item + li {display:inline-block}
      .persp_subpage_children.subpage-navi .current_page_item + li{float:right} /*next page*/ </style>";
      $l = $css.'<ul class="persp_subpage_children subpage-navi three_fourth">' . $childpages . '</ul>';
    }
  }

  echo $l;
}
function persp_newsletterform(){
  echo do_shortcode('[gravityform id=2 title=false description=false ajax=true tabindex=49]');
}

//return_child_pages_without_child_submenue
//test against this function with in_array() on page.php etc.
//ids in this array are pages that shall not show a children-sub-pages menue
function no_childpages(){
  $arr=array(98);//alle-termine
  return $arr;
}

/* Hook into the 'init' action so that the function
* Containing our post type registration is not
* unnecessarily executed.
*/

add_action( 'init', 'custom_post_type', 0 );

add_filter('body_class', 'append_forms_classes');
function append_forms_classes($classes){
  global $post;

  $i=$post->ID;
  $allforms=" persp_formular";
  if($i==428)$classes[]="persp_feedback".$allforms;
  if($i==430)$classes[]="persp_anfrage".$allforms;
  if($i==424)$classes[]="persp_newsletter".$allforms;
  return $classes;
}
