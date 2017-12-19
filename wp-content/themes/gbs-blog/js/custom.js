jQuery(document).ready(function() {
  	"use strict";
	  var owl = jQuery("#homeslider");
   owl.owlCarousel({
	  navigation : true, // Show next and prev buttons
      slideSpeed : 300,
      paginationSpeed : 400,
      singleItem:true,
	  items : 1,
      // "singleItem:true" is a shortcut for:
      // items : 1, 
      // itemsDesktop : false,
      // itemsDesktopSmall : false,
      // itemsTablet: false,
      // itemsMobile : false
 
  });
});

jQuery(document).ready(function(){
    "use strict";
  jQuery('.search-col img').click(function(e){
    jQuery('.search-col .search-field').toggleClass('active');
  });
 });