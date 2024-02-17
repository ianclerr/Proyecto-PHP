$( document ).ready(function() {

    $('nav ul li > a:not(:only-child)').click(function(e) {
      $(this).siblings('.nav-submenu').toggle();
      $('.nav-submenu').not($(this).siblings()).hide();
      e.stopPropagation();
    });
  
    $('html').click(function() {
      $('.nav-submenu').hide();
    });
    
    $('#nav-boton').click(function() {
      $('nav ul').toggle()
      $('#nav-boton').toggleClass("activo");
    })
  
  });