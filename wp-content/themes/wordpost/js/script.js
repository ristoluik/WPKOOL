(function ($) {
/* custom forms plugin */
	$(function(){
		initCustomForms();
	});
	/* custom forms init */
	function initCustomForms() {
		/* Call stylized select*/
		$('select').customSelect();
		/* Call stylized radiobutton */
		$('input:radio').customRadio();
		/* Call stylized checkbox*/
		$('input:checkbox').customCheckbox();
		/* Hang function to click on the reset button*/
		$('input:reset').click(function() {
		/* We remove the checked attribute and a class activity in checkboxes */
			$('form').find('input:checked').removeAttr('checked');
			$('form').find('.checkboxAreaChecked').removeClass().addClass('checkboxArea');
		/* We remove a class activity in radiobuttons */
			$('form').find('.radioAreaChecked').removeClass().addClass('radioArea');
		/* Return select the value that was set when the page loads */
			$('.center').each(function() {
				var centerSele = $(this).attr("name");
				$(this).html(centerSele);
			});
		});
		/* Call stylized input file */
		if (!($.browser.msie && parseFloat($.browser.version)<7)){
			$('input:file').customInpfile();
		}
		/*A semi-transparent resource description in the header (description)*/
		$('.site-title span').animate({ opacity: 0.5 });
		$('#slider-wrap').Slider();
		/*The arrow under the active menu item navigation*/
		$('.current-menu-item').menuArrowCur();
		$('.current_page_item').menuArrowCurpage();
	}
	/* Menu current item - arrow*/
	$.fn.menuArrowCur = function(){
		var ArrowStructure = '<span class="current-item-arrow"></span>';
		var ArrovImg = '<div class="current-item-arrow"></div>';
		var width_li = $('.current-menu-item').width();
		$('#navigation .current-menu-item').append(ArrovImg);
		$('.current-item-arrow').css({'right':width_li/2});
	};
	$.fn.menuArrowCurpage = function(){
		var ArrowStructurep = '<span class="current-item-arrow"></span>';
		var ArrovImgp = '<div class="current-item-arrow"></div>';
		var width_lip = $('.current_page_item').width();
		$('#navigation .current_page_item').append(ArrovImgp);
		$('.current-item-arrow').css({'right':width_lip/2});
	};
	/* custom input file module */
	$.fn.customInpfile = function(){
		var InpfileStructure = '<div class="fileLoad"><button>' + stringJs.chooseFile + '</button><input type="text" value="' + stringJs.fileNotSel + '" /></div>';
		var ImputFileDiv = '<div class="file-load-block"></div>';
		$('input:file').wrap(ImputFileDiv);
		$(InpfileStructure).insertBefore('input:file');
		$('input:file').animate({ opacity: 0 });
		/* track the change INPUT file */
		$('input:file').change(function(){
		/* If the file is attached skid value into a variable */
			var fileResult = $( this )[0].files[0]['name'];
			/* And then pass the value to the INPUT which is under the boot */
			$(this).parent().find('.fileLoad').find('input').val(fileResult);
		});
	};
	/* custom checkboxes module */
	$.fn.customCheckbox = function(_options){
		var _options = jQuery.extend({
			checkboxStructure: '<div></div>',
			checkboxDisabled: 'checkboxdisabled',
			checkboxDefault: 'checkboxArea',
			checkboxChecked: 'checkboxAreaChecked',
			filterClass:'default'
		}, _options);
		return this.each(function(){
			var checkbox = jQuery(this);
			if(!checkbox.hasClass('outtaHere') && checkbox.is(':checkbox') && !checkbox.hasClass(_options.filterClass)){
				var replaced = jQuery(_options.checkboxStructure);
				this._replaced = replaced;
				if(checkbox.is(':disabled')) replaced.addClass(_options.checkboxDisabled);
				else if(checkbox.is(':checked')) replaced.addClass(_options.checkboxChecked);
				else replaced.addClass(_options.checkboxDefault);

				replaced.click(function(){
					if(checkbox.is(':checked')) checkbox.removeAttr('checked');
					else if(checkbox.is(':disabled')) checkbox.attr('disabled');
					else checkbox.attr('checked', 'checked');
					changeCheckbox(checkbox);
				});
				checkbox.click(function(){
                    changeCheckbox(checkbox);
                    if(!checkbox.is(':checked')) checkbox.removeAttr('checked');
					else checkbox.attr('checked', 'checked');
				});
				checkbox.click(function(){
					changeCheckbox(checkbox);
				});
				replaced.insertBefore(checkbox);
				checkbox.addClass('outtaHere');
			}
		});
		function changeCheckbox(_this){
			_this.change();
			if(_this.is(':checked')) _this.get(0)._replaced.removeClass().addClass(_options.checkboxChecked);
			else if(_this.is(':disabled')) _this.get(0);
			else _this.get(0)._replaced.removeClass().addClass(_options.checkboxDefault);
		}
	};

	/* custom radios module */
	$.fn.customRadio = function(_options){
		var _options = jQuery.extend({
			radioStructure: '<div></div>',
			radioDisabled: 'radiodisabled',
			radioDefault: 'radioArea',
			radioChecked: 'radioAreaChecked',
			filterClass:'default'
		}, _options);
		return this.each(function(){
			var radio = jQuery(this);
			if(!radio.hasClass('outtaHere') && radio.is(':radio') && !radio.hasClass(_options.filterClass)){
				var replaced = jQuery(_options.radioStructure);
				this._replaced = replaced;
				if(radio.is(':disabled')) replaced.addClass(_options.radioDisabled);
				else if(radio.is(':checked')) replaced.addClass(_options.radioChecked);
				else replaced.addClass(_options.radioDefault);
				replaced.click(function(){
					if(jQuery(this).hasClass(_options.radioDefault)){
						radio.attr('checked', 'checked');
						changeRadio(radio.get(0));
					}
				});
				radio.click(function(){
					if(!jQuery(this).hasClass(_options.radioDefault)){
						radio.attr('checked', 'checked');
						changeRadio(radio.get(0));
					}
				});
				radio.click(function(){
					changeRadio(this);
				});
				replaced.insertBefore(radio);
				radio.addClass('outtaHere');
			}
		});
		function changeRadio(_this){
			jQuery(_this).change();
			jQuery('input:radio[name='+jQuery(_this).attr("name")+']').not(_this).each(function(){
				if(this._replaced && !jQuery(this).is(':disabled')) this._replaced.removeClass().addClass(_options.radioDefault);
                $(this).removeAttr('checked');
			});
			_this._replaced.removeClass().addClass(_options.radioChecked);
		}
	};

	/* custom selects module */
	$.fn.customSelect = function(_options) {
		var _options = jQuery.extend({
			selectStructure: '<div class="selectArea"><span class="left"></span><span class="center"></span><a href="#" class="selectButton"></a><div class="disabled"></div></div>',
			hideOnMouseOut: false,
			copyClass: true,
			selectText: '.center',
			selectBtn: '.selectButton',
			selectDisabled: '.disabled',
			optStructure: '<div class="optionsDivVisible"><div class="select-center"><ul></ul></div></div>',
			optList: 'ul',
			filterClass:'default'
		}, _options);
		return this.each(function() {
			var select = jQuery(this);
			if(!select.hasClass('outtaHere') && !select.hasClass(_options.filterClass)) {
				if(select.is(':visible')) {
					var hideOnMouseOut = _options.hideOnMouseOut;
					var copyClass = _options.copyClass;
					var replaced = jQuery(_options.selectStructure);
					var selectText = replaced.find(_options.selectText);
					var selectBtn = replaced.find(_options.selectBtn);
					var selectDisabled = replaced.find(_options.selectDisabled).hide();
					var optHolder = jQuery(_options.optStructure);
					var optList = optHolder.find(_options.optList);
					if(copyClass) optHolder.addClass('drop-'+select.attr('class'));

					if(select.attr('disabled')) selectDisabled.show();
					select.find('option, optgroup').each(function(){
						if (jQuery(this).is('optgroup')) {
							var selOptgroup = jQuery(this);
							var _optgroup = jQuery('<li class="not_click">' + selOptgroup.attr("label") + '</li>');
							optList.append(_optgroup);
							}
						if (jQuery(this).is('option')) {
							var selOpt = jQuery(this);
							var _opt = jQuery('<li><a href="#">' + selOpt.html() + '</a></li>');
							if(selOpt.attr('selected')) {
								selectText.html(selOpt.html());
								_opt.addClass('selected');
								selectText.attr("name",selectText.html());
							}

							_opt.children('a').click(function() {
								optList.find('li').removeClass('selected');
								select.find('option').removeAttr('selected');
								jQuery(this).parent().addClass('selected');
								selOpt.attr('selected', 'se(function ($) {lected');
								selectText.html(selOpt.html());
								select.change();
								optHolder.hide();
								return false;
							});
							optList.append(_opt);
						}
					});

					replaced.width(select.outerWidth());
					replaced.insertBefore(select);
					optHolder.css({
						width: select.outerWidth(),
						display: 'none',
						position: 'absolute'
					});
					jQuery(document.body).append(optHolder);

					var optTimer;
					replaced.hover(function() {
						if(optTimer) clearTimeout(optTimer);
					}, function() {
						if(hideOnMouseOut) {
							optTimer = setTimeout(function() {
								optHolder.hide();
							}, 200);
						}
					});
					optHolder.hover(function(){
						if(optTimer) clearTimeout(optTimer);
					}, function() {
						if(hideOnMouseOut) {
							optTimer = setTimeout(function() {
								optHolder.hide();
							}, 200);
						}
					});
					selectBtn.click(function() {
						if(optHolder.is(':visible')) {
							optHolder.hide();
						}
						else{
							if(_activeDrop) _activeDrop.hide();
							optHolder.find('ul').css({height:'auto', overflow:'hidden'});
							optHolder.css({
								top: replaced.offset().top + replaced.outerHeight(),
								left: replaced.offset().left,
								display: 'block'
							});
							_activeDrop = optHolder;
						}
						return false;
					});
					replaced.addClass(select.attr('class'));
					select.addClass('outtaHere');
				}
			}
		});
	};
			/*----------------------- Slider ---------------------*/
	$.fn.Slider = function() {
		var hwSlideSpeed = 700; /*Speed ​​slide transition animations*/
		var hwTimeOut = 3000;	/*time elapsed before turning slides*/
		var hwNeedLinks = false;	/*enables or disables the display of links "next - previous."*/
			$('.slide').css(
				{"position" : "absolute",
				"top":'0', "left": '0'}).hide().eq(0).show();
			var slideNum = 0;
			var slideTime;
			slideCount = $("#slider .slide").size();
			var animSlide = function(arrow){
				clearTimeout(slideTime);
				$('.slide').eq(slideNum).fadeOut(hwSlideSpeed);
				if(arrow == "next"){
					if(slideNum == (slideCount-1)){slideNum=0;}
					else{slideNum++}
				} else if(arrow == "prew") {
					if(slideNum == 0){
						slideNum=slideCount-1;
					} else {
					slideNum-=1
					}
				} else {
					slideNum = arrow;
				}
				$('.slide').eq(slideNum).fadeIn(hwSlideSpeed, rotator);
				$(".control-slide.active").removeClass("active");
				$('.control-slide').eq(slideNum).addClass('active');
			};
			if(hwNeedLinks){
				var $linkArrow = $('<a id="prewbutton" href="#">&lt;</a><a id="nextbutton" href="#">&gt;</a>').prependTo('#slider');
				$('#nextbutton').click(function(){
					animSlide("next");
					return false;
				});
				$('#prewbutton').click(function(){
					animSlide("prew");
					return false;
				})
			}
			var $adderSpan = '';
			$('.slide').each(function(index) {
				$adderSpan += '<span class = "control-slide">' + index + '</span>';
			});
			$('<div class ="sli-links">' + $adderSpan +'</div>').appendTo('#slider-wrap');
			$(".control-slide:first").addClass("active");
			$('.control-slide').click(function(){
				var goToNum = parseFloat($(this).text());
				animSlide(goToNum);
			});
			var pause = false;
			var rotator = function(){
				if(!pause){slideTime = setTimeout(function(){animSlide('next')}, hwTimeOut);}
			};
			$('#slider-wrap').hover(
				function(){clearTimeout(slideTime); pause = true;},
				function(){pause = false; rotator();
			});
			rotator();
	};
	/* event handler on DOM ready */
	var _activeDrop;
	$(function(){
		$('body').click(hideOptionsClick);
		$(window).resize(hideOptions)
	});
	function hideOptions() {
		if(_activeDrop && _activeDrop.length) {
			_activeDrop.hide();
			_activeDrop = null;
		}
	}
	function hideOptionsClick(e) {
		if(_activeDrop && _activeDrop.length) {
			var f = false;
			$(e.target).parents().each(function(){
				if(this == _activeDrop) f=true;
			});
			if(!f) {
				_activeDrop.hide();
				_activeDrop = null;
			}
		}
	}
})(jQuery);