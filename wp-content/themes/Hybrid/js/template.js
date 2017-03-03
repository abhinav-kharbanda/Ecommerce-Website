$(document).ready(function(){
    
	
   	//Responsive Navigation Menu

	/*$('.top_menu').slicknav({
	label: '',
	duration: 700,

	
	});*/
    
    
        if($(window).width()<=780)
            {
                $('.top_menu').hide();
                $('.mob_menu_button').show();
               
                
            }
	
$('.mob_menu_button').click(function(){
  $('.navigation-mob').slideToggle(200);
    
});
	//Make Videos Responsive
	$(".video-wrapper").fitVids();

	//Initialize tooltips
	$('.show-tooltip').tooltip();

	//Contact Us Map
	if($('#contact-us-map').length > 0){ //Checks if there is a map element
		var map = L.map('contact-us-map', {
			center: [51.502, -0.09],
			scrollWheelZoom: false,
			zoom: 15
		});
		L.tileLayer('http://{s}.tile.cloudmade.com/{key}/22677/256/{z}/{x}/{y}.png', {
			key: 'BC9A493B41014CAABB98F0471D759707'
		}).addTo(map);
		L.marker([51.5, -0.09]).addTo(map).bindPopup("<b>Some Company</b><br/>123 Fake Street<br/>LN1 2ST<br/>London</br>United Kingdom").openPopup();
	}

	$( window ).resize(function() {
		$('.col-footer:eq(0), .col-footer:eq(1)').css('height', '');
		var footerColHeight = Math.max($('.col-footer:eq(0)').height(), $('.col-footer:eq(1)').height()) + 'px';
		$('.col-footer:eq(0), .col-footer:eq(1)').css('height', footerColHeight);
	});
	$( window ).resize();

});
	



$( window ).resize(function() {
    
      if($(window).width()<=780)
            {
                $('.top_menu').hide();
                $('.mob_menu_button').show();
             
                
           }
  
      else
      {
          $('.top_menu').show();
                $('.mob_menu_button').hide();
                $('.navigation-mob').hide();
      }
   
    if($(window).width()<=1115)
    {
                $('.container').css("padding","0% 8%");
        
    }
    
    else
        $('.container').css("padding","0 15px");
        

$( "#log" ).append( "<div>Handler for .resize() called.</div>" );
});
