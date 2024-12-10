document.addEventListener('DOMContentLoaded', function () {
    const cartLink = document.querySelector('.cart a');
    let cartCount = 0;

    document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            cartCount++;
            cartLink.innerHTML = `Cart (${cartCount})`;
            alert('Item added to cart!');
        });
    });
});




$(document).ready(function () {
    var $slider = $('.hero-slider');
    var $sections = $('.single-slider');
    var currentSection = 0;
    
    function changeSection(index) {
        if (index < 0) index = 0;
        if (index >= $sections.length) index = $sections.length - 1;
        
        $slider.animate({ scrollTop: $sections.eq(index).offset().top }, 800);
        currentSection = index;
    }

    $(window).on('mousewheel DOMMouseScroll', function (event) {
        var delta = event.originalEvent.wheelDelta || -event.originalEvent.detail;

        if (delta > 0) {
            // Scrolling up
            changeSection(currentSection - 1);
        } else {
            // Scrolling down
            changeSection(currentSection + 1);
        }

        event.preventDefault(); // Prevent the default scroll behavior
    });

    // Optional: Add keyboard navigation
    $(document).on('keydown', function (event) {
        if (event.which === 38) {
            // Up arrow key
            changeSection(currentSection - 1);
        } else if (event.which === 40) {
            // Down arrow key
            changeSection(currentSection + 1);
        }
    });
});




var swiper = new Swiper('.slider-wrapper', {
    direction: 'horizontal',
    loop: true,
    autoplay: {
        delay: 3000,
        disableOnInteraction: false,
    },
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
});



// JS/script.js
document.addEventListener('DOMContentLoaded', function () {
    var swiper = new Swiper('.swiper-container', {
        loop: true,
        autoplay: {
            delay: 5000, // Change this value to adjust the auto-slide speed (in milliseconds)
            disableOnInteraction: false,
        },
        speed: 1000, // Adjust the transition speed here (in milliseconds)
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
});
