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
$classes = get_sub_field("classes");
?>
<section class="upcoming-classes <?php echo $overlay_grey_position;?>" style="<?php echo $background_color.$background_image;?>">
  <div class="container">
    <div class="row">
      <?php
        if($title || $description){
          echo '<div class="col-md-9"><h5>'.$title.'</h5>'.($description).'</div>';
        }
      ?>
      <div class="col-md-3 text-md-right pt-2">
        <a href="<?php echo get_option("siteurl");?>/class_for/biomedical-engineers/" class="text-link-arrow">See All <i class="fas fa-angle-right ml-2"></i></a>
      </div>
    </div>
    <div class="row no-gutters mt-3 mt-md-0">
      <?php
      $counter = 0;
      foreach($classes as $class){
        $classdata = get_post($class);
        $image = get_the_post_thumbnail_url( $class, 'full');
        $classfor = get_primary_taxonomy_term($class, "class_for");
        $register_link = get_field("register_link",$class);
        $register_date = get_field("register_date",$class);
        $custom_link = get_field("custom_link",$class);
        $custom_link_title = get_field("custom_link_title",$class);
        if($custom_link) {
            $custom_link = '<a href="'.$custom_link.'" class="text-link-arrow">'.$custom_link_title.' <i class="fas fa-angle-right ml-2"></i></a>';
        } else {
            $custom_link = '<a href="'.get_term_link($classfor["terms"]).'" class="text-link-arrow">'.$custom_link_title.' <i class="fas fa-angle-right ml-2"></i></a>';
        }
        if($register_link)
          $register_link = '<a href="/registration/?training='.$classdata->post_title.'&date='.$register_date.'" class="btn btn-primary">REGISTER</a>';
        $counter++;
        echo '
              <div class="col-md-4">
                <div class="upcoming-class matchHeight">
                  <div class="square-image">
                    <img src="'.$image.'" alt="'.$classdata->post_title.'" class="img-fluid">
                  </div>
                  <div class="text-area">
                    <p class="eyebrow text-uppercase">'.strtoupper($classfor["title"]).'</p>
                    <p class="title">'.$classdata->post_title.'</p>
                    <p>'.$register_date.'</p>
                    <p class="small">'.$classdata->post_excerpt.'</p>
                    <div class="row">
                      <div class="col-6">'.$register_link.'</div>
                      <div class="col-6 d-inline-flex align-items-center justify-content-md-center">'.$custom_link.'</div>
                    </div>
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
