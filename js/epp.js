jQuery(document).ready(function() {


  //---------------------------------
  // Settings
  //
  // Easy Peasy Portfolio uses jQuery-based JavaScript to enhance
  // the user experience. If you don't want to dig into the script
  // you can adjust a few parameters below.
  //---------------------------------

  activate = true;        // Change to false to deactivate all JavaScript animations. Mainly used to compare usability by Linus.
  fadeTime = 125;         // Set your preferred title fade time in milliseconds


  //---------------------------------
  // Activating JS
  //
  // Doing it the easy way: if we want to use effects,
  // just remove the .no-js class from the wrapper.
  // This is to make it easier to compare usability with
  // and without effects, and style appropriately.
  //---------------------------------

  if(activate) {
    jQuery('body').removeClass('no-js').addClass('js');
  }


  //---------------------------------
  // Polaroid title fade on archives
  //---------------------------------

  jQuery('body.js > .posts > .archive > .polaroid').hover(function(){
    jQuery(this).find('.caption').fadeIn(fadeTime);
  }, function(){
    jQuery(this).find('.caption').fadeOut(fadeTime*2);
  });


  //---------------------------------
  // Centering polaroid images vertically
  // and displaying a preloader
  //---------------------------------

  jQuery('body.js .archive .polaroid .image:has(img)').prepend('<img class="preloader" src="/wp-content/themes/easypeasyportfolio/img/preloader.gif" />');
  jQuery('body.js .archive .polaroid .image .featured-image').hide().load(function(){
    jQuery(this).each(function() {
      w = jQuery(this).width();
      h = jQuery(this).height();
      if (w > h) {
        jQuery(this).css({
          'position' : 'relative',
          'top' : '50%',
          'margin-top' : '-'+h/2+'px'
        });
      }
      jQuery(this).parent().find('> .preloader').fadeOut(700, function(){
        jQuery(this).parent().find('> .featured-image').fadeIn(700);
        jQuery(this).remove();
      });
    });
  }).each(function(){
    if (this.complete) {
      jQuery(this).trigger('load');
    }
  });


  //---------------------------------
  // Random rotation of polaroids on archive
  //
  // Uses the easy element rotation jQuery plugin:
  // http://plugins.jquery.com/project/easy-element-rotation
  //---------------------------------

  function randomXtoY(minVal,maxVal,floatVal) {
    var randVal = minVal+(Math.random()*(maxVal-minVal));
    return typeof floatVal=='undefined'?Math.round(randVal):randVal.toFixed(floatVal);
  }

  jQuery('body.js .archive .polaroid, body.js #presentation .polaroid .image').each(function(){
    degree = randomXtoY(-0.8,0.8)
    jQuery(this).parent().easyRotate({
      'degrees' : degree
    });
    jQuery(this).parent().css({
      'position' : 'static'
    });
  });


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

  jQuery(window).load(function() {
    jQuery('body.js .gallery a').colorbox({
      'initialWidth' : '200',
      'initialHeight' : '200',
      'opacity' : '0.6',
      'maxHeight' : '700',
      'maxWidth' : '800',
      'current' : '{current} of {total}'
    });
  });


  //---------------------------------
  // Labelify
  //
  // Hides the comment labels and places them in the input fields.
  // Cleaner, and better usability too.
  //
  // Uses the neat labelify jQuery plugin:
  // http://colorpowered.com/colorbox/
  //---------------------------------

  jQuery('body.js #respond #commentform input[type="text"], body.js #respond #commentform textarea').each(function(){
    if (jQuery(this).attr('value') == '') {
      jQuery(this).labelify({
        text: "label"
      });
    }
  });
  jQuery('body.js #respond #commentform label').remove();

});