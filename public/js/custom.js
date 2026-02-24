
  /* HTML document is loaded. DOM is ready. 
  -------------------------------------------*/

  $(document).ready(function() {

      $(".dropdown").hover(
          function() {
              $('.dropdown-menu', this).not('.in .dropdown-menu').stop(true,true).slideDown("400");
              $(this).toggleClass('open');
          },
          function() {
              $('.dropdown-menu', this).not('.in .dropdown-menu').stop(true,true).slideUp("400");
              $(this).toggleClass('open');
          }
      );


  /*-------------------------------------------------------------------------------
    Hide mobile menu after clicking on a link
  -------------------------------------------------------------------------------*/

      $('.navbar-collapse a').click(function(){
          $(".navbar-collapse").collapse('hide');
      });




  /*-------------------------------------------------------------------------------
    smoothScroll js
  -------------------------------------------------------------------------------*/
    $(function() {
        $('.navbar-default a').bind('click', function(event) {
            var $anchor = $(this);
            $('html, body').stop().animate({
                scrollTop: $($anchor.attr('href')).offset().top - 49
            }, 1000);
            event.preventDefault();
        });
    });


      /*The share request form*/
      $('.input').focus(function(){
          $(this).parent().find(".label-txt").addClass('label-active');
      });

      $(".input").focusout(function(){
          if ($(this).val() == '') {
              $(this).parent().find(".label-txt").removeClass('label-active');
          };
      });


      /*To display the total price without reloading*/
      /*$(function getTotalPrice() {
          var shareAmount = document.getElementById("shareAmount").value;
          var total = shareAmount*100000;
          document.getElementById('totalPrice').innerHTML = total;
      });*/

  /*-------------------------------------------------------------------------------
    Owl Carousel
  -------------------------------------------------------------------------------*/
    
   $(document).ready(function() {
    $("#screenshot-carousel").owlCarousel({
      items : 4,
      itemsDesktop : [1199,3],
      itemsDesktopSmall : [979,3],
      slideSpeed: 300,
    });
  });

   $(document).ready(function() {
    $("#about-carousel").owlCarousel({
      autoPlay: 6000,
      items : 1,
      itemsDesktop : [1199,1],
      itemsDesktopSmall : [979,1],
      itemsTablet: [768,1],
      itemsTabletSmall: false,
      itemsMobile : [479,1],
    });
  });



  /*-------------------------------------------------------------------------------
    wow js - Animation js
  -------------------------------------------------------------------------------*/

  new WOW({ mobile: true }).init();


  });

