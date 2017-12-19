jQuery(document).ready(function($) {

	// Initializing foundation
	$(document).foundation();

	$('.close_btn_dynamic_sidebar').click(function(){
		$('.main_sidebar_toggle_wrap').animate({"left": "-31.125rem"}, "slow" );
        $('.main_sidebar_toggle_wrap').removeClass('j_side_widget');
	});

	$('.skip-link').click(function(){
		$('.main_sidebar_toggle_wrap').animate({"left": "0"}, "slow" );
        $('.main_sidebar_toggle_wrap').addClass('j_side_widget');
	});


    $('.c-sidebar-labelmobile').click(function(){
        if( $(this).hasClass('is-open') ){
            $('.menu-social-wrap-responsive').animate({"right": "-31.125rem"}, "slow" );
            $(this).removeClass('is-open');
        }else{
            $('.menu-social-wrap-responsive').animate({"right": "0"}, "slow" );
            $(this).addClass('is-open');
        }

    });

});

    // For masonary in category page
     // set the container that Masonry will be inside of in a var
    var container = document.querySelector('.archive .instablog_masonary_wrap');
    if(container){
        //create empty var msnry
        var msnry;
        // initialize Masonry after all images have loaded
        imagesLoaded( container, function() {
          msnry = new Masonry( container, {
            columnWidth: '.masonary-post',
            itemSelector: '.masonary-post',
            originLeft: 'true',
            percentPosition: true,
            gutter: 0
          });
        });
    }
