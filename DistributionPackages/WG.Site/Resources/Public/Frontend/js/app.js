jQuery(document).foundation();

jQuery(document).ready(function () {

  /**
  * Functions on page load
  */

  initJs();

  /**
   * Functions on window resize
   */

  $(window).resize($.debounce(500, function () {
    reInitJs();
    //priv_ctrlNav();
  }));

  /**
   * Functions on scrolling
   */

  $(window).scroll(function () {
    closeOpenElements();
    //headerControle();
    //hideLayer();
  });

});


/** 
 * Initialisierung (on load)
 * Re-Initalisierung (on resize)
 */

var w = false;
var breakpoint = 600;

function initJs() {
  resizeFn();             // resize Funktionen on page load
  wg_toggleNav();         // Navigation ein- und ausblenden
  wg_toggleSubItems();    // Subitems ein- und ausblenden
  wg_toggleLanguageNav(); // Sprach-Navigation ein- und ausblenden
  wg_toggleSidebar();     // Sidebar ein und ausblenden
  wg_moveUp();            // scrolls to top of the page
  wg_shrinkNav();         // Shrinknav
  wg_toggleForm();        // Katalog Formular ausblenden
  // wg_showIconInfo();      // Iconset Infos
}


function reInitJs() {
  var wNew = $(window).width();
  if ((wNew >= breakpoint && w < breakpoint) || (wNew < breakpoint && w >= breakpoint)) { resizeFn(); }
  /* debug
  if(wNew >= breakpoint && w < breakpoint) { alert("change to large device: "+w+"-"+wNew); w = wNew; return true; }
  if(wNew < breakpoint && w >= breakpoint) { alert("change to small device: "+w+"-"+wNew); w = wNew; return true; }
  alert("no change: "+w+"-"+wNew); w = wNew; return false;
  */
}


function resizeFn() {
  w = $(window).width();

  if (w >= breakpoint) {
    //alert("large device: "+w);

  } else {
    //alert("small device: "+w);

  }
}


/**
 * Section: custom Functions
 * all function should start with prefix "wg_"
 * use CamelCase for the functionname
 */


/**
 * Toggle Referenzen Layer
 */

function wg_toggleNav() {

  $("#nav-trigger").click(function () {
    //var trigger = $(this);
    $('#navigation').toggle();
    $("#nav-trigger").toggleClass('open');
  });

}  // end function toggleLayer()


function wg_toggleSubItems() {
  $("#mainnav .trigger").click(function () {
    $(this).parents("li").toggleClass('current', 500);
    $(this).toggleClass('current', 500);
  });
}

function wg_toggleLanguageNav() {

  $("#lg-trigger").click(function () {
    $(this).next('nav').slideToggle(500);
    //var trigger = $(this);
    //$('#lg-nav').toggle();
    //$("#nav-trigger").toggleClass('open');
  });

}  // end function toggleLayer()

/**
 * Toggle Sidebar
 */
function wg_toggleSidebar() {
  $("#sidebar-trigger").click(function () {
    $('.sidebar').toggleClass('open', 500);
  });
}

function wg_shrinkNav() {
  $(window).scroll(function () {
    var winTop = $(window).scrollTop();
    if (winTop >= 30) {
      $("body").addClass("sticky-shrinknav");
    } else {
      $("body").removeClass("sticky-shrinknav");
    }
  });
};

/** Toggle Katalog Formular */
function wg_toggleForm() {
  $(".form-trigger").click(function(){
    $(".form-catalog").slideToggle(500);
  });
}

// helper function
// Navigation scrollbar machen, wenn erforderlich
function priv_ctrlNav() {

  var nav = $('#navigation');
  var navheight = $(nav).outerHeight();
  var windowheight = $(window).height();
  //alert( navheight );
  //alert( $(window).height() );

  if (navheight > windowheight) {
    if ($(nav).hasClass('scrollable') === false) {
      $(nav).addClass('scrollable');
    }
  } else {
    if ($(nav).hasClass('scrollable')) {
      $(nav).removeClass('scrollable');
    }
  }
}



/**
 * Zum Seitenanfang springen
 */

function wg_moveUp() {

  $("#toplink").click(function (event) {
    event.preventDefault();
    $('html, body').animate({
      scrollTop: $("body").offset().top
    }, 1000);
  });

} // end function moveUp()


/**
 * Zum Seitenanfang springen
 */

function wg_moveToAnker(ankerID) {

  $('html, body').animate({
    scrollTop: $("#" + ankerID).offset().top - 100
  }, 1000);

} // end function wg_moveToAnker()


/**
 * Show Icon-Infos
 */

function wg_showIconInfo() {

  $(".iconset a").mouseenter(function () {
    var info = $(this).attr('data-info');
    $('.iconinfo').text(info);
  }).mouseleave(function () {
    $('.iconinfo').text('');
  });

  $(".iconset-svg a").mouseenter(function () {
    var info = $(this).attr('data-info');
    $('.iconinfo').text(info);
  }).mouseleave(function () {
    $('.iconinfo').text('');
  });

  /*  
    $("#iconset span").click( function() {
      var content = $("#iconinfo").text();
      var info = $(this).attr('data-info');
      if(content == info) { 
        $('#iconinfo').text('');
      }
      else {
        $('#iconinfo').text(info);
      }
    })
  */
}  // end function showIconInfo()


/**
 * Sidebar und Navi schließen
 */

