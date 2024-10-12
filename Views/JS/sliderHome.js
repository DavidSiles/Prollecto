
$(document).ready(function(){
    // Configuración del slider
   $('#filmImg1').slick({
        autoplay: true, 
        autoplaySpeed: 6000,
        slidesToShow: 2,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 1500,
                settings: {
                    slidesToShow: 1,
                    arrows: false
                }
            }
        ]
    });
});


$(document).ready(function(){
    // Configuración del slider
    $('#filmImg2').slick({
        autoplay: true, 
        autoplaySpeed: 2000,
        slidesToShow: 4,
        slidesToScroll: 3,
        responsive: [
            {
                breakpoint: 1500,
                settings: {
                    slidesToShow: 3,
                    arrows: false
                }
            },
            {
                breakpoint: 1020,
                settings: {
                    slidesToShow: 2,
                    arrows: false
                }
            }
        ]
    });

});
