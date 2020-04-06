<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
//do_action( 'woocommerce_before_main_content' );
$themeurl = get_stylesheet_directory_uri();
$term = get_queried_object();

$form_title = get_field('form_title', 'option');
$form_sub_title = get_field('form_sub_title', 'option');
$form_content = get_field('form_content', 'option');

$background_image = get_field('background_image', $term->taxonomy . '_' . $term->term_id);
if($background_image=="")
  $background_image = $themeurl.'/images/product_marquee_hero2.jpg';
$background_image = 'background-image:url('.$background_image.');';
$header_sub_title_top = get_field('header_sub_title_top', $term->taxonomy . '_' . $term->term_id);
$header_title = get_field('header_title', $term->taxonomy . '_' . $term->term_id);
if($header_title==""){
  $header_title = $term->name;
}
$header_title_text = $header_title;

$header_sub_title = get_field('header_sub_title', $term->taxonomy . '_' . $term->term_id);
if($header_sub_title){
  $header_sub_titl = term_description();
}
$button_text = get_field('button_text', $term->taxonomy . '_' . $term->term_id);
$button_url = get_field('button_url', $term->taxonomy . '_' . $term->term_id);
if($button_url=="")
	$button_url = "#";

if($header_sub_title_top)
	$header_sub_title_top = '<p class="eyebrow text-white text-uppercase">'.$header_sub_title_top.'</p>';
if($header_title_text)
	$header_title_text = '<h2 class="text-white mb-2 mb-md-4">'.$header_title_text.'</h2>';
if($header_sub_title)
	$header_sub_title = '<h6 class="text-white mb-2 mb-md-4">'.$header_sub_title.'</h6>';
if($button_text)
	$button_text = '<a href="'.$button_text.'" class="btn btn-light my-2 my-md-3">'.$button_text.'</a>';
?>
<section class="product-marquee">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6 px-0 product-marquee-media-area" style="<?php echo $background_image;?>">
      </div>
      <div class="col-md-6 text-white product-marquee-text-area">
        <div class="fix-container-position">
          <?php echo $header_sub_title_top.$header_title_text.$header_sub_title.$button_text;?>
        </div>
      </div>
    </div>
  </div>
</section>
<?php

$term = get_queried_object();

if($term->parent==0){
?>

<section class="one-third-product-card section-padding">
  <div class="container">
    <div class="row no-gutters">
      <div class="col-12 one-third-products">
      	<?php
      		$termdatas = get_terms( array( 'taxonomy' => 'product_cat', 'hide_empty' => false, 'parent' => $term->term_id ) );
      		foreach( $termdatas as $termdata ){
      			$thumbnail_id = get_woocommerce_term_meta($termdata->term_id, 'thumbnail_id', true);
      			$image = wp_get_attachment_url($thumbnail_id);
      			$termlink = get_term_link($termdata->name, "product_cat");
      			echo '
				        <div class="one-third-product productlistdata">
				          <a href="'.$termlink.'">
				            <img src="'.$image.'" class="img-fluid" alt="one third product 1">
				            <div class="one-third-product-label">
				              <h5>'.$termdata->name.'</h5>
				              <p>'.$termdata->description.'</p>
				              <a href="'.$termlink.'" class="label-link">Learn More <i class="fas fa-angle-right ml-1"></i></a>
				            </div>
				          </a>
				        </div>
      				 ';
      		}
      	?>


      </div>
    </div>
  </div>
</section>
<?php
}

