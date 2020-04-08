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
$content = get_sub_field("content");

$paddingTop = get_sub_field('padding_top');
$textAlignLeft = get_sub_field('text_align_left');

?>
<section class="impact-text <?php echo $overlay_grey_position;?><?php if($paddingTop): echo " padding-top"; endif; ?><?php if($textAlignLeft): echo " text-align-left"; endif; ?>" style="<?php echo $background_color.$background_image;?>">
  <div class="container">
    <div class="row">
      <div class="col-md-10 col-lg-8 mx-auto">
        <?php echo do_shortcode($content); ?>
      </div>
    </div>
  </div>
</section>
