var isIphone = navigator.userAgent.indexOf("iPhone") != -1;
var isIpod = navigator.userAgent.indexOf("iPod") != -1;
var isIpad = navigator.userAgent.indexOf("iPad") != -1;

// now set one variable for all iOS devices
var isIos = isIphone || isIpod || isIpad;

jQuery(document).ready(function() {
  if (isIos) {
    jQuery("body").addClass("ios");
  }
  jQuery(".product-owl-carousel").owlCarousel({
    nav: true,
    dots: false,
    stagePadding: 50,
    responsiveClass: true,
    responsive: {
      0: {
        items: 1,
        nav: true
      },
      600: {
        items: 3,
        nav: true
      },
      1000: {
        items: 5,
        nav: true,
        loop: false
      }
    }
  });

  jQuery(".education-owl-carousel").owlCarousel({
    nav: true,
    dots: false,
    stagePadding: 70,
    responsiveClass: true,
    responsive: {
      0: {
        items: 1,
        nav: true
      },
      600: {
        items: 2,
        nav: true
      },
      1000: {
        items: 4,
        nav: true,
        loop: false
      }
    }
  });

  var bigimage = jQuery("#mainCarousel");
  var thumbs = jQuery("#thumbs");
  //var totalslides = 10;
  var syncedSecondary = true;

  bigimage
    .owlCarousel({
      items: 1,
      slideSpeed: 7000,
      nav: false,
      autoplay: false,
      dots: false,
      loop: true,
      responsiveRefreshRate: 200,
      animateOut: 'fadeOut',
         animateIn: 'fadeIn',
    })
    .on("changed.owl.carousel", syncPosition);

  thumbs
    .on("initialized.owl.carousel", function() {
      thumbs
        .find(".owl-item")
        .eq(0)
        .addClass("current");
    })
    .owlCarousel({
      items: 6,
      dots: false,
      nav: true,
      navText: [
        '<i class="fas fa-caret-left"></i>',
        '<i class="fas fa-caret-right"></i>'
      ],
      smartSpeed: 200,
      slideSpeed: 500,
      slideBy: 6,
      responsiveRefreshRate: 100,
      responsive: {
        0: {
          items: 2,
          slideBy: 2,
        },
        600: {
          items: 4,
          slideBy: 4,
        },
        1000: {
          items: 6,
          nav: true,
          slideBy: 6,
        }
      }
    })
    .on("changed.owl.carousel", syncPosition2);

  function syncPosition(el) {
    //if loop is set to false, then you have to uncomment the next line
    //var current = el.item.index;

    //to disable loop, comment this block
    var count = el.item.count - 1;
    var current = Math.round(el.item.index - el.item.count / 2 - 0.5);

    if (current < 0) {
      current = count;
    }
    if (current > count) {
      current = 0;
    }
    //to this

    thumbs
      .find(".owl-item")
      .removeClass("current")
      .eq(current)
      .addClass("current");
    var onscreen = thumbs.find(".owl-item.active").length - 1;
    var start = thumbs
      .find(".owl-item.active")
      .first()
      .index();
    var end = thumbs
      .find(".owl-item.active")
      .last()
      .index();

    if (current > end) {
      thumbs.data("owl.carousel").to(current, 100, true);
    }
    if (current < start) {
      thumbs.data("owl.carousel").to(current - onscreen, 100, true);
    }
  }

  function syncPosition2(el) {
    if (syncedSecondary) {
      var number = el.item.index;
      bigimage.data("owl.carousel").to(number, 100, true);
    }
  }

  thumbs.on("click", ".owl-item", function(e) {
    e.preventDefault();
    var number = $(this).index();
    bigimage.data("owl.carousel").to(number, 300, true);
  });









  jQuery("a.hsearch").click(function(e) {
    jQuery(".search-form").toggle();
    e.preventDefault();
  });
  jQuery(".navbar-toggler i").click(function(e) {
    if (jQuery(".navbar-toggler").hasClass("collapsed")) {
      jQuery(".navbar-toggler").removeClass("collapsed");
      jQuery(".navbar-toggler").addClass("expanded");
      jQuery(".wpmm-menu").addClass("mm-menu_opened");
    } else {
      jQuery(".navbar-toggler").addClass("collapsed");
      jQuery(".navbar-toggler").removeClass("expanded");
      jQuery(".wpmm-menu").removeClass("mm-menu_opened");
    }
  });
  setTimeout(function() {
    jQuery(".mm-listview").append('<li class="mm-listitem">' + jQuery("#hiddenmenumobile").html() + '</li>');
  }, 500);

  setTimeout(function() {
    jQuery(".wpmm-menu .mm-navbars_top").hide();
    jQuery(".mm-menu_navbar_top-1 .mm-panels").css("top", "0px");
    jQuery(".mm-btn").click(function() {
      jQuery(".wpmm-menu .mm-navbars_top").hide();
      setTimeout(function() {
        if (jQuery(".wpmm-menu .mm-navbars_top .mm-navbar_has-btns .mm-navbar__title").text() == "Menu") {
          jQuery(".wpmm-menu .mm-navbars_top").hide();
          jQuery(".mm-menu_navbar_top-1 .mm-panels").css("top", "0px");
        } else {
          jQuery(".wpmm-menu .mm-navbars_top").show();
          jQuery(".mm-menu_navbar_top-1 .mm-panels").css("top", "44px");
        }
      }, 500);
    });
  }, 500);

  //Show More Accessories Cards
  (function() {
    setTimeout(function() {
      size_li = $(".accessories-cards .load-card").length;
      x = 3;
      jQuery('.accessories-cards .load-card:lt(' + x + ')').show();

      if (size_li <= x) {
        jQuery('#loadMore').hide();
      }

      jQuery('#loadMore').click(function() {
        x = jQuery('.accessories-cards .load-card:visible').length + 6;
        if (x < size_li) {
          jQuery('.accessories-cards .load-card:lt(' + x + ')').show();
        } else {
          jQuery('.accessories-cards .load-card:lt(' + size_li + ')').show();
          jQuery('#loadMore').hide();
        }
      });
    }, 600);
  })();

  //Offset anchors
  (function() {
    jQuery('a[href^="#"]').on('click', function(event) {
      var target = $(this.getAttribute('href'));
      if (target.length) {
        event.preventDefault();
        jQuery('html, body').stop().animate({
          scrollTop: target.offset().top - 230
        }, 1000);
      }
    });
  })();


});

