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
$sub_title = get_sub_field("sub_title");
$related = get_sub_field("products");
$layout = get_sub_field("layout");

if($layout=="5"){
?>
<section class="mosaic-story section-padding <?php echo $overlay_grey_position;?>" style="<?php echo $background_color.$background_image;?>">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 mx-auto text-center">
        <?php
          if($title){
            echo '<h3>'.$title.'</h3>';
          }
          if($sub_title){
            echo '<h6 class="px-lg-5">'.$sub_title.'</h6>';
          }
        ?>        
      </div>
    </div>
    <div class="row mt-5">
      <div class="col-12 mosaic-products">
        <?php
          foreach($related as $rel){
              $postdata = get_post($rel);
              setup_postdata($postdata); 
              $featured_img_url = get_the_post_thumbnail_url($postdata,"full");
              if($featured_img_url == "")
                $featured_img_url = get_stylesheet_directory_uri()."/images/related_products_productname_hero1.jpg"; 
              $sku = get_field("_sku",$postdata->ID);
              $term = get_primary_taxonomy_term($postdata->ID);
              $link = get_permalink($postdata->ID);
              $content = wp_trim_words(strip_tags(get_the_excerpt($postdata->ID)), 10, "");
              echo '   
                    <div class="mosaic-product">
                      <a href="'.$link.'">
                        <img src="'.$featured_img_url.'" class="img-fluid" alt="'.$postdata->post_title.'">
                        <div class="mosaic-label">
                          <h5>'.$postdata->post_title.'</h5>
                          <a href="'.$link.'" class="label-link">Learn More <i class="fas fa-angle-right ml-1"></i></a>
                        </div>
                      </a>
                    </div>    
                   ';
          }
          wp_reset_postdata();
          echo '</div></div>';
        ?>         
      </div>
    </div>
  </div>
</section>  
<?php } else{?>
<section class="one-fourth-product section-padding <?php echo $overlay_grey_position;?>" style="<?php echo $background_color.$background_image;?>">
  <div class="container">
    <div class="row no-gutters">
      <div class="col-12 one-fourth-products">
        <?php
          if($title){
            echo '<h3>'.$title.'</h3>';
          }
          if($sub_title){
            echo '<h6 class="px-lg-5">'.$sub_title.'</h6>';
          }
        ?>        
        <?php
          foreach($related as $rel){
              $postdata = get_post($rel);
              setup_postdata($postdata); 
              $featured_img_url = get_the_post_thumbnail_url($postdata,"full");
              if($featured_img_url == "")
                $featured_img_url = get_stylesheet_directory_uri()."/images/related_products_productname_hero1.jpg"; 
              $sku = get_field("_sku",$postdata->ID);
              $term = get_primary_taxonomy_term($postdata->ID);
              $link = get_permalink($postdata->ID);
              $content = wp_trim_words(strip_tags(get_the_excerpt($postdata->ID)), 10, "");
              echo '   
                    <div class="one-fourth-product-box">
                      <a href="'.$link.'">
                        <div class="square-image">
                          <img src="'.$featured_img_url.'" class="img-fluid" alt="'.$postdata->post_title.'">
                        </div>
                        <div class="one-fourth-product-label">
                          <h5>'.$postdata->post_title.'</h5>
                          <a href="'.$link.'" class="label-link">Learn More <i class="fas fa-angle-right ml-1"></i></a>
                        </div>
                      </a>
                    </div>  
                   ';
          }
          wp_reset_postdata();
          echo '</div></div>';
        ?>   
      </div>
    </div>
  </div>
</section>    
<?php }?>