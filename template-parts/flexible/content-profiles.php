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
$profiles = get_sub_field("profiles");

?>
<section class="profiles section-padding <?php echo $overlay_grey_position;?>" style="<?php echo $background_color.$background_image;?>">
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
        foreach($profiles as $profile){ ?>
            <?php
                $profileInfo = $profile["profile_group"];
                $social = $profile['social'];

                $profileImage = $profile["image"];

                if($profileImage):
                    $profilePhoto = $profileImage;
                else:
                    $profilePhoto = '/wp-content/themes/mizuho/images/mizuho_default.svg';
                endif;

                $lightboxID = str_replace(' ', '_', strtolower($profileInfo["profile_name"]))
             ?>
            <div class="col-md-6 col-lg-4">
                <div class="profile">
                    <div class="brand-pillar-content">
                        <div>
                            <img src="<?php echo $profilePhoto; ?>" alt="<?php echo $profile["profile_name"]; ?>" class="img-fluid rounded-circle">
                            <h5><?php echo $profileInfo["profile_name"]; ?></h5>
                            <h6><?php echo $profileInfo["profile_title"]; ?></h6>
                            <?php echo $profile["short_profile"]; ?>
                        </div>
                    </div>
                    <?php if( $profileInfo["add_full_profile"] ) : ?>
                        <?php
                            $twitter = $social['twitter'];
                            $linkedin = $social['linkedin'];
                         ?>
                        <div class="link">
                            <a data-fancybox data-src="#<?php echo $lightboxID; ?>" href="javascript:;"><?php echo $profile["link_text"]; ?> <i class="fas fa-angle-right ml-2"></i></a>
                        </div>
                        <div class="profile-lightbox" style="display:none" id="<?php echo $lightboxID; ?>">
                            <div>
                                <div class="profile-image-sm">
                                    <img src="<?php echo $profilePhoto; ?>" alt="<?php echo $profile["profile_name"]; ?>" class="img-fluid rounded-circle">
                                </div>
                                <div class="profile-full">
                                    <h5><?php echo $profileInfo["profile_name"]; ?></h5>
                                    <div class="profile-meta">
                                        <div class="profile-left">
                                            <h6><?php echo $profileInfo["profile_title"]; ?></h6>
                                        </div>
                                        <?php if( $twitter || $linkedin ) : ?>
                                            <div class="profile-right">
                                                <ul>
                                                    <?php if( $linkedin ): ?>
                                                        <li>
                                                            <a href="<?php echo $linkedin; ?>" target="_blank">
                                                                <i class="fab fa-linkedin-in"></i>
                                                            </a>
                                                        </li>
                                                    <?php endif; ?>
                                                    <?php if( $twitter ) : ?>
                                                    <li>
                                                        <a href="<?php echo $twitter ?>" target="_blank">
                                                            <i class="fab fa-twitter"></i>
                                                        </a>
                                                    </li>
                                                <?php endif; ?>
                                                </ul>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="profile-content">
                                        <?php echo $profile["full_profile"]; ?>
                                    </div>
                                </div>
                            </div>

                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php }
      ?>
    </div>
  </div>
</section>