jQuery(window).scroll(function() {
  if (jQuery(window).scrollTop() > 100) {
    jQuery("body").addClass("sticky");
    jQuery('body.sticky header').stop().animate({
      top: 0
    }, 500);
  } else {
    jQuery("body").removeClass("sticky");
    jQuery("body header").removeAttr("style");
  }
});

jQuery.urlParam = function(name) {
  var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
  if (results == null) {
    return null;
  } else {
    return results[1] || 0;
  }
}

jQuery(function() {
  jQuery(".ssbp-wrap a.ssba_facebook_share img").attr("src", themeurl + "/images/footer-icon-fb.png");
  jQuery(".ssbp-wrap a.ssba_twitter_share img").attr("src", themeurl + "/images/footer-icon-twitter.png");
  jQuery(".ssbp-wrap a.ssba_linkedin_share img").attr("src", themeurl + "/images/footer-icon-linkedin.png");
  jQuery(".ssbp-wrap").show();

  jQuery(".splink").click(function(e) {
    e.preventDefault();
    jQuery(".sharepopup").toggle();
  });

  jQuery(".specification-button").click(function() {
    if (jQuery(this).html() == "View Specifications") {
      jQuery(this).html("View Features and Positions");
    } else if (jQuery(this).html() == "View Features and Positions") {
      jQuery(this).html("View Specifications");
    }
  });
  jQuery(".carousel-indicators li.list-inline-item a").click(function() {
    jQuery(".features-product.collapseProductOverview").addClass("show");
    jQuery(".specification.collapseProductOverview").removeClass("show");
    jQuery(".specification-button").html("View Specifications");
  });

  /*PRODUCT FILTER*/
  jQuery(".tax-product_cat .filter-checkbox input[type=checkbox]").change(function() {
    productcheckallfilters();
  });

  jQuery(".tax-product_cat .calist").click(function(e) {
    e.preventDefault();
    jQuery(this).parent().parent().find("input[type=checkbox]").prop('checked', false);
    productcheckallfilters();
  });

  jQuery(".tax-product_cat .showmoreproduct #myBtn").click(function() {
    jQuery("input[name=pg]").val(parseInt(jQuery("input[name=pg]").val()) + 1);
    jQuery(".field_cat").val(jQuery(".filter-area .category-list ul li a.active").attr("rel"));

    jQuery(".loadingpageproduct").html("<p style='text-align:center;'>Loading...</p>");

    var values = {};
    values['action'] = 'productload';
    values['pg'] = jQuery("input[name=pg]").val();
    values['cat'] = jQuery(".filter-area .category-list ul li a.active").attr("rel");

    jQuery(".fllist input.inputfl").each(function() {
      values["filter-" + jQuery(this).attr("rel")] = jQuery("input[name=" + jQuery(this).attr("rel") + "]").val();
    });
    jQuery.ajax({
      url: ajaxurl,
      type: 'post',
      data: values,
      success: function(result) {
        jQuery(".loadingpageproduct").html("");
        jQuery(".productloaddata").append(result);
      }
    });
  });


  function productcheckallfilters() {
    var inputdata = {};
    jQuery(".filter-checkbox input[type=checkbox]").each(function() {
      if (jQuery(this).is(':checked')) {
        if (inputdata[jQuery(this).attr("rel")] == undefined) {
          inputdata[jQuery(this).attr("rel")] = jQuery(this).val();
        } else {
          inputdata[jQuery(this).attr("rel")] = inputdata[jQuery(this).attr("rel")] + "," + jQuery(this).val();
        }
      }
    });
    jQuery(".fllist input.inputfl").each(function() {
      jQuery(this).val(inputdata[jQuery(this).attr("rel")]);
      if (jQuery(this).val() != "") {
        jQuery(".calist." + jQuery(this).attr("rel") + "ca").show();
      } else {
        jQuery(".calist." + jQuery(this).attr("rel") + "ca").hide();
      }
    });
    jQuery(".field_pg").val(1);
    /*
    if(workswith){
      jQuery(".workswithca").show();
    }
    else{
      jQuery(".workswithca").hide();
    }
    if(features){
      jQuery(".featuresca").show();
    }
    else{
      jQuery(".featuresca").hide();
    }
    if(anatomy){
      jQuery(".anatomyca").show();
    }
    else{
      jQuery(".anatomyca").hide();
    }
    */

    /*after process done we run query*/
    jQuery(".productloaddata").html("Loading...");
    jQuery(".showmoreproduct").hide();

    var values = {};
    values['action'] = 'productload';
    values['pg'] = jQuery("input[name=pg]").val();
    values['cat'] = jQuery(".filter-area .category-list ul li a.active").attr("rel");
    var urllink = "";
    jQuery(".fllist input.inputfl").each(function() {
      values["filter-" + jQuery(this).attr("rel")] = jQuery("input[name=" + jQuery(this).attr("rel") + "]").val();
      if (jQuery("input[name=" + jQuery(this).attr("rel") + "]").val() != "")
        urllink = urllink + jQuery("input[name=" + jQuery(this).attr("rel") + "]").val() + ",";
    });
    jQuery.ajax({
      url: ajaxurl,
      type: 'post',
      data: values,
      success: function(result) {
        jQuery(".productloaddata").html(result);
      }
    });
    if (urllink)
      history.pushState(null, null, "?filter=" + urllink);
  }
  /*PRODUCT FILTER*/


  /*RESOURCE FILTER*/
  jQuery(".resourcedata .filter-checkbox input[type=checkbox]").change(function() {
    resoucecheckallfilters();
  });
  /*jQuery(".resourcedata .filter-list ul li a").click(function(e){
    e.preventDefault();
    jQuery(".resourcedata .filter-list ul li a").removeClass("active");
    jQuery(this).addClass("active");
    resoucecheckallfilters();
  });*/

  jQuery(".resourcedata .resourcetypeca").click(function(e) {
    e.preventDefault();
    jQuery("#filter-type input[type=checkbox]").prop('checked', false);
    resoucecheckallfilters();
  });
  jQuery(".resourcedata .resourcesurgicalca").click(function(e) {
    e.preventDefault();
    jQuery("#filter-surgical-tables input[type=checkbox]").prop('checked', false);
    resoucecheckallfilters();
  });
  jQuery(".resourcedata .resourceotherca").click(function(e) {
    e.preventDefault();
    jQuery("#filter-other input[type=checkbox]").prop('checked', false);
    resoucecheckallfilters();
  });

  jQuery(".resourcedata .showmoreresource #myBtn").click(function() {
    jQuery("input[name=pg]").val(parseInt(jQuery("input[name=pg]").val()) + 1);
    jQuery(".field_cat").val(jQuery(".resourcedata .filter-list ul li a.active").attr("rel"));

    jQuery(".loadingpageproduct").html("<p style='text-align:center;'>Loading...</p>");
    jQuery.ajax({
      url: ajaxurl,
      type: 'post',
      data: {
        action: 'resourceload',
        pg: jQuery("input[name=pg]").val(),
        cat: jQuery(".field_cat").val(),
        resource_type: jQuery("input[name=resource_type]").val(),
        resource_surgical_table: jQuery("input[name=resource_surgical_table]").val(),
        resource_other_product: jQuery("input[name=resource_other_product]").val()
      },
      success: function(result) {
        jQuery(".loadingpageproduct").html("");
        jQuery(".productloaddata").append(result);
      }
    });
  });

  function resoucecheckallfilters() {
    var resource_type = "";
    var resource_surgical_table = "";
    var resource_other = "";
    jQuery(".resourcedata .filter-checkbox input[type=checkbox]").each(function() {
      if (jQuery(this).attr("rel") == "resourcetype" && jQuery(this).is(':checked')) {
        if (resource_type == "") {
          resource_type = jQuery(this).val();
        } else {
          resource_type = resource_type + "," + jQuery(this).val();
        }
      }
      if (jQuery(this).attr("rel") == "resourcesurgical" && jQuery(this).is(':checked')) {
        if (resource_surgical_table == "") {
          resource_surgical_table = jQuery(this).val();
        } else {
          resource_surgical_table = resource_surgical_table + "," + jQuery(this).val();
        }
      }
      if (jQuery(this).attr("rel") == "resourceother" && jQuery(this).is(':checked')) {
        if (resource_other == "") {
          resource_other = jQuery(this).val();
        } else {
          resource_other = resource_other + "," + jQuery(this).val();
        }
      }
    });
    jQuery(".field_cat").val(jQuery(".resourcedata .filter-list ul li a.active").attr("rel"));
    jQuery(".field_resource_type").val(resource_type);
    jQuery(".field_resource_surgical_table").val(resource_surgical_table);
    jQuery(".field_resource_other_product").val(resource_other);
    jQuery(".field_pg").val(1);
    if (resource_type) {
      jQuery(".resourcetypeca").show();
    } else {
      jQuery(".resourcetypeca").hide();
    }
    if (resource_surgical_table) {
      jQuery(".resourcesurgicalca").show();
    } else {
      jQuery(".resourcesurgicalca").hide();
    }
    if (resource_other) {
      jQuery(".resourceothercar").show();
    } else {
      jQuery(".resourceothercar").hide();
    }


    var urllink = "";
    if (jQuery("input[name=resource_type]").val() != "") {
      urllink = urllink + jQuery("input[name=resource_type]").val() + ",";
    }
    if (jQuery("input[name=resource_surgical_table]").val() != "") {
      urllink = urllink + jQuery("input[name=resource_surgical_table]").val() + ",";
    }
    if (jQuery("input[name=resource_other_product]").val() != "") {
      urllink = urllink + jQuery("input[name=resource_other_product]").val() + ",";
    }

    /*after process done we run query*/
    jQuery(".productloaddata").html("Loading...");
    jQuery(".showmoreproduct").hide();
    jQuery.ajax({
      url: ajaxurl,
      type: 'post',
      data: {
        action: 'resourceload',
        cat: jQuery("input[name=cat]").val(),
        resource_type: jQuery("input[name=resource_type]").val(),
        resource_surgical_table: jQuery("input[name=resource_surgical_table]").val(),
        resource_other_product: jQuery("input[name=resource_other_product]").val()
      },
      success: function(result) {
        jQuery(".productloaddata").html(result);
      }
    });

    if (urllink)
      history.pushState(null, null, "?filter=" + urllink);

  }
  /*RESOURCE FILTER*/


  /*CLASS FILTER*/
  jQuery(".classdata .filter-checkbox input[type=checkbox]").change(function() {
    classcheckallfilters();
  });
  /*jQuery(".classdata .filter-list ul li a").click(function(e){
    e.preventDefault();
    jQuery(".classdata .filter-list ul li a").removeClass("active");
    jQuery(this).addClass("active");
    classcheckallfilters();
  });*/

  jQuery(".classdata .classclassca").click(function(e) {
    e.preventDefault();
    jQuery("#filter-class input[type=checkbox]").prop('checked', false);
    classcheckallfilters();
  });
  jQuery(".classdata .classproductca").click(function(e) {
    e.preventDefault();
    jQuery("#filter-product input[type=checkbox]").prop('checked', false);
    classcheckallfilters();
  });
  jQuery(".classdata .classtypeca").click(function(e) {
    e.preventDefault();
    jQuery("#filter-type input[type=checkbox]").prop('checked', false);
    classcheckallfilters();
  });

  jQuery(".classdata .showmoreclass #myBtn").click(function() {
    jQuery("input[name=pg]").val(parseInt(jQuery("input[name=pg]").val()) + 1);
    jQuery(".field_cat").val(jQuery(".classdata .filter-list ul li a.active").attr("rel"));

    jQuery(".loadingpageclass").html("<p style='text-align:center;'>Loading...</p>");
    jQuery.ajax({
      url: ajaxurl,
      type: 'post',
      data: {
        action: 'classload',
        pg: jQuery("input[name=pg]").val(),
        cat: jQuery(".field_cat").val(),
        class_class: jQuery("input[name=class_class]").val(),
        class_product: jQuery("input[name=class_product]").val(),
        class_type: jQuery("input[name=class_type]").val()
      },
      success: function(result) {
        jQuery(".loadingpageclass").html("");
        jQuery(".classloaddata").append(result);
      }
    });
  });

  function classcheckallfilters() {
    var class_class = "";
    var class_product = "";
    var class_type = "";
    jQuery(".classdata .filter-checkbox input[type=checkbox]").each(function() {
      if (jQuery(this).attr("rel") == "classclass" && jQuery(this).is(':checked')) {
        if (class_class == "") {
          class_class = jQuery(this).val();
        } else {
          class_class = class_class + "," + jQuery(this).val();
        }
      }
      if (jQuery(this).attr("rel") == "classproduct" && jQuery(this).is(':checked')) {
        if (class_product == "") {
          class_product = jQuery(this).val();
        } else {
          class_product = class_product + "," + jQuery(this).val();
        }
      }
      if (jQuery(this).attr("rel") == "classtype" && jQuery(this).is(':checked')) {
        if (class_type == "") {
          class_type = jQuery(this).val();
        } else {
          class_type = class_type + "," + jQuery(this).val();
        }
      }
    });
    jQuery(".field_cat").val(jQuery(".classdata .filter-list ul li a.active").attr("rel"));
    jQuery(".field_class_class").val(class_class);
    jQuery(".field_class_product").val(class_product);
    jQuery(".field_class_type").val(class_type);
    jQuery(".field_pg").val(1);
    if (class_class) {
      jQuery(".classclassca").show();
    } else {
      jQuery(".classclassca").hide();
    }
    if (class_product) {
      jQuery(".classproductca").show();
    } else {
      jQuery(".classproductca").hide();
    }
    if (class_type) {
      jQuery(".classtypeca").show();
    } else {
      jQuery(".classtypeca").hide();
    }

    var urllink = "";
    if (jQuery("input[name=class_class]").val() != "") {
      urllink = urllink + jQuery("input[name=class_class]").val() + ",";
    }
    if (jQuery("input[name=class_product]").val() != "") {
      urllink = urllink + jQuery("input[name=class_product]").val() + ",";
    }
    if (jQuery("input[name=class_type]").val() != "") {
      urllink = urllink + jQuery("input[name=class_type]").val() + ",";
    }

    /*after process done we run query*/
    jQuery(".classloaddata").html("Loading...");
    jQuery(".showmoreclass").hide();
    jQuery.ajax({
      url: ajaxurl,
      type: 'post',
      data: {
        action: 'classload',
        cat: jQuery("input[name=cat]").val(),
        class_class: jQuery("input[name=class_class]").val(),
        class_product: jQuery("input[name=class_product]").val(),
        class_type: jQuery("input[name=class_type]").val()
      },
      success: function(result) {
        jQuery(".classloaddata").html(result);
      }
    });

    if (urllink)
      history.pushState(null, null, "?filter=" + urllink);

  }
  /*CLASS FILTER*/


  jQuery("#selectAccCategories").change(function() {
    if (jQuery("#selectAccCategories").val() == "") {
      jQuery(".accessories-cards .accessories-card").show();
    } else {
      jQuery(".accessories-cards .accessories-card").each(function() {
        if (jQuery(this).hasClass(jQuery("#selectAccCategories").val()))
          jQuery(this).show();
        else
          jQuery(this).hide();
      });
    }
  });


  if (jQuery.urlParam("filter")) {
    var filterlist = jQuery.urlParam("filter").split(",");
    var checked = 0;
    for (i = 0; i < filterlist.length; i++) {
      if (filterlist[i] != "") {
        checked = 1;
        jQuery(".custom-control-input[value=" + filterlist[i] + "]").attr("checked", "changed");
      }
    }
    if (checked == 1) {
      if (jQuery(".tax-product_cat").length > 0) {
        productcheckallfilters();
      }
      if (jQuery(".resourcedata").length > 0) {
        resoucecheckallfilters();
      }
      if (jQuery(".classdata").length > 0) {
        classcheckallfilters();
      }
    }
  }

  jQuery(".product-tabs .nav-tabs .nav-item .nav-link").click(function() {
    jQuery(".tab-content .tab-pane").removeClass("show active");
    jQuery(".tab-content #" + jQuery(this).attr("aria-controls")).addClass("show active");
  });
});

