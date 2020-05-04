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
          	$header_image = get_field("header_image");
          	if($header_image)
          		$featured_img_url = $header_image;
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
              $dropdown_title = get_field("dropdown_title");
              $request = get_field("request");
              if($request){
                echo '<div class="custom-button-dropdown"><a  data-target="#collapseCustomDropdown" class="main-button collapsed" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseCustomDropdown">'. $dropdown_title .'</a><div id="collapseCustomDropdown" class="dropdown-button collapse">';
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

<?php
  $features_background_color = get_field("features_background_color");
  $features_flip_position = get_field("features_flip_position");
  $features_title = get_field("features_title");
  if($features_title)
    $features_title = '<h3>'.$features_title.'</h3>';
  $features_image = get_field("features_image");
  if($features_image)
    $media = '<img src="'.$features_image.'" alt="'.$features_title.'" class="img-fluid mb-3 mb-md-0">';
  $features_media = get_field("features_media");
  if($features_media)
    $media = $features_media;
  $features_content = get_field("features_content");

  $order1 = "order-md-1";
  $order2 = "order-md-2";
  $order3 = "order-md-3";
  if($features_flip_position){
    $order1 = "order-md-3";
    $order2 = "order-md-2";
    $order3 = "order-md-1";
  }
?>
<section class="features section-padding mt-4">
  <div class="container">
    <div class="row">
      <div class="col-md-6 text-area order-2 <?php echo $order1;?>">
        <?php
          echo $features_title;
          echo $features_content;
        ?>
      </div>
      <div class="col-md-1 <?php echo $order2;?>"></div>
      <div class="col-md-5 media-area order-1 <?php echo $order3;?>">
        <?php
          echo $media;
        ?>
      </div>
    </div>
  </div>
</section>
