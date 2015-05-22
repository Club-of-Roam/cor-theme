///////////////////////////////
// Variables
///////////////////////////////

var gridContainer = jQuery('.thumbs');
var colW;
var gridGutter = 0;
var thumbWidth = 350;
var themeColumns = 3;
var catptionOffset = -20;
var stickyNav = jQuery('#header .bottom .surround');
var stickyNavOffsetTop;
var topOffest = (jQuery('body').hasClass('admin-bar')) ? 28 : 0; //
var OS;

///////////////////////////////
// Set Home Slideshow Height
///////////////////////////////

function setHomeSlideshowHeight() {
	var windowHeight = jQuery(window).height()-topOffest;
	jQuery('.home .slideshow').height(windowHeight);
	jQuery('.home .slideshow .slide').height(windowHeight);
	jQuery('.home #header .top').height(windowHeight);
	jQuery('.home .slideshow .flex-direction-nav').css('top', (windowHeight/2)-15 );
	jQuery('.home .slideshow .flex-control-nav').css('top', windowHeight-40 );
}

///////////////////////////////
// Center Home Slideshow Text
///////////////////////////////

function centerHomeCaption() {
	jQuery('.home .slideshow .details').each(function(id){
		jQuery(this).css('margin-top','-'+((jQuery(this).actual('height')/2)-catptionOffset)+'px');
		jQuery(this).show();
	});
}

///////////////////////////////
// Home Slideshow Parallax
///////////////////////////////

function homeParallax(){
	if(jQuery('body').hasClass('home')){
		var top = jQuery(this).scrollTop();
		jQuery('.home .slideshow .details').css('transform', 'translateY(' + (top/-3) + 'px)');
		jQuery('.home .slideshow .slide').css({'background-position' : 'center ' + (-top/6)+"px"});
	}
}

///////////////////////////////
// Initialize
///////////////////////////////

jQuery.noConflict();
jQuery(document).ready(function(){

	jQuery('#container').imagesLoaded(function(){
		setHomeSlideshowHeight();
		centerHomeCaption();
		homeParallax();
		jQuery('.home #container').css('opacity', '1' );
	});

	jQuery(window).smartresize(function(){
		setHomeSlideshowHeight();
		centerHomeCaption();
	});

	jQuery(window).scroll(function() {
		homeParallax();
	});

	//Set Down Arrow Button
	jQuery('#downButton').click(function(){
		jQuery.scrollTo("#middle", 1000, { offset:-(jQuery('#header .bottom').height()+topOffest), axis:'y' });
	});

});