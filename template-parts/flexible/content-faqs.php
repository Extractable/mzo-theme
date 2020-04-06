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
$faqs = get_sub_field("faqs");

?>
<section class="faq section-padding <?php echo $overlay_grey_position;?>" style="<?php echo $background_color.$background_image;?>">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <?php
          if($title)
            echo '<h4>'.$title.'</h4>';
          if($content)
            echo '<h6>'.$content.'</h6>';
        ?>

        <div class="accordion mt-md-5" id="accordionFAQ">
          <?php
            $counter=0;
            $contentmore = '';
            foreach($faqs as $faq){
              if($faq["link_url"]=="")
                $faq["link_url"] = '';
              if($faq["link_text"])
                $faq["link_text"] = '<a href="'.$faq["link_url"].'" class="text-link-arrow">'.$faq["link_text"].' <i class="fas fa-angle-right ml-2"></i></a>';
              $counter++;
              if($counter<6){
                echo '
                      <div class="card">
                        <div class="card-header" id="heading'.$counter.'">
                          <h2 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse'.$counter.'" aria-expanded="true" aria-controls="collapse'.$counter.'">
                              '.$faq["title"].'
                            </button>
                          </h2>
                        </div>

                        <div id="collapse'.$counter.'" class="collapse" aria-labelledby="heading'.$counter.'" data-parent="#accordionFAQ">
                          <div class="card-body">
                            '.wpautop($faq["content"]).'
                            '.$faq["link_text"].'
                          </div>
                        </div>
                      </div>              
                     ';
              }
              else{
                $contentmore .= '
                                  <div class="card">
                                    <div class="card-header" id="heading'.$counter.'">
                                      <h2 class="mb-0">
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse'.$counter.'" aria-expanded="true" aria-controls="collapse'.$counter.'">
                                          '.$faq["title"].'
                                        </button>
                                      </h2>
                                    </div>

                                    <div id="collapse'.$counter.'" class="collapse" aria-labelledby="heading'.$counter.'" data-parent="#accordionFAQ">
                                      <div class="card-body">
                                        '.wpautop($faq["content"]).'
                                        '.$faq["link_text"].'
                                      </div>
                                    </div>
                                  </div>                  
                                ';
              }
            }
          ?>
          <span id="more">
            <?php echo $contentmore;?>
          </span>
          <?php if($contentmore){?>
          <div class="show-more mt-md-4 mb-4">
            <button onclick="showMoreFAQ()" id="myBtn" class="mt-3">SEE ALL <i class="fas fa-plus"></i></button>
          </div>
        <?php } ?>
        </div>



      </div>
    </div>
  </div>
</section>
