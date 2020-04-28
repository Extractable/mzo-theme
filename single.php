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

$posttype = get_post_type();
if($posttype=="post"){
	$term = get_primary_taxonomy_term();
}
else if($posttype=="resource"){
	$resources_page = get_field("resources_page","option");
	$term["title"] = $resources_page->post_title;
	$term["url"] = get_permalink($resources_page->ID);
}
$title = $post->post_title;
$sub_title = get_field("sub_title");
$background_image = get_field("background_image");
if($background_image){
  $background_image = 'background-image:url('.$background_image.');';
}

$form_title = get_field('form_title', 'option');
$form_sub_title = get_field('form_sub_title', 'option');
$form_content = get_field('form_content', 'option');

$hide_date = get_field("hide_date");
$hide_author = get_field("hide_author");
$hide_social = get_field("hide_social");

?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<section class="top-breadcrumb">
			  <div class="container">
			    <div class="row">
			      <div class="col-12">
			        <span class="d-none d-md-inline-block"><a href="<?php echo get_option("siteurl");?>">Home</a> /</span> <span class="d-inline-flex align-items-center d-md-none"><a href="#"><i class="fas fa-angle-right mr-2"></i><span class="d-none">breadcrumb</span></a></span><a href="<?php echo $term["url"];?>"><?php echo $term["title"];?></a>
			      </div>
			    </div>
			  </div>
			</section>

			<section class="article-page-banner default-banner section-padding" style="<?php echo $background_color.$background_image;?>">
			  <div class="container">
			    <div class="row">
			      <div class="col-lg-8 mx-auto text-white py-3 py-md-5 px-3 text-center">
			        <h2 class="mb-3"><?php echo $title;?></h2>
			        <?php if($sub_title){echo '<h6>'.$sub_title.'</h6>';}?>
			      </div>
			    </div>
			  </div>
			</section>
			<section class="article-page">
			  <div class="container">
			  	<?php if($hide_date && $hide_author && $hide_social){} else{?>
			    <div class="row article-meta">
			      <div class="col-md-6 mb-3">
			      	<?php
			      		if(!$hide_date){
			      			echo '<p>';
			      			the_date();
			      			echo '</p>';
			      		}
			      		if(!$hide_author){
			      			echo '<p>By <a href="'.get_the_author_url().'">'.get_the_author_meta('display_name').'</a></p>';
			      		}
			      	?>

			      </div>
			      <div class="col-md-6">
			        <div class="article-social text-md-right mb-2">
			        	<?php
			        		if(!$hide_social){
			        			echo do_shortcode('[ssba-buttons]');
			        		}
			        	?>
			        </div>
			      </div>
			    </div>
				<?php } ?>
			    <div class="row article-body">
			    	<div class="col-12">
			    	<?php //echo do_shortcode($post->post_content);?>
			    	<?php
						if( have_rows('post_content') ){
						    while ( have_rows('post_content') ) : the_row();
						        if( get_row_layout() == 'heading' ){
						        	$heading_type = get_sub_field("heading_type");
						        	$heading_text = get_sub_field("heading_text");
						        	if($heading_type=="H1"){
						        		echo '<h1>'.$heading_text.'</h1>';
						        	}
						        	if($heading_type=="H2"){
						        		echo '<h2>'.$heading_text.'</h2>';
						        	}
						        	if($heading_type=="H3"){
						        		echo '<h3>'.$heading_text.'</h3>';
						        	}
						        	if($heading_type=="H4"){
						        		echo '<h4>'.$heading_text.'</h4>';
						        	}
						        	if($heading_type=="H5"){
						        		echo '<h5>'.$heading_text.'</h5>';
						        	}
						        	if($heading_type=="H6"){
						        		echo '<h6>'.$heading_type.'</h6>';
						        	}
						        }
						        if( get_row_layout() == 'content' ){
						            $content = get_sub_field('content');
						            echo do_shortcode($content);
						        }
						        if( get_row_layout() == 'image' ){
						            $image = get_sub_field('image');
						            $caption = get_sub_field('caption');
						            echo '<figure><img src="'.$image.'" alt="" /><figcaption>'.$caption.'</figcaption></figure>';
						        }
						        if( get_row_layout() == 'footnotes' ){
						            $content = get_sub_field('content');
						            echo '<div class="footnotes">'.do_shortcode($content).'</div>';
						        }
						        if( get_row_layout() == 'tables' ){
						            $tables = get_sub_field('tables');
						            $tbhead = '';
						            foreach($tables[0] as $tablehead){
						            	if($tablehead!="")
						            		$tbhead .= '<th>'.$tablehead.'</th>';
						            }
						            $tbcolumn = '';
						            $counter = 0;
						            foreach($tables as $tabledata){
						            	if($counter==0){
						            		$counter++;
						            		continue;
						            	}
						            	$tabcolhtml = '';
						            	foreach($tabledata as $tabcol){
						            		if($tabcol!="")
						            			$tabcolhtml .= '<td>'.$tabcol.'</td>';
						            	}
										$tbcolumn .= '<tr>'.$tabcolhtml.'</tr>';
						            }
						            echo '
						            		<table>
						            			'.$tbhead.'
						            			'.$tbcolumn.'
						            		</table>
						            	 ';
						        }
						        if( get_row_layout() == 'sources' ){
						            $content = get_sub_field('content');
						            echo '<p class="caption">'.do_shortcode($content).'</p>';
						        }
						    endwhile;
						}
						else{
							echo do_shortcode($post->post_content);
						}
			    	?>
			    	</div>
			    </div>
			  </div>
			</section>
			<?php
		endwhile; // End of the loop.
		?>

		<!-- Global Modules -->
		<?php
		while ( have_posts() ) :
			the_post();
			if( have_rows('content') ):
				while ( have_rows('content') ) : the_row();
					get_template_part("template-parts/flexible/content", get_row_layout());
				endwhile;
			endif;
		endwhile; // End of the loop.
		?>
		<!-- /Global Modules -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
