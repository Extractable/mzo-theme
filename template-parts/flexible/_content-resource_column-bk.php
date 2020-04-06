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
$resources = get_sub_field("resources");
?>
<section class="resources-icons <?php echo $overlay_grey_position;?>" style="<?php echo $background_color.$background_image;?>; border: 1px solid hotpink;">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h3><?php echo $title;?></h3>
      </div>
      <div class="col-12 mt-4">
        <div class="row">
          <?php
            foreach($resources as $rlist){
              if($rlist["url"]==""){
                $rlist["url"] = "#";
              }
              if($rlist["icon"]){
                $rlist["icon"] = '<a href="'.$rlist["url"].'"><img src="'.$rlist["icon"].'" alt="'.$rlist["title"].'" /></a>';
              }
              echo '
                <div class="col-lg-4 col-md-6">
                  <div class="row resources">
                    <div class="col-2 col-md-3 px-0">
                      '.$rlist["icon"].'
                    </div>
                    <div class="col-10 col-md-9">
                      <p><a href="'.$rlist["url"].'">'.$rlist["title"].'</a></p>
                    </div>
                  </div>
                </div>
                 ';
            }
          ?>
        </div>
      </div>
    </div>
  </div>
</section>
