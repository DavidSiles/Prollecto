$(document).ready(function() {
    // Verificar si el usuario ya ha aceptado las cookies
    if (localStorage.getItem('cookiesAccepted') !== 'true') {
        $('.cookie-container').show();
    }

    // Cuando se hace clic en el botón de aceptar cookies
    $('.cookie-btn').click(function() {
        localStorage.setItem('cookiesAccepted', 'true');
        $('.cookie-container').hide();
    });
    // Clic en el botón de no aceptar cookies
    $('.cookie-btn1').click(function() {
        $('.cookie-container').fadeOut();
        
        // Volver a mostrar el banner 
        setTimeout(function() {
            $('.cookie-container').fadeIn();
        }, 1000); 
    });
});
