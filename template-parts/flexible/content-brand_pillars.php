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
$content = get_sub_field("content");
$pillars = get_sub_field("pillars");

?>
<section class="three-part-story section-padding <?php echo $overlay_grey_position;?>" style="<?php echo $background_color.$background_image;?>">
  <div class="container">
    <div class="row">
      <div class="col-lg-7 mx-auto text-center">
        <?php
          if($title)
            echo '<h2>'.$title.'</h2>';
          if($content)
            echo '<h6>'.$content.'</h6>';
        ?>
      </div>
    </div>
    <div class="row mt-4 mt-md-5">
      <?php
        foreach($pillars as $pillar){
          echo '
                <div class="col-md-6 col-lg-4">
                  <div class="brand-pillar">
                      <div class="brand-pillar-content">
                         <div>
                             <img src="'.$pillar["image"].'" alt="'.$pillar["title"].'" class="img-fluid rounded-circle">
                             <h5>'.$pillar["title"].'</h5>
                             '.$pillar["content"].'
                         </div>
                      </div>
                      <div class="link">
                        <a href="'.$pillar["link_url"].'">'.$pillar["link_text"].' <i class="fas fa-angle-right ml-2"></i></a>
                      </div>
                  </div>
                </div>
               ';
        }
      ?>
    </div>
  </div>
</section>
