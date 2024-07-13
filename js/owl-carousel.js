$(function() {
    // Owl Carousel
        var owl = $(".owl-carousel");
        owl.owlCarousel({
        responsive: {
            0 : { //breakpoint from 0 up
                items: 1,
                margin: 10,
                loop: true,
                nav: false,
                autoplay: true,
                autoplayTimeout: 2500,
                autoplayHoverPause: true
            },
            821 : { //breakpoint from 768 up
                items: 2,
                autoplay: true,
                autoplayTimeout: 2500,
                autoplayHoverPause: true
            }
        }
    });
    $('.play').on('click',function(){
        owl.trigger('play.owl.autoplay',[2500])
    })
    $('.stop').on('click',function(){
        owl.trigger('stop.owl.autoplay')
                        });
// Custom Nav

    $('.carousel-next').click(() => owl.trigger('next.owl.carousel'))
    
    $('.carousel-prev').click(() => owl.trigger('prev.owl.carousel'))

    });
