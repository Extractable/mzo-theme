<?php
$themesite = get_stylesheet_directory_uri();
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
$links = get_sub_field("links");

?>
<section class="product-selector section-padding <?php echo $overlay_grey_position;?>" style="<?php echo $background_color.$background_image;?>">
  <div class="container">
    <div class="row">
      <div class="product-owl-carousel owl-carousel owl-theme">
        <?php
          foreach($links as $link){
            echo '
                  <div class="col px-3 px-md-2">
                    <div class="item">
                      <a href="'.$link["link"].'" class="d-flex flex-column justify-content-center text-center">
                        <img src="'.$link["icon"].'" alt="icon '.$link["title"].'" class="mx-auto">
                        <p class="eyebrow text-uppercase">'.$link["title"].'</p>
                        <p class="desc">'.($link["content"]).'</p>
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