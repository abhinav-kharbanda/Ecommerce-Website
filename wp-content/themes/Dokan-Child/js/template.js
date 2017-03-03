$(document).ready(function() {
   // $(".archive .lazy.post-image").attr('src',' ');
    $(".search_button").click(function(e)
    {
        if (!$(this).closest(".input-group").children("#s").val())
        {
            e.preventDefault();
            $(this).closest("#searchform").animate({'borderColor': '#f37736'}).delay(200).stop().animate({'borderColor': '#eeeee'}, 400);
        }
    });
  $('.dropdown').on('show.bs.dropdown', function(e){
    var $menu = $(this).find('.dropdown-menu').first();
    if ($menu.hasClass('pull-center'))
        {   
            $menu.css('margin-right', ($menu.outerWidth() / -2));
        }
    $menu.stop(true, true).fadeIn(300);
  });
  // ADD SLIDEUP ANIMATION TO DROPDOWN //
  $('.dropdown').on('hide.bs.dropdown', function(e){
    var $menu = $(this).find('.dropdown-menu').first();
    
    $menu.stop(true, true).fadeOut(300);
  });  

  
    function getGridSize() {
        return  (window.innerWidth < 400) ? 1 : (window.innerWidth < 600) ? 2 : (window.innerWidth < 1000) ? 3 : 4;
    }
    $('.product-sliders').flexslider({
        namespace: "flex-",
        selector: ".slides > li",
        animation: "slide",
        itemWidth: 305,
        itemMargin: 30,
        touch: true,
        controlNav: false,
        prevText: "",
        nextText: "",
        minItems: 1,
        maxItems: getGridSize(),
        useCSS: true,
        keyboard: true,
        move: 3,
        animationLoop: true,
        slideshow: false
    });
    $('.shop-slider').flexslider({
        namespace: "flex-",
        selector: ".slides > li",
        animation: "fade",
        itemMargin: 0,
        touch: true,
        controlNav: false,
        prevText: "",
        nextText: "",
        minItems: 1,
        maxItems: getGridSize(),
        useCSS: true,
        keyboard: true,
        move: 3,
        animationLoop: true,
        slideshow: true,
        slideshowSpeed: 6000,
        pauseOnHover: false,
        start:
        function(slider) {
            var curr_slide = $('.flex-active-slide');
            curr_slide.find('.image').animate({right: '0px', opacity: '1'}, 600, function() {
                curr_slide.find('.title').animate({opacity: '1'}, 300, function() {
                    curr_slide.find('.description').animate({opacity: '1'}, 800);
                });
            });
                }, //Callback: function(slider) - Fires asynchronously with each slider animation
                before:
                function(slider) {
                    var curr_slide = $('.flex-active-slide');
                    curr_slide.find('.image').animate({right: '-300px', opacity: '0'}, 600, function() {
                        $(this).css('right', '-200px');
                    });
                    curr_slide.find('.title , .description').animate({left: '-300px', opacity: '0'}, 300, function() {
                        $(this).css('left', '0px');
                    });
                },
                after: function(slider) {
            //$('.flex-active-slide').find('.image').animate({right:'0px',opacity:'1'},400);
            var curr_slide = $('.flex-active-slide');
            curr_slide.find('.image').animate({right: '0px', opacity: '1'}, 600, function() {
                curr_slide.find('.title').animate({opacity: '1'}, 300, function() {
                    curr_slide.find('.description').animate({opacity: '1'}, 800);
                });
            });
        }            //Callback: function(slider) - Fires after each slider animation completes
    });
$('.sidebar-seller-btn').click(function(e) {
    if ($('ul.contact-seller-side-list').is(':hidden'))
    {
        e.preventDefault();
        $('ul.contact-seller-side-list').slideToggle(500);
        $(this).attr('value', 'Send Message');
    }
});
if(! $('.single_add_to_cart_button').hasClass('add_to_cart_button'))
{
    $('.quantity').hide();
}
});
$(document).on("scroll", function() {
    var header = $(".mainmenu-wrapper");
    if ($('body').hasClass('archive'))
    {
        if ($(document).scrollTop() > 640) {
            $(".mainmenu-wrapper").addClass("small");
        } else {
            $(".mainmenu-wrapper").removeClass("small");
        }
    }
    if ($(document).scrollTop() > 10) {
        $(".mainmenu-wrapper").addClass("shadow");
    } else {
        $(".mainmenu-wrapper").removeClass("shadow");
    }
});
 $(document).on('click','.notice-close',function(){
        $(this).parent().fadeOut(600);


  });