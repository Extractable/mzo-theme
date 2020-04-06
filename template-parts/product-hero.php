<?php
$themeurl = get_stylesheet_directory_uri();
$product = wc_get_product();
$sku = $product->get_sku();
?>
<section class="hero-product-marquee">
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
      <div class="col-12 col-md-7">
        <h2><?php echo $post->post_title;?></h2>
        <?php if($sku){echo '<p class="eyebrow">PART #'.$sku.'</p>';}?>
      </div>
    </div>
    <div class="row mt-3">
      <div class="col-12">
        <div class="hero-product">
          <?php 
            $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full'); 
            if( $featured_img_url )
              echo '<img src="'.$featured_img_url.'" alt="hero product marquee hero" class="img-fluid media-bg">';

            $video_url = get_field("video_url");
            if( $video_url )
              echo '<a href="'.$video_url.'" data-fancybox class="video-link"><img src="'.$themeurl.'/images/icon-video-blue.svg" alt="icon video" class="img-fluid"></a>';
          ?>
          
          <div class="label">
            <div class="text-area">
               <div class="shortdescription"><?php the_excerpt(); ?></div>
            </div>
            <div class="button-area">
              <?php
              $request = get_field("request");
              if($request){
                echo '<div class="custom-button-dropdown"><a href="#collapseCustomDropdown" class="main-button collapsed" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseCustomDropdown">Request Information</a><div id="collapseCustomDropdown" class="dropdown-button collapse">';
                foreach($request as $reqdata){
                  echo '<a href="'.$reqdata["url"].'">'.$reqdata["title"].' <i class="fas fa-arrow-right"></i></a>';
                }
                echo '</div></div>';
              }
              $download_brochure_text = get_field("download_brochure_text");
              $download_brochure_url = get_field("download_brochure_url");
              if($download_brochure_url==""){
                $download_brochure_url = "#";
              }
              if($download_brochure_text){
                echo  '
                        <div class="download-brochure">
                          <p><a href="'.$download_brochure_url.'">'.$download_brochure_text.' <img src="'.$themeurl.'/images/button-download.svg" alt="download icon" class="img-fluid ml-2"></a></p>
                        </div>
                      ';
              }
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="home-product-thumbnails">
  <div class="container">
    <div class="row">
      <?php
        $thumbnails = get_field("thumbnails");
        foreach($thumbnails as $thumbnail){
          echo '
                  <div class="col-md-6 col-lg-3">
                    <div class="home-product-thumbnail">
                      <div class="square-img">
                        <a href="'.$thumbnail["image"].'" data-fancybox="gallery"><img src="'.$thumbnail["image"].'" alt="'.strip_tags($thumbnail["text"]).'" class="img-fluid"></a>
                      </div>
                      <p class="eyebrow">'.$thumbnail["text"].'</p>
                    </div>
                  </div>
               ';
        }
      ?>
    </div>
  </div>
</section>

<section class="product-overview section-padding mb-md-4">
  <div id="myCarousel" class="carousel slide">
    <div class="container">
      <div class="row features-product collapse show collapseProductOverview" id="collapseFeatures">
        <div class="col-12 text-area">
          <h3 class="mb-4">Features & Positions</h3>
        </div>
        <div class="col-12 media-area">
          <!-- main slider carousel items -->
          <div class="carousel-inner">
            <?php
              $features = get_field("features");
              $counter=0;
              foreach($features as $feature){
                $class="";
                if($counter<1)
                  $class="active";
                echo '
                      <div class="'.$class.' carousel-item" data-slide-number="'.$counter.'">
                        <div class="text-slide">
                          <h5 class="mb-3">'.$feature["title"].'</h5>
                          <div class="smallcontent">'.$feature["content"].'</div>
                        </div>
                        <img src="'.$feature["image"].'" alt="'.$feature["title"].'" class="img-fluid">
                      </div>                
                     ';
                $counter++;
              }
            ?>
          </div>
        </div>
      </div>
      <div class="row specification collapse collapseProductOverview" id="collapseSpecification">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <h3 class="mb-3">Specifications</h3>
            </div>
          </div>
          <div class="row">
            <div class="col-md-5">
              <?php
                $specifications = get_field("specifications_left");
                foreach($specifications as $spec){
                	echo '<h5 class="my-3">'.$spec["title"].'</h5>';
                	echo '<table><tbody>';
                	foreach($spec["list"] as $speclist){
                		if($speclist["bold_left"]){
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
            <div class="col-md-1"></div>
            <div class="col-md-5">
              <?php
                $specifications = get_field("specifications_right");
                foreach($specifications as $spec){
                	echo '<h5 class="my-3">'.$spec["title"].'</h5>';
                	echo '<table><tbody>';
                	foreach($spec["list"] as $speclist){
                		if($speclist["bold_left"]){
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
            <div class="col-md-1"></div>
          </div>
        </div>
      </div>
      <div class="row explore mt-3 mt-md-5">
        <div class="col-lg-9">
          <h6>Explore Features & Positions</h6>
          <ul class="carousel-indicators list-inline">
            <?php
              $features = get_field("features");
              $counter=0;
              foreach($features as $feature){
                $class="";
                if($counter<1)
                  $class="active";
                echo '    
                      <li class="list-inline-item '.$class.'">
                        <a id="carousel-selector-'.$counter.'" class="selected" data-slide-to="'.$counter.'" data-target="#myCarousel">
                          <img src="'.$feature["image"].'" alt="'.$feature["title"].'" class="img-fluid">
                        </a>
                      </li>          

                     ';
                $counter++;
              }
            ?>
          </ul>
        </div>
        <div class="col-lg-3">
          <h6>Specifications</h6>
          <button class="specification-button collapsed" type="button" data-toggle="collapse" data-target=".collapseProductOverview" aria-expanded="false" aria-controls="collapseFeatures collapseSpecification">View Specifications</button>
        </div>
      </div>
    </div>
  </div>
</section>