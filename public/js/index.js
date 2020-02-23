
$('.owl-carousel').owlCarousel({
    margin:20,
    nav:true,
    navText: ["<i class='far fa-hand-point-left'></i>","<i class='far fa-hand-point-right'></i>"],
    dots: false,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:5
        }
    }
})