function closeOpenElements() {

  if ($('.sidebar').hasClass('open')) {
    $('.sidebar').toggleClass('open', 500);
  }
  /*
    if( $('#navigation').css("display") == 'block' ) {
      $('#navigation').hide();
      $('#nav-trigger').removeClass('open');    
    }
  */
} // end function moveUp()


function maps_loeschen() {
  Cookies.remove('custom_google_maps');
  location.reload();
}


/*News Slider*/

$('.news-slider').owlCarousel({
  items: 4,
  margin: 20,
  nav: true,
  dots: false,
  navText: ['<svg xmlns=\"http:\/\/www.w3.org\/2000\/svg\" viewBox=\"0 0 8.15 8.45\"><defs><style>.arrow-slider-left-cls-1{fill:#002640;}<\/style><\/defs><path class=\"arrow-slider-left-cls-1\" d=\"M2.06,4.22A24.24,24.24,0,0,1,3.53,0H1.34A31.07,31.07,0,0,0,.05,4l0,.24.05.21a29.63,29.63,0,0,0,1.3,4H3.54A24.38,24.38,0,0,1,2.06,4.22Z\"\/><path class=\"arrow-slider-left-cls-1\" d=\"M4.67,4l-.06.24.06.23A28.24,28.24,0,0,0,6,8.45H8.15A25.25,25.25,0,0,1,6.67,4.22,24.28,24.28,0,0,1,8.15,0H6A28.84,28.84,0,0,0,4.67,4Z\"\/><\/svg>', '<svg xmlns=\"http:\/\/www.w3.org\/2000\/svg\" viewBox=\"0 0 8.15 8.45\"><defs><style>.arrow-slider-cls1{fill:#002640;}<\/style><\/defs><g><g><g><path class=\"arrow-slider-cls1\" d=\"M6.09,4.23A24.24,24.24,0,0,1,4.62,8.45H6.81a31.07,31.07,0,0,0,1.29-4l.05-.24L8.1,4A29.63,29.63,0,0,0,6.8,0H4.61A24.38,24.38,0,0,1,6.09,4.23Z\"\/><path class=\"arrow-slider-cls1\" d=\"M3.48,4.47l.06-.24L3.48,4A28.24,28.24,0,0,0,2.19,0H0A25.25,25.25,0,0,1,1.48,4.23,24.28,24.28,0,0,1,0,8.45H2.2A29.73,29.73,0,0,0,3.48,4.47Z\"\/><\/g><\/g><\/g><\/svg>'],
  responsive: {
    0: {
      items: 1
    },
    600: {
      items: 3
    },
    1028: {
      items: 4
    }
  }
});


/*Shopslider*/

$('.newsslider').owlCarousel({
  margin: 70,
  items: 3,
  nav: true,
  dots: false,
  navText: ['<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30.05 52.75"><defs><style>.arrow-prev-cls-1{fill:#002640;}</style></defs><title>pfeil-produktslider-prev</title><g id="Ebene_2" data-name="Ebene 2"><g id="Ebene_1-2" data-name="Ebene 1"><g id="Ebene_1-2-2" data-name="Ebene 1-2"><path class="cls-1" d="M23.85,51.75,1.05,29h0a3.62,3.62,0,0,1,0-5.1l22.8-22.8A3.61,3.61,0,0,1,29,6.15L8.75,26.35,29,46.65a3.41,3.41,0,0,1,1.1,2.5,3.59,3.59,0,0,1-3.6,3.6A3.54,3.54,0,0,1,23.85,51.75Z"/></g></g></g></svg>', '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30.05 52.75"><defs><style>.arrow-for-cls-1{fill:#002640;}</style></defs><title>Element 1</title><g id="Ebene_2" data-name="Ebene 2"><g id="Ebene_1-2" data-name="Ebene 1"><g id="Ebene_1-2-2" data-name="Ebene 1-2"><path class="cls-1" d="M3.6,52.75A3.59,3.59,0,0,1,0,49.15a3.41,3.41,0,0,1,1.1-2.5l20.2-20.3L1.1,6.15a3.61,3.61,0,0,1,5.1-5.1L29,23.85A3.62,3.62,0,0,1,29,29h0L6.2,51.75A3.54,3.54,0,0,1,3.6,52.75Z"/></g></g></g></svg>'],
  responsive: {
    0: {
      items: 1
    },
    600: {
      items: 2
    },
    1028: {
      items: 3
    }
  }
});



/*
E-Mailadressen Ver- und Entschlüsseln
*/


function EnCrypt_mailaddress(s) {
  var n = 0;
  var r = "";
  for (var i = 0; i < s.length; i++) {
    n = s.charCodeAt(i);
    if (n >= 8364) { n = 128; }
    r += String.fromCharCode(n + (3));
  }
  return r;
}

function UnCrypt_mailaddress(s) {
  var n = 0;
  var r = "";
  for (var i = 0; i < s.length; i++) {
    n = s.charCodeAt(i);
    if (n >= 8364) { n = 128; }
    r += String.fromCharCode(n - (3));
  }
  return r;
}

function open_mailaddress(s) {
  location.href = UnCrypt_mailaddress(s);
}

function test_encryption(s, enc_s) {
  alert('input: ' + s);
  alert('encrypted: ' + enc_s);
  var dec_s = UnCrypt_mailaddress(enc_s);
  alert('decrypted: ' + dec_s);
}