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
$description = get_sub_field("description");
if($description)
  $description = '<p class="small">'.$description.'</p>';
$classes = get_sub_field("posts");
?>
<section class="latest-insights <?php echo $overlay_grey_position;?>" style="<?php echo $background_color.$background_image;?>">
  <div class="container">
    <div class="row">
      <?php
        if($title || $description){
          echo '<div class="col-md-9"><h5>'.$title.'</h5>'.($description).'</div>';
        }
      ?>
      <div class="col-md-3 text-md-right pt-2">
        <a href="<?php echo get_permalink(get_option( 'page_for_posts' ));?>" class="text-link-arrow">See All <i class="fas fa-angle-right ml-2"></i></a>
      </div>
    </div>
    <div class="row no-gutters mt-3 mt-md-0">
      <?php
      $counter = 0;
      $themeurl = get_stylesheet_directory_uri();
      foreach($classes as $class){
        $classdata = get_post($class);
        $image = get_the_post_thumbnail_url( $class, 'full');
        $category = get_primary_taxonomy_term($class);
        $counter++;
        echo '
              <div class="col-md-4">
                <div class="latest-insight">
                  <div class="square-image">
                    <img src="'.$image.'" alt="'.$classdata->name.'" class="img-fluid">
                  </div>
                  <div class="text-area">
                    <p class="eyebrow text-uppercase">'.$category["title"].'</p>
                    <p class="title">'.$classdata->post_title.'</p>
                    <p class="small">'.get_field("sub_title",$class).'</p>
                    <a href="'.get_permalink($class).'" class="text-link-arrow">Learn More <i class="fas fa-angle-right ml-2"></i></a>
                  </div>
                </div>
              </div>   
             ';
        if($counter>=3)
          break;
      }
      ?>
    </div>
  </div>
</section>
