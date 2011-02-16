jQuery(document).ready(function() {

  jQuery('.form-field, .form-table tr').each(function(){
    c = jQuery(this).find('label').attr('for');
    jQuery(this).addClass(c);
  });

});