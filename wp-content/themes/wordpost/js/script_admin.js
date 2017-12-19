// Jquery with no conflict
jQuery(document).ready(function($) {
	var temp=($('.wordpost_slide_image').prop('checked'))?1:0;
	if(0==temp){
		$('.slide_settings_hide').hide();
	}
	$('.wordpost_slide_image').click(function(){
		$('.slide_settings_hide').toggle();
		($('.wordpost_slide_image').prop('checked'))?$('.wordpost_delete_slide').val(''):$('.wordpost_delete_slide').val('delete');
	});
});

