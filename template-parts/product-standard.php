<?php
$themeurl = get_stylesheet_directory_uri();
$product = wc_get_product();
$sku = $product->get_sku();

$product_media = get_field("product_media");
?>
<section class="standard-product-marquee">
  <div class="container">
    <div class="row">
      <div class="col-9 marquee-breadcrumb">
        <?php
          $args = array(
              'orderby'       => 'name',
              'order'         => 'ASC',
              'hide_empty'    => false,

          );
          $terms = get_the_terms(get_the_ID(), 'product_cat');
          foreach($terms as $key => $term){
              if($term->parent != 0){
                  $terms[$term->parent]->children[] = $term;
                  unset($terms[$key]);
              }
          }        

          $categories = get_the_terms(get_the_ID(), 'product_cat', $args);
          $counter=0;
          $totalcat = count($categories);
          $lastitem = "";
          $listmenu = "";
          $parentchild = 0;
          foreach ($terms as $category) {
            if($category->parent==0){
              $parentchild = 1;
              $listmenu .= ' <a href="'.get_term_link($category).'">'.$category->name.'</a> /';
              $totalcat = count($terms[$category->term_id]->children);
              $counter = 1;
              foreach($terms[$category->term_id]->children as $children){
                if ($counter==$totalcat) {
                    //last item
                    $lastitem = '<span class="d-inline-flex align-items-center d-md-none"><a href="#"><i class="fas fa-angle-right mr-2"></i><span class="d-none">breadcrumb</span></a></span><a href="'.get_term_link($children).'">'.$children->name.'</a>';
                } else {
                    $listmenu .= ' <a href="'.get_term_link($children).'">'.$children->name.'</a> /';
                }
                $counter++;
              }
              break;
            }
          }
          if($parentchild<1){
            foreach($categories as $category){
              $counter++;
              if($counter==$totalcat){
                //last item
                $lastitem = '<span class="d-inline-flex align-items-center d-md-none"><a href="#"><i class="fas fa-angle-right mr-2"></i><span class="d-none">breadcrumb</span></a></span><a href="'.get_term_link($category).'">'.$category->name.'</a>';
              }
              else{
                $listmenu .= ' <a href="'.get_term_link($category).'">'.$category->name.'</a> /';
              }
            }            
          }
        ?>

        <span class="d-none d-md-inline-block"><a href="<?php echo get_option("siteurl");?>">Home</a> / <?php echo $listmenu;?></span> <?php echo $lastitem;?>
      </div>
      <div class="col-3 text-right">
        <a href="#" class="splink"><i class="fas fa-share-alt"></i><span class="d-none">Share</span></a>
        <div class="sharepopup"><?php echo do_shortcode('[ssba-buttons]');?></div>
      </div>
    </div>
    <div class="row mt-3 mt-md-5">
      <div class="col-md-6">
        <span class="d-block d-md-none">
          <h2><?php echo $post->post_title;?></h2>
          <?php if ($sku) {
            echo '<p class="eyebrow">PART #'.$sku.'</p>';
        }?>
        </span>
        <div id="myCarousel" class="carousel slide">
          <!-- main slider carousel items -->
          <div class="carousel-inner">
            <?php
              $counter=0;
              foreach ($product_media as $productdata) {
                  $showDesc = $productdata["show_desc"];
                  $image = $productdata["image"];
                  $video = $productdata["video"];
                  $image_video_sub_title = $productdata["image_video_sub_title"];
                  if ($image_video_sub_title) {
                      $image_video_sub_title = '<p class="legal text-uppercase font-weight-bold text-white">'.$image_video_sub_title.'</p>';
                  }
                  $title = $productdata["title"];
                  if ($title) {
                      $title = '<h6>'.$title.'</h6>';
                  }
                  $description = $productdata["description"];
                  if ($description) {
                      $description = wpautop($description);
                  }

                  $class="";
                  if ($counter<1) {
                      $class="active";
                  }
                  if ($video) {
                      $video = '<a href="'.$video.'" data-fancybox class="link-label"><span class="d-none">Link</span></a><img src="'.$themeurl.'/images/icon-video.svg" alt="icon video" class="icon-media">';
                  }

                  echo '
                      <div class="'.$class.' carousel-item" data-slide-number="'.$counter.'">
                        <img src="'.$image.'" alt="'.$title.'" class="img-fluid w-100">';

                  if ($showDesc) {
                      echo  '<div class="label">
                              '.$video.'
                              '.$title.'
                              '.$description.'
                              '.$image_video_sub_title.'
                          </div>';
                  }

                  echo '</div>';

                  $counter++;
              }
            ?>
          </div>
          <!-- main slider carousel nav controls -->

          <ul class="carousel-indicators list-inline mx-auto px-2">
            <?php
              $counter=0;
              foreach ($product_media as $productdata) {
                  $image = $productdata["image"];
                  $video = $productdata["video"];

                  $class="";
                  if ($counter<1) {
                      $class="active";
                  }
                  if ($video) {
                      $video = '<a href="'.$video.'" data-fancybox class="link-label"><span class="d-none">Link</span></a><img src="'.$themeurl.'/images/icon-video.svg" alt="icon video" class="icon-media">';
                      $class.=" video";
                  }
                  echo '
                      <li class="list-inline-item '.$class.'">
                        <a id="carousel-selector-'.$counter.'" class="selected" data-slide-to="'.$counter.'" data-target="#myCarousel">
                          <img src="'.$image.'" alt="thumb product sub 1" class="img-fluid">
                        </a>
                      </li>
                     ';
                  $counter++;
              }
            ?>
          </ul>
          <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"><i class="fas fa-caret-left"></i></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"><i class="fas fa-caret-right"></i></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
      <div class="col-md-6">
        <span class="d-none d-md-block">
          <h2><?php echo $post->post_title;?></h2>
          <?php if ($sku) {
                echo '<p class="eyebrow">PART #'.$sku.'</p>';
            }?>
        </span>
        <div class="shortdescription"><?php the_excerpt(); ?></div>
        <?php
          $component_description = get_field("component_description");
          if ($component_description) {
              echo do_shortcode($component_description);
          }
        ?>
        <?php
          $request = get_field("request");
          if ($request) {
              echo '<div class="request mb-3"><div class="position-relative select-form"><label for="selectRequestInformation" class="mr-3">Request</label><select class="custom-select border-dark" id="selectRequestInformation" required>';
              foreach ($request as $reqdata) {
                  echo '<option value="'.$reqdata["url"].'">'.$reqdata["title"].'</option>';
              }
              echo '</select></div></div>';
          }

        ?>

      </div>
    </div>
  </div>
