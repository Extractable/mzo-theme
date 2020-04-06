<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package mizuho
 */
$obj = get_queried_object();
if($obj->taxonomy=="product_cat"){
	wc_get_template( 'archive-product.php' );
}
else{
get_header();
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main">
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
	</main><!-- #main -->
</div><!-- #primary -->

<?php
//get_sidebar();
get_footer();
}