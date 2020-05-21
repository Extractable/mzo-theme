<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package mizuho
 */
$themesite = get_stylesheet_directory_uri();
$footer_logo = get_field('footer_logo', 'option');
$footer_call_text = get_field('footer_call_text', 'option');
$footer_copyright_text = get_field('footer_copyright_text', 'option');
$footer_social_text = get_field('footer_social_text', 'option');
$footer_link_text = get_field('footer_link_text', 'option');
?>

<footer>
  <div class="container">
    <div class="row no-gutters">
      <div class="col-12 text-center pb-2 mb-4">
        <a href="/"><img src="<?php echo $footer_logo;?>" alt="footer-logo" class="img-fluid" width="278"></a>
      </div>
      <div class="col">
        <?php dynamic_sidebar("footer-1");?>
      </div>
      <div class="col">
        <?php dynamic_sidebar("footer-2");?>
      </div>
      <div class="col">
        <?php dynamic_sidebar("footer-3");?>
      </div>
      <div class="col">
        <?php dynamic_sidebar("footer-4");?>
      </div>
      <div class="col footer-about-us">
        <?php dynamic_sidebar("footer-5");?>
      </div>
      <div class="col d-block d-md-none tabletshow">
        <div class="footer-social mb-2">
          <?php echo $footer_social_text; ?>
        </div>
        <div class="footer-call"><?php echo $footer_call_text; ?></div>
      </div>
    </div>
    <div class="row mt-5 d-none d-md-flex tablethide">
      <div class="col-md-6">
        <div class="footer-call"><?php echo $footer_call_text; ?></div>
        <div class="legal"><?php echo $footer_copyright_text; ?></div>
      </div>
      <div class="col-md-6">
        <div class="footer-social text-right mb-2">
          <?php echo $footer_social_text; ?>
        </div>
        <div class="legal text-right">
          <?php echo $footer_link_text; ?>
        </div>
      </div>
    </div>
    <div class="row d-block d-md-none tabletshow">
      <div class="col-12">
        <div class="legal text-center mb-1">
          <?php echo $footer_link_text; ?>
        </div>
        <div class="legal text-center"><?php echo $footer_copyright_text; ?></div>
      </div>
    </div>
  </div>
</footer>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/iframe-resizer/4.2.10/iframeResizer.min.js"></script>
<script src="<?php echo $themesite;?>/assets/js/jquery.matchHeight-min.js"></script>
<script src="<?php echo $themesite;?>/assets/js/theme.js?time=<?php echo time(); ?>"></script>

<?php wp_footer(); ?>
<div id="hiddenmenumobile" style="display:none;"><?php echo get_field("mobile_menu","option");?></div>
</body>

</html>
