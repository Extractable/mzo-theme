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
$class_promo_text = wpautop(do_shortcode(get_field('class_promo_text', 'option')));
$postnews = get_field( 'class_page', 'option' );
$posttitle = get_the_title($postnews);
$postlink = get_permalink($postnews);

$form_title = get_field('form_title', 'option');
$form_sub_title = get_field('form_sub_title', 'option');
$form_content = get_field('form_content', 'option');

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
$class_desc = get_field('class_desc', $term);
$class_sub_desc = get_field('class_sub_desc', $term);
$button_text = get_field('button_text', $term);
$button_url = get_field('button_url', $term);
if($button_url=="")
	$button_url = "#";

if($header_title)
	$header_title = '<h2 class="text-white mb-2 mb-md-4">'.$header_title.'</h2>';
if($header_sub_title)
	$header_sub_title = '<h6 class="text-white mb-2 mb-md-4">'.$header_sub_title.'</h6>';



$termdatas = get_terms( array( 'taxonomy' => 'class_for', 'hide_empty' => false ) );
$listcategory = "";
foreach( $termdatas as $termdata ){
	if($term->slug==$termdata->slug){
		$listcategory .= ' <li><a href="'.get_term_link($termdata).'" rel="'.$termdata->slug.'" class="active">'.$termdata->name.'</a></li>';
	}
	else{
		$listcategory .= ' <li><a href="'.get_term_link($termdata).'" rel="'.$termdata->slug.'">'.$termdata->name.'</a></li>';
	}
}

