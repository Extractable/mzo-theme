<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package mizuho
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */

function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}

function fix_svg_thumb_display() {
  echo '
    <style type="text/css">td.media-icon img[src$=".svg"], img[src$=".svg"].attachment-post-thumbnail {
      width: 100% !important;
      height: auto !important;
    }</style>
  ';
}
add_action('admin_head', 'fix_svg_thumb_display');

add_filter('upload_mimes', 'cc_mime_types');
if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));

}


/**
 * Register a custom post type called "book".
 *
 * @see get_post_type_labels() for label keys.
 */
function mizuho_codex_init() {
    $labels = array(
        'name'                  => _x( 'Classes', 'Post type general name', 'textdomain' ),
        'singular_name'         => _x( 'Class', 'Post type singular name', 'textdomain' ),
        'menu_name'             => _x( 'Classes', 'Admin Menu text', 'textdomain' ),
        'name_admin_bar'        => _x( 'Class', 'Add New on Toolbar', 'textdomain' ),
        'add_new'               => __( 'Add New', 'textdomain' ),
        'add_new_item'          => __( 'Add New Class', 'textdomain' ),
        'new_item'              => __( 'New Class', 'textdomain' ),
        'edit_item'             => __( 'Edit Class', 'textdomain' ),
        'view_item'             => __( 'View Class', 'textdomain' ),
        'all_items'             => __( 'All Classes', 'textdomain' ),
        'search_items'          => __( 'Search Classes', 'textdomain' ),
        'parent_item_colon'     => __( 'Parent Classes:', 'textdomain' ),
        'not_found'             => __( 'No Classes found.', 'textdomain' ),
        'not_found_in_trash'    => __( 'No Classes found in Trash.', 'textdomain' ),
        'featured_image'        => _x( 'Class Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'archives'              => _x( 'Class archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'textdomain' ),
        'insert_into_item'      => _x( 'Insert into Class', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'textdomain' ),
        'uploaded_to_this_item' => _x( 'Uploaded to this Class', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'textdomain' ),
        'filter_items_list'     => _x( 'Filter Classes list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'textdomain' ),
        'items_list_navigation' => _x( 'Classes list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'textdomain' ),
        'items_list'            => _x( 'Classes list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'textdomain' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'class' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
    );

    register_post_type( 'class', $args );


    $labels = array(
        'name'                  => _x( 'Resources', 'Post type general name', 'textdomain' ),
        'singular_name'         => _x( 'Resource', 'Post type singular name', 'textdomain' ),
        'menu_name'             => _x( 'Resources', 'Admin Menu text', 'textdomain' ),
        'name_admin_bar'        => _x( 'Resource', 'Add New on Toolbar', 'textdomain' ),
        'add_new'               => __( 'Add New', 'textdomain' ),
        'add_new_item'          => __( 'Add New Resource', 'textdomain' ),
        'new_item'              => __( 'New Resource', 'textdomain' ),
        'edit_item'             => __( 'Edit Resource', 'textdomain' ),
        'view_item'             => __( 'View Resource', 'textdomain' ),
        'all_items'             => __( 'All Resources', 'textdomain' ),
        'search_items'          => __( 'Search Resources', 'textdomain' ),
        'parent_item_colon'     => __( 'Parent Resources:', 'textdomain' ),
        'not_found'             => __( 'No Resources found.', 'textdomain' ),
        'not_found_in_trash'    => __( 'No Resources found in Trash.', 'textdomain' ),
        'featured_image'        => _x( 'Resource Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'archives'              => _x( 'Resource archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'textdomain' ),
        'insert_into_item'      => _x( 'Insert into Resource', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'textdomain' ),
        'uploaded_to_this_item' => _x( 'Uploaded to this Resource', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'textdomain' ),
        'filter_items_list'     => _x( 'Filter Resources list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'textdomain' ),
        'items_list_navigation' => _x( 'Resources list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'textdomain' ),
        'items_list'            => _x( 'Resources list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'textdomain' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'resource' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
    );

    register_post_type( 'resource', $args );
}

add_action( 'init', 'mizuho_codex_init' );


function mizuho_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'mizuho_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function mizuho_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'mizuho_pingback_header' );


function atg_menu_classes($classes, $item, $args) {
  if($args->theme_location == 'menu-1') {
    $classes[] = 'nav-link';
  }
  return $classes;
}
add_filter('nav_menu_css_class', 'atg_menu_classes', 1, 3);


function get_primary_taxonomy_term( $post = 0, $taxonomy = 'category' ) {
	if ( ! $post ) {
		$post = get_the_ID();
	}
	$terms        = get_the_terms( $post, $taxonomy );
	$primary_term = array();
	if ( $terms ) {
		$term_display = '';
		$term_slug    = '';
		$term_link    = '';
		if ( class_exists( 'WPSEO_Primary_Term' ) ) {
			$wpseo_primary_term = new WPSEO_Primary_Term( $taxonomy, $post );
			$wpseo_primary_term = $wpseo_primary_term->get_primary_term();
			$term               = get_term( $wpseo_primary_term );
			if ( is_wp_error( $term ) ) {
				$term_display = $terms[0]->name;
				$term_slug    = $terms[0]->slug;
				$term_link    = get_term_link( $terms[0]->term_id );
				$termdata = $terms[0];
			} else {
				$term_display = $term->name;
				$term_slug    = $term->slug;
				$term_link    = get_term_link( $term->term_id );
				$termdata = $term;
			}
		} else {
			$term_display = $terms[0]->name;
			$term_slug    = $terms[0]->slug;
			$term_link    = get_term_link( $terms[0]->term_id );
			$termdata = $terms[0];
		}
		$primary_term['url']   = $term_link;
		$primary_term['slug']  = $term_slug;
		$primary_term['title'] = $term_display;
		$primary_term['terms']  = $termdata;
	}
	return $primary_term;
}

// STOP WORDPRESS REMOVING TAGS
function tags_tinymce_fix( $init )
{
  // html elements being stripped
  $init['extended_valid_elements'] = 'i[*],span[*]';
  // don't remove line breaks
  $init['remove_linebreaks'] = false;
  // convert newline characters to BR
  $init['convert_newlines_to_brs'] = true;
  // don't remove redundant BR
  $init['remove_redundant_brs'] = false;
  // pass back to wordpress
  return $init;
}
add_filter('tiny_mce_before_init', 'tags_tinymce_fix');

add_shortcode('productlist', 'productlist');
function productlist(){
	$themesite = get_stylesheet_directory_uri();
	$contentHTML = '
					<section class="mosaic-story section-padding">
					  <div class="container">
					    <div class="row">
					      <div class="col-lg-8 mx-auto text-center">
					        <h3>Product Heading Ipsum Dolor Sit Smet, Con Secte Tur Adipiscing</h3>
					        <h6 class="px-lg-5">Lorem ipsum dolor sit amet, consec tetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </h6>
					      </div>
					    </div>
					    <div class="row mt-5">
					      <div class="col-12 mosaic-products">
					        <div class="mosaic-product">
					          <a href="#">
					            <img src="'.$themesite.'/images/mosaic_story_hero1.jpg" class="img-fluid" alt="mosaic story hero 1">
					            <div class="mosaic-label">
					              <h5>Product Title Lorem Ipsum Dolar Sit Amet Consectetuer</h5>
					            </div>
					          </a>
					        </div>
					        <div class="mosaic-product">
					          <a href="#">
					            <img src="'.$themesite.'/images/mosaic_story_sub1.jpg" class="img-fluid" alt="mosaic story sub 1">
					            <div class="mosaic-label">
					              <h5>Product Title Lorem Ipsum Dolar Sit Amet Consectetuer</h5>
					            </div>
					          </a>
					        </div>
					        <div class="mosaic-product">
					          <a href="#">
					            <img src="'.$themesite.'/images/mosaic_story_sub2.jpg" class="img-fluid" alt="mosaic story sub 2">
					            <div class="mosaic-label">
					              <h5>Product Title Lorem Ipsum Dolar Sit Amet Consectetuer</h5>
					            </div>
					          </a>
					        </div>
					        <div class="mosaic-product">
					          <a href="#">
					            <img src="'.$themesite.'/images/mosaic_story_sub3.jpg" class="img-fluid" alt="mosaic story sub 3">
					            <div class="mosaic-label">
					              <h5>Product Title Lorem Ipsum Dolar Sit Amet Consectetuer</h5>
					            </div>
					          </a>
					        </div>
					        <div class="mosaic-product">
					          <a href="#">
					            <img src="'.$themesite.'/images/mosaic_story_sub4.jpg" class="img-fluid" alt="mosaic story sub 4">
					            <div class="mosaic-label">
					              <h5>Product Title Lorem Ipsum Dolar Sit Amet Consectetuer</h5>
					            </div>
					          </a>
					        </div>
					      </div>
					    </div>
					  </div>
					</section>
				   ';
	return $contentHTML;
}


add_shortcode('productfour', 'productfour');
function productfour(){
	$themesite = get_stylesheet_directory_uri();
	$contentHTML = '
					<section class="one-fourth-product section-padding">
					  <div class="container">
					    <div class="row no-gutters">
					      <div class="col-12 one-fourth-products">
					        <h3>Neuro Spine Products Heading</h3>
					        <div class="one-fourth-product-box">
					          <a href="#">
					            <div class="square-image">
					              <img src="'.$themesite.'/images/one_fourth_productname_hero1.jpg" class="img-fluid" alt="one fourth product 1">
					            </div>
					            <div class="one-fourth-product-label">
					              <h5>Neuro Spine Surgical Tables</h5>
					            </div>
					          </a>
					        </div>
					        <div class="one-fourth-product-box">
					          <a href="#">
					            <div class="square-image">
					              <img src="'.$themesite.'/images/one_fourth_productname_hero2.jpg" class="img-fluid" alt="one fourth product 2">
					            </div>
					            <div class="one-fourth-product-label">
					              <h5>Surgical Table Accessories</h5>
					            </div>
					          </a>
					        </div>
					        <div class="one-fourth-product-box">
					          <a href="#">
					            <div class="square-image">
					              <img src="'.$themesite.'/images/one_fourth_productname_hero3.jpg" class="img-fluid" alt="one fourth product 3">
					            </div>
					            <div class="one-fourth-product-label">
					              <h5>Positioning</h5>
					            </div>
					          </a>
					        </div>
					        <div class="one-fourth-product-box">
					          <a href="#">
					            <div class="square-image">
					              <img src="'.$themesite.'/images/one_fourth_productname_hero4.jpg" class="img-fluid" alt="one fourth product 4">
					            </div>
					            <div class="one-fourth-product-label">
					              <h5>Supplies and Patient Care Kits</h5>
					            </div>
					          </a>
					        </div>
					      </div>
					    </div>
					  </div>
					</section>
				   ';
	return $contentHTML;
}


add_shortcode('resources', 'resources');
function resources(){
	global $post;

	$termdatas = get_terms( array( 'taxonomy' => 'resource_for', 'hide_empty' => false ) );
	$listcategory = "";
	foreach( $termdatas as $termdata ){
		$listcategory .= ' <li><a href="'.get_term_link($termdata).'" rel="'.$termdata->slug.'">'.$termdata->name.'</a></li>';
	}

	$additionalfilter = Array();
	$category = @$_REQUEST["cat"];
	if($category!=""){
		$additionalfilter[] =array(
		                              'taxonomy' => "resource_for",
		                              'field' => 'slug',
		                              'terms' => explode(",",$category),
		                              'operator' => 'IN',
		                          );
	}

	$resource_type = @$_REQUEST["resource_type"];
	if($resource_type!=""){
		$additionalfilter[] =array(
		                              'taxonomy' => "resource_type",
		                              'field' => 'slug',
		                              'terms' => explode(",",$resource_type),
		                              'operator' => 'IN',
		                          );
	}
	$resource_surgical_table = @$_REQUEST["resource_surgical_table"];
	if($resource_surgical_table!=""){
		$additionalfilter[] =array(
		                              'taxonomy' => "resource_surgical_table",
		                              'field' => 'slug',
		                              'terms' => explode(",",$resource_surgical_table),
		                              'operator' => 'IN',
		                          );
	}
	$resource_other_product = @$_REQUEST["resource_other_product"];
	if($resource_other_product!=""){
		$additionalfilter[] =array(
		                              'taxonomy' => "resource_other_product",
		                              'field' => 'slug',
		                              'terms' => explode(",",$resource_other_product),
		                              'operator' => 'IN',
		                          );
	}
	if(count($additionalfilter)<1)
		$additionalfilter = "";

	$pg = @$_REQUEST["pg"];
	if($pg==""){
		$pg = 1;
	}
	$args = array(
					'posts_per_page' => 9 * $pg,
					'post_type' => 'resource',
					'tax_query' => array(
					    'relation' => 'AND',
					    $additionalfilter
					),
				 );


    $termdatas = get_terms( array( 'taxonomy' => 'resource_type', 'hide_empty' => false ) );
    $htmltype = "";
    foreach( $termdatas as $termdata ){
		$htmltype .= '
		              <div class="custom-control custom-checkbox">
		                <input type="checkbox" class="custom-control-input" id="resourcetype_'.$termdata->slug.'" name="resourcetype_'.$termdata->slug.'" rel="resourcetype" value="'.$termdata->slug.'">
		                <label class="custom-control-label" for="resourcetype_'.$termdata->slug.'">'.$termdata->name.'</label>
		              </div>
		             ';
	}
    $termdatas = get_terms( array( 'taxonomy' => 'resource_surgical_table', 'hide_empty' => false ) );
    $htmlsurgical = "";
    foreach( $termdatas as $termdata ){
		$htmlsurgical .= '
			              <div class="custom-control custom-checkbox">
			                <input type="checkbox" class="custom-control-input" id="resourcesurgical_'.$termdata->slug.'" name="resourcesurgical_'.$termdata->slug.'" rel="resourcesurgical" value="'.$termdata->slug.'">
			                <label class="custom-control-label" for="resourcesurgical_'.$termdata->slug.'">'.$termdata->name.'</label>
			              </div>
			             ';
	}
    $termdatas = get_terms( array( 'taxonomy' => 'resource_other_product', 'hide_empty' => false ) );
    $htmlotherp = "";
    foreach( $termdatas as $termdata ){
		$htmlotherp .= '
			              <div class="custom-control custom-checkbox">
			                <input type="checkbox" class="custom-control-input" id="resourceother_'.$termdata->slug.'" name="resourceother_'.$termdata->slug.'" rel="resourceother" value="'.$termdata->slug.'">
			                <label class="custom-control-label" for="resourceother_'.$termdata->slug.'">'.$termdata->name.'</label>
			              </div>
			           ';
	}

    $query = new WP_Query( $args );
    $shownav = 1;
    if($query->found_posts <= $query->post_count){
      $shownav = 0;
    }
    $listp = '';
    if ( $query->have_posts() ) {
        $countercol = 1;
        while ( $query->have_posts() ) {
            $query->the_post();
            $permalink = get_permalink();
            $title = get_the_title();
            $content = wp_trim_words(strip_tags(get_the_excerpt()), 10, "");
            $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');
            $cta_text = get_field("cta_text");
            $cta_url = get_field("cta_url");
            if($cta_url=="")
            	$cta_url = "#";
            if($cta_text)
            	$cta_text = '<a href="'.$cta_url.'" class="label-link">'.$cta_text.' <i class="fas fa-angle-right ml-1"></i></a>';

             $listp.= '
			            <div class="product-resource pcol'.$countercol.'">
			              <div class="square-image">
			                <a href="'.$permalink.'"><img src="'.$featured_img_url.'" class="img-fluid" alt="'.@$post->post_title.'"></a>
			              </div>
			              <div class="product-resource-label">
	                        <h5><a href="'.$permalink.'">'.$title.'</a></h5>
			                '.$cta_text.'
			              </div>
			            </div>
	                  ';
            $countercol++;
            if($countercol>=4){
              $countercol = 1;
            }
        }
    }
    wp_reset_postdata();
	$stylesmp = "";
	if($shownav){
		$stylesmp = "display:block;";
	}
	else{
		$stylesmp = "display:none;";
	}

	$contentHTML = '
						<section class="product-resource-cards section-padding resourcedata">
						  <div class="container">
						    <div class="row">
						      <div class="col-lg-3 filter-area">
						        <div class="toggle-filter d-block d-lg-none">
						          <a data-toggle="collapse" class="collapsed" href="#filter-toggle" role="button">Resources For <span class="toggle-plus"></span><span class="toggle-minus" style="display: none;"></span></a>
						        </div>
						        <div class="collapse" id="filter-toggle">
						          <h5 class="mb-4 d-none d-lg-block">Resources For</h5>
						          <div class="toggle-filter-inside d-block d-lg-none">
						            <a data-toggle="collapse" class="collapsed" href="#filter-for" role="button">For <span class="toggle-plus"></span><span class="toggle-minus"></span></a>
						          </div>
						          <div class="filter-list collapse" id="filter-for">
						            <h6>For</h6>
						            <ul class="no-bullets">
						              <li><a href="'.get_permalink(get_field("resources_page","option")).'" class="active">All</a></li>
              						  '.$listcategory.'
						            </ul>
						          </div>
						          <div class="toggle-filter-inside d-block d-lg-none">
						            <a data-toggle="collapse" class="collapsed" href="#filter-type" role="button">Type <span class="toggle-plus"></span><span class="toggle-minus"></span></a>
						          </div>
						          <div class="filter-checkbox collapse" id="filter-type">
						            <h6>Type <a href="#" class="resourcetypeca clearall" style="display:none;">Clear All</a></h6>
						            '.$htmltype.'
						          </div>
						          <div class="toggle-filter-inside d-block d-lg-none">
						            <a data-toggle="collapse" class="collapsed" href="#filter-surgical-tables" role="button">Surgical Tables <span class="toggle-plus"></span><span class="toggle-minus"></span></a>
						          </div>
						          <div class="filter-checkbox collapse" id="filter-surgical-tables">
						            <h6>Surgical Tables <a href="#" class="resourcesurgicalca clearall" style="display:none;">Clear All</a></h6>
						            '.$htmlsurgical.'
						          </div>
						          <div class="toggle-filter-inside d-block d-lg-none">
						            <a data-toggle="collapse" class="collapsed" href="#filter-other" role="button">Other Products <span class="toggle-plus"></span><span class="toggle-minus"></span></a>
						          </div>
						          <div class="filter-checkbox collapse" id="filter-other">
						            <h6>Other Products <a href="#" class="resourceotherca clearall" style="display:none;">Clear All</a></h6>
						            '.$htmlotherp.'
						          </div>
						          <div class="d-block d-lg-none">
						            <a href="#" class="btn btn-primary my-2 w-100">Done</a>
						            <a href="#" class="btn btn-light bg-white mb-4 w-100">Reset</a>
						          </div>
						        </div>
						      </div>
						      <div class="col-lg-9">
						        <div class="row">
						          <div class="col-12 product-resources productloaddata">

						            '.$listp.'

						          </div>
						          <div style="width: 100%;">
				                    <input type="hidden" name="cat" class="field_cat" value="">
				                    <input type="hidden" name="resource_type" class="field_resource_type" value="">
				                    <input type="hidden" name="resource_surgical_table" class="field_resource_surgical_table" value="">
				                    <input type="hidden" name="resource_other_product" class="field_resource_other_product" value="">
				                    <input type="hidden" name="pg" class="field_pg" value="'.$pg.'">
				                    <div class="loadingpageproduct"></div>
						            <div class="product-resource-more showmoreresource" style="'.$stylesmp.'">
						              <button id="myBtn">Show More <i class="fas fa-plus"></i></button>
						            </div>
						          </div>
						        </div>
						      </div>
						    </div>
						  </div>
						</section>
				   ';
	return $contentHTML;
}


function new_excerpt_more( $more ) {
    return '';
}
add_filter('excerpt_more', 'new_excerpt_more');



add_action( 'wp_ajax_nopriv_productload', 'productload' );
add_action( 'wp_ajax_productload', 'productload' );

function productload() {

	$additionalfilter = Array();
	$category = @$_REQUEST["cat"];
	if($category==""){
		$category = $term->slug;
	}
	foreach($_REQUEST as $reqkey => $reqval){
		if($reqval){
			if(strstr($reqkey, "filter-")){
				$reqkeyval = str_replace("filter-","",$reqkey);
				$additionalfilter[] =array(
				                              'taxonomy' => $reqkeyval,
				                              'field' => 'slug',
				                              'terms' => explode(",",$reqval),
				                              'operator' => 'IN',
				                          );
			}
		}
	}
	if(count($additionalfilter)<1)
		$additionalfilter = "";

	$pg = @$_REQUEST["pg"];
	if($pg==""){
		$pg = 1;
	}
	$offset = (12*($pg-1));
	$args = array(
					'posts_per_page' => 12,
					'offset' => $offset,
					'post_type' => 'product',
					'tax_query' => array(
					    'relation' => 'AND',
					    array(
					        'taxonomy' => "product_cat",
					        'field' => 'slug',
					        'terms' => array($category),
					        'operator' => 'IN',
					    ),
					    $additionalfilter
					),
				 );

    $query = new WP_Query( $args );
    $shownav = 1;
    if($query->found_posts <= $query->post_count+$offset){
      $shownav = 0;
    }
    if ( $query->have_posts() ) {
    	$countercol = 1;
        while ( $query->have_posts() ) {
            $query->the_post();
            $permalink = get_permalink();
            $title = get_the_title();
            $content = wp_trim_words(strip_tags(get_the_excerpt()), 10, "");
            $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');

            echo '
                  <div class="one-third-product productlistdata pcol'.$countercol.'">
                    <a href="'.$permalink.'">
                      <img src="'.$featured_img_url.'" class="img-fluid" alt="'.$post->post_title.'">
                      </a><div class="one-third-product-label"><a href="'.$permalink.'">
                        <h5>'.$title.'</h5>
                        <p>'.$content.'</p>
                        </a><a href="'.$permalink.'" class="label-link">Learn More <i class="fas fa-angle-right ml-1"></i></a>
                      </div>
                  </div>
                 ';
	        $countercol++;
	        if($countercol>=4){
	          $countercol = 1;
	        }
        }
    }
    else{
    	echo '<p class="text-center" style="width:100%;">No Results Found</p>';
    }
    if($shownav){
    	$addjs = 'jQuery(".showmoreproduct").show();';
    }
    else{
    	$addjs = 'jQuery(".showmoreproduct").hide();';
    }
    echo '<script>
    		jQuery(document).ready(function(){
    			'.$addjs.'
    		});
    	  </script>
    	 ';
    die();
}




add_action( 'wp_ajax_nopriv_resourceload', 'resourceload' );
add_action( 'wp_ajax_resourceload', 'resourceload' );

function resourceload() {

	$additionalfilter = Array();
	$category = @$_REQUEST["cat"];
	if($category!=""){
		$additionalfilter[] =array(
		                              'taxonomy' => "resource_for",
		                              'field' => 'slug',
		                              'terms' => explode(",",$category),
		                              'operator' => 'IN',
		                          );
	}
	$resource_type = @$_REQUEST["resource_type"];
	if($resource_type!=""){
		$additionalfilter[] =array(
		                              'taxonomy' => "resource_type",
		                              'field' => 'slug',
		                              'terms' => explode(",",$resource_type),
		                              'operator' => 'IN',
		                          );
	}
	$resource_surgical_table = @$_REQUEST["resource_surgical_table"];
	if($resource_surgical_table!=""){
		$additionalfilter[] =array(
		                              'taxonomy' => "resource_surgical_table",
		                              'field' => 'slug',
		                              'terms' => explode(",",$resource_surgical_table),
		                              'operator' => 'IN',
		                          );
	}
	$resource_other_product = @$_REQUEST["resource_other_product"];
	if($resource_other_product!=""){
		$additionalfilter[] =array(
		                              'taxonomy' => "resource_other_product",
		                              'field' => 'slug',
		                              'terms' => explode(",",$resource_other_product),
		                              'operator' => 'IN',
		                          );
	}
	if(count($additionalfilter)<1)
		$additionalfilter = "";

	$pg = @$_REQUEST["pg"];
	if($pg==""){
		$pg = 1;
	}
	$offset = (9*($pg-1));
	$args = array(
					'posts_per_page' => 9,
					'offset' => $offset,
					'post_type' => 'resource',
					'tax_query' => array(
					    'relation' => 'AND',
					    $additionalfilter
					),
				 );
    $query = new WP_Query( $args );
    $shownav = 1;
    if($query->found_posts <= $query->post_count+$offset){
      $shownav = 0;
    }
    if ( $query->have_posts() ) {
    	$countercol = 1;
        while ( $query->have_posts() ) {
            $query->the_post();
            $permalink = get_permalink();
            $title = get_the_title();
            $content = wp_trim_words(strip_tags(get_the_excerpt()), 10, "");
            $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');

            $cta_text = get_field("cta_text");
            $cta_url = get_field("cta_url");
            if($cta_url=="")
            	$cta_url = "#";
            if($cta_text)
            	$cta_text = '<a href="'.$cta_url.'" class="label-link">'.$cta_text.' <i class="fas fa-angle-right ml-1"></i></a>';

            echo '
		            <div class="product-resource pcol'.$countercol.'">
		              <div class="square-image">
		                <a href="'.$permalink.'"><img src="'.$featured_img_url.'" class="img-fluid" alt="'.@$post->post_title.'"></a>
		              </div>
		              <div class="product-resource-label">
                        <h5><a href="'.$permalink.'">'.$title.'</a></h5>
		                '.$cta_text.'
		              </div>
		            </div>
                 ';
	        $countercol++;
	        if($countercol>=4){
	          $countercol = 1;
	        }
        }
    }
    else{
    	echo '<p class="text-center" style="width:100%;">No Results Found</p>';
    }
    if($shownav){
    	$addjs = 'jQuery(".showmoreresource").show();';
    }
    else{
    	$addjs = 'jQuery(".showmoreresource").hide();';
    }
    echo '<script>
    		jQuery(document).ready(function(){
    			'.$addjs.'
    		});
    	  </script>
    	 ';
    die();
}




add_action( 'wp_ajax_nopriv_classload', 'classload' );
add_action( 'wp_ajax_classload', 'classload' );

function classload() {
    $themeurl = get_stylesheet_directory_uri();
	$additionalfilter = Array();
	$category = @$_REQUEST["cat"];
	if($category!=""){
		$additionalfilter[] =array(
		                              'taxonomy' => "class_for",
		                              'field' => 'slug',
		                              'terms' => explode(",",$category),
		                              'operator' => 'IN',
		                          );
	}
	$class_class = @$_REQUEST["class_class"];
	if($class_class!=""){
		$additionalfilter[] =array(
		                              'taxonomy' => "class_class",
		                              'field' => 'slug',
		                              'terms' => explode(",",$class_class),
		                              'operator' => 'IN',
		                          );
	}
	$class_product = @$_REQUEST["class_product"];
	if($class_product!=""){
		$additionalfilter[] =array(
		                              'taxonomy' => "class_product",
		                              'field' => 'slug',
		                              'terms' => explode(",",$class_product),
		                              'operator' => 'IN',
		                          );
	}
	$class_type = @$_REQUEST["class_type"];
	if($class_type!=""){
		$additionalfilter[] =array(
		                              'taxonomy' => "class_type",
		                              'field' => 'slug',
		                              'terms' => explode(",",$class_type),
		                              'operator' => 'IN',
		                          );
	}
	if(count($additionalfilter)<1)
		$additionalfilter = "";

	$pg = @$_REQUEST["pg"];
	if($pg==""){
		$pg = 1;
	}
	$offset = (6*($pg-1));
	$args = array(
					'posts_per_page' => 6,
					'offset' => $offset,
					'post_type' => 'class',
					'tax_query' => array(
					    'relation' => 'AND',
					    $additionalfilter
					),
				 );
    $query = new WP_Query( $args );
    $shownav = 1;
    if($query->found_posts <= $query->post_count+$offset){
      $shownav = 0;
    }
    if ( $query->have_posts() ) {
    	$countercol = 1;
        while ( $query->have_posts() ) {
	        $query->the_post();
	        $permalink = get_permalink();
	        $title = get_the_title();
	        $content = get_the_content();//wp_trim_words(strip_tags(get_the_excerpt()), 10, "");
	        $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');
	        $sku = get_field("sku");
	        $price = get_field("price");
	        $download_brochure_link = get_field("download_brochure_link");
	        $register_link = get_field("register_link");
            $classTitle = get_field("class_title");
	        $datas = get_field("data");
	        $contentdata = '';
	        $counter = 0;
	        foreach($datas as $data){
	        	$counter++;
	        	$class = "";
	        	$text = "REGISTER";
	        	if($data["status"]=="full"){
	        		$class = "disabled";
	        		$text = "Class Full";
	        	}
	        	if($data["url"]==""){
	        		$data["url"]="#";
	        	}
                $classDate = $data["date"];
				$contentdata .= '
					                <tr>
					                  <td>'.$data["date"].'</td>
					                  <td>'.$data["location"].'</td>
                                      <td><a href="/registration/?training='.$classTitle.'&date='.$classDate.'" class="btn btn-primary '.$class.'">'.$text.'</a></td>
					                </tr>
								';
	        }
	        $buttonhtml  = '';
	        if($download_brochure_link){
	        	$buttonhtml = '
				                    <div class="download-link my-2 d-none d-md-block"><a href="'.$download_brochure_link.'" class="text-link-arrow">Download the Brochure <i class="fas fa-angle-right ml-2"></i></a></div>
				                    <button type="button" data-toggle="collapse" data-target="#classdata'.$counter.'" aria-expanded="false" aria-controls="classdata'.$counter.'" class="collapsed">View Dates <i class="fas fa-plus ml-2"></i><i class="fas fa-minus ml-2"></i></button>
	        				  ';
	        }
	        else if($register_link && count($datas)<1){
	        	$buttonhtml = '
				                    <div class="download-link my-2"></div>
				                    <a href="'.$register_link.'" class="button" target="_blank">Register</a>
	        				  ';
	        }

	        $skuhtml = '';
	        if($sku){
	        	$skuhtml = '<p class="class-id">'.$sku.'</p>';
	        }
	        $pricehtml = '';
	        if($price){
	        	$pricehtml = '<h6>'.$price.'</h6>';
	        }

	        echo      '
						<div class="class-detail">
				          <div class="main-area">
				            <div class="row">
				              <div class="col pr-md-3 mr-md-3">
				                <div class="square-image">
				                  <img src="'.$featured_img_url.'" alt="'.$title.'" class="img-fluid">
				                </div>
				              </div>
				              <div class="col-md-9 pl-md-0">
				                <h6>'.$title.'</h6>
				                <div class="row">
				                  <div class="col-md-8 col-xl-9 desc">
				                    '.wpautop($content).'
				                  </div>
				                  <div class="col-md-4 col-xl-3 text-md-right">
				                    <div class="download-link d-block d-md-none">
				                    </div>
				                    '.$skuhtml.$pricehtml.'
				                  </div>
				                  <div class="col-12 d-flex align-items-center justify-content-between flex-column flex-md-row">
				                  	'.$buttonhtml.'
				                  </div>
				                </div>
				              </div>
				            </div>
				          </div>
				          <div class="class-toggle collapse" id="classdata'.$counter.'">
				            <div class="d-flex justify-content-end mb-n3 mx-n4">
				              <a href="#" data-toggle="collapse" data-target="#classdata'.$counter.'" aria-expanded="true" aria-controls="classdata'.$counter.'">
                                <img src="'.$themeurl.'/images/toggle-times.svg" alt="close toggle"><span class="d-none">Close</span>
				              </a>
				            </div>
				            <table class="class-table">
				              <thead>
				                <tr>
				                  <td class="column-1">
				                    <h6>Date</h6>
				                  </td>
				                  <td class="column-2">
				                    <h6>Location</h6>
				                  </td>
				                  <td class="column-3">
				                    <h6>Register</h6>
				                  </td>
				                </tr>
				              </thead>
				              <tbody>
				              	'.$contentdata.'
				              </tbody>
				            </table>
				          </div>
				        </div>
	                  ';
	        $countercol++;
	        if($countercol>=4){
	          $countercol = 1;
	        }
        }
    }
    else{
    	echo '<p class="text-center" style="width:100%;">No Results Found</p>';
    }
    if($shownav){
    	$addjs = 'jQuery(".showmoreclass").show();';
    }
    else{
    	$addjs = 'jQuery(".showmoreclass").hide();';
    }
    echo '<script>
    		jQuery(document).ready(function(){
    			'.$addjs.'
    		});
    	  </script>
    	 ';
    die();
}

add_action("wp_loaded","checkajax");
function checkajax(){
	$ajax = @$_REQUEST["ajax"];
	$action = @$_REQUEST["action"];

	if($ajax==1 && $action=="manager"){
		$country = $_REQUEST["country"];
		$zip = $_REQUEST["zip"];

		if($country=="us"){
			$args = array(
			    'posts_per_page'   => 1,
			    'post_type'		   => 'sales_reps',
			    'orderby'          => 'post_date',
			    'order'            => 'DESC',
			    'post_status'      => 'publish',
			    'meta_query' => array(
			        array(
			            'key'     => 'sales_zip',
			            'value'   => $zip,
			            'compare' => 'LIKE',
			        ),
			    ),
			);
		}
		else{
			$args = array(
			    'posts_per_page'   => 1,
			    'post_type'		   => 'location',
			    'orderby'          => 'post_date',
			    'order'            => 'DESC',
			    'post_status'      => 'publish',
			    'meta_query' => array(
			        array(
			            'key'     => 'loc_countries',
			            'value'   => $zip,
			            'compare' => 'LIKE',
			        ),
			    ),
			);
		}

		$postdatas = get_posts( $args );
		if(count($postdatas)){
			foreach($postdatas as $postdata){
				if($country=="us"){
					$image = get_the_post_thumbnail_url($postdata->ID, 'full');
					if($image){
						$classinfo = 'col-md-8';
						$classimage = '<div class="col-md-4"><img src="'.$image.'" alt="'.$postdata->post_title.'"></div>';
					}
					else{
						$classinfo = 'col-md-12';
					}
					$title = get_field("sales_title", $postdata->ID);
					$area = get_field("sales_area", $postdata->ID);
					$cell = get_field("sales_cell", $postdata->ID);
					$email = get_field("sales_email", $postdata->ID);

					$contentinfo = '';
					if($title){
						$contentinfo .= '<div class="managertitle">'.$title.'</div>';
					}
					if($area){
						$contentinfo .= '<div class="managerarea">'.$area.'</div>';
					}
					if($cell){
						$contentinfo .= '<div class="managercell">Cell: <a href="tel:'.$cell.'">'.$cell.'</a></div>';
					}
					if($email){
						$contentinfo .= '<div class="manageremail">Email: <a href="mailto:'.$email.'">'.$email.'</a></div>';
					}
					echo '
							<div class="row managersection">
								'.$classimage.'
								<div class="'.$classinfo.'"><div class="managerposttitle">'.$postdata->post_title.'</div>'.$contentinfo.'</div>
							</div>
						 ';
				}
				else{
					$loc_details = get_field("loc_details", $postdata->ID);
					$loc_contact = get_field("loc_contact", $postdata->ID);
					$loc_phone = get_field("loc_phone", $postdata->ID);
					$loc_email = get_field("loc_email", $postdata->ID);

					$contentinfo = '';
					if($loc_details){
						$contentinfo .= '<div class="loc_details">'.$loc_details.'</div>';
					}
					if($loc_contact){
						$contentinfo .= '<div class="loc_contact">Contact: '.$loc_contact.'</div>';
					}
					if($loc_phone){
						$contentinfo .= '<div class="loc_phone">Phone: <a href="tel:'.$loc_phone.'">'.$loc_phone.'</a></div>';
					}
					if($loc_email){
						$contentinfo .= '<div class="loc_email">Email: <a href="mailto:'.$loc_email.'">'.$loc_email.'</a></div>';
					}
					echo '
							<div class="row managersection">
								<div class="col-md-12"><div class="managerposttitle">'.$postdata->post_title.'</div>'.$contentinfo.'</div>
							</div>
						 ';

				}
			}
		}
		else{
					echo '
							<div class="row managersection">
								<div class="col-md-12"><div class="managerposttitle" style="text-align:center;">No results found.</div></div>
							</div>
						 ';
		}
		exit;
	}
}

add_shortcode("searchcontactus", "searchcontactus");
function searchcontactus() {
	$contentHTML = '
					<div class="mobile-menu-bottom">
						<form role="search" method="get" class="search-form" action="http://www.dev.millennialwebdevelopment.com/mizuho/wp" style="display: block;">
							<label for="s" style="display: none;">Search for:</label>
							<input type="search" class="search-field" placeholder="I need help finding…" value="" id="s" name="s">
							<button type="submit" class="search-submit"><i class="fas fa-search"></i></button>
						</form>
						<a href="/support/#contactform">Contact Us</a>
					</div>
				  ';
	return $contentHTML;
}
