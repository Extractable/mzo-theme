<?php
$background_image = get_sub_field("background_image");
if($background_image=="")
  $background_image = get_field('footer_background_image', 'option');
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
if($title=="")
  $title = get_field('form_title', 'option');
$sub_title = get_sub_field("sub_title");
if($sub_title=="")
  $sub_title = get_field('form_sub_title', 'option');
$content = get_sub_field("content");
if($content=="")
  $content = get_field('form_content', 'option');

$use_global_footer_form_setting = get_sub_field("use_global_footer_form_setting");
if($use_global_footer_form_setting){
  $background_image = get_field('footer_background_image', 'option');
  $title = get_field('form_title', 'option');
  $sub_title = get_field('form_sub_title', 'option');
  $content = get_field('form_content', 'option');
}
$top_content_contact_left = get_sub_field("top_content_contact_left");
$top_content_contact_right = get_sub_field("top_content_contact_right");
?>
<section class="contact-us section-padding <?php echo $overlay_grey_position;?>" style="<?php echo $background_color.$background_image;?>">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 mx-auto text-center">
        <?php 
          if($title){
            echo '<h2>'.$title.'</h2>';
          }
          if($sub_title){
            echo '<h6 class="px-md-3">'.$sub_title.'</h6>';
          }
        ?>
      </div>
    </div>
    <?php
    if($top_content_contact_left || $top_content_contact_right){
    ?>
    <div class="row mt-4 contact-us-more-info">
      <div class="col-lg-8 mx-auto">
        <div class="row">
          <div class="col-md-6 mb-3">
            <?php echo $top_content_contact_left;?>
          </div>
          <div class="col-md-6 mb-3">
            <?php echo $top_content_contact_right;?>
          </div>
        </div>
      </div>
    </div>    
    <?php
    }
    ?>
    <div class="row mt-4">
      <div class="col-lg-8 mx-auto">
        <?php echo do_shortcode($content); ?>
      </div>
    </div>
  </div>
</section>