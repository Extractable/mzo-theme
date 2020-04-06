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
$content_background_overlay = get_sub_field("content_background_overlay");
$content_background_overlay_mobile = get_sub_field("content_background_overlay_mobile");
$title = get_sub_field("title");
$content = get_sub_field("content");

if($content_background_overlay){
  echo '<style type="text/css">
          @media (max-width: 767.98px){
            .sectionpb'.get_row_index().'.page-break .page-break-text-area{
              background-color: transparent!important;
            }
            .sectionpb'.get_row_index().'.page-break .page-break-text-area::before{
              background:'.$content_background_overlay_mobile.';
            }
          }
        </style>';
  $content_background_overlay = 'background-color:'.$content_background_overlay.';';
}
if($media){
  $content1 = $media;
}
?>
<section class="sectionpb<?php echo get_row_index();?> page-break section-padding <?php echo $overlay_grey_position;?>" style="<?php echo $background_color.$background_image;?>">
  <div class="container">
    <div class="row">
      <div class="col-md-6 d-flex justify-content-end">
        <div class="page-break-text-area text-white" style="<?php echo  $content_background_overlay;?>">
        <?php
          if($title){
            echo '<h3 class="text-white">'.$title.'</h3>';
          }
          if($content){
            echo do_shortcode($content);
          }
        ?>
        </div>
      </div>
    </div>
  </div>
</section>