</section>

 <?php $components = get_field("components"); ?>
<section class="product-tabs">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <ul class="nav nav-tabs no-bullets" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="overview-tab" data-toggle="tab" href="javascript:;" role="tab" aria-controls="overview" aria-selected="true">Overview</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="specifications-tab" data-toggle="tab" href="javascript:;" role="tab" aria-controls="specifications" aria-selected="false">Specifications</a>
          </li>
          <?php if($components) : ?>
              <li class="nav-item">
                <a class="nav-link" id="component-tab" data-toggle="tab" href="javascript:;" role="tab" aria-controls="component" aria-selected="false">Components</a>
              </li>
          <?php endif; ?>
        </ul>
        <div class="tab-content" id="myTabContent">
          <!-- Overview -->
          <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
            <div class="row mb-2">
                <div class="col-lg-6">
                    <?php
                      $overview = get_field("overview");
                      foreach ($overview as $overvdata) {
                          echo '
                                <h5>'.$overvdata["title"].'</h5>
                                '.wpautop(do_shortcode($overvdata["content"])).'
                           ';
                      }
                    ?>
                </div>
                <div class="col-lg-6">
                    <?php
                      $overviewr = get_field("overview_right");
                      foreach ($overviewr as $overrvdata) {
                          echo '
                                <h5>'.$overrvdata["title"].'</h5>
                                '.wpautop(do_shortcode($overrvdata["content"])).'
                           ';
                      }
                    ?>
                </div>

            </div>
          </div>
          <!-- /Overview -->
          <!-- Specifications -->
          <div class="tab-pane fade" id="specifications" role="tabpanel" aria-labelledby="specifications-tab">
            <div class="row">
              <div class="col-lg-6">
                <div class="specification">
                    <?php
                      $specifications = get_field("specifications_left");
                      foreach ($specifications as $spec) {
                          echo '<h5 class="my-3">'.$spec["title"].'</h5>';
                          echo '<table><tbody>';
                          foreach ($spec["list"] as $speclist) {
                              if ($speclist["bold_left"]) {
                                  $speclist["left_text"] = '<strong>'.$speclist["left_text"].'</strong>';
                              }
                              echo '<tr>
                      <td>'.$speclist["left_text"].'</td>
                      <td>'.$speclist["right_text"].'</td>
                             </tr>';
                          }
                          echo '</tbody></table>';
                      }
                    ?>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="specification">
                    <?php
                      $specifications = get_field("specifications_right");
                      foreach ($specifications as $spec) {
                          echo '<h5 class="my-3">'.$spec["title"].'</h5>';
                          echo '<table><tbody>';
                          foreach ($spec["list"] as $speclist) {
                              if ($speclist["bold_left"]) {
                                  $speclist["left_text"] = '<strong>'.$speclist["left_text"].'</strong>';
                              }
                              echo '<tr>
                      <td>'.$speclist["left_text"].'</td>
                      <td>'.$speclist["right_text"].'</td>
                             </tr>';
                          }
                          echo '</tbody></table>';
                      }
                    ?>
                </div>
              </div>
              <div class="col-md-1"></div>
            </div>
          </div>
          <!-- Specifications -->
          <!-- Components -->
          <?php if($components) : ?>
              <div class="tab-pane fade" id="component" role="tabpanel" aria-labelledby="component-tab">
                  <?php echo do_shortcode($components); ?>
              </div>
          <?php endif; ?>
          <!-- /Components -->
        </div>
      </div>
    </div>
  </div>
</section>