else{

  $termdatas = get_terms( array( 'taxonomy' => 'product_cat', 'hide_empty' => false, 'parent' => $term->parent ) );
  $listcategory = "";
  foreach( $termdatas as $termdata ){
    if($termdata->term_id == $term->term_id)
      $listcategory .= ' <li><a href="'.get_term_link($termdata).'" rel="'.$termdata->slug.'" class="active">'.$termdata->name.'</a></li>';
    else
      $listcategory .= ' <li><a href="'.get_term_link($termdata).'" rel="'.$termdata->slug.'">'.$termdata->name.'</a></li>';
  }

  $additionalfilter = Array();
  $category = @$_REQUEST["cat"];
  if($category==""){
    $category = $term->slug;
  }
  $workswith = @$_REQUEST["workswith"];
  if($workswith!=""){
    $additionalfilter[] =array(
                                  'taxonomy' => "workswith",
                                  'field' => 'slug',
                                  'terms' => explode(",",$workswith),
                                  'operator' => 'IN',
                              );
  }
  $features = @$_REQUEST["features"];
  if($features!=""){
    $additionalfilter[] =array(
                                  'taxonomy' => "features",
                                  'field' => 'slug',
                                  'terms' => explode(",",$features),
                                  'operator' => 'IN',
                              );
  }
  $anatomy = @$_REQUEST["anatomy"];
  if($anatomy!=""){
    $additionalfilter[] =array(
                                  'taxonomy' => "anatomy",
                                  'field' => 'slug',
                                  'terms' => explode(",",$anatomy),
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
    'posts_per_page' => 12 * $pg,
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



  $filters = get_field("filters", $term->taxonomy . '_' . $term->term_id);
  if($filters == ""){
    $filters = get_field("filters", $term->taxonomy . '_' . $term->parent);
  }
  $filterlist = Array();
  if($filters!=""){
    $filterlist = explode(PHP_EOL, $filters);
    for($counter=0;$counter<count($filterlist);$counter++){
      $filterlist[$counter] = trim($filterlist[$counter]);
    }
  }
  $filterterm = Array();

  if(count($filterlist)>0){
    $argstemp = array(
      'posts_per_page' =>-1,
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
    global $post;
    $querytemp = new WP_Query( $argstemp );
    if ( $querytemp->have_posts() ) {
      while ( $querytemp->have_posts() ) {
        $querytemp->the_post();
        foreach($filterlist as $filterl){
          $term_list = wp_get_post_terms( $post->ID, $filterl, array( 'fields' => 'all' ) );
          foreach($term_list as $termlist){
            $filterterm[$filterl][$termlist->term_id] = $termlist;
          }
        }
      }
    }
  }

  //once we get the termlist for all the post, later we will use that as filter data.

?>
<section class="one-third-filtered-product-card section-padding">
  <div class="container">
    <div class="row">
      <div class="col-lg-3 filter-area">
        <div class="toggle-filter d-block d-lg-none">
          <a data-toggle="collapse" class="collapsed" href="#filter-toggle" role="button">Filters <span class="toggle-plus"></span><span class="toggle-minus" style="display: none;"></span></a>
        </div>
        <div class="collapse" id="filter-toggle">
          <div class="toggle-filter-inside d-block d-lg-none">
            <a data-toggle="collapse" class="collapsed" href="#filter-toggle-category" role="button">Category <span class="toggle-plus"></span><span class="toggle-minus"></span></a>
          </div>
          <div class="category-list collapse" id="filter-toggle-category">
            <h6>Category</h6>
            <ul class="no-bullets">
              <?php echo $listcategory;?>
            </ul>
          </div>

          <?php
          if(count($filterlist)>0){
            foreach($filterlist as $filterl){
              $termlist = get_taxonomy($filterl);
              $htmlterm = '';
              foreach( $filterterm[$filterl] as $termdata ){
                $htmlterm .= '
                              <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="'.$filterl.'-'.$termdata->slug.'" name="'.$filterl.'-'.$termdata->slug.'" rel="'.$filterl.'" value="'.$termdata->slug.'">
                                <label class="custom-control-label" for="'.$filterl.'-'.$termdata->slug.'">'.$termdata->name.'</label>
                              </div>
                             ';
              }
              echo '
                    <div class="toggle-filter-inside d-block d-lg-none">
                      <a data-toggle="collapse" class="collapsed" href="#filter-toggle-'.$termlist->name.'" role="button">'.$termlist->label.' <span class="toggle-plus"></span><span class="toggle-minus"></span></a>
                    </div>
                    <div class="filter-checkbox collapse" id="filter-toggle-'.$termlist->name.'">
                      <h6>'.$termlist->label.' <a href="#" class="calist '.$termlist->name.'ca clearall" style="display:none;">Clear All</a></h6>
                      '.$htmlterm.'
                    </div>
                   ';
            }
          }
          ?>

          <div class="d-block d-lg-none">
            <a href="#" class="btn btn-primary my-2 w-100">Done</a>
            <a href="#" class="btn btn-light bg-white mb-4 w-100">Reset</a>
          </div>
        </div>
      </div>
      <div class="col-lg-9">
        <h6><strong><?php $term->name;?></strong></h6>
        <div class="row">
          <div class="col-12 one-third-products productloaddata">
            <?php
                /*$args = array('post_type' => 'product',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'product_cat',
                            'field' => 'term_id',
                            'terms' => Array($term->term_id)
                        ),
                    ),
                 );*/
                $query = new WP_Query( $args );
                $shownav = 1;
                if($query->found_posts <= $query->post_count){
                  $shownav = 0;
                }
                if ( $query->have_posts() ) {
                    $countercol = 1;
                    while ( $query->have_posts() ) {
                        $query->the_post();
                        $permalink = get_permalink();
                        $title = get_the_title();
                        $roll_over = get_field('product_rollover_text');
                        //$content = wp_trim_words(strip_tags(get_the_excerpt()), 20, "");
                        $excerpt = get_the_excerpt();
                        /* Excerpt Limit */

                        if( $roll_over ) {
                            $content = strip_tags($roll_over);
                            $content = substr($roll_over, 0, 133);
                            $content = substr($content, 0, strripos($content, " "));
                        }else {
                            $content = strip_tags($excerpt);
                            $content = substr($content, 0, 133);
                            $content = substr($content, 0, strripos($content, " "));
                        }


                        /* End Excerpt Limit */

                        $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full'); ?>

                        <div class="one-third-product productlistdata pcol<?php echo $countercol; ?>">
                            <a href="<?php echo $permalink; ?>">
                                <img src="<?php echo $featured_img_url; ?>" class="img-fluid" alt="<?php echo $post->post_title; ?>">
                            </a>
                            <div class="one-third-product-label">
                                <a href="<?php echo $permalink; ?>">
                                    <h5><?php echo $title; ?></h5>
                                    <p><?php echo $content; ?></p>
                                </a>
                                <a href="<?php echo $permalink; ?>" class="label-link">Learn More <i class="fas fa-angle-right ml-1"></i></a>
                            </div>
                        </div>
                    <?php
                        $countercol++;
                        if($countercol>=4){
                          $countercol = 1;
                        }
                    }
                }
                else{
                  echo '<p class="text-center" style="width:100%;">No Results Found</p>';
                }
                wp_reset_postdata();
            ?>
          </div>
          <div style="width: 100%;" class="fllist">
            <?php
              if(count($filterlist)>0){
                foreach($filterlist as $filterl){
                  echo '<input type="hidden" name="'.$filterl.'" rel="'.$filterl.'" class="inputfl '.$filterl.'" value="">';
                }
              }
              echo '
                    <input type="hidden" name="pg" class="field_pg" value="'.$pg.'">
                    <div class="loadingpageproduct"></div>
                   ';

              $stylesmp = "";
              if($shownav){
                $stylesmp = "display:block;";
              }
              else{
                $stylesmp = "display:none;";
              }
              echo '<div class="show-more showmoreproduct" style="'.$stylesmp.'"><button id="myBtn">Show More <i class="fas fa-plus"></i></button></div>';
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php
}
?>

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
<?php
get_footer( 'shop' );
