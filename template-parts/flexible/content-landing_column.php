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
$icon_content_left = get_sub_field("icon_content_left");
$title_content_left = get_sub_field("title_content_left");
$content_left = get_sub_field("content_left");

$icon_content_right = get_sub_field("icon_content_right");
$title_content_right = get_sub_field("title_content_right");
$content_right = get_sub_field("content_right");


?>
<section class="landing-page-content <?php echo $overlay_grey_position;?>" style="<?php echo $background_color.$background_image;?>">
    <div class="container">
      <div class="row">
        <div class="col-md-6 left-area">
          <div class="row no-gutters">
            <?php 
              if($icon_content_left){
                  echo '
                        <div class="col-3 col-md-2">
                          <img src="'.$icon_content_left.'" alt="'.$title_content_left.'" class="img-fluid">
                        </div>         
                       ';
              }
            ?>
            <?php 
              if($title_content_left){
                  echo '
                        <div class="col-9 col-md-9 pr-3 pr-md-5">
                          <h5>'.$title_content_left.'</h5>
                        </div>      
                       ';
              }
            ?>
          </div>
          <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-9 pr-md-5">
              <?php echo do_shortcode($content_left); ?>
            </div>
          </div>
        </div>
        <div class="col-md-6 right-area">
          <?php 
              if($icon_content_right){
                echo '<img src="'.$icon_content_right.'" alt="'.$title_content_right.'" class="img-fluid">';
              }
              if($title_content_right){
                echo '<h5>'.$title_content_right.'</h5>';
              }
               echo do_shortcode($content_right); 
          ?>
        </div>
      </div>
    </div>
</section>