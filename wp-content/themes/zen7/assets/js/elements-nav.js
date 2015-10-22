jQuery(document).ready(function($){

    function goToByScroll(id){
          // Reove "link" from the ID
        id = id.replace("link", "");
          // Scroll
        $('html,body').animate({
            scrollTop: $("#"+id).offset().top},
            'slow');
    }

    $(".btn-group-vertical > .btn").click(function(e) { 
        $(".btn-group-vertical > .btn").removeClass('selected');
        $(this).addClass('selected');
          // Prevent a page reload when a link is pressed
        e.preventDefault(); 
          // Call the scroll function
        goToByScroll($(this).attr("id"));           
    });
    jQuery(function($) {
      function fixDiv() {
        var $cache = $('.btn-group-vertical'); 
        if ($(window).scrollTop() > 220) {
            $cache.css({'position': 'fixed', 'top': '100px', 'width' : '160px'}); 
        } else {
          $cache.css({'position': 'relative', 'top': 'auto'});
        };
      };
      $(window).scroll(fixDiv);
      fixDiv();
    });
    jQuery(function($) {
      function fixDiv() {
        var $cache = $('.header[data-affix=header]'); 
        if ($(window).scrollTop() > 80) {
          if (jQuery('.admin-bar').length > 0) {
            $cache.css({'position': 'fixed', 'top': '32px'}).addClass('fadeDown-menu affix-menu').removeClass('fadeUp-menu');
          } else {
            $cache.css({'position': 'fixed', 'top': '0px'}).addClass('fadeDown-menu affix-menu').removeClass('fadeUp-menu');
          }
          $('.menu-affix').css({'height': '75px', 'top': '0px', 'width' : '100%'});
          $('.white-half-menu').css({"border-bottom" : "1px solid #E6E6E6"});
          // $('.header[data-affix=header].header-style-02 , .header[data-affix=header].header-style-03 , .header[data-affix=header].header-style-04 , .header[data-affix=header].header-style-05').css({'background': 'rgba(255,255,255,1)'});
        } else {
          $('.white-half-menu').css({"border-bottom" : "1px solid transparent"});
          $cache.css({'position': 'relative', 'top': 'auto'}).removeClass('fadeDown-menu affix-menu').addClass('fadeUp-menu');
          // $('.header[data-affix=header].header-style-02 , .header[data-affix=header].header-style-03 , .header[data-affix=header].header-style-04 , .header[data-affix=header].header-style-05').css({'background' : 'rgba(255,255,255,0.9)'})
          $('.menu-affix').css({'height': '0px', 'top': '0px', 'width' : '100%'});
        }
      }
      $(window).scroll(fixDiv);
      fixDiv();
    });
    jQuery(function($) {
      function fixDiv() {
        var $cache = $('.header[data-affix-min=header]'); 
        if ($(window).scrollTop() > 80) {
          $cache.css({'position': 'fixed', 'top': '0px'}).addClass('fadeDown-menu affix-menu').removeClass('fadeUp-menu'); 
          $('.menu-affix').css({'height': '75px', 'top': '0px', 'width' : '100%'});
          $('.header[data-affix-min=header].header-style-02').css({'background': '#fff'});
          $('.header[data-affix-min=header] nav.menu>ul>li a h1 , .header[data-affix-min=header] nav.menu>ul>li a h2').css({'display': 'none'});
          $('.header[data-affix-min=header] nav.menu>ul>li a').css({'padding-right': '0px'});
          $('.header[data-affix-min=header] nav.menu>ul').css({'height': '60px'});
          $('.header[data-affix-min=header] .logo').css({'line-height': '60px'});
        } else {
          $cache.css({'position': 'relative', 'top': 'auto'}).removeClass('fadeDown-menu affix-menu').addClass('fadeUp-menu');
          $('.menu-affix').css({'height': '0px', 'top': '0px', 'width' : '100%'});
          $('.header[data-affix-min=header] nav.menu>ul>li a h1 , .header[data-affix-min=header] nav.menu>ul>li a h2').css({'display': 'block'});
          $('.header[data-affix-min=header] nav.menu>ul>li a').css({'padding-right': '20px'});
          $('.header[data-affix-min=header] nav.menu>ul').css({'height': '75px'});
          $('.header[data-affix-min=header] .logo').css({'line-height': '75px'});
        }
      }
      $(window).scroll(fixDiv);
      fixDiv();
    });

});