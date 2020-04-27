<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package mizuho
 */

get_header();

$themeurl = get_stylesheet_directory_uri();
$postnews = get_field( 'resources_page', 'option' );
$posttitle = get_the_title($postnews);
$postlink = get_permalink($postnews);

$term = get_queried_object();
$background_image = get_field('background_image', $term);
if($background_image=="")
	$background_image = $themeurl."/images/product_marquee_hero5.jpg";
$background_image = 'background-image:url('.$background_image.');';
$header_title = get_field('header_title', $term);
if($header_title=="")
	$header_title = $term->name;
$header_sub_title = get_field('header_sub_title', $term);
$content_term = get_field('content', $term);
$button_text = get_field('button_text', $term);
$button_url = get_field('button_url', $term);
if($button_url=="")
	$button_url = "#";

if($header_title)
	$header_title = '<h2 class="text-white mb-2 mb-md-4">'.$header_title.'</h2>';
if($header_sub_title)
	$header_sub_title = '<h6 class="text-white mb-2 mb-md-4">'.$header_sub_title.'</h6>';

?>


	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<section class="top-breadcrumb">
			  <div class="container">
			    <div class="row">
			      <div class="col-12">
			        <span class="d-none d-md-inline-block"><a href="<?php echo get_option("siteurl");?>">Home</a> /</span> <span class="d-inline-flex align-items-center d-md-none"><a href="#"><i class="fas fa-angle-right mr-2"></i><span class="d-none">breadcrumb</span></a></span><a href="<?php echo $postlink;?>"><?php echo $posttitle;?></a> <span class="d-none d-md-inline-block" style="padding-right: 5px;">/</span><span class="d-inline-block d-md-none" style="padding-right: 5px;"></span><span class="d-inline-flex align-items-center d-md-none"><a href="#"><i class="fas fa-angle-right mr-2"></i><span class="d-none">breadcrumb</span></a></span><a href="<?php echo get_term_link($term);?>"><?php echo $term->name;?></a>
			      </div>
			    </div>
			  </div>
			</section>

			<section class="product-marquee extra-tall">
			  <div class="container-fluid">
			    <div class="row">
			      <div class="col-md-6 px-0 product-marquee-media-area" style="<?php echo $background_image;?>">
			      </div>
			      <div class="col-md-6 text-white product-marquee-text-area">
			        <div class="fix-container-position">
			          <?php
			          	echo $header_title;
			          	echo $header_sub_title;
						echo $content_term;
			          	if($button_text){
			          		echo '<a href="'.$button_url.'" class="text-link-arrow text-white mt-2 mt-md-4">'.$button_text.' <i class="fas fa-angle-right ml-2"></i></a>';
			          	}
			          ?>
			        </div>
			      </div>
			    </div>
			  </div>
			</section>
<?php

	$termdatas = get_terms( array( 'taxonomy' => 'resource_for', 'hide_empty' => false ) );
	$listcategory = "";
	foreach( $termdatas as $termdata ){
		if($termdata->term_id == $term->term_id)
			$listcategory .= ' <li><a href="'.get_term_link($termdata).'" rel="'.$termdata->slug.'" class="active">'.$termdata->name.'</a></li>';
		else
			$listcategory .= ' <li><a href="'.get_term_link($termdata).'" rel="'.$termdata->slug.'">'.$termdata->name.'</a></li>';
	}

	$additionalfilter = Array();
	if($term!=""){
		$additionalfilter[] =array(
		                              'taxonomy' => "resource_for",
		                              'field' => 'slug',
		                              'terms' => explode(",",$term->slug),
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
						              <li><a href="'.get_permalink(get_field("resources_page","option")).'">All</a></li>
              						  '.$listcategory.'
						            </ul>
						          </div>
						          <div class="toggle-filter-inside d-block d-lg-none">
						            <a data-toggle="collapse" class="collapsed" href="#filter-type" role="button">Type <span class="toggle-plus"></span><span class="toggle-minus"></span></a>
						          </div>
						          <div class="filter-checkbox collapse" id="filter-type">
							            <h6>Type <a class="resourcetypeca clearall" style="display:none;">Clear All</a></h6>
						            '.$htmltype.'
						          </div>
						          <div class="toggle-filter-inside d-block d-lg-none">
						            <a data-toggle="collapse" class="collapsed" href="#filter-surgical-tables" role="button">Surgical Tables <span class="toggle-plus"></span><span class="toggle-minus"></span></a>
						          </div>
						          <div class="filter-checkbox collapse" id="filter-surgical-tables">
						            <h6>Surgical Tables <a class="resourcesurgicalca clearall" style="display:none;">Clear All</a></h6>
						            '.$htmlsurgical.'
						          </div>
						          <div class="toggle-filter-inside d-block d-lg-none">
						            <a data-toggle="collapse" class="collapsed" href="#filter-other" role="button">Other Products <span class="toggle-plus"></span><span class="toggle-minus"></span></a>
						          </div>
						          <div class="filter-checkbox collapse" id="filter-other">
						            <h6>Other Products <a class="resourceotherca clearall" style="display:none;">Clear All</a></h6>
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


	echo $contentHTML;
?>

		</main><!-- #main -->
	</div><!-- #primary -->
<?php
get_footer();
