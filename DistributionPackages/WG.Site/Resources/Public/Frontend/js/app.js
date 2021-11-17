jQuery(document).foundation();

jQuery(document).ready(function() {

    /**
     * Functions on page load
     */

    initJs();

    /**
     * Functions on window resize
     */

    $(window).resize(function() {
        reInitJs();
        // headerHeight();
        footerHeight();
        //priv_ctrlNav();
    });

    /**
     * Functions on scrolling
     */

    $(window).scroll(function() {
        //closeOpenElements();
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
    resizeFn(); // resize Funktionen on page load
    wg_toggleNav(); // Navigation ein- und ausblenden
    wg_toggleSubItems(); // Subitems ein- und ausblenden
    wg_setStartActive(); // Den Nav Eintrag zur Startseite active setzten
    //wg_toggleLanguageNav(); // Sprach-Navigation ein- und ausblenden
    //wg_toggleSidebar();     // Sidebar ein und ausblenden
    wg_moveUp(); // scrolls to top of the page
    wg_shrinkNav(); // Shrinknav
    // headerHeight();
    footerHeight();
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
 * Navigationseintrag für die Startseite active setzten
 */
function wg_setStartActive() {
    if (window.location.href === "http://s887868066.online.de/" || window.location.href === "https://www.bio-eckbremen.de/" || window.location.href === "http://127.0.0.1:8081/") {
        $("a").each(function() {
            if ($(this).attr("href") === "/") {
                $(this).parent(".navigation-item").addClass("navigation-item--state-current");
            }
        })
    }
}


/**
 * Static Header Height
 */
function headerHeight() {
    var height = $(".main-header").outerHeight();
    if ($("body").hasClass("neos-backend")) {
        // Do Nothing
    } else {
        // console.log(height);
        //  $(".header-image").css("margin-top", height);
    }
}

/*
 * Footer Height
 */
function footerHeight() {
    var fHeight = $(".main-footer").outerHeight();
    // console.log(fHeight);
    $(".content-wrapper").css("min-height", "calc(100vh - " + fHeight + "px)");
}

/**
 * Toggle Referenzen Layer
 */

function wg_toggleNav() {

    $(".menu-trigger").click(function() {
        //var trigger = $(this);
        $('.main-nav').toggle();
        $(".menu-trigger").toggleClass('nav-open');
    });

} // end function toggleLayer()


function wg_toggleSubItems() {
    $("#mainnav .trigger").click(function() {
        $(this).parents("li").toggleClass('current', 500);
        $(this).toggleClass('current', 500);
    });
}

function wg_toggleLanguageNav() {

    $("#lg-trigger").click(function() {
        $(this).next('nav').slideToggle(500);
        //var trigger = $(this);
        //$('#lg-nav').toggle();
        //$("#nav-trigger").toggleClass('open');
    });

} // end function toggleLayer()

/**
 * Toggle Sidebar
 */
function wg_toggleSidebar() {
    $("#sidebar-trigger").click(function() {
        $('.sidebar').toggleClass('open', 500);
    });
}


/**
 * Scroll Detection
 */
function wg_shrinkNav() {
    $(window).scroll(function() {
        var winTop = $(window).scrollTop();
        if ($("body").hasClass("neos-backend")) {
            // Do Nothing
        } else {
            if (winTop >= 20) {
                $("body").addClass("sticky-shrinknav");
            } else {
                $("body").removeClass("sticky-shrinknav");
            }
        }
    });
};


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

    $("#toplink").click(function(event) {
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


// Maps

$(".confirm.google").on('click', function() {
    maps_laden();
})

$(".delete.google").on('click', function() {
    maps_loeschen();
})

function maps_laden() {
    Cookies.set('customMaps', 'yes')
    location.reload();
}


function maps_loeschen() {
    Cookies.remove('customMaps');
    location.reload();
}


/*News Slider*/
/*
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
*/


/*
E-Mailadressen Ver- und Entschlüsseln
*/

/*
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
*/