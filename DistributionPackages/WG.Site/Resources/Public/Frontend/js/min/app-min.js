function initJs(){resizeFn(),wg_toggleNav(),wg_toggleSubItems(),wg_setStartActive(),wg_moveUp(),wg_shrinkNav(),footerHeight()}function reInitJs(){var n=$(window).width();(n>=breakpoint&&breakpoint>w||breakpoint>n&&w>=breakpoint)&&resizeFn()}function resizeFn(){w=$(window).width()}function wg_setStartActive(){("https://relaunch.zahnarzt-friedrichs.de/"===window.location.href||"https://www.zahnarzt-friedrichs.de/"===window.location.href||"http://127.0.0.1:8081/"===window.location.href)&&$("a").each(function(){"/"===$(this).attr("href")&&$(this).parent(".navigation-item").addClass("navigation-item--state-current")})}function headerHeight(){$(".main-header").outerHeight();$("body").hasClass("neos-backend")}function footerHeight(){var n=$(".main-footer").outerHeight();$(".content-wrapper").css("min-height","calc(100vh - "+n+"px)")}function wg_toggleNav(){$(".menu-trigger").click(function(){$(".main-nav").toggle(),$(".menu-trigger").toggleClass("nav-open")})}function wg_toggleSubItems(){$("#mainnav .trigger").click(function(){$(this).parents("li").toggleClass("current",500),$(this).toggleClass("current",500)})}function wg_toggleLanguageNav(){$("#lg-trigger").click(function(){$(this).next("nav").slideToggle(500)})}function wg_toggleSidebar(){$("#sidebar-trigger").click(function(){$(".sidebar").toggleClass("open",500)})}function wg_shrinkNav(){$(window).scroll(function(){var n=$(window).scrollTop();$("body").hasClass("neos-backend")||(n>=20?$("body").addClass("sticky-shrinknav"):$("body").removeClass("sticky-shrinknav"))})}function priv_ctrlNav(){var n=$("#navigation"),e=$(n).outerHeight(),t=$(window).height();e>t?$(n).hasClass("scrollable")===!1&&$(n).addClass("scrollable"):$(n).hasClass("scrollable")&&$(n).removeClass("scrollable")}function wg_moveUp(){$("#toplink").click(function(n){n.preventDefault(),$("html, body").animate({scrollTop:$("body").offset().top},1e3)})}function wg_moveToAnker(n){$("html, body").animate({scrollTop:$("#"+n).offset().top-100},1e3)}function closeOpenElements(){$(".sidebar").hasClass("open")&&$(".sidebar").toggleClass("open",500)}function maps_laden(){Cookies.set("customMaps","yes"),location.reload()}function maps_loeschen(){Cookies.remove("customMaps"),location.reload()}jQuery(document).foundation(),jQuery(document).ready(function(){initJs(),$(window).resize(function(){reInitJs(),footerHeight()}),$(window).scroll(function(){})});var w=!1,breakpoint=600;$(".confirm.google").on("click",function(){maps_laden()}),$(".delete.google").on("click",function(){maps_loeschen()});
//# sourceMappingURL=app-min.js.map