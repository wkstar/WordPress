(function ($, root, undefined) {
	
	$(function () {
		
		'use strict';
		
		// DOM ready, take it away
		var $w = $(window);
		var $wW = $w.width();
		
		/* if($("body.home").length > 0){ */
			$('.wrapper > .inner').waypoint(function() {
				//if($wW > 640){
					$(".header nav").toggleClass("stuck");
				//}
			}, {
				offset: '115'	
			});
		/*
} else {
			$('.wrapper > .inner').waypoint(function() {
				//if($wW > 640){
					$(".header nav").toggleClass("stuck");
				//}
			}, {
				offset: '115'	
			});
		};
*/
		
		// Nav on mobile
		$("#nav-toggle").on("click", function(e){
			e.preventDefault();
			$(this).toggleClass("active");
			$(".header nav ul").slideToggle();
		});
		
		
		// Tabs setup
		var $tabs = $("#tabs nav a");
		var $tabsContent = $(".tabsCol .tabWrap");
		if($tabs.length > 0){
			$tabs.first().addClass("active")
			
			// See if more than 1 h3 PER tab, if there is, assign the class "accordion" to that tab
			$tabsContent.each(function() {
				var $this = $(this);
				if($this.find('h3').length > 1){ //if looking for direct descendants then do .children('div').length
					$this.addClass('accordions');
				}
			});
			/*
$(".accordions").each(function(){
				$('h3').nextUntil('h3').addBack().wrapAll('<div>');
			});
*/
		}
		
		// Tabs Switching
		var tabSwitch = function($t, $i){
			$tabs.removeClass("active");
			$t.addClass("active");
			$tabsContent.hide();
			$tabsContent.eq($i).show();
		};
		
		// Tab clicks
		$("#tabs nav").on("click", "a", function(e){
			e.preventDefault();
			var $t = $(this);
			var $i = $t.index();
			tabSwitch($t, $i);
		});
		
	});
	
})(jQuery, this);
