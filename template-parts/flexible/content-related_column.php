<?php
$background_image = get_sub_field("background_image");
$background_color = get_sub_field("background_color");
$overlay_grey_position = get_sub_field("overlay_grey_position");

if($background_image){
  $background_image = 'background-image:url('.$background_image.');';
}
if($background_color){
  $background_color = 'background-color:'.$background_color.';';
}
if($overlay_grey_position){
  if($overlay_grey_position=="top"){
    $overlay_grey_position = 'top-bg-grey';
  }
  if($overlay_grey_position=="bottom"){
    $overlay_grey_position = 'bottom-bg-grey';
  }
}
$title = get_sub_field("title");
$content = get_sub_field("content");
$related = get_sub_field("related");
?>
<section class="related-product-cards <?php echo $overlay_grey_position;?>" style="<?php echo $background_color.$background_image;?>">
  <div class="container">

        <?php
          if($title){
            echo '<div class="row"><div class="col-12"><h3>'.$title.'</h3></div></div>';
          }
          echo '<div class="row mt-4 related-cards">';
          foreach($related as $rel){
              $postdata = get_post($rel);
              setup_postdata($postdata);
              $featured_img_url = get_the_post_thumbnail_url($postdata,"full");
              if($featured_img_url == "")
                $featured_img_url = get_stylesheet_directory_uri()."/images/related_products_productname_hero1.jpg";
              $term = get_primary_taxonomy_term($postdata->ID);

              if(get_post_type($postdata->ID)=="product"){
                $sub_title = get_field("sub_title",$postdata->ID);
                $sku = get_post_meta($postdata->ID,"_sku",true);
                if( $sku ):
                    $sub_title = '<p class="eyebrow">Part #'.$sku.'</p>';
                else:
                    $sub_title = '<p class="eyebrow">&nbsp;</p>';
                endif;
                //$sub_title = '<p class="eyebrow">Part #'.$sku.'</p>';
                $description = str_replace("<p>",'<p class="small">',wpautop(get_the_excerpt($postdata->ID)));
                $link = '<p class="link"><a href="'.get_permalink($postdata->ID).'">Learn More <i class="fas fa-angle-right ml-2"></i></a></p>';
              }
              else{
                $sub_title = get_field("eyebrow_text",$postdata->ID);
                if( $sub_title ):
                    $sub_title = '<p class="eyebrow text-uppercase">'.$sub_title.'</p>';
                else:
                    $sub_title = '<p class="eyebrow">&nbsp;</p>';
                endif;

                $description = str_replace("<p>",'<p class="desc d-block d-md-none">',wpautop(get_the_excerpt($postdata->ID)));
                $link = '<p class="link"><a href="'.$term["url"].'">'.$term["title"].'</a></p>';
              }

              echo '
                    <div class="col-12 col-md-6 col-lg-4">
                    <div class="related-card">
                      <div>
                      <img src="'.$featured_img_url.'" alt="'.$postdata->post_title.'" class="img-fluid">
                      <div class="text-area">
                        '.$sub_title.'
                        <p class="title">'.$postdata->post_title.'</p>
                        '.$description.'
                        '.$link.'
                      </div>
                      </div>
                    </div>
                    </div>
                   ';
          }
          wp_reset_postdata();
          echo '</div>';
        ?>
  </div>
</section>
