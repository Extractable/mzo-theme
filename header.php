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
if ($blue_button_url=="") {
    $blue_button_url ="#";
}
$hide_header_menu = get_field("hide_header_menu");
$mobile_hide_menu = get_field('mobile_hide_menu', 'option');
$header_text = get_field("header_text");
if ($header_text) {
    $header_text = '<h6 class="ml-5 mt-2 d-none d-lg-block">'.$header_text.'</h6>';
}

$contenthmenu1 = "";
$contenthmenu2 = '<ul class="navbar-nav d-lg-none">';
foreach ($mobile_hide_menu as $mhmenu) {
    $contenthmenu1 .= '<a href="'.$mhmenu["url"].'" class="ml-4">'.$mhmenu["text"].'</a>';
    $contenthmenu2 .= '<li class="nav-item"><a class="nav-link" href="'.$mhmenu["url"].'">'.$mhmenu["text"].'</a></li>';
}
$contenthmenu2 .= '</ul>';

?>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
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
  <script type="text/javascript">var themeurl="<?php echo $themesite;?>";var ajaxurl = "<?php echo  admin_url('admin-ajax.php');?>"</script>
	<link rel="stylesheet" href="<?php echo $themesite;?>/assets/css/theme.min.css?time=<?php echo time(); ?>">
	<?php wp_head(); ?>
    <script>
        (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-53W3XFV');
    </script>
</head>

<body <?php body_class(); ?>>

  <header>
    <div class="container header-top">
        <div class="row align-items-center flex-wrap justify-content-between">
            <div class="col-6">
                <a class="navbar-brand" href="<?php echo get_option("siteurl");?>">
                    <img src="<?php echo $logo;?>" alt="logo mizuho" class="img-fluid" width="278">
                    <?php if ($hide_header_menu) {
    echo $header_text;
}?>
                </a>
            </div>
            <div class="col-6 header-top-right ">
                <div class="d-none d-lg-flex text-right align-items-center justify-content-end">
                    <?php
                     if ($hide_header_menu) {
                         echo $contenthmenu1;
                     } else {
                         echo $header_right;
                     }
                    ?>
                    <?php echo get_search_form();?>
                </div>
                <?php
                    if (!$hide_header_menu) {
                        echo '
                            <div class="d-block d-lg-none d-xl-none text-right align-items-center justify-content-end test" style="position: relative;">
                                <button class="mmmenu wpmm-button collapsed" type="button" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                                    <div id="nav-icon3">
                                          <span></span>
                                          <span></span>
                                          <span></span>
                                          <span></span>
                                      </div>
                                </button>
                            </div>
                        ';
                    } else {
                        echo $contenthmenu2;
                    }
                 ?>
            </div>
        </div>
    </div>
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-12">
                <div class="menu-container">
                    <div class="menu-area">
                        <?php
                            if (!$hide_header_menu) {
                                echo '<div class="desktopmenu">';
                                wp_nav_menu(array('container' => false, 'theme_location' => 'menu-1', 'menu_class' => 'navbar-nav'));
                                echo '</div>';
                                echo '<div class="mobilemenu dl-menuwrapper">';
                                wp_nav_menu(array('container' => false, 'theme_location' => 'menu-mobile', 'menu_class' => 'navbar-nav dl-menu '));
                                echo '</div>';
                            }
                         ?>
                        <?php if (!$hide_header_menu): ?>
                            <div class="menu-contact-us <?php if ($hide_header_menu) {
                             echo 'd-flex d-md-none';
                         }?>">
                                <?php
                                  if ($blue_button_text) {
                                      echo '<a class="nav-link text-uppercase" href="'.$blue_button_url.'">'.$blue_button_text.'</a>';
                                  }
                                ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>


  </header>