/*
function showMoreAccessories() {
  var moreText = document.getElementById("more");
  var btnText = document.getElementById("myBtn");
  var moreButton = "Show More <i class='fas fa-plus'></i>";
  var lessButton = "Show Less <i class='fas fa-minus'></i>";


  if (moreText.style.display == "contents") {
    btnText.innerHTML = moreButton;
    moreText.style.display = "none";
  } else {
    btnText.innerHTML = lessButton;
    moreText.style.display = "contents";
  }
}
*/


function showMoreResources() {
  var moreText = document.getElementById("more");
  var btnText = document.getElementById("myBtn");
  var moreButton = "Show More <i class='fas fa-plus'></i>";
  var lessButton = "Show Less <i class='fas fa-minus'></i>";


  if (moreText.style.display == "contents") {
    btnText.innerHTML = moreButton;
    moreText.style.display = "none";
  } else {
    btnText.innerHTML = lessButton;
    moreText.style.display = "contents";
  }
}

function showMore() {
  var moreText = document.getElementById("more");
  var btnText = document.getElementById("myBtn");
  var moreButton = "Show More <i class='fas fa-plus'></i>";
  var lessButton = "Show Less <i class='fas fa-minus'></i>";


  if (moreText.style.display === "contents") {
    btnText.innerHTML = moreButton;
    moreText.style.display = "none";
  } else {
    btnText.innerHTML = lessButton;
    moreText.style.display = "contents";
  }
}


function showMoreFAQ() {
  var moreText = document.getElementById("more");
  var btnText = document.getElementById("myBtn");
  var moreButton = "SEE ALL <i class='fas fa-plus'></i>";
  var lessButton = "SEE LESS <i class='fas fa-minus'></i>";


  if (moreText.style.display === "contents") {
    btnText.innerHTML = moreButton;
    moreText.style.display = "none";
  } else {
    btnText.innerHTML = lessButton;
    moreText.style.display = "contents";
  }
}

/**
* iFrame Resizing
*/
iFrameResize({ log: true }, '.sizetracker');
var eventMethod = window.addEventListener ? "addEventListener" : "attachEvent";
var eventer = window[eventMethod];
var messageEvent = eventMethod == "attachEvent" ? "onmessage" : "message";
// Listen for a message from the iframe.
eventer(messageEvent, function(e) {
    if (isNaN(e.data)) return;

    // replace #sizetracker with what ever what ever iframe id you need
    document.getElementById('sizetracker').style.height = e.data + 'px';

}, false);
