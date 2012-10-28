//---------------------------------
// Preloader for polaroids
//---------------------------------

function eppPreloadPolaroids() {
  jQuery('html.js .archive .polaroid .image:has(img)').prepend('<img class="preloader" src="/wp-content/themes/easypeasyportfolio/img/preloader.gif">');
  jQuery('html.js .archive .polaroid .image .featured-image').load(function(){
    jQuery(this).parent().find('> .preloader').fadeOut(700, function(){
      jQuery(this).parent().find('> .featured-image').css({ 'opacity': 1 });
      jQuery(this).remove();
    });
  }).each(function(){
    if (this.complete) {
      jQuery(this).trigger('load');
    }
  });
}


//---------------------------------
// Random rotation of polaroids on archive
//
// Uses the easy element rotation jQuery plugin:
// http://plugins.jquery.com/project/easy-element-rotation
//---------------------------------

function randomXtoY(minVal, maxVal, floatVal) {
  var randVal = minVal+(Math.random()*(maxVal-minVal));
  return typeof floatVal == 'undefined' ? Math.round(randVal) : randVal.toFixed(floatVal);
}

function eppRotatePolaroids() {
  jQuery('html.js .hentry.archive .polaroid, html.js #presentation .polaroid .image').each(function(){
    var degree = randomXtoY(-0.8,0.8)
    jQuery(this).parent().easyRotate({
      'degrees' : degree
    });
    jQuery(this).parent().css({
      'position' : 'static'
    });
  });
}


//---------------------------------
// Gallery images popup
//
// Places the large gallery images in a colorbox, so we don't
// have to open them in a new tab. Must be loaded after everything
// else when we load flickr images with JS - hence the window.load.
//
// Uses the awesome Colorbox jQuery plugin:
// http://colorpowered.com/colorbox/
//---------------------------------

function eppGalleryBox() {
  jQuery(window).load(function() {
    jQuery('html.js .gallery a').colorbox({
      'initialWidth' : '200',
      'initialHeight' : '200',
      'opacity' : '0.6',
      'maxHeight' : '700',
      'maxWidth' : '800',
      'current' : '{current} of {total}'
    });
  });
}


//---------------------------------
// Labelify
//
// Hides the comment labels and places them in the input fields.
// Cleaner, and better usability too.
//
// Uses the neat labelify jQuery plugin:
// http://www.kryogenix.org/code/browser/labelify/
//---------------------------------

function eppLabelify() {
  jQuery('html.js #respond #commentform input[type="text"], html.js #respond #commentform textarea').each(function(){
    if (jQuery(this).attr('value') == '') {
      jQuery(this).labelify({
        text: "label"
      });
    }
  });
  jQuery('html.js #respond #commentform label').remove();
}


//---------------------------------
// LET'S ROLL
//---------------------------------
jQuery(document).ready(function() {
  eppPreloadPolaroids();
  //eppRotatePolaroids();
  eppGalleryBox();
  eppLabelify();
});