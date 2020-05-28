<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package mizuho
 */

get_header();

$search = @$_GET["s"];
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<section class="top-breadcrumb">
		  <div class="container">
		    <div class="row">
		      <div class="col-12">
		        <span class="d-none d-md-inline-block"><a href="<?php echo get_option("siteurl");?>">Home</a> /</span> <span class="d-inline-flex align-items-center d-md-none"><a href="#"><i class="fas fa-angle-right mr-2"></i><span class="d-none">breadcrumb</span></a></span><a href="#">Search</a>
		      </div>
		    </div>
		  </div>
		</section>

		<section class="search-banner default-banner">
		  <div class="container">
		    <div class="row">
		      <div class="col-12 mx-auto text-white pt-4 pb-5 py-md-4">
		        <form action="" method="get" class="search-form py-2">
		          <div class="form-group row align-items-center no-gutters">
		            <label for="inputSearch" class="col-md-3 col-form-label">Search</label>
		            <div class="col-md-9 mt-4 mt-md-0">
		              <div class="input-group">
		                <input type="text" class="form-control" id="inputSearch" name="s" placeholder="Search" value="<?php echo $search;?>">
		                <div class="input-group-append">
		                  <button type="submit" class="searchbtn">
		                    <i class="fa fa-search"></i>
		                    <span class="d-none">Search</span>
		                  </button>
		                </div>
		              </div>
					  <div class="banner-search-error">
					  	Please enter a search term
					  </div>
		            </div>
		          </div>
		        </form>
		        <?php
		        	$paged = $GLOBALS['wp_query']->query_vars["paged"];
		        	if($paged==0)
		        		$paged = 1;
		        	$pagestart = 1;
		        	if($paged>1)
		        		$pagestart = (10*($paged-1))+1;

		        	$foundposts = $GLOBALS['wp_query']->found_posts;

		        	if ( have_posts() ) {
		        		$totalposts = ($paged*10);
		        		if($totalposts>$foundposts)
		        			$totalposts = $foundposts;
		        		echo '<h6>'.$pagestart.'-'.$totalposts.' of '.$foundposts.' results for <strong>“'.$search.'”</strong></h6>';
		        	}
		        ?>

		      </div>
		    </div>
		  </div>
		</section>
		<?php if ( have_posts() ) : ?>

		<section class="search-results">
		  <div class="container">
		    <div class="row">
		      <div class="col-12">
			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();
				$link = get_permalink();
				$title = str_replace($search,"<strong>".$search."</strong>",$post->post_title);
				$excerpt = str_replace($search,"<strong>".$search."</strong>",wpautop(get_the_excerpt()));
				$search = ucfirst($search);
				$title = str_replace($search,"<strong>".$search."</strong>",$title);
				$excerpt = str_replace($search,"<strong>".$search."</strong>",$excerpt);
				$search = strtoupper($search);
				$title = str_replace($search,"<strong>".$search."</strong>",$title);
				$excerpt = str_replace($search,"<strong>".$search."</strong>",$excerpt);
				$search = strtolower($search);
				$title = str_replace($search,"<strong>".$search."</strong>",$title);
				$excerpt = str_replace($search,"<strong>".$search."</strong>",$excerpt);

				$posttype = get_post_type();
				if($posttype=="class"){
        			$classfor = get_primary_taxonomy_term($post->ID, "class_for");
        			$link = $classfor["url"];
				}

				$excerpt = str_replace('[...]','',$excerpt);
				echo '
				        <div class="search-result">
				          <p class="date eyebrow">'.get_the_date("F d, Y").'</p>
				          <h6><a href="'.$link.'">'.$title.'</a></h6>
				          '.$excerpt.'
				          <a href="'.$link.'">'.$link.'</a>
				        </div>
					 ';
			endwhile;

			wp_pagenavi();

		else :
			?>
			<section class="search-results">
			  <div class="container">
			    <div class="row">
			      <div class="col-12 text-center mt-5 mb-5">
			      <div class="mt-5 mb-5">
			      		<h3>Nothing Found</h3>
			      		<p>Sorry, but nothing matched your search terms. Please try again with some different keywords.</p>
			      </div>
			      </div>
			    </div>
			  </div>
			</section>
			<?php
		endif;
		?>
		      </div>
		    </div>
		  </div>
		</section>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
