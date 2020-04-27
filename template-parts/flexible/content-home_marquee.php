<?php
$themesite = get_stylesheet_directory_uri();

$background_image = get_sub_field("background_image");
if($background_image){
  $background_image_bg = ", url(".$background_image.")";
}
$background_video = get_sub_field("background_video");
$sub_title = get_sub_field("sub_title");
$title = get_sub_field("title");
$content = get_sub_field("content");
$button_text = get_sub_field("button_text");
$button_url = get_sub_field("button_url");
if($button_url=="")
  $button_url = "#";

$layout = get_sub_field("add_extra_padding");
if($layout){
  $layout = "solutions-marquee";
}
else{
  $layout = "homepage-marquee";
}
?>
<section class="<?php echo $layout;?>" style="background-image: url(<?php echo $themesite;?>/images/homepage-bottom-mask-invert.png)<?php echo $background_image_bg;?>;">
  <?php
    if($background_video){
      echo '<div class="backgroundvideo">'.$background_video.'</div>';
    }
  ?>
  <div class="bg-mobile d-block d-md-none">
    <img src="<?php echo $background_image; ?>" alt="mobile-bg" class="img-fluid">
  </div>
  <div class="container">
    <div class="row">
      <div class="col-md-6 text-white banner-text-area">
        <div>
            <div>
                <?php if($sub_title){?><p class="eyebrow text-white text-uppercase"><?php echo $sub_title;?></p><?php } ?>
                <?php if($title){?><h1 class="text-white mb-2 mb-md-4"><?php echo $title;?></h1><?php } ?>
                <?php if($content){?><div class="intro mb-2 mb-md-4"><?php echo $content;?></div><?php } ?>
                <?php if($button_text){?><a href="<?php echo $button_url;?>" class="btn btn-light my-2 my-md-3"><?php echo $button_text;?></a><?php } ?>
            </div>
        </div>
      </div>
    </div>
  </div>
</section>
