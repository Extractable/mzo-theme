<?php
$themesite = get_stylesheet_directory_uri();

$image = get_sub_field("image");
$video = get_sub_field("video");
$sub_title = nl2br(get_sub_field("sub_title"));
$title = get_sub_field("title");
$content = get_sub_field("content");
$button_text = get_sub_field("button_text");
$button_url = get_sub_field("button_url");
if($button_url=="")
  $button_url = "#";


if($image){
  $image = 'background-image:url('.$image.');';
}
?>
<section class="product-marquee extra-tall" style="<?php echo $background_image;?>;">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6 px-0 product-marquee-media-area<?php if($video): echo ' video'; endif; ?>" style="<?php echo $image;?>">
        <?php if($video): ?>
            <a href="<?php echo $video; ?>" data-fancybox="" class="link-label"></a>
        <?php endif; ?>
      </div>
      <div class="col-md-6 text-white product-marquee-text-area">
        <div class="fix-container-position">
          <?php if($title){?><h2 class="text-white mb-2 mb-md-4"><?php echo $title;?></h2><?php } ?>
          <?php if($sub_title){?><h6 class="text-white mb-2 mb-md-4"><?php echo $sub_title;?></h6><?php } ?>
          <?php echo do_shortcode($content);?>
          <?php if($button_text){?><a href="<?php echo $button_url;?>" class="text-link-arrow text-white mt-2 mt-md-4"><?php echo $button_text;?> <i class="fas fa-angle-right ml-2"></i></a><?php } ?>
        </div>
      </div>
    </div>
  </div>
</section>
