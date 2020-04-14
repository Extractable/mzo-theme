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
$related = get_sub_field("products");
?>
<section class="product-tiles <?php echo $overlay_grey_position;?>" style="<?php echo $background_color.$background_image;?>">
  <div class="container">
        <?php
          if($title){
            echo '<div class="row"><div class="col-12"><h3>'.$title.'</h3></div></div>';
          }
          echo '<div class="row mt-4"><div class="col-12">';
          foreach($related as $rel){
              $postdata = get_post($rel);
              setup_postdata($postdata);
              $featured_img_url = get_the_post_thumbnail_url($postdata,"full");
              if($featured_img_url == "")
                $featured_img_url = get_stylesheet_directory_uri()."/images/related_products_productname_hero1.jpg";
              $sku = get_field("_sku",$postdata->ID);
              $term = get_primary_taxonomy_term($postdata->ID);
              $link = get_permalink($postdata->ID);
              echo '
                    <div class="product-tile">
                      <div class="row">
                        <div class="col product-tile-image">
                          <div class="square-image">
                            <img src="'.$featured_img_url.'" alt="'.$postdata->post_title.'" class="img-fluid">
                          </div>
                        </div>
                        <div class="col">';
                        if( $sku ) :
                            echo '<p class="eyebrow text-uppercase">Item #'.$sku.'</p>';
                        else:
                           echo '<p class="eyebrow text-uppercase">nbpsp;</p>';
                        endif;
                          echo '<h6><a href="'.$link.'">'.$postdata->post_title.'</a></h6>
                          <p class="desc">'.get_the_excerpt($postdata->ID).'</p>';
              echo '
                        </div>
                      </div>
                    </div>
                   ';
          }
          wp_reset_postdata();
          echo '</div></div>';
        ?>
  </div>
</section>
