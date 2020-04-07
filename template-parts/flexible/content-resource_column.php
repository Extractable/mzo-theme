<?php
$background_image = get_sub_field("background_image");
$background_color = get_sub_field("background_color");
$overlay_grey_position = get_sub_field("overlay_grey_position");

if ($background_image) {
    $background_image = 'background-image:url('.$background_image.');';
}
if ($background_color) {
    $background_color = 'background-color:'.$background_color.';';
}
if ($overlay_grey_position) {
    if ($overlay_grey_position=="top") {
        $overlay_grey_position = 'top-bg-grey';
    }
    if ($overlay_grey_position=="bottom") {
        $overlay_grey_position = 'bottom-bg-grey';
    }
}
$title = get_sub_field("title");
$icon = get_sub_field("icon");
$content = get_sub_field("content");
$resources = get_sub_field("resources");
?>
<section class="resources-icons <?php echo $overlay_grey_position;?>" style="<?php echo $background_color.$background_image;?>">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h3><?php echo $title;?></h3>
      </div>
      <div class="col-12 mt-4">
        <div class="row">
            <?php if ( have_rows('resources') ) : ?>
				<?php while( have_rows('resources') ): the_row(); ?>
                    <?php
                        $resouceLink = get_sub_field('url_array');
                        $resourceContent = get_sub_field('content');
                    ?>
                    <div class="col-lg-4 col-md-6">
                      <div class="row resources">
                        <div class="col-2 col-md-3 px-0">
                            <a href="<?php echo $resouceLink['url']; ?>" target="<?php echo $resouceLink['target']; ?>"><img src="<?php the_sub_field('icon'); ?>"></a>
                        </div>
                        <div class="col-10 col-md-9">
                            <div class="resource-content">
                                <h3><?php the_sub_field('title'); ?></h3>
                                <?php
                                    if( $resourceContent ) {
                                        echo $resourceContent;
                                    }
                                ?>
                            </div>
                            <?php if( $resouceLink ) : ?>
                                <div class="resource-link">
                                    <a class="text-link-arrow" href="<?php echo $resouceLink['url']; ?>" target="<?php echo $resouceLink['target']; ?>"><?php echo $resouceLink['title']; ?> <i class="fas fa-angle-right ml-2"></i></a>
                                </div>
                            <?php endif; ?>
                        </div>
                      </div>
                    </div>
				<?php endwhile;
			endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>
