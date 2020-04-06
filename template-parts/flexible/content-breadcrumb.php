<?php
$hide_in_desktop = get_sub_field("hide_in_desktop");
$title = get_sub_field("title");
$url = get_sub_field("url");
if($hide_in_desktop){
?>
<section class="top-breadcrumb d-block d-md-none">
<div class="container">
  <div class="row">
    <div class="col-12">
      <?php
        $breadcrumbs = get_sub_field("breadcrumb");
        foreach($breadcrumbs as $breadcrumb){
          echo '<span class="d-inline-flex align-items-center d-md-none"><a href="#"><i class="fas fa-angle-right mr-2"></i><span class="d-none">breadcrumb</span></a></span><a href="'.$breadcrumb["url"].'">'.$breadcrumb["title"].'</a>';
        }
      ?>
    </div>
  </div>
</div>
</section>
<?php
} else {
?>
<section class="top-breadcrumb">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <span class="d-none d-md-inline-block"><a href="<?php echo get_option("siteurl");?>">Home</a></span>
      <?php
        $breadcrumbs = get_sub_field("breadcrumb");
        foreach($breadcrumbs as $breadcrumb){
          echo '<span class="d-none d-md-inline-block" style="padding-right: 5px;">/</span><span class="d-inline-block d-md-none" style="padding-right: 5px;"></span><span class="d-inline-flex align-items-center d-md-none"><a href="#"><i class="fas fa-angle-right mr-2"></i><span class="d-none">breadcrumb</span></a></span><a href="'.$breadcrumb["url"].'">'.$breadcrumb["title"].'</a> ';
        }
      ?>
      </div>
    </div>
  </div>
</section>
<?php
}
?>