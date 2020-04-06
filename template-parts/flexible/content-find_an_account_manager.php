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
$content_background_overlay = get_sub_field("content_background_overlay");
$content_background_overlay_mobile = get_sub_field("content_background_overlay_mobile");
$title = get_sub_field("title");
$content = get_sub_field("content");

if($content_background_overlay){
  echo '<style type="text/css">
          @media (max-width: 767.98px){
            .sectionpb'.get_row_index().'.page-break .page-break-text-area{
              background-color: transparent!important;
            }
            .sectionpb'.get_row_index().'.page-break .page-break-text-area::before{
              background:'.$content_background_overlay_mobile.';
            }
          }
        </style>';
  $content_background_overlay = 'background-color:'.$content_background_overlay.';';
}
if($media){
  $content1 = $media;
}
?>
<section class="sectionfam<?php echo get_row_index();?> account-manager-finder section-padding <?php echo $overlay_grey_position;?>" style="<?php echo $background_color.$background_image;?>">
  <div class="container">
    <div class="row">
      <div class="col-12 text-center">
        <?php
          if($title){
            echo '<h3 class="mb-md-4">'.$title.'</h3>';
          }
          if($content){
            echo do_shortcode($content);
          }
        ?>
      </div>
      <div class="col-md-6 col-lg-4 mx-auto mt-md-4">
        <form action="#" method="post" name="formManager" id="formManager">
          <div class="form-group">
            <label for="selectCountry" class="d-none">Select</label>
            <select class="form-control" id="selectCountry" required>
              <option value="us">United States</option>
              <option value="international">International</option>
            </select>
          </div>
          <div class="form-group">
            <label for="zipCodeInput" class="d-none">Zip Code</label>
            <input type="text" required class="form-control" id="zipCodeInput" placeholder="Zip Code / Country">
          </div>
          <div class="text-center my-4">
            <button type="submit" class="btn btn-primary mb-2">SEARCH</button>
          </div>
        </form>
        <div class="loadingarea" style="display:none;"><img src="<?php echo get_stylesheet_directory_uri();?>/images/Blocks-1s-200px.svg" alt="" style="width: 70px;" /></div>
        <div class="formresults"></div>
      </div>      
    </div>
  </div>
</section>
<style type="text/css">
.loadingarea{
    margin: 0 auto;
    text-align: center;
}
.managersection{
    font-size: 16px;
}
.managersection img{
    max-width: 100%;
}
.managersection .managerposttitle{
	font-weight: bold;
}
.managersection .managercell{
	margin-top:15px;
}
.managersection .loc_details{
	margin-bottom:15px;
}
</style>
<script type="text/javascript">
	jQuery(document).ready(function(){
		jQuery( "#formManager" ).submit(function( event ) {
			jQuery(".loadingarea").show();
			jQuery(".formresults").html("");
			event.preventDefault();
			jQuery.ajax({
			  method: "POST",
			  url: "?ajax=1&action=manager",
			  data: { country: jQuery("#selectCountry").val(), zip: jQuery("#zipCodeInput").val() }
			}).done(function( msg ) {
				jQuery(".loadingarea").hide();
			    jQuery(".formresults").html(msg);
			});	
		});			
	});
</script>