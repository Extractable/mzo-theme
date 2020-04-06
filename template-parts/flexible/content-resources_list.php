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
$classes = get_sub_field("resources");
?>
<section class="resources-section <?php echo $overlay_grey_position;?>" style="<?php echo $background_color.$background_image;?>">
  <div class="container">
    <div class="row">
      <?php
        if($title || $description){
          echo '<div class="col-md-9"><h5>'.$title.'</h5>'.($description).'</div>';
        }
      ?>
      <div class="col-md-3 text-md-right pt-2">
        <a href="<?php echo get_permalink(get_field("resources_page","option"));?>" class="text-link-arrow">See All <i class="fas fa-angle-right ml-2"></i></a>
      </div>
    </div>
    <div class="row mt-5 mt-md-3">
      <?php
      $counter = 0;
      $themeurl = get_stylesheet_directory_uri();
      foreach($classes as $class){
        $classdata = get_post($class);
        $image = get_the_post_thumbnail( $class, 'full');
        $category = get_primary_taxonomy_term($class, "resource_for");
        $counter++;
        echo '
              <div class="col-md-4">
                <div class="resource">
                  <div class="row">
                    <div class="col-2 col-md-3 text-center px-0">
                      <img src="'.$themeurl.'/images/icon_case_study.svg" alt="icon case study" class="img-fluid">
                    </div>
                    <div class="col-10 col-md-9">
                      <p class="eyebrow text-uppercase">'.$category["title"].'</p>
                      <p class="title">'.$classdata->post_title.'</p>
                      <p class="small">'.get_field("sub_title",$class).'</p>
                      <a href="'.get_permalink($class).'" class="text-link-arrow">Learn More <i class="fas fa-angle-right ml-2"></i></a>
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