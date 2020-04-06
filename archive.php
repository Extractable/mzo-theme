<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package mizuho
 */

get_header();

$postnews = get_option( 'page_for_posts' );
$posttitle = get_the_title($postnews);
$postlink = get_permalink($postnews);

$term = get_queried_object();


?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<section class="top-breadcrumb">
			  <div class="container">
			    <div class="row">
			      <div class="col-12">
			        <span class="d-none d-md-inline-block"><a href="#">Home</a> /</span> <span class="d-inline-flex align-items-center d-md-none"><a href="#"><i class="fas fa-angle-right mr-2"></i><span class="d-none">breadcrumb</span></a></span><a href="<?php echo $postlink;?>"><?php echo $posttitle;?></a>
			      </div>
			    </div>
			  </div>
			</section>
			<section class="default-banner">
			  <div class="container">
			    <div class="row">
			      <div class="col-md-6 text-white py-5">
			        <h2><?php echo single_cat_title( '', false );?></h2>
			        <h6><?php echo get_the_archive_description();?></h6>
			      </div>
			    </div>
			  </div>
			</section>			
			<section class="filtered-content section-padding">
			  <div class="container">
			    <div class="row">
			      <div class="col-lg-3 filter-area">
			        <div class="toggle-filter d-block d-lg-none">
			          <a data-toggle="collapse" class="collapsed" href="#filter-toggle" role="button">Filter by <span class="toggle-plus"></span><span class="toggle-minus" style="display: none;"></span></a>
			        </div>
			        <div class="collapse" id="filter-toggle">
			          <h5 class="mb-4 d-none d-lg-block">Filter by</h5>
			          <div class="toggle-filter-inside d-block d-lg-none">
			            <a data-toggle="collapse" class="collapsed" href="#filter-toggle-category" role="button">Type of News <span class="toggle-plus"></span><span class="toggle-minus"></span></a>
			          </div>
			          <div class="filter-list collapse" id="filter-toggle-category">
			            <h6>Type of News</h6>
			            <ul class="no-bullets">
			              <?php
							$args = array(
							    'hide_empty'      => true,
							);
							$categories = get_categories($args);
							$listcat = '';
							$active=0;
							foreach ( $categories as $category ) {
								if($term->term_id == $category->term_id){
									$active=1;
							    	$listcat .= '<li><a href="'.get_category_link( $category->term_id ).'" class="active">'.$category->name.'</a></li>';
								}
								else{

							    	$listcat .= '<li><a href="'.get_category_link( $category->term_id ).'">'.$category->name.'</a></li>';
								}
							}			
							if($active==1){
								$listcat = '<li><a href="'.$postlink.'">All</a></li>'.$listcat;
							}		
							else{
								$listcat = '<li><a href="'.$postlink.'" class="active">All</a></li>'.$listcat;
							}				
							echo $listcat;
			              ?>
			            </ul>
			          </div>

			          <!--<div class="d-block d-lg-none">
			            <a href="#" class="btn btn-primary my-2 w-100">Done</a>
			            <a href="#" class="btn btn-light bg-white mb-4 w-100">Reset</a>
			          </div>//-->
			        </div>
			      </div>
			      <div class="col-lg-1"></div>
			      <div class="col-lg-8">
			        <div class="archive-search mb-4">
			          <form action="" method="get" class="search-form py-2">
			            <div class="form-group row align-items-center no-gutters">
			              <label for="inputSearch" class="col-md-2 col-form-label">Search</label>
			              <div class="col-md-7 mt-4 mt-md-0">
			                <div class="input-group">
			                  <input type="text" class="form-control" id="inputSearch" name="search" placeholder="Search" value="<?php echo @$_GET["s"];?>">
			                  <div class="input-group-append">
			                    <button type="submit">
			                      <i class="fa fa-search"></i>
			                      <span class="d-none">Search</span>
			                    </button>
			                  </div>
			                </div>
			              </div>
			            </div>
			          </form>
			          <!--<h6>99 results for <strong>“Jackson Table”</strong></h6>//-->
			          <?php
			          	if(@$_GET["search"]!=""){
			          		echo '<h6>search results for <strong>“'.$_GET["search"].'”</strong></h6>';
			          	}
			          ?>
			        </div>
			        <?php
			        	if(@$_GET["search"]!=""){
							$args = array(
								'post_type' => 'post',
								'category_name' => $term->name,
								's' => @$_GET["search"]
							);  
						}
			        	else{
							$args = array(
								'post_type' => 'post',
								'category_name' => $term->name
							);  
			        	}
			        	query_posts($args);
						// The Loop
						while ( have_posts() ) : the_post();
							$link = get_permalink();
							echo '
							        <div class="search-result">
							          <p class="date eyebrow">'.get_the_date("F d, Y").'</p>
							          <h6><a href="'.$link.'">'.$post->post_title.'</a></h6>
							          '.wpautop(get_the_excerpt()).'
							          <a href="'.$link.'">'.$link.'</a>
							        </div>							
								 ';
						endwhile;
						 
						wp_pagenavi();

						// Reset Query
						wp_reset_query();
			        ?>

			      </div>
			    </div>
			  </div>
			</section>			

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
