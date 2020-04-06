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
$class_for = get_sub_field("class_for");
?>
<section class="education-selector section-padding <?php echo $overlay_grey_position;?>" style="<?php echo $background_color.$background_image;?>">
  <div class="container">
    <div class="row">
      <?php
        if($title || $description){
          echo '<div class="col-12 d-none d-md-block"><h5>'.$title.'</h5>'.($description).'</div>';
        }
      ?>
      <div class="education-owl-carousel owl-carousel owl-theme">
        <?php
          foreach($class_for as $classfor){
            $term = get_term( $classfor["class_for"] , 'class_for' );
            echo '
                  <div class="col px-3 px-md-2">
                    <div class="item">
                      <a href="#" class="d-flex flex-column justify-content-center text-center">
                        <div class="square-image">
                          <img src="'.$classfor["image"].'" alt="'.$term->name.'" class="mx-auto">
                        </div>
                        <p class="eyebrow text-uppercase">'.$term->name.'</p>
                        <p class="small">'.$classfor["description"].'</p>
                      </a>
                    </div>
                  </div>            
                 ';
          }
        ?>
      </div>
    </div>
  </div>
</section>