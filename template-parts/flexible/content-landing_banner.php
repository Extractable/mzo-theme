<?php
$themesite = get_stylesheet_directory_uri();

$background_image = get_sub_field("background_image");
if($background_image){
  $background_image = "background-image: url(".$background_image.")";
}
$background_color = get_sub_field("background_color");
if($background_color){
  $background_color = 'background-color:'.$background_color.';';
}
$background_video = get_sub_field("background_video");
$sub_title = get_sub_field("sub_title");
$title = get_sub_field("title");

$button_text = get_sub_field("button_text");
$button_url = get_sub_field("button_url");
if($button_url=="")
  $button_url = "#";

$link_text = get_sub_field("link_text");
$link_url = get_sub_field("link_url");
if($link_url=="")
  $link_url = "#";


$layout_type = get_sub_field("layout_type");
$image = get_sub_field("image");

if($layout_type=="left"){
  $classsection = 'default-banner section-padding';
  $classrow = 'col-md-6 text-white py-3 py-md-5 px-4';
  $classcontainer = 'container';
}
else if($layout_type=="center"){
  $classsection = 'article-page-banner default-banner section-padding';
  $classrow = 'col-lg-8 mx-auto text-white py-3 py-md-5 px-3 text-center';
  $classcontainer = 'container';
}
else if($layout_type=="two"){
  $classsection = 'product-marquee extra-tall';
  $classrow = '';
  $classcontainer = 'container-fluid';
}
?>
<section class="<?php echo $classsection;?>" style="<?php echo $background_color.$background_image;?>">
  <?php
    if($background_video){
      echo '<div class="backgroundvideo">'.$background_video.'</div>';
    }
  ?>
  <div class="<?php echo $classcontainer;?>">
    <div class="row">
      <?php if($layout_type!="two"){?>
      <div class="<?php echo $classrow;?>">
          <?php if($title){?><h2 class="mb-3"><?php echo $title;?></h2><?php } ?>
          <?php if($sub_title){?><h6><?php echo $sub_title;?></h6><?php } ?>
          <?php if($button_text){?><a href="<?php echo $button_url;?>" class="btn btn-light my-4 px-2 px-md-5"><?php echo $button_text;?></a><?php } ?>
          <?php if($link_text){?><a href="<?php echo $link_url;?>" class="text-link-arrow text-white my-4 px-2"><?php echo $link_text;?> <i class="fas fa-angle-right ml-2"></i></a><?php } ?>
      </div>
      <?php } else {?>
            <div class="col-md-6 px-0 product-marquee-media-area" style="background-image:url(<?php echo $image;?>);"></div>
            <div class="col-md-6 text-white product-marquee-text-area">
              <div class="fix-container-position">
                <?php if($sub_title){?><h2 class="text-white mb-2 mb-md-4"><?php echo $title;?></h2><?php } ?>
                <?php if($sub_title){?><?php echo $sub_title;?><?php } ?>
                <?php if($button_text){?><a href="<?php echo $button_url;?>" class="btn btn-light my-4 px-2 px-md-5"><?php echo $button_text;?></a><?php } ?>
                <?php if($link_text){?><a href="<?php echo $link_url;?>" class="text-link-arrow text-white my-4 px-2"><?php echo $link_text;?> <i class="fas fa-angle-right ml-2"></i></a><?php } ?>
              </div>
            </div>
          </div>        
      <?php }?>
    </div>
  </div>
</section>