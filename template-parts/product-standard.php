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

          $wpseo_primary_term = new WPSEO_Primary_Term( 'product_cat', get_the_ID() );
          $wpseo_primary_term = $wpseo_primary_term->get_primary_term();
          $termseo = get_term( $wpseo_primary_term );
          if(@$termseo->term_id){
              $listmenuArray = Array();
              $listmenuArray[] = Array("link" => get_term_link($termseo->term_id), "name" => $termseo->name);
              if($termseo->parent>0){
                $termseo2 = get_term( $termseo->parent, "product_cat" ); 
                $listmenuArray[] = Array("link" => get_term_link($termseo2->term_id), "name" => $termseo2->name);
                if($termseo2->parent>0){
                  $termseo3 = get_term( $termseo2->parent, "product_cat" ); 
                  $listmenuArray[] = Array("link" => get_term_link($termseo3->term_id), "name" => $termseo3->name);
                  if($termseo3->parent>0){
                    $termseo4 = get_term( $termseo3->parent, "product_cat" ); 
                    $listmenuArray[] = Array("link" => get_term_link($termseo4->term_id), "name" => $termseo4->name);
                    if($termseo4->parent>0){
                      $termseo5 = get_term( $termseo4->parent, "product_cat" ); 
                      $listmenuArray[] = Array("link" => get_term_link($termseo5->term_id), "name" => $termseo5->name);
                      if($termseo5->parent>0){
                        $termseo6 = get_term( $termseo5->parent, "product_cat" ); 
                        $listmenuArray[] = Array("link" => get_term_link($termseo6->term_id), "name" => $termseo6->name);
                      }                         
                    }                          
                  }                      
                }                
              }
              $lastitem = "";
              $listmenu = "";
              for($counter=(count($listmenuArray)-1);$counter>=0;$counter--){
                  if ($counter==0) {
                      //last item
                      $lastitem = '<span class="d-inline-flex align-items-center d-md-none"><a href="#"><i class="fas fa-angle-left mr-2"></i><span class="d-none">breadcrumb</span></a></span><a href="'.$listmenuArray[$counter]["link"].'">'.$listmenuArray[$counter]["name"].'</a>';
                  } else {
                      $listmenu .= ' <a href="'.$listmenuArray[$counter]["link"].'">'.$listmenuArray[$counter]["name"].'</a> /';
                  }
              }
          }
          else{
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
                      $lastitem = '<span class="d-inline-flex align-items-center d-md-none"><a href="#"><i class="fas fa-angle-left mr-2"></i><span class="d-none">breadcrumb</span></a></span><a href="'.get_term_link($children).'">'.$children->name.'</a>';
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
                  $lastitem = '<span class="d-inline-flex align-items-center d-md-none"><a href="#"><i class="fas fa-angle-left mr-2"></i><span class="d-none">breadcrumb</span></a></span><a href="'.get_term_link($category).'">'.$category->name.'</a>';
                }
                else{
                  $listmenu .= ' <a href="'.get_term_link($category).'">'.$category->name.'</a> /';
                }
              }
            }
          }
        ?>

        <span class="d-none d-md-inline-block"><a href="<?php echo get_option("siteurl");?>">Home</a> / <?php echo $listmenu;?></span> <?php echo $lastitem;?>
      </div>
      <div class="col-3 text-right">
        <a href="" class="splink"><i class="fas fa-share-alt"></i><span class="d-none">Share</span></a>
        <div class="sharepopup"><?php echo do_shortcode('[ssba-buttons]');?></div>
      </div>
    </div>
    <div class="row mt-3 mt-md-5">
        <!-- Marquee Slider -->
      <div class="col-md-6">
        <!-- Mobile Title -->
        <span class="d-block d-md-none">
          <h2><?php echo $post->post_title;?></h2>
          <?php if ($sku) {
            echo '<p class="eyebrow">PART #'.$sku.'</p>';
        }?>
        </span>
        <!-- Start Slider -->
        <div id="mainImages">
            <!-- Start Main Carousel -->
            <div id="mainCarousel" class="owl-carousel owl-theme">
                <!-- Repeater -->
                <?php
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

                        if ($video) {
                            $video = '<a href="'.$video.'" data-fancybox class="link-label"><span class="d-none">Link</span></a><img src="'.$themeurl.'/images/icon-video.svg" alt="icon video" class="icon-media">';
                        }

                        echo '
                        <div class="item">
                            <img src="'.$image.'" alt="'.$title.'" class="img-fluid w-100">';
                            if( $showDesc ) {
                                echo '
                                    <div class="label">
                                        '.$video.'
                                        '.$title.'
                                        '.$description.'
                                        '.$image_video_sub_title.'
                                    </div>
                                ';
                            }
                        echo '</div>';
                    }
                ?>
                <!-- /Repeater -->
            </div>
            <!-- Start Carousel Thumbnails -->
            <div id="thumbs" class="owl-carousel owl-theme">
                <!-- Repeater -->
                <?php
                    foreach ($product_media as $productdata) {
                        $image = $productdata["image"];
                        $video = $productdata["video"];
                        $class="";
                        if ($video) {
                            $video = '<a href="'.$video.'" data-fancybox class="link-label"><span class="d-none">Link</span></a><img src="'.$themeurl.'/images/icon-video.svg" alt="icon video" class="icon-media">';
                            $class.=" video";
                        }
                        echo '
                            <div class="item'.$class.'">
                                <img src="'.$image.'" alt="thumb product sub 1" class="img-fluid">
                            </div>
                        ';
                    }
                ?>
                <!-- /Repeater -->
            </div>
        </div>
        <!-- End Slider -->
      </div>

      <!-- Marquee Content -->
      <div class="col-md-6">
        <span class="d-none d-md-block">
          <h2><?php echo $post->post_title;?></h2>
          <?php if ($sku) {
                echo '<p class="eyebrow">PART #'.$sku.'</p>';
            }?>
        </span>
        <div class="shortdescription">
            <?php the_excerpt(); ?>
        </div>
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
                  <div class="row">
                      <div class="col-lg-6">
                        <?php the_field('components'); ?>
                      </div>
                      <div class="col-lg-6">
                        <?php the_field('components_right'); ?>
                      </div>
                  </div>
              </div>
          <?php endif; ?>
          <!-- /Components -->
        </div>
      </div>
    </div>
  </div>
</section>
