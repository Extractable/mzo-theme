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
$image = get_sub_field("image");
$video_image = get_sub_field("video_image");
$video_url = get_sub_field("video_url");
$title = get_sub_field("title");
$flip_position = get_sub_field("flip_position");
$media = get_sub_field("media");
$content = get_sub_field("content");

if($flip_position){
  $flip_position = "media-right";
}
if($image){
  $content1 = '<img src="'.$image.'" alt="'.$title.'" class="img-fluid rounded mb-4">';
}
if($video_image){
  $content1 = '<a href="'.$video_url.'" data-fancybox="gallery" data-fancybox-type="iframe" class="playvideo"><img src="'.$video_image.'" alt="'.$title.'" class="img-fluid rounded mb-4"></a>';
}

$no_padding_left = get_sub_field("no_padding_left");
if($no_padding_left){
  $no_padding_left = "px-md-0";
}

$bullet_points_color = get_sub_field("bullet_points_color");
$bullet_points_no_dots = get_sub_field("bullet_points_no_dots");
$bullet_points = get_sub_field("bullet_points");
$button_type = get_sub_field("button_type");
$button_text = get_sub_field("button_text");
$button_url = get_sub_field("button_url");
if($button_url=="")
  $button_url="#";
if($bullet_points_color){
  echo '
        <style type="text/css">
            .stwocol'.get_row_index().' ul li, .stwocol'.get_row_index().' ul li a, .stwocol'.get_row_index().' ul li:before{
              color: '.$bullet_points_color.';
            }
        </style>
       ';
}
if($bullet_points_no_dots){
  $bullet_points_no_dots = 'no-bullets pl-0';
}
?>
<section class="stwocol<?php echo get_row_index();?> split-story <?php echo $flip_position;?> section-padding <?php echo $overlay_grey_position;?>" style="<?php echo $background_color.$background_image;?>">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-lg-5 media-content">
        <?php echo $content1;?>
      </div>
      <div class="d-none d-lg-block col-lg-1 separator-1"></div>
      <div class="col-md-6 col-lg-5 text-content <?php echo $no_padding_left;?>">
        <?php
          if($title){
            echo '<h3>'.$title.'</h3>';
          }
          if($content){
            echo do_shortcode($content);
          }
          if(count($bullet_points)>0){
            echo '<ul class="'.$bullet_points_no_dots.'">';
            foreach($bullet_points as $bp){
              if($bp["url"]==""){
                echo '<li>'.$bp["text"].'</li>';
              }
              else{
                echo '<li><a href="'.$bp["url"].'">'.$bp["text"].'</a></li>';
              }
            }
            echo '</ul>';
          }
          if($button_text){
            if($button_type=="simple"){
              echo '<p><a class="link-text" href="'.$button_url.'">'.$button_text.'</a></p>';
            }
            else if($button_type=="button"){
              echo '<p><a class="btn btn-primary my-3" href="'.$button_url.'">'.$button_text.'</a></p>';
            }
            else if($button_type=="caret"){
              echo '<p><a class="link-text" href="'.$button_url.'">'.$button_text.' <i class="fas fa-angle-right ml-2"></i></a></p>';
            }
          }
        ?>
      </div>
      <div class="d-none d-lg-block col-lg-1 separator-2"></div>
    </div>
  </div>
</section>
