//**************************
//        Site v1.0       
//       Authored by      
//   Conran Design Group
//**************************

$(document).ready(function(){ 

	//***********************************
	// ADD A CLASS TO THE BODY IF JS ENABLED
	//***********************************
	$("body").addClass("jsEnabled");
	
	var $w = $(window);
	var $wH = $w.height();
	var $wW = $w.width();
	
	$("#topContainer").css("height", $wH + "px");
	$("#mainContainer").css("min-height", $wH + "px");
	//$("#bottomContainer").css("min-height", $wH + "px");
	
	
	$('#mainContainer').waypoint(function(direction) {
		$("header").toggleClass("scrolled");
	}, {
	  offset: '70'
	});
	
	$('#bottomContainer').waypoint(function(direction) {
		$("header").toggleClass("bottom");
	}, {
	  offset: '70'
	});
	
	
	
	
	
	
	// Find all YouTube videos
	//var $allVideos = $("iframe[src^='http://www.youtube.com']"),
	var $allVideos = $("iframe[src^='http://player.vimeo.com'], iframe[src^='http://www.youtube.com']"),
	
	    // The element that is fluid width
	    $fluidEl = $("body");
	
	// Figure out and save aspect ratio for each video
	$allVideos.each(function() {
	
	  $(this)
	    .data('aspectRatio', this.height / this.width)
	
	    // and remove the hard coded width/height
	    .removeAttr('height')
	    .removeAttr('width');
	
	});
	
	// When the window is resized
	$(window).resize(function() {
	
	  var newWidth = $fluidEl.width();
	
	  // Resize all videos according to their own aspect ratio
	  $allVideos.each(function() {
	
	    var $el = $(this);
	    $el
	      .width(newWidth)
	      .height(newWidth * $el.data('aspectRatio'));
	
	  });
	
	// Kick off one resize to fix all videos on page load
	}).resize();
	
	
	
	
	
	//***********************************
	// Clear/replace value
	//***********************************
	var searchBoxClearMePrevious = '';
	$("input.searchQ").focus(function(){
		if ( $(this).val() == $(this).attr('title') ) {
			searchBoxClearMePrevious = $(this).val();
			$(this).val('');
		}
	});
	$("input.searchQ").blur(function(){
		if ( $(this).val() == '' ) {
			$(this).val(searchBoxClearMePrevious);
		}
	});
	
	//***********************************
	// external links new window
	//***********************************
	$("a[href^='http:']:not([href*='" + window.location.host + "'])").each(function() {               
		$(this).attr("target", "_blank");
	});
	
	//***********************************
	// print page
	//***********************************
	$(".pageTool1 a").click(function(e){
		e.preventDefault();
		window.print();
	})

	//***********************************
	// bookmark page
	//***********************************
	$(".pageTool3 a").click(function(e){
		e.preventDefault();
		if(document.all)window.external.AddFavorite(location.href,document.title);
		else if(window.sidebar)window.sidebar.addPanel(document.title,location.href,'');
	})
	
});