$additionalfilter = Array();
$category = @$_REQUEST["cat"];
if($term!=""){
	$additionalfilter[] =array(
	                              'taxonomy' => "class_for",
	                              'field' => 'slug',
	                              'terms' => explode(",",$term->slug),
	                              'operator' => 'IN',
	                          );
}
else{
	$additionalfilter[] =array(
	                              'taxonomy' => "class_for",
	                              'field' => 'slug',
	                              'terms' => explode(",",$term->name),
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
if(@$class_other_product!=""){
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
$args = array(
				'posts_per_page' => 6 * $pg,
				'post_type' => 'class',
				'tax_query' => array(
				    'relation' => 'AND',
				    $additionalfilter
				),
			 );


$termdatas = get_terms( array( 'taxonomy' => 'class_class', 'hide_empty' => false ) );
$htmlclass = "";
foreach( $termdatas as $termdata ){
	$htmlclass    .= '
		              <div class="custom-control custom-checkbox">
		                <input type="checkbox" class="custom-control-input" id="classclass_'.$termdata->slug.'" name="classclass_'.$termdata->slug.'" rel="classclass" value="'.$termdata->slug.'">
		                <label class="custom-control-label" for="classclass_'.$termdata->slug.'">'.$termdata->name.'</label>
		              </div>
		             ';
}
$termdatas = get_terms( array( 'taxonomy' => 'class_product', 'hide_empty' => false ) );
$htmlproduct = "";
foreach( $termdatas as $termdata ){
	$htmlproduct.= '
		              <div class="custom-control custom-checkbox">
		                <input type="checkbox" class="custom-control-input" id="classproduct_'.$termdata->slug.'" name="classproduct_'.$termdata->slug.'" rel="classproduct" value="'.$termdata->slug.'">
		                <label class="custom-control-label" for="classproduct_'.$termdata->slug.'">'.$termdata->name.'</label>
		              </div>
		           ';
}
$termdatas = get_terms( array( 'taxonomy' => 'class_type', 'hide_empty' => false ) );
$htmltype = "";
foreach( $termdatas as $termdata ){
	$htmltype .= '
	              <div class="custom-control custom-checkbox">
	                <input type="checkbox" class="custom-control-input" id="classtype_'.$termdata->slug.'" name="classtype_'.$termdata->slug.'" rel="classtype" value="'.$termdata->slug.'">
	                <label class="custom-control-label" for="classtype_'.$termdata->slug.'">'.$termdata->name.'</label>
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
    $countertemp = 0;
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
        $datas = get_field("data");
        $contentdata = '';

        $countertemp=$countertemp+1;
		//$queryURL = parse_url( html_entity_decode( esc_url( add_query_arg( $arr_params ) ) ) );
		//parse_str( $queryURL['query'], $getVar );
		$classTitle = get_field("class_title");
		//echo 'Describe yourself: ' . $variableNum1 . '. What do you like most about PHP? ' . $variableNum2;
        foreach($datas as $data){
        	$class = "";
        	$text = "REGISTER";
        	if($data["status"]=="full"){
        		$class = "disabled";
        		$text = "Class Full";
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
		if( $download_brochure_link ) {
			$buttonhtml .= '<div class="download-link my-2 d-none d-md-block"><a href="'.$download_brochure_link.'" class="text-link-arrow">Download the Brochure <i class="fas fa-angle-right ml-2"></i></a></div>';
		}else {
			$buttonhtml .= '<div class="download-link my-2 d-none d-md-block"></div>';
		}

		if($contentdata) {
			$buttonhtml .= '<button type="button" data-toggle="collapse" data-target="#classdata'.$countertemp.'" aria-expanded="false" aria-controls="classdata'.$countertemp.'" class="collapsed">View Dates <i class="fas fa-plus ml-2"></i><i class="fas fa-minus ml-2"></i></button>';
		}else {
			$buttonhtml .= '<button type="button" class="disabled" disabled>Classes Full</button>';
		}

		/*
        if($download_brochure_link && $contentdata){
        	$buttonhtml = '
                <div class="download-link my-2 d-none d-md-block"><a href="'.$download_brochure_link.'" class="text-link-arrow">Download the Brochure <i class="fas fa-angle-right ml-2"></i></a></div>
                <button type="button" data-toggle="collapse" data-target="#classdata'.$countertemp.'" aria-expanded="false" aria-controls="classdata'.$countertemp.'" class="collapsed">View Dates <i class="fas fa-plus ml-2"></i><i class="fas fa-minus ml-2"></i></button>
		    ';
        }elseif($download_brochure_link) {
			$buttonhtml = '
				<div class="download-link my-2 d-none d-md-block"><a href="'.$download_brochure_link.'" class="text-link-arrow">Download the Brochure <i class="fas fa-angle-right ml-2"></i></a></div>
			';
		}elseif($contentdata) {
			$buttonhtml = '
                <div class="download-link my-2 d-none d-md-block"></div>
                <button type="button" data-toggle="collapse" data-target="#classdata'.$countertemp.'" aria-expanded="false" aria-controls="classdata'.$countertemp.'" class="collapsed">View Dates <i class="fas fa-plus ml-2"></i><i class="fas fa-minus ml-2"></i></button>
		    ';
		}
		*/
		/*
        else if($register_link && count($datas)<1){
        	$buttonhtml = '
                <div class="download-link my-2"></div>
                <a href="'.$register_link.'" class="button" target="_blank">Register</a>
		    ';
        }
		*/

        $skuhtml = '';
        if($sku){
        	$skuhtml = '<p class="class-id">'.$sku.'</p>';
        }
        $pricehtml = '';
        if($price){
        	$pricehtml = '<h6>'.$price.'</h6>';
        }
         $listp.= '
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
			          <div class="class-toggle collapse" id="classdata'.$countertemp.'">
			            <div class="d-flex justify-content-end mb-n3 mx-n4">
			              <a href="#" data-toggle="collapse" data-target="#classdata'.$countertemp.'" aria-expanded="true" aria-controls="classdata'.$countertemp.'">
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
wp_reset_postdata();
$stylesmp = "";
if($shownav){
	$stylesmp = "display:block;";
}
else{
	$stylesmp = "display:none;";
}
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<!-- breadcrumb -->
			<section class="top-breadcrumb">
			  <div class="container">
			    <div class="row">
			      <div class="col-12">
			        <span class="d-none d-md-inline-block"><a href="<?php echo get_option("siteurl");?>">Home</a> /</span> <span class="d-inline-flex align-items-center d-md-none"><a href="#"><i class="fas fa-angle-right mr-2"></i><span class="d-none">breadcrumb</span></a></span><a href="<?php echo $postlink;?>"><?php echo $posttitle;?></a> <span class="d-none d-md-inline-block" style="padding-right: 5px;">/</span><span class="d-inline-block d-md-none" style="padding-right: 5px;"></span><span class="d-inline-flex align-items-center d-md-none"><a href="#"><i class="fas fa-angle-right mr-2"></i><span class="d-none">breadcrumb</span></a></span><a href="<?php echo get_term_link($term);?>"><?php echo $term->name;?></a>
			      </div>
			    </div>
			  </div>
			</section>
			<!-- Hero -->
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

			<section class="class-details section-padding classdata">
			  <div class="container">
			    <div class="row">
			      <div class="col-lg-3 filter-area">
			        <div class="toggle-filter d-block d-lg-none">
			          <a data-toggle="collapse" class="collapsed" data-target="#filter-toggle" role="button">Upcoming Classes <span class="toggle-plus"></span><span class="toggle-minus" style="display: none;"></span></a>
			        </div>
			        <div class="collapse" id="filter-toggle">
			          <h5 class="mb-4 d-none d-lg-block">Upcoming Classes</h5>
			          <div class="toggle-filter-inside d-block d-lg-none">
			            <a data-toggle="collapse" class="collapsed" data-target="#filter-toggle-category" role="button">For <span class="toggle-plus"></span><span class="toggle-minus"></span></a>
			          </div>
			          <div class="filter-list collapse" id="filter-toggle-category">
			            <h6>For</h6>
			            <ul class="no-bullets">
			            	<?php echo $listcategory;?>
			            </ul>
			          </div>
			          <div class="toggle-filter-inside d-block d-lg-none">
			            <a data-toggle="collapse" class="collapsed" data-target="#filter-class" role="button">Class <span class="toggle-plus"></span><span class="toggle-minus"></span></a>
			          </div>
			          <div class="filter-checkbox collapse" id="filter-class">
			            <h6>Class <a class="classclassca clearall" style="display:none;">Clear All</a></h6>
			            <?php echo $htmlclass;?>
			          </div>
			          <div class="toggle-filter-inside d-block d-lg-none">
			            <a data-toggle="collapse" class="collapsed" data-target="#filter-product" role="button">Product <span class="toggle-plus"></span><span class="toggle-minus"></span></a>
			          </div>
			          <div class="filter-checkbox collapse" id="filter-product">
			            <h6>Product <a class="classproductca clearall" style="display:none;">Clear All</a></h6>
			            <?php echo $htmlproduct;?>
			          </div>
			          <div class="toggle-filter-inside d-block d-lg-none">
			            <a data-toggle="collapse" class="collapsed" data-target="#filter-type" role="button">Type <span class="toggle-plus"></span><span class="toggle-minus"></span></a>
			          </div>
			          <div class="filter-checkbox collapse" id="filter-type">
			            <h6>Type <a class="classtypeca clearall" style="display:none;">Clear All</a></h6>
			            <?php echo $htmltype;?>
			          </div>
			          <div class="d-block d-lg-none">
			            <a href="#" class="btn btn-primary my-2 w-100">Done</a>
			            <a href="#" class="btn btn-light bg-white mb-4 w-100 btnreset">Reset</a>
			          </div>
			        </div>
			      </div>
			      <div class="col-lg-9">
			        <?php echo $class_promo_text;?>
					<?php if( $class_desc) : ?>
						<div class="class-desc">
							<?php echo $class_desc;?>
						</div>
					<?php endif; ?>
			        <div class="classloaddata">
			        <?php echo $listp;?>
			    	</div>
					<div style="width: 100%;">
						<input type="hidden" name="cat" class="field_cat" value="">
						<input type="hidden" name="class_class" class="field_class_class" value="">
						<input type="hidden" name="class_product" class="field_class_product" value="">
						<input type="hidden" name="class_type" class="field_class_type" value="">
						<input type="hidden" name="pg" class="field_pg" value="<?php echo $pg;?>">
						<div class="loadingpageclass"></div>
						<div class="product-class-more showmoreclass" style="<?php echo $stylesmp;?>">
						  <button id="myBtn">Show More <i class="fas fa-plus"></i></button>
						</div>
					</div>
					<?php if( $class_sub_desc) : ?>
						<div class="class-sub-desc">
							<?php echo $class_sub_desc;?>
						</div>
					<?php endif; ?>
			      </div>
			    </div>
			  </div>
			</section>

			<section class="contact-us section-padding">
			  <div class="container">
			    <div class="row">
			      <div class="col-lg-8 mx-auto text-center">
			        <?php
			        	if($form_title){
			        		echo '<h2>'.$form_title.'</h2>';
			        	}
			        	if($form_sub_title){
			        		echo '<h6 class="px-md-3">'.$form_sub_title.'</h6>';
			        	}
			        ?>
			      </div>
			    </div>
			    <div class="row mt-4">
			      <div class="col-lg-8 mx-auto">
			      	<?php echo do_shortcode($form_content);?>
			      </div>
			    </div>
			  </div>
			</section>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
