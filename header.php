<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package mizuho
 */
$themesite = get_stylesheet_directory_uri();
$logo = get_field('logo', 'option');
$header_right = get_field('header_right', 'option');
$blue_button_text = get_field('blue_button_text', 'option');
$blue_button_url = get_field('blue_button_url', 'option');
if($blue_button_url==""){
  $blue_button_url ="#";
}
$hide_header_menu = get_field("hide_header_menu");
$mobile_hide_menu = get_field('mobile_hide_menu', 'option');
$header_text = get_field("header_text");
if($header_text)
  $header_text = '<h6 class="ml-5 mt-2 d-none d-lg-block">'.$header_text.'</h6>';

$contenthmenu1 = "";
$contenthmenu2 = '<ul class="navbar-nav d-lg-none">';
foreach($mobile_hide_menu as $mhmenu){
  $contenthmenu1 .= '<a href="'.$mhmenu["url"].'" class="ml-4">'.$mhmenu["text"].'</a>';
  $contenthmenu2 .= '<li class="nav-item"><a class="nav-link" href="'.$mhmenu["url"].'">'.$mhmenu["text"].'</a></li>';
}
$contenthmenu2 .= '</ul>';

//global $template; echo basename($template)."aaaaaaaaa";
?>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
 	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="https://gmpg.org/xfn/11">
  	<!-- Favicon -->
  	<link rel="shortcut icon" href="<?php echo $themesite;?>/images/favicon.png" type="image/x-icon">
	<!-- FontAwesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />
  <script type="text/javascript">var themeurl="<?php echo $themesite;?>";var ajaxurl = "<?php echo  admin_url( 'admin-ajax.php' );?>"</script>
	<link rel="stylesheet" href="<?php echo $themesite;?>/assets/css/theme.min.css?time=<?php echo time(); ?>">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

  <header>
    <div class="container">
      <div class="row">
        <nav class="navbar navbar-expand-lg w-100 flex-wrap p-0 <?php if($hide_header_menu){echo 'py-lg-3';}?>">
          <div class="col-12 header-top d-flex align-content-center flex-wrap justify-content-between">
            <a class="navbar-brand" href="<?php echo get_option("siteurl");?>"><img src="<?php echo $logo;?>" alt="logo mizuho" class="img-fluid" width="278"><?php if($hide_header_menu){echo $header_text;}?></a>
            <div class="header-top-right text-right d-none d-lg-flex align-items-center">
              <?php
               if($hide_header_menu){
                echo $contenthmenu1;
               }
               else{
                echo $header_right;
               }
              ?>
              <?php echo get_search_form();?>
            </div>
            <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
            </button>
          </div>
          <div class="collapse navbar-collapse menu-area" id="navbarNavDropdown">
           <?php
           if($hide_header_menu){
            echo  $contenthmenu2;
           }
           else{
            echo '<div class="desktopmenu">';
            wp_nav_menu(array('container' => false, 'theme_location' => 'menu-1', 'menu_class' => 'navbar-nav'));
            echo '</div>';
            echo '<div class="mobilemenu dl-menuwrapper">';
            wp_nav_menu(array('container' => false, 'theme_location' => 'menu-mobile', 'menu_class' => 'navbar-nav dl-menu dl-menuopen'));
            echo '</div>';
           }
           ?>
          </div>
          <div class="nav-item menu-contact-us <?php if($hide_header_menu){ echo 'd-flex d-md-none';}?>">
              <?php
                if($blue_button_text){
                    echo '<a class="nav-link text-uppercase" href="'.$blue_button_url.'">'.$blue_button_text.'</a>';
                }
              ?>
          </div>
        </nav>
      </div>
    </div>
  </header>
