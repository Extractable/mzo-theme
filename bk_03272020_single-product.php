<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package mizuho
 */

get_header();

global $post;
$themeurl = get_stylesheet_directory_uri();
$term = get_primary_taxonomy_term();
$title = $post->post_title;
$sub_title = get_field("sub_title");
$background_image = get_sub_field("background_image");
if($background_image){
  $background_image = 'background-image:url('.$background_image.');';
}

$form_title = get_field('form_title', 'option');
$form_sub_title = get_field('form_sub_title', 'option');
$form_content = get_field('form_content', 'option');
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();
			$layout_type = get_field("layout_type");
			$component_description = get_field("component_description");
			$product_media = get_field("product_media");
			$tabs = get_field("tabs");
			$content = get_field("content");

			get_template_part("template-parts/product",$layout_type);
			?>
			<?php
		endwhile; // End of the loop.
		?>

      	<?php

			if( have_rows('content') ):
			    while ( have_rows('content') ) : the_row();
			    	get_template_part("template-parts/flexible/content", get_row_layout());
			    endwhile;
			endif;
			$accessories_list = get_field("accessories_list");
			if(count($accessories_list)>0){
				$args = array(
								'posts_per_page' => -1,
								'post_type' => 'product',
								'post__in' => $accessories_list,
                                'orderby' => 'post__in'
							 );
			}
			else{
				$args = array(
								'posts_per_page' => -1,
								'post_type' => 'product',
								'tax_query' => array(
								    'relation' => 'AND',
								    array(
								        'taxonomy' => "product_cat",
								        'field' => 'id',
								        'terms' => array(76),
								        'operator' => 'IN',
								    )
								),
							 );
			}
			global $post;
		    $query = new WP_Query( $args );
		    $total = $query->found_posts;
		    if ( $query->have_posts() ) {
		    	$counter = 1;
		    	$accessories1 = '';
		    	$accessories2 = '';
		        while ( $query->have_posts() ) {
		            $query->the_post();
					$featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');
					if($featured_img_url == "")
						$featured_img_url = get_stylesheet_directory_uri()."/images/placeholder-560x560.png";
      				$sku = get_post_meta($post->ID,"_sku",true);
      				$permalink = get_permalink();
					$qterms = get_the_terms( $post->ID, 'product_cat' );
                    $showLink = get_field('show_link', $post->ID);
					$listterm = '';
					foreach ($qterms as $qterm) {
					    $listterm = $listterm." ".$qterm->slug;
					}
      				//if($counter<4){
			            $accessories1 .= '
									        <div class="col-12 col-md-6 col-lg-4 load-card">
                                                <div class="accessories-card '.$listterm.'">
                                                    <div>
    									                <img src="'.$featured_img_url.'" alt="'.$post->post_title.'" class="img-fluid">
    									                <div class="text-area">
            									            <p class="eyebrow">Part #'.$sku.'</p>
            									            <p class="title">'.$post->post_title.'</p>
            									            <p class="small">'.get_the_excerpt().'</p>';
                                                            if($showLink) {
            			$accessories1 .=					'<p class="link"><a href="'.$permalink.'">Learn More <i class="fas fa-angle-right ml-2"></i></a></p>';
                                                            }
                        $accessories1 .= '
        									            </div>
                                                  </div>
    									        </div>
                                            </div>
			            				 ';
      				//}
      				/*else{
			            $accessories2 .= '
									        <div class="accessories-card '.$listterm.'">
									          <img src="'.$featured_img_url.'" alt="'.$post->post_title.'" class="img-fluid">
									          <div class="text-area">
									            <p class="eyebrow">Part #'.$sku.'</p>
									            <p class="title">'.$post->post_title.'</p>
									            <p class="small">'.$sub_title.'</p>
									            <p class="link"><a href="'.$permalink.'">Learn More <i class="fas fa-angle-right ml-2"></i></a></p>
									          </div>
									        </div>
			            				 ';
      				}*/
		            $counter++;
		        }
		    }
		    wp_reset_postdata();
      	?>
        <!-- Accessories -->
		<section class="accessorie-cards section-padding">
		  <div class="container">
		    <div class="row">
		      <div class="col-md-12">
		        <h3>Accessories</h3>
		      </div>
		    </div>
            <div class="row mt-4 accessories-cards">
                <?php echo $accessories1;?>
            </div>
            <div class="row">
                <div class="show-more">
                    <button type="button" id="loadMore">Show More <i class='fas fa-plus'></i></button>
                </div>
            </div>
		  </div>
		</section>
        <!-- /Accessories -->

		<?php
		$resources_title = get_field("resources_title");
		$resources_list = get_field("resources_list");
		if($resources_title){
		?>
		<section class="resources-icons">
		  <div class="container">
		    <div class="row">
		      <div class="col-12">
		        <h3><?php echo $resources_title;?></h3>
		      </div>
		      <div class="col-12 mt-4">
		        <div class="row">
		          <?php
		          	foreach($resources_list as $rlist){
		          		if($rlist["url"]==""){
		          			$rlist["url"] = "#";
		          		}
		          		if($rlist["icon"]){
		          			$rlist["icon"] = '<a href="'.$rlist["url"].'"><img src="'.$rlist["icon"].'" alt="'.$rlist["title"].'" /></a>';
		          		}
		          		echo '
					          <div class="col-lg-4 col-md-6">
					            <div class="row resources">
					              <div class="col-2 col-md-3 px-0">
					                '.$rlist["icon"].'
					              </div>
					              <div class="col-10 col-md-9">
					                <p><a href="'.$rlist["url"].'">'.$rlist["title"].'</a></p>
					              </div>
					            </div>
					          </div>
		          			 ';
		          	}
		          ?>
		        </div>
		      </div>
		    </div>
		  </div>
		</section>
		<?php
		}
		?>
        <!-- Related Products -->
		<section class="related-product-cards">
		  <div class="container">
		    <div class="row">
		      <div class="col-12">
		        <h3>Related Products</h3>
		      </div>
		    </div>
		    <div class="row mt-4 related-cards">
                <?php
                if(get_post_type()=="post"){
                    $related = get_posts( array( 'category__in' => wp_get_post_categories($post->ID), 'numberposts' => 3, 'post__not_in' => array($post->ID) ) );
                }
                if(get_post_type()=="product"){

                    global $product;
                    $cross_sell_ids = $product->get_cross_sell_ids();
                    if(count($cross_sell_ids)>0){
                        $args = array(
                                        'posts_per_page' => 12,
                                        'post_type' => 'product',
                                        'post__in' => $cross_sell_ids
                                     );
                        $related = get_posts(
                            array(
                                'post_type' => 'product',
                                'numberposts' => 3,
                                'post__in' => $cross_sell_ids
                            )
                        );
                    }
                    else{
                        $curcat = get_primary_taxonomy_term($post->ID,"product_cat");
                        $related = get_posts(
                            array(
                                'post_type' => 'product',
                                'numberposts' => 3,
                                'post__not_in' => array($post->ID),
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => "product_cat",
                                        'field' => 'slug',
                                        'terms' => array($curcat["slug"]),
                                        'operator' => 'IN',
                                    )
                                 )
                            )
                        );
                    }
                }
                if( $related ) {
                    foreach( $related as $post ) {
                        setup_postdata($post);
                        $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');
                        $sub_title = get_field("sub_title");
                        if(get_post_type()=="product"){
                            $sku = get_post_meta($post->ID,"_sku",true);
                            $sub_title = '<p class="eyebrow">Part #'.$sku.'</p>';
                            $description = '<p class="small">'.get_the_excerpt().'</p>';
                            $link = '<p class="link"><a href="'.get_permalink().'">Learn More <i class="fas fa-angle-right ml-2"></i></a></p>';
                        }
                        else{
                            $sub_title = '<p class="eyebrow text-uppercase">'.$sub_title.'</p>';
                            $description = '<p class="desc d-block d-md-none">'.get_the_excerpt().'</p>';
                            $link = '<p class="link"><a href="'.$term["url"].'">'.$term["title"].'</a></p>';
                        }
                        if($featured_img_url == "")
                            $featured_img_url = get_stylesheet_directory_uri()."/images/related_products_productname_hero1.jpg";
                        $term = get_primary_taxonomy_term();
                        echo '
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="related-card">
                                      <div>
                                      <img src="'.$featured_img_url.'" alt="'.$post->post_title.'" class="img-fluid">
                                      <div class="text-area">
                                        '.$sub_title.'
                                        <p class="title">'.$post->post_title.'</p>
                                        '.$description.'
                                        '.$link.'
                                      </div>
                                      </div>
                                    </div>
                                </div>
                             ';
                    }
                }
                wp_reset_postdata();
                ?>
